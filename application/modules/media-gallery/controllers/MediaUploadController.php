<?php

class MediaGallery_MediaUploadController extends Zend_Controller_Action
{

	public function init(){
	    $contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('upload', 'json')
                      ->initContext();
                      
		$this->_helper->viewRenderer->setNoRender(true);
		$fileKey = $this->_getParam('file_key');
		$fileKey = $fileKey?$fileKey:'Filedata';
		$this->mediaDestination=Zend_Registry::get('MEDIA_GALLERY_MEDIA_PATH').'/original/file';
		$this->thumbnailBaseUrl = Zend_Registry::get('MEDIA_GALLERY_MEDIA_URL').'/thumbnail/file';
        $this->file = $_FILES[$fileKey];
        if ($this->file){
        	$this->file['ext'] = $ext = substr($this->file['name'],strrpos($this->file['name'], ".")+1);
        	//die($this->file['ext']);
        } else {
        	die('failure');//the file wasn't uploaded, and since that's all this controller does is handle file uploads we know there is a problem
        }
	}
	
	public function uploadAction(){
		if (is_file($this->file['tmp_name'])){//a file was uploaded... 
			//move the media to the media folder with a unique name
			$uniqStub=md5($this->file['name'].date('Y-m-d H:i:s').rand(1,1000));
			$newFileName=$uniqStub.'.'.$this->file['ext'];
			$newFullFilePath = $this->mediaDestination.'/'.$newFileName;
			move_uploaded_file($this->file['tmp_name'], $newFullFilePath);

			//JSON response
			$this->view->fileName = $newFileName;
			$this->view->thumbnailUrl = $this->thumbnailBaseUrl."/{$uniqStub}_thumbnail_100_100.".$this->file['ext'];
		} else {
		    //should not reach the following die if there is a valid file and it gets moved
		    $this->view->error = "The temporary file name is not a file.  See line 63 of ". __FILE__;   
		}		
	}
	
	public function testUploadScriptAction(){
		//debugging
			$debugData = array(
				'REQUEST'=>$this->getRequest()->getParams(),
				'$_FILES'=>$_FILES,
			);
			$mail = new Zend_Mail;
			$mail->setFrom ('debugging@kfx2.com', 'Debugging');
			$mail->addTo('lance@kfx2.com');
			$mail->setSubject ('Testing Upload Script');
			$mail->setBodyHTML(print_r($debugData,1));
			$mail->send();
	        $this->_forward('upload');
	}

}
