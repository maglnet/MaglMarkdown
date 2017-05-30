<?php

return array(
    'magl_markdown' => array(
        // use the configured cache interface to cache the rendered markdown
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
        // configuration options for the adapters
        'adapter_config' => array(
            'github_markdown' => array(
                // the access token to authenticate to the github api
                // you can get one for you account at the settings -> applications page
                // https://github.com/settings/applications
                'access_token' => '',
                
                // markdown mode, one of 'markdown' or 'gfm' (default: 'gfm')
                //'markdown_mode' => 'gfm',
            ),
            // config for Michel Fortin's markdown adapter
            // all array keys will be passed to the adapter
            // a list of configuration options can be found here: http://michelf.ca/projects/php-markdown/configuration/
            'michelf_markdown' => array(
                //'empty_element_suffix' => ' />',
            ),
            // config for Michel Fortin's markdown extra adapter
            // all array keys will be passed to the adapter
            // a list of configuration options can be found here: http://michelf.ca/projects/php-markdown/configuration/
            'michelf_markdown_extra' => array(
                //'empty_element_suffix' => ' />',
            ),
            // config for erusev parsedown adapter
            // all array keys will be passed to the adapter
            // a list of configuration options can be found here: https://github.com/erusev/parsedown/wiki/Tutorial:-Get-Started
            'erusev_parsedown' => array(
                //'breaks_enabled' => true,
                //'markup_escaped' => true,
            ),
            // config for erusev parsedown extra adapter
            // all array keys will be passed to the adapter
            // a list of configuration options can be found here: https://github.com/erusev/parsedown/wiki/Tutorial:-Get-Started
            'erusev_parsedown_extra' => array(
                //'breaks_enabled' => true,
                //'markup_escaped' => true,
            ),
        ),
    ),
    // here you can switch the used markdown adapter
    // enable ONE of the parsers to override the default
    // if you need more informations about a parser check the README.md, you'll
    // find links to detailed descriptions about the parsers
    'service_manager' => array(
        'aliases' => array(
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownExtraAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter', // default parser
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\GithubMarkdownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\LeagueCommonMark',
        )
    )
);
