<?php

/**
 * @author  Matthias Glaub <magl@magl.net>
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace MaglMarkdown\Adapter\Options;

use Zend\Stdlib\AbstractOptions;

class GithubMarkdownOptions extends AbstractOptions
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     *
     * @var string
     */
    protected $markdownApiUri = 'https://api.github.com/markdown';

    /**
     *
     * @var string
     */
    protected $markdownMode = 'gfm';

    public function getMarkdownApiUri()
    {
        return $this->markdownApiUri;
    }

    public function setMarkdownApiUri($markdownApiUri)
    {
        $this->markdownApiUri = $markdownApiUri;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getMarkdownMode()
    {
        return $this->markdownMode;
    }

    public function setMarkdownMode($markdownMode)
    {
        $this->markdownMode = $markdownMode;
    }
}
