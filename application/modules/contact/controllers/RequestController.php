<?php

class Contact_RequestController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_forward('form');
    }
    
    public function formAction(){
		$this->view->form=$form=$this->_getForm();
		
		/* hack for this layout with sidebar images */
		$this->view->page = "contact-us";
		
		/* hack for this site to have editable content */
		$this->view->content = Doctrine_Query::create()->from('Content_Model_Content')->where('slug = ?', 'contact-us')->fetchOne()->content;
		
		if ($this->getRequest()->isPost()){
			if($form->isValid($this->getRequest()->getPost())) {
				//get the form data values
				$data = $form->getValues();
				//Core_Api_Debug::dumpDie($data);
				//create the new contact request record
				$contactRequest = new Contact_Model_ContactRequest();
				$contactRequest->merge($data);
				$contactRequest->save();
				//redirect after post
				$this->_helper->redirector->gotoSimple('success');
			} else {
				$this->view->notifier()->addMessage("Sorry, but you have some validation errors.  Please correct those and resubmit.", 'warning');
			}
		} 
		
	}
	
	public function successAction(){
	    //$this->_helper->redirector->gotoUrl('/content/contact-request-accepted');
	}
	
	private function _getForm(){
	    return new Contact_Form_Request();
	}


}

