<?php
/**
 *
 * @category   Zend
 * @package    Core_Api_Form
 * @subpackage Element
 * @copyright  
 * @license    
 */

/** Zend_Form_Element_Xhtml */
require_once 'Zend/Form/Element/Text.php';

/**
 * "Robot Trap" form element
 * 
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 * @copyright  
 * @license    
 * @version    
 */
class Core_Api_Form_Element_RobotTrap extends Zend_Form_Element_Text
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formText';
    
    public function init(){
    	parent::init();
    	$this->addValidator(new Core_Api_Validate_RobotTrap());
	}
}
