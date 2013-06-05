
<?php
require_once 'Zend/Validate/Abstract.php';

class Core_Api_Validate_Auth_Exists extends Zend_Validate_Abstract {
    const AUTH_EXISTS = 'authExists';

    protected $_messageTemplates = array(
        self::AUTH_EXISTS => 'This username already exists.  Please choose another username or login with your current username.'
    );
    
    /**
     * Te field names of the form that will be used to create a new user name and password
     * 
	 */
    protected $_elementNames = array('username'=>'username');


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
		}
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
    	//die('attempting to check if this username already exists');
		$error=false;
		// Get a reference to the singleton instance of Zend_Auth
		$auth = Zend_Auth::getInstance();
		// Set up the authentication adapter
		$authAdapter = new Core_Api_Auth_Adapter_Doctrine($context[$this->_elementNames['username']], null, array('username'=>'email'));
		// check to see if the user exists
		if ($authAdapter->userExists()) {
		    $error=true;
		    $this->_error(self::AUTH_EXISTS);
		}
        return !$error;
    }
}
