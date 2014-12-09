<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextPageMapper
 *
 * @author shykor
 */
class Application_Model_TextPageMapper extends Application_Model_Mapper {

    public function __construct() {
        parent::__construct(new Application_Model_DbTable_TextPageTable());
    }

    /**
     * 
     * @param type $id
     * @param Application_Model_LeftMenu $entity
     * @return type
     */
    public function find($id, Application_Model_TextPage $entity) {

        $select = $this->getDbTable()->select();
        $select->where('id = ? OR uri = ?', $id);

        //echo $select->assemble();
        //die();
        //$result = $this->getDbTable()->find($id);
        $result = $this->getDbTable()->fetchRow($select);


        if (!count($result)) {
            return;
        }

        //self::wrapper($entity, $result->current());
        self::fill($entity, $result);
    }

    public function save(Application_Model_TextPage $entity) {

        $data = array(
            'keywords' => $entity->getKeywords(),
            'description' => $entity->getDescription(),
            'title' => $entity->getTitle(),
            'text' => $entity->getText(),
            'deleted' => $entity->getDeleted()
        );

        if (is_null(($id = $entity->getId()))) {
            unset($data['deleted']);
            $data['uri'] = Application_Model_Mapper::titleToUrl($data['title']);
            $this->getDbTable()->insert($data);
        } else {

            if (empty($data['keywords']) || is_null($data['keywords'])) {
                $data['keywords'] = new Zend_Db_Expr('null');
            }

            if (empty($data['description']) || is_null($data['description'])) {
                $data['description'] = new Zend_Db_Expr('null');
            }

            //$data['uri'] = self::nameToUrlTitle($data['title']);

            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    /**
     * 
     * @return type
     */
    public function fetchAll($deleted = false) {

        $select = $this->getDbTable()->select();
        if ($deleted) {
            $select->where('deleted = ?', array('0'));
        }
        $result = $this->getDbTable()->fetchAll($select);
        return self::fillAll($result);
    }

    private static function fillAll($result) {
        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_TextPage();
            self::fill($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }

    private static function fill(Application_Model_TextPage $entity, $row) {
        $entity->setId($row->id);
        $entity->setKeywords($row->keywords);
        $entity->setDescription($row->description);
        $entity->setTitle($row->title);
        $entity->setText($row->text);
        $entity->setDeleted($row->deleted);
    }

}
