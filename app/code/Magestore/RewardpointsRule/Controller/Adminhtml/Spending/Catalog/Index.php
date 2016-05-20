<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog;

/**
 * Class Index
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
 */
class Index extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = parent::execute();
        $resultPage->getConfig()->getTitle()->prepend(__('Catalog Spending Rule Manager'));

        return $resultPage;
    }
}
