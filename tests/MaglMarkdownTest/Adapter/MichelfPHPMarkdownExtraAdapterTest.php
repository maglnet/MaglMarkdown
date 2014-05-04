<?php

namespace MaglMarkdownTest\Adapter;

/**
 * Description of MichelfPHPMarkdownExtraAdapterTest
 *
 * @author matthias
 */
class MichelfPHPMarkdownExtraAdapterTest extends AbstractMarkdownAdapterTest
{

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

}
