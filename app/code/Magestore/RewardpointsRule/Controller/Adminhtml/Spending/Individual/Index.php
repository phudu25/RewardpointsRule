<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Individual;

/**
 * Class Index
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Individual
 */
class Index extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Individual
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = parent::execute();
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Spending Points By Product'));

        return $resultPage;
    }
}
