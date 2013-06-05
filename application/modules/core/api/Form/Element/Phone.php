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
require_once 'Zend/Form/Element/Xhtml.php';

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
class Core_Api_Form_Element_Phone extends Zend_Form_Element_Xhtml
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formPhone';
	public $parentheses = true;
	public $openParentheses = '(';
	public $closeParentheses = ')';
	public $separator = true;
	public $separatorString = '-';
    
    public function init(){
    	$this->addValidator(new Zend_Validate_Regex('/^[0-9]*$/'));
    	parent::init();
    }
    
    public function setValue($value){
    	if (is_array($value)){
    		$value = implode($value);
    		$value = substr($value, 0,10);
    	}
    	return parent::setValue($value);
    }
	
	public function setParentheses($active = true, $open = '(', $close = ')'){
		$this->parentheses = $active;
		$this->openParentheses = $open;
		$this->closeParentheses = $close;
		return $this;
	}
	
	public function setSeparator($active = true, $separatorString = '-'){
		$this->separator = $active;
		$this->separatorString = $separatorString;
		return $this;
	}	
}
