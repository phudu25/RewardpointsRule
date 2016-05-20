<?php

namespace Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit\Tab;

/**
 * Class Conditions
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit\Tab
 */
class Conditions extends \Magento\Backend\Block\Widget\Form\Generic
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
     * @var \Magento\Rule\Block\Conditions
     */
    protected $_conditions;

    /**
     * Conditions constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magestore\RewardpointsRule\Model\Earning\SalesFactory $earningSalesFactory
     * @param \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset
     * @param \Magento\Rule\Block\Conditions $conditions
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magestore\RewardpointsRule\Model\Earning\SalesFactory $earningSalesFactory,
        \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset,
        \Magento\Rule\Block\Conditions $conditions,
        array $data = array()
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_earningSalesFactory = $earningSalesFactory;
        $this->_rendererFieldset = $rendererFieldset;
        $this->_conditions = $conditions;
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        if ( $this->_backendSession->getFormData()){
            $data = $this->_backendSession->getFormData();
            $model = $this->_earningSalesFactory->create()
                ->load($data['rule_id'])
                ->setData($data);
            $this->_backendSession->setFormData(null);
        } elseif ( $this->_coreRegistry->registry('rule_data')){
            $model = $this->_coreRegistry->registry('rule_data');
            $data = $model->getData();
        }

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');

        $renderer = $this->_rendererFieldset->setTemplate('Magento_CatalogRule::promo/fieldset.phtml')
            ->setNewChildUrl($this->getUrl('sales_rule/promo_quote/newConditionHtml/form/rule_conditions_fieldset'))
        ;

        $fieldset = $form->addFieldset('conditions_fieldset', array('legend'=>__('Apply the rule to shopping carts only if the following conditions are met (leave blank for all carts)')))->setRenderer($renderer);

        $fieldset->addField('conditions','text',array(
            'name'	=> 'conditions',
            'label'	=> __('Conditions'),
            'title'	=> __('Conditions'),
            'required'	=> true,
        ))->setRule($model)->setRenderer($this->_conditions);

//        $form->addFieldset('sales_conditions_example', array('legend' => Mage::helper('rewardpointsrule')->__('Example conditions')))->setRenderer($this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset')->setTemplate('rewardpointsrule/example/sales_conditions.phtml'));

        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}