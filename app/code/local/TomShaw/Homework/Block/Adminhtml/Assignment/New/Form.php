<?php

class TomShaw_Homework_Block_Adminhtml_Assignment_New_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
 
        $information = $form->addFieldset('base_information', array('legend' => Mage::helper('homework')->__('Assignment Information')));
        
        $information->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('homework')->__('Title'),
            'title'     => Mage::helper('homework')->__('Title'),
            'maxlength' => '50',
            'required'  => true,
        ));
        
		$widgetFilters = array('is_email_compatible' => 1);
		$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('widget_filters' => $widgetFilters));
        
		$information->addField('description','editor', array(
			'name'		=> 'description',
            'label'     => Mage::helper('homework')->__('Description'),
            'title'     => Mage::helper('homework')->__('Description'),
			'state'     => 'html',
			'required'  => true,
			'value'     => 'Type assignment information here.',
			'style'     => 'width:250%; height:200px;',
			'config'    => $wysiwygConfig
		));
        
        $settings = $form->addFieldset('base_settings', array('legend' => Mage::helper('homework')->__('Assignment Settings')));
        
        $settings->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => Mage::helper('homework')->__('Status'),
            'title'     => Mage::helper('homework')->__('Status'),
            'maxlength' => '50',
        	'options'	=> $this->getStatuses(),
            'required'  => true,
        ));
        
		$settings->addField('store_id', 'select', array(
			'name'      => 'store_id',
			'label'     => Mage::helper('catalog')->__('Store'),
			'title'     => Mage::helper('catalog')->__('Store'),
			'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(true, false),
			'required'  => true,
		));
        
        $settings->addField('priority', 'select', array(
            'name'      => 'priority',
            'label'     => Mage::helper('homework')->__('Priority'),
            'title'     => Mage::helper('homework')->__('Priority'),
            'maxlength' => '50',
        	'options'	=> $this->getPriorities(),
            'required'  => true,
        ));
        
        $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        $settings->addField('due_at', 'date', array(
            'name'      => 'due_at',
            'label'     => Mage::helper('cms')->__('Due Date'),
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
			'style'     => 'width:80%;',
            'disabled'  => false,
			'format'    => 'yyyy-M-d H:mm',
        	'time'      => true
        ));
        
        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/create'));
 
        $this->setForm($form);
    }
    
    private function getStatuses()
    {
    	return array(
    		1 => 'Pending',
    		2 => 'Approved', 
    		3 => 'Completed', 
    		4 => 'Denied', 
    		5 => 'Cancelled'
    	);
    }
    
    private function getPriorities()
    {
    	return array(
    		1 => 'High',
    		2 => 'Medium', 
    		3 => 'Low'
    	);
    }
}