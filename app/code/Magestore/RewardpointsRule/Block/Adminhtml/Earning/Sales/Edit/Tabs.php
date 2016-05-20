<?php
namespace Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit;

/**
 * Class Tabs
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('earning_sales_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Shopping Cart Earning Rule Information'));
    }

    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        $this->addTab('general', array(
            'label' => __('General Information'),
            'title' => __('General Information'),
            'content' => $this->getLayout()->createBlock('Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit\Tab\Form')->toHtml(),
        ));

        $this->addTab('condition', array(
            'label' => __('Conditions'),
            'title' => __('Conditions'),
            'content' => $this->getLayout()->createBlock('Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit\Tab\Conditions')->toHtml(),
        ));

        $this->addTab('actions', array(
            'label' => __('Actions'),
            'title' => __('Actions'),
            'content' => $this->getLayout()->createBlock('Magestore\RewardpointsRule\Block\Adminhtml\Earning\Sales\Edit\Tab\Actions')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
