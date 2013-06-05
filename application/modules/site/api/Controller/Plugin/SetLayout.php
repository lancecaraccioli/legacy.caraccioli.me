<?php
//USAGE:  load the admin layout or the site layout
class Site_Api_Controller_Plugin_SetLayout extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
		$environment_config = Zend_Registry::getInstance()->get("options");
		$module = $request->getParam('module');
		$controller = $request->getParam('controller');
		$is_admin = (strstr($module,"admin") || strstr($controller,"admin") ) ? true : false;
		$layout = ($is_admin) ? $environment_config['admin']['layout']['layout'] : $environment_config['layout']['layout'];
		$layoutPath = ($is_admin) ? $environment_config['admin']['layout']['layoutPath'] : $environment_config['layout']['layoutPath'];
    
		if ($is_admin){
			Zend_Layout::getMvcInstance()->setLayout($layout);	
			Zend_Layout::getMvcInstance()->setLayoutPath($layoutPath);
		}
	}
}
