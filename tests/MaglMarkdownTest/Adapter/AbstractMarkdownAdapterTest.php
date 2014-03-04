<?php

namespace MaglMarkdownTest\Adapter;

/**
 * Description of AbstractMarkdownAdapterTest
 *
 * @author matthias
 */
abstract class AbstractMarkdownAdapterTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * perform simple syntax check to be sure the adapter really transforms markup to html 
	 * @param \MaglMarkdown\Adapter\MarkdownAdapterInterface $markdownAdapter the adapter used for simple syntax check
	 */
	protected function simpleSyntaxCheck(\MaglMarkdown\Adapter\MarkdownAdapterInterface $markdownAdapter)
	{
		// simple paragraph check
		$text = trim($markdownAdapter->transformText('test string'));
		$this->assertEquals('<p>test string</p>', $text);

		// simple em check
		$text = trim($markdownAdapter->transformText('*test string*'));
		$this->assertEquals('<p><em>test string</em></p>', $text);

		// simple bold check
		$text = trim($markdownAdapter->transformText('**test string**'));
		$this->assertEquals('<p><strong>test string</strong></p>', $text);
	}

}
