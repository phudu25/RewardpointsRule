<?php
namespace Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit;

/**
 * Class Tabs
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('spending_catalog_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Catalog Spending Rule Information'));
    }

    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'general',
            [
                'label' => __('General Information'),
                'content' =>  $this->getLayout()->createBlock(
                    'Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit\Tab\Form'
                )->toHtml()
            ]
        );

        $this->addTab('condition', array(
            'label' => __('Conditions'),
            'title' => __('Conditions'),
            'content' => $this->getLayout()->createBlock('Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit\Tab\Conditions')->toHtml(),
        ));

        $this->addTab('actions', array(
            'label' => __('Actions'),
            'title' => __('Actions'),
            'content' => $this->getLayout()->createBlock('Magestore\RewardpointsRule\Block\Adminhtml\Spending\Catalog\Edit\Tab\Actions')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
