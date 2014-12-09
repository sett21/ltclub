<?php

require_once APPLICATION_PATH . '/modules/admin/forms/Menu.php';

class Admin_BottommenuController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->getHelper('Redirector')->gotoSimpleAndExit('index', 'auth', 'admin');
        }
    }

    public function editAction() {

        $form = new Admin_Form_Menu();
        $topmenu = new Application_Model_BottomMenu();
        $topmenu->find($this->getParam('id'));

        $mapperTextPage = new Application_Model_TextPageMapper();
        foreach ($mapperTextPage->fetchAllWithOutDeleted() as $item) {
            $form->getElement('textpage_id')->addMultiOption($item->getId(), $item->getTitle());
        }

        if (!is_null($topmenu->getId())) {
            $form->getElement('textpage_id')->setValue($topmenu->getTextpageId());
        } else {
            $this->view->result = $topmenu->getMapper()->fetchAll();
        }

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getAllParams())) {
                $topmenu->setTextpageId($form->getElement('textpage_id')->getValue());
                $topmenu->save();
                $this->_redirect('/admin/bottommenu/edit');
            }
        }

        $this->view->topmenu = $topmenu;
        $this->view->form = $form;
    }

}

