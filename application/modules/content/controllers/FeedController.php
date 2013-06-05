<?php

class Content_FeedController extends Zend_Controller_Action
{
	public function init(){
	    $this->_helper->layout->disableLayout();
	}
	
    public function indexAction()
    {
	    $this->_forward('list');
	}
	
	public function listAction(){
    	$this->view->contentPages = $contentPages = Doctrine_Query::create()
    		->from('Content_Model_Content c')
	    	->orderBy('c.publish_date DESC')
			->where('c.publish_date IS NOT NULL')
			->limit(10)
	    	->execute();
	}

}
