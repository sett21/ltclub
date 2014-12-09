<?php

class Admin_SocialController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->getHelper('Redirector')->gotoSimpleAndExit('index', 'auth', 'admin');
        }
    }

    public function editAction() {

        $form = new Admin_Form_Social();
        $social = new Application_Model_Social();
        $social->find($this->getParam('id'));

        if (!is_null($social->getId())) {
            $form->getElement('href')->setValue($social->getHref());
        } else {
            $this->view->result = $social->getMapper()->fetchAll();
        }

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getAllParams())) {
                $social->setHref($form->getElement('href')->getValue());
                $social->save();
                $this->_redirect('/admin/social/edit');
            }
        }

        $this->view->topmenu = $social;
        $this->view->form = $form;
    }

}

