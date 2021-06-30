<?php

namespace MaglMarkdown\View\Helper;

use Laminas\View\Helper\AbstractHelper;

/**
 * This is a ZF2 View Helper to provide Markdown transformation
 *
 * @author Matthias Glaub <magl@magl.net>
 */
class Markdown extends AbstractHelper
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
