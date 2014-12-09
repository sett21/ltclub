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
class Application_Model_MenuMapper {
    const TOP = 1;
    const LEFT = 2;
    const BOTTOM = 3;

    /**
     *
     * @var type 
     */
    private $dbTable;

    /**
     * 
     * @return type
     */
    public function getDbTable() {

        if (is_null($this->dbTable)) {
            $this->setDbTable(new Application_Model_DbTable_MenuTable());
        }

        return $this->dbTable;
    }

    /**
     * 
     * @param type $dbTable
     * @return \Application_Model_MenuMapper
     * @throws Exception
     */
    public function setDbTable($dbTable) {

        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }

        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }

        $this->dbTable = $dbTable;
        return $this;
    }

    /**
     * 
     * @param type $id
     * @param Application_Model_Menu $entity
     * @return type
     */
    public function find($id, Application_Model_Menu $entity) {

        $result = $this->getDbTable()->find($id);

        if (!count($result)) {
            return;
        }

        self::wrapper($entity, $result->current());
    }

    public function save(Application_Model_Menu $entity) {

        $data = array(
            'type_id' => $entity->getTypeId(),
            'parent_id' => $entity->getParentId(),
            'menu' => $entity->getMenu(),
            'page_id' => $entity->getTextpageId(),
            'href' => $entity->getHref(),
            'deleted' => $entity->getDeleted()
        );

        if (is_null(($id = $entity->getId()))) {

            if (empty($data['parent_id'])) {
                unset($data['parent_id']);
            }

            if (empty($data['textpage_id'])) {
                unset($data['textpage_id']);
            }

            unset($data['deleted']);

            $this->getDbTable()->insert($data);
        } else {

            if (empty($data['parent_id'])) {
                $data['parent_id'] = new Zend_Db_Expr('null');
            }

            if (empty($data['page_id'])) {
                $data['page_id'] = new Zend_Db_Expr('null');
            }

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

            $entity = new Application_Model_Menu();
            self::wrapper($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }

    /**
     * 
     * @return type
     */
    public function fetchByType($type, $deleted = false) {
        $select = $this->getDbTable()->select();
        $select->setIntegrityCheck(false);

        $select->from(array('l' => $this->getDbTable()->info('name')));
        $select->joinLeft(array('t' => 'lm_textpage'), 't.id = l.page_id', array('t.uri'));
        $select->where('l.type_id = ?', array($type));
        
        if ($deleted) {
            $select->where('l.deleted = ?', array('0'));
        }

        $result = $this->getDbTable()->fetchAll($select);

        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_Menu();
            self::wrapper($entity, $item);
            $entity->uri = $item->uri;
            $items[] = $entity;
        }

        return $items;
    }

    public function fetchParentItems() {
        $select = $this->getDbTable()->select();
        $select->where('parent_id IS NULL');
        $result = $this->getDbTable()->fetchAll($select);

        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_Menu();
            self::wrapper($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }

    private static function wrapper(Application_Model_Menu $entity, $row) {
        $entity->setId($row->id);
        $entity->setParentId($row->parent_id);
        $entity->setTypeId($row->type_id);
        $entity->setMenu($row->menu);
        $entity->setTextpageId($row->page_id);
        $entity->setHref($row->href);
        $entity->setDeleted($row->deleted);
    }

}
