<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog;

/**
 * Class InlineEdit
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
 */
class InlineEdit extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Catalog
{
    /**
     * @return $this
     */
    public function execute()
    {

        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->_resultJsonFactory->create();

        $model = $this->_spendingCatalogFactory->create();
        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }
        foreach (array_keys($postItems) as $ruleId) {
            $model->addData($postItems[$ruleId]);
            $model->setId($ruleId);
            $model->save();
        }

        return $resultJson->setData([
            'messages' => $this->getErrorMessages(),
            'error' => $this->isErrorExists(),

        ]);
    }

    /**
     * Get array with errors
     *
     * @return array
     */
    protected function getErrorMessages()
    {
        $messages = [];
        foreach ($this->getMessageManager()->getMessages()->getItems() as $error) {
            $messages[] = $error->getText();
        }
        return $messages;
    }

    /**
     * Check if errors exists
     *
     * @return bool
     */
    protected function isErrorExists()
    {
        return (bool)$this->getMessageManager()->getMessages(true)->getCount();
    }
}
