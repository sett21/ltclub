<?php

class Admin_Form_Textpage extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')->setRequired(true);
        $this->addElement($title);
        
        $keywords = new Zend_Form_Element_Text('keywords');
        $keywords->setLabel('Keywords');
        $this->addElement($keywords);
        
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description');
        $this->addElement($description);

        $text = new Zend_Form_Element_Textarea('text');
        $text->setLabel('Text')->setRequired(true);
        $this->addElement($text);

        $bttn = new Zend_Form_Element_Submit('submit');
        $this->addElement($bttn);
    }

}

