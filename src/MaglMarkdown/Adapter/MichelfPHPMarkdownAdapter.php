<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Michel Fortin's PHP Markdown to transform the Markup to HTML
 *
 * @see http://michelf.ca/projects/php-markdown/ Michel Fortin's PHP Markdown
 * @author Matthias Glaub <magl@magl.net>
 */
class MichelfPHPMarkdownAdapter extends AbstractMichelfPHPMarkdown implements MarkdownAdapterInterface
{

    /**
     *
     * @var \Michelf\Markdown
     */
    private $parser;

    public function __construct(array $options = null)
    {
        $this->parser = new \Michelf\Markdown();
        $this->setParserOptions($this->parser, $options);
    }

    public function transformText($text)
    {
        return $this->parser->transform($text);
    }
}
