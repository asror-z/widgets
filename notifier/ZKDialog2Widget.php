<?php

namespace zetsoft\widgets\notifier;

use kartik\dialog\Dialog;
use zetsoft\system\kernels\ZWidget;

/**
 * Author: Asror Zakirov
 *
 * Class ZKDialog2Widget
 * https://github.com/kartik-v/yii2-dialog2
 *
 *
 * CreatedBy: Javohir Abdufattokhov
 */
class ZKDialog2Widget extends ZWidget
{


    /**
     *
     * Configuration
     */
    public $config = [];
    public $_config = [
        'libName' => 'krajeeDialog',
        'options' => [], // default options
        'grapes' => true,
    ];

    public const size = [
        'type-default' => 'size-normal',
        'type-small' => 'size-small',
        'type-large' => 'size-large',
        'type-wide' => 'size-wide',
    ];

    public const type = [
        'type-default' => 'type-default',
        'type-primary' => 'type-primary',
        'type-success' => 'type-success',
        'type-danger' => 'type-danger',
        'type-warning' => 'type-warning',
        'type-info' => 'type-info',


    ];

    public function codes()
    {
        
        $this->options = [
            'libName' => $this->_config['libName'],
            'options' => $this->_config['options'], // default options

           
        ];

       $this->htm = Dialog::widget($this->options);

    }

}

