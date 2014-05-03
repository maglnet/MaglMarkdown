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

	public function transformText($text)
	{
		$parsedown = new \Parsedown();

		return $parsedown->parse($text);
	}

}
