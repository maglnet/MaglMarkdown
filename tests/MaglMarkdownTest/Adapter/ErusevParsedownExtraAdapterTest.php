<?php

namespace MaglMarkdownTest\Adapter;

/**
 * Description of ErusevParsedownAdapterTest
 *
 * @author matthias
 */
class ErusevParsedownExtraAdapterTest extends AbstractMarkdownAdapterTest
{

    /**
     * test if ErusevParsedown adapter is properly setup and working
     */
    public function testErusevParsedownExtraAdapter()
    {
        $markdownAdapter = \MaglMarkdownTest\Bootstrap::getServiceManager()->get('MaglMarkdown\Adapter\ErusevParsedownExtraAdapter');

        $this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdownAdapter);
        $this->assertInstanceOf('\MaglMarkdown\Adapter\ErusevParsedownExtraAdapter', $markdownAdapter);

        $this->simpleSyntaxCheck($markdownAdapter);
        $this->extendedSyntaxCheck($markdownAdapter);
    }

}
