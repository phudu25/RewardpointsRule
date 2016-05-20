<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog;

/**
 * Class Index
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog
 */
class NewAction extends \Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog
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
