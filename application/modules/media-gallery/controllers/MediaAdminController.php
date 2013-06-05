<?php

class MediaGallery_MediaAdminController extends Zend_Controller_Action
{
	
    public function indexAction(){
		$this->_redirect('/media-gallery/album-admin/list');
	}
	public function editAction(){
		$this->_forward('form');
	}
	public function createAction(){
		$this->_forward('form');
	}
 
    public function formAction(){
		$form = new MediaGallery_Form_Media();
        $id = $this->getRequest()->getParam('id');
        $media = $id?Doctrine_Query::create()->from('MediaGallery_Model_Media')->where('id = ?', $id)->fetchOne():new MediaGallery_Model_Media;
        if ($this->getRequest()->isPost()){//a form has been submitted... (sets form defaults to Post Values)
        	if($form->isValid($_POST)){//if the form validates
	            $values = $form->getValues();
	            $media->merge($values);
	            $media->save();
				$this->view->notifier("'$media->name' was saved successfully.");
	            $this->_helper->redirector->direct('edit',null,null,array('id'=>$media->id));
	        }
        } elseif ($id){//no $_POST, but a particular id is requested for editing
			$form->setDefaults($media->toArray());
			$this->view->notifier("You are editing a media record '$media->name'");
		} elseif ($media_album_id = $this->getRequest()->getParam('media_album_id')){//request to create a new media for a particular media album
            $media = new MediaGallery_Model_Media;
            $album = Doctrine_Query::create()->from('MediaGallery_Model_Album a')->where('a.id = ?', $media_album_id)->fetchOne();
			if (!$album){
				$this->view->notifier('Sorry the album id you requested is incorrect.  Be sure to select the correct album that this media record should be associated with.','warning');
			} else {
				$media->Album = $album;
				$this->view->notifier("You are creating a new media record for the media album '" .$media->Album->name."'");
				$form->setDefaults(array('media_album_id'=>$media->Album->id));
			}
		} else {//no id and no media_album_id... return to media album list so we can either create another or edit a current media
			$this->view->notifier('Sorry the information we needed to edit/create a new media record was missing.','warning');
            $this->_redirect('/media-gallery/album-admin/list');
        }
        $this->view->media=$media;
        $this->view->form = $form;
    }
	
	public function listAction()
    {
        $media_album_id = $this->getRequest()->getParam('media_album_id');
        $media_album=Doctrine_Query::create()->from('MediaGallery_Model_Album')->where('id = ?', $media_album_id)->orderby('name')->fetchOne();
        if (!$media_album){
			$this->view->notifier('Sorry we need the media album whose media you\'d like listed.  Please try again.','warning');
			$this->_redirect('/media-gallery/album-admin/list');
        }
		$this->view->media_album = $media_album;
    }
	
	public function deleteAction()
    {
		$id = $this->_getParam('id');
		$media = Doctrine::getTable('MediaGallery_Model_Media')->find($id);
		$media && $media->delete();
        $this->_redirect('/media-gallery/media-admin/list/media_album_id/'.$media->media_album_id);
    }
	
	public function undeleteAction(){
		//TODO:add softdelete to media then impliment this action
	}
}
