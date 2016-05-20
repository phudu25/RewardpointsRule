<?php

namespace Magestore\RewardpointsRule\Block\Adminhtml\Earning\Catalog\Edit\Tab;

/**
 * Class Actions
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Earning\Catalog\Edit\Tab
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
        $fieldset = $form->addFieldset('actions_fieldset', array('legend' => __('Earning Point Action')));

        $fieldset->addField('simple_action', 'select', array(
            'label' => __('Action'),
            'title' => __('Action'),
            'name' => 'simple_action',
            'options' => array(
                \Magestore\RewardpointsRule\Model\Earning\Catalog::ACTION_FIXED => __('Give fixed X points to Customers'),
                \Magestore\RewardpointsRule\Model\Earning\Catalog::ACTION_BY_PRICE => __('Give X points for every Y amount of Price'),
                \Magestore\RewardpointsRule\Model\Earning\Catalog::ACTION_BY_PROFIT => __('Give X points for every Y amount of Profit'),
            ),
            'onchange'  => 'toggleSimpleAction()',
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
            'after_element_html' => '<strong>[' .$this->_scopeConfig->getValue(\Magento\Directory\Model\Currency::XML_PATH_CURRENCY_BASE) . ']</strong>',
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
        
//        $form->addFieldset('catalog_earned_actions_example', array('legend' => Mage::helper('rewardpointsrule')->__('Example actions')))->setRenderer($this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset')->setTemplate('rewardpointsrule/example/catalog_earned_actions.phtml'));

        $form->setValues($data);
        return parent::_prepareForm();
    }
}
