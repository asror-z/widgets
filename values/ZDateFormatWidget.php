<?php

/**
 *
 * @author Xolmat Ravshanov
 *
 *
 */

namespace zetsoft\widgets\values;

use zetsoft\system\kernels\ZWidget;

class ZDateFormatWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];


    public $_config = [
        'value' => '',
        'hour' => false,
    ];

    public static $grapes = [
        'width' => '600px',
        'height' => '300px',
    ];

    public $event = [];

    public $_event = [

    ];

    public $layout = [];
    public $_layout = [
        'date' => <<<HTML
              <div class="myClass my-2 w-100">
                   <div class="d-inline-block">
                     {date}   
                   </div> 
              </div>
HTML,
    ];


    public function asset()
    {

    }

    public function codes()
    {

        switch (true) {
            // Format 31.10.2020
            case !empty($this->value):
                $this->htm = strtr($this->_layout['date'], [
                    '{date}' => date('d-m-Y H:i:s', strtotime($this->value)),
                ]);
                break;

            case $this->_config['hour'] && !empty($this->_config['value']):
                $this->htm = strtr($this->_layout['date'], [
                    '{date}' => date("d-m-Y", strtotime($this->_config['value'])),
                ]);
                break;

            case $this->_config['hour'] && !empty($this->value):
                $this->htm = strtr($this->_layout['date'], [
                    '{date}' => date("d-m-Y", strtotime($this->value)),
                ]);
                break;

            case !empty($this->_config['value']):
                $this->htm = strtr($this->_layout['date'], [
                    '{date}' => date("d-m-Y H:i:s", strtotime($this->_config['value'])),
                ]);
                break;


        }

    }

}

