<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use rmrevin\yii\fontawesome\FA;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;

/**
 *  https://bantikyan.github.io/icheck-material/
 *  https://github.com/bantikyan/icheck-material
 *  /core/tester/asror/main.aspx?path=render/inputes/ZCheckRadioListWidget/active.php
 */
class ZCheckRadioListWidget extends ZWidget
{
    /**
     * Configuration
     */



    public $config = [];
    public $_config = [
        'color' => ZColor::color['orange'],
        'grapes' => true,
        'hasIcon' => true,
        'icon' => 'fas fa-'. FA::_USERS,
    ];

    public $label = [];
    public $_label = [

        'color' => Azl . 'цвет',
        'grapes' => Azl . 'Grapes'

    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZCheckRadioListWidget/image/icon.png',
        /*'name' => Azl . 'CheckRadioList',*/
        'title' => Azl . 'CheckRadioList',

    ];
    public $branch = [];
    public $_branch = [
        'widget' => [
            'color',
            'grapes',
            'hasIcon',
            'icon'
        ],
    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="icheck-material-{color}">             
               <input type="radio" 
                      id="{data-id}-{key}"
                      value="{key}"
                      name="{name}" 
                      {checked}/> 
                      
               <label for="{data-id}-{key}">{data}</label>    
            </div>
HTML,
        'validate' => <<<HTML
    <div  id="{id}" class="form-control h-auto {class} md-form">
        <p class="mb-0">{placeholder}</p>
          <div>
          {icon}
         <div class="ml-5">{content}</div>
</div>
</div>
HTML,
        'icon' => <<<HTML
        <i class="{icon} prefix"></i>
HTML,
];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/icheck-material@1.0.1/icheck-material.css');
    }


    public function codes()
    {
        $iconCode = ($this->_config['hasIcon']) ?
            strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon']
            ]) : null;
        $placCode = $this->_config['hasPlace'] ? $this->_config['placeholder'] : '';


        $content = '';

        foreach ($this->data as $key => $item) {
            $checked = '';
            if ($this->value === $key)
            $checked = 'checked';

            if (is_array($this->value))
                foreach ($this->value as $val)
                    if ($val === $key)
                        $checked = 'checked';



            $content .= strtr($this->_layout['main'], [
                '{key}' => $key,
                '{data-id}' => uniqid('', true),
                '{name}' => $this->name,
                '{color}' => $this->_config['color'],
                '{data}' => $item,
                '{checked}' => $checked,

            ]);
        }

        $this->htm = strtr($this->_layout['validate'], [
            '{id}' => $this->id,
            '{content}' => $content,
            '{placeholder}' => $placCode,
            '{icon}' => $iconCode,
            '{class}' => $this->_config['class'],

        ]);
    }
}


