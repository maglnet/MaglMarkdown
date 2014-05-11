<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Michel Fortin's PHP Markdown Extra to transform the Markup to HTML
 *
 * @see http://michelf.ca/projects/php-markdown/extra/ Michel Fortin's PHP Markdown Extra
 * @author Matthias Glaub <magl@magl.net>
 */
class MichelfPHPMarkdownExtraAdapter extends AbstractMichelfPHPMarkdown implements MarkdownAdapterInterface
{

    /**
     *
     * @var \Michelf\MarkdownExtra
     */
    private $parser;

    public function __construct(array $options = null)
    {
        $this->parser = new \Michelf\MarkdownExtra();
        $this->setParserOptions($this->parser, $options);
    }

    public function transformText($text)
    {
        return $this->parser->transform($text);
    }
}
