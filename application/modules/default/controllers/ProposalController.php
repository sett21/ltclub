<?php

class Default_ProposalController extends Zend_Controller_Action {

    public function indexAction() {
        $this->view->proposal = new Application_Model_Proposal();
        $this->view->proposal->find($this->getParam('id'));
        
        $this->view->headTitle($this->view->proposal->getProposal(), 'PREPEND');
        
        $view = $this->getFrontController()->getParam('bootstrap')->getResource('view');
        $view->headMeta()->appendName('keywords', $this->view->proposal->getKeywords());
        $view->headMeta()->appendName('description', $this->view->proposal->getMdescription());
    }

}

