<?php
namespace Magestore\RewardpointsRule\Model\ResourceModel\Spending;

/**
 * Class Catalog
 * @package Magestore\RewardpointsRule\Model\ResourceModel\Spending
 */
class Catalog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('rewardpoints_spending_catalog', 'rule_id');
    }

}
