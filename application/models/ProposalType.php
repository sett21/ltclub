<?php

class Application_Model_ProposalType {

    public $id;
    public $type;
    public $deleted;
    private $mapper;

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

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function getMapper() {

        if (is_null($this->mapper)) {
            $this->mapper = new Application_Model_ProposalTypeMapper();
        }

        return $this->mapper;
    }

    public function find($id) {
        $this->getMapper()->find($id, $this);
    }

    public function save() {
        $this->getMapper()->save($this);
    }

}