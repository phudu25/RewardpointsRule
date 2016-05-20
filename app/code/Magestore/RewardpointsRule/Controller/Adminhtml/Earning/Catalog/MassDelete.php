<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog;

/**
 * Class MassDelete
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog
 */
class MassDelete extends \Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog
{
    /**
     * @return $this
     */
    public function execute()
    {
        $ruledeleted = 0;
        $collection = $this->_massActionFilter->getCollection($this->_earningCatalogFactory->create()->getCollection());
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
