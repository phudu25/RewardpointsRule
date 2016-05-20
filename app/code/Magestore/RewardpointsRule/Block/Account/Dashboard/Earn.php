<?php
namespace Magestore\RewardpointsRule\Block\Account\Dashboard;

/**
 * Class Earn
 * @package Magestore\RewardpointsRule\Block\Account\Dashboard
 */
class Earn extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magestore\RewardpointsRule\Model\Earning\CatalogFactory
     */
    protected $_earningCatalogFactory;

    /**
     * @var \Magestore\RewardpointsRule\Model\Earning\SalesFactory
     */
    protected $_earningSalesFactory;

    /**
     * @var \Magestore\Rewardpoints\Helper\Customer
     */
    protected $_helperCustomer;

    /**
     * @var \Magestore\RewardpointsRule\Helper\Data
     */
    protected $_helperRule;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;

    /**
     * Earn constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magestore\RewardpointsRule\Model\Earning\CatalogFactory $earningCatalogFactory
     * @param \Magestore\RewardpointsRule\Model\Earning\SalesFactory $earningSalesFactory
     * @param \Magestore\Rewardpoints\Helper\Customer $helperCustomer
     * @param \Magestore\RewardpointsRule\Helper\Data $helperRule
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magestore\RewardpointsRule\Model\Earning\CatalogFactory $earningCatalogFactory,
        \Magestore\RewardpointsRule\Model\Earning\SalesFactory $earningSalesFactory,
        \Magestore\Rewardpoints\Helper\Customer $helperCustomer,
        \Magestore\RewardpointsRule\Helper\Data $helperRule,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        array $data)
    {
        parent::__construct($context, $data);
        $this->_earningCatalogFactory = $earningCatalogFactory;
        $this->_earningSalesFactory = $earningSalesFactory;
        $this->_helperCustomer = $helperCustomer;
        $this->_helperRule = $helperRule;
        $this->_filterProvider = $filterProvider;
    }

    /**
     * @return int
     */
    public function getCustomerGroupId()
    {
        return  $this->_helperCustomer->getCustomer()->getGroupId();
    }

    /**
     * @return int
     */
    public function getWebsiteId()
    {
        return $this->_storeManager->getStore()->getWebsiteId();
    }

    /**
     * @return array
     */
    public function getCatalogRules()
    {
        if (!$this->_helperRule->isEnabled()) {
            return array();
        }
        return $this->_earningCatalogFactory->create()->getCollection()
            ->setAvailableFilter(
                $this->getCustomerGroupId(),
                $this->getWebsiteId(),
                date('Y-m-d H:i:s')
            );
    }

    /**
     * @return array
     */
    public function getShoppingCartRules()
    {
        if (!$this->_helperRule->isEnabled()) {
            return array();
        }
        return $this->_earningSalesFactory->create()->getCollection()
            ->setAvailableFilter(
                $this->getCustomerGroupId(),
                $this->getWebsiteId(),
                date('Y-m-d H:i:s')
            );
    }

    public function proccessEditor($text){
        return $this->_filterProvider->getPageFilter()->filter($text);
    }
}
