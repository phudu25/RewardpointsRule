<?php
namespace Magestore\RewardpointsRule\Controller\Adminhtml;

/**
 * Class ControllerContext
 * @package Magestore\RewardpointsRule\Controller\Adminhtml
 */
class ControllerContext implements \Magento\Framework\ObjectManager\ContextInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $_filterDate;

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_massActionFilter;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * ControllerContext constructor.
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date $filterDate
     * @param \Magento\Ui\Component\MassAction\Filter $massActionFilter
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $filterDate,
        \Magento\Ui\Component\MassAction\Filter $massActionFilter,
        \Magento\Framework\Registry $registry
    ) {
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        $this->_filterDate = $filterDate;
        $this->_massActionFilter = $massActionFilter;
        $this->_registry = $registry;
    }

    /**
     * @return \Magento\Framework\Controller\Result\JsonFactory
     */
    public function getResultJsonFactory(){
        return $this->_resultJsonFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function getResultPageFactory(){
        return $this->_resultPageFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\ForwardFactory
     */
    public function getResultForwardFactory(){
        return $this->_resultForwardFactory;
    }

    /**
     * @return \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    public function getFilterDate(){
        return $this->_filterDate;
    }

    /**
     * @return \Magento\Ui\Component\MassAction\Filter
     */
    public function getMassActionFilter(){
        return $this->_massActionFilter;
    }

    /**
     * @return \Magento\Framework\Registry
     */
    public function getRegistry(){
        return $this->_registry;
    }
}