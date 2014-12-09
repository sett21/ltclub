<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextPage
 *
 * @author shykor
 */
class Application_Model_TextPage {

    protected $id;
    protected $keywords;
    protected $description;
    protected $title;
    protected $text;
    protected $uri;
    protected $deleted;
    private $mapper;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getKeywords() {

        if (is_null($this->keywords)) {
            return '';
        }

        return $this->keywords;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function getDescription() {

        if (is_null($this->description)) {
            return '';
        }

        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getUri() {
        return $this->uri;
    }

    public function setUri($uri) {
        $this->uri = $uri;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function getMapper() {

        if (is_null($this->mapper)) {
            $this->mapper = new Application_Model_TextPageMapper();
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
