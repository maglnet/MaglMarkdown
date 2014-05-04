<?php

namespace MaglMarkdown\Adapter;

/**
 * The MarkdownAdapterInterface needs to be implemented by all adapters
 * that should be used by this module
 *
 * @author Matthias Glaub <magl@magl.net>
 */
interface MarkdownAdapterInterface
{

    public function transformText($text);
}
