<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 */

namespace MaglMarkdown\Cache;

use Laminas\Cache\Storage\StorageInterface;
use Laminas\EventManager\Event;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;

/**
 * Class CacheListener
 *
 * @package MaglMarkdown\Cache
 */
class CacheListener implements ListenerAggregateInterface
{
    /**
     *
     * @var StorageInterface
     */
    private $cache;

    /**
     * @var callable[]
     */
    protected $listeners = array();

    /**
     * {@inheritDoc}
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $callback) {
            $events->detach($callback);
            unset($this->listeners[$index]);
        }
    }

    public function __construct(StorageInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param EventManagerInterface $events
     * @param int                   $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach('markdown.render.pre', array($this, 'preRender'), $priority);
        $this->listeners[] = $events->attach('markdown.render.post', array($this, 'postRender'), $priority);
    }

    /**
     * Searches the cache for rendered markdown.
     *
     * @param  \Laminas\EventManager\Event $event
     * @return mixed the rendered markdown, if found, false otherwise
     * @throws \Laminas\Cache\Exception\ExceptionInterface
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
     * @param \Laminas\EventManager\Event $event
     * @return mixed
     * @throws \Laminas\Cache\Exception\ExceptionInterface
     */
    public function postRender(Event $event)
    {
        $markdown = $event->getParam('markdown');
        $renderedMarkdown = $event->getParam('renderedMarkdown');

        $markdownHash = md5($markdown);

        return $this->cache->setItem($markdownHash, $renderedMarkdown);
    }
}
