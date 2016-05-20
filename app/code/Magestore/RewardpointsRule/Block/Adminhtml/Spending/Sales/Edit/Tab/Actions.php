<?php

namespace Magestore\RewardpointsRule\Block\Adminhtml\Spending\Sales\Edit\Tab;

/**
 * Class Actions
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Spending\Sales\Edit\Tab
 */
class Actions extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magestore\RewardpointsRule\Model\Spending\SalesFactory
     */
    protected $_spendingSalesFactory;

    /**
     * @var \Magento\Backend\Block\Widget\Form\Renderer\Fieldset
     */
    protected $_rendererFieldset;

    /**
     * @var \Magento\Rule\Block\Actions
     */
    protected $_actions;

    /**
     * @var \Magestore\RewardpointsRule\Model\Status
     */
    protected $_status;

    /**
     * Actions constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magestore\RewardpointsRule\Model\Earning\SalesFactory $earningSalesFactory
     * @param \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset
     * @param \Magento\Rule\Block\Actions $actions
     * @param \Magestore\RewardpointsRule\Model\Status $status
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magestore\RewardpointsRule\Model\Spending\SalesFactory $spendingSalesFactory,
        \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset,
        \Magento\Rule\Block\Actions $actions,
        \Magestore\RewardpointsRule\Model\Status $status,
        array $data = array()
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_spendingSalesFactory = $spendingSalesFactory;
        $this->_rendererFieldset = $rendererFieldset;
        $this->_actions = $actions;
        $this->_status = $status;
    }

    protected function _prepareForm()
    {
        if ($this->getFormData()) {
            $data = $this->_backendSession->getFormData();
            $model = $this->_spendingSalesFactory->create()
                ->load($data['rule_id'])
                ->setData($data);
            $this->_backendSession->setFormData(null);
        } elseif ($this->_coreRegistry->registry('rule_data')) {
            $model = $this->_coreRegistry->registry('rule_data');
            $data = $model->getData();
        }

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');
        $this->setForm($form);
        $fieldset = $form->addFieldset('points_action_fieldset', array('legend' => __('Spending Points')));

        $fieldset->addField('simple_action', 'select', array(
            'label' => __('Action'),
            'title' => __('Action'),
            'name' => 'simple_action',
            'options' => array(
                'fixed' => __('Give discount for fixed X points'),
                'by_price' => __('Give discount for every X points'),
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

        $fieldset->addField('max_points_spended', 'text', array(
            'label' => __('Maximum points allowed to spend'),
            'title' => __('Maximum points allowed to spend'),
            'name' => 'max_points_spended',
        ));

        $fieldset->addField('max_price_spended_type', 'select', array(
            'label' => __('Limit spending points based on'),
            'title' => __('Limit spending points based on'),
            'name' => 'max_price_spended_type',
            'options' => array(
                'none'    => __('None'),
                'by_price' => __('A fixed amount of Total Order Value'),
                'by_percent' => __('A percentage of Total Order Value'),
            ),
            'onchange'  => 'toggleMaxPriceSpend()',
            'note'=> __('Select the type of limit spending points')
        ));
        $fieldset->addField('max_price_spended_value', 'text', array(
            'label' => __('Limit value allowed to spend points at'),
            'title' => __('Limit value allowed to spend points at'),
            'name' => 'max_price_spended_value',
            'note' => __('Set the maximum number of Discount Amounts. If empty or zero, there is no limitation..')
        ));
        $fieldset->addField('discount_style', 'select', array(
            'label' => __('Action'),
            'title' => __('Action'),
            'name' => 'discount_style',
            'options' => array(
                'cart_fixed' => __('Give a fixed discount amount for the whole cart'),
                'by_percent' => __('Give a percent discount amount for the whole cart'),
            ),
        ));

        $fieldset->addField('discount_amount', 'text', array(
            'label' => __('Discount Amount'),
            'title' => __('Discount Amount'),
            'name' => 'discount_amount',
            'required' => true,
            'note'=> __('Discount received for every X points in tab Conditions')

        ));

        $fieldset->addField('stop_rules_processing', 'select', array(
            'label' => __('Stop further rules processing'),
            'title' => __('Stop further rules processing'),
            'name' => 'stop_rules_processing',
            'options' => $this->_status->toOptionHashStop(),
        ));

        $renderer = $this->_rendererFieldset
            ->setTemplate('Magento_CatalogRule::promo/fieldset.phtml')
            ->setNewChildUrl($this->getUrl('sales_rule/promo_quote/newActionHtml/form/rule_actions_fieldset'));

        $fieldset = $form->addFieldset('actions_fieldset', array('legend' => __('Apply the rule only to cart items matching the following conditions (leave blank for all items)')))->setRenderer($renderer);

        $fieldset->addField('actions', 'text', array(
            'label' => __('Apply To'),
            'title' => __('Apply To'),
            'name' => 'actions',
        ))->setRule($model)->setRenderer($this->_actions);

//        $form->addFieldset('sales_action_example', array('legend' => Mage::helper('rewardpointsrule')->__('Example actions')))->setRenderer($this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset')->setTemplate('rewardpointsrule/example/sales_spending_actions.phtml'));


//        $form->addFieldset('sales_action_example', array('legend' => Mage::helper('rewardpointsrule')->__('Example actions')))->setRenderer($this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset')->setTemplate('rewardpointsrule/example/sales_actions.phtml'));

        $form->setValues($data);
        return parent::_prepareForm();
    }
}
