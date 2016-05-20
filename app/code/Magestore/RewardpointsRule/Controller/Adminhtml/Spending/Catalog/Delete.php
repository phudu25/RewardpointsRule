<?php
namespace  Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog;

/**
 * Class Delete
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
 */
class Delete extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
{

    /**
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        if ($this->getRequest()->getParam('id')) {
            $model = $this->_spendingCatalogFactory->create();
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
