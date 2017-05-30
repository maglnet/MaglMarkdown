<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Emanuil Rusev's Parsedown Extra to transform the Markup to HTML
 *
 * @see    http://parsedown.org/
 * @author Matthias Glaub <magl@magl.net>
 */
class ErusevParsedownExtraAdapter implements MarkdownAdapterInterface
{

    /**
     *
     * @var \ParsedownExtra
     */
    private $parser;

    public function __construct(array $options = null)
    {
        $this->parser = new \ParsedownExtra();
        $this->setParserOptions($this->parser, $options);
    }

    public function transformText($text)
    {
        return $this->parser->text($text);
    }

    protected function setParserOptions($parser, $options = null)
    {
        if (is_array($options)) {
            foreach ($options as $key => $value) {
                $function = 'set' . ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
                $parser->$function($value);
            }
        }
    }
}
