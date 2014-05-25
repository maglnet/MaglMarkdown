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
    
    protected function extendedSyntaxCheck(\MaglMarkdown\Adapter\MarkdownAdapterInterface $markdownAdapter)
    {
        
        $testFiles = glob(__DIR__.'/tests/*.md');
        
        foreach($testFiles as $filename){
            
            $markdownString = file_get_contents($filename);
            
            $renderedMarkdown = $markdownAdapter->transformText($markdownString);
            
            // we'll slightly modify the rendered output to be more compatible
            // like removing blank lines
            $renderedMarkdown = trim($renderedMarkdown);
            $renderedMarkdown = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $renderedMarkdown);
            
            echo $renderedMarkdown;
            
            $expectedResult = file_get_contents($filename.'.result');
            
            $this->assertEquals($expectedResult, $renderedMarkdown);
            
        }
    }

}
