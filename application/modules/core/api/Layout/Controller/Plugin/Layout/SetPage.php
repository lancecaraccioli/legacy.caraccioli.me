<?php
//USAGE:  identify which page we are on
class Site_Layout_Controller_Plugin_Layout_SetPage extends Zend_Layout_Controller_Plugin_Layout
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
		$module = $request->getParam('module');
		$controller = $request->getParam('controller');
		$slug = $request->getParam('slug');
		Zend_Layout::getMvcInstance()->getView()->currentPage = $slug?$slug:$module.'-'.$controller;
	}
}

