<?php

namespace MaglMarkdown\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MarkdownFactory
 *
 * @package MaglMarkdown\Service
 */
class MarkdownFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Markdown
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this->create($serviceLocator);
    }

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return Markdown
     * @throws \Interop\Container\Exception\NotFoundException
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->create($container);
    }

    /**
     * @param ServiceLocatorInterface|ContainerInterface $container
     * @return Markdown
     */
    protected function create($container)
    {
        if (!$container instanceof ServiceLocatorInterface && !$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException('Invalid container to create service');
        }

        $em = null;
        $markdownAdapter = $container->get('MaglMarkdown\MarkdownAdapter');

        // get / inject eventmanager only if cache is enabled
        $config = $container->get('config');
        $cacheEnabled = $config['magl_markdown']['cache_enabled'];
        if ($cacheEnabled) {
            $em = $container->get('application')->getEventManager();
        }

        return new Markdown($markdownAdapter, $em);
    }
}
