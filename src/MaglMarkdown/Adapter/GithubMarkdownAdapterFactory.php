<?php

namespace MaglMarkdown\Adapter;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Http\Client as HttpClient;
use Zend\Http\Request;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class GithubMarkdownAdapterFactory
 *
 * @package MaglMarkdown\Adapter
 */
class GithubMarkdownAdapterFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return GithubMarkdownAdapter
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
     * @return GithubMarkdownAdapter
     * @throws \Interop\Container\Exception\NotFoundException
     * @throws \Zend\Http\Client\Exception\InvalidArgumentException
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
     * @return GithubMarkdownAdapter
     */
    protected function create($container)
    {
        if (!$container instanceof ServiceLocatorInterface && !$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException('Invalid container to create service');
        }

        $request = new Request();

        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');

        $options = $container->get('MaglMarkdown\Adapter\GithubMarkdownOptions');

        return new GithubMarkdownAdapter($client, $request, $options);
    }
}
