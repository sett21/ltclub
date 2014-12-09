<?php

class Application_Model_Subscribe {

    public $id;
    public $subscribe;
    public $active;
    public $deleted;
    private static $mapper;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getSubscribe() {
        return $this->subscribe;
    }

    public function setSubscribe($subscribe) {
        $this->subscribe = $subscribe;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function getMapper() {

        if (is_null(self::$mapper)) {
            self::$mapper = new Application_Model_SubscribeMapper();
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

