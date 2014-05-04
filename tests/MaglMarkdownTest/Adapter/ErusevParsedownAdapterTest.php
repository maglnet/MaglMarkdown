<?php

namespace MaglMarkdownTest\Adapter;

/**
 * Description of ErusevParsedownAdapterTest
 *
 * @author matthias
 */
class ErusevParsedownAdapterTest extends AbstractMarkdownAdapterTest
{

    /**
     * test if ErusevParsedown adapter is properly setup and working
     */
    public function testErusevParsedownAdapter()
    {
        $markdownAdapter = \MaglMarkdownTest\Bootstrap::getServiceManager()->get('MaglMarkdown\Adapter\ErusevParsedownAdapter');

        $this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdownAdapter);
        $this->assertInstanceOf('\MaglMarkdown\Adapter\ErusevParsedownAdapter', $markdownAdapter);

        $this->simpleSyntaxCheck($markdownAdapter);
    }

}
