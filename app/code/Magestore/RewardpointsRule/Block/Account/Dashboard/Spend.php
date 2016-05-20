<?php
namespace Magestore\RewardpointsRule\Block\Account\Dashboard;

/**
 * Class Spend
 * @package Magestore\RewardpointsRule\Block\Account\Dashboard
 */
class Spend extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magestore\RewardpointsRule\Model\Spending\CatalogFactory
     */
    protected $_spendingCatalogFactory;

    /**
     * @var \Magestore\RewardpointsRule\Model\Spending\SalesFactory
     */
    protected $_spendingSalesFactory;

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
     * Spend constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magestore\RewardpointsRule\Model\Spending\CatalogFactory $spendingCatalogFactory
     * @param \Magestore\RewardpointsRule\Model\Spending\SalesFactory $spendingSalesFactory
     * @param \Magestore\Rewardpoints\Helper\Customer $helperCustomer
     * @param \Magestore\RewardpointsRule\Helper\Data $helperRule
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magestore\RewardpointsRule\Model\Spending\CatalogFactory $spendingCatalogFactory,
        \Magestore\RewardpointsRule\Model\Spending\SalesFactory $spendingSalesFactory,
        \Magestore\Rewardpoints\Helper\Customer $helperCustomer,
        \Magestore\RewardpointsRule\Helper\Data $helperRule,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        array $data)
    {
        parent::__construct($context, $data);
        $this->_spendingCatalogFactory = $spendingCatalogFactory;
        $this->_spendingSalesFactory = $spendingSalesFactory;
        $this->_helperCustomer = $helperCustomer;
        $this->_helperRule = $helperRule;
        $this->_filterProvider = $filterProvider;
    }

     /**
     * get customer group id
     * 
     * @return int
     */
    public function getCustomerGroupId()
    {
        return  $this->_helperCustomer->getCustomer()->getGroupId();
    }
    
    
     /**
     * get website group id
     * 
     * @return int
     */
    public function getWebsiteId()
    {
        return $this->_storeManager->getStore()->getWebsiteId();
    }
    
    /**
     * get catalog spending rules
     * 
     * @return Magestore_RewardPointsRule_Model_Earning_Sales_Collection
     */
    public function getCatalogRules()
    {
        if (!$this->_helperRule->isEnabled()) {
            return array();
        }
        return $this->_spendingCatalogFactory->create()->getCollection()
            ->setAvailableFilter(
                $this->getCustomerGroupId(),
                $this->getWebsiteId(),
                date('Y-m-d H:i:s')
            );
    }
    
    /**
     * get shippongcart spending rules
     * 
     * @return Magestore_RewardPointsRule_Model_Earning_Catalog_Collection
     */
    public function getShoppingCartRules()
    {
        if (!$this->_helperRule->isEnabled()) {
            return array();
        }
        return $this->_spendingSalesFactory->create()->getCollection()
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
