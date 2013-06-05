<?php

class Admin_ConsoleController extends Zend_Controller_Action
{

    public function init(){
	    
	}

    public function indexAction()
    {
        
    }
	
	public function notifierDemoAction(){
		$this->view->notifier('Informational notification by default');
		$this->view->notifier()->addMessage('Also an informational notification by default');
		$this->view->notifier()->addMessage('Explicitly set informational notification.','information');
		$this->view->notifier()->addMessage('Warning notification.','warning');
		$this->view->notifier()->addMessage('Error notification.','error');
		$this->view->notifier()
			->addMessage('Arbitrary message type.','foozish')
			->addMessage('Hello World', 'radio broadcast');
		$this->view->notifier(array(
			'warning'=>'Road Construction Ahead.',
			'error'=>'Bank Error Collect $10.'
		));
		$this->_helper->redirector('index');
	}
    


}

