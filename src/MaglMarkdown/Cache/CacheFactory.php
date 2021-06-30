<?php

namespace MaglMarkdown\Cache;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\Cache\Storage\StorageInterface;
use Laminas\Cache\StorageFactory;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

/**
 * Class CacheFactory
 *
 * @package MaglMarkdown\Cache
 */
class CacheFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return StorageInterface
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
     * @return StorageInterface
     * @throws \Laminas\Cache\Exception\InvalidArgumentException
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
     * @return StorageInterface
     */
    protected function create($container)
    {
        if (!$container instanceof ServiceLocatorInterface && !$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException('Invalid container to create service');
        }

        $config = $container->get('config');

        return StorageFactory::factory($config['magl_markdown']['cache']);
    }
}
