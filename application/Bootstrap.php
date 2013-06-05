<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function run()
    {
    	$this->bootstrap('frontController');
        $this->frontController->dispatch();
    }
    
    protected function _initAutoLoader(){
    		$this->getApplication()
            ->getAutoLoader()
            ->registerNamespace('Doctrine')
            ->registerNamespace('LC')
            ;
    }

    protected function _initLayout(){
    	$environment_config = $this->getApplication()->getOptions();
        Zend_Layout::startMvc($environment_config['layout']);
		Zend_Registry::getInstance()->set('options', $environment_config);
    }
    
	protected function _initView(){
        $view = Zend_Layout::getMvcInstance()->getView();
        $view->doctype('XHTML1_STRICT');
	}
    protected function _initDb(){
   		// We will be using Doctrine as the database interface
        // DATABASE ADAPTER - Setup the database adapter
        $environment_config = $this->getApplication()->getOptions();
        $db = $environment_config['database'];
        $dsn = $db['type'] . '://' . $db['username'] . ':' . $db['password'] . '@' . $db['host'] . '/' . $db['dbname'];
		
       	try{
        	$manager = Doctrine_Manager::connection($dsn);
			//to enable DQL callbacks (used by softdelete and other behaviors)
			$manager->setAttribute(Doctrine::ATTR_USE_DQL_CALLBACKS, true);
        } catch( Exception $e){
        	echo $e;
        }
    }
    
    protected function _initEmailTransport(){
		$tr = new Zend_Mail_Transport_Smtp('smtp.central.cox.net');
        Zend_Mail::setDefaultTransport($tr);
    }
    
    protected function _initFrontControllerPlugins(){
    	$front = Zend_Controller_Front::getInstance(); 
    	$options = $this->getApplication()->getOptions();
		//TODO: add front controller plugins that are loaded at the application level.. .currently there shouldn't be any, all front controller plugins should be added via that module Bootstrap.
    }
    
    protected function _initRegistry(){
        $registry = Zend_Registry::getInstance();
        $registry->set('PUBLIC_PATH', realpath(dirname(__FILE__).'/../public'));
        $registry->set('USER_MEDIA_PATH', realpath(dirname(__FILE__).'/../public/user'));
        $registry->set('USER_MEDIA_URL', '/user');
    }
    
    protected function _initSession(){
		//this gives flash applications the ability to identify the current session
    	isset($_REQUEST['s_ID']) && session_id($_REQUEST['s_ID']);
        Zend_Session::start();
    }
}


