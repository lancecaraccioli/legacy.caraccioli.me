<?php

class Core_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initResourceLoader(){
        $resourceLoader = $this->getResourceLoader();
        $resourceLoader->addResourceType('api', 'api/', 'Api');
    }
	
    protected function _initView(){
        $view = Zend_Layout::getMvcInstance()->getView();
        $view->addHelperPath(dirname(__FILE__).'/api/View/Helper/', 'Core_Api_View_Helper');
    }


}


