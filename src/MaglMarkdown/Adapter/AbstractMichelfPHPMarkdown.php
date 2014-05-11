<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 */

namespace MaglMarkdown\Adapter;

abstract class AbstractMichelfPHPMarkdown
{

    protected function setParserOptions($parser, $options = null)
    {
        if ($options) {
            foreach ($options as $key => $value) {
                $parser->$key = $value;
            }
        }
    }
}
