<?php

class Admin_Form_Menu extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $menu = new Zend_Form_Element_Text('menu');
        $menu->setLabel('Menu')->setRequired(true);
        $this->addElement($menu);

        $typeId = new Zend_Form_Element_Hidden('type_id');
        //$typeId->setRequired(true);
        $this->addElement($typeId);
        
        // Select
        $parentId = new Zend_Form_Element_Select('parent_id');
        $parentId->setLabel('ParentId');
        
        $mapper = new Application_Model_MenuMapper();
        $parentId->addMultiOption('', '');
        
        foreach ($mapper->fetchParentItems() as $item) {
            $parentId->addMultiOption($item->getId(), $item->getMenu());
        }
        
        $this->addElement($parentId);
        
        // Select
        $pageId = new Zend_Form_Element_Select('page_id');
        $pageId->setLabel('PageId');
        
        $mapperTextPage = new Application_Model_TextPageMapper();
        $pageId->addMultiOption('', '');
        
        foreach ($mapperTextPage->fetchAll(true) as $item) {
            $pageId->addMultiOption($item->getId(), $item->getTitle());
        }
        
        $this->addElement($pageId);
        
        $href = new Zend_Form_Element_Text('href');
        $href->setLabel('Href');
        $this->addElement($href);

        $bttn = new Zend_Form_Element_Submit('bttn');
        $bttn->setLabel('Submit');
        $this->addElement($bttn);
    }

}

