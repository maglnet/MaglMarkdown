<?php

namespace MaglMarkdown;

/**
 * MaglMarkdown is a ZF2 module to provide a View Helper that is able to
 * transform Markdown to html
 * 
 * @author Matthias Glaub <magl@magl.net>
 */
class Module extends \Zend\Form\View\Helper\AbstractHelper {

	public function getServiceConfig() {
		return array(
			'invokables' => array(
				'MaglMarkdown\Adapter\ErusevParsedownAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownAdapter',
				'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter',
				'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter',
			),
			'aliases' => array(
				'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter'
			),
		);
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
					'Michelf' => __DIR__ . '/vendor/michelf/php-markdown/Michelf',
				),
			),
		);
	}

	public function getViewHelperConfig() {
		return array('invokables' => array('markdown' => 'MaglMarkdown\View\Helper\Markdown'));
	}

}
