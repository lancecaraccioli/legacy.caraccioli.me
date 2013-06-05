<?php
class MediaGallery_Form_Album extends Zend_Form
{
	
	private $_media_album_id;
	
	public function setPhotoOptions($media_album_id){
		$photoOptions=array(''=>"choose a photo");
        if (is_numeric($media_album_id)){
            $photos=Doctrine_Query::create()->from('MediaGallery_Model_Media m')->where('media_album_id = ?', $media_album_id)->addWhere('m.type=?','photo')->execute();
            foreach($photos as $key=>$photo){
                $photoOptions[$photo->id]=$photo->name;
            }
        }
        $this->cover_photo_id->addMultiOptions($photoOptions);
	}
	
	public function init() {
		$this->setAttrib('enctype', 'multipart/form-data');
		$this->setDisableLoadDefaultDecorators(true);
		$this->setMethod('post');
		$this->addElement('hidden','id');
		$this->addElement(new Core_Api_Form_Element_MultiHidden('uploaded_filenames', array('isArray'=>true)));
        $query=Doctrine_Query::create();

		$this->addElement('select','cover_photo_id')
            ->getElement('cover_photo_id')
            ->setIsArray(false)
            ->setValue('')
            ->setRequired(false)
            ->setLabel('Cover Photo:'); 
		$this->addElement('text','name',array('label' => 'Album Name','required' => true));
		$this->addElement('textarea','description',array('label' => 'Description','required' => true));
		$this->addElement('submit','submit',array('label' => 'Send'));
        
        //the below view logic seems missplaced... are there static Zend_Form methods for setting a default?  If so couldn't this be part of the config process?
        //should I extend the Zend_Form to create a custom default form that all ofother forms would extend containing the view logic below?
		$this->addDecorator('FormElements')
			 ->addDecorator('HtmlTag', array('tag' => 'ul')) //this adds a <ul> inside the <form>
			 ->addDecorator('Form');
		$this->setElementDecorators(array(
			'ViewHelper',
			array('Label',array('requiredSuffix' => '<span class="form-required">*</span>', 'escape' => false)),
			'Errors',
			new Zend_Form_Decorator_HtmlTag(array('tag' => 'li')) //wrap elements in <li>'s
		));
        $this->submit->removeDecorator('HtmlTag');
        $this->submit->addDecorator(array('div'=>'HtmlTag'), array('tag'=>'div', 'class'=>'button-wrapper'));
        $this->submit->addDecorator(array('li'=>'HtmlTag'), array('tag'=>'li'));
		$this->submit->removeDecorator('Label');
 
		//Set decorators for the displaygroup:
		$this->setDisplayGroupDecorators(array(
			'FormElements',
			array(array('ul'=>'HtmlTag'),array('tag'=>'ul')),
			'Fieldset',
			array(array('li'=>'HtmlTag'),array('tag'=>'li')),
		));
	}
}
