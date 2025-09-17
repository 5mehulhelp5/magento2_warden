<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment8\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs tables in magento2 database, runs only once
     *
     * @param Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param Magento\Framework\Setup\ModuleContextInterface $context
     * @return null
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (!$setup->tableExists('employee_table')) {
            $table = $setup->getConnection()->newTable(
                $setup->getTable('employee_table')
            )
                ->addColumn(
                    'employee_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Employee ID'
                )
                ->addColumn(
                    'first_name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'First Name'
                )
                ->addColumn(
                    'last_name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Last Name'
                )
                ->addColumn(
                    'email_id',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Email ID'
                )
                ->setComment('Employee Table');
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
