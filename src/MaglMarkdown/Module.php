<?php

namespace MaglMarkdown;

use MaglMarkdown\Adapter\GithubMarkdownAdapter;
use MaglMarkdown\Adapter\Options\GithubMarkdownOptions;
use MaglMarkdown\View\Helper\Markdown;
use Zend\Http\Client as HttpClient;

/**
 * MaglMarkdown is a ZF2 module to provide a View Helper that is able to
 * transform Markdown to html
 *
 * @author Matthias Glaub <magl@magl.net>
 */
class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'markdown' => function ($sm) {
                    $markdownAdapter = $sm->getServiceLocator()->get('MaglMarkdown\MarkdownAdapter');

                    return new Markdown($markdownAdapter);
                }
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                // the github markdown adapter
                'MaglMarkdown\Adapter\GithubMarkdownAdapter' => function ($sm) {
                    $request = new \Zend\Http\Request();

                    $client = new HttpClient();
                    $client->setAdapter('Zend\Http\Client\Adapter\Curl');

                    $options = $sm->get('MaglMarkdown\Adapter\GithubMarkdownOptions');

                    return new GithubMarkdownAdapter($client, $request, $options);
                },
                // options for the github adapter
                'MaglMarkdown\Adapter\GithubMarkdownOptions' => function ($sm) {
                    $config = $sm->get('Config');

                    return new GithubMarkdownOptions($config['magl_markdown']['adapter_config']['github_markdown']);
                },
            ),
        );
    }
}
