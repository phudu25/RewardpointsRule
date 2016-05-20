<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales;

/**
 * Class MassDelete
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
 */
class MassDelete extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
{
    /**
     * @return $this
     */
    public function execute()
    {
        $ruledeleted = 0;
        $collection = $this->_filter->getCollection($this->_spendingSalesFactory->create()->getCollection());
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
