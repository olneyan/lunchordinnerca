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
* @package     Ced_Auction
* @author      CedCommerce Core Team <connect@cedcommerce.com >
* @copyright   Copyright CEDCOMMERCE (http://cedcommerce.com/)
* @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*/ 
class Ced_CsMarketplace_Block_Layer_View extends Mage_Core_Block_Template
{
	public function filterAttr()
	{
          $vids = [];$fgroups =[];
		$vendor = Mage::getModel('csmarketplace/vendor')
											->getCollection()
											->addAttributeToSelect('*')
											->addAttributeToFilter('status',array('eq'=>Ced_CsMarketplace_Model_Vendor::VENDOR_APPROVED_STATUS));

		    $rest = $this->getRequest()->getParam('rest');
		    $information = Mage::registry('vshop_lists');
			if(strlen($rest))
			{
				
				$vendor->addAttributeToFilter('entity_id',['in' => $information['validIds']]);
			}

			foreach ($vendor as $key => $value) {
				$vids[] = $value->getId();
			}
			
		for($i=0;$i<count($vids);$i++)
		{
			$fgroup = Mage::getModel('csmarketplace/vendor')->load($vids[$i])->getFoodGroup();
			if(!empty($fgroup))
			{
				$fgroups[] = $fgroup;
			}
			
		}
		if(strlen($rest) == 1)
		{
			return $arr =[];
		}
		else{
			return $fgroups;
		}
		//print_r($fgroups); die("fgkj");
		
		//print_r($collection->getData()); die("gl");
	}
	
	protected function _prepareAttributeCollection($collection)
	{
		$collection->addIsFilterableFilter();
		return $collection;
	}
	
	public function getValue($data)
	{

	//	print_r($products); die("fkjv");
	//	$count = count($products);
		$data = explode(',', $data);
		
		
	   $attribute = Mage::getSingleton('eav/config')
                        ->getAttribute('csmarketplace_vendor','food_group');
                        
                        if ($attribute->usesSource()) {
                        	$options = $attribute->getSource()->getAllOptions(false);
                        }
       
                        	$result ='';
   foreach ($options as $key => $value) { 
   

   	
	   for($i=0;$i<count($data);$i++) {
	   
              if($value['value'] == $data[$i])
              {
              	$vids = $this->getVendorColl();
              
              	$products = Mage::getModel('csmarketplace/vendor')->getCollection()->addAttributeToFilter(
              			array(
              					array('attribute'=> 'food_group','finset' => array($data[$i]))
              			))->addFieldToFilter('entity_id',['in'=>$vids]);
             // 	echo count($products->getData()); die("dfvkj");
              //echo "<pre>";		print_r($vids); echo "<br>";print_r($products->getData());echo "</pre>";die("dfjv");
              	$count = count($products->getData());
              	
              	//echo $value['value'];echo "<br>";
              	 $result.= $value['value'].":".$value['label'].'('.$count.')'.',' ;
              }
              else{
              	continue;
              }
	     	
	     }
   }
  
   return $result;
   
     
	}
	
	
	
	public function getVendorColl()
	{
		
		$vids = [];$fgroups =[];
		$vendor = Mage::getModel('csmarketplace/vendor')
		->getCollection()
		->addAttributeToSelect('*')
		->addAttributeToFilter('status',array('eq'=>Ced_CsMarketplace_Model_Vendor::VENDOR_APPROVED_STATUS));
		
		$rest = $this->getRequest()->getParam('rest');
		$information = Mage::registry('vshop_lists');
		if(strlen($rest) < 2)
		{
			$rest = "";
		}
		
		if(strlen($rest))
		{
			$vendor->addAttributeToFilter('entity_id',['in' => $information['validIds']]);
		}
		
		foreach ($vendor as $key => $value) {
			$vids[] = $value->getId();
		}
		//print_r($vids); die("dflk");
		if(strlen($rest) == 1)
		{
			return $arr =[];
		}
		else{
			return $vids;
		}
		
	}
	
}
