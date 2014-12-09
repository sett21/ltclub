<?php

require_once APPLICATION_PATH . '/modules/admin/forms/Proposal.php';

class Admin_ProposalsController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->getHelper('Redirector')->gotoSimpleAndExit('index', 'auth', 'admin');
        }
    }

    public function indexAction() {
        $mapper = new Application_Model_ProposalMapper();
        $this->view->results = $mapper->fetchAllWithoutDeleted();
    }

    public function addAction() {

        $form = new Admin_Form_Proposal();
        $proposal = new Application_Model_Proposal();

        self::issetFormRequest($this, $form, $proposal, true);

        $this->view->form = $form;
    }

    public function editAction() {

        $proposal = new Application_Model_Proposal();
        $proposal->find($this->getParam('id'));

        $form = new Admin_Form_Proposal();
        $form->getElement('preview')->setRequired(false);
        $form->getElement('banner')->setRequired(false);

        self::issetFormRequest($this, $form, $proposal, true);

        $form->getElement('keywords')->setValue($proposal->getKeywords());
        $form->getElement('mdescription')->setValue($proposal->getMdescription());
        $form->getElement('type_id')->setValue($proposal->getTypeId());
        $form->getElement('proposal')->setValue($proposal->getProposal());
        $form->getElement('description')->setValue($proposal->getDescription());
        $form->getElement('text')->setValue($proposal->getText());
        $form->getElement('inclusion')->setValue($proposal->getInclusion());
        $form->getElement('persons')->setValue($proposal->getPersons());

        $this->view->form = $form;
    }

    public function dropAction() {
        $proposal = new Application_Model_Proposal();
        $proposal->find($this->getParam('id'));
        $proposal->setDeleted(1);
        $proposal->save();

        $this->_redirect('/admin/proposals');
    }

    private static function issetFormRequest($controller, $form, $proposal, $notValidImage = false) {

        // if isset Request
        if ($controller->getRequest()->isPost()) {

            Zend_Debug::dump($controller->getAllParams());
            //die();

            if ($form->isValid($controller->getAllParams())) {

                $proposal->setKeywords($form->getValue('keywords'));
                $proposal->setMdescription($form->getValue('mdescription'));
                $proposal->setTypeId($form->getValue('type_id'));
                $proposal->setProposal($form->getValue('proposal'));
                $proposal->setDescription($form->getValue('description'));
                $proposal->setText($form->getValue('text'));
                $proposal->setInclusion($form->getValue('inclusion'));
                $proposal->setPersons($form->getValue('persons'));

                $uploaded = new Zend_File_Transfer_Adapter_Http();
                $uploaded->setDestination(UPLOADS_DIRECTORY);

                foreach ($uploaded->getFileInfo() as $file => $info) {

                    if ($notValidImage) {
                        if (!strlen($info['name'])) {
                            continue;
                        }
                    }

                    $path = sprintf('/uploads/%s', $info['name']);

                    switch ($file) {
                        case 'preview':
                            $proposal->setPreview($path);
                            break;

                        case 'banner':
                            $proposal->setBanner($path);
                            break;
                    }

                    // Get Name
                    $name = $uploaded->getFileName($file);
                    $path = UPLOADS_DIRECTORY . '/' . $info['name'];

                    // Add Filter
                    $uploaded->addFilter(new Zend_Filter_File_Rename(array(
                                'target' => $path,
                                'overwrite' => true)
                            ), null, $file);

                    // Do
                    $uploaded->receive($file);
                }

                $proposal->save();

                $controller->_redirect('/admin/proposals');
            }
        }
    }

}

