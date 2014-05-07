<?php

namespace MaglMarkdown\Adapter;

use MaglMarkdown\Adapter\Options\GithubMarkdownOptions;
use Zend\Http\Client;
use Zend\Http\Request;

/**
 * This is an implementation that uses github's markdown API to render Markdown
 *
 *
 * @see https://developer.github.com/v3/
 * @see https://developer.github.com/v3/markdown/
 * @author Matthias Glaub <magl@magl.net>
 */
class GithubMarkdownAdapter implements MarkdownAdapterInterface
{

    /**
     *
     * @var Client
     */
    private $httpClient;

    /**
     *
     * @var GithubMarkdownOptions
     */
    private $options;

    /**
     *
     * @var Request
     */
    private $request;

    public function __construct(Client $httpClient, Request $request, GithubMarkdownOptions $options)
    {
        $this->httpClient = $httpClient;
        $this->options = $options;
        $this->request = $request;
    }

    public function transformText($text)
    {
        $requestArray = array(
            'text' => $text,
            'mode' => $this->options->getMarkdownMode()
        );

        $this->request->setUri($this->options->getMarkdownApiUri());
        $this->request->setMethod(Request::METHOD_POST);
        $this->request->setContent(json_encode($requestArray));
        if ($this->options->getAccessToken()) {
            $this->request->getHeaders()
                ->addHeaderLine('Authorization', 'token '.$this->options->getAccessToken());
        }

        $response = $this->httpClient->dispatch($this->request);

        $renderedMarkdown = $response->getBody();

        return $renderedMarkdown;
    }

}
