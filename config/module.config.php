<?php

/*
 * @author Matthias Glaub <magl@magl.net>
 */

return array(
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
    'view_helpers' => array(
        'invokables' => array(
            'markdown' => 'MaglMarkdown\View\Helper\Markdown'
        ),
    ),
);
