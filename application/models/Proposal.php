<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proposal
 *
 * @author shykor
 */
class Application_Model_Proposal {

    protected $id;
    protected $type_id;
    protected $preview;
    protected $banner;
    protected $keywords;
    protected $mdescription;
    protected $proposal;
    protected $description;
    protected $text;
    protected $inclusion;
    protected $persons;
    protected $uri;
    protected $deleted;
    private $mapper;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTypeId() {
        return $this->type_id;
    }

    public function setTypeId($typeId) {
        $this->type_id = $typeId;
    }

    public function getPreview() {
        return $this->preview;
    }

    public function setPreview($preview) {
        $this->preview = $preview;
    }

    public function getBanner() {
        return $this->banner;
    }

    public function setBanner($banner) {
        $this->banner = $banner;
    }

    public function getKeywords() {
        return !is_null($this->keywords) ? $this->keywords : '';
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function getMdescription() {
        return !is_null($this->mdescription) ? $this->mdescription : '';
        
    }

    public function setMdescription($mdescription) {
        $this->mdescription = $mdescription;
    }

    public function getProposal() {
        return $this->proposal;
    }

    public function setProposal($proposal) {
        $this->proposal = $proposal;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getInclusion() {
        return $this->inclusion;
    }

    public function setInclusion($inclusion) {
        $this->inclusion = $inclusion;
    }

    public function getPersons() {
        return $this->persons;
    }

    public function setPersons($persons) {
        $this->persons = $persons;
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
            $this->mapper = new Application_Model_ProposalMapper();
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
