
<?php
require_once 'Zend/Validate/Abstract.php';

class Core_Api_Validate_USAState extends Zend_Validate_Abstract {
    const NOT_USA_STATE = 'notUSAState';

    protected $_messageTemplates = array(
        self::NOT_USA_STATE => 'The value you entered does not match a USA state.'
    );

    /**
     * The united states
     *
     * @var array
     */
    public static $_usaStates = array(
        'AL'=>'AL - Alabama',
        'AK'=>'AK - Alaska',
        'AZ'=>'AZ - Arizona',
        'AR'=>'AR - Arkansas',
        'CA'=>'CA - California',
        'CO'=>'CO - Colorado',
        'CT'=>'CT - Connecticut',
        'DE'=>'DE - Delaware',
        'DC'=>'DC - District of Columbia',
        'FL'=>'FL - Florida',
        'GA'=>'GA - Georgia',
        'HI'=>'HI - Hawaii',
        'ID'=>'ID - Idaho',
        'IL'=>'IL - Illinois',
        'IN'=>'IN - Indiana',
        'IA'=>'IA - Iowa',
        'KS'=>'KS - Kansas',
        'KY'=>'KY - Kentucky',
        'LA'=>'LA - Louisiana',
        'ME'=>'ME - Maine',
        'MD'=>'MD - Maryland',
        'MA'=>'MA - Massachusetts',
        'MI'=>'MI - Michigan',
        'MN'=>'MN - Minnesota',
        'MS'=>'MS - Mississippi',
        'MO'=>'MO - Missouri',
        'MT'=>'MT - Montana',
        'NE'=>'NE - Nebraska',
        'NV'=>'NV - Nevada',
        'NH'=>'NH - New Hampshire',
        'NJ'=>'NJ - New Jersey',
        'NM'=>'NM - New Mexico',
        'NY'=>'NY - New York',
        'NC'=>'NC - North Carolina',
        'ND'=>'ND - North Dakota',
        'OH'=>'OH - Ohio',
        'OK'=>'OK - Oklahoma',
        'OR'=>'OR - Oregon',
        'PA'=>'PE - Pennsylvania',
        'RI'=>'RI - Rhode Island',
        'SC'=>'SC - South Carolina',
        'SD'=>'SD - South Dakota',
        'TN'=>'TN - Tennessee',
        'TX'=>'TX - Texas',
        'UT'=>'UT - Utah',
        'VT'=>'VT - Vermont',
        'VA'=>'VA - Virginia',
        'WA'=>'WA - Washington',
        'WV'=>'WV - West Virginia',
        'WI'=>'WI - Wisconsin',
        'WY'=>'WY - Wyoming',
    );

    /**
     * Constructor of this validator
     *
     * The argument to this constructor is the third argument to the elements' addValidator, but is not used for this validator
     * method.
     *
	 * @param array|string $args - not used
     */
    public function __construct($args = array()) {
    }

    /**
     * Check if the element using this validator is valid
     *
     * This method will compare the $value of the element to possible values in the united states array
     * if the value matches a valid united state then it returns true
     *
     * @param $value string
     * @param $context array All other elements from the form
     * @return boolean Returns true if the element is valid
     */
    public function isValid($value, $context = null) {
		$error = false;
        $value = (string) $value;
        $this->_setValue($value);
        if(!isset(self::$_usaStates[$value])){
        	$this->_error(self::NOT_USA_STATE);
        	$error = true;
        }
        return !$error;
    }
}
