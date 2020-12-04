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

namespace zetsoft\widgets\inptest;


use zetsoft\system\kernels\ZWidget;


/**
 *  https://bantikyan.github.io/icheck-material/ asset
 *  https://github.com/bantikyan/icheck-material
 */
class ZMaterialCheckboxWidget2 extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'color' => self::colors['indigo'],
        'class' => '',
        'label' => ''
    ];


    public $event = [];
    public $_event = [
        'click' => 'console.log("clicked")',
        'change' => 'console.log("changed")',
    ];

    public const colors = [
        'red' => 'red',
        'pink' => 'pink',
        'purple' => 'purple',
        //start|AzimToirov|2020-10-09
        'deeppurple' => 'deeppurple',
        'indigo' => 'indigo',
        //end|AzimToirov|2020-10-09
        'blue' => 'blue',
        'lightblue' => 'lightblue',
        'cyan' => 'cyan',
        'teal' => 'teal',
        'green' => 'green',
        'lightgreen' => 'lightgreen',
        'lime' => 'lime',
        'yellow' => 'yellow',
        'amber' => 'amber',
        'orange' => 'orange',
        'deeporange' => 'deeporange',
        'brown' => 'brown',
        'grey' => 'grey',
        'bluegrey' => 'bluegrey',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
         <div class="icheck-material-{color}">
           <input name="{name}[]" value="0" type="hidden">
            <input type="checkbox" class="{class}" name="{name}[]" value="{value}" id="{inputId}">
            <label for="{inputId}">{label}</label>
         </div> 
HTML,
        'event' => <<<JS
    $('#{inputId}')
    .on('click', {click})
    .on('change', {change});
    
    $('#{inputId}').click(function() {
        if ($(this).is(":checked")){
        console.log('chechked')    
        } 
    });
JS,
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/icheck-material@1.0.1/icheck-material.css');
    }

    public function codes()
    {
        //start|AzimToirov|2020-10-09


        //end|AzimToirov|2020-10-09

        $checkbox = '';
        foreach ($this->data as $key => $title) {
            $checkbox .= strtr($this->_layout['main'], [
                '{inputId}' => $this->id . $key,
                '{name}' => $this->name,
                '{value}' => $key,
                '{label}' => $title,
                '{class}' => $this->_config['class'],
                '{color}' => $this->_config['color'],
            ]);
        }
        //vdd($this->value);

        $this->htm = $checkbox;

        $this->js = strtr($this->_layout['event'], [
            '{inputId}' => $this->id . $key,
            '{click}' => $this->eventCode('click'),
            '{change}' => $this->eventCode('change')
        ]);
    }
}

