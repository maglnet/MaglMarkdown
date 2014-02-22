# MaglMarkdown

Version 1.0.2 by Matthias Glaub

## Introduction

MaglMarkdown is a ZF2 module that adds a View Helper to transform [Markdown](http://daringfireball.net/projects/markdown/).

You can use one of the following parsers for your Markdown:
* The [PHP-Markdown](http://michelf.com/projects/php-markdown/) parser from Michel Fortin
* The [PHP-MarkdownExtra](http://michelf.ca/projects/php-markdown/extra/) parser from Michel Fortin (this is the default)
* The [Parsedown](http://parsedown.org/) parser from Emanuil Rusev

## Installation

You can simply install the module with composer by adding the following "require" to your composer.json

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


## Usage

Simply use it within your Views like this

```
$this->markdown('Yes, **this** is *Markdown*!');
```

## Configuration

Have a look at the provided config file *config/maglmarkdown.local.php*.
There you can choose between the provided parsers, simply comment out one of the lines to enable a different parser.

## Adding own parsers

It is possible to add your own parser implementation. All you have to do, is to write a class that implements the *MaglMarkdown\Adapter\MarkdownAdapterInterface* interface
and provide an alias for that class.
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