<?php

/**
 * CedCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    Ced;
 * @package     Ced_CsMarketplace
 * @author 		CedCommerce Core Team <coreteam@cedcommerce.com>
 * @copyright   Copyright CedCommerce (http://cedcommerce.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Ced_CsMarketplace_VshopsController extends Mage_Core_Controller_Front_Action {

    /**
     * Initialize requested vendor object
     *
     * @return Ced_CsMarketplace_Model_Vendor
     */
    protected $_vendorCollection;

    protected function _initVendor() {
        Mage::dispatchEvent('csmarketplace_controller_vshops_init_before', array(
            'controller_action' => $this
<<<<<<< HEAD
            ));
=======
        ));
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b

        if (!Mage::helper('csmarketplace/acl')->isEnabled())
            return false;
        $shopUrl = Mage::getModel('csmarketplace/vendor')->getShopUrlKey($this->getRequest()->getParam('shop_url', ''));
        if (!strlen($shopUrl)) {
            return false;
        }

        $vendor = Mage::getModel('csmarketplace/vendor')->setStoreId(Mage::app()->getStore()->getId())->loadByAttribute('shop_url', $shopUrl);
        if (!Mage::helper('csmarketplace')->canShow($vendor)) {
            return false;
        } else if (!Mage::helper('csmarketplace')->isShopEnabled($vendor)) {
            return false;
        }

        // Mage::getSingleton('catalog/session')->setLastVisitedCategoryId($category->getId());
        Mage::register('current_vendor', $vendor);
        // Mage::register('current_entity_key', $category->getPath());

        try {
            Mage::dispatchEvent('csmarketplace_controller_vshops_init_after', array(
                'vendor' => $vendor,
                'controller_action' => $this
<<<<<<< HEAD
                ));
=======
            ));
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            return false;
        }

        return $vendor;
    }

    /**
     * Vendor Shop list action
     */
