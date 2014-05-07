<?php

return array(
    'magl_markdown' => array(
        'adapter_config' => array(
            'github_markdown' => array(
                // the access token to authenticate to the api
                // you can get one for you account at the settings -> applications page
                // https://github.com/settings/applications
                'access_token' => '',

            )
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\ErusevParsedownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter',
            //'MaglMarkdown\MarkdownAdapter' => 'MaglMarkdown\Adapter\MichelfPHPMarkdownExtraAdapter', // this is the default parser
        )
    )
);
