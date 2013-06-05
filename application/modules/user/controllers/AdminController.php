<?php

class User_AdminController extends Zend_Controller_Action {
	
	var $sub_module;
	var $sub_molules;
	
	public function init(){
		$this->sub_modules = array('role','resource');
		if(isset($_SESSION['acl_sub_module']) && in_array($_SESSION['acl_sub_module'],$this->sub_modules)){	
			$this->sub_module = $_SESSION['acl_sub_module'];
		} else {
			$this->sub_module = 'role';
			$_SESSION['acl_sub_module'] = $this->sub_module;
		}
		switch($this->sub_module){
			case 'role':
				$this->model = new Acl_Model_AclRole();
				break;
			case 'resource':
				$this->model = new Acl_Model_AclResource();
				break;
		}
	}
	
	/**
	 * 
	 *
	 * @return void
	 * @author Aaron
	 */
  public function indexAction() {
		//$this->_forward('list');
	    $this->view->roles = $roles = Doctrine_Query::create()
    		->from('Acl_Model_AclRole r')
	    	->orderBy('r.name')
	    	->execute();
  }
  
	/**
	 * This is a function that loads a list of content pages in a flat
	 * view.
	 *
	 * @return void
	 * @author Aaron
	 */
	public function listAction(){

	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Aaron
	 */
  public function formAction() {
    $request = $this->getRequest();
    $form    = $this->_getForm();
    
    // check to see if this action has been POST'ed to
    if ($this->getRequest()->isPost()) {

    	// now check to see if the form submitted exists, and
      // if the values passed in are valid for this form
      if ($form->isValid($request->getPost())) {
          	
      	// since we now know the form validated, we can now
        // start integrating that data submitted via the form
        // into our model
        $this->model->saveForm($form->getValues());
      
				// now that we have saved our model, lets url redirect
        // to a new location this is also considered a "redirect after post"
        // @see http://en.wikipedia.org/wiki/Post/Redirect/Get
        return $this->_helper->redirector('index');
      }
    } elseif(!empty($request->id)){
    	
    	$AclRole = Doctrine::getTable('Acl_Model_AclRole')->find($request->id);
		$this->view->AclRole = $AclRole;
	   	$form->setDefaults(array('AclRole' => $AclRole->toArray()));
		
    }

    $this->view->form = $form;
	$this->render($this->sub_module.'/create');
  }

	/**
	 * This is the default action for creating a content item.
	 *
	 * @return void
	 * @author Aaron
	 */
  public function createAction(){
  	$this->view->placeholder('title')->set('Create');
  	$this->_forward('form');
  }

    public function editAction(){
    	$this->view->placeholder('title')->set('Edit SiteMap');
    	$this->_forward('form');
    }

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Aaron
	 */
  public function deleteAction() {
  	$request = $this->getRequest();
    $AclRole = Doctrine::getTable('Acl_Model_AclRole')->find($request->id);
    if(!empty($AclRole)) {
        $AclRole->delete();
    }
    return $this->_helper->redirector('index');
  }
  
  /**
   * Load the admin form for use.
   *
   * @return void
   * @author Aaron
   */
  protected function _getForm() {
	$form = null;
	switch($this->sub_module){
		case 'role':
			$form = new Acl_Form_CreateUpdateRole();
			break;
	}
	return $form;
  } 
}
