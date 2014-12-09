<?php

require_once APPLICATION_PATH . '/modules/admin/forms/Service.php';

class Admin_ServiceController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->getHelper('Redirector')->gotoSimpleAndExit('index', 'auth', 'admin');
        }
    }

    public function editAction() {

        $form = new Admin_Form_Service();
        $service = new Application_Model_Service();
        $service->find($this->getParam('id'));

        $mapperTextPage = new Application_Model_TextPageMapper();
        foreach ($mapperTextPage->fetchAll(true) as $item) {
            $form->getElement('page_id')->addMultiOption($item->getId(), $item->getTitle());
        }

        if (!is_null($service->getId())) {
            $form->getElement('page_id')->setValue($service->getTextpageId());
        } else {
            $this->view->result = $service->getMapper()->fetchAll();
        }

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getAllParams())) {
                $service->setTextpageId($form->getElement('page_id')->getValue());
                $service->save();
                $this->_redirect('/admin/service/edit');
            }
        }

        $this->view->topmenu = $service;
        $this->view->form = $form;
    }

}

