<?php

class Twitter_FeedController extends Zend_Controller_Action
{
	public function init(){
	   // $this->_helper->layout->disableLayout();
		$frontendOptions = array(
		   'lifetime' => 120, // cache lifetime of 2 mins
		   'automatic_serialization' => true
		);

		$backendOptions = array(
			'cache_dir' => '../application/configs/cache/' // Directory where to put the cache files
		);

		// getting a Zend_Cache_Core object
		$this->cache = Zend_Cache::factory(
														'Core',
														'File',
														$frontendOptions,
														$backendOptions);
													
		$this->cacheKey = preg_replace('/[^a-zA-Z0-9]/',"_", $this->getRequest()->getActionName());//$this->_getParam('action'));//this is a hack because the _getParam method is not working correctly when this is rendered via the _view_helper_action view helper
		if (!$data = $this->cache->load($this->cacheKey)){
			$this->service  = $twitter = new Zend_Service_Twitter('mrburly', 'caydi102505');
			$this->verifiedServiceCredentials = $twitter->account->verifyCredentials();
			$this->rateLimitStatus = $twitter->account->rateLimitStatus();
			$this->requestNewData = true;
			if (!empty($this->verifiedServiceCredentials->error)){
				$this->requestNewData = false;//.we didn't authenticate... it's pointless to request data
			}
		} else {
			$this->view->data = $data;
		}    	
	}
	
    public function indexAction()
    {
	    $this->_forward('list');
	}
	
	public function statusUpdatesListAction(){
		if ($this->requestNewData){
			$restResponse =  $this->service->status->userTimeline(array('count'=>3));
			foreach($restResponse->status as $statusUpdate){
				$data[]=$this->_simpleXmlToArray($statusUpdate);
			}
			$data[0]['cached_at']=date('Y-m-d H:i:s');
			$this->cache->save($data, $this->cacheKey);
			$this->view->data = $data;
		} 
	}
	
	protected function _simpleXmlToArray(SimpleXMLElement $element){
		$vars = get_object_vars($element);
		foreach ($vars as $key=>$var){
			if ($var instanceof SimpleXMLElement){
				$vars[$key] = $this->_simpleXmlToArray($var);
			}
		}
		return $vars;
	}

}
