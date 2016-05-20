<?php
namespace Magestore\RewardpointsRule\Model\ResourceModel\Spending;

/**
 * Class Sales
 * @package Magestore\RewardpointsRule\Model\ResourceModel\Spending
 */
class Sales extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('rewardpoints_spending_sales', 'rule_id');
    }

}
