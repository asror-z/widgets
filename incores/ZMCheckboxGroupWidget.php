<?php

/**
 * @author MurodovMirbosit
 *
 *
 */

namespace zetsoft\widgets\incores;


use kartik\widgets\SwitchInput;
use PhpOffice\PhpWord\Reader\HTML;
use yii\web\JsExpression;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZMCheckboxGroupWidget
 * @package widgets\inputes
 *
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#checkbox()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZMCheckboxGroupWidget extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZMCheckboxGroupWidget::type['MaterialCheckboxWithLoader'],
        'class' => 'material-checkbox',
        'title' => '',
        'textColor' => ZColor::color['muted'],
        'checkColor' => ZColor::color['main-green'],
        'parentClass' => 'd-flex',
        'disabled' => false,

    ];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
        'RadioButton' => 'RadioButton',
        'MaterialRadioButton' => 'MaterialRadioButton',
        'MaterialCheckboxWithLoader' => 'MaterialCheckboxWithLoader'
    ];

    public $event = [];
    public $_event = [
        'change' =>
            'function() {
                console.log("change")
            }',

        'checked' => <<<JS
            function() {
                console.log('checked')
            }
JS,
    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
     <div class="{parentClass}">{content}</div>
     
HTML,

        'MaterialCheckbox' => <<<HTML
        <div class="form-check material-checkbox {class}">
            <input type="checkbox" 
                {checked} 
                class="form-check-input MCheckbox" 
                id="{id}-material" 
                value="{value}" 
                name="{name}[]"
                {disabled}
            >
            <label class=" font-weight-light form-check-label text-{textColor} " for="{id}-material">{label}</label>
        </div>
HTML,

        'MaterialCheckboxWithLoader' => <<<HTML
        <div class="form-check material-checkbox {class} ">
            <a class="zLoader">
                <input type="checkbox" 
                    {checked} 
                    class="form-check-input MCheckbox" 
                    id="{id}-material" 
                    value="{value}" 
                    name="{name}[]"
                />
                <label class=" font-weight-light form-check-label text-{textColor} " for="{id}-material">{label}</label>
            </a>
        </div>
HTML,

        'DefaultCheckbox' => <<<HTML
        <div class="form-check material-checkbox">
            <input type="checkbox" {checked} class="custom-control-input MCheckbox" id="{id}_material" value="{value}" name="{name}[]">
            <label class="custom-control-label text-{textColor}" for="{id}_material">{label}</label>
        </div>
HTML,

        'RadioButton' => <<<HTML
        <div class="form-check material-checkbox">
           <input type="radio" {checked} class="custom-control-input MCheckbox" id="{id}_material" value="{value}" name="{name}[]">
       <label class="custom-control-label text-{textColor}" for="{id}_material">{label}</label>
        </div>
HTML,

        'MaterialRadioButton' => <<<HTML
        <div class="form-check material-checkbox">
            <input type="radio" {checked} class="form-check-input MCheckbox" id="{id}_material" value="{value}" name="{name}"> 
            <label class="form-check-label text-{textColor}" for="{id}_material">{label}</label>
        </div>
HTML,

        'js' => <<<JS
       var checkboxID = $('#{id}-material');

       checkboxID.on('checked', {checked});
       checkboxID.on('change', {change});
       
       
JS,

        'css' => <<<CSS
     .form-check-label::after{
        background-color: _checkColor_ !important;
        border: _checkColor_ !important;
      }
      .white-skin input[type=checkbox]:checked+label:before{
        border-right: 1.5px solid  _checkColor_;
        border-bottom: 1.5px solid _checkColor_;
      } 
      
     
     .custom-control-input:checked~.custom-control-label::before {
        background-color: springgreen;
        border: inherit;
     }   
     
     .form-check-input[type=checkbox]+label:before, .form-check-input[type=checkbox]:not(.filled-in)+label:after, label.btn input[type=checkbox]+label:before, label.btn input[type=checkbox]:not(.filled-in)+label:after{
        border:1px solid #8d8d8d;
     }
         
CSS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/awesome-bootstrap-checkbox@1.0.1/demo/build.css');
    }

    public function codes()
    {
        $json = json_encode($this->value);


        $content = '';
        foreach ($this->data as $key => $value) {
            $checked = '';
            $randomID = $this->myId();

            if (is_array($this->value))
                foreach ($this->value as $val) {
                    if ($val === $key)
                        $checked = 'checked';
                }

            $content .= strtr($this->_layout[$this->_config['type']], [
                '{key}' => $key,
                '{id}' => $randomID,
                '{value}' => $key,
                '{name}' => $this->name,
                '{label}' => $value,
                '{checked}' => $checked,
                '{disabled}' => $this->_config['disabled'],
                '{class}' => $this->_config['class'],
                '{textColor}' => $this->_config['textColor']
            ]);

            $this->js .= strtr($this->_layout['js'], [
                '{id}' => $randomID,
                '{json}' => $json,
                '{change}' => $this->eventCode('change'),
                '{checked}' => $this->eventCode('checked'),
            ]);

        }

        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
            '{parentClass}' => $this->_config['parentClass'],
        ]);



        $this->css = strtr($this->_layout['css'], [
            '_checkColor_' => $this->_config['checkColor']
        ]);
    }
}
