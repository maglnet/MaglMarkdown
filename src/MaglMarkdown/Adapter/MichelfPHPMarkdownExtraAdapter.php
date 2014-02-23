<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Michel Fortin's PHP Markdown Extra to transform the Markup to HTML
 *
 * @see http://michelf.ca/projects/php-markdown/extra/ Michel Fortin's PHP Markdown Extra
 * @author Matthias Glaub <magl@magl.net>
 */
class MichelfPHPMarkdownExtraAdapter implements MarkdownAdapterInterface
{

	public function transformText($text)
	{
		return \Michelf\MarkdownExtra::defaultTransform($text);
	}

}
