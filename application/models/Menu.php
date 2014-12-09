<?php

class Application_Model_Menu implements ArrayAccess {

    protected $id;
    protected $parent_id;
    protected $type_id;
    protected $menu;
    protected $textpage_id;
    protected $href;
    protected $deleted;
    protected $mapper;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getParentId() {
        return $this->parent_id;
    }

    public function setParentId($parentId) {
        $this->parent_id = $parentId;
    }

    public function getTypeId() {
        return $this->type_id;
    }

    public function setTypeId($type_id) {
        $this->type_id = $type_id;
    }

    public function getMenu() {
        return $this->menu;
    }

    public function setMenu($leftmenu) {
        $this->menu = $leftmenu;
    }

    public function getTextpageId() {
        return $this->textpage_id;
    }

    public function setTextpageId($textpage_id) {
        $this->textpage_id = $textpage_id;
    }

    public function getHref() {
        return $this->href;
    }

    public function setHref($href) {
        $this->href = $href;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function offsetSet($offset, $value) {
        if ($this->offsetExists($offset)) {
            $this->$offset = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->$offset);
    }

    public function offsetUnset($offset) {
        return null;
    }

    public function offsetGet($offset) {

        if ($this->offsetExists($offset)) {
            return $this->$offset;
        }

        return null;
    }

    /**
     * 
     * @param type $id
     */
    public function find($id) {
        $this->getMapper()->find($id, $this);
    }

    /**
     * 
     * @return type
     */
    public function getMapper() {

        if (is_null($this->mapper)) {
            $this->mapper = new Application_Model_MenuMapper();
        }

        return $this->mapper;
    }

    public function save() {
        $this->getMapper()->save($this);
    }

}