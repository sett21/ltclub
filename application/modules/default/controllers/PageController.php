<?php

class Default_PageController extends Zend_Controller_Action {

    const NAME = 'page';

    public function indexAction() {
        $this->view->textpage = new Application_Model_TextPage();
        $this->view->textpage->find($this->getParam('id'));
        $this->view->headTitle($this->view->textpage->getTitle(), 'PREPEND');
        $view = $this->getFrontController()->getParam('bootstrap')->getResource('view');
        $view->headMeta()->appendName('keywords', $this->view->textpage->getKeywords());
        $view->headMeta()->appendName('description', $this->view->textpage->getDescription());
    }
}