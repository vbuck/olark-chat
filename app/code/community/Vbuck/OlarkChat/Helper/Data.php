<?php

/**
 * Olark chat widget helper class.
 *
 * This class is a storage container for custom Olark configurations.
 * It will be used by the Olark widget block to fetch dynamic data.
 * 
 * PHP Version 5
 * 
 * @category  Class
 * @package   Vbuck_OlarkChat
 * @author    Groove Commerce
 * @copyright 2015 Groove Commerce, LLC. All Rights Reserved.
 */

/**
 * Class declaration
 *
 * @category Class_Type_Helper
 * @package  Vbuck_OlarkChat
 * @author   Groove Commerce
 */

class Vbuck_OlarkChat_Helper_Data
    extends Mage_Core_Helper_Abstract
{

    protected $_configuration   = array();
    protected $_commands        = array();

    /**
     * Add preset data to widget setup.
     *
     * @return Vbuck_OlarkChat_Helper_Data
     */
    protected function _addBaseData()
    {
        $this->configure('box.corner_position', Mage::getStoreConfig('olark/chat_widget/position'));

        // Add logged-in customer data
        if (Mage::getStoreConfigFlag('olark/chat_widget/visitor_recognition') && Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();

            $this->command('api.visitor.updateFullName', array('fullName' => $customer->getName()))
                ->command('api.visitor.updateEmailAddress', array('emailAddress' => $customer->getEmail()));
        }

        $this->command('api.box.show');

        if (Mage::getStoreConfigFlag('olark/chat_widget/start_expanded')) {
            $this->command('api.box.expand');   
        }

        return $this;
    }

    /**
     * Escape a value for use in JS output.
     * 
     * @param mixed $value The value to output.
     * 
     * @return string
     */
    protected function _escapeValue($value)
    {
        if ($value instanceof Varien_Object) {
            $value = $value->getData();
        }

        if (is_array($value)) {
            $value = Mage::helper('core')->jsonEncode($value);
        } else if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        } else if (is_numeric($value)) {
            $value = strval($value);
        } else {
            return "'" . addslashes($value) . "'";
        }

        return addslashes($value);
    }

    /**
     * Configure the chat widget.
     * 
     * @param string $option The option key.
     * @param mixed  $value  The option value.
     * 
     * @return Vbuck_OlarkChat_Helper_Data
     */
    public function configure($option, $value)
    {
        $this->_configuration[$option] = $value;

        return $this;
    }

    /**
     * Queue a command for execution.
     * 
     * @param string $command The command to execute.
     * @param mixed  $data    The data to pass to the command.
     * 
     * @return Vbuck_OlarkChat_Helper_Data
     */
    public function command($command, $data = null)
    {
        $this->_commands[$command] = $data;

        return $this;
    }

    /**
     * Render the current Olark configuration.
     * 
     * @return string
     */
    public function renderJs()
    {
        $output = array();

        $this->_addBaseData();

        Mage::dispatchEvent('olark_chat_render_widget_js', array('object' => $this));

        foreach ($this->_configuration as $key => $value) {
            $output[] = "olark.configure('{$key}', {$this->_escapeValue($value)});";
        }

        foreach ($this->_commands as $key => $value) {
            if (is_null($value)) {
                $output[] = "olark('{$key}');";
            } else {
                $output[] = "olark('{$key}', {$this->_escapeValue($value)});";
            }
        }

        return implode("\n", $output);
    }

}