<?php
class MediaGallery_Form_Media extends Zend_Form
{
	public function init() {
	    //die(Zend_Registry::get('MEDIA_GALLERY_THUMB_PATH'));
		$this->setAttrib('enctype', 'multipart/form-data');
		$this->setMethod('post');
		$this->addElement('hidden','id');
		$this->addElement('hidden','crop_top');
		$this->addElement('hidden','crop_left');
		$this->addElement('hidden','crop_width');
		$this->addElement('hidden','crop_height');
        $mediaAlbums=Doctrine::getTable('MediaGallery_Model_Album')->findAll();
        $mediaAlbumOptions=array(''=>"choose an album");
        foreach($mediaAlbums as $key=>$mediaAlbum){
            $mediaAlbumOptions[$mediaAlbum->id]=$mediaAlbum->name;
        }
		$this->addElement('select','media_album_id')
            ->getElement('media_album_id')
            ->addMultiOptions($mediaAlbumOptions)
            ->setIsArray(false)
            ->setValue('')
            ->setRequired(true)
            ->setLabel('Media Album:');
		$this->addElement('text','name',array('label' => 'Media Name','required' => true));
		$this->addElement('hidden','uploaded_filename');
        $this->addElement('submit','submit',array('label' => 'Send'));
        
	}
}
