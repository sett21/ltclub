<?php

class Default_SearchController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $search = new Application_Model_Search();
        $this->view->result = $search->getMapper()->findByLike($this->getParam('text'));
    }

}

