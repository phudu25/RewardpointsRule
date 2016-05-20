<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog;

/**
 * Class Index
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog
 */
class Index extends \Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = parent::execute();
        $resultPage->getConfig()->getTitle()->prepend(__('Catalog Earning Rule Manager'));

        return $resultPage;
    }
}
