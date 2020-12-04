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
 * Class ZMRadioWidget
 * @package widgets\inputes
 *
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#checkbox()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.aspx
 *
 */
class ZMRadioWidget_asdasd extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZMRadioWidget::type['MaterialCheckbox'],
    ];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
    ];

    public $layout = [];
    public $_layout = [
        'MaterialCheckbox' => <<<HTML
        <div class="form-check material-checkbox" id="{id}">
           <input type="radio" class="form-check-input" id="{id}-material" value="{value}" name="{name}">
       <label class="form-check-label" for="{id}-material">{label}</label>
        </div>
HTML,
        'DefaultCheckbox' => <<<HTML
        <div class="form-check material-checkbox" id="{id}">
           <input type="radio" class="custom-control-input" id="{id}-material" value="{value}" name="{name}">
       <label class="custom-control-label" for="{id}-material">{label}</label>
        </div>
HTML,

        'js' => <<<JS
       
$(document).ready(function() {
    
    var checkBox = $('#{id}-material');
    var values = {json};
    var checkBoxes = $('.material-checkbox').find('.form-check-input');
    
    if (!values)
        values = [];
    
    checkBoxes.each(function(key, v) {
    
        var val = $(v).attr('value');
        if (values.includes(val))
            $(v).attr('checked', 'checked');
    });
    
    checkBox.on('change', function() {
      if (typeof this.checked)
          $(this).attr('value', 1);
      else
          $(this).attr('value', 'f');
    });
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
        foreach ($this->data as $key => $value) {
            $content .= strtr($this->_layout[$this->_config['type']], [
                '{key}' => $key,
                '{id}' => $this->id++ . random_int(1,99999999),
                '{value}' => $key,
                '{name}' => $this->name,
                '{label}' => $value,
            ]);
        }
        $this->htm = $content;

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id++,
            '{json}' => $json,
        ]);
    }
}
