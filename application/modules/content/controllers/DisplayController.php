<?php

class Content_DisplayController extends Zend_Controller_Action
{
	public function init(){
		
	}
	
    public function indexAction()
    {
        $this->_forward('show');
	}
	
    public function showAction(){
		//attempt to fetch the content page from the database.
		$slug = $this->_getParam('slug', '404');
		//die ($this->view->getScriptPath());
    	$content = Doctrine_Query::create()
			->from('Content_Model_Content')
			->where('slug = ?', $slug)
			->fetchOne();
		if (!$content) {
			$slug = '404';
			$this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found'); 
			$content = Doctrine_Query::create()->from('Content_Model_Content')->where('slug = ?', '404')->fetchOne();
		}
		$this->view->content = $content;
		
		//attempt to load any decorator scripts
		$contentDecorator = 'decorators/'.$slug;
		try{
			$path = $this->view->getScriptPath('display/'.$contentDecorator.'.phtml');
			$hasDecorator = $path?true:false;
		} catch(Zend_View_Exception $e){
			//swallow the error  no decorator script exists.
			$hasDecorator = false;
		}
		
		if ($hasDecorator){
			$this->render($contentDecorator);
		}
    }
}
