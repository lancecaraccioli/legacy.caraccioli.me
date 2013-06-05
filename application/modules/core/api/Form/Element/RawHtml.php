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
class Core_Api_Form_Element_RawHtml extends Zend_Form_Element_Xhtml
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formRawHtml';
}
