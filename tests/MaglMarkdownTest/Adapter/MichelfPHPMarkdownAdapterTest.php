<?php

namespace MaglMarkdownTest\Adapter;

/**
 * Description of MichelfPHPMarkdownAdapterTest
 *
 * @author matthias
 */
class MichelfPHPMarkdownAdapterTest extends AbstractMarkdownAdapterTest
{

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

}
