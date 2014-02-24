<?php

namespace MaglMarkdownTest;

use RuntimeException;
use Zend\Loader\AutoloaderFactory;
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
		if (($path = static::findParentPath('vendor'))) {
			$zf2ModulePaths[] = $path;
		}
		if (($path = static::findParentPath('module')) !== $zf2ModulePaths[0] && $path) {
			$zf2ModulePaths[] = $path;
		}

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
		$vendorPath = static::findParentPath('vendor');

		// Composer autoloading
		if (file_exists($vendorPath . '/autoload.php')) {
			include $vendorPath . '/autoload.php';
		} else {
			throw new RuntimeException('Unable to find composer autoloader. Run `php composer.phar install`.'); 
		}

		AutoloaderFactory::factory(array(
			'Zend\Loader\StandardAutoloader' => array(
				'autoregister_zf' => true,
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
				),
			),
		));
	}

	protected static function findParentPath($path)
	{
		$dir = __DIR__;
		$previousDir = '.';
		while (!is_dir($dir . '/' . $path)) {
			$dir = dirname($dir);
			if ($previousDir === $dir) {
				return false;
			}
			$previousDir = $dir;
		}
		return $dir . '/' . $path;
	}

}

Bootstrap::init();
