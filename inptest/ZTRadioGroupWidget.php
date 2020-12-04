<?php

/**
 *
 * Author:  Shukurullo Odilov
 * Date:    20.05.2020
 *
 */

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

/**
 * Class ZTRadioGroupWidget
 * @package widgets\inptest
 */
class ZTRadioGroupWidget extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZTRadioGroupWidget::Types['ioslike'],
        'size' => ZTRadioGroupWidget::Sizes['default'],
        'color' => ZTRadioGroupWidget::Colors['default'],
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

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <h3>{mainLabel}</h3>
                    </div>
                </div>
            </div>
            <div class="row">{inputs}</div>
HTML,

        'input' => <<<HTML
                 <div class="col-sm-12">
                     <div class="">
                      <div class="form-check {type} {size} {color}">
                          <label>     
                            <input type="radio" class="tita-toggle-checkbox" name="{name}" value="{value}" id="{id}-{key}-tita-toggle"><span></span>
                            <label class="form-check-label" for="{id}-tita-toggle">
                                {inputLabel}
                            </label>
                          </label>
                        </div>
                    </div>
                 </div>
HTML,
        'js' => <<<JS

        var value = "{value}"
        var radioInputs = $("input[name='{name}']")
        radioInputs.each(function(key, input) {
            if($(input).val() == value){
                $(input).attr('checked', 'checked')
            }
        });

JS,

    ];


    /**
     * Get label
    */
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

    /**
     * Get input name
    */
    public function getName()
    {

        if ($this->modelCheck()) {
          return $this->name;
        }

        elseif (isset($this->_config['name']) ) {
          return $this->_config['name'];
        }
        
        else return "TitaToggleRadio-".$this->id;
    }


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/titatoggle@2.1.2/dist/titatoggle-dist.css');
        $this->fileJs('https://cdn.statically.io/gh/kleinejan/titatoggle/master/docs/js/highlight.js');
    }

    public function codes()
    {

        $inputs = '';

        foreach ($this->data as $key => $value) {
            $inputs .=  strtr($this->_layout['input'], [
                    '{type}' => $this->_config['type'],
                    '{size}' => $this->_config['size'],
                    '{color}' => $this->_config['color'],
                    '{inputLabel}' => $value,
                    '{id}' =>$this->id,
                    '{key}' => $key,
                    '{name}' => ZTRadioGroupWidget::getName(),
                    '{value}' => $key,
                ]);
        }
        
        $this->htm = strtr($this->_layout['main'], [
            '{mainLabel}' => ZTRadioGroupWidget::getLabel(),
            '{inputs}' => $inputs,
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{name}' => ZTRadioGroupWidget::getName(),
        ]);
    }
}
