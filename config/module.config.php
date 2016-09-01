<?php

/*
 * @author Matthias Glaub <magl@magl.net>
 */

namespace MaglMarkdown;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'magl_markdown' => [
        // use the configured cache interface
        'cache_enabled' => false,
        
        // configuration options for the adapters
        'adapter_config' => [
            // config for github markdown adapter
            'github_markdown' => [
                // markdown mode, one of 'markdown' or 'gfm'
                'markdown_mode' => 'gfm',

                // api endpoint to use
                'markdown_api_uri' => 'https://api.github.com/markdown',
            ],
            // config for Michel Fortin's markdown adapter
            // all array keys will be passed to the adapter
            // a list of configuration options can be found here: http://michelf.ca/projects/php-markdown/configuration/
            'michelf_markdown' => [],
            // config for Michel Fortin's markdown extra adapter
            // all array keys will be passed to the adapter
            // a list of configuration options can be found here: http://michelf.ca/projects/php-markdown/configuration/
            'michelf_markdown_extra' => [],
        ],
        
        // cache config to store rendered markdown
        'cache' => [
            'adapter' => [
                'name' => 'filesystem',
                'options' => [
                    'ttl' => 3600,
                    'cache_dir' => 'data/cache/'
                ],
            ],
            'plugins' => [
                'exception_handler' => ['throw_exceptions' => true],
            ],
        ],
    ],
    //config for service manager
    'service_manager' => [
        'aliases' => [
            'MaglMarkdown\MarkdownAdapter' => Adapter\MichelfPHPMarkdownExtraAdapter::class,
            'MaglMarkdown\Adapter\LeagueCommonMark' => Adapter\LeagueCommonMarkAdapter::class,
        ],
        'factories' => [
            Adapter\ErusevParsedownAdapter::class => InvokableFactory::class,
            Adapter\ErusevParsedownExtraAdapter::class => InvokableFactory::class,
            Adapter\LeagueCommonMarkAdapter::class => InvokableFactory::class,
            // cache listener to handle caching
            'MaglMarkdown\CacheListener' => Cache\CacheListenerFactory::class,
            // cache to store rendered markdown
            'MaglMarkdown\Cache' => Cache\CacheFactory::class,
            // Markdown Service, to support caching
            'MaglMarkdown\MarkdownService' => Service\MarkdownFactory::class,
            // the github markdown adapter
            'MaglMarkdown\Adapter\GithubMarkdownAdapter' => Adapter\GithubMarkdownAdapterFactory::class,
            // options for the github adapter
            'MaglMarkdown\Adapter\GithubMarkdownOptions' => Adapter\GithubMarkdownOptionsFactory::class,
            // Michel Fortin's Markdown Extra Adapter
            'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter' => Adapter\MichelfPHPMarkdownExtraAdapterFactory::class,
            // Michel Fortin's Markdown Adapter
            'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter' => Adapter\MichelfPHPMarkdownAdapterFactory::class,
        ],
    ],
];
