<?php

class Application_Model_Service {

    public $id;
    public $service;
    public $textpage_id;
    public $deleted;
    private $mapper;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getService() {
        return $this->service;
    }

    public function setService($service) {
        $this->service = $service;
    }

    public function getTextpageId() {
        return $this->textpage_id;
    }

    public function setTextpageId($textpageId) {
        $this->textpage_id = $textpageId;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function getMapper() {

        if (is_null($this->mapper)) {
            $this->mapper = new Application_Model_ServiceMapper();
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

