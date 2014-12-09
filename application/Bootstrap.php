<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    /**
     * Init Namespace
     * @return type
     */
    protected function _initAutoload() {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Lumiere_');

        return $autoloader;
    }

    protected function _initAutoloadModule() {
        $autoloader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => 'Admin_',
                    'basePath' => APPLICATION_PATH . '/modules/admin',
                ));
        return $autoloader;
    }

    /**
     * Init Controller Plugins
     * @return type 
     */
    protected function _initControllerPlugins() {
        $controller = Zend_Controller_Front::getInstance();
        $controller->registerPlugin(new Lumiere_Controller_Plugin_ChangeLayout());
        //$controller->registerPlugin(new Lumiere_Controller_Plugin_LeftMenu());
        $controller->registerPlugin(new Lumiere_Controller_Plugin_PreDispatch());
        return $controller;
    }

    /**
     * 
     */
    protected function _initViews() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        
        $view->headTitle('Lumiere Travel Club')->setSeparator('. ');
        
        $view->headLink()->appendStylesheet('/assets/stylesheets/screen.css');
        $view->headLink()->appendStylesheet('/assets/stylesheets/smoothness/jquery.ui.min.css');
        $view->headLink()->appendStylesheet('/assets/stylesheets/jquery-ui.css');
        $view->headLink()->appendStylesheet('/assets/stylesheets/jquery-ui.structure.css');
        $view->headLink()->appendStylesheet('/assets/stylesheets/jquery-ui.theme.css');
        $view->headLink()->appendStylesheet('/assets/stylesheets/global.css');
        
        $view->headScript()->appendFile('/assets/javascripts/jquery.min.js');
        $view->headScript()->appendFile('/assets/javascripts/jquery.ui.min.js');
        $view->headScript()->appendFile('/assets/javascripts/jquery-ui.js');
        $view->headScript()->appendFile('/assets/javascripts/jquery.global.js');
        
        return $view;
    }

    protected function _initRoute() {
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $textPageWithUri = new Zend_Controller_Router_Route('/page/:id', array(
                    'module' => 'default',
                    'controller' => 'page',
                    'action' => 'index'
                ));
        $router->addRoute('textpagewithuri', $textPageWithUri);
        
        $proposalWithUri = new Zend_Controller_Router_Route('/proposal/:id', array(
                    'module' => 'default',
                    'controller' => 'proposal',
                    'action' => 'index'
                ));
        $router->addRoute('proposalwithuri', $proposalWithUri);
    }

}