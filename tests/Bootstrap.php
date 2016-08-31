<?php

namespace MaglMarkdownTest;

use Composer\Autoload\ClassLoader;
use Zend\Mvc\Application;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{

    protected static $serviceManager;

    public static function init()
    {
        $zf2ModulePaths = array(dirname(dirname(__DIR__)));

        static::initAutoloader();

        // use ModuleManager to load this module and it's dependencies
        $config = array(
            'module_listener_options' => array(
                'module_paths' => $zf2ModulePaths,
            ),
            'modules' => array(
                'MaglMarkdown'
            )
        );

        if (class_exists(\Zend\Router\Module::class)) {
            $config['modules'][] = 'Zend\Router';
        }

        $app = Application::init($config);
        static::$serviceManager = $app->getServiceManager();
    }

    /**
     *
     * @return \Zend\ServiceManager\ServiceManager
     */
    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    protected static function initAutoloader()
    {
        /** @var ClassLoader $loader */
        $loader = require __DIR__ . '/../vendor/autoload.php';
        $loader->add(__NAMESPACE__, __DIR__ . '/' . __NAMESPACE__);
    }

}

Bootstrap::init();
