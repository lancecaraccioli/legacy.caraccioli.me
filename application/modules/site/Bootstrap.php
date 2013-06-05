<?php

class Site_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initResourceLoader(){
        $resourceLoader = $this->getResourceLoader();
        $resourceLoader->addResourceType('api', 'api/', 'Api');
    }
	
    protected function _initPlugins(){
		$front = Zend_Controller_Front::getInstance(); 
		$front->registerPlugin(new Site_Api_Controller_Plugin_AclCheck)
				->registerPlugin(new Site_Api_Controller_Plugin_SetLayout);
    }

}


