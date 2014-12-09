<?php

class Default_SubscribeController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $email = $this->getParam('email');
        $subscribe = new Application_Model_Subscribe();
        $subscribe->find($email);
        
        if (!is_null($subscribe->getId())) {
            $subscribe->setActive(1);
            $subscribe->save();
        }
        
        $this->_redirect('/');
        
    }

}

