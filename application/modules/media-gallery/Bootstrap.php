<?php

class MediaGallery_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initRegistry(){
        $registry = Zend_Registry::getInstance();
        $registry->set('MEDIA_GALLERY_PATH',        $registry->get('PUBLIC_PATH').'/media-gallery');
        $registry->set('MEDIA_GALLERY_URL',         '/media-gallery');
        $registry->set('MEDIA_GALLERY_MEDIA_PATH',  $registry->get('PUBLIC_PATH').'/media-gallery/media-download');
        $registry->set('MEDIA_GALLERY_MEDIA_URL',   '/media-gallery/media-download');

        $registry->set('MEDIA_GALLERY_THUMB_DEFAULTS_PATH',  $registry->get('MEDIA_GALLERY_PATH').'/thumbnail/file/_defaults');
        
    }
	
	protected function _initCustomRoute(){
		
	}
    

}


