<?php

class Core_SandboxController extends Zend_Controller_Action
{

    public function init(){

	}

    public function indexAction()
    {
		var_dump(Doctrine::getTable('Core_Model_SandBox')->getColumnNames());
		die();
    }
    


}

