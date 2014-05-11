<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Michel Fortin's PHP Markdown to transform the Markup to HTML
 *
 * @see http://michelf.ca/projects/php-markdown/ Michel Fortin's PHP Markdown
 * @author Matthias Glaub <magl@magl.net>
 */
class MichelfPHPMarkdownAdapter implements MarkdownAdapterInterface
{

    /**
     *
     * @var \Michelf\Markdown
     */
    private $parser;

    public function __construct(array $options = null)
    {
        $this->parser = new \Michelf\Markdown();
        // set the parsers options
        if($options){
            foreach ($options as $key => $value) {
                $this->parser->$key = $value;
            }
        }
    }

    public function transformText($text)
    {
        return $this->parser->transform($text);
    }
}
