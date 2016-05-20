<?php
namespace Magestore\RewardpointsRule\Model\Earning;

/**
 * Class Catalog
 * @package Magestore\RewardpointsRule\Model\Earning
 */
class Catalog  extends \Magento\Rule\Model\AbstractModel
{

    const ACTION_FIXED = 'fixed';
    const ACTION_BY_PRICE = 'by_price';
    const ACTION_BY_PROFIT = 'by_profit';
    /**
     * @var \Magento\CatalogRule\Model\Rule\Condition\Combine
     */
    protected $_ruleConditionCombine;

    /**
     * @var \Magento\CatalogRule\Model\Rule\Action\Collection
     */
    protected $_ruleActionCollection;

    /**
     * Catalog constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\CatalogRule\Model\Rule\Condition\Combine $ruleConditionCombine
     * @param \Magento\CatalogRule\Model\Rule\Action\Collection $ruleActionCollection
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\CatalogRule\Model\Rule\Condition\Combine $ruleConditionCombine,
        \Magento\CatalogRule\Model\Rule\Action\Collection $ruleActionCollection,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        parent::__construct(
            $context,
            $registry,
            $formFactory,
            $localeDate,
            $resource,
            $resourceCollection,
            $data
        );
        $this->_ruleConditionCombine = $ruleConditionCombine;
        $this->_ruleActionCollection = $ruleActionCollection;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\RewardpointsRule\Model\ResourceModel\Earning\Catalog');
    }

    /**
     * @return \Magento\CatalogRule\Model\Rule\Condition\Combine
     */

    public function getConditionsInstance()
    {
        return $this->_ruleConditionCombine;
    }

    /**
     * @return \Magento\CatalogRule\Model\Rule\Action\Collection
     */
    public function getActionsInstance()
    {
        return $this->_ruleActionCollection;
    }

    /**
     *load Rule posted from web
     *
     * @param array $rule
     * @return $this
     */
    public function loadPost(array $rule)
    {
        $arr = $this->_convertFlatToRecursive($rule);
        if (isset($arr['conditions'])) {
            $this->getConditions()->setConditions(array())->loadArray($arr['conditions'][1]);
        }
        if (isset($arr['actions'])) {
            $this->getActions()->setActions(array())->loadArray($arr['actions'][1], 'actions');
        }
        return $this;
    }

    /**
     * Fix error when load and save with collection
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        $this->setConditions(null);
        $this->setActions(null);
        return parent::_afterLoad();
    }

    /**
     * Fix bug when save website ids and customer group id in magento v1.7
     *
     * @return $this
     */
    public function beforeSave()
    {
        parent::beforeSave();
        if ($this->hasWebsiteIds()) {
            $websiteIds = $this->getWebsiteIds();
            if (is_array($websiteIds) && !empty($websiteIds)) {
                $this->setWebsiteIds(implode(',', $websiteIds));
            }
        }
        if ($this->hasCustomerGroupIds()) {
            $groupIds = $this->getCustomerGroupIds();
            if (is_array($groupIds) && !empty($groupIds)) {
                $this->setCustomerGroupIds(implode(',', $groupIds));
            }
        }
        return $this;
    }
}