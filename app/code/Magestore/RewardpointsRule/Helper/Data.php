<?php
namespace Magestore\RewardpointsRule\Helper;

/**
 * Class Data
 * @package Magestore\RewardpointsRule\Helper
 */
class Data extends \Magestore\Rewardpoints\Helper\Config
{
    const XML_PATH_ENABLE_PLUGIN    = 'rewardpoints/rewardpointsrule/enable';
    const XML_PATH_SHOW_ON_LISTING  = 'rewardpoints/display/product_listing';
	const XML_PATH_ENABLE_REWARDPOINTS = 'rewardpoints/general/enable';

    /**
     * @param null $store
     * @return bool
     */
    public function isEnabled($store = null)
    {
        return $this->getConfig(self::XML_PATH_ENABLE_PLUGIN, $store) && $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLE_REWARDPOINTS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store);
    }


    /**
     * @param null $store
     * @return bool
     */
    public function getCanShow($store = null)
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_SHOW_ON_LISTING,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store);
    }
}
