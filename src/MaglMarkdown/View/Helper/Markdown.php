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
     * @var \MaglMarkdown\Service\Markdown
     */
    private $markdownService;

    public function __construct(\MaglMarkdown\Service\Markdown $markdownService)
    {
        $this->markdownService = $markdownService;
    }

    public function __invoke($text)
    {
        return $this->markdownService->render($text);
    }
}
