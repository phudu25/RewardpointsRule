<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales;

/**
 * Class MassStatus
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
 */
class MassStatus extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
{
    /**
     * @return $this
     */
    public function execute()
    {
        $ruleChangeStatus = 0;
        $collection = $this->_filter->getCollection($this->_spendingSalesFactory->create()->getCollection());
        foreach ($collection as $rule) {
            $rule->setStatus($this->getRequest()->getParam('status'))->save();
            $ruleChangeStatus++;
        }

        if ($ruleChangeStatus) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', $ruleChangeStatus));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}
