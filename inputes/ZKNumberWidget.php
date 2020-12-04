<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use kartik\number\NumberControl;

/**
 * Class ZKNumberWidget
 * @package widgets\inputes
 *
 * Refactored by: Olim Sattorov
 */
class ZKNumberWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'maskedInputOption' => [
            'alias' => 'numeric',
            'digits' => 2,
            'groupSeparator' => '.',
            'autoGroup' => true,
            'autoUnmask' => false,
            'unmaskAsNumber' => true,


        ]
    ];

    public function asset()
    {
    
    }


    public function codes()
    {
        $this->options = [
            'name' => $this->name,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'value' => $this->value,
            'bsVersion' => $this->bsVersion,
            'disabled' => $this->_config['disabled'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                '{id}' => $this->id,

            ],
            'displayOptions' => [
                'placeholder' => $this->_config['placeholder']
            ],//htrml attributes,
            'saveInputContainer' => [],//htrml attributes,
            'maskedInputOptions' => $this->_config['maskedInputOption']
        ];
        $number = NumberControl::widget($this->options);

        $iconCode = '';
        if($this->_config['hasIcon'])
            $iconCode = <<<HTML
        <i class="{$this->_config['icon']} prefix icon-prefix"></i>
HTML;


        $this-> htm = <<<HTML
    <div class="md-form" class="help-block invalid-feedback" >
    {$iconCode}
    {$number}
</div>
HTML;


    }

}
