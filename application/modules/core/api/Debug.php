<?php
class Core_Api_Debug extends Zend_Debug{
	
	private $_logger = null;
	
	protected static $_instance = null;
	
	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function setLogger($logger){//Zend_Log
		if ($logger instanceof Zend_Log){
			$this->_logger = $logger;	
		}
	}
	
	public function getLogger(){
		return $this->_logger;
	}
	

    private static function _alert($die = false){
        $backtrace = debug_backtrace();
        $alert = array(
            'Custom Debug Alert' => array(
                'Class' => $backtrace[2]["class"],
                'Function' => $backtrace[2]["function"],
                'File' => $backtrace[1]["file"],
                'Line' => $backtrace[1]["line"],
            )
        );
        self::dump ($alert);
        if ($die) die();
    }
    public static function alertDie(){
        self::_alert(true);
    }
    public static function alert(){
        self::_alert();
    }
    
    public static function dumpDie($data){
    	self::dump($data);
    	die();
    }
    
    public static function fb($data, $logType = Zend_Log::INFO){
		self::getInstance()->getLogger()->log($data, $logType);
	}
	public static function db(){
		$profiler = Zend_Registry::get('DB_PROFILER');
		if ($profiler){
			$time = 0;
			foreach ($profiler as $event) {
			    $time += $event->getElapsedSecs();
			    $profile .= $event->getName() . " " . sprintf("%f", $event->getElapsedSecs()) . "\n";
			    $profile .= $event->getQuery() . "\n";
			    $params = $event->getParams();
			    if( ! empty($params)) {
			        $profile = print_r($params, 1);
			    }
			}
			$profile .= "Total time: " . $time  . "\n";
		} else {
			$profile = "profiler not enabled... add profiler to zend registry key='DB_PROFILER'";
		}
		self::fb($profile);
    }
}

/*short cut helper functions*/
function fb($data, $logType = Zend_Log::INFO){
	Core_Api_Debug::fb($data,$logType);
}

function db(){
	Core_Api_Debug::db();
}
