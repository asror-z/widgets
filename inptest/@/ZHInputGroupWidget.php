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
namespace zetsoft\widgets\inptest;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class    ZHDropDownListWidget
 * @package widgets\inputes
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#activeDropDownList()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 *
 * Refactored: Doston Rakhmatov
 */


class  ZHInputGroupWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'title' => 'InputGroup',
        'theme' => ZHInputGroupWidget::theme['krajee-bs4'],
        'size' => ZHInputGroupWidget::size['lg'],

    ];
    private $_sInput;
    /**
     *
     * Constants
     */
    public const theme = [
        'default'    => 'default',
        'classic'    => 'classic',
        'bootstrap'  => 'bootstrap',
        'krajee'     => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];
    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
        'xs' => 'xs'
    ];
    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
   /* public $event  = [];
    public $_event = [
        'change'   => ' console.log("ZKSelect2Widget | $eventChange") ',
        'open'     => ' console.log("ZKSelect2Widget | $eventOpen") ',
    ];*/
    public function codes()
    {
        $this->options = [
            'text' => $this->_config['title'],
            'size' => $this->_config['size'],
            'readonly' => $this->_config['readonly'],
            'class' => '',
            'id' => $this->id,
        ];

        $this->layout = [
            'template' => <<<HTML
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text " id="{id}-jhgv" style='height:40px'>
                        InputName: &nbsp <i class="{icon}"></i> 
                         <input type="text" name="{name}" value="{value}" >
                    </div>
                </div>
            </div>
HTML
        ];

        $this->htm = strtr($this->layout['template'], [
            '{id}' => $this->id,
            '{icon}' => $this->_config['icon'],
            '{value}' => $this->value,
            '{name}' => $this->name,
        ]);
        
    }
}
