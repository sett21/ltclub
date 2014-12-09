<?php

class Admin_Form_Proposal extends Zend_Form {

    public function init() {
        
        $this->setMethod('post');
        
        $preview = new Zend_Form_Element_File('preview');
        $preview->setLabel('Preview')->setRequired(true);
        $this->addElement($preview);
        
        $banner = new Zend_Form_Element_File('banner');
        $banner->setLabel('Banner')->setRequired(true);
        $this->addElement($banner);
        
        // Select
        $typeId = new Zend_Form_Element_Select('type_id');
        $typeId->setLabel('Type');
        
        $mapper = new Application_Model_ProposalTypeMapper();
        
        foreach ($mapper->fetchAll() as $item) {
            $typeId->addMultiOption($item->getId(), $item->getType());
        }
        
        $this->addElement($typeId);
        
        $keywords = new Zend_Form_Element_Text('keywords');
        $keywords->setLabel('Keywords');
        $this->addElement($keywords);
        
        $mdescription = new Zend_Form_Element_Text('mdescription');
        $mdescription->setLabel('Meta Description');
        $this->addElement($mdescription);
        
        $proposal = new Zend_Form_Element_Text('proposal');
        $proposal->setLabel('Proposal')->setRequired(true);
        $this->addElement($proposal);
        
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description')->setRequired(true);
        $this->addElement($description);
        
        $text = new Zend_Form_Element_Textarea('text');
        $text->setLabel('Text')->setRequired(true);
        $this->addElement($text);
        
        $inclusion = new Zend_Form_Element_Checkbox('inclusion');
        $inclusion->setLabel('Inclusion');
        $this->addElement($inclusion);
        
        $persons = new Zend_Form_Element_Text('persons');
        $persons->setLabel('Persons')->setRequired(true);
        $this->addElement($persons);
        
        $bttn = new Zend_Form_Element_Submit('submit');
        $bttn->setLabel('Submit');
        $this->addElement($bttn);
            
    }

}

