<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog;

/**
 * Class MassDelete
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
 */
class MassDelete extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
{
    /**
     * @return $this
     */
    public function execute()
    {
        $ruledeleted = 0;
        $collection = $this->_filter->getCollection($this->_spendingCatalogFactory->create()->getCollection());
        foreach ($collection as $rule) {
            $rule->delete();
            $ruledeleted++;
        }

        if ($ruledeleted) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) were deleted.', $ruledeleted));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}
