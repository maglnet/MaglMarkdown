<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Emanuil Rusev's Parsedown to transform the Markup to HTML
 *
 * @see http://parsedown.org/
 * @author Matthias Glaub <magl@magl.net>
 */
class ErusevParsedownAdapter implements MarkdownAdapterInterface
{

    /**
     *
     * @var \Parsedown
     */
    private $parser;

    public function __construct()
    {
        $this->parser = new \Parsedown();
    }

    public function transformText($text)
    {
        return $this->parser->text($text);
    }
}
