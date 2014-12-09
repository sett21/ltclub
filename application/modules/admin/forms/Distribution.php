<?php

class Admin_Form_Distribution extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $distribution = new Zend_Form_Element_Textarea('distribution');
        $distribution->setLabel('Text')->setRequired(true);
        $this->addElement($distribution);

        $bttn = new Zend_Form_Element_Submit('submit');
        $this->addElement($bttn);
    }

}

