<?php

class Contact_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initRoutes(){
    	$route = new Zend_Controller_Router_Route(
    		'/contact-us',
    		array(
					'module' => 'contact',
					'controller' =>'request',
					'action'=>'form',
					)
			);
			
			
			Zend_Controller_Front::getInstance()
				->getRouter()
				->addRoute('contact',$route);
    
    }

}


