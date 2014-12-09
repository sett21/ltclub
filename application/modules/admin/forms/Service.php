<?php

class Admin_Form_Service extends Zend_Form {

    public function init() {

        $this->setMethod('post');

//        $service = new Zend_Form_Element_Text('service');
//        $service->setLabel('Service')->setRequired(true);
//        $this->addElement($service);

        // Select
        $pageId = new Zend_Form_Element_Select('page_id');
        $pageId->setLabel('PageId');
        
        $mapperTextPage = new Application_Model_TextPageMapper();
        $pageId->addMultiOption('', '');
        
        foreach ($mapperTextPage->fetchAll(true) as $item) {
            $pageId->addMultiOption($item->getId(), $item->getTitle());
        }
        
        $this->addElement($pageId);
        
        $bttn = new Zend_Form_Element_Submit('bttn');
        $bttn->setLabel('Submit');
        $this->addElement($bttn);
    }

}

