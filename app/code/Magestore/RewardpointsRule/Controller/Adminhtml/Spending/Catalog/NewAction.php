<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog;

/**
 * Class NewAction
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
 */
class NewAction extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
{
    /**
     * Create new action
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();
        $resultForward->forward('edit');
        return $resultForward;
    }
}
