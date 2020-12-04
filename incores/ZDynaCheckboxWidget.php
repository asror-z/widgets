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

namespace zetsoft\widgets\incores;


use zetsoft\system\kernels\ZWidget;


/**
 *  https://bantikyan.github.io/icheck-material/ asset
 *  https://github.com/bantikyan/icheck-material
 */
class ZDynaCheckboxWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'color' => ZDynaCheckboxWidget::colors['orange'],
        'class' => '',
        'label' => '',
        'radio' => false,
        'isChecked' => false
    ];

    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];

    public $event = [];
    public $_event = [
        'click' => 'console.log("clicked")',
    ];

    public const colors = [
        'red' => 'red',
        'pink' => 'pink',
        'purple' => 'purple',
        'deeppurple' => 'deeppurple',
        'indigo' => 'indigo',
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
            <input type="{type}" {checked} class="checkBox-dynawidget {class}" name="{name}" value="{value}" id="{inputId}">
            <label class="checkBox-label" for="{inputId}" style="margin-left: 17px;!important;">{label}</label>
         </div>
          
HTML,

    ];

    public function asset()
    {
        /*$this->fileCss('icheck-material/icheck-material.css');*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/icheck-material@1.0.1/icheck-material.css');
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            '{inputId}' => 'check' . $this->id,
            '{name}' => $this->name,
            '{value}' => $this->value,
            '{label}' => $this->_config['label'],
            '{class}' => $this->_config['class'],
            '{checked}' => $this->_config['isChecked'] ? 'checked' : '',
            '{type}' => $this->_config['radio'] ? 'radio' : 'checkbox',

            '{color}' => $this->_config['color'],

        ]);

    }


}

