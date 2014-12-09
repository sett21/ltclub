<?php

class Application_Model_MenuTypeMapper extends Application_Model_Mapper {

    public function __construct() {
        parent::__construct(new Application_Model_DbTable_MenuTypeTable());
    }

    /**
     * 
     * @param type $id
     * @param Application_Model_LeftMenu $entity
     * @return type
     */
    public function find($id, Application_Model_Proposal $entity) {

        $result = $this->getDbTable()->find($id);

        if (!count($result)) {
            return;
        }

        self::wrapper($entity, $result->current());
    }

    public function save(Application_Model_MenuType $entity) {

        $data = array(
            'type' => $entity->getType(),
        );

        if (is_null(($id = $entity->getId()))) { // Insert
            $this->getDbTable()->insert($data);
        } else { // Update
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
            $entity = new Application_Model_MenuType();
            self::wrapper($entity, $item);
            $items[] = $entity;
        }
        
        return $items;
    }

    private static function wrapper(Application_Model_MenuType $entity, $row) {
        $entity->setId($row->id);
        $entity->setType($row->type);
    }

}
