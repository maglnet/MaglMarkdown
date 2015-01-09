# MaglMarkdown - ZF2 View Helper For Markdown

[![Latest Stable Version](https://poser.pugx.org/maglnet/magl-markdown/v/stable.svg)](https://packagist.org/packages/maglnet/magl-markdown)
[![Latest Unstable Version](https://poser.pugx.org/maglnet/magl-markdown/v/unstable.svg)](https://packagist.org/packages/maglnet/magl-markdown)
[![License](https://poser.pugx.org/maglnet/magl-markdown/license.svg)](https://packagist.org/packages/maglnet/magl-markdown)
[![Dependency Status](https://www.versioneye.com/user/projects/53106961ec13758b7e0000c0/badge.svg)](https://www.versioneye.com/user/projects/53106961ec13758b7e0000c0)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maglnet/MaglMarkdown/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maglnet/MaglMarkdown/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/maglnet/MaglMarkdown/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/maglnet/MaglMarkdown/?branch=master)


dev-master: [![Build Status](https://travis-ci.org/maglnet/MaglMarkdown.svg?branch=master)](https://travis-ci.org/maglnet/MaglMarkdown)

MaglMarkdown is developed by Matthias Glaub

## Introduction

MaglMarkdown is a ZF2 module that adds a View Helper to transform [Markdown](http://daringfireball.net/projects/markdown/).
To change between different renderers have a look at the [config section](#configuration)

You can use one of the following parsers for your Markdown:  
* The [PHP-Markdown](http://michelf.com/projects/php-markdown/) parser from Michel Fortin
* The [PHP-MarkdownExtra](http://michelf.ca/projects/php-markdown/extra/) parser from Michel Fortin (this is the default)
* The [Parsedown](http://parsedown.org/) parser from Emanuil Rusev
* The [Parsedown-Extra](http://parsedown.org/) parser from Emanuil Rusev
* [Github Markdown Api](https://guides.github.com/features/mastering-markdown/)
  * you should provide an access_token within the config, to avoid hitting the [rate_limit](https://developer.github.com/v3/rate_limit/) too soon
  * it's highly recommended to enable caching if you use the Github Api because of the mentioned rate_limit and to boost performance
* The [PHP League's CommonMark](http://parsedown.org/) https://github.com/thephpleague/commonmark

## Installation

You can install the module with composer by adding the following "require" to your `composer.json`

```json
{
	"require": {
		"maglnet/magl-markdown": "~1.1"
	}
}
```

after that you need to run
```bash
$ php composer.phar update
```

and enable the module within your `application.config.php`
```php
array(
	'modules' => array(
		'Application',
		'MaglMarkdown',
	),
);
```


## Usage

### View Helper
Simply use it within your Views like this

```php
$this->markdown('Yes, **this** is *Markdown*!');
```

### Service Manager
You can get the MarkdownService through the Service Manager, to use
the `render()` method wherever you like within you zf2 application.
`MarkdownService` automatically uses caching if it has been enabled within the
config.

```php
/* @var $markdownService MaglMarkdown\Service\Markdown */
$markdownService = $serviceManager->get('MaglMarkdown\MarkdownService');
$html = $markdownService->render('Yes, **this** is *Markdown*!');
```

You can also get a MarkdownAdapter through the Service Manager and use
`transformText()` to get your Markdown rendered to HTML.  
This is **NOT** recommended anymore. Use the above mentioned `MarkdownService` instead
because it can use the provided caching mechanism.

```php
/* @var $markdownAdapter MaglMarkdown\Adapter\MarkdownAdapterInterface */
$markdownAdapter = $serviceManager->get('MaglMarkdown\MarkdownAdapter');
$html = $markdownAdapter->transformText('Yes, **this** is *Markdown*!');
```


*Security warning:*  
You should be aware, that your markdown could contain insecure content (e.g. user generated content). 
So use something like HTMLPurifier to sanitize your output.

## Configuration
Copy the provided config file `config/maglmarkdown.local.php` to your
autoloading directory `YourZF2Application/config/autoload/maglmarkdown.local.php` and adjust it to your needs.    
By default [PHP-MarkdownExtra](http://michelf.ca/projects/php-markdown/extra/) parser by Michel Fortin is used.  

### Cache
By default, caching is disabled.
Set `cache_enabled` to `true` within `config/maglmarkdown.local.php` to enable the caching.
Caching could be very helpful if you have large markdown files/texts or if you're using an Adapter
that relies on third-party APIs that either are rate limited or take a long time to render.

A simple filesystem cache is configured by default, but feel free to configure your own adapter.

### Adding own parsers

It is possible to add your own parser implementation.  
All you have to do, is to write a class that implements the `MaglMarkdown\Adapter\MarkdownAdapterInterface` interface
and make it available through the service manager.  
After that override the alias `MaglMarkdown\MarkdownAdapter`to point to your custom adapter.  
MaglMarkdown will then use this class to transform the Markdown.

```php
array(
	'aliases' => array(
		'MaglMarkdown\MarkdownAdapter' => 'Your\Own\MarkdownAdapter', //needs to implement MaglMarkdown\Adapter\MarkdownAdapterInterface
	),
)
```

## Events

The markdown service triggers two events you can listen to:
* `markdown.render.pre` before rendering (with the markdown text as parameter)
* `markdown.render.post` after rendering (with the rendered markdown as parameter)

These events are currently used for the integrated caching feature only,
but do whatever you like with these events.

## License

MaglMarkdown is licensed under the MIT license.  
See the included LICENSE file.

Based on PHP Markdown Lib  
Copyright (c) 2004-2013 Michel Fortin  
http://michelf.ca/  
All rights reserved.  

Based on parsedown  
Copyright (c) 2013 Emanuil Rusev  
http://erusev.com/  
All rights reserved.  

Based on The PHP League's Common Mark implementation
Copyright (c) 2014, Colin O'Dell
https://github.com/thephpleague/commonmark
All rights reserved.  

Based on Markdown  
Copyright (c) 2003-2005 John Gruber  
http://daringfireball.net/  
All rights reserved.
