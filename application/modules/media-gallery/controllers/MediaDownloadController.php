<?php

class MediaGallery_MediaDownloadController extends Zend_Controller_Action
{

	const MAX_HEIGHT=640;
	const MAX_WIDTH=480;

	public function init(){
		
	}

	public function thumbnailAction(){
		//if we are here then that means apache did not find the file under the public folder.
		//we need to create the file and place it in the public folder
		/*
		*	The request var 'file' is formated <uploaded_filename>_thumbnail_<width>_<height>.<ext>
		*	
		*/
        require_once ('WideImage/WideImage.php');
		$file = $this->_getParam('file');
		//find the file extension
		$ext = substr($file,strrpos($file, ".")+1);
		//the part of the file name before the '.'
		$slug= substr($file,0,strrpos($file, "."));
		//seperate the fullsize filename from the dimensions information
		$data = explode('_t_',$slug);
		//construct a file path for the fullsize filename
		$originalFile = Zend_Registry::getInstance()->get('MEDIA_GALLERY_MEDIA_PATH').'/original/file/'.$data[0].'.'.$ext;
		//parse the dimesions information
		$dimensions = explode('_',$data[1]);
		$left = $dimensions[0].'%';
		$top = $dimensions[1].'%';
		$width = $dimensions[2].'%';
		$height = $dimensions[3].'%';
		$maxWidth = $dimensions[4];
		$maxHeight = $dimensions[5];
		//Core_Api_Debug::dumpDie($dimensions);
		//create the new file path which should resolve to the current request uri under the public folder on the next request
		$saveFileName = Zend_Registry::getInstance()->get('MEDIA_GALLERY_MEDIA_PATH').'/thumbnail/file/'.$file;
		//create the thumbnail
		
        $wi = WideImage::load($originalFile)
                ->crop($left,$top,$width,$height)
				->resize($maxHeight, $maxWidth, 'inside')
                ->saveToFile($saveFileName);
		//redirect back to the actual file now which should live at the same request uri (though now apache resolves it to a file so this new request will not enter the zend framework)
        $this->_redirect($_SERVER['REQUEST_URI']);
	}
	

}
