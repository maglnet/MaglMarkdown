<?php

namespace MaglMarkdown;

/**
 * MaglMarkdown is a ZF2 module to provide a View Helper that is able to
 * transform Markdown to html
 * 
 * @author Matthias Glaub <magl@magl.net>
 */
class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
    
    public function getViewHelperConfig(){
        return array(
            'factories' => array(
                'markdown' => function($sm){
                    $markdownAdapter = $sm->getServiceLocator()->get('MaglMarkdown\MarkdownAdapter');
                    return new View\Helper\Markdown($markdownAdapter);
                }
            )
        );
    }
}
