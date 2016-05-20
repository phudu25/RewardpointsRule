<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales;

/**
 * Class NewAction
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
 */
class NewAction extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
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
