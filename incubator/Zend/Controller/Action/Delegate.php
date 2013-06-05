<?php
abstract class  Zend_Controller_Action_Delegate {
	protected $_delegator ;
	public function setDelegator(Zend_Controller_Action_Delegator $delegator){
		$this->_delegator=$delegator;
	}
	
	//if the delegate can't find an method to call then it will proxy the delegator, which is usefull for getting information from controller resources... e.g. $this->getRequest()
	public function __call($method, $arguments){
		if ($this->_delegator instanceof Zend_Controller_Action_Delegator){ 
			if (method_exists($this->_delegator,$method)){
				return $this->_delegator ->$method($arguments);
			} else {
				throw new Exception('You have called an unsupported method "'.$method.'" on Zend_Controller_Action_Delegate.');
			}
		}  else {
			throw new Exception("You must register a delegator that uses Zend_Controller_Action_Delegate via the setDelegate method");
		}
	}
	
	//if an attribute can't be found then attempt to proxy the delegator's attribute
	public function __get($key){
		if (isset($this->_delegator->$key)){
			return ($this->_delegator->$key);
		}
	}
}
