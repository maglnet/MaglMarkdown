<?php

/*
 * @author Matthias Glaub <magl@magl.net>
 */

namespace MaglMarkdown;

return array(
    'magl_markdown' => array(
        // use the configured cache interface
        'cache_enabled' => false,
        
        // configuration options for the adapters
        'adapter_config' => array(
            // config for github markdown adapter
            'github_markdown' => array(
                // markdown mode, one of 'markdown' or 'gfm'
                'markdown_mode' => 'gfm',

                // api endpoint to use
                'markdown_api_uri' => 'https://api.github.com/markdown',
            ),
            // config for Michel Fortin's markdown adapter
            // all array keys will be passed to the adapter
            // a list of configuration options can be found here: http://michelf.ca/projects/php-markdown/configuration/
            'michelf_markdown' => array(),
            // config for Michel Fortin's markdown extra adapter
            // all array keys will be passed to the adapter
            // a list of configuration options can be found here: http://michelf.ca/projects/php-markdown/configuration/
            'michelf_markdown_extra' => array(),
        ),
        
        // cache config to store rendered markdown
        'cache' => array(
            'adapter' => array(
                'name' => 'filesystem',
                'options' => array(
                    'ttl' => 3600,
                    'cache_dir' => 'data/cache/'
                ),
            ),
            'plugins' => array(
                'exception_handler' => array('throw_exceptions' => true),
            ),
        ),
    ),
    //config for service manager
    'service_manager' => array(
        'aliases' => array(
            'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter',
            'MaglMarkdown\Adapter\LeagueCommonMark' => 'MaglMarkdown\Adapter\LeagueCommonMarkAdapter',
        ),
        'invokables' => array(
            'MaglMarkdown\Adapter\ErusevParsedownAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownAdapter',
            'MaglMarkdown\Adapter\ErusevParsedownExtraAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownExtraAdapter',
            'MaglMarkdown\Adapter\LeagueCommonMarkAdapter' => 'MaglMarkdown\Adapter\LeagueCommonMarkAdapter',
        ),
        'factories' => array(
            // cache listener to handle caching
            'MaglMarkdown\CacheListener' => 'MaglMarkdown\Cache\CacheListenerFactory',
            // cache to store rendered markdown
            'MaglMarkdown\Cache' => 'MaglMarkdown\Cache\CacheFactory',
            // Markdown Service, to support caching
            'MaglMarkdown\MarkdownService' => 'MaglMarkdown\Service\MarkdownFactory',
            // the github markdown adapter
            'MaglMarkdown\Adapter\GithubMarkdownAdapter' => 'MaglMarkdown\Adapter\GithubMarkdownAdapterFactory',
            // options for the github adapter
            'MaglMarkdown\Adapter\GithubMarkdownOptions' => 'MaglMarkdown\Adapter\GithubMarkdownOptionsFactory',
            // Michel Fortin's Markdown Extra Adapter
            'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapterFactory',
            // Michel Fortin's Markdown Adapter
            'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapterFactory',
        ),
    ),
);
