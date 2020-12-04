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
 * Class ZHPasswordInputWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#passwordInput()-detail
 *
 */
class ZHPasswordInputWidget extends ZWidget
{
    public $config = [];
    public $_config = [
    'grapes' => true,
    'readonly' => false,
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div class="md-form m-0 {class}">
                {iconCode}&nbsp;{pinput}
            <label for="{id}"></label>
</div>
HTML,
        'icon' => <<<HTML
    <i class="icon-prefix prefix {icon}"></i>
HTML,
    ];

    public function codes()
    {

        $this->options = [
            'type' => 'password',
            'class' => 'kv-editable-input form-control',
            'disabled' => $this->_config['readonly'],
            'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            'id' => $this->id,
            'value' => $this->value,
        ];

        if (empty($this->model)) {
            $pinput = ZHTML::passwordInput(
                $this->name,
                $this->value,
                $this->options
            );
        } else {
            $pinput = ZHTML::activePasswordInput(
                $this->model,
                $this->attribute,
                $this->options
            );
        }

        $iconCode = '';
        if ($this->_config['hasIcon']) {
            $iconCode = strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon']
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{iconCode}' => $iconCode,
            '{pinput}' => $pinput,
            
            '{class}' => $this->_config['class']
        ]);
    }
}
