<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales;

/**
 * Class Index
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales
 */
class Index extends \Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = parent::execute();
        $resultPage->getConfig()->getTitle()->prepend(__('Shopping Cart Earning Rule Manager'));

        return $resultPage;
    }
}
