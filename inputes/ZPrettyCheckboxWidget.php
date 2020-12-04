<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;

/**
 * Class    ZPrettyCheckboxWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZPrettyCheckboxWidget extends ZWidget
{
    /**
     *
     * Constants
     */
    public const type = [];

    public const outer_classes = [
        'default' => 'p-default',
        'fill' => 'p-fill',
        'thick' => 'p-thick',
        'curve' => 'p-curve',
        'round' => 'p-round',
        'switch' => 'p-switch',
        'slim' => 'p-slim',
        'smooth' => 'p-smooth',
        'jelly' => 'p-jelly',
        'tada' => 'p-tada',
        'rotate' => 'p-rotate',
        'pulse' => 'p-pulse',
        'plain' => 'p-plain',
        'toggle' => 'p-toggle',
    ];

    public const color_classes = [
        'primary' => 'p-primary',
        'success' => 'p-success',
        'info' => 'p-info',
        'warning' => 'p-warning',
        'danger' => 'p-danger',
        'primary-o' => 'p-primary-o',
        'success-o' => 'p-success-o',
        'info-o' => 'p-info-o',
        'warning-o' => 'p-warning-o',
        'danger-o' => 'p-danger-o',
    ];

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'outer_class_name' => 'p-default p-fill p-curve',
        'color_class_name' => 'info',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
			<div class="pretty {outer_class_name}">
		        <input id="p-{id}" name="{name}" value="on" type="checkbox" class="checkedImg"/>
		        <div class="state {color_class_name}">
		            {icon}
		            <label for="p-{id}">{label}</label>
		            <span >{placeholder}</span>
		        </div>
		    </div>
		HTML,

        'icon' => <<<HTML
            <i class="icon {icon}"></i>
        HTML,

        'js' => <<<JS
    const input = document.querySelector("#p-{id}");
    const savedValue = {value};
    
    console.log(savedValue);
//    if (savedValue) {
//        
//    }


JS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css');
    }

    public function codes()
    {
        $iconCode = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon'],
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{outer_class_name}' => $this->_config['outer_class_name'] ? $this->_config['outer_class_name'] : '',
            '{color_class_name}' => $this->_config['color_class_name'] ? $this->_config['color_class_name'] : '',
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{label}' => $this->_config['label'],
            '{icon}' => $iconCode,
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{icon}' => $this->modelCheck() ? $this->value : '',
        ]);

    }

}
