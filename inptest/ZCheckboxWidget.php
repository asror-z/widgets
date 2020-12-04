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

namespace zetsoft\widgets\inptest;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class    ZHDropDownListWidget
 * @package widgets\inptest
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#activeCheckboxList()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZCheckboxWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'encode' => false,
        'type' => ZCheckboxWidget::type['horizontal'],
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="form-check d-flex {class}" name="{name}" value="{value}" id="{id}">
            {iconCode} &ensp;&ensp;
         </div>
         
         
       
HTML,
        'iconCode' => <<<HTML
       <i class="{iconj} check-list"></i>
HTML,


    ];

    public const type = [
        'horizontal' => 'horizontal',
        'vertical' => 'vertical',
    ];

    public function codes()
    {
        $this->css = <<<CSS
         .check-list{
            font-size: 22px;
         }
CSS;
        if ($this->_config['hasIcon']) {
            foreach ($this->data as $value => $title):
                if ($value === $this->value)
                    $selected = true;
                else
                    $selected = false;

                $checked = '';
                if ($selected)
                    $checked = 'checked';

                $this->htm .= <<<HTML
                    <p class="marginRightCheckList">
                        <input type="checkbox" name="name[]" class="form-check-input danger-color" id="{$value}" value="{$value}" {$checked}>
                        <label class="form-check-label" for="{$value}">{$title}</label>
                    </p>
        HTML;

            endforeach;
        }


        $this->htm .= strtr($this->_layout['main'], [
            '{iconCode}' => $this->_layout['iconCode'],
            '{class}' => $this->_config['class'],
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}' => $this->value,
        ]);

        $this->htm .= strtr($this->_layout['iconCode'], [
            '{iconj}' => $this->_config['icon'],
        ]);


    }
}
