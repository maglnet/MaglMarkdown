<?php

namespace MaglMarkdownTest\Adapter;

/**
 * Description of GithubMarkdownAdapterTest
 *
 * @author matthias
 */
class GithubMarkdownAdapterTest extends AbstractMarkdownAdapterTest
{

    public function testGetGithubMarkdownAdapter()
    {
        $markdownAdapter = \MaglMarkdownTest\Bootstrap::getServiceManager()->get('MaglMarkdown\Adapter\GithubMarkdownAdapter');

        $this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdownAdapter);
        $this->assertInstanceOf('\MaglMarkdown\Adapter\GithubMarkdownAdapter', $markdownAdapter);

    }

    /**
     * test if GithubMarkdown adapter is properly setup and working
     */
    public function testGithubMarkdownAdapterWithAuthorization()
    {
        $textInput = 'myInputText';
        $textOutput = 'myOutputText';
        $accessToken = "myAccessToken";

        $mockHeaders = $this->getMock('\Zend\Http\Headers');
        $mockHeaders->expects($this->once())
            ->method('addHeaderLine')
            ->with('Authorization', 'token '.$accessToken);

        $mockResponse = $this->getMock('\Zend\Http\Response');
        $mockResponse->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($textOutput));

        $mockClient = $this->getMock('\Zend\Http\Client');
        $mockClient->expects($this->once())
            ->method('dispatch')
            ->will($this->returnValue($mockResponse));

        $mockRequest = $this->getMock('\Zend\Http\Request');
        $mockRequest->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue($mockHeaders));

        $options = new \MaglMarkdown\Adapter\Options\GithubMarkdownOptions();
        $options->setAccessToken($accessToken);

        $markdownAdapter = new \MaglMarkdown\Adapter\GithubMarkdownAdapter($mockClient, $mockRequest, $options);

        $this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdownAdapter);
        $this->assertInstanceOf('\MaglMarkdown\Adapter\GithubMarkdownAdapter', $markdownAdapter);

        //simple test, if the adapter returns the value
        $this->assertEquals($textOutput, $markdownAdapter->transformText($textInput));

    }

}
