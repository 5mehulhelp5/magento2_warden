<?php

namespace RajNishad\Assignment8\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $connection = $setup->getConnection();
            $tableName = $setup->getTable('employee_table');

            if ($connection->isTableExists($tableName)) {
                // Add address column
                $connection->addColumn(
                    $tableName,
                    'address',
                    [
                        'type' => Table::TYPE_TEXT,
                        'length' => 255,
                        'nullable' => false,
                        'comment' => 'Address'
                    ]
                );

                // Add phone_number column
                $connection->addColumn(
                    $tableName,
                    'phone_number',
                    [
                        'type' => Table::TYPE_TEXT,
                        'length' => 10,
                        'nullable' => false,
                        'comment' => 'Phone Number'
                    ]
                );
            }
        }

        $setup->endSetup();
    }
}
