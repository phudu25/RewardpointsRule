<?php 

namespace Magestore\RewardpointsRule\Block\Adminhtml\Spending\Sales;

/**
 * Class Edit
 * @package Magestore\RewardpointsRule\Block\Adminhtml\Spending\Sales
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Edit constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_coreRegistry = $registry;
    }
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'Magestore_RewardpointsRule';
        $this->_controller = 'adminhtml_spending_sales';

        $this->buttonList->update('save', 'label', __('Save Rule'));
        $this->buttonList->update('delete', 'label', __('Delete Rule'));

        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ],
            ],
            -100
        );

        $this->buttonList->add(
            'new-button',
            [
                'label' => __('Save and New'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndNew', 'target' => '#edit_form'],
                    ],
                ],
            ],
            10
        );

        $this->_formScripts[] = "
            function toggleSimpleAction(){
                if ($('rule_simple_action').value == 'fixed') {
                    $('rule_max_points_spended').up(1).hide();
                    $('rule_max_price_spended_value').up(1).hide();
                    $('rule_max_price_spended_type').up(1).hide();
                } else {
                    $('rule_max_points_spended').up(1).show();
                    $('rule_max_price_spended_type').up(1).show();
                    toggleMaxPriceSpend();
                }
            }
            function toggleMaxPriceSpend(){
                if($('rule_max_price_spended_type').value == 'none'){
                    $('rule_max_price_spended_value').up(1).hide();
                }else{
                    $('rule_max_price_spended_value').up(1).show();
                }
            }

            require([\"prototype\",],
                function  () {
                    Event.observe(window, \"load\", function(){toggleSimpleAction();});
                });
        ";
    }

    /**
     * @return mixed
     */
    public function getRegistryModel()
    {
        return $this->_coreRegistry->registry('rule_data');
    }
    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->getRegistryModel()->getId()) {
            return __("Edit Rule '%1'", $this->escapeHtml($this->getRegistryModel()->getName()));
        } else {
            return __('Add Rule');
        }
    }
}
