<?php
namespace  Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales;

/**
 * Class Delete
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
 */
class Delete extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
{

    /**
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        if ($this->getRequest()->getParam('id')) {
            $model = $this->_spendingSalesFactory->create();
            try {
                $model->load($this->getRequest()->getParam('id'))->delete();
                $this->messageManager->addSuccess(__('Rule was deleted'));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
            return $this->_redirect('*/*/');
        }
    }
}
