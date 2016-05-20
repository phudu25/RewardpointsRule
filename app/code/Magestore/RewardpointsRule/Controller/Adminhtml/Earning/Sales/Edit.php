<?php
namespace  Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales;

/**
 * Class Edit
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales
 */
class Edit extends \Magestore\RewardpointsRule\Controller\Adminhtml\Earning\Sales
{
    /**
     * @return $this|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = parent::execute();
        $id     = $this->getRequest()->getParam('id');
        $model  = $this->_earningSalesFactory->create()->load($id);

        if ($model->getId() || $id == 0) {
            $data = $this->_session->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            $model->getConditions()->setJsFormObject('rule_conditions_fieldset');
            $model->getActions()->setJsFormObject('rule_actions_fieldset');
            $this->_registry->register('rule_data', $model);
            if ($model->getId()){
                $resultPage->getConfig()->getTitle()->prepend(__('Edit Rule "%1"',$model->getName()));
            }else{
                $resultPage->getConfig()->getTitle()->prepend(__('New Shopping Cart Earning Rule'));
            }
        } else {
            $this->_session->addError(__('The item does not exist'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/Index');
        }
        return  $resultPage;
    }
}
