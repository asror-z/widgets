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
class ZDynaCheckboxWidget2 extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'color' => ZDynaCheckboxWidget::colors['orange'],
        'class' => '',
        'label' => ''
        

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
            <input type="checkbox" class="{class}" name="{name}" value="{value}" id="{inputId}">
            <label for="{inputId}">{label}</label>
         </div> 
HTML,

        'js' => <<<JS
$(function() {
    $("#{inputId}").click(function(){
        if ($(this).is(":checked")) {
            $(this).addClass('checked');
            $(this).val('1');
        } 
        else {
            $(this).removeClass('checked');
            $(this).val('0')
        }
    });
     if ($('#{inputId}').val() === '1')
          $('#{inputId}').attr('checked', 'checked')     
});
JS,
        'event' => <<<JS
    $('#{inputId}').on('click', {click});
JS,

        'event_change' => <<<JS
    $('#{inputId}').change({change});
JS,

    ];
    public function asset()
    {
        /*$this->fileCss('icheck-material/icheck-material.css');*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/icheck-material@1.0.1/icheck-material.css');
    }

    public function codes()
    {

              $this->htm = strtr($this->_layout['main'], [
            '{inputId}' =>'check'. $this->id,
            '{name}' => $this->name,
            '{value}' => $this->value,
            '{label}' => $this->_config['label'],
            '{class}' => $this->_config['class'],

            '{color}' => $this->_config['color'],

        ]);
        $this->js .= strtr($this->_layout['js'], [

            '{inputId}' =>'check'. $this->id,

        ]);

        $this->js .= strtr($this->_layout['event'], [

            '{inputId}' =>'check'. $this->id,
            '{click}' => $this->eventCode('click')

        ]);

    }


}

