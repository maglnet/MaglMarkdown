<?php

namespace MaglMarkdown\View\Helper;

/**
 * This is a ZF2 View Helper to provide Markdown transformation
 *
 * @author Matthias Glaub <magl@magl.net>
 */
class Markdown extends \Zend\View\Helper\AbstractHelper implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

	/**
	 *
	 * @var \Zend\ServiceManager\ServiceLocatorInterface
	 */
	private $serviceLocator = null;

	/**
	 *
	 * @var \MaglMarkdown\Adapter\MarkdownAdapterInterface
	 */
	private $markdownAdapter = null;

	public function __invoke($text) {
		return $this->getMarkdownAdapter()->transformText($text);
	}

	/**
	 * 
	 * @return \MaglMarkdown\Adapter\MarkdownAdapterInterface
	 */
	private function getMarkdownAdapter() {
		if (null === $this->markdownAdapter) {
			$this->markdownAdapter = $this->getServiceLocator()->getServiceLocator()->get('MaglMarkdown\MarkdownAdapter');
			if (!$this->markdownAdapter instanceof \MaglMarkdown\Adapter\MarkdownAdapterInterface) {
				throw new \Exception(get_class($this->markdownAdapter) . ' is not an instance of \MaglMarkdown\Adapter\MarkdownAdapterInterface.' . PHP_EOL . 'You need to impement this interface to provide a valid MarkdownAdapter');
			}
		}
		return $this->markdownAdapter;
	}

	public function getServiceLocator() {
		return $this->serviceLocator;
	}

	public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	}

}
