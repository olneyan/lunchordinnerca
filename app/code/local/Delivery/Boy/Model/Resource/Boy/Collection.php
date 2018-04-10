<?php

class Delivery_Boy_Model_Resource_Boy_Collection extends Mage_Eav_Model_Entity_Collection_Abstract {
 
    protected function _construct() {
        $this->_init('delivery_boy/boy');
    }
 
}