<?php

/*
 * @author Matthias Glaub <magl@magl.net>
 */

return array(
    'magl_markdown' => array(
        // use the configured cache interface
        'cache_enabled' => false,
        
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
        'invokables' => array(
            'MaglMarkdown\Adapter\ErusevParsedownAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownAdapter',
            'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter',
            'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter',
        ),
        'aliases' => array(
            'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter'
        ),
    ),
);
