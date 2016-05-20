<?php
namespace Magestore\RewardpointsRule\Ui\DataProvider\Product;

use Magento\Framework\Data\Collection;
use Magento\Ui\DataProvider\AddFieldToCollectionInterface;

/**
 * Class AddRewardpointFieldToCollection
 * @package Magestore\RewardpointsRule\Ui\DataProvider\Product
 */
class AddRewardpointFieldToCollection implements AddFieldToCollectionInterface
{
    /**
     * {@inheritdoc}
     */
    public function addField(Collection $collection, $field, $alias = null)
    {
         $collection->addFieldToSelect($field);
    }
}
