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
class Core_Api_Form_Element_Link extends Zend_Form_Element_Xhtml
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $linkText = '';
    public $linkTarget = '';
    public $helper = 'formLink';
    
    public function setLinkText($text){
    	$this->linkText = $text;
    	return $this;	
    }
    public function setTarget($target){
    	$this->linkTarget = $target;	
    	return $this;
    }
    public function setHref($href){
    	$this->linkHref = $href;	
    	return $this;
    }
    
    /*protected function _getInfo($name, $value = null, $attribs = null, $options = null, $listsep = null){
    	if (!isset($options['linkText']) && !empty($this->linkText)){
    		$options['linkText']=$this->linkText;
    	}
    	if (!isset($attribs['target']) && !empty($this->linkTarget)){
    		$attribs['target']=$this->linkTarget;
    	}
    	$info = parent::_getInfo($name, $value, $attribs, $options, $listsep);
    	return $info;
    }*/
}
