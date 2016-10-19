<?php

class Timvroom_Inventorymonitor_Block_Adminhtml_Inventorymonitor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Timvroom_Inventorymonitor_Block_Adminhtml_Inventorymonitor_Edit constructor.
     */
    public function __construct()
    {
        // $this->_objectId = 'id';
        parent::__construct();
        $this->_blockGroup = 'inventorymonitor';
        $this->_controller = 'adminhtml_inventorymonitor';
        $this->_mode = 'edit';
        $modelTitle = $this->_getModelTitle();
        $this->_updateButton('save', 'label', $this->_getHelper()->__("Save $modelTitle"));
        $this->_addButton('saveandcontinue', array(
            'label' => $this->_getHelper()->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * @return Mage_Core_Helper_Abstract
     */
    protected function _getHelper()
    {
        return Mage::helper('inventorymonitor');
    }

    /**
     * @return mixed
     */
    protected function _getModel()
    {
        return Mage::registry('current_model');
    }

    /**
     * @return string
     */
    protected function _getModelTitle()
    {
        return $this->_getHelper()->__('Inventory Monitor');
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        $model = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        if ($model && $model->getId()) {
            return $this->_getHelper()->__("Edit $modelTitle (ID: {$model->getId()})");
        } else {
            return $this->_getHelper()->__("New $modelTitle");
        }
    }


    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
    }

    /**
     * Get form save URL
     *
     * @deprecated
     * @see getFormActionUrl()
     * @return string
     */
    public function getSaveUrl()
    {
        $this->setData('form_action_url', 'save');

        return $this->getFormActionUrl();
    }
}
