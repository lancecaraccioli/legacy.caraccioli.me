<?php
class DelegationTestController extends Zend_Controller_Action_Delegator
{
    public function init()
    {
        $this->registerDelegate(new LC_Controller_Action_Delegate_ListDetail(array(model=>'Content_Model_Content')));
    }
}

