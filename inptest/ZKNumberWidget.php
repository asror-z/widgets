<?php

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;
use kartik\number\NumberControl;

/**
 * Class ZKNumberWidget
 * @package widgets\inputes
 *
 * Refactored: Bunyod Yoqubjonov
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
            'autoUnmask' => true,
            'unmaskAsNumber' => true,


        ]
    ];

    public $layout = [];
    public $_layout = [
        'main'=><<<HTML
            <div class="md-form">
                {iconCode}
                {number}
             </div>
HTML ,
        'iconCode'=><<<HTML
        <i class="{icon} prefix icon-prefix"></i>
HTML
    ];
    
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

  
        $this->htm = strtr($this->_layout['iconCode'], [
            '{icon}'=> $this->_config['icon']
        ]);

        $this->htm .= strtr($this->_layout['main'], [
          '{number}'=>$number,
          '{iconCode}'=>$this->_layout['iconCode']
        ]);



    }

}
