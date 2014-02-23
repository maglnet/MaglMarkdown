<?php

namespace MaglMarkdownTest\ViewHelper;

/**
 * Simple tests for the provided ViewHelpers
 * 
 * @author Matthias Glaub <magl@magl.net>
 */
class ViewHelperTest extends \Zend\Test\PHPUnit\Controller\AbstractControllerTestCase
{

	/**
	 * testing the default adapter is set to PHPMarkodnExtra by Michel Fortin
	 */
	public function testDefaultAdapterConfiguration()
	{
		$markdown = \MaglMarkdownTest\Bootstrap::getServiceManager()->get('MaglMarkdown\MarkdownAdapter');

		$this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdown);
		$this->assertInstanceOf('\MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter', $markdown);
	}

	/**
	 * test if MichelfPHPMarkdown adapter is properly setup and working
	 */
	public function testParserMichelfPHPMarkdown()
	{
		$markdownAdapter = \MaglMarkdownTest\Bootstrap::getServiceManager()->get('MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter');

		$this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdownAdapter);
		$this->assertInstanceOf('\MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter', $markdownAdapter);

		$this->simpleSyntaxCheck($markdownAdapter);
	}

	/**
	 * test if MichelfPHPMarkdownExtra adapter is properly setup and working
	 */
	public function testParserMichelfPHPMarkdownExtra()
	{
		$markdownAdapter = \MaglMarkdownTest\Bootstrap::getServiceManager()->get('MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter');

		$this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdownAdapter);
		$this->assertInstanceOf('\MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter', $markdownAdapter);

		$this->simpleSyntaxCheck($markdownAdapter);
	}

	/**
	 * test if ErusevParsedown adapter is properly setup and working
	 */
	public function testParserErusevParsedown()
	{
		$markdownAdapter = \MaglMarkdownTest\Bootstrap::getServiceManager()->get('MaglMarkdown\Adapter\ErusevParsedownAdapter');

		$this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdownAdapter);
		$this->assertInstanceOf('\MaglMarkdown\Adapter\ErusevParsedownAdapter', $markdownAdapter);

		$this->simpleSyntaxCheck($markdownAdapter);
	}

	/**
	 * perform simple syntax check to be sure the adapter really transforms markup to html 
	 * @param \MaglMarkdown\Adapter\MarkdownAdapterInterface $markdownAdapter the adapter used for simple syntax check
	 */
	private function simpleSyntaxCheck(\MaglMarkdown\Adapter\MarkdownAdapterInterface $markdownAdapter)
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
