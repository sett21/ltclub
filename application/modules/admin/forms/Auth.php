<?php

class Admin_Form_Auth extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username')->setRequired(true);
        $this->addElement($username);
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')->setRequired(true);
        $this->addElement($password);

        $bttn = new Zend_Form_Element_Submit('bttn');
        $bttn->setLabel('Submit');
        $this->addElement($bttn);
    }

}

