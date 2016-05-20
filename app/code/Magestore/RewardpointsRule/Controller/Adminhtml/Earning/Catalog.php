<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml\Earning;

use Magento\Backend\App\Action\Context;

/**
 * Class Catalog
 * @package Magestore\RewardpointsRule\Controller\Adminhtml\Earning
 */
class Catalog extends \Magento\Backend\App\Action
{
    /**
     * @var \Magestore\RewardpointsRule\Model\Earning\CatalogFactory
     */
    protected $_earningCatalogFactory;

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
     * Catalog constructor.
     * @param Context $context
     * @param \Magestore\RewardpointsRule\Model\Earning\CatalogFactory $earningCatalogFactory
     * @param \Magestore\RewardpointsRule\Controller\Adminhtml\ControllerContext $controllerContext
     */
    public function __construct(
        Context $context,
        \Magestore\RewardpointsRule\Model\Earning\CatalogFactory $earningCatalogFactory,
        \Magestore\RewardpointsRule\Controller\Adminhtml\ControllerContext $controllerContext
    ) {
        parent::__construct($context);
        $this->_earningCatalogFactory = $earningCatalogFactory;
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
        $resultPage->setActiveMenu('Magestore_RewardpointsRule::Earning_Catalog');
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_RewardpointsRule::Earning_Catalog');
    }
}
