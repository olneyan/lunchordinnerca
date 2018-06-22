<?php 

/**
  * CedCommerce
  *
  * NOTICE OF LICENSE
  *
  * This source file is subject to the Academic Free License (AFL 3.0)
  * You can check the licence at this URL: http://cedcommerce.com/license-agreement.txt
  * It is also available through the world-wide-web at this URL:
  * http://opensource.org/licenses/afl-3.0.php
  *
  * @category    Ced
  * @package     Ced_CsVendorReview
  * @author      CedCommerce Core Team <connect@cedcommerce.com >
  * @copyright   Copyright CEDCOMMERCE (http://cedcommerce.com/)
  * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
  */

/**
 * Rating Item admin side general tab of form
 */
 

class Ced_CsVendorReview_Block_Adminhtml_Rating_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * Prepare review form
	 */
	protected function _prepareForm()
	{
   	
		$form = new Varien_Data_Form(array());
		$this->setForm($form);
		$fieldset = $form->addFieldset('id' , array('legend'=> Mage::helper('csvendorreview')->__('Rating Infromation')));	
		
		$fieldset->addField('rating_label', 'text', array(
					'label'     => Mage::helper('csvendorreview')->__('Rating Name'),
					'name'      => 'rating_label',
			));
			
		$fieldset->addField('rating_code', 'text', array(
					'label'     => Mage::helper('csvendorreview')->__('Rating Code'),
					'class'     => 'required-entry',
					'name'      => 'rating_code',
			));
			
		$fieldset->addField('sort_order', 'text', array(
					'label' => Mage::helper('csvendorreview')->__('Sort Order'),
					'name'  => 'sort_order',
			)); 

			
		if ( Mage::registry('csvendorreview_data') ){
			$form->setValues(Mage::registry('csvendorreview_data')->getData());
		}

		return parent::_prepareForm();
	}
 
}