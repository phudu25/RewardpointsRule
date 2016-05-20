<?php
namespace Magestore\RewardpointsRule\Model\ResourceModel\Spending\Sales;

/**
 * Class Collection
 * @package Magestore\RewardpointsRule\Model\ResourceModel\Spending\Sales
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'rule_id';
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\RewardpointsRule\Model\Spending\Sales', 'Magestore\RewardpointsRule\Model\ResourceModel\Spending\Sales');
    }

    /**
     * @param $customerGroupId
     * @param $websiteId
     * @param null $date
     * @return $this
     */
    public function setAvailableFilter($customerGroupId, $websiteId, $date = null)
    {
        if (is_null($date)) {
            $date = date('Y-m-d H:i:s');
        }
        $this->addFieldToFilter('website_ids', array('finset' => $websiteId))
            ->addFieldToFilter('customer_group_ids', array('finset' => $customerGroupId))
            ->addFieldToFilter('status', 1);

        $this->getSelect()->where("(from_date IS NULL) OR (DATE(from_date) <= ?)", $date)
            ->where("(to_date IS NULL) OR (DATE(to_date) >= ?)", $date)
            ->order('sort_order DESC');
        return $this;
    }

    /**
     * @param $websiteId
     * @param null $date
     * @return $this
     */
    public function getRulesForWebsite($websiteId,$date = null){
        if (is_null($date)) {
            $date = date('Y-m-d H:i:s');
        }
        $this->addFieldToFilter('website_ids', array('finset' => $websiteId))
            ->addFieldToFilter('status', 1);

        $this->getSelect()->where("(from_date IS NULL) OR (DATE(from_date) <= ?)", $date)
            ->where("(to_date IS NULL) OR (DATE(to_date) >= ?)", $date)
            ->order('sort_order DESC');
        return $this;
    }
}
