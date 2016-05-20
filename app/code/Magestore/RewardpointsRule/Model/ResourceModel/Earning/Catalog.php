<?php
namespace Magestore\RewardpointsRule\Model\ResourceModel\Earning;

/**
 * Class Catalog
 * @package Magestore\RewardpointsRule\Model\ResourceModel\Earning
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
        $this->_init('rewardpoints_earning_catalog', 'rule_id');
    }

}
