<?php

class Application_Model_ServiceMapper extends Application_Model_Mapper {

    public function __construct() {
        parent::__construct(new Application_Model_DbTable_ServiceTable());
    }

    /**
     * 
     * @param type $id
     * @param Application_Model_LeftMenu $entity
     * @return type
     */
    public function find($id, Application_Model_Service $entity) {

        $result = $this->getDbTable()->find($id);

        if (!count($result)) {
            return;
        }

        self::wrapper($entity, $result->current());
    }

    public function save(Application_Model_Service $entity) {

        $data = array(
            'service' => $entity->getService(),
            'textpage_id' => $entity->getTextpageId(),
            'deleted' => $entity->getDeleted(),
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

            $entity = new Application_Model_Service();
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
        $select->setIntegrityCheck(false);

        $select->from(array('s' => 'lm_service'));
        $select->joinLeft(array('t' => 'lm_textpage'), 't.id = s.textpage_id', array('t.uri'));

        $select->where('s.deleted = ?', array('0'));

        //die($select->assemble());

        $result = $this->getDbTable()->fetchAll($select);

        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_Service();
            self::wrapper($entity, $item);
            $entity->uri = $item->uri;
            $items[] = $entity;
        }

        return $items;
    }

    private static function wrapper(Application_Model_Service $entity, $row) {
        $entity->setId($row->id);
        $entity->setService($row->service);
        $entity->setTextpageId($row->textpage_id);
        $entity->setDeleted($row->deleted);
    }

}

