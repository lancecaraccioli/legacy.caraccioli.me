<?php

require_once 'Zend/View/Helper/FormElement.php';

class Core_Api_View_Helper_FormMultiHidden extends Zend_View_Helper_FormElement
{
    public function formMultiHidden($name, $value = null, array $attribs = null)
    {
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable
        if (isset($id)) {
            if (isset($attribs) && is_array($attribs)) {
                $attribs['id'] = $id;
            } else {
                $attribs = array('id' => $id);
            }
        }
		$html='';
		if (is_array($value)){
			$firstElement=true;
			foreach($value as $key=>$val){
				if ($firstElement){
					$html.=$this->_hidden($name, $val, $attribs);
					unset($attribs['id']);
					$firstElement=false;
				}
				$html.=$this->_hidden($name, $val, $attribs);
			}
		} else {
			$html.=$this->_hidden($name, $value, $attribs);
		}
        return  $html;
    }
}
