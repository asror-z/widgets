<?php

/**
 * @author MurodovMirbosit
 */

namespace zetsoft\widgets\incores;


use kartik\widgets\SwitchInput;
use PhpOffice\PhpWord\Reader\HTML;
use yii\web\JsExpression;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZMCheckboxWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#checkbox()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZMCheckboxWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZMCheckboxWidget::type['MaterialCheckbox'],
        'placeholder' => '',
        'InpuType' => ZMCheckboxWidget::InpuType['checkbox'],
    ];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
    ];

    public const InpuType = [
      'checkbox' => 'checkbox',
      'radio' => 'radio',
    ];

    public $event = [];
    public $_event = [
        
        'checked' => "console.log('CHECKED');",
        'unchecked' => "console.log('UNCHECKED');"
    ];


    public $layout = [];
    public $_layout = [

        'MaterialCheckbox' => <<<HTML
        <div class="form-check {class}">
          <input name="{name}" value="0" type="hidden" id="{id}-hidden">
          <input type="{InpuType}" {checked} class="form-check-input MCheckbox" id="{id}-material" value="{value}" name="{name}">
          <label class="form-check-label" for="{id}-material">{label}</label>
        </div>
HTML,

        'DefaultCheckbox' => <<<HTML
        <div class="form-check {class}">
           <input name="{name}" value="0" type="hidden" id="{id}-hidden"> 
           <input type="{InpuType}" {checked} class="custom-control-input MCheckbox" id="{id}-material" value="{value}" name="{name}">
           <label class="custom-control-label" for="{id}-material">{label}</label>
        </div>
HTML,
        'js' => <<<JS
        
      var checkBox = $('#{id}-material');
      checkBox.on('change', function() {
     
          if (this.checked)
              $(this).attr('value', 1);
          else
              $(this).attr('value', null);
              
      });
      checkBox.on('change', {change});
      
JS,
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/awesome-bootstrap-checkbox@1.0.1/demo/build.css');
    }

    public function codes()
    {
        $checked = '';
        if ($this->value == 1)
            $checked = 'checked';


        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{checked}' => $checked,
            '{name}' => $this->name,
            '{label}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{InpuType}' => $this->_config['InpuType'],
            '{class}' => $this->_config['class'],
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{change}' => $this->eventCode('change'),
            '{unchecked}' => $this->eventCode('unchecked'),
            '{checked}' => $this->eventCode('checked'),
        ]);
    }
}
