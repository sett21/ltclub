<?php

class Application_Model_SocialMapper extends Application_Model_Mapper {

    public function __construct() {
        parent::__construct(new Application_Model_DbTable_SocialTable());
    }

    /**
     * 
     * @param type $id
     * @param Application_Model_LeftMenu $entity
     * @return type
     */
    public function find($id, Application_Model_Social $entity) {

        $result = $this->getDbTable()->find($id);

        if (!count($result)) {
            return;
        }

        self::wrapper($entity, $result->current());
    }

    public function save(Application_Model_Social $entity) {

        $data = array(
            'social' => $entity->getSocial(),
            'img' => $entity->getImg(),
            'href' => $entity->getHref(),
        );

        if (is_null(($id = $entity->getId()))) {
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

            $entity = new Application_Model_Social();
            self::wrapper($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }

    private static function wrapper(Application_Model_Social $entity, $row) {
        $entity->setId($row->id);
        $entity->setSocial($row->social);
        $entity->setImg($row->img);
        $entity->setHref($row->href);
    }

}