<<<<<<< HEAD
    public function getlocationAction() {
       /* if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
//Send request and receive json data by latitude and longitude
            $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
            $json = @file_get_contents($url);
            $data = json_decode($json);
            print_r($data);
            $status = $data->status;
            if($status=="OK"){
    //Get address from json data
                $location = $data->results[0]->formatted_address;
            }else{
                $location =  '';
            }
// dipslay address
            echo $location;
        } */
        $geolocation = $_POST['latitude'].','.$_POST['longitude'];
        $request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$geolocation.'&sensor=false'; 
        $file_contents = file_get_contents($request);
        $json_decode = json_decode($file_contents);
        if(isset($json_decode->results[0])) {
            $response = array();
            foreach($json_decode->results[0]->address_components as $addressComponet) {
                if(in_array('political', $addressComponet->types)) {
                    $response[] = $addressComponet->long_name; 
                }
            }
            if(isset($response[0])){ $first  =  $response[0];  } else { $first  = 'null'; }
            if(isset($response[1])){ $second =  $response[1];  } else { $second = 'null'; }
            if(isset($response[2])){ $third  =  $response[2];  } else { $third  = 'null'; }
            if(isset($response[3])){ $fourth =  $response[3];  } else { $fourth = 'null'; }
            if(isset($response[4])){ $fifth  =  $response[4];  } else { $fifth  = 'null'; }

            if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' ) {
                echo $first." , ".$second." , ".$fourth." , ".$fifth;
            }
            else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  ) {
                echo $first." , ".$second." , ".$third." , ".$fourth;
            }
            else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' ) {
                //echo "<br/>City:: ".$first;
                //echo "<br/>State:: ".$second;
                //echo "<br/>Country:: ".$third;
                echo $first." , ".$second." , ".$third;
            }
            else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
                //echo "<br/>State:: ".$first;
                //echo "<br/>Country:: ".$second;
                echo $first." , ".$second;
            }
            else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
                echo $first;
            }
        }
    }
    public function indexAction() {
        $parames = $this->getRequest()->getParams();
       // die();
        $address =$parames['rest'];
        Mage::getSingleton('core/session')->setSearchaddress($address);
=======
    public function indexAction() {
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
        if (!Mage::getStoreConfig('ced_csmarketplace/general/shopurl_active')) {
            $this->_redirect('/');
            return;
        }
        if (!Mage::helper('csmarketplace/acl')->isEnabled()) {
            $this->_forward('noRoute');
            return;
        }

        $this->setInformation();

        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('checkout/session');
        $title = Mage::getStoreConfig('ced_vshops/general/vshoppage_title', Mage::app()->getStore()->getId()) ? Mage::getStoreConfig('ced_vshops/general/vshoppage_title', Mage::app()->getStore()->getId()) : "CsMarketplace Vendor Shops";
        $this->getLayout()->getBlock('head')->setTitle(Mage::helper('csmarketplace')->__($title));
        if ($meta_description = Mage::getStoreConfig('ced_vseo/general/meta_description', Mage::app()->getStore()->getId()))
            $this->getLayout()->getBlock('head')->setDescription($meta_description);
        if ($meta_keywords = Mage::getStoreConfig('ced_vseo/general/meta_keywords', Mage::app()->getStore()->getId()))
            $this->getLayout()->getBlock('head')->setKeywords($meta_keywords);

        $this->renderLayout();
    }

    public function setInformation() {
<<<<<<< HEAD

        $this->_vendorCollection = Mage::getResourceModel('csmarketplace/vendor_collection')
        ->addAttributeToSelect('*')
        ->addAttributeToSelect(array(
            'store_latitude',
            'store_longitude',
            'delivery_radius'
            ), 'left')
        ->addAttributeToFilter('status', array('eq' => Ced_CsMarketplace_Model_Vendor::VENDOR_APPROVED_STATUS));
=======
        // $vendorIds = array();
        // $model = Mage::getModel('csmarketplace/vshop')->getCollection()->addFieldToFilter('shop_disable', array(
        //     'eq' => Ced_CsMarketplace_Model_Vshop::DISABLED
        // ));
        // if (count($model) > 0) {
        //     foreach ($model as $row) {
        //         $vendorIds [] = $row->getVendorId();
        //     }
        // }


        // $categoryCollection =  Mage::getModel('catalog/category')
        //     ->getCollection()
        //     ->addAttributeToFilter('entity_id', array('gt' => 4));

        // Zend_Debug::dump(get_class_methods(get_class($categoryCollection)));
        // Zend_Debug::dump($categoryCollection->getFilter());
        // die;


        $this->_vendorCollection = Mage::getResourceModel('csmarketplace/vendor_collection')
            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array(
                'store_latitude',
                'store_longitude',
                'delivery_radius'
            ), 'left')
            ->addAttributeToFilter('status', array('eq' => Ced_CsMarketplace_Model_Vendor::VENDOR_APPROVED_STATUS));

//        echo($this->_vendorCollection->getSelect());
        
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b

        $sortBy = $this->getRequest()->getQuery('sortby', 'distance');
        $sortDir = $this->getRequest()->getQuery('sortdir', 'asc');
        if ($sortBy === 'distance' || $sortBy === 'opens_at') {
            $this->_vendorCollection->getSelect()->order("$sortBy $sortDir");
        } else {
            $this->_vendorCollection->setOrder($sortBy, $sortDir);
        }
<<<<<<< HEAD
=======
        
//        Zend_Debug::dump($this->_vendorCollection->getData());
//        die;
        

        
        
        
        // Zend_Debug::dump(
        //     get_class_methods(get_class($this->_vendorCollection))
        // );
        // Zend_Debug::dump($this->_vendorCollection);
        // Zend_Debug::dump($this->_vendorCollection->getData());
        // die;

>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b

        $this->_vendorCollection->joinTable(
            array('vshop'=> 'mg_ced_csmarketplace_vendor_shop'), 
            'vendor_id=entity_id', 
            array('shop_disable'=>'shop_disable')
<<<<<<< HEAD
            );

        $this->_vendorCollection->addFilterToMap('distance', 'e.distance');
        $this->_vendorCollection->addFilterToMap('shop_disable', 'vshop.shop_disable');
        $this->_vendorCollection->addFieldToFilter('shop_disable', array('eq' => 1));
        
=======
        );

        // $this->_vendorCollection->_map['fields']['shop_disable'] = 'vshop.shop_disable';
        $this->_vendorCollection->addFilterToMap('distance', 'e.distance');
        $this->_vendorCollection->addFilterToMap('shop_disable', 'vshop.shop_disable');
        $this->_vendorCollection->addFieldToFilter('shop_disable', array('eq' => 1));
