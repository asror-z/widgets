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
 * Class ZHRadioWidget
 * @package widgets\inputes
 *
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#checkbox()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZMCheckboxGroupWidgetNew extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZMCheckboxGroupWidgetNew::type['MaterialCheckbox'],
    ];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
        'radio' => 'radio',
    ];

    public $layout = [];
    public $_layout = [
        'MaterialCheckbox' => <<<HTML
        <div class="form-check material-checkbox">
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
        'radio' => <<<HTML
        <div class="form-check material-checkbox">
            <input type="radio" class="form-check-input" id="{id}-material" value="{value}" name="{name}[]">
            <label class="form-check-label" for="{id}-material">{label}</label>
        </div>
HTML,

        'js' => <<<JS
           
    const checked = [];
        $('input:checkbox:checked').each(function() {
	        checked.push($(this).val());
});
JS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/awesome-bootstrap-checkbox@1.0.1/demo/build.css');
    }

    public function codes()
    {
        if ($this->data === null)
            echo 'data bering';


        $json = json_encode($this->value);
        $content = '';

        foreach ($this->data as $key => $value) {
            $content .= strtr($this->_layout[$this->_config['type']], [
                '{key}' => $key,
                '{id}' => $this->id++ . random_int(1, 9999999),
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
