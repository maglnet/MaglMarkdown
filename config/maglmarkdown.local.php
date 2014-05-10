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
        'adapter_config' => array(
            'github_markdown' => array(
                // the access token to authenticate to the api
                // you can get one for you account at the settings -> applications page
                // https://github.com/settings/applications
                'access_token' => '',
                
                // markdown mode, one of 'markdown' or 'gfm' (default: 'gfm')
                //'markdown_mode' => 'gfm',
            )
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter', // this is the default parser
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\GithubMarkdownAdapter',
        )
    )
);
