<?php

class Timvroom_Inventorymonitor_Model_Stock extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'inventorymonitor_stock';

    protected function _construct()
    {
        $this->_init('inventorymonitor/stock');
    }

}