<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace MaglMarkdownTest\Service;

class MarkdownTest extends \PHPUnit\Framework\TestCase
{
    public function testServiceTriggersEvents(){
        
        $markdownAdapter = new \MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter();
        
        $responseCollection = new \Laminas\EventManager\ResponseCollection();
        
        $emMock = $this->getMockBuilder('\Laminas\EventManager\EventManager')->getMock();
        
        $emMock->expects($this->exactly(2))
            ->method('trigger')
            ->willReturn($responseCollection)
            ->withConsecutive(
                array('markdown.render.pre'),
                array('markdown.render.post')
            );
           
       
        
        $service = new \MaglMarkdown\Service\Markdown($markdownAdapter, $emMock);
        
        $service->render('MyText');
        
        
    }
    
    
    public function testServiceReturnsValue(){
        
        $renderedMarkdown = 'the rendered Markdown';
        
        $markdownAdapter = new \MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter();
        
        $responseCollection = new \Laminas\EventManager\ResponseCollection();
        $responseCollection->setStopped(true);
        $responseCollection->push($renderedMarkdown);
        
        $emMock = $this->getMockBuilder('\Laminas\EventManager\EventManager')->getMock();
        
        $emMock->expects($this->once())
            ->method('trigger')
            ->willReturn($responseCollection)
            ->with('markdown.render.pre');
        
        $service = new \MaglMarkdown\Service\Markdown($markdownAdapter, $emMock);
        
        $output = $service->render('MyText');
        
        $this->assertEquals($output, $renderedMarkdown);
        
    }
}
