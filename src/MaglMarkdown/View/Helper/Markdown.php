<?php

namespace MaglMarkdown\View\Helper;

/**
 * This is a ZF2 View Helper to provide Markdown transformation
 *
 * @author Matthias Glaub <magl@magl.net>
 */
class Markdown extends \Zend\View\Helper\AbstractHelper
{

    /**
     *
     * @var \MaglMarkdown\Adapter\MarkdownAdapterInterface
     */
    private $markdownAdapter;

    public function __construct(\MaglMarkdown\Adapter\MarkdownAdapterInterface $markdownAdapter)
    {
        $this->markdownAdapter = $markdownAdapter;
    }

    public function __invoke($text)
    {
        return $this->markdownAdapter->transformText($text);
    }

}
