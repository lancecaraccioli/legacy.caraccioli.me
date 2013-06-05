<?php

class Content_Form_CreateUpdate extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post')->setAttrib('enctype', 'multipart/form-data');

        $ContentForm = new Zend_Form_SubForm();

        $ContentForm->addElement('hidden', 'id', array(
            'label'      => '',
            'required'   => false,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'NotEmpty',
            )
        ));

        $ContentForm->addElement('text', 'title', array(
            'label'      => 'Title:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'NotEmpty',
            )
        ));

        $ContentForm->addElement('textarea', 'content', array(
            'label'      => 'Content:',
            'required'   => true,
            'filters'    => array(),
            'validators' => array(
                'NotEmpty',
            )
        ));

        $this->addSubForm($ContentForm, 'Content');

        // add the submit button
        $this->addElement('submit', 'save', array(
            'label'    => 'Save',
        ));
    }
}
