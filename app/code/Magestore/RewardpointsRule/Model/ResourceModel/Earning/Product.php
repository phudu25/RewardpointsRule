<?php
namespace Magestore\RewardpointsRule\Model\ResourceModel\Earning;

/**
 * Class Product
 * @package Magestore\RewardpointsRule\Model\ResourceModel\Earning
 */
class Product extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;

    /**
     * @var \Magestore\RewardpointsRule\Model\Earning\CatalogFactory
     */
    protected $_earningCatalog;

    /**
     * @var \Magestore\RewardpointsRule\Model\Earning\Indexer\Product
     */
    protected $_indexerProduct;

    /**
     * Product constructor.
     * @param Context $context
     * @param null|string $connectionName
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magestore\RewardpointsRule\Model\Earning\CatalogFactory $earningCatalog
     * @param \Magestore\RewardpointsRule\Model\Earning\Indexer\Product $indexerProduct
     */
    public function __construct(
        Context $context,
        $connectionName,
        \Magento\Catalog\Model\ProductFactory  $productFactory,
        \Magestore\RewardpointsRule\Model\Earning\CatalogFactory $earningCatalog,
        \Magestore\RewardpointsRule\Model\Earning\Indexer\Product $indexerProduct
    )
    {
        parent::__construct($context, $connectionName);
        $this->_productFactory = $productFactory;
        $this->_earningCatalog = $earningCatalog;
        $this->_indexerProduct = $indexerProduct;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('rewardpoints_earning_product', 'id');
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function updateEarningProduct() {
        $write = $this->_getWriteAdapter();
        $write->beginTransaction();

        //delete all
        $write->delete($this->getTable('rewardpoints_earning_product'));
        $write->commit();

        $rows = array();
        Mage::app()->loadAreaPart(Mage_Core_Model_App_Area::AREA_FRONTEND, Mage_Core_Model_App_Area::PART_EVENTS); // fix finalPrice
        $catalog_product = $this->_productFactory->create()->getCollection();
        // Prepare Catalog Product Collection to used for Rules
        $catalog_product->addAttributeToSelect('price')
            ->addAttributeToSelect('special_price')
            ->addAttributeToSelect('cost')
            ->addAttributeToSelect('tax_class_id');

        $rules = $this->_earningCatalog->create()->getCollection()
            ->addFieldToFilter('status', 1);
        $rules->getSelect()
            ->where("(from_date IS NULL) OR (DATE(from_date) <= ?)", now(true))
            ->where("(to_date IS NULL) OR (DATE(to_date) >= ?)", now(true));
        foreach ($rules as $rule) {
            $rule->afterLoad();
            $rule->getConditions()->collectValidatedAttributes($catalog_product);
        }

        try {
            foreach ($catalog_product as $product) {
                $datas = $this->_indexerProduct
                    ->getIndexProduct($product);

                foreach ($datas as $data) {
                    $rows[] = $data;
                }
                if (count($rows) == 1000) {
                    $write->insertMultiple($this->getTable('rewardpoints_earning_product'), $rows);
                    $rows = array();
                }
            }
            if (!empty($rows)) {
                $write->insertMultiple($this->getTable('rewardpoints_earning_product'), $rows);
            }
            $write->commit();
        } catch (Exception $e) {
            $write->rollback();
            throw $e;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWriteAdapter() {
        return $this->_getWriteAdapter();
    }

}
