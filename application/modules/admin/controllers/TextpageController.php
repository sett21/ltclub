<?php

require_once APPLICATION_PATH . '/modules/admin/forms/Textpage.php';

class Admin_TextpageController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->getHelper('Redirector')->gotoSimpleAndExit('index', 'auth', 'admin');
        }
    }

    public function indexAction() {
        $mapper = new Application_Model_TextPageMapper();
        $this->view->results = $mapper->fetchAll();
    }

    public function addAction() {
        $form = new Admin_Form_Textpage();
        $textpage = new Application_Model_TextPage();

        self::issetFormRequest($this, $form, $textpage);
        $this->view->form = $form;
    }

    public function editAction() {

        $textpage = new Application_Model_TextPage();
        $textpage->find($this->getParam('id'));

        $form = new Admin_Form_Textpage();

        self::issetFormRequest($this, $form, $textpage);

        $form->getElement('keywords')->setValue($textpage->getKeywords());
        $form->getElement('description')->setValue($textpage->getDescription());
        $form->getElement('title')->setValue($textpage->getTitle());
        $form->getElement('text')->setValue($textpage->getText());

        $this->view->form = $form;
    }

    private static function issetFormRequest($controller, Admin_Form_Textpage $form, Application_Model_TextPage $textpage) {
        // if isset Request
        if ($controller->getRequest()->isPost()) {

            if ($form->isValid($controller->getAllParams())) {
                $textpage->setKeywords($form->getValue('keywords'));
                $textpage->setDescription($form->getValue('description'));
                $textpage->setText($form->getValue('text'));
                $textpage->setTitle($form->getValue('title'));
                $textpage->save();
                $controller->_redirect('/admin/textpage');
            }
        }
    }

    public function dropAction() {
        $textpage = new Application_Model_TextPage();
        $textpage->find($this->getParam('id'));
        $textpage->setDeleted(1);
        $textpage->save();
        $this->_redirect('/admin/textpage');
    }

}

