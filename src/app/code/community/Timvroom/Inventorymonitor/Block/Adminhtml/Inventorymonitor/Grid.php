<?php

class Timvroom_Inventorymonitor_Block_Adminhtml_Inventorymonitor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Timvroom_Inventorymonitor_Block_Adminhtml_Inventorymonitor_Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('grid_id');
        // $this->setDefaultSort('COLUMN_ID');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('inventorymonitor/stock')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {

        $this->addColumn('id', [
            'header' => $this->__('ID'),
            'width' => '50px',
            'index' => 'monitor_id'
        ]);

        $this->addColumn('created_at', [
            'header' => $this->__('Time'),
            'index' => 'created_at'
        ]);

        $this->addColumn('source', [
            'header' => $this->__('Source'),
            'index' => 'source'
        ]);

        $this->addColumn('description', [
            'header' => $this->__('Description'),
            'index' => 'Description'
        ]);

        $this->addColumn('product_id', [
            'header' => $this->__('Product Id'),
            'index' => 'product_id'
        ]);

        $this->addColumn('sku', [
            'header' => $this->__('Sku'),
            'index' => 'sku'
        ]);

        $this->addColumn('orig_qty', [
            'header' => $this->__('Old qty'),
            'index' => 'orig_qty'
        ]);

        $this->addColumn('qty', [
            'header' => $this->__('New qty'),
            'index' => 'qty'
        ]);

        $this->addColumn('diff', [
            'header' => $this->__('diff'),
            'index' => 'difference'
        ]);

        $this->addColumn('mismatch', [
            'header' => $this->__('Mismatch qty'),
            'index' => 'mismatch'
        ]);

        $this->addExportType('*/*/exportCsv', $this->__('CSV'));
        $this->addExportType('*/*/exportExcel', $this->__('Excel XML'));

        return parent::_prepareColumns();
    }

    /**
     * @param $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('inventorymonitor/stock')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));

        return $this;
    }
}
