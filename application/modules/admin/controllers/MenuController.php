<?php

require_once APPLICATION_PATH . '/modules/admin/forms/Menu.php';

class Admin_MenuController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->getHelper('Redirector')->gotoSimpleAndExit('index', 'auth', 'admin');
        }
    }

    public function indexAction() {
     
        $this->view->type = $this->getParam('type');
        
        if (!$this->getParam('type')) {
            $mapper = new Application_Model_MenuTypeMapper();
            $this->view->results = $mapper->fetchAll();
            return false;
        }
        
        $mapper = new Application_Model_MenuMapper();
        $this->view->results = $mapper->fetchByType($this->view->type, true);
    }

    public function addAction() {
        $form = new Admin_Form_Menu();
        $menu = new Application_Model_Menu();
        $form->getElement('type_id')->setValue($this->getParam('type'));
        self::issetFormRequest($this, $form, $menu);
        $this->view->form = $form;
    }

    public function editAction() {
        $form = new Admin_Form_Menu();
        $menu = new Application_Model_Menu();
        $menu->find($this->getParam('id'));
        $form->getElement('type_id')->setValue($this->getParam('type'));
        self::issetFormRequest($this, $form, $menu);
        $form->getElement('menu')->setValue($menu->getMenu());
        $form->getElement('parent_id')->setValue($menu->getParentId());
        $form->getElement('page_id')->setValue($menu->getTextpageId());
        $form->getElement('href')->setValue($menu->getHref());
        $this->view->form = $form;
    }

    public function dropAction() {
        $leftmenu = new Application_Model_Menu();
        $leftmenu->find($this->getParam('id'));
        $leftmenu->setDeleted(1);
        $leftmenu->save();
        $this->_redirect('/admin/menu/?type=' . $this->getParam('type'));
    }

    /**
     * 
     * @param type $controller
     * @param Admin_Form_Menu $form
     * @param Application_Model_Menu $menu
     */
    private static function issetFormRequest($controller, Admin_Form_Menu $form, Application_Model_Menu $menu) {
        if ($controller->getRequest()->isPost()) {
            if ($form->isValid($controller->getAllParams())) {
                $menu->setTypeId($controller->getParam('type'));
                $menu->setMenu($form->getValue('menu'));
                $menu->setParentId($form->getValue('parent_id'));
                $menu->setTextpageId($form->getValue('page_id'));
                $menu->setHref($form->getValue('href'));
                $menu->save();
                $controller->_redirect('/admin/menu/?type=' . $controller->getParam('type'));
            }
        }
    }

}

