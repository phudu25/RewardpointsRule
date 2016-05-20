<?php

namespace Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit\Tab;

/**
 * Class Actions
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit\Tab
 */
class Actions extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magestore\RewardpointsRule\Model\Earning\SalesFactory
     */
    protected $_earningSalesFactory;

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
        \Magestore\RewardpointsRule\Model\Earning\SalesFactory $earningSalesFactory,
        \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset,
        \Magento\Rule\Block\Actions $actions,
        \Magestore\RewardpointsRule\Model\Status $status,
        array $data = array()
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_earningSalesFactory = $earningSalesFactory;
        $this->_rendererFieldset = $rendererFieldset;
        $this->_actions = $actions;
        $this->_status = $status;
    }

    protected function _prepareForm()
    {
        if ($this->getFormData()) {
            $data = $this->_backendSession->getFormData();
            $model = $this->_earningSalesFactory->create()
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
        $fieldset = $form->addFieldset('points_action_fieldset', array('legend' => __('Earning Point Action')));

        $fieldset->addField('simple_action', 'select', array(
            'label' => __('Action'),
            'title' => __('Action'),
            'name' => 'simple_action',
            'options' => array(
                \Magestore\RewardpointsRule\Model\Earning\Sales::ACTION_FIXED => __('Give fixed X points to Customers'),
                \Magestore\RewardpointsRule\Model\Earning\Sales::ACTION_BY_TOTAL => __('Give X points for every Y money spent'),
                \Magestore\RewardpointsRule\Model\Earning\Sales::ACTION_BY_QTY => __('Give X points for every Y qty purchased'),
            ),
            'onchange' => 'toggleSimpleAction()',
            'note'=> __('Select the type to earn points')
        ));

        $fieldset->addField('points_earned', 'text', array(
            'label' => __('Points (X)'),
            'title' => __('Points (X)'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'points_earned',
        ));

        $fieldset->addField('money_step', 'text', array(
            'label' => __('Money Step (Y)'),
            'title' => __('Money Step (Y)'),
            'name' => 'money_step',
            'after_element_html' => '<strong>[' . $this->_scopeConfig->getValue(\Magento\Directory\Model\Currency::XML_PATH_CURRENCY_BASE) . ']</strong>',
        ));

        $fieldset->addField('qty_step', 'text', array(
            'label' => __('Quantity (Y)'),
            'title' => __('Quantity (Y)'),
            'name' => 'qty_step',
        ));

        $fieldset->addField('max_points_earned', 'text', array(
            'label' => __('Maximum points earned by this rule'),
            'title' => __('Maximum points earned by this rule'),
            'name' => 'max_points_earned',
            'note' => __('Set the maximum number of Discount Amounts. If empty or zero, there is no limitation.')
        ));

        $fieldset->addField('stop_rules_processing', 'select', array(
            'label' => __('Stop further rules processing'),
            'title' => __('Stop further rules processing'),
            'name' => 'stop_rules_processing',
            'options' => $this->_status->toOptionHashStop(),
        ));

        $renderer = $this->_rendererFieldset->setTemplate('Magento_CatalogRule::promo/fieldset.phtml')
            ->setNewChildUrl($this->getUrl('sales_rule/promo_quote/newActionHtml/form/rule_actions_fieldset'));

        $fieldset = $form->addFieldset('actions_fieldset', array('legend' => __('Apply the rule only to cart items matching the following conditions (leave blank for all items)')))->setRenderer($renderer);

        $fieldset->addField('actions', 'text', array(
            'label' => __('Apply To'),
            'title' => __('Apply To'),
            'name' => 'actions',
        ))->setRule($model)->setRenderer($this->_actions);

//        $form->addFieldset('sales_action_example', array('legend' => Mage::helper('rewardpointsrule')->__('Example actions')))->setRenderer($this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset')->setTemplate('rewardpointsrule/example/sales_actions.phtml'));

        $form->setValues($data);
        return parent::_prepareForm();
    }
}
