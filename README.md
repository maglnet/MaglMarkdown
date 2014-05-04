# MaglMarkdown

[![Latest Stable Version](https://poser.pugx.org/maglnet/magl-markdown/v/stable.png)](https://packagist.org/packages/maglnet/magl-markdown)
[![Latest Unstable Version](https://poser.pugx.org/maglnet/magl-markdown/v/unstable.png)](https://packagist.org/packages/maglnet/magl-markdown)
[![License](https://poser.pugx.org/maglnet/magl-markdown/license.png)](https://packagist.org/packages/maglnet/magl-markdown)
[![Dependency Status](https://www.versioneye.com/user/projects/53106961ec13758b7e0000c0/badge.png)](https://www.versioneye.com/user/projects/53106961ec13758b7e0000c0)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maglnet/MaglMarkdown/badges/quality-score.png?s=7eae6389efc0ce777f8d7a4439cce5ad99ec8e01)](https://scrutinizer-ci.com/g/maglnet/MaglMarkdown/)
[![Code Coverage](https://scrutinizer-ci.com/g/maglnet/MaglMarkdown/badges/coverage.png?s=32e6c5cc905fe1e7cb3914d0ca08818f7af455de)](https://scrutinizer-ci.com/g/maglnet/MaglMarkdown/)


dev-master: [![Build Status](https://travis-ci.org/maglnet/MaglMarkdown.png?branch=master)](https://travis-ci.org/maglnet/MaglMarkdown)

MaglMarkdown is developed by Matthias Glaub

## Introduction

MaglMarkdown is a ZF2 module that adds a View Helper to transform [Markdown](http://daringfireball.net/projects/markdown/).

You can use one of the following parsers for your Markdown:  
* The [PHP-Markdown](http://michelf.com/projects/php-markdown/) parser from Michel Fortin
* The [PHP-MarkdownExtra](http://michelf.ca/projects/php-markdown/extra/) parser from Michel Fortin (this is the default)
* The [Parsedown](http://parsedown.org/) parser from Emanuil Rusev

## Installation

You can install the module with composer by adding the following "require" to your `composer.json`

```json
{
	"require": {
		"maglnet/magl-markdown": "1.*"
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
You can also get a MarkdownAdapter through the Service Manager and use
`transformText()` to get your Markdown rendered to HTML.

```php
/* @var $markdownAdapter MaglMarkdown\Adapter\MarkdownAdapterInterface */
$markdownAdapter = $serviceManager->get('MaglMarkdown\MarkdownAdapter');
$html = $markdownAdapter->transformText('Yes, **this** is *Markdown*!');
```


*Security warning:*  
You should be aware, that your markdown could contain insecure content (e.g. user generated content). 
So use something like HTMLPurifier to sanitize your output.

## Configuration

Have a look at the provided config file `config/maglmarkdown.local.php` and copy it to `YourZF2Application/config/autoload/maglmarkdown.php`.  
There you can choose between the provided parsers, simply comment out one of the lines to enable a different parser.  
By default [PHP-MarkdownExtra](http://michelf.ca/projects/php-markdown/extra/) parser by Michel Fortin is used.  

## Adding own parsers

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

Based on Markdown  
Copyright (c) 2003-2005 John Gruber  
http://daringfireball.net/  
All rights reserved.
