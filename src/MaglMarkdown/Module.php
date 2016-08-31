<?php

namespace MaglMarkdown;

use MaglMarkdown\Cache\CacheListener;
use Zend\ModuleManager\Feature;
use Zend\Mvc\MvcEvent;

/**
 * MaglMarkdown is a ZF2 module to provide a View Helper that is able to
 * transform Markdown to html
 *
 * @author Matthias Glaub <magl@magl.net>
 */
class Module implements
    Feature\AutoloaderProviderInterface,
    Feature\ConfigProviderInterface,
    Feature\ViewHelperProviderInterface
{

    public function onBootstrap(MvcEvent $e)
    {
        // attach the cache listener, if caching is enabled
        $sm = $e->getApplication()->getServiceManager();
        $config = $sm->get('config');
        if ($config['magl_markdown']['cache_enabled']) {
            $em = $e->getApplication()->getEventManager();
            /** @var CacheListener $listener */
            $listener = $sm->get('MaglMarkdown\CacheListener');
            $listener->attach($em);
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'markdown' => View\Helper\MarkdownFactory::class,
            ],
        ];
    }
}
