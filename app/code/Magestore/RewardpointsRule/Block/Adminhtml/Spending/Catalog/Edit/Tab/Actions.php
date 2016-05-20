<?php

namespace Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit\Tab;

/**
 * Class Actions
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit\Tab
 */
class Actions extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magestore\RewardpointsRule\Model\Status
     */
    protected $_status;

    /**
     * Actions constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magestore\RewardpointsRule\Model\Status $status
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magestore\RewardpointsRule\Model\Status $status,
        array $data = array()
    )
    {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_status = $status;
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        if ($this->_backendSession->getFormData()) {
            $data = $this->_backendSession->getFormData();
            $this->_backendSession->setFormData(null);
        } elseif ($this->_coreRegistry->registry('rule_data')) {
            $data = $this->_coreRegistry->registry('rule_data')->getData();
        }

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');
        $this->setForm($form);
        $fieldset = $form->addFieldset('actions_fieldset', array('legend' => __('Action')));

        $fieldset->addField('simple_action', 'select', array(
            'label' => __('Action'),
            'title' => __('Action'),
            'name' => 'simple_action',
            'options' => array(
                'fixed' => __('Discount for every X points')
            ),
            'onchange'  => 'toggleSimpleAction()',
            'note'=> __('Select the type to spend points')
        ));

        $fieldset->addField('points_spended', 'text', array(
            'label' => __('Points (X)'),
            'title' => __('Points (X)'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'points_spended',
        ));

        $fieldset->addField('max_price_spended_type', 'select', array(
            'label' => __('Limit spending points based on'),
            'title' => __('Limit spending points based on'),
            'name' => 'max_price_spended_type',
            'options' => array(
                \Magestore\RewardpointsRule\Model\Spending\Catalog::LIMIT_NONE    => __('None'),
                \Magestore\RewardpointsRule\Model\Spending\Catalog::LIMIT_BY_PRICE => __('A fixed amount of Price'),
                \Magestore\RewardpointsRule\Model\Spending\Catalog::LIMIT_BY_PERCENT => __('A percentage of Price'),
            ),
            'onchange'  => 'toggleMaxPriceSpend()',
            'note'=> __('Select the type to limit spending points')
        ));
        $fieldset->addField('max_price_spended_value', 'text', array(
            'label' => __('Limit value allowed to spend points at'),
            'title' => __('Limit value allowed to spend points at'),
            'name' => 'max_price_spended_value',
            'note' => __('Set the maximum number of Discount Amounts. If empty or zero, there is no limitation..')
        ));

        $fieldset->addField('discount_style', 'select', array(
            'label' => __('Discount Type'),
            'title' => __('Discount Type'),
            'name' => 'discount_style',
            'options' => array(
                'by_fixed' => __('By a fixed amount'),
                'to_fixed' => __('To a fixed amount'),
                'by_percent' => __('By a percentage of the original price'),
                'to_percent' => __('To a percentage of the original price'),
            ),
        ));

        $fieldset->addField('discount_amount', 'text', array(
            'label' => __('Discount amount'),
            'title' => __('Discount amount'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'discount_amount',
        ));

        $fieldset->addField('uses_per_product', 'text', array(
            'label' => __('Uses Allowed Per Product'),
            'title' => __('Uses Allowed Per Product'),
            'name' => 'uses_per_product',
            'note' => __('Set the maximum number of Discount Amounts. If empty or zero, there is no limitation.')
        ));

        $fieldset->addField('stop_rules_processing', 'select', array(
            'label' => __('Stop further rules processing'),
            'title' => __('Stop further rules processing'),
            'name' => 'stop_rules_processing',
            'options' => $this->_status->toOptionHashStop(),
        ));

//        $form->addFieldset('reward_history_fieldset', array('legend' => Mage::helper('rewardpointsrule')->__('Transactions history')))->setRenderer($this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset')->setTemplate('rewardpointsrule/example/catalog_spent_actions.phtml'));

        $form->setValues($data);
        return parent::_prepareForm();
    }
}
