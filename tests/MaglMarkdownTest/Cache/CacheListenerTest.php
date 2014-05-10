<?php

/**
 * @author Matthias Glaub <magl@magl.net>
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace MaglMarkdownTest\Cache;

class CacheListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testAttachDetachListeners(){
        
        $emMock = $this->getMock('\Zend\EventManager\EventManager');
        
        $emMock->expects($this->exactly(2))
            ->method('attach')
            ->withConsecutive(
                array('markdown.render.pre'),
                array('markdown.render.post')
            );
           
        $emMock->expects($this->exactly(2))
            ->method('detach')
            ->willReturn(true);
           
        $cache = new \Zend\Cache\Storage\Adapter\Memory();
        
        $cacheListener = new \MaglMarkdown\Cache\CacheListener($cache);
        
        $cacheListener->attach($emMock);
        $cacheListener->detach($emMock);
    }

    public function testSettingGettingValues(){
        $cache = new \Zend\Cache\Storage\Adapter\Memory();
        
        $cacheListener = new \MaglMarkdown\Cache\CacheListener($cache);
        
        $myMarkdown = "This is a test";
        $myRenderedMarkdown = "This is a test (pseudo rendered markdown)";
        
        $event = new \Zend\EventManager\Event();
        $event->setParam('markdown', $myMarkdown);
        $event->setParam('renderedMarkdown', $myRenderedMarkdown);
        
        // test return null, if no entry in cache
        $this->assertFalse($cacheListener->preRender($event));
        
        // test insert entry
        $this->assertTrue($cacheListener->postRender($event));
        
        //test returning the rendered markdown after setting it
        $this->assertEquals($myRenderedMarkdown, $cacheListener->preRender($event));

        // test return null, if no entry in cache
        $event->setParam('markdown', 'must not be found');
        $this->assertFalse($cacheListener->preRender($event));

    }
}
