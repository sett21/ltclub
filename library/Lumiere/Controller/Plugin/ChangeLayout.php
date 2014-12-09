<?php

class Lumiere_Controller_Plugin_ChangeLayout extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
        $module = $request->getModuleName();
        
        if ('admin' == $module) {
            Zend_Layout::getMvcInstance()->setLayout($module);
        }
    }

}