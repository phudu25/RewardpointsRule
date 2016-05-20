<?php
namespace  Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog;

/**
 * Class Delete
 * @package Magestore\Rewardpoints\Controller\Adminhtml\Earningrates
 */
class Delete extends \Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Catalog
{

    /**
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        if ($this->getRequest()->getParam('id')) {
            $model = $this->_earningCatalogFactory->create();
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
