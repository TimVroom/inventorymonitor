<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$tableName = $installer->getTable('inventorymonitor/monitor');
$table = $installer->getConnection()
    ->newTable($tableName)->setComment('Monitoring of inventory')
    ->addColumn('monitor_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn('source', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
        'default' => 'magento'
    ), 'source')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
    ), 'Description')
    ->addColumn('additional', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
    ), 'Additional info')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 10, array(
        'nullable' => false,
    ), 'Product Id')
    ->addColumn('sku', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Sku')
    ->addColumn('stock_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 10, array(
        'nullable' => true,
    ), 'Stock id')
    ->addColumn('orig_qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable' => true,
    ), 'Original qty')
    ->addColumn('db_orig_qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable' => true,
    ), 'Original qty from table')
    ->addColumn('qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable' => true,
    ), 'New qty')
    ->addColumn('in_stock', Varien_Db_Ddl_Table::TYPE_SMALLINT, 5, array(
        'nullable' => true,
    ), 'New qty')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => true,
        'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT
    ), 'Create time')
    ->addForeignKey($installer->getFkName($tableName, 'product_id', $installer->getTable('catalog/product'), 'entity_id'),
        'product_id', $installer->getTable('catalog/product'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE);
$installer->getConnection()->createTable($table);

$installer->endSetup();