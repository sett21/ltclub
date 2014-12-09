<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AsyncController
 *
 * @author shykor
 */
class Default_AsyncController extends Zend_Controller_Action {

    /**
     * 
     */
    public function init() {

        /* Initialize action controller here */
        $this->_helper->viewRenderer->setNoRender();

        // Отключение макета для данного действия
        $this->_helper->getHelper('layout')->disableLayout();
    }

    public function getproposalsAction() {

        $mapper = new Application_Model_ProposalMapper();
        
        $type = $this->getParam('type');
        $inclusion = $this->getParam('inclusion');
        $limit = $this->getParam('limit', Application_Model_ProposalMapper::LIMIT);
        $offset = $this->getParam('offset');
        
        foreach ($mapper->fetchWithOutDeletedAndWithTypeAndLimitAndInclusion($limit, $offset, $type, $inclusion) as $proposal) {
            $this->view->proposal = $proposal;
            echo $this->view->render('/partials/proposal.phtml');
        }
    }
    
    public function getproposalsbytypeAction() {

        $mapper = new Application_Model_ProposalMapper();
        
        $type = $this->getParam('type');
        $inclusion = $this->getParam('inclusion');
        $limit = $this->getParam('limit', Application_Model_ProposalMapper::LIMIT);
        $offset = $this->getParam('offset');
        
        $data = array(
            'count' => $mapper->countWithDeleted($type, $inclusion),
            'proposals' => ''
        );
        
        foreach ($mapper->fetchWithOutDeletedAndWithTypeAndLimitAndInclusion($limit, $offset, $type, $inclusion) as $proposal) {
            $this->view->proposal = $proposal;
            $data['proposals'] .= $this->view->render('/partials/proposal.phtml');
        }
        
        echo Zend_Json_Encoder::encode($data);
    }

    public function setsubscribeAction() {
        
        if ($this->getRequest()->isPost()) {
            $subscribe = new Application_Model_Subscribe();
            $subscribe->setSubscribe($this->getParam('subscribe'));
            $subscribe->save();
        }
        
        echo Zend_Json_Encoder::encode(array(
            'error' => 0
        ));
    }
    
    public function searchproposalAction() {
        
        $proposal = new Application_Model_Proposal();
        $result = $proposal->getMapper()->findByLike($this->getParam('term'));
        
        $items = array();
        
        foreach ($result as $item) {
            $items[] = array(
                'value' => $item->getProposal(),
                'proposal' => $item->getProposal(),
                'uri' => $item->getUri(),
            );
        }
        
        echo Zend_Json_Encoder::encode($items);
    }
}
