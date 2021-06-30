<?php

namespace MaglMarkdownTest\View\Helper;

use MaglMarkdownTest\Bootstrap;
use Laminas\View\HelperPluginManager;

/**
 * Description of ModuleTest
 *
 * @author matthias
 */
class MarkdownTest extends \PHPUnit\Framework\TestCase
{

    public function testGetViewHelper()
    {
        $serviceManager = Bootstrap::getServiceManager();

        /* @var $view HelperPluginManager */
        $view = $serviceManager->get('ViewHelperManager');

        $markdown = $view->get('markdown');
        $this->assertInstanceOf('MaglMarkdown\View\Helper\Markdown', $markdown);
        $this->assertInstanceOf('Laminas\View\Helper\HelperInterface', $markdown);
    }

    public function testViewHelperWorking()
    {
        $serviceManager = Bootstrap::getServiceManager();

        /* @var $view HelperPluginManager */
        $view = $serviceManager->get('ViewHelperManager');

        /** @var \MaglMarkdown\View\Helper\Markdown $markdown */
        $markdown = $view->get('markdown');
        $text = $markdown('some sample string');

        $this->assertNotEmpty($text);
    }

}
