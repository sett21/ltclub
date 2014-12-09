<?php

class Admin_SubscribeController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $mapper = new Application_Model_SubscribeMapper();
        $this->view->results = $mapper->fetchAll(true);
    }

    public function editAction() {
        $form = new Admin_Form_Subscribe();

        $subscribe = new Application_Model_Subscribe();
        $subscribe->find($this->getParam('id'));

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getAllParams())) {

                $subscribe->setSubscribe($form->getValue('subscribe'));
                $subscribe->setActive($form->getValue('active'));
                $subscribe->save();
                $this->_redirect('/admin/subscribe');
            }
        }

        $form->getElement('subscribe')->setValue($subscribe->getSubscribe());
        $form->getElement('active')->setValue($subscribe->getActive());
        $this->view->form = $form;
    }

    public function createAction() {

        $form = new Admin_Form_Distribution();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getAllParams())) {
                $mapper = new Application_Model_SubscribeMapper();

                $result = $mapper->fetchAll(true, true);

                $mail = new Zend_Mail();
                $mail->setBodyText($form->getValue('distribution'));
                $mail->setFrom('test@msbios.com', 'Some Sender');

                foreach ($result as $item) {
                    $mail->addTo($item->getSubscribe(), 'Some Recipient');
                }

                $mail->setSubject('TestSubject');
                $mail->send();
                $this->_redirect('/admin/subscribe');
            }
        }

        $this->view->form = $form;
    }

}

