<?php

class Timvroom_Inventorymonitor_Model_Observer
{
    /**
     * @param $observer
     */
    public function cataloginventoryStockItemSaveBefore($observer)
    {

        $inv = $observer->getEvent()->getObject();
    }

    protected function _getPreviousEvent()
    {

    }

    protected function _getSource()
    {

    }
}