//        $this->_vendorCollection->addFieldToFilter('entity_id', array('in' => [10, 11]));


        
        
        // ->addAttributeToFilter();
        // ->where("`vshop`.`shop_disable` != " . Ced_CsMarketplace_Model_Vshop::DISABLED);


        // if (count($vendorIds) > 0) {
        //     $this->_vendorCollection = $this->_vendorCollection->addAttributeToFilter('entity_id', array(
        //         'nin' => $vendorIds
        //     ));
        // }

>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
        $char = $this->getRequest()->getParam('char');
        if (strlen($char)) {
            $this->_vendorCollection->addAttributeToFilter('public_name', array('like' => '%' . $char . '%'));
        }

        $fgroup = $this->getRequest()->getParam('fgroup');
        if (strlen($fgroup)) {
            $this->_vendorCollection->addAttributeToFilter('food_group', array('in' => $fgroup));
        }

        
        $rest = $this->getRequest()->getParam('rest');
<<<<<<< HEAD
        //echo "<pre>";
        //print_r($rest);
        //die();
        $validIds = [];
        $disatanceArray = [];
        if (strlen($rest)) {
           // $origin = str_replace(' ', '', $rest);
            $origin = $rest;
            //print_r($origin);

            $geocodeCacheId = 'geocode_cache';
            $geocodeCollection = unserialize(Mage::app()->loadCache($geocodeCacheId));


           // if (!$geocodeCollection || (is_array($geocodeCollection) && !array_key_exists($origin, $geocodeCollection) && Mage::app()->useCache('collections'))) {
            if($origin){
                $origin = urlencode($origin);
                $address_url = "https://maps.google.com/maps/api/geocode/json?address=$origin&sensor=false&key=AIzaSyCjvXmbMif9YChsxyB9QxMReWZE5SjpUbs";
                //print_r($address_url);

=======
        $validIds = [];
        $disatanceArray = [];
        if (strlen($rest)) {
            //echo $apikey; die("dfk");
            $origin = str_replace(' ', '', $rest);

            $geocodeCacheId = 'geocode_cache'; //unique id for your cache data
//                        Mage::app()->removeCache($geocodeCacheId);
            $geocodeCollection = unserialize(Mage::app()->loadCache($geocodeCacheId));
            if (!$geocodeCollection || (is_array($geocodeCollection) && !array_key_exists($origin, $geocodeCollection) && Mage::app()->useCache('collections'))) {
                $address_url = "http://maps.google.com/maps/api/geocode/json?address=$origin&sensor=false";
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $address_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $response = curl_exec($ch);
                curl_close($ch);
                $response_a = json_decode($response);
<<<<<<< HEAD

                $resp_json = file_get_contents($address_url);

    // decode the json
                $resp = json_decode($resp_json, true);
               // echo "<pre>";
                //print_r($resp);
                //die();

                //echo isset($resp['results'][0]['geometry']['location']['lat'];
                //echo isset($resp['results'][0]['geometry']['location']['lat'];
                 //die();

=======
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
                $tags = array('collections'); //cache tags will be explain later in detail
                $lifetime = false; //false means infinity, or you can specify number of seconds
                $priority = 8; // number between 0-9, used by few backend cache models
                $geocodeCollection[$origin] = array(
<<<<<<< HEAD
                    'lat' => $resp['results'][0]['geometry']['location']['lat'],
                    'lon' => $resp['results'][0]['geometry']['location']['lng']
                    );
=======
                    'lat' => $response_a->results[0]->geometry->location->lat,
                    'lon' => $response_a->results[0]->geometry->location->lng
                );
//                            Zend_Debug::dump($response_a->status);
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
                if ("OK" === $response_a->status) {
                    Mage::app()->saveCache(serialize($geocodeCollection), $geocodeCacheId, $tags, $lifetime, $priority);
                }
            }
//            Zend_Debug::dump($geocodeCollection);
            $response_a = $geocodeCollection[$origin];
            $lat1 = $response_a['lat'];
            $lon1 = $response_a['lon'];
<<<<<<< HEAD
            //die();

            
            if (!is_null($lat1) && !is_null($lon1)) {
                Mage::register('got_geo_codes', true);
                $this->_vendorCollection->getSelect()
                ->columns(array(
                    'distance' => new Zend_Db_Expr(
                        "round(((degrees(acos(sin(RADIANS($lat1)) * sin(RADIANS(`at_store_latitude`.`value`)) 
                        + cos(RADIANS($lat1)) * cos(RADIANS(`at_store_latitude`.`value`)) 
                                * cos(RADIANS($lon1 - `at_store_longitude`.`value`)))) * 60 * 1.5515) * 1.609344), 2)"
                        )
                    ));
                //echo "<pre>";    
                //print_r($this->_vendorCollection->getData());
                


                $i = 0;
                if ($lat1) {
                    foreach ($this->_vendorCollection->getData() as $val) {
                        //echo $val['entity_id'];
                        $lat2 = $val['store_latitude'];
                        //echo "<br/>";
                        $lon2 = $val['store_longitude'];
                        //echo "<br/>";

                        //die();

                        if (!$lat2) { continue; }
                        $unit = Mage::getStoreConfig('lod_configs/address_search_bar/radius_unit');
                        $theta = $lon1 - $lon2;
                        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                        $dist = acos($dist);
                        //echo "   ";
                        $dist = rad2deg($dist);
                        //echo "   ";
                        $miles = $dist * 60 * 1.1515;
                        $unit = strtoupper($unit);

                        if ($unit == "K") {
                            $Adist = $miles * 1.609344;
                            $val['delivery_radius'];
                            if ($Adist <= $val['delivery_radius']) {
                                $validIds [] = $val['entity_id'];
                                $disatanceArray [$i] ['id'] = $val['entity_id'];
                                $disatanceArray [$i] ['distance'] = round($Adist, 2) . " " . "km";
                                $i++;
                            }
                        } else if ($unit === 'M') {
                            //$miles;
                            //$Adist = $miles * 1.609344;
                            //$Adist = $dist;
                            $val['delivery_radius'];
                            $Adist = $miles;
                            if ($Adist <= $val['delivery_radius']) {
                                $validIds [] = $val['entity_id'];
                                $disatanceArray [$i] ['id'] = $val['entity_id'];
                                $disatanceArray [$i] ['distance'] = round($Adist, 2) . " " . "miles";
                                $i++;
                            }
                        } else { // defaults to K
                            $Adist = $miles * 1.609344;

=======
            
            if (!is_null($lat1) && !is_null($lon1)) {
//            if (1!==1) {
                Mage::register('got_geo_codes', true);
                $this->_vendorCollection->getSelect()
                    ->columns(array(
                        'distance' => new Zend_Db_Expr(
                            "round(((degrees(acos(sin(RADIANS($lat1)) * sin(RADIANS(`at_store_latitude`.`value`)) 
                                + cos(RADIANS($lat1)) * cos(RADIANS(`at_store_latitude`.`value`)) 
                                * cos(RADIANS($lon1 - `at_store_longitude`.`value`)))) * 60 * 1.5515) * 1.609344), 2)"
                        )
                ));
                
                $i = 0;
                if ($lat1) {
                    foreach ($this->_vendorCollection->getData() as $val) {
                        $lat2 = $val['store_latitude'];
                        $lon2 = $val['store_longitude'];
                        if (!$lat2) { continue; }
                        $unit = 'K';
                        $theta = $lon1 - $lon2;
                        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                        $dist = acos($dist);
                        $dist = rad2deg($dist);
                        //$miles = $dist * 60 * 1.4915; 1.1515
                        $miles = $dist * 60 * 1.5515;
                        $unit = strtoupper($unit);
                        if ($unit == "K") {
                            $Adist = $miles * 1.609344;
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
                            if ($Adist <= $val['delivery_radius']) {
                                $validIds [] = $val['entity_id'];
                                $disatanceArray [$i] ['id'] = $val['entity_id'];
                                $disatanceArray [$i] ['distance'] = round($Adist, 2) . " " . "km";
                                $i++;
                            }
                        }
                    }
                }
