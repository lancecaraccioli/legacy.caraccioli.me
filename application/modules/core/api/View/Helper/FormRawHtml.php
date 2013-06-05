<?php
/**
 * @category   Zend
 * @package    Core_Api_View
 * @subpackage Helper
 * @copyright 
 * @license   
 */


/**
 * Abstract class for extension
 */
require_once 'Zend/View/Helper/FormElement.php';


/**
 * Helper to generate a "phone" element
 *
 * @category   Zend
 * @package    Core_Api_View
 * @subpackage Helper
 * @copyright  
 * @license    
 */
class Core_Api_View_Helper_FormRawHtml extends Zend_View_Helper_FormElement
{
    /**
     * Generates a 'phone' element.
     *
     * @access public
     *
     * @param string|array $name If a string, the element name.  If an
     * array, all other parameters are ignored, and the array elements
     * are used in place of added parameters.
     *
     * @param mixed $value The element value.
     *
     * @param array $attribs Attributes for the element tag.
     *
     * @return string The element XHTML.
     */
    public function formRawHtml($name, $value = null, $attribs = null)
    {
        
        $xhtml = '<span class="custom-form-element-raw-html">';
        $xhtml .= $value;
        $xhtml .= '</span>';

        return $xhtml;
    }
}
