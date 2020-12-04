<?php

/**
 * @author MurodovMirbosit
 */

namespace zetsoft\widgets\incores;


use kartik\widgets\SwitchInput;
use PhpOffice\PhpWord\Reader\HTML;
use yii\web\JsExpression;
use zetsoft\dbitem\App\eyuf\CheckboxItem;
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
class ZMCheckboxItemGroupWidget extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZMCheckboxItemGroupWidget::type['MaterialCheckbox'],
        'class' => 'material-checkbox',
        'title' => '',
        'textColor' => ZColor::color['muted'],
        'checkColor' => ZColor::color['main-green'],
    ];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
        'RadioButton' => 'RadioButton',
        'MaterialRadioButton' => 'MaterialRadioButton'
    ];

    public $event = [];
    public $_event = [

        'checked' => <<<JS
   function() {
        console.log('checked')
   }
JS,
    ];


    public $layout = [];
    public $_layout = [
        'MaterialCheckbox' => <<<HTML
        <div class="form-check material-checkbox {class} hint--top" aria-label="{hint}">
           <input type="checkbox" {checked} class="form-check-input MCheckbox" id="{id}-material" value="{value}" name="{name}[]">
           <label class=" font-weight-light form-check-label text-{textColor}" for="{id}-material">
           {src}
           {label}
           </label>
           <p for="{id}">{title}</p>
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
       $('.MCheckbox').on('change', {checked})
       $('.MCheckbox').on('change', {change});
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

        $content = $this->_config['title'];
        /** @var CheckboxItem $value */

        foreach ($this->data as $key => $value) {
            $checked = '';
            if (is_array($this->value))
                foreach ($this->value as $val) {
                    if ($val == $key)
                        $checked = 'checked="checked"';
                }

            $content .= strtr($this->_layout[$this->_config['type']], [
                '{key}' => $key,
                '{id}' => $this->id++ . random_int(1, 9999999),
                '{value}' => $key,
                '{name}' => $this->name,

                '{src}' => $value->icon,
                '{hint}' => $value->text,
                '{title}' => $value->title,
                '{label}' => $value->title,

                '{checked}' => $checked,
                '{class}' => $this->_config['class'],
                '{textColor}' => $this->_config['textColor']
            ]);

        }

        $this->htm .= $content;


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id++ . random_int(1, 9999999),
            '{json}' => $json,
            '{change}' => $this->eventCode('change'),
            '{checked}' => $this->eventCode('change'),
        ]);

        $this->css = strtr($this->_layout['css'], [
            '_checkColor_' => $this->_config['checkColor']
        ]);
    }
}
