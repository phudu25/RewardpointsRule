<?php

namespace Magestore\RewardpointsRule\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package Magestore\RewardpointsRule\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var \Magento\Eav\Setup\EavSetup
     */
    protected $_eavSetup;

    /**
     * @var \Magento\Eav\Model\Entity\Type
     */
    protected $_entityTypeModel;

    /**
     * @var \Magento\Eav\Model\Entity\Attribute
     */
    protected $_catalogAttribute;

    /**
     * InstallSchema constructor.
     * @param \Magento\Eav\Setup\EavSetup $eavSetup
     * @param \Magento\Eav\Model\Entity\Type $entityTypeModel
     * @param \Magento\Eav\Model\Entity\Attribute $catalogAttribute
     */
    public function __construct(
        \Magento\Eav\Setup\EavSetup $eavSetup,
        \Magento\Eav\Model\Entity\Type $entityTypeModel,
        \Magento\Eav\Model\Entity\Attribute $catalogAttribute
    )
    {
        $this->_eavSetup = $eavSetup;
        $this->_entityTypeModel = $entityTypeModel;
        $this->_catalogAttribute = $catalogAttribute;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Drop tables if exists
         */
        $installer->getConnection()->dropTable($installer->getTable('rewardpoints_earning_catalog'));
        $installer->getConnection()->dropTable($installer->getTable('rewardpoints_earning_sales'));
        $installer->getConnection()->dropTable($installer->getTable('rewardpoints_earning_product'));
        $installer->getConnection()->dropTable($installer->getTable('rewardpoints_spending_catalog'));
        $installer->getConnection()->dropTable($installer->getTable('rewardpoints_spending_sales'));

        /**
         * Create table 'rewardpoints_earning_catalog'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('rewardpoints_earning_catalog'))
            ->addColumn(
                'rule_id',Table::TYPE_INTEGER,11,
                ['identity' => true, 'nullable' => false, 'primary' => true,'auto_increment' => true]
            )
            ->addColumn(
                'name',Table::TYPE_TEXT,255,
                ['nullable' => false]
            )

            ->addColumn(
                'description',Table::TYPE_TEXT,NULL,
                ['nullable' => true]
            )
            ->addColumn(
                'status',Table::TYPE_SMALLINT,6,
                ['nullable' => false, 'default'=>0]
            )
            ->addColumn(
                'website_ids',Table::TYPE_TEXT,255,
                ['nullable' => true]
            )
            ->addColumn(
                'customer_group_ids',Table::TYPE_TEXT,255,
                ['nullable' => true]
            )
            ->addColumn(
                'from_date',Table::TYPE_DATETIME,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'to_date',Table::TYPE_DATETIME,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'sort_order',Table::TYPE_INTEGER,11,
                ['nullable' => true]
            )
            ->addColumn(
                'conditions_serialized',Table::TYPE_TEXT,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'simple_action',Table::TYPE_TEXT,11,
                ['nullable' => false]
            )
            ->addColumn(
                'points_earned',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'money_step',Table::TYPE_DECIMAL,'12,4',
                ['nullable' => false]
            )
            ->addColumn(
                'max_points_earned',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'stop_rules_processing',Table::TYPE_SMALLINT,6,
                ['nullable' => false]
            );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'rewardpoints_earning_sales'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('rewardpoints_earning_sales'))
            ->addColumn(
                'rule_id',Table::TYPE_INTEGER,11,
                ['identity' => true, 'nullable' => false, 'primary' => true,'auto_increment' => true]
            )
            ->addColumn(
                'name',Table::TYPE_TEXT,255,
                ['nullable' => false]
            )

            ->addColumn(
                'description',Table::TYPE_TEXT,NULL,
                ['nullable' => true]
            )
            ->addColumn(
                'status',Table::TYPE_SMALLINT,6,
                ['nullable' => false, 'default'=>0]
            )
            ->addColumn(
                'website_ids',Table::TYPE_TEXT,255,
                ['nullable' => true]
            )
            ->addColumn(
                'customer_group_ids',Table::TYPE_TEXT,255,
                ['nullable' => true]
            )
            ->addColumn(
                'from_date',Table::TYPE_DATETIME,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'to_date',Table::TYPE_DATETIME,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'sort_order',Table::TYPE_INTEGER,11,
                ['nullable' => true]
            )
            ->addColumn(
                'conditions_serialized',Table::TYPE_TEXT,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'actions_serialized',Table::TYPE_TEXT,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'simple_action',Table::TYPE_TEXT,11,
                ['nullable' => false]
            )
            ->addColumn(
                'points_earned',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'money_step',Table::TYPE_DECIMAL,'12,4',
                ['nullable' => false]
            )
            ->addColumn(
                'qty_step',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'max_points_earned',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'stop_rules_processing',Table::TYPE_SMALLINT,6,
                ['nullable' => false]
            );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'rewardpoints_earning_product'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('rewardpoints_earning_product'))
            ->addColumn(
                'id',Table::TYPE_INTEGER,11,
                ['identity' => true, 'nullable' => false, 'primary' => true,'auto_increment' => true]
            )
            ->addColumn(
                'customer_group_id',Table::TYPE_SMALLINT,10,
                ['nullable' => false]
            )
            ->addColumn(
                'website_id',Table::TYPE_SMALLINT,5,
                ['nullable' => false]
            )
            ->addColumn(
                'product_id',Table::TYPE_INTEGER,10,
                ['nullable' => false]
            )
            ->addColumn(
                'rule_ids',Table::TYPE_TEXT,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'earning_point',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'rewardpoints_spending_catalog'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('rewardpoints_spending_catalog'))
            ->addColumn(
                'rule_id',Table::TYPE_INTEGER,11,
                ['identity' => true, 'nullable' => false, 'primary' => true,'auto_increment' => true]
            )
            ->addColumn(
                'name',Table::TYPE_TEXT,255,
                ['nullable' => false]
            )
            ->addColumn(
                'description',Table::TYPE_TEXT,NULL,
                ['nullable' => true]
            )
            ->addColumn(
                'status',Table::TYPE_SMALLINT,6,
                ['nullable' => false, 'default'=>0]
            )
            ->addColumn(
                'website_ids',Table::TYPE_TEXT,255,
                ['nullable' => true]
            )
            ->addColumn(
                'customer_group_ids',Table::TYPE_TEXT,255,
                ['nullable' => true]
            )
            ->addColumn(
                'from_date',Table::TYPE_DATETIME,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'to_date',Table::TYPE_DATETIME,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'sort_order',Table::TYPE_INTEGER,11,
                ['nullable' => true]
            )
            ->addColumn(
                'conditions_serialized',Table::TYPE_TEXT,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'simple_action',Table::TYPE_TEXT,11,
                ['nullable' => false]
            )
            ->addColumn(
                'points_spended',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'money_step',Table::TYPE_DECIMAL,'12,4',
                ['nullable' => false]
            )
            ->addColumn(
                'qty_step',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'max_points_spended',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'discount_style',Table::TYPE_TEXT,255,
                ['nullable' => false]
            )
            ->addColumn(
                'discount_amount',Table::TYPE_DECIMAL,'12,4',
                ['nullable' => false]
            )
            ->addColumn(
                'uses_per_product',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'stop_rules_processing',Table::TYPE_SMALLINT,6,
                ['nullable' => false]
            )
            ->addColumn(
                'max_price_spended_type',Table::TYPE_TEXT,255,
                ['nullable' => false]
            )
            ->addColumn(
                'max_price_spended_value',Table::TYPE_DECIMAL,'12,4',
                ['nullable' => false]
            );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'rewardpoints_spending_sales'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('rewardpoints_spending_sales'))
            ->addColumn(
                'rule_id',Table::TYPE_INTEGER,11,
                ['identity' => true, 'nullable' => false, 'primary' => true,'auto_increment' => true]
            )
            ->addColumn(
                'name',Table::TYPE_TEXT,255,
                ['nullable' => false]
            )
            ->addColumn(
                'description',Table::TYPE_TEXT,NULL,
                ['nullable' => true]
            )
            ->addColumn(
                'status',Table::TYPE_SMALLINT,6,
                ['nullable' => false, 'default'=>0]
            )
            ->addColumn(
                'website_ids',Table::TYPE_TEXT,255,
                ['nullable' => true]
            )
            ->addColumn(
                'customer_group_ids',Table::TYPE_TEXT,255,
                ['nullable' => true]
            )
            ->addColumn(
                'from_date',Table::TYPE_DATETIME,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'to_date',Table::TYPE_DATETIME,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'sort_order',Table::TYPE_INTEGER,11,
                ['nullable' => true]
            )
            ->addColumn(
                'conditions_serialized',Table::TYPE_TEXT,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'actions_serialized',Table::TYPE_TEXT,NULL,
                ['nullable' => false]
            )
            ->addColumn(
                'simple_action',Table::TYPE_TEXT,11,
                ['nullable' => false]
            )
            ->addColumn(
                'points_spended',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'money_step',Table::TYPE_DECIMAL,'12,4',
                ['nullable' => false]
            )
            ->addColumn(
                'max_points_spended',Table::TYPE_INTEGER,11,
                ['nullable' => false]
            )
            ->addColumn(
                'discount_style',Table::TYPE_TEXT,255,
                ['nullable' => false]
            )
            ->addColumn(
                'discount_amount',Table::TYPE_DECIMAL,'12,4',
                ['nullable' => false]
            )
            ->addColumn(
                'stop_rules_processing',Table::TYPE_SMALLINT,6,
                ['nullable' => false]
            )
            ->addColumn(
                'max_price_spended_type',Table::TYPE_TEXT,255,
                ['nullable' => false]
            )
            ->addColumn(
                'max_price_spended_value',Table::TYPE_DECIMAL,'12,4',
                ['nullable' => false]
            );
        $installer->getConnection()->createTable($table);


        $dataAttributeEarningPoint = array(
            'group'                      => 'General',
            'type'                       => 'int',
            'input'                      => 'text',
            'label'                      => 'Number of points earned',
            'required'                   => false,
            'frontend_class'            => 'validate-digits',
            'sort_order'                 => 10,
            'global'                     => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
            'visible'                    => 1,
            'user_defined'               => 1,
            'apply_to' => 'simple,configurable,virtual,downloadable',
            'is_used_for_promo_rules' => 1,
            'used_in_product_listing' => 1,
        );
        $catalogAttributeModel = $this->_catalogAttribute;
        $this->_eavSetup->addAttribute($this->_entityTypeModel->loadByCode('catalog_product')->getData('entity_type_id'), 'rewardpoints_earn', $dataAttributeEarningPoint);

        $attribute = $catalogAttributeModel->loadByCode('catalog_product', 'rewardpoints_earn');
        $attribute->addData(array('is_used_for_promo_rules' => 1))->save();

        $dataAttributeSpendingPoint =  array(
            'type'                       => 'int',
            'input'                      => 'text',
            'label'                      => 'Buy with number of points',
            'required'                   => false,
            'frontend_class'            => 'validate-digits',
            'sort_order'                 => 10,
            'global'                     => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
            'visible'                    => 1,
            'group'                      => 'General',
            'user_defined'               => 1,
            'apply_to' => 'simple,configurable,virtual,downloadable',
            'is_used_for_promo_rules' => 1,
            'used_in_product_listing' => 1,
        );
        $this->_eavSetup->addAttribute($this->_entityTypeModel->loadByCode('catalog_product')->getData('entity_type_id'), 'rewardpoints_spend',$dataAttributeSpendingPoint);
        $attribute = $catalogAttributeModel->loadByCode('catalog_product', 'rewardpoints_spend');
        $attribute->addData(array('is_used_for_promo_rules' => 1))->save();

        $installer->endSetup();
    }

}
