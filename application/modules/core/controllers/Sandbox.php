<?php

class Core_SandboxController extends Zend_Controller_Action
{

    public function init(){

	}

    public function indexAction()
    {
        $q = Doctrine_Query::create()
			->from('Core_Model_Sandbox s')
			->leftJoin('s.Core_Model_Sandbox2')
			;
		echo ($q->getSql(). '<br />');
		Zend_Debug::dump($q->execute()->toArray());
		die();
    }
    


}

