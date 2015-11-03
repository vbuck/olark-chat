<?php

/**
 * Olark chat widget position source model.
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
 * @category Class_Type_Model
 * @package  Vbuck_OlarkChat
 * @author   Rick Buczynski <me@rickbuczynski.com>
 */

class Vbuck_OlarkChat_Model_System_Config_Source_Position
{

    /**
     * Get all positions as an option array.
     * 
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'TL',
                'label' => Mage::helper('olark_chat')->__('Top-Left'),
            ),
            array(
                'value' => 'TR',
                'label' => Mage::helper('olark_chat')->__('Top-Right'),
            ),
            array(
                'value' => 'BR',
                'label' => Mage::helper('olark_chat')->__('Bottom-Right'),
            ),
            array(
                'value' => 'BL',
                'label' => Mage::helper('olark_chat')->__('Bottom-Left'),
            ),
        );
    }

}