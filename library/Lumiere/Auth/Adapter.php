<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adapter
 *
 * @author Judzhin Miles
 */
class Lumiere_Auth_Adapter implements Zend_Auth_Adapter_Interface {

    private $username, $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
     * @return Zend_Auth_Result
     */
    public function authenticate() {

        $user = new stdClass();
        $user->username = $this->username;

        $code = Zend_Auth_Result::FAILURE;
        
        $data = new Zend_Config_Ini(sprintf('%s/authenticate.ini', APPLICATION_PATH), APPLICATION_ENV);
        $data = $data->toArray();
        $authenticate = $data['authenticate'];
        
        if ($authenticate['username'] == $this->username && $authenticate['password'] == md5($this->password)) {
            $code = Zend_Auth_Result::SUCCESS;
        }

//        Zend_Debug::dump(array(
//            'password' => $authenticate['password'],
//            'md5' => md5($this->password)
//        ));
        
        return new Zend_Auth_Result($code, $user);
    }

}
