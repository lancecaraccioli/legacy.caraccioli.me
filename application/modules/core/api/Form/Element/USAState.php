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
require_once 'Zend/Form/Element/Select.php';

/**
 * Phone form element
 * 
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 * @copyright  
 * @license    
 * @version    
 */
class Core_Api_Form_Element_USAState extends Zend_Form_Element_Select
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formSelect';
    
    public function init(){
    	parent::init();
    	$this->addValidator(new Core_Api_Validate_USAState());
    	$this->addMultiOptions(array(''=>'choose...') + Core_Api_Validate_USAState::$_usaStates);
    }
}
