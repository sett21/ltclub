<?php

class Admin_Form_Subscribe extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        
        $subscribe = new Zend_Form_Element_Text('subscribe');
        $subscribe->setLabel('Subscribe');
        $subscribe->setRequired(true);
        $this->addElement($subscribe);
        
        $active = new Zend_Form_Element_Checkbox('active');
        $active->setLabel('Active');
        $this->addElement($active);
        
        $bttn = new Zend_Form_Element_Submit('submit');
        $this->addElement($bttn);
        
    }

}

