<?php

namespace MaglMarkdownTest\Adapter;

/**
 * Description of LeagueCommonMarkAdapterTest
 *
 * @author matthias
 */
class LeagueCommonMarkAdapterTest extends AbstractMarkdownAdapterTest
{

    /**
     * test if LeagueCommonMark adapter is properly setup and working
     */
    public function testLeagueCommonMarkAdapter()
    {
        $markdownAdapter = \MaglMarkdownTest\Bootstrap::getServiceManager()->get('MaglMarkdown\Adapter\LeagueCommonMark');

        $this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdownAdapter);
        $this->assertInstanceOf('\MaglMarkdown\Adapter\LeagueCommonMarkAdapter', $markdownAdapter);

        $this->simpleSyntaxCheck($markdownAdapter);
        $this->extendedSyntaxCheck($markdownAdapter);
    }

}
