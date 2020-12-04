<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
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
class ZMCheckboxGroupWidgetAz extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZMCheckboxGroupWidget::type['MaterialRadioButton'],
        'class' => 'material-checkbox',
        'title' => '',
        'textColor' => ZColor::color['muted'],
        'checkColor' => ZColor::color['main-green'],
    ];

    public $getSessionForm = [];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
        'RadioButton' => 'RadioButton',
        'MaterialRadioButton' => 'MaterialRadioButton'
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="main-checkbox-div">
            <h5 class="text-success">{title}</h5>
            {main}
        </div>
HTML,

        'MaterialCheckbox' => <<<HTML
        <div class="form-check material-checkbox {class}">
           <input type="checkbox" class="form-check-input" id="{id}_material" value="{value}" name="{name}[]">
       <label class=" font-weight-light form-check-label text-{textColor}" for="{id}_material">{label}</label>
        </div>
HTML,
        'DefaultCheckbox' => <<<HTML
        <div class="form-check">
           <input type="checkbox" class="custom-control-input" id="{id}_material" value="{value}" name="{name}[]">
       <label class="custom-control-label text-{textColor}" for="{id}_material">{label}</label>
        </div>
HTML,

        'RadioButton' => <<<HTML
        <div class="form-check">
           <input type="radio" class="custom-control-input" id="{id}_material" value="{value}" name="{name}">
       <label class="custom-control-label text-{textColor}" for="{id}_material">{label}</label>
        </div>
HTML,

        'MaterialRadioButton' => <<<HTML
        <div class="form-check material-checkbox {class}">
            <input type="radio" class="form-check-input" id="{id}_material" value="{value}" name="{name}">
            <label class="form-check-label text-{textColor}" for="{id}_material">{label}</label>
        </div>
HTML,

        'js' => <<<JS
    var checkBox = $('#{id}-material');
    var values = {json};
    var checkBoxes = $('.{class}').find('.form-check-input:first-child');
    
    
    if (typeof values !== 'array')
        values = [];
    
    checkBoxes.each(function(key, v) {
    
        let val = $(v).attr('value');
        
        console.log($(v).attr('value'));
        if (values.includes(val))
            $(v).attr('checked', 'checked');
        console.log(values);
             
    });
    
    checkBox.on('change', function() {
      if (typeof this.checked) {
          $(this).attr('value', true);
      }
      else
          $(this).attr('value', false);
    });
    
     //getItems from session
    
    var checkedForm ='{getSessionForm}';
    
    if (checkedForm!==0){
    let els = checkedForm.split('-');
    
    els.map((item,i) =>
        checkBoxes.map((m,checkBox1) =>
            $(checkBox1).attr('value')===item?$(checkBox1).attr('checked','checked'):''
            //console.log(checkBox1,item)
        )
    )
    
    console.log(els)
    }
    
    //console.log(checkedSess)
    
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
        $content = '';

        foreach ($this->data as $key => $value) {
            $content .= strtr($this->_layout[$this->_config['type']], [
                '{key}' => $key,
                '{id}' => $this->id++ . random_int(1, 9999999),
                '{value}' => $key,
                '{class}' => $this->_config['class'],
                '{name}' => $this->name,
                '{label}' => $value,
                '{textColor}' => $this->_config['textColor']
            ]);

        }

        $this->htm .= strtr($this->_layout['main'], [
            '{main}' => $content,
            '{title}' => $this->_config['title']
        ]);

        $json = json_encode($this->value);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id++,
            '{class}' => $this->_config['class'],
            '{json}' => $json,
            '{getSessionForm}' => $this->sessionGet('catalogForm') !== 0 ? implode('-', $this->sessionGet('catalogForm')) : $this->sessionGet('catalogForm'),
        ]);

        $this->css = strtr($this->_layout['css'], [
            '_checkColor_' => $this->_config['checkColor']
        ]);
    }
}
