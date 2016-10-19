<?php

class Timvroom_Inventorymonitor_Block_Adminhtml_Inventorymonitor extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'inventorymonitor';
        $this->_controller = 'adminhtml_inventorymonitor';
        // $this->_headerText      = $this->__('Grid Header Text');
        // $this->_addButtonLabel  = $this->__('Add Button Label');
        parent::__construct();
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new');
    }

}

