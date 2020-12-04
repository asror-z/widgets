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
class ZMCheckboxGroupWidget2 extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'container' => '',
        'type' => ZMCheckboxGroupWidget2::type['MaterialCheckbox'],
        'value2name' => false,
        'class' => 'ZCheckboxGroupWidget',
        'value' => null,
    ];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
        'RadioCheckbox' => 'RadioCheckbox',
    ];

    public $layout = [];
    public $_layout = [
        'MaterialCheckbox' => <<<HTML
        <div class="form-check material-checkbox {class}">
           <input type="checkbox" class="form-check-input" id="{id}-material" value="{value}" name="{name}[]">
       <label class="form-check-label" for="{id}-material">{label}</label>
        </div>
HTML,
        'DefaultCheckbox' => <<<HTML
        <div class="form-check">
           <input type="checkbox" class="custom-control-input" id="{id}-material" value="{value}" name="{name}[]">
       <label class="custom-control-label" for="{id}-material">{label}</label>
        </div>
HTML,
        'RadioCheckbox' => <<<HTML
        <div class="form-check material-checkbox">
            <input type="radio" class="form-check-input" id="{id}-material" value="{value}" name="{name}[]">
            <label class="form-check-label" for="{id}-material">{label}</label>
        </div>
HTML,

        'js' => <<<JS
    $('#{id}-mainContent').slimScroll({
        railVisible: true,
        allowPageScroll: true,
        touchScrollStep: 1000,
        height: '{height}',
        width: '100%'
    });
    
    const checkBox = $('#{id}-material');
    let values = {json};
    const checkBoxes = $('.material-checkbox').find('.form-check-input');
    
    if (!values)
        values = [];
    
    checkBoxes.each(function(key, v) {
    
        let val = $(v).attr('value');
        if (values.includes(val))
            $(v).attr('checked', 'checked');
             
    });
    
    checkBox.on('change', function() {
      if (typeof this.checked)
          $(this).attr('value', 1);
      else
          $(this).attr('value', 'f');
    });
JS,
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/awesome-bootstrap-checkbox@1.0.1/demo/build.css');
    }

    public function codes()
    {
        $json = json_encode($this->value);

        $content = '';
        foreach ($this->data as $this->_config['value'] => $value) {
            if ($this->_config['value2name'] === true)
            {
                $content .= strtr($this->_layout[$this->_config['type']], [
                    '{key}' => $this->_config['value'],
                    '{id}' => $this->id++ . random_int(1, 9999999),
                    '{value}' => $this->_config['value'] . '-' . $this->name,
                    '{name}' => $this->name,
                    '{label}' => $value,
                    '{class}' => $this->_config['class'],
                ]);
            }
            else
            {
                $content .= strtr($this->_layout[$this->_config['type']], [
                    '{key}' => $this->_config['value'],
                    '{id}' => $this->id++ . random_int(1, 9999999),
                    '{value}' => $this->_config['value'],
                    '{name}' => $this->name,
                    '{label}' => $value,
                    '{class}' => $this->_config['class'],
                ]);
            }

        }

        $this->htm = $content;

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id++,
            '{json}' => $json,
            '{class}' => $this->_config['container'],
        ]);
    }
}
