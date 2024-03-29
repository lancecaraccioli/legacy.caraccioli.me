<?
/**
 * @category   Core
 * @package    Core_Api_View
 * @subpackage Core_Api_View_Helper
 * @author     Lance Caraccioli
 * @email      caraccioli@cox.net
 * @website    
 * @copyright  Lance Caraccioli 2009
 * @license    http://framework.zend.com/license/new-bsd  New BSD License
*/

/**
 * @see Zend_Session
 */
require_once 'Zend/Session.php';

/**
 * @see Zend_View_Helper_Abstract
 */
require_once 'Zend/View/Helper/Abstract.php';

/**
 * Notifier - Intelligent Flash Messaging
 *
 * @uses       Zend_View_Helper_Abstract
 * @category   Core
 * @package    Core_Api_View
 * @subpackage Core_Api_View_Helper
 * @author     Lance Caraccioli
 * @email      caraccioli@cox.net
 * @website    
 * @copyright  Lance Caraccioli 2009
 * @license    http://framework.zend.com/license/new-bsd  New BSD License
*/
class Core_Api_View_Helper_Notifier extends Zend_View_Helper_Abstract {

	static protected $_storage = null;
	const INFORMATION = 'information';
	const WARNING = 'warning';
	const ERROR = 'error';
	
	/**
	* The enterance point to the functionality offered by the notifier view helper.  This will proxy to addMessage if $messages is set.
	* This method will return $this making this method chainable
	*
	* @param  string|array|null $messages can be and array of type=>message combos or a string representing a new message
	* @param  string|null $type the namespace to apply this message to it can be completely arbitrary, but three standard ones are defined constants of this class
	* @return $this
	*/
	public function notifier($messages = null, $type = self::INFORMATION ) {
		if (!empty($messages)){
			$this->addMessage($messages, $type);
		}//else - user is trying to get notifier to do something else with it
		return $this;
	}

	/**
	* This method will add a message or array of messages to the specified namespaces (type), which can be arbitrarily named.
	* The namespaces are FIFO, and the messages are FIFO within namespaces
	* This method will return $this making this method chainable
	*
	* @param  string|array|null $messages can be and array of type=>message combos or a string representing a new message
	* @param  string|null $type ignored if $messages is an array otherwise it is the namespace to apply this message to.  $type can be completely arbitrary, but three standard ones are defined constants of this class
	* @return $this
	*/	
	public function addMessage($messages, $type = self::INFORMATION){
		//FIFO by group
		if (is_array($messages)){//assume multiple messages
			foreach($messages as $type=>$message){
				$this->addMessage($message, $type);
			}
		} else {
			$message = $messages;//for code readability - there is a single message based on above conditional
			$dataStorage = $this->_getStorage();
			$dataStorage->messages[$type][]=$message;
		}
		return $this;
	}
	
	/**
	* This method will return the messages for the specified namespace.  If no namespace is specified then all namespaces are returned with their associated messages.
	* 
	* @param  string|null $type the namespace to retieve messages for.
	* @return array
	*/	
	public function getMessages($type = null){
		//this unsets the namespace (type) once the values are aquired but before they are returned
		$dataStorage = $this->_getStorage();
		$messages = $type?$dataStorage->messages[$type]:$dataStorage->messages;
		if ($type){
			unset($dataStorage->messages[$type]);
		} else {
			unset($dataStorage->messages);
		}
		return $messages;
	}

	/**
	* Get the message storage container
	*
	* @return Zend_Session_Namespace
	*/
	private function _getStorage() {
		if (!self::$_storage instanceof Zend_Session_Namespace) {
		  $className = get_class($this);
		  self::$_storage = new Zend_Session_Namespace($className);
		}
		return self::$_storage;
	}
}
