<?php
class LC_Controller_Action_Delegate_ListDetail extends Zend_Controller_Action_Delegate{

	protected $_options;
	
	public function __construct($options){
		$this->_options = $options;
	}
	public function listAction(){
		$this->view->records = Doctrine_Query::create()
			->from($this->_options['model'])
			->execute();
	}
}