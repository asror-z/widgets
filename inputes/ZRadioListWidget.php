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

namespace zetsoft\widgets\inputes;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class    ZHDropDownListWidget
 * @package widgets\inputes
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#activeRadioList()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 *
 * Refactored: Doston Rakhmatov
 */
class ZRadioListWidget extends ZWidget
{

    public $data= [
      'Item1',
      'Item2',
      'Item3',
      'Item4',
      'Item5',
    ];

    public $config = [];
    public $_config = [
        'title' => '',
        'radio' => 'radio',
        'types' => ZRadioListWidget::type['horizontal'],

    ];

    /**
     *
     * Constants
     */
    public const type = [
        'horizontal' => 'horizontal',
        'vertical' => 'vertical'
    ];
    public $layout=[];
    public $_layout=[
        'main' => <<<HTML
            <div class="form-check" id="{id}">
                <span>{geticon}</span>
                <span>{placeholder}</span>
                {block1}                            
            </div>
HTML,
        'block1' => <<<HTML
                    <div class="form-control border-0 {class}" {readonly}>
                        <input type="radio"  value="{key}"  id="{key}" 
                         name="{name}" class="form-check-input" {checked} {readonly}> 
                        <label class="form-check-label" for="{key}">{value}</label>
                    </div>
HTML,
        'icon' => <<<HTML
          <i class="icon-prefix prefix {icon}"></i>
HTML,
    ];


    public function codes()
    {

        $geticon = '';
        if ($this->_config['hasIcon']) {
            $geticon = $this->htm .= strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon'],
            ]);
        }

        $block1 = '';

        foreach ($this->data as $key => $value) {
            if ($key == $this->value) {
                $check = 'checked';
            } else {
                $check = '';
            }

            $block1 .= $this->htm = strtr($this->_layout['block1'], [
                '{key}' => $key,
                '{id}' => $this->id,
                '{name}' => $this->name,
                '{attribute}' => $this->attribute,
                '{checked}' => $check,
                '{value}' => $value,
                '{class}' => $this->_config['class'],
                '{multiple}' => $this->_config['multiple'] ? 'multiple="multiple"' : '',
                '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',

            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{block1}' => $block1,
            '{id}' => $this->id,
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{geticon}' => $geticon
        ]);
    }


}
