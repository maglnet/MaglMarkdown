<?php

namespace MaglMarkdown\Adapter;

/**
 * This is an implementation that uses Emanuil Rusev's Parsedown to transform the Markup to HTML
 *
 * @see http://parsedown.org/
 * @author Matthias Glaub <magl@magl.net>
 */
class ErusevParsedownAdapter implements MarkdownAdapterInterface {

	public function __construct() {
		echo "loading";
		require_once realpath(__DIR__ . '/../../../vendor/erusev/parsedown/Parsedown.php');
	}

	public function transformText($text) {
		$parsedown = new \Parsedown();

		return $parsedown->parse($text); # prints: <p>Hello <em>Parsedown</em>!</p>
	}

}