<<<<<<< HEAD
                //asort($validIds);
                //print_r($validIds);
                //die();

                $this->_vendorCollection->addFieldToFilter('entity_id', array('in' => $validIds));
            } else {
                Mage::register('got_geo_codes', false);
                $this->_vendorCollection->getSelect()->columns(array('distance' => new Zend_Db_Expr(0)));
=======
            } else {
                Mage::register('got_geo_codes', false);
//                $this->_redirect("*/*/*", $this->getRequest()->getQuery());
//                exit;
                
                $this->_vendorCollection->getSelect()->columns(array('distance' => new Zend_Db_Expr("null")));
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
                $i = 0;
                foreach ($this->_vendorCollection->getData() as $val) {
                    $validIds [] = $val['entity_id'];
                    $disatanceArray [$i] ['id'] = $val['entity_id'];
                    $disatanceArray [$i] ['distance'] = "N/A";
                    $i++;
                }
<<<<<<< HEAD
                asort($validIds);
                $this->_vendorCollection->addFieldToFilter('entity_id', array('in' => $validIds));
            }
        } else {
            Mage::register('got_geo_codes', false);
            $this->_vendorCollection->getSelect()->columns(array('distance' => new Zend_Db_Expr(0)));
            asort($validIds);
            $this->_vendorCollection->addFieldToFilter('entity_id', array('in' => $validIds));
        }
        
        if (!Mage::helper('csmarketplace')->isSharingEnabled()) {
            $this->_vendorCollection->addAttributeToFilter('website_id', array(
                'eq' => Mage::app()->getStore()->getWebsiteId()
                ));
        }
        
