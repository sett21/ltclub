<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bootstrap
 *
 * @author shykor
 */
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap {

    public function _initAuloload() {
        $autoloader = new Zend_Application_Module_Autoloader(array(
                    'resourceTypes' => array(
                        'form' => array(
                            'path' => 'forms',
                            'namespace' => 'Admin_',
                        ),
                    )
                ));
        return $autoloader;
    }

}