<?php

class Lumiere_Controller_Plugin_PreDispatch extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
        // Get Layout
        $layout = Zend_Layout::getMvcInstance();
        // Get View
        $view = $layout->getView();
        
        // If Default Module
        if ('default' == $request->getModuleName()) {

            
            // Init Service
            $mapperService = new Application_Model_ServiceMapper();
            $view->services = $mapperService->fetchAllWithOutDeleted();
            
            // Init Menu
            $menu = new Application_Model_Menu(); 
            $view->topmenus = $menu->getMapper()->fetchByType(Application_Model_MenuMapper::TOP, true);
            $view->leftmenus = $menu->getMapper()->fetchByType(Application_Model_MenuMapper::LEFT, true);
            $view->bottommenus = $menu->getMapper()->fetchByType(Application_Model_MenuMapper::BOTTOM, true);
            
            foreach ($view->leftmenus as $lm) {

                if (is_null($lm->getParentId())) {
                    continue;
                }

                $id = $request->getParam('id');
                if ($request->getRequestUri() == $lm->getHref() || $id == $lm->getTextpageId() || $id == $lm->uri ) {
                    $view->activemenuid = $lm->getParentId();
                    break;
                }
                
            }
            
            
            // Init Social
            $mapperSocial = new Application_Model_SocialMapper();
            $view->socials = $mapperSocial->fetchAll();
        }
    }

}