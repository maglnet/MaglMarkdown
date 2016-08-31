<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 */

namespace MaglMarkdown\Service;

use MaglMarkdown\Adapter\MarkdownAdapterInterface;
use Zend\EventManager\EventManagerInterface;

class Markdown
{

    /**
     *
     * @var MarkdownAdapterInterface
     */
    private $markdownAdapter;

    /**
     *
     * @var EventManagerInterface
     */
    private $eventManager;

    /**
     * Markdown constructor.
     *
     * @param MarkdownAdapterInterface   $markdownAdapter
     * @param EventManagerInterface|null $eventManager
     */
    public function __construct(MarkdownAdapterInterface $markdownAdapter, EventManagerInterface $eventManager = null)
    {
        $this->markdownAdapter = $markdownAdapter;
        $this->eventManager = $eventManager;
    }

    public function render($markdown)
    {
        // first check if there's something within the cache
        $cachedMarkdown = $this->triggerEvent('markdown.render.pre', ['markdown' => $markdown]);
        if (false !== $cachedMarkdown) {
            return $cachedMarkdown;
        }

        // now render, it seems cache is not active
        // or nothing was found within the cache
        $renderedMarkdown = $this->markdownAdapter->transformText($markdown);

        // save the rendered markdown to the cache
        $this->triggerEvent('markdown.render.post', [
            'markdown' => $markdown,
            'renderedMarkdown' => $renderedMarkdown,
        ]);

        return $renderedMarkdown;
    }

    private function triggerEvent($event, $args)
    {
        // if there's no eventmanager, we don't need to trigger anything
        if (!$this->eventManager) {
            return false;
        }

        // triggering the event and return result, if event stopped
        $result = $this->eventManager->trigger($event, $this, $args);
        if ($result->stopped()) {
            return $result->last();
        }

        return false;
    }
}
