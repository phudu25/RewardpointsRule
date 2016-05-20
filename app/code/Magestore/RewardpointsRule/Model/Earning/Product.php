<?php
namespace Magestore\RewardpointsRule\Model\Earning;

/**
 * Class Product
 * @package Magestore\RewardpointsRule\Model\Earning
 */
class Product  extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\RewardpointsRule\Model\ResourceModel\Earning\Product');
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function applyAll() {
        $this->_getResource()->updateEarningProduct();
    }
}