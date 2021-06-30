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

        $mockHeaders = $this->getMockBuilder('\Laminas\Http\Headers')->getMock();
        $mockHeaders->expects($this->once())
            ->method('addHeaderLine')
            ->with('Authorization', 'token '.$accessToken);

        $mockResponse = $this->getMockBuilder('\Laminas\Http\Response')->getMock();
        $mockResponse->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($textOutput));

        $mockClient = $this->getMockBuilder('\Laminas\Http\Client')->getMock();
        $mockClient->expects($this->once())
            ->method('send')
            ->will($this->returnValue($mockResponse));

        $mockRequest = $this->getMockBuilder('\Laminas\Http\Request')->getMock();
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
