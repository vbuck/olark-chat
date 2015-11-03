<?php

/**
 * Olark chat output block.
 * 
 * PHP Version 5
 * 
 * @category  Class
 * @package   Vbuck_OlarkChat
 * @author    Rick Buczynski <me@rickbuczynski.com>
 * @copyright 2015 Rick Buczynski
 */

/**
 * Class declaration
 *
 * @category Class_Type_Block
 * @package  Vbuck_OlarkChat
 * @author   Rick Buczynski <me@rickbuczynski.com>
 */

class Vbuck_OlarkChat_Block_Widget
    extends Mage_Core_Block_Abstract
{

    protected $_excludedHandles = array();

    /**
     * Local constructor.
     * 
     * @return Vbuck_OlarkChat_Block_Widget
     */
    protected function _construct()
    {
        $this->addData(
            array(
                'cache_lifetime' => 86400,
                'cache_tags'     => array('OLARK_WIDGET'),
                'cache_key'      => "CHAT_{$this->getOlarkId()}",
            )
        );

        $this->_excludedHandles = array_map( 'trim', ( preg_split('/[\r\n]+/', Mage::getStoreConfig('olark/chat_widget/excluded_handles')) ) );

        return $this;
    }

    /**
     * Pre-render processing.
     * 
     * @return string
     */
    protected function _toHtml($html = '')
    {
        return $html . Mage::getStoreConfig('olark/chat_widget/script_template');
    }

    /**
     * Post-render processing.
     * 
     * @param string $html The rendered output.
     * 
     * @return string
     */
    protected function _afterToHtml($html = '')
    {
        if (!$this->isEnabled()) {
            return '';
        }

        $processor = Mage::getModel('cms/template_filter')
            ->setVariables(
                array(
                    'custom_config' => $this->getCustomConfig(),
                    'olark_id'      => $this->getOlarkId(),
                )
            );

        return $processor->filter($html);
    }

    /**
     * Determine whether the widget should be excluded based on the current layout handle.
     * 
     * @return boolean
     */
    protected function _isExcludedHandle()
    {
        return count( ( array_intersect($this->_excludedHandles, $this->getLayout()->getUpdate()->getHandles()) ) ) > 0;
    }

    /**
     * Get the custom configuration JavaScript.
     * 
     * @return string
     */
    public function getCustomConfig()
    {
        return $this->helper('olark_chat')->renderJs();
    }

    /**
     * Get the Olark client ID.
     * 
     * @return string
     */
    public function getOlarkId()
    {
        return Mage::getStoreConfig('olark/chat_widget/olark_id');
    }

    /**
     * Determine whether the feature is enabled.
     * 
     * @return boolean
     */
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag('olark/chat_widget/enable') && 
            strlen($this->getOlarkId()) > 0 && 
            !$this->_isExcludedHandle();
    }

}