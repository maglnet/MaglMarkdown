<?php

namespace MaglMarkdown\Adapter;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

/**
 * Class ErusevParsedownAdapterFactory
 *
 * @package MaglMarkdown\Adapter
 */
class ErusevParsedownExtraAdapterFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
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
     * @return ErusevParsedownExtraAdapter
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
     * @return ErusevParsedownExtraAdapter
     */
    protected function create($container)
    {
        if (!$container instanceof ServiceLocatorInterface && !$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException('Invalid container to create service');
        }

        $config = $container->get('config');

        return new ErusevParsedownExtraAdapter($config['magl_markdown']['adapter_config']['erusev_parsedown_extra']);
    }
}
