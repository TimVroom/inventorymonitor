<?php

class Timvroom_Inventorymonitor_Adminhtml_InventorymonitorController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('inventorymonitor/adminhtml_inventorymonitor'));
        $this->renderLayout();
    }

    public function exportCsvAction()
    {
        $fileName = 'Inventory Monitor_export.csv';
        $content = $this->getLayout()->createBlock('inventorymonitor/adminhtml_inventorymonitor_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction()
    {
        $fileName = 'Inventory Monitor_export.xml';
        $content = $this->getLayout()->createBlock('inventorymonitor/adminhtml_inventorymonitor_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select Inventory Monitor(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('inventorymonitor/stock')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('inventorymonitor')->__('An error occurred while mass deleting items. Please review log and try again.')
                );
                Mage::logException($e);

                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('inventorymonitor/stock');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('inventorymonitor')->__('This Inventory Monitor no longer exists.')
                );
                $this->_redirect('*/*/');

                return;
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('current_model', $model);

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('inventorymonitor/adminhtml_inventorymonitor_edit'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost()) {

            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('inventorymonitor/stock');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->_getSession()->addError(
                        Mage::helper('inventorymonitor')->__('This Inventory Monitor no longer exists.')
                    );
                    $this->_redirect('*/*/index');

                    return;
                }
            }

            // save model
            try {
                $model->addData($data);
                $this->_getSession()->setFormData($data);
                $model->save();
                $this->_getSession()->setFormData(false);
                $this->_getSession()->addSuccess(
                    Mage::helper('inventorymonitor')->__('The Inventory Monitor has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('inventorymonitor')->__('Unable to save the Inventory Monitor.'));
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));

                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel('inventorymonitor/stock');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('inventorymonitor')->__('Unable to find a Inventory Monitor to delete.'));
                }
                $model->delete();
                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('inventorymonitor')->__('The Inventory Monitor has been deleted.')
                );
                // go to grid
                $this->_redirect('*/*/index');

                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('inventorymonitor')->__('An error occurred while deleting Inventory Monitor data. Please review log and try again.')
                );
                Mage::logException($e);
            }
            // redirect to edit form
            $this->_redirect('*/*/edit', array('id' => $id));

            return;
        }
        // display error message
        $this->_getSession()->addError(
            Mage::helper('inventorymonitor')->__('Unable to find a Inventory Monitor to delete.')
        );
        // go to grid
        $this->_redirect('*/*/index');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/inventorymonitor');
    }
}