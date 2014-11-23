<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Emanuil Rusev's Parsedown Extra to transform the Markup to HTML
 *
 * @see http://parsedown.org/
 * @author Matthias Glaub <magl@magl.net>
 */
class ErusevParsedownExtraAdapter implements MarkdownAdapterInterface
{

    /**
     *
     * @var \ParsedownExtra
     */
    private $parser;

    public function __construct()
    {
        $this->parser = new \ParsedownExtra();
    }

    public function transformText($text)
    {
        return $this->parser->text($text);
    }
}
