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
 * Phone form element
 * 
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 * @copyright  
 * @license    
 * @version    
 */
class Core_Api_Form_Element_Date extends Zend_Form_Element_Text
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formDate';
    
    public function init(){
    	$this->addValidator(new Core_Api_Validate_Date());
    	parent::init();
    }
    
    public function setValue($value){
        $timestamp = strtotime($value);
    	if ($timestamp){
    		$value = date('Y-m-d H:i:s', $timestamp);
    	}
    	return parent::setValue($value);
    }
}
