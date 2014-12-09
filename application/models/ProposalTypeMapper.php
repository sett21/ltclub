<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LeftMenuMapper
 *
 * @author shykor
 */
class Application_Model_ProposalTypeMapper extends Application_Model_Mapper {

    public function __construct() {
        parent::__construct(new Application_Model_DbTable_ProposalTypeTable());
    }

    /**
     * 
     * @param type $id
     * @param Application_Model_LeftMenu $entity
     * @return type
     */
    public function find($id, Application_Model_ProposalType $entity) {

        $result = $this->getDbTable()->find($id);

        if (!count($result)) {
            return;
        }

        self::wrapper($entity, $result->current());
    }

    public function save(Application_Model_ProposalType $entity) {

        $data = array(
            'type' => $entity->getType(),
            'deleted' => $entity->getDeleted()
        );

        if (is_null(($id = $entity->getId()))) {
            unset($data['deleted']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    /**
     * 
     * @return type
     */
    public function fetchAll() {

        $result = $this->getDbTable()->fetchAll();

        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_ProposalType();
            self::wrapper($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }

    /**
     * 
     * @return type
     */
    public function fetchAllWithOutDeleted() {
        $select = $this->getDbTable()->select();
        $select->where('deleted = ?', array('0'));
        $result = $this->getDbTable()->fetchAll($select);

        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_ProposalType();
            self::wrapper($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }
//
//    public function fetchParentItems() {
//        $select = $this->getDbTable()->select();
//        $select->where('parent_id IS NULL');
//        $result = $this->getDbTable()->fetchAll($select);
//
//        $items = array();
//
//        foreach ($result as $item) {
//
//            $entity = new Application_Model_LeftMenu();
//            self::wrapper($entity, $item);
//            $items[] = $entity;
//        }
//
//        return $items;
//    }

    private static function wrapper(Application_Model_ProposalType $entity, $row) {
        $entity->setId($row->id);
        $entity->setType($row->type);
        $entity->setDeleted($row->deleted);
    }

}
