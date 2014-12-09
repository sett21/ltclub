<?php

class Admin_Form_ProposalsType extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $type = new Zend_Form_Element_Text('type');
        $type->setLabel('Type')->setRequired(true);
        $this->addElement($type);

        $bttn = new Zend_Form_Element_Submit('bttn');
        $bttn->setLabel('Submit');
        $this->addElement($bttn);
    }

}

