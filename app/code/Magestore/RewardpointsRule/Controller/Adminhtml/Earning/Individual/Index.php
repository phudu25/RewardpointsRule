<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Individual;

/**
 * Class Index
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Individual
 */
class Index extends \Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Individual
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = parent::execute();
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Earning Points By Product'));

        return $resultPage;
    }
}
