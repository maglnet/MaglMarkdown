<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 */

namespace MaglMarkdown\Cache;

use Zend\Cache\Storage\StorageInterface;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

/**
 * Class CacheListener
 *
 * @package MaglMarkdown\Cache
 */
class CacheListener implements ListenerAggregateInterface
{

    use ListenerAggregateTrait;

    /**
     *
     * @var StorageInterface
     */
    private $cache;

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
     * @param  \Zend\EventManager\Event $event
     * @return mixed the rendered markdown, if found, false otherwise
     * @throws \Zend\Cache\Exception\ExceptionInterface
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
     * @return mixed
     * @throws \Zend\Cache\Exception\ExceptionInterface
     */
    public function postRender(Event $event)
    {
        $markdown = $event->getParam('markdown');
        $renderedMarkdown = $event->getParam('renderedMarkdown');

        $markdownHash = md5($markdown);

        return $this->cache->setItem($markdownHash, $renderedMarkdown);
    }
}
