<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use kartik\widgets\SwitchInput;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class    ZHDropDownListWidget
 * @package widgets\inputes
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#activeDropDownList()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZDropDownListWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'title' => 'Title',
        'multiple' => true,
        'class' => 'form-control md-form',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => 'fa-down',
        'src' => '/render/inputes/ZSelect2Widget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<h4>Select2</h4>',
        'content' => Azl . '<b>this widget for selcted element</b>',
    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
            'title',
            'multiple',
            'class',
        ],
    ];

    

    public function codes()
    {
        $multiple = $this->_config['multiple'] ? 'multiple' : '';

        $this->options = [
            'data' => $this->data,
            'id' => $this->id,
            'value' => $this->_config['title'],
            'class' => $this->_config['class'],
            'options' => [
                'multiple' => $multiple,
                'value' => 'none',
                'label' => $this->_config['title']
            ]
        ];




        if (empty($this->model)) {
            $this->htm = ZHTML::dropDownList(
                $this->name,
                null,
                $this->data,
                $this->options
            );
        } else {
            $this->htm = ZHTML::activeDropDownList(
                $this->model,
                $this->attribute,
                $this->data,
                $this->options
            );
        }
    }

}
