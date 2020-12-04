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


use zetsoft\system\kernels\ZWidget;

/**
 * Class ZHRadioWidget
 * @package widgets\inputes
 *
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#checkbox()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZMRadioGroupMultiWidgetasd extends ZWidget
{

    public $data = [
        1 => 'Bosya',
        2 => 'Bosya1',
        3 => 'Bosya2',
    ];

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZMCheckboxGroupWidget::type['MaterialCheckbox'],
    ];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
    ];

    public $layout = [];
    public $_layout = [
        'MaterialCheckbox' => <<<HTML
        <div class="form-check">
           <input type="radio" class="form-check-input" id="{key}-material" value="{value}" name="{name}[]">
       <label class="form-check-label" for="{key}-material">{label}</label>
        </div>
HTML,
        'DefaultCheckbox' => <<<HTML
        <div class="form-check">
           <input type="radio" class="custom-control-input" id="{key}-material" value="{value}" name="{name}[]">
       <label class="custom-control-label" for="{key}-material">{label}</label>
        </div>
HTML,

        'js' => <<<JS


JS,

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
                '{id}' => $this->id,
                '{value}' => $value,
                '{name}' => $this->name . random_int(1, 1000) ,
                '{label}' => $value,
            ]);
        }
        $this->htm = $content;

        if (isset($value)){
            $this->js = strtr($this->_layout['js'], [
                '{id}' => $this->id
            ]);
        }
    }
}
