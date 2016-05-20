<?php
namespace  Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales;

/**
 * Class Save
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
 */
class Save extends \Magestore\RewardpointsRule\Controller\Adminhtml\Spending\Sales
{

    /**
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data = $this->getRequest()->getPostValue()){
            $model = $this->_spendingSalesFactory->create()->load($this->getRequest()->getParam('id'));
            $data['from_date'] = $this->_filterDate->filter($data['from_date']);
            $data['to_date'] = $this->_filterDate->filter($data['to_date']);
            if (!$data['from_date']) $data['from_date'] = null;
            if (!$data['to_date']) $data['to_date'] = null;
            if (isset($data['rule'])) {
                $rules = $data['rule'];
                if (isset($rules['conditions'])) {
                    $data['conditions'] = $rules['conditions'];
                }
                if (isset($rules['actions'])) {
                    $data['actions'] = $rules['actions'];
                }
                unset($data['rule']);
            }
            try {
                $model->loadPost($data)
                    ->setData('from_date',$data['from_date'])
                    ->setData('to_date',$data['to_date'])
                    ->save()
                ;
                $this->messageManager->addSuccess(__('Rule was successfully saved'));
                $this->_session->setFormData(false);
                if ($this->getRequest()->getParam('back')=='edit') {
                    return $resultRedirect->setPath('*/*/edit', array('id' => $model->getId()));
                }
                if ($this->getRequest()->getParam('back') == 'new') {
                    return $resultRedirect->setPath('*/*/new');
                }
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_session->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', array('id' => $model->getId()));
            }
        }
        $this->messageManager->addError(__('Unable to find the item to save'));
        return $resultRedirect->setPath('*/*/');
    }
}
