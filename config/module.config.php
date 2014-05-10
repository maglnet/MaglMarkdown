<?php

/*
 * @author Matthias Glaub <magl@magl.net>
 */

return array(
    'magl_markdown' => array(
        // configuration options for the adapters
        'adapter_config' => array(
            // config for github markdown adapter
            'github_markdown' => array(
                // markdown mode, one of 'markdown' or 'gfm'
                'markdown_mode' => 'gfm',

                // api endpoint to use
                'markdown_api_uri' => 'https://api.github.com/markdown',
            )
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
