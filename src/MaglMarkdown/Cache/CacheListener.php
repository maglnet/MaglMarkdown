<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 */

namespace MaglMarkdown\Cache;

use Zend\Cache\Storage\StorageInterface;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class CacheListener implements ListenerAggregateInterface
{
    private $listeners = array();

    /**
     *
     * @var StorageInterface
     */
    private $cache;

    public function __construct(StorageInterface $cache)
    {
        $this->cache = $cache;
    }

    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('markdown.render.pre', array($this, 'preRender'));
        $this->listeners[] = $events->attach('markdown.render.post', array($this, 'postRender'));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Searches the cache for rendered markdown.
     *
     * @param  \Zend\EventManager\Event $event
     * @return mixed the rendered markdown, if found, false otherwise
     */
    public function preRender(Event $event)
    {
        $markdown = $event->getParam('markdown');

        $markdownHash = md5($markdown);

        $success = false;
        $renderedMarkdown = $this->cache->getItem($markdownHash, $success);
        if ($success) {
            $event->stopPropagation(true);

            return $renderedMarkdown;
        }

        return false;
    }

    /**
     * Saves the rendered markdown within the cache.
     *
     * @param \Zend\EventManager\Event $event
     */
    public function postRender(Event $event)
    {
        $markdown = $event->getParam('markdown');
        $renderedMarkdown = $event->getParam('renderedMarkdown');

        $markdownHash = md5($markdown);

        return $this->cache->setItem($markdownHash, $renderedMarkdown);
    }

}
