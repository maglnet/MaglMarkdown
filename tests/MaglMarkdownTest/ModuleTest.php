<?php

namespace MaglMarkdownTest;

use MaglMarkdown\Module;
use Zend\View\HelperPluginManager;

/**
 * Description of ModuleTest
 *
 * @author matthias
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{

	/**
	 *
	 * @var Module
	 */
	private $instance;

	public function setUp()
	{
		$this->instance = new Module();
	}

	public function testInstance()
	{
		$this->assertInstanceOf('MaglMarkdown\Module', $this->instance);
	}

	public function testGetViewHelperConfig()
	{
		$config = $this->instance->getViewHelperConfig();

		$this->assertTrue(array_key_exists('markdown', $config['invokables']));
	}

	public function testGetAutoloaderConfig()
	{
		$config = $this->instance->getAutoloaderConfig();

		$this->assertTrue(array_key_exists('MaglMarkdown', $config['Zend\Loader\StandardAutoloader']['namespaces']));
	}

	public function testGetServiceConfig()
	{
		$config = $this->instance->getServiceConfig();

		$this->assertTrue(array_key_exists('MaglMarkdown\Adapter\ErusevParsedownAdapter', $config['invokables']));
		$this->assertTrue(array_key_exists('MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter', $config['invokables']));
		$this->assertTrue(array_key_exists('MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter', $config['invokables']));

		$this->assertTrue(array_key_exists('MaglMarkdown\MarkdownAdapter', $config['aliases']));
	}

	public function testGetDefaultAdapter()
	{
		$markdown = Bootstrap::getServiceManager()->get('MaglMarkdown\MarkdownAdapter');

		$this->assertInstanceOf('\MaglMarkdown\Adapter\MarkdownAdapterInterface', $markdown);
		$this->assertInstanceOf('\MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter', $markdown);
	}

	public function testGetViewHelper()
	{
		$serviceManager = Bootstrap::getServiceManager();

		/* @var $view HelperPluginManager */
		$view = $serviceManager->get('ViewHelperManager');

		$markdown = $view->get('markdown');
		$this->assertInstanceOf('MaglMarkdown\View\Helper\Markdown', $markdown);
		$this->assertInstanceOf('Zend\View\Helper\HelperInterface', $markdown);
	}

}
