<?php

namespace RajNishad\Assignment15\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (!$setup->tableExists('raj_assignment15_group_sales')) {
            $table = $setup->getConnection()->newTable(
                $setup->getTable('raj_assignment15_group_sales')
            )->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'ID'
            )->addColumn(
                'customer_group_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Customer Group ID'
            )->addColumn(
                'total_sales',
                Table::TYPE_DECIMAL,
                '12,4',
                ['nullable' => false, 'default' => '0.0000'],
                'Total Sales Amount'
            )->setComment('Total Sales by Customer Group');

            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
