<?php

class Sandbox_SmartererController extends Zend_Controller_Action
{
	public function init(){
	    
	}
	
    public function indexAction()
    {
        $this->_forward('test-widget');
	}

    public function testWidgetAction(){
        $this->view->title="Smarterer Test Widget Testing";
    }
	
}
