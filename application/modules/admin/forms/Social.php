<?php

class Admin_Form_Social extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $href = new Zend_Form_Element_Text('href');
        $href->setLabel('Href')->setRequired(true);
        $this->addElement($href);
        
        $bttn = new Zend_Form_Element_Submit('submit');
        $bttn->setLabel('Submit');
        $this->addElement($bttn);
        
    }

}

