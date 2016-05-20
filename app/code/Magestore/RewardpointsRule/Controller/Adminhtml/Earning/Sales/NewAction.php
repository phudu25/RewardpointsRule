<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales;

/**
 * Class NewAction
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales
 */
class NewAction extends \Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales
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
