<?php

class Admin_AuthController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->_helper->viewRenderer->setNoRender();

        // Отключение макета для данного действия
        $this->_helper->getHelper('layout')->disableLayout();
    }

    public function indexAction() {
        $form = new Admin_Form_Auth();

        if ($this->getRequest()->isPost()) {
            
            //echo 'request';
            
            if ($form->isValid($this->getAllParams())) {
                
                //echo 'form';
                
                $auth = Zend_Auth::getInstance();

                $username = $form->getElement('username')->getValue();
                $password = $form->getElement('password')->getValue();
                $adapter = new Lumiere_Auth_Adapter($username, $password);
                $result = $auth->authenticate($adapter);

                //Zend_Debug::dump($result);
                
                if ($result->getCode() == Zend_Auth_Result::SUCCESS) {
                    $this->getHelper('Redirector')->gotoSimpleAndExit('index', 'index', 'admin');
                }
            }
        }

        $this->view->form = $form;
        echo $this->view->render('/auth/logon.phtml');
    }

    public function logonAction() {
        $this->getHelper('Redirector')->gotoSimpleAndExit('index');
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->getHelper('Redirector')->gotoSimpleAndExit('index');
    }

}

