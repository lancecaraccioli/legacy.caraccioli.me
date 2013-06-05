<?php

class Core_Api_Auth_Adapter_Doctrine implements Zend_Auth_Adapter_Interface
{
	private $username;
	private $password;
	
	private $_column_map = array('username'=>'username', 'password'=>'password');
    /**
     * Sets username and password for authentication and remaps db column names if necessary
     *
     * @return void
     */
    public function __construct($username, $password = null, $column_map = array())
    {
        $this->username = $username;
        $this->password = $password;
        $this->_column_map['username'] = (is_array($column_map) && isset($column_map['username']))?$column_map['username']:$this->_column_map['username'];
        $this->_column_map['password'] = (is_array($column_map) && isset($column_map['password']))?$column_map['password']:$this->_column_map['password'];
    }

    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot
     *                                     be performed
     * @return Zend_Auth_Result
     */
    public function authenticate(){
        $user = Doctrine_Query::create()
        	->from('User_Model_User')
        	->where($this->_column_map['username'].' = ?', $this->username)
        	->addWhere($this->_column_map['password'].' = ?', md5($this->password))
	        ->execute()->toArray();
		
	    if (!empty($user)){
	    	$user = $user[0];
			if(array_key_exists('is_confirmed',$user)){
				if($user['is_confirmed']==0){
					return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, $this->username, array('NOT_CONFIRMED'));
				}
			} 
			return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->username, array());
	    } else {
	    	return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, $this->username, array('NOT_AUTHORIZED'));
	    }
    }
    
    public function userExists(){
        $user = Doctrine_Query::create()
        	->from('User_Model_User')
        	->where($this->_column_map['username'].' = ?', $this->username)
	        ->fetchOne();
	    if (!empty($user)){
	    	return true;
	    } else {
	    	return false;
	    }
    }
}
