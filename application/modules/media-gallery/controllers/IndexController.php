<?php

class MediaGallery_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->redirector->gotoSimple('index','photo-gallery');
    }

    public function indexAction()
    {
        // action body
    }


}

