<?php
namespace Magestore\RewardpointsRule\Model\Earning;

/**
 * Class Sales
 * @package Magestore\RewardpointsRule\Model\Earning
 */
class Sales  extends \Magento\Rule\Model\AbstractModel
{

    const ACTION_FIXED = 'fixed';
    const ACTION_BY_TOTAL = 'by_total';
    const ACTION_BY_QTY = 'by_qty';

    /**
     * @var \Magento\SalesRule\Model\Rule\Condition\Combine
     */
    protected $_ruleConditionCombine;

    /**
     * @var \Magento\SalesRule\Model\Rule\Condition\Product\Combine
     */
    protected $_ruleConditionProductCombine;

    /**
     * Sales constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\SalesRule\Model\Rule\Condition\Combine $ruleConditionCombine
     * @param \Magento\SalesRule\Model\Rule\Condition\Product\Combine $ruleConditionProductCombine
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\SalesRule\Model\Rule\Condition\Combine $ruleConditionCombine,
        \Magento\SalesRule\Model\Rule\Condition\Product\Combine $ruleConditionProductCombine,
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
        $this->_ruleConditionProductCombine = $ruleConditionProductCombine;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\RewardpointsRule\Model\ResourceModel\Earning\Sales');
        $this->setIdFieldName('rule_id');
    }

    /**
     * @return \Magento\SalesRule\Model\Rule\Condition\Combine
     */
    public function getConditionsInstance()
    {
        return $this->_ruleConditionCombine;
    }

    /**
     * @return \Magento\SalesRule\Model\Rule\Condition\Product\Combine
     */
    public function getActionsInstance()
    {
        return $this->_ruleConditionProductCombine;
    }

    /**
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
