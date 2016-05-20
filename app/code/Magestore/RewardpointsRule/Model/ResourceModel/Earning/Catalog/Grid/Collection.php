<?php
namespace Magestore\RewardpointsRule\Model\ResourceModel\Earning\Catalog\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Class Collection
 * @package Magestore\RewardpointsRule\Model\ResourceModel\Earning\Catalog\Grid
 */
class Collection extends SearchResult
{
    /**
     * @param array|string $field
     * @param null $condition
     * @return $this
     */
    public function addFieldToFilter($field, $condition = null)
    {

        if ($field == 'customer_group_ids') {
            if(isset($condition['eq']) && $condition['eq']) {
                $condition = array('finset' => $condition['eq']);
            }
        }
        return parent::addFieldToFilter($field, $condition);
    }
}
