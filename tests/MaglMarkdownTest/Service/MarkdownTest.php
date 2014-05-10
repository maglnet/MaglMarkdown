<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace MaglMarkdownTest\Service;

class MarkdownTest extends \PHPUnit_Framework_TestCase
{
    public function testServiceTriggersEvents(){
        
        $markdownAdapter = new \MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter();
        
        $responseCollection = new \Zend\EventManager\ResponseCollection();
        
        $emMock = $this->getMock('\Zend\EventManager\EventManager');
        
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
        
        $responseCollection = new \Zend\EventManager\ResponseCollection();
        $responseCollection->setStopped(true);
        $responseCollection->add(0, $renderedMarkdown);
        
        $emMock = $this->getMock('\Zend\EventManager\EventManager');
        
        $emMock->expects($this->once())
            ->method('trigger')
            ->willReturn($responseCollection)
            ->with('markdown.render.pre');
        
        $service = new \MaglMarkdown\Service\Markdown($markdownAdapter, $emMock);
        
        $output = $service->render('MyText');
        
        $this->assertEquals($output, $renderedMarkdown);
        
    }
}
