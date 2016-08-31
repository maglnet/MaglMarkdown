<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 */

namespace MaglMarkdown\Adapter;

abstract class AbstractMichelfPHPMarkdown
{
    /**
     * @param mixed $parser
     * @param array|null $options
     */
    protected function setParserOptions($parser, $options = null)
    {
        if (is_array($options)) {
            foreach ($options as $key => $value) {
                $parser->$key = $value;
            }
        }
    }
}
