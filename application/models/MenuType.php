<?php

class Application_Model_MenuType {

    public $id;
    public $type;
    private static $mapper;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getMapper() {

        if (is_null(self::$mapper)) {
            self::$mapper = new Application_Model_MenuTypeMapper();
        }

        return self::$mapper;
    }

    public function find($id) {
        $this->getMapper()->find($id, $this);
    }
    
    public function save() {
        $this->getMapper()->save($this);
    }
}

