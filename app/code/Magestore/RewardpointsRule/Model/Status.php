<?php
namespace Magestore\RewardpointsRule\Model;

/**
 * Class Status
 * @package Magestore\RewardpointsRule\Model
 */
class Status
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const STOP_YES = 1;
    const STOP_NO = 0;

    /**
     * @var array
     */
    protected $_stopArray;
    /**
     * @var array
     */

    protected $_array;
    /**
     * @return array
     */

    /**
     * @return array
     */
    public function toOptionHashStop()
    {
        if (!$this->_stopArray) {
            $this->_stopArray = [
                self::STOP_YES => __('Yes'),
                self::STOP_NO => __('No')
            ];
        }
        return $this->_stopArray;
    }

    /**
     * @return array
     */
    public function toOptionArrayStop()
    {
        $options = array();
        foreach (self::toOptionHashStop() as $value => $label) {
            $options[] = array(
                'value' => $value,
                'label' => $label
            );
        }
        return $options;
    }

    /**
     * @return array
     */
    public function toOptionHash()
    {
        if (!$this->_array) {
            $this->_array = [
                self::STATUS_ACTIVE => __('Active'),
                self::STATUS_INACTIVE => __('Inactive')
            ];
        }
        return $this->_array;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = array();
        foreach (self::toOptionHash() as $value => $label) {
            $options[] = array(
                'value' => $value,
                'label' => $label
            );
        }
        return $options;
    }
}