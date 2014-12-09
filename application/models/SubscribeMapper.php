<?php

class Application_Model_SubscribeMapper extends Application_Model_Mapper {

    public function __construct() {
        parent::__construct(new Application_Model_DbTable_SubscribeTable());
    }

    /**
     * 
     * @param type $id
     * @param Application_Model_LeftMenu $entity
     * @return type
     */
    public function find($id, Application_Model_Subscribe $entity) {

        $select = $this->getDbTable()->select();
        $select->where('(id = ? OR subscribe = ?) AND deleted = "0"', $id);

        $result = $this->getDbTable()->fetchRow($select);

        if (!count($result)) {
            return;
        }

        self::fill($entity, $result);
    }

    public function save(Application_Model_Subscribe $entity) {

        $data = array(
            'subscribe' => $entity->getSubscribe(),
            'active' => $entity->getActive(),
            'deleted' => $entity->getDeleted()
        );

        if (is_null(($id = $entity->getId()))) {

            unset($data['active']);
            unset($data['deleted']);

            $subscribe = new Application_Model_Subscribe();
            $subscribe->find($data['subscribe']);

            if (is_null($subscribe->getId())) {

                $mail = new Zend_Mail('UTF-8');
                $str = sprintf('http://%s/subscribe/?email=%s&token=%s', $_SERVER['HTTP_HOST'], $data['subscribe'], md5(time()));
                $mail->setBodyText(sprintf('Вы подписались  на рассылку новостей от кампании Lumière Travel CLub, для подтверждения регистрации пройдите по ссылке %s', $str));
                $mail->setFrom('test@msbios.com', 'Some Sender');
                $mail->addTo($data['subscribe'], 'Some Recipient');
                $mail->setSubject('TestSubject');
                $mail->send();

                $this->getDbTable()->insert($data);
            }
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    /**
     * 
     * @return type
     */
    public function fetchAll($activate = false, $deleted = false) {

        $select = $this->getDbTable()->select();

        if ($activate) {
            $select->where('active = ?', array('1'));
        }

        if ($deleted) {
            $select->where('deleted = ?', array('0'));
        }

        $result = $this->getDbTable()->fetchAll($select);

        $items = array();

        foreach ($result as $item) {

            $entity = new Application_Model_Subscribe();
            self::fill($entity, $item);
            $items[] = $entity;
        }

        return $items;
    }

    private static function fill(Application_Model_Subscribe $entity, $row) {
        $entity->setId($row->id);
        $entity->setSubscribe($row->subscribe);
        $entity->setActive($row->active);
        $entity->setDeleted($row->deleted);
    }

}
