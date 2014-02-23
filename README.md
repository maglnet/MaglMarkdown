# MaglMarkdown

[![Latest Stable Version](https://poser.pugx.org/maglnet/magl-markdown/v/stable.png)](https://packagist.org/packages/maglnet/magl-markdown)
[![Latest Unstable Version](https://poser.pugx.org/maglnet/magl-markdown/v/unstable.png)](https://packagist.org/packages/maglnet/magl-markdown)
[![License](https://poser.pugx.org/maglnet/magl-markdown/license.png)](https://packagist.org/packages/maglnet/magl-markdown)

MaglMarkdown is developed by Matthias Glaub

## Introduction

MaglMarkdown is a ZF2 module that adds a View Helper to transform [Markdown](http://daringfireball.net/projects/markdown/).

You can use one of the following parsers for your Markdown:
* The [PHP-Markdown](http://michelf.com/projects/php-markdown/) parser from Michel Fortin
* The [PHP-MarkdownExtra](http://michelf.ca/projects/php-markdown/extra/) parser from Michel Fortin (this is the default)
* The [Parsedown](http://parsedown.org/) parser from Emanuil Rusev

## Installation

You can install the module with composer by adding the following "require" to your `composer.json`

```
{
	"require": {
		"maglnet/magl-markdown": "1.*"
	}
}
```

after that you need to run
```
php composer.phar update
```

and enable the module within your `application.config.php`
```
'modules' => array(
	'Application',
	'MaglMarkdown',
),
```


## Usage

Simply use it within your Views like this

```
$this->markdown('Yes, **this** is *Markdown*!');
```

## Configuration

Have a look at the provided config file `config/maglmarkdown.local.php` and copy it to `YourZF2Application/config/autoload/maglmarkdown.php` .
There you can choose between the provided parsers, simply comment out one of the lines to enable a different parser.
By default [PHP-MarkdownExtra](http://michelf.ca/projects/php-markdown/extra/) parser by Michel Fortin is used.

## Adding own parsers

It is possible to add your own parser implementation.
All you have to do, is to write a class that implements the `MaglMarkdown\Adapter\MarkdownAdapterInterface` interface
and make it available throug the service manager.
After that override the alias `MaglMarkdown\MarkdownAdapter`to point to your custom adapter.
MaglMarkdown will then use this class to transform the Markdown.

```
'aliases' => array(
	'MaglMarkdown\MarkdownAdapter' => 'Your\Own\MarkdownAdapter', //needs to implement MaglMarkdown\Adapter\MarkdownAdapterInterface
)
```

## License

MaglMarkdown is licensed under the LGPL-3 license. 
See the included LICENSE file.

[PHP Markdown](http://michelf.com/projects/php-markdown/) is available under the BSD-3-Clause license.
[Parsedown](http://parsedown.org/) is available under the MIT License.
