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
class Core_Api_View_Helper_FormDate extends Zend_View_Helper_FormElement
{
    /**
     * Generates a 'date' element.
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
    public function formDate($name, $value = null, $attribs = null)
    {
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable

        // build the element
        $disabled = '';
        if ($disable) {
            // disabled
            $disabled = ' disabled="disabled"';
        }
        
        // XHTML or HTML end tag?
        $endTag = ' />';
        if (($this->view instanceof Zend_View_Abstract) && !$this->view->doctype()->isXhtml()) {
            $endTag= '>';
        }
        
        $date = '';
        if ($timestamp = strtotime($value)){
            $date = date('M jS Y', $timestamp);
        } else {
        	$date = $value;//values that fail validation still need to be returned to the form view
        }
        
        $xhtml = '<input type="text"'
				. ' class="formDate"'
                . ' name="' . $this->view->escape($name) . '"'
                . ' id="' . $this->view->escape($id) . '"'
                . ' value="' . $date . '"'
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $endTag;

        return $xhtml;
    }
}
