
<?php
require_once 'Zend/Validate/Abstract.php';

class Core_Api_Validate_Date extends Zend_Validate_Abstract {
    const NOT_DATE = 'valueNotDate';

    protected $_messageTemplates = array(
        self::NOT_DATE => 'Value is not a valid date.'
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
     * This method will use php's strtotime function to determine if the given string is a valid date
     *
     * @param $value string representing a date
     * @param $context array All other elements from the form
     * @return boolean Returns true if the element is a valid date
     */
    public function isValid($value, $context = null) {
        $error = false;
        $timestamp = strtotime($value);
        if (!$timestamp){
            $this->_error(self::NOT_DATE);
            $error = true;
        } else {
            $this->_setValue(date('Y-m-d h:i:s', $timestamp));   
        }
        return !$error;
    }
}
