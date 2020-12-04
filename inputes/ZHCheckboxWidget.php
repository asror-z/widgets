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


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use function RingCentral\Psr7\str;

/**
 * Class ZHRadioWidget
 * @package widgets\inputes
 *
 * testing/Inputs/ZHCheckboxWidget/clean_checkbox.html
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#checkbox()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 *  Refactory: Ergashev Zoxidjon
 */
class ZHCheckboxWidget extends ZWidget
{

    public $config = [];
    public $_config = [
      'placeholder' => '',
        'theme' => '',

      
    ];
    
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZHCheckboxWidget/image/icon.png',
        'name' => Azl . 'Checkbox',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZHCheckboxWidget/image/icon.png"/>',

    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
            'placeholder',
            'theme',
        ],
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div class="form-control border-0 {class}">
                     {icon}
                <div class="d-inline form-check">
                    <input  
                        type="checkbox" 
                        placeholder="{placeholder}" 
                        class="form-check-input" 
                        checked="{check}"
                        value="true"
                        name="{name}" 
                        id="{id}" 
                    />
                    <label class="form-check-label"  for="{id}">{placeholder}</label>
                </div>             
            </div>
HTML,
/*      'js' => <<<JS
        $(function() {
            $(".icheckmat").click(function(){
                if (!$(this).is(":checked")) {
                    $(this).removeClass('checked');
                } else {
                    $(this).addClass    ('checked');
                }
            });
        });
JS,*/

        'icon' => <<<HTML
            <i class="{icon} fa-2x"></i>
HTML,
    ];

    public function asset()
    {
        $theme = $this->_config['theme'];
        if(isset($theme)) {
            $this->fileCss("/render/inputes/ZHCheckboxWidget/asset/{$theme}.css");
        }
    }

    public function codes()
    {

        $iconCode = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon']
        ]);

        if ($this->value === 1)
            $checked = true;
        else
            $checked = false;

        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{check}' => $checked,
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{icon}' => $this->_config['hasIcon'] ? $iconCode : '',
            '{class}' => $this->_config['class'],
        ]);

       /* $this->css .=strtr($this->_layout['style'],[

        ]);*/
        /* $this->js .= strtr($this->_layout['js'], [

         ]);*/
    }
}
