<?php

/**
 *
 *
 * Author:  Shukurullo Odilov
 * Date:    20.05.2020
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

/**
 * Class ZTCheckboxGroupWidget
 * @package widgets\inptest
 */
class ZTCheckboxGroupWidget extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZTCheckboxGroupWidget::Types['ioslike'],
        'size' => ZTCheckboxGroupWidget::Sizes['default'],
        'color' => ZTCheckboxGroupWidget::Colors['default'],
    ];


    /**
     * Constants
     */

    public const Types = [
        'default' => 'checkbox-slider--default',
        'rounded' => 'checkbox-slider--a-rounded',
        'withtext' => 'checkbox-slider--a   ',
        'ioslike' => 'checkbox-slider--b',
        'flat' => 'checkbox-slider--b-flat',
        'materiallike' => 'checkbox-slider--c',
    ];
    public const Sizes = [
        'large' => 'checkbox-slider-lg',
        'middle' => 'checkbox-slider-md',
        'small' => 'checkbox-slider-sm',
        'default' => 'checkbox-slider',

    ];

    public const Colors = [
        'default' => '',
        'info' => 'checkbox-slider-info',
        'danger' => 'checkbox-slider-danger',
        'warning' => 'checkbox-slider-warning',

    ];

    public $event = [];
    public $_event = [

        'checked' => "console.log('CHECKED');",
        'unchecked' => "console.log('UNCHECKED');"
    ];

    public function getLabel()
    {
        if (isset($this->_config['label'])) {
            return $this->_config['label'];
        }
        elseif ($this->modelCheck()) {
            return $this->model->getAttributeLabel($this->attribute);
        }
        else return "Some Label";
    }

    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
            <div class="">
                <div class="col-sm-12">
                        <h3>{mainLabel}</h3>
                    </div>
                </div>
            </div>
            <div class="">{inputs}</div>
HTML,

        'input' => <<<HTML
                 <div class="col-md-12"   >
                  <div class="form-check {type} {size} {color}">
                      <label>     
                       <input name="{name}[{key}]" value="0" type="hidden" id="{id}-{key}-hidden">   
                        <input type="checkbox" class="{id}-tita-toggle-checkbox" name="{name}[{key}]" value="{value}" id="{id}-{key}-tita-toggle"><span></span>
                        <label class="form-check-label" for="{id}-tita-toggle">
                            {inputLabel}
                        </label>
                      </label>
                    </div>
                </div>
HTML,

        'js' => <<<JS
       
$(document).ready(function() {
    
    let values = {json};
    const checkBoxes = $('.form-check').find('.{id}-tita-toggle-checkbox');
    
    if (!values){
        values = [];
    }
    
    checkBoxes.each(function(key, input) {
        if($(input).val() == '1'){
            $(input).attr('checked', 'checked')
        }
    });

    $('input.{id}-tita-toggle-checkbox').on('change', function() {

        var val = $(this).attr('value')

        console.log($(this).attr('id'))

        if (  $(this).val() == '1' ) {
            $(this).val('0');
        }
        else{
            $(this).val('1');
        }
    });
});

        hljs.initHighlightingOnLoad();

JS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/titatoggle@2.1.2/dist/titatoggle-dist.css');
        $this->fileJs('https://cdn.statically.io/gh/kleinejan/titatoggle/master/docs/js/highlight.js');
    }

    public function codes()
    {

        $json = json_encode($this->value);
        $inputs = '';

        foreach ($this->data as $key => $value) {
            
            $inputs .=  strtr($this->_layout['input'], [
                    '{type}' => $this->_config['type'],
                    '{size}' => $this->_config['size'],
                    '{color}' => $this->_config['color'],
                    '{inputLabel}' => $value,
                    '{id}' => $this->id,
                    '{key}' => $key,
                    '{name}' => $this->name,
                    '{value}' => isset($this->value[$key]) ? $this->value[$key] : "0" ,
                ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{mainLabel}' => ZTCheckboxGroupWidget::getLabel(),
            '{inputs}' => $inputs,
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{json}' => $json,
        ]);
    }
}
