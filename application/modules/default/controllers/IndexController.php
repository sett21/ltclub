<?php

class Default_IndexController extends Zend_Controller_Action {

    public function indexAction() {

        $mapperProposalType = new Application_Model_ProposalTypeMapper();
        $this->view->types = $mapperProposalType->fetchAllWithOutDeleted();
        
        $mapper = new Application_Model_ProposalMapper();
        $this->view->count = $mapper->countWithDeleted();
        $this->view->proposals = $mapper->fetchWithOutDeletedAndWithTypeAndLimitAndInclusion();
    }

}