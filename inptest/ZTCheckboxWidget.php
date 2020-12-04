<?php

/**
 *
 *  class ZTCheckboxWidget
 *
 *  https://github.com/kleinejan/titatoggle
 *  http://kleinejan.github.io/titatoggle/
 *
 *
 * Author: Jasurbek Normurodov
 * Refactored: Jasurbek Normurodov
 *
 */
namespace zetsoft\widgets\inputes;
namespace zetsoft\widgets\inptest;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\SwitchInput;
use yii\web\JsExpression;

class ZTCheckboxWidget extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZTCheckboxWidget::Types['ioslike'],
        'size' => ZTCheckboxWidget::Sizes['default'],
        'color' => ZTCheckboxWidget::Colors['default'],
    ];

    /**
     * Get label for Input
    */
    public function getLabel()
    {
        if ($this->_config['label'] != "") {
          return $this->_config['label'];
        }
        elseif ($this->modelCheck()) {
          return $this->model->getAttributeLabel($this->attribute);
        }
        else return "Some Label";
    }

    /**
     *
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
                 <div class="col-sm-12"   >
                  <div class="form-check {type} {size} {color}">
                      <label>     
                       <input name="{name}" value="0" type="hidden" id="{id}-hidden">   
                        <input type="checkbox"  name="{name}" value="{value}" id="{id}-tita-toggle"><span></span>
                        <label class="form-check-label" for="{id}-tita-toggle">
                        {label}
                        </label>
                      </label>
                    </div>
                </div>
HTML,

      'js' => <<<JS

      $(document).ready(function() {
      	var checkBox = $('#{id}-tita-toggle');
      	if (checkBox.attr('value') == 1)
      	checkBox.attr('checked', 'checked');

      	checkBox.on('change', function() {
      		if (this.checked) {
      			$(this).attr('value', 1);
      		}
      		else
      		$(this).attr('value', 'f');
      		});
      		checkBox.on('change', {change});
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


        $this->options = [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'value' => $this->value,
        ];

        $this->htm .= strtr($this->_layout['main'], [
                '{type}' => $this->_config['type'],
                '{size}' => $this->_config['size'],
                '{color}' => $this->_config['color'],
                '{label}' => $this->getLabel(),
                '{id}' => $this->id,
                '{name}' => $this->modelCheck() ? $this->name : '',
                '{value}' => $this->modelCheck() ? $this->value : '',
            ]
        );

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{change}' => $this->eventCode('change'),
            '{unchecked}' => $this->eventCode('unchecked'),
            '{checked}' => $this->eventCode('checked'),
        ]);
    }
}
