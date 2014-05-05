<?php

namespace MaglMarkdown;

use MaglMarkdown\Adapter\GithubMarkdownAdapter;
use MaglMarkdown\View\Helper\Markdown;
use Zend\Cache\StorageFactory;
use Zend\Http\Client as HttpClient;
use Zend\Mvc\MvcEvent;
use MaglMarkdown\Cache\CacheListener;

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
        if($config['magl_markdown']['cache_enabled']){
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
            )
        );
    }
}
