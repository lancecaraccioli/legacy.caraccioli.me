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
class Core_Api_View_Helper_FormLink extends Zend_View_Helper_FormElement
{
    /**
     * Generates an <a> tag with the elements value set as the value of the href attribute
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
    public function formLink($name, $value = null, $attribs = null, $options = null)
    {
    	$info = $this->_getInfo($name, $value, $attribs, $options);
        $target =   isset($info['attribs']['linkTarget'])?' target="'.$info['attribs']['linkTarget'].'"':'';
        $linkText = isset($info['attribs']['linkText'])?$info['attribs']['linkText']:$value;
        $href = isset($info['attribs']['linkHref'])?$info['attribs']['linkHref']:$value;
        $xhtml = !empty($href)?'<a'.$target.' class="custom-form-element-link" href="'.$href.'">'.$linkText.'</a>':'';

        return $xhtml;
    }
}