=======
            }
            asort($validIds);
            $this->_vendorCollection->addFieldToFilter('entity_id', array('in' => $validIds));
        }

        // if (strlen($rest)) {
            // $vcollection = Mage::getModel('csmarketplace/vendor')
            //         ->getCollection()
            //         ->addAttributeToSelect('*')
            //         ->addAttributeToFilter('status', array('eq' => Ced_CsMarketplace_Model_Vendor::VENDOR_APPROVED_STATUS))
            //         ->addAttributeToFilter('entity_id', ['in' => $validIds]);
        // }

        // $fgroup = $this->getRequest()->getParam('fgroup');
        // if (strlen($fgroup)) {
            // $vColllection = Mage::getModel('csmarketplace/vendor')
            //         ->getCollection()
            //         ->addAttributeToSelect('*')
            //         ->addAttributeToFilter('status', array('eq' => Ced_CsMarketplace_Model_Vendor::VENDOR_APPROVED_STATUS))
            //         ->addAttributeToFilter('entity_id', ['in' => $validIds]);
            // $ids = [];
            // $validId = [];
            // foreach ($vColllection as $key => $val) {
            //     $ids [] = $val->getId();
            // }
            // for ($i = 0; $i < count($ids); $i ++) {
            //     $fGroup = Mage::getModel('csmarketplace/vendor')->load($ids [$i])->getFoodGroup();
            //     $fGroup = explode(',', $fGroup);
            //     if (in_array($fgroup, $fGroup)) {
            //         $validId [] = $ids [$i];
            //     }
            // }
            // $vcollection->addFieldToFilter('entity_id', array('in' => $validId));

            // $j = 0;
            // foreach ($disatanceArray as $k => $v) {
            //     if (!in_array($v['id'], $validId)) {
            //         unset($disatanceArray[$j]);
            //     }
            //     $j++;
            // }
            // $disatanceArray = array_values($disatanceArray);
        // }
        if (!Mage::helper('csmarketplace')->isSharingEnabled()) {
            $this->_vendorCollection->addAttributeToFilter('website_id', array(
                'eq' => Mage::app()->getStore()->getWebsiteId()
            ));
        }


        //         $this->_vendorCollection->load();
        // var_dump($this->_vendorCollection->count());
        // $this->_vendorCollection->getSelect()->assemble();
        // Zend_Debug::dump($this->_vendorCollection->getData());
        // var_dump($this->_vendorCollection->count());
