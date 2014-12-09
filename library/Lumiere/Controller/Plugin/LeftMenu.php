<?php

class Lumiere_Controller_Plugin_LeftMenu extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        if ('default' == $request->getModuleName()) {

            $layout = Zend_Layout::getMvcInstance();
            $view = $layout->getView();

            $mapper = new Application_Model_MenuMapper();
            $view->leftmenus = $mapper->fetchByType();
            
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
        }
    }

}