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
    private $eventManager = null;

    public function __construct(MarkdownAdapterInterface $markdownAdapter, EventManagerInterface $eventManager = null)
    {
        $this->markdownAdapter = $markdownAdapter;
        $this->eventManager = $eventManager;
    }

    public function render($markdown)
    {
        // first check if there's something within the cache
        if ($this->eventManager) {
            $result = $this->eventManager->trigger('markdown.render.pre', $this, array('markdown' => $markdown));
            if ($result->stopped()) {
                return $result->last();
            }
        }

        // now render, it seems cache is not active
        // or nothing was found within the cache
        $renderedMarkdown = $this->markdownAdapter->transformText($markdown);

        // save the rendered markdown to the cache
        if ($this->eventManager) {
            $this->eventManager->trigger('markdown.render.post', $this, array(
                'markdown' => $markdown,
                'renderedMarkdown' => $renderedMarkdown
            ));
        }

        return $renderedMarkdown;
    }
}
