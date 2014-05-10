<?php

return array(
    'magl_markdown' => array(
        // use the configured cache interface
        //'cache_enabled' => true,
        
        // cache config to store rendered markdown
        // comment out the following key and adjust it to your needs
        // the filesystem adapter is configured by default
        /*
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
        */
    ),
    'service_manager' => array(
        'aliases' => array(
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter', // this is the default parser
        )
    )
);
