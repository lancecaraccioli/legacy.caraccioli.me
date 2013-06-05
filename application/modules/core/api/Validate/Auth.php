<?php
require_once 'Zend/Validate/Abstract.php';

class Core_Api_Validate_Auth extends Zend_Validate_Abstract {
	const NOT_CONFIRMED = 'notConfirmed';
    const NOT_AUTHORIZED = 'notAuthorized';
	const UNKNOWN_ERROR = 'unknownError';

    protected $_messageTemplates = array(
        self::NOT_AUTHORIZED => 'The username and password provided do not match an authorized user.',
        self::NOT_CONFIRMED => 'Your account is valid, but you have not confirmed your email address. (See link below to have another confirmation email sent to you.)',
        self::UNKNOWN_ERROR => 'We were not able to log you in due to a possible error in our system.'		
    );
    
    /**
     * The field names of the form that will be used for validation purposes
     * 
	 */
    protected $_elementNames = array('username'=>'username', 'password'=>'password');


    /**
     * Constructor of this validator
     *
     * The argument to this constructor is the third argument to the elements' addValidator
     * method.
     *
     * @param array|string $fieldsToMatch
     */
    public function __construct($fields = array()) {
    	
    	//die('constructing new Custom Validate Auth object');
		if (is_array($fields)){
			$this->_elementNames['username']=isset($fields['username'])?$fields['username']:$this->_elementNames['username'];
			$this->_elementNames['password']=isset($fields['password'])?$fields['password']:$this->_elementNames['password'];
		}
		//Zend_Debug::dump($this->_elementNames);die();
    }

    /**
     * Check if the element using this validator is valid
     *
     * This method will use the context to make sure that the username and password is one of an authorized user
     *
	 * @param $value string - this is of no concern to us as we are looking for Zend_Auth authorization of the form
     * @param $context array All other elements from the form
     * @return boolean Returns true if the element is valid
     */
    public function isValid($value, $context = null) {
    	//die('attempting to validate authorization');
		$error=false;
		// Get a reference to the singleton instance of Zend_Auth
		$auth = Zend_Auth::getInstance();
		// Set up the authentication adapter
		$authAdapter = new Core_Api_Auth_Adapter_Doctrine($context[$this->_elementNames['username']], $context[$this->_elementNames['password']], array('username'=>'email'));
		// Attempt authentication, saving the result
		$result = $auth->authenticate($authAdapter);
		if (!$result->isValid()) {
			$messages = $result->getMessages();
			$message = eval('return (self::'.$messages[0].');') ? eval('return (self::'.$messages[0].');') : 'NO';
		    $error=true;
		    $this->_error($message);
		} else {
			// user name password stored in session by Zend_Auth
		}
        return !$error;
    }
}
