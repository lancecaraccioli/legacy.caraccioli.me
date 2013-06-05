<?php

class Content_AdminController extends Zend_Controller_Action
{
	public function init(){
	    
	}
	
    public function indexAction()
    {
    	$this->view->contentPages = $contentPages = Doctrine_Query::create()
    		->from('Content_Model_Content c')
	    	->orderBy('c.title')
	    	->execute();
	}
	
	public function listAction(){
	    $this->_forward('index');
	}
	
    public function formAction()
    {
        $request = $this->getRequest();
        $form    = $this->_getForm();
        // check to see if this action has been POST'ed to
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $values = $form->getValues();
                $Content = $values['Content']['id']? Doctrine::getTable('Content_Model_Content')->find($values['Content']['id']) : new Content_Model_Content();
				$Content->fromArray($values['Content']);
				$Content->save();
				//send a flash message
				$this->view->notifier("You successfully updated '$Content->title'.");
                return $this->_helper->redirector('edit',null,null,array('id'=>$Content->id));
            } else {
				$this->view->notifier("Please correct the validation errors listed on the form.", 'error');
			}
        } elseif(!empty($request->id)){
        	$Content = Doctrine::getTable('Content_Model_Content')->find($request->id);
			$this->view->notifier("You are editing '$Content->title'.");
        	$this->view->Content = $Content;
		   	$form->setDefaults(array('Content' => $Content->toArray()));
        } else {
			$this->view->notifier("You are creating a new content page.");
		}

        $this->view->form = $form;
    }
	
    public function createAction(){
    	$this->view->placeholder('title')->set('Create Content');
    	$this->_forward('form');
    }

    public function editAction(){
    	$this->view->placeholder('title')->set('Edit Content');
    	$this->_forward('form');
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id');
        $Content = Doctrine::getTable('Content_Model_Content')->find($id);
        if(!empty($Content)) {
            $Content->delete();
        }
		$this->view->notifier("You just deleted '$Content->title' - <a href=\"".$this->view->url(array('action'=>'undelete'))."\">undo</a>", 'warning');
        return $this->_helper->redirector('index');
    }
	
	public function undeleteAction(){
        $id = $this->_getParam('id');
        $Content = Doctrine_Query::create()
			->from('Content_Model_Content c')
			->addWhere('c.id=?',$id)
			->addWhere('c.deleted_at IS NOT NULL')//required else SoftDelete behavior will prevent selection of this record
			->fetchOne();
			;
		$Content->deleted_at = null;
		$Content->save();
		$this->view->notifier("You just restored '$Content->title'");
        return $this->_helper->redirector('index');
	}
	
    protected function _getForm()
    {
        $form = new Content_Form_CreateUpdate();
        return $form;
    }
}
