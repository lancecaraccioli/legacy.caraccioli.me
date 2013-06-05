<?php
class Site_Api_Acl extends Zend_Acl {
  public function __construct() {
    //Add a new role called "guest"
	$this->addRole(new Zend_Acl_Role('guest'));
    
    //expect to use the member role in the future, when roles are pulled form the db
    $this->addRole(new Zend_Acl_Role('member'));
    
    //Add a role called administrator
    $this->addRole(new Zend_Acl_Role('administrator'));
		$this->addRole(new Zend_Acl_Role('caraccioli@cox.net'), 'administrator');

	//add a resource to represent unrestricted resources
    $this->add(new Zend_Acl_Resource('unrestricted'));
        $this->add(new Zend_Acl_Resource('default_index'),'unrestricted');
        $this->add(new Zend_Acl_Resource('content_feed'),'unrestricted');
        $this->add(new Zend_Acl_Resource('content_display'),'unrestricted');
        $this->add(new Zend_Acl_Resource('contact_request'),'unrestricted');
        $this->add(new Zend_Acl_Resource('media-gallery_photo-gallery'), 'unrestricted');
		$this->add(new Zend_Acl_Resource('events_calendar'), 'unrestricted');
    
	//add a resource to represent restricted resources
    $this->add(new Zend_Acl_Resource('restricted'));
        $this->add(new Zend_Acl_Resource('user_user'),'restricted');
    
    //guest are allowed to login to the user_user resource, and have all privledges to unrestricted resources
    $this->allow('guest', 'user_user', array('index','login','register','password-reminder'));
    $this->allow('guest', 'unrestricted');    
    //admin is allowed all privledges to all resources
    $this->allow('administrator');
  }
  
  public function isAllowed($role = null, $resource = null, $privilege = null){
  	$role = $this->hasRole($role)?$role:'guest';
  	$resource = $this->has($resource)?$resource:'restricted';
	//die($resource);
  	return (parent::isAllowed($role,$resource,$privilege));
  }
  
}
