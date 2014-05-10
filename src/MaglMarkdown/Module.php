<?php

namespace MaglMarkdown;

use MaglMarkdown\Adapter\GithubMarkdownAdapter;
use MaglMarkdown\Adapter\Options\GithubMarkdownOptions;
use MaglMarkdown\Cache\CacheListener;
use MaglMarkdown\Service\Markdown as MarkdownService;
use MaglMarkdown\View\Helper\Markdown;
use Zend\Cache\StorageFactory;
use Zend\Http\Client as HttpClient;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;

/**
 * MaglMarkdown is a ZF2 module to provide a View Helper that is able to
 * transform Markdown to html
 *
 * @author Matthias Glaub <magl@magl.net>
 */
class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        // attach the cache listener, if caching is enabled
        $sm = $e->getApplication()->getServiceManager();
        $config = $sm->get('Config');
        if ($config['magl_markdown']['cache_enabled']) {
            $em = $e->getApplication()->getEventManager();
            $em->attachAggregate($sm->get('MaglMarkdown\CacheListener'));
        }
    }

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
                    $markdownService = $sm->getServiceLocator()
                        ->get('MaglMarkdown\MarkdownService');

                    return new Markdown($markdownService);
                }
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                // cache listener to handle caching
                'MaglMarkdown\CacheListener' => function ($sm) {
                    return new CacheListener($sm->get('MaglMarkdown\Cache'));
                },
                // cache to store rendered markdown
                'MaglMarkdown\Cache' => function ($sm) {
                    $config = $sm->get('Config');
                    $cache = StorageFactory::factory($config['magl_markdown']['cache']);

                    return $cache;
                },
                // Markdown Service, to support caching
                'MaglMarkdown\MarkdownService' => function ($sm) {
                    $em = null;
                    $markdownAdapter = $sm->get('MaglMarkdown\MarkdownAdapter');

                    // get / inject eventmanager only if cache is enabled
                    $config = $sm->get('Config');
                    $cacheEnabled = $config['magl_markdown']['cache_enabled'];
                    if ($cacheEnabled) {
                        $em = $sm->get('Application')->getEventManager();
                    }

                    $markdownService = new MarkdownService($markdownAdapter, $em);
                    return $markdownService;
                },
                // the github markdown adapter
                'MaglMarkdown\Adapter\GithubMarkdownAdapter' => function ($sm) {
                    $request = new Request();

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
