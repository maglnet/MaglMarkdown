<?php

namespace MaglMarkdown\Adapter;

use League\CommonMark\CommonMarkConverter;

/**
 * This is an implementation that uses Emanuil Rusev's Parsedown to transform the Markup to HTML
 *
 * @see https://github.com/thephpleague/commonmark
 * @author Matthias Glaub <magl@magl.net>
 */
class LeagueCommonMarkAdapter implements MarkdownAdapterInterface
{

    /**
     *
     * @var CommonMarkConverter
     */
    private $parser;

    public function __construct()
    {
        $this->parser = new CommonMarkConverter();
    }

    public function transformText($text)
    {
        return $this->parser->convertToHtml($text);
    }
}
