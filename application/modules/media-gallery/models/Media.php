<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MediaGallery_Model_Media extends MediaGallery_Model_Base_Media
{
	
	public static $file_ext_to_type_map=array(
		'png'=>'photo',
		'gif'=>'photo',
		'jpg'=>'photo',
		'jpeg'=>'photo',
		'flv'=>'video',
		'wmv'=>'video',
		'mp3'=>'audio',
		'pdf'=>'pdf',
		'doc'=>'doc',
		'unknown'=>'unknown',
	);
	
	public function croppedThumbnailUrl($maxHeight = 0,$maxWidth=0, $top=null, $left=null, $width=null, $height=null){
		//TODO: check media type and select default thumbnail to association to video's, pdf's, etc.
		$top=($top !== null)?$top:$this->crop_top;
		$left=($left !== null)?$left:$this->crop_left;
		$width=($width !== null)?$width:$this->crop_width;
		$height=($height !== null)?$height:$this->crop_height;
		$thumbnailUrl='';
		if ($this->uploaded_filename){
			$ext = $this->getExtension();
			$slug= $this->getSlug();
			$thumbnailUrl = Zend_Registry::getInstance()->get('MEDIA_GALLERY_MEDIA_URL'). "/thumbnail/file/{$slug}_t_{$left}_{$top}_{$width}_{$height}_{$maxWidth}_{$maxHeight}.{$ext}";
		}
        return $thumbnailUrl;
	}
	public function thumbnailUrl($maxHeight = 0,$maxWidth=0){
		//TODO: check media type and select default thumbnail to association to video's, pdf's, etc.
		$top=0;
		$left=0;
		$width=100;
		$height=100;
        return $this->croppedThumbnailUrl($maxHeight, $maxWidth, $top,$left,$width,$height);
	}

	public function getExtension(){
		$ext = substr($this->uploaded_filename,strrpos($this->uploaded_filename, ".")+1);
		return $ext;
	}
	
	public function getSlug(){
		$slug= substr($this->uploaded_filename,0,strrpos($this->uploaded_filename, "."));
		return $slug;
	}
	
	public function mediaUrl(){
		$mediaUrl='';
		if ($this->uploaded_filename){
			$mediaUrl = Zend_Registry::getInstance()->get('MEDIA_GALLERY_MEDIA_URL').'/original/file/'.$this->uploaded_filename;
		}
		return $mediaUrl;
	}
	
    public static function getMediaTypeForFileName($filename){
        $ext = substr($filename,strrpos($filename, ".")+1);

    	$type = self::$file_ext_to_type_map[$ext];
    	$type = $type?$type:self::$file_ext_to_type_map['unknown'];
    	return $type;
    }
}
