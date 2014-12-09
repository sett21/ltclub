<?php

require_once APPLICATION_PATH . '/modules/admin/forms/ProposalsType.php';

class Admin_ProposalstypeController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->getHelper('Redirector')->gotoSimpleAndExit('index', 'auth', 'admin');
        }
    }

    public function indexAction() {
        $mapper = new Application_Model_ProposalTypeMapper();
        $this->view->results = $mapper->fetchAllWithOutDeleted();
    }

    public function addAction() {
        $form = new Admin_Form_ProposalsType();
        $proposal = new Application_Model_ProposalType();
        self::issetFormRequest($this, $form, $proposal);
        $this->view->form = $form;
    }

    public function editAction() {
        $form = new Admin_Form_ProposalsType();
        $proposal = new Application_Model_ProposalType();
        $proposal->find($this->getParam('id'));
        self::issetFormRequest($this, $form, $proposal);
        $form->getElement('type')->setValue($proposal->getType());
        $this->view->form = $form;
    }

    public function dropAction() {
        $proposal = new Application_Model_ProposalType();
        $proposal->find($this->getParam('id'));
        $proposal->setDeleted(1);
        $proposal->save();
        $this->_redirect('/admin/proposalstype');
    }

    private static function issetFormRequest($controller, $form, $proposalType) {

        // if isset Request
        if ($controller->getRequest()->isPost()) {
            if ($form->isValid($controller->getAllParams())) {
                $proposalType->setType($form->getValue('type'));
                $proposalType->save();
                $controller->_redirect('/admin/proposalstype');
            }
        }
    }

}

