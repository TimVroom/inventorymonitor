<?php

class Timvroom_Inventorymonitor_Model_Resource_Stock extends Mage_Core_Model_Resource_Db_Abstract
{
    protected $_serializableFields = [
        'additional' => [null, []]
    ];

    protected function _construct()
    {
        $this->_init('inventorymonitor/monitor', 'monitor_id');
    }
}