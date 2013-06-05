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
class Core_Api_View_Helper_FormPhone extends Zend_View_Helper_FormElement
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
    public function formPhone($name, $value = null, $attribs = null)
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
        
        $areaCode = substr($value, 0,3);
        $prefix = substr($value, 3, 3);
        $line = substr($value, 6, 4);
        
		$xhtml = ($info['attribs']['parentheses']) ? "<span>".$info['attribs']['openParentheses']."</span>" : "";
		
        $xhtml .= '<input type="text"'
				. ' class="us-phone us-phone-areacode"'
				. ' maxlength = "3"'
                . ' name="' . $this->view->escape($name) . '[areacode]"'
                . ' id="' . $this->view->escape($id) . '-areacode"'
                . ' value="' . $this->view->escape($areaCode) . '"'
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $endTag;
                
		$xhtml .= ($info['attribs']['parentheses']) ? "<span>".$info['attribs']['closeParentheses']."</span>" : "";

        $xhtml .= '<input type="text"'
				. ' class="us-phone us-phone-prefix"'
				. ' maxlength = "3"'
                . ' name="' . $this->view->escape($name) . '[prefix]"'
                . ' id="' . $this->view->escape($id) . '-prefix"'
                . ' value="' . $this->view->escape($prefix) . '"'
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $endTag;
                
		$xhtml .= ($info['attribs']['separator']) ? "<span>".$info['attribs']['separatorString']."</span>" : "";

        $xhtml .= '<input type="text"'
				. ' class="us-phone us-phone-line"'
				. ' maxlength = "4"'
                . ' name="' . $this->view->escape($name) . '[line]"'
                . ' id="' . $this->view->escape($id) . '-line"'
                . ' value="' . $this->view->escape($line) . '"'
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $endTag;


        return $xhtml;
    }
}
