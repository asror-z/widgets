<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Refactored By: Abdulkhamidov Musoxon
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 *
 * https://github.com/itsjavi/fontawesome-iconpicker
 *   i:\Develop\Interface\Inputs\Icon\Victor-Valencia Bootstrap-Iconpicker
 * Victor-Valencia Bootstrap-Iconpicker
 */
class  ZFontAwesomeIconPickerWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZFontAwesomeIconPickerWidget::type['asComponent'],
        'placement' => ZFontAwesomeIconPickerWidget::placement['bottomLeft'],

    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '/render/inputes/ZFileInputWidget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<b>Title</b>',
    ];

    public const type = [
        'inlinePick' => 'inlinePick',
        'asComponent' => 'asComponent',
    ];
    public const placement = [
        'inline' => 'inline',
        'topLeftCorner' => 'topLeftCorner',
        'topLeft' => 'topLeft',
        'top' => 'top',
        'topRight' => 'topRight',
        'topRightCorner' => 'topRightCorner',
        'rightTop' => 'rightTop',
        'right' => 'right',
        'rightBottom' => 'rightBottom',
        'bottomRightCorner' => 'bottomRightCorner',
        'bottomRight' => 'bottomRight',
        'bottom' => 'bottom',
        'bottomLeft' => 'bottomLeft',
        'bottomLeftCorner' => 'bottomLeftCorner',
        'leftBottom' => 'leftBottom',
        'left' => 'left',
        'leftTop' => 'leftTop',
    ];



    public $branch = [];
    public $_branch = [
        'widget' => [
            'type',
            'placement',
        ],
    ];

    public $layout = [];
    public $_layout = [

        'inlinePick' => <<<HTML
        <div class="form-group">
             <label data-title="Inline picker" data-placement="inline" class="icp icp-auto {class}" data-selected="fa-align-justify">
            </label>
        </div>
        icon
        <p class="lead">
            <i class="{value} fa-3x picker-target"></i>
        </p>
        <input type="text" id="{id}" name="{name}" value="{value}" placeholder="{placeholder}">
HTML,

        'asComponent' => <<<HTML
       <div class="form-group">
            <div class="input-group">
                {getIcon}
                <input placeholder="{placeholder}" id="{id}"  
                class="form-control icp icp-auto {class}"  name="{name}"
                       type="text" value="{value}">
            </div>
        </div>
HTML,

        'icon' => <<<HTML
        <i class="fa-2x {icon} mr-3">
               </i>
HTML,


        'js' => <<<JS
$( document ).ready(function() {
     $('#{id}').iconpicker({
                    title: "here is title",
                    selected: true,
                    defaultValue: true,
                    collision: 'false', 
                    animation: true, 
                    placement : '{placement}', 
                    hideOnSelect: false,
                    showFooter: false,
                    searchInFooter: false,
                    mustAccept: false,
                    selectedCustomClass: 'bg-primary', 
                    /*icons: [], */  // your custom icons
                   /* fullClassFormatter: function(val) {
                         return 'fa ' + val;
                     }, */   
                    input: 'input,.iconpicker-input',                     
                    inputSearch: true
                    /*container: true*/
                });
       
                $('.icp').on('iconpickerSelected', function (e) {
                 $('#{id}').val(e.iconpickerValue);
                });
});
JS


    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/css/fontawesome-iconpicker.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/js/fontawesome-iconpicker.min.js');
    }

    public function codes()
    {

        $icon = $this->_config['icon'];
        if (!empty($this->value))
            $icon = $this->value;

        $getIcon = strtr($this->_layout['icon'], [
            '{icon}' => $icon
        ]);


        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}' => $this->value,
            

            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            /*'{readonly}' => $this->_config['readonly'] ? 'readonly' : '',*/
            '{getIcon}' => $getIcon,
            '{class}' => $this->_config['class']
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{placement}' => $this->_config['placement']

        ]);

    }
}


