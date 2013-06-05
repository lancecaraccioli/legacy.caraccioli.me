
<?php
require_once 'Zend/Validate/Abstract.php';

class Core_Api_Validate_RobotTrap extends Zend_Validate_Abstract {
    const NOT_EMPTY = 'valueNotEmpty';

    protected $_messageTemplates = array(
        self::NOT_EMPTY => 'NOT_EMPTY'
    );
    /**
     * Constructor of this validator
     *
     * The argument to this constructor is the third argument to the elements' addValidator
     * method.
     *
     * @param array|string $fieldsToMatch
     */
    public function __construct($params = array()) {
        
    }

    /**
     * Check if the element using this validator is valid
     *
     * This method will simply return an error if the field is not empty (it is empty by default, and is hidden by CSS, thus should be empty unless a robot is filling in the form
     *
     * @param $value string
     * @param $context array All other elements from the form
     * @return boolean Returns true if the element is empty
     */
    public function isValid($value, $context = null) {
        $error = false;
        if (strlen($value)>0){
            $this->_error(self::NOT_EMPTY);
            $error = true;
        }
        return !$error;
    }
}
