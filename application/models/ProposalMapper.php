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
class Application_Model_ProposalMapper extends Application_Model_Mapper {
    const LIMIT = 3;

    public function __construct() {
        parent::__construct(new Application_Model_DbTable_ProposalTable());
    }

    /**
     * 
     * @param type $id
     * @param Application_Model_LeftMenu $entity
     * @return type
     */
    public function find($id, Application_Model_Proposal $entity) {

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
        self::wrapper($entity, $result);
    }

    public function save(Application_Model_Proposal $entity) {

        $data = array(
            'type_id' => $entity->getTypeId(),
            'preview' => $entity->getPreview(),
            'banner' => $entity->getBanner(),
            'keywords' => $entity->getKeywords(),
            'mdescription' => $entity->getMdescription(),
            'proposal' => $entity->getProposal(),
            'description' => $entity->getDescription(),
            'text' => $entity->getText(),
            'inclusion' => $entity->getInclusion(),
            'persons' => $entity->getPersons(),
            'deleted' => $entity->getDeleted()
        );

        if (is_null(($id = $entity->getId()))) { // Insert
            unset($data['deleted']);
            
            $data['uri'] = Application_Model_Mapper::titleToUrl($data['proposal']);
            $exists = new Application_Model_Proposal();
            
            do {
                $exists->find($data['uri']);

                if (!is_null($exists->getId())) {
                    $data['uri'] .= "_" . substr(sha1(time()), 5, 5);
                    continue;
                }
                
                break;
            } while (false);

            $this->getDbTable()->insert($data);
        } else { // Update
            //
            // Fix Empty Row
            if (empty($data['preview']) || is_null($data['preview'])) {
                unset($data['preview']);
            }

            // Fix Empty Row
            if (empty($data['banner']) || is_null($data['banner'])) {
                unset($data['banner']);
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
        return self::wrapperFetchAll($result);
    }

    /**
     * 
     * @return type
     */
    public function fetchAllWithoutDeleted() {
        $select = $this->getDbTable()->select();
        $select->where('deleted = ?', array('0'));
        $select->order('id DESC');
        $result = $this->getDbTable()->fetchAll($select);
        return self::wrapperFetchAll($result);
    }

    /**
     * 
     * @return type
     */
    public function fetchWithOutDeletedAndWithTypeAndLimitAndInclusion($limit = self::LIMIT, $offset = 0, $type = null, $inclusion = null) {
        $select = $this->getDbTable()->select();

        if (!is_null($type) && $type != 0) {
            $select->where('type_id = ?', array($type));
        }

        if (!is_null($inclusion) && $inclusion == 1) {
            $select->where('inclusion = ?', array($inclusion));
        }

        $select->where('deleted = ?', array('0'));
        $select->order('id DESC');
        $select->limit($limit, $offset);
        $result = $this->getDbTable()->fetchAll($select);
        return self::wrapperFetchAll($result);
    }

    /**
     * 
     * @return type
     */
    public function countWithDeleted($type = null, $inclusion = null) {
        $select = $this->getDbTable()->select();
        $select->from($this->getDbTable()->info('name'), 'COUNT(*) AS count');

        if (!is_null($type) && $type != 0) {
            $select->where('type_id = ?', array($type));
        }

        if (!is_null($inclusion) && $inclusion == 1) {
            $select->where('inclusion = ?', array($inclusion));
        }

        $select->where('deleted = ?', array('0'));

        $result = $this->getDbTable()->fetchRow($select);
        return $result->count;
    }

    public function findByLike($val) {
        $select = $this->getDbTable()->select();
        $column = $this->getDbTable()->getAdapter()->quoteIdentifier('proposal');
        $where = $this->getDbTable()->getAdapter()->quoteInto("$column LIKE ?", '%' . $val . '%');
        
        $select->where($where);
        $select->where('deleted = "0"');
        
        $result = $this->getDbTable()->fetchAll($select);
        
        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_Proposal();
            self::wrapper($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }
    
    private static function wrapperFetchAll($result) {
        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_Proposal();
            self::wrapper($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }

    private static function wrapper(Application_Model_Proposal $entity, $row) {
        $entity->setId($row->id);
        $entity->setTypeId($row->type_id);
        $entity->setPreview($row->preview);
        $entity->setBanner($row->banner);
        $entity->setKeywords($row->keywords);
        $entity->setMdescription($row->mdescription);
        $entity->setProposal($row->proposal);
        $entity->setDescription($row->description);
        $entity->setText($row->text);
        $entity->setInclusion($row->inclusion);
        $entity->setPersons($row->persons);
        $entity->setUri($row->uri);
        $entity->setDeleted($row->deleted);
    }

}
