<?php

class Timvroom_Inventorymonitor_Model_Resource_Stock_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('inventorymonitor/stock');

        // add caluclated values
        $this->_fieldsToSelect = [
            '*',
            'difference' => new Zend_Db_Expr('main_table.orig_qty - main_table.new_qty'),
            'mismatch' => new Zend_Db_Expr('main_table.orig_qty - main_table.db_orig_qty')
        ];
    }
}