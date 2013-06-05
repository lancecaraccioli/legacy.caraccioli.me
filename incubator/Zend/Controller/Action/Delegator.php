<?php
abstract class  Zend_Controller_Action_Delegator extends Zend_Controller_Action {
	protected $_delegates = array();
	public function registerDelegate(Zend_Controller_Action_Delegate $delegate){
		$this->_delegates[]=$delegate;
		$delegate->setDelegator($this);
	}
	
	//if the controller can't find an action to call then it will attempt to call taht action in the action delegate
	public function __call($method, $arguments){
		if (!empty($this->_delegates)){
			foreach($this->_delegates as $delegate){
				if (method_exists($delegate,$method)){
					//only call  the first  delegate that can handle it
					return $delegate->$method($arguments);
				}
			}
		} else {
			throw new Exception ('No Zend_Controller_Action_Delegate objects where registered with Zend_Controller_Action_Delegator');
		}		
	}
}