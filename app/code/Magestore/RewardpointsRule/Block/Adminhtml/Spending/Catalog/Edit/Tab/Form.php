<?php

namespace Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit\Tab;

/**
 * Class Form
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit\Tab
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_cmsWysiwygConfig;

    /**
     * @var \Magento\Config\Model\Config\Source\Website
     */
    protected $_configSourceWebsite;

    /**
     * @var \Magento\Customer\Ui\Component\Listing\Column\Group\Options
     */
    protected $_customerGroup;

    /**
     * @var \Magestore\RewardpointsRule\Model\Status
     */
    protected $_status;

    /**
     * Form constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $cmsWysiwygConfig
     * @param \Magento\Config\Model\Config\Source\Website $configSourceWebsite
     * @param \Magento\Customer\Ui\Component\Listing\Column\Group\Options $customerGroup
     * @param \Magestore\RewardpointsRule\Model\Status $status
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $cmsWysiwygConfig,
        \Magento\Config\Model\Config\Source\Website $configSourceWebsite,
        \Magento\Customer\Ui\Component\Listing\Column\Group\Options $customerGroup,
        \Magestore\RewardpointsRule\Model\Status $status,
        array $data = array()
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_cmsWysiwygConfig = $cmsWysiwygConfig;
        $this->_configSourceWebsite = $configSourceWebsite;
        $this->_customerGroup = $customerGroup;
        $this->_status = $status;
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm() {
        if ($this->_backendSession->getFormData()) {
            $data = $this->_backendSession->getFormData();
            $this->_backendSession->setFormData(null);
        } elseif ($this->_coreRegistry->registry('rule_data')) {
            $data = $this->_coreRegistry->registry('rule_data')->getData();
        }
        if (!is_null($this->getRequest()->getParam('group_id'))) {
            $data['customer_group_ids'] = $this->getRequest()->getParam('group_id');
        }
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');
        $this->setForm($form);
        $fieldset = $form->addFieldset('general_fieldset', array('legend' => __('General Information')));

        $fieldset->addField('name', 'text', array(
            'label' => __('Rule Name'),
            'title' => __('Rule Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'name',
        ));

        $wysiwygConfig = $this->_cmsWysiwygConfig->getConfig(
            array(
                'hidden'=>false,
                'add_variables' => true,
                'add_widgets' => true,
                'add_images'=>true
            )
        );

        $fieldset->addField('description', 'editor', array(
            'name' => 'description',
            'label' => __('Description'),
            'title' => __('Description'),
            'style' => 'width:276px;height:100px;',
            'config'    => $wysiwygConfig,
            'note' => __('Rule description shown on Reward Information page'),
        ));

        $fieldset->addField('status', 'select', array(
            'label' => __('Status'),
            'title' => __('Status'),
            'name' => 'status',
            'values' => $this->_status->toOptionArray(),
        ));

        if (!$this->_storeManager->isSingleStoreMode()) {
            $fieldset->addField('website_ids', 'multiselect', array(
                'name' => 'website_ids[]',
                'label' => __('Websites'),
                'title' => __('Websites'),
                'required' => true,
                'values' => $this->_configSourceWebsite->toOptionArray(),
            ));
        } else {
            $fieldset->addField('website_ids', 'hidden', array(
                'name' => 'website_ids[]',
                'value' => $this->_storeManager->getStore(true)->getWebsiteId()
            ));
            $data['website_ids'] = $this->_storeManager->getStore(true)->getWebsiteId();
        }

        $fieldset->addField('customer_group_ids', 'multiselect', array(
            'label' => __('Customer groups'),
            'title' => __('Customer groups'),
            'name' => 'customer_group_ids',
            'required' => true,
            'values' => $this->_customerGroup->toOptionArray()
        ));

        $fieldset->addField('from_date', 'date', array(
            'name' => 'from_date',
            'label' => __('Valid from'),
            'title' => __('From date'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => \Magento\Framework\Stdlib\DateTime::DATE_INTERNAL_FORMAT,
            'date_format' => 'MM/dd/yyyy',
        ));

        $fieldset->addField('to_date', 'date', array(
            'name' => 'to_date',
            'label' => __('Valid to'),
            'title' => __('To date'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => \Magento\Framework\Stdlib\DateTime::DATE_INTERNAL_FORMAT,
            'date_format' => 'MM/dd/yyyy',
        ));

        $fieldset->addField('sort_order', 'text', array(
            'name' => 'sort_order',
            'label' => __('Priority'),
            'title' => __('Priority'),
            'note' => __('Rule with higher priority will be applied first.')
        ));

        $form->setValues($data);
        return parent::_prepareForm();
    }
}
