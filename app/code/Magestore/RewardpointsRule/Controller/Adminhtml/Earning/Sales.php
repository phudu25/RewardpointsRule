<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Earning;

use Magento\Backend\App\Action\Context;

/**
 * Class Sales
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning
 */
class Sales extends \Magento\Backend\App\Action
{
    /**
     * @var \Magestore\RewardpointsRule\Model\Earning\SalesFactory
     */
    protected $_earningSalesFactory;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_massActionFilter;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $_filterDate;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * Sales constructor.
     * @param Context $context
     * @param \Magestore\RewardpointsRule\Model\Earning\SalesFactory $earningSalesFactory
     * @param \Magestore\RewardpointsRule\Controller\Adminhtml\ControllerContext $controllerContext
     */
    public function __construct(
        Context $context,
        \Magestore\RewardpointsRule\Model\Earning\SalesFactory $earningSalesFactory,
        \Magestore\RewardpointsRule\Controller\Adminhtml\ControllerContext $controllerContext
    ) {
        parent::__construct($context);
        $this->_earningSalesFactory = $earningSalesFactory;
        $this->_resultJsonFactory = $controllerContext->getResultJsonFactory();
        $this->_resultPageFactory = $controllerContext->getResultPageFactory();
        $this->_resultForwardFactory = $controllerContext->getResultForwardFactory();
        $this->_massActionFilter = $controllerContext->getMassActionFilter();
        $this->_filterDate = $controllerContext->getFilterDate();
        $this->_registry = $controllerContext->getRegistry();
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Magestore_RewardpointsRule::Earning_Sales');
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_RewardpointsRule::Earning_Sales');
    }
}
