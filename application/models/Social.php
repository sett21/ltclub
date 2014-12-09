<?php

class Application_Model_Social {

    public $id;
    public $social;
    public $img;
    public $href;
    private $mapper;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getSocial() {
        return $this->social;
    }

    public function setSocial($social) {
        $this->social = $social;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
    }

    public function getHref() {
        return $this->href;
    }

    public function setHref($href) {
        $this->href = $href;
    }

    public function getMapper() {

        if (is_null($this->mapper)) {
            $this->mapper = new Application_Model_SocialMapper();
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