//        echo $this->_vendorCollection->getSelect(true);
        // Zend_Debug::dump($this->_vendorCollection);

        // die;



//        Zend_Debug::dump($this->_vendorCollection->getSize(), "Get Size: ");
//        Zend_Debug::dump($this->_vendorCollection->getSize(), "Count: ");
//        var_dump(count($this->_vendorCollection->loadData()));
//        die;



>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
        if (strlen($rest) == 1) {
            Mage::register('vshop_lists', [
                'vendor' => '',
                'distance' => $disatanceArray,
                'validIds' => $validIds
<<<<<<< HEAD
                ]);
        } elseif (strlen($rest) && !count($validIds)) {
         Mage::register('vshop_lists', [
             'vendor' => '',
             'distance' => $disatanceArray,
             'validIds' => $validIds
             ]);
     } elseif (strlen($rest)) {
         Mage::register('vshop_lists', [
             'vendor' => $this->_vendorCollection,
             'distance' => $disatanceArray,
             'validIds' => $validIds
             ]);
     } else {
        Mage::register('vshop_lists', [
            'vendor' => $this->_vendorCollection,
            'distance' => $disatanceArray,
            'validIds' => $validIds
            ]);
    }
}
=======
            ]);
        // } elseif (strlen($rest) && !count($validIds)) {
            // Mage::register('vshop_lists', [
            //     'vendor' => '',
            //     'distance' => $disatanceArray,
            //     'validIds' => $validIds
            // ]);
        // } elseif (strlen($rest)) {
            // Mage::register('vshop_lists', [
            //     'vendor' => $vcollection,
            //     'distance' => $disatanceArray,
            //     'validIds' => $validIds
            // ]);
        } else {
            // var_dump($this->_vendorCollection->count());
            Mage::register('vshop_lists', [
                'vendor' => $this->_vendorCollection,
                'distance' => $disatanceArray,
                'validIds' => $validIds
            ]);
        }
        // echo $this->_vendorCollection->getSelect(true);
    }
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b

    /**
     * Vendor Shop view action
     */
    public function viewAction() {
<<<<<<< HEAD
=======
//            die(__METHOD__);
//		Mage::app()->cleanCache();
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
        if (!Mage::getStoreConfig('ced_csmarketplace/general/shopurl_active')) {
            $this->_redirect('/');
            return;
        }
        if ($vendor = $this->_initVendor()) {
            if (Mage::registry('current_category') == null) {
                $category = Mage::getModel('catalog/category')->setStoreId(Mage::app()->getStore()->getId())->load(Mage::app()->getStore()->getRootCategoryId());
                Mage::register('current_category', $category);
            }
            $this->loadLayout();
            $this->getLayout()->getBlock('head')->setTitle($vendor->getPublicName() . " " . Mage::helper('csmarketplace')->__('Shop'));
            if ($vendor->getMetaDescription()) {
                $this->getLayout()->getBlock('head')->setDescription($vendor->getMetaDescription());
            }
            if ($vendor->getMetaKeywords()) {
                $this->getLayout()->getBlock('head')->setKeywords($vendor->getMetaKeywords());
            }
            $this->renderLayout();
        } else {
            $this->_forward('noRoute');
        }
    }

}
