<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Smtp
 * @copyright   Copyright (c) 2017 Mageplaza (https://www.mageplaza.com/)
 * @license     http://mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Smtp\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Mageplaza\Smtp\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * install tables
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     *
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('mageplaza_smtp_log')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('mageplaza_smtp_log'))
                ->addColumn('id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true,
                ], 'Log ID')
                ->addColumn('subject', Table::TYPE_TEXT, 255, ['nullable => false'], 'Email Subject')
                ->addColumn('email_content', Table::TYPE_TEXT, '64k', [], 'Email Content')
                ->addColumn('status', Table::TYPE_SMALLINT, 1, ['nullable' => false], 'Status')
                ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [], 'Created At')
                ->addIndex($installer->getIdxName('mageplaza_smtp_log', ['status']), ['status']);

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
