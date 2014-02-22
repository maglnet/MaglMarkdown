<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Michel Fortin's PHP Markdown to transform the Markup to HTML
 *
 * @see http://michelf.ca/projects/php-markdown/ Michel Fortin's PHP Markdown
 * @author Matthias Glaub <magl@magl.net>
 */
class MichelfPHPMarkdownAdapter implements MarkdownAdapterInterface {

	public function transformText($text) {
		return \Michelf\Markdown::defaultTransform($text);
	}

}
