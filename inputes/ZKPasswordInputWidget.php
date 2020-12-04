<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\password\PasswordInput;
use yii\web\JsExpression;

/**
 * Class ZKPasswordInputWidget
 * @package zetsoft\widgets\inputes
 * https://demos.krajee.com/password-details/password-input
 * Refactored: Doston Rakhmatov
 */
class ZKPasswordInputWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'size' => ZKPasswordInputWidget::size['md'],
        'togglePlacement' => ZKPasswordInputWidget::togglePlacement['left'],
        'isShowToggle' => false,
        'midChar' => 2,
        'consecAlphaUC' => 2,
        'consecAlphaLC' => 2,
        'consecNumber' => 2,
        'seqAlpha' => 3,
        'seqNumber' => 3,
        'seqSymbol' => 3,
        'length' => 4,
        'number' => 4,
        'symbol' => 6,
        'toggleMask' => false,

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZKPasswordInputWidget/image/icon.png',
        'name' => Azl . 'PasswordInput',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZKPasswordInputWidget/image/icon.png"/>',

    ];

    /**
     *
     * Constants
     */
    public const togglePlacement = [
        'left' => 'left',
        'right' => 'right'
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
        'xs' => 'xs'
    ];

    /**
     * Plugin Events
     * http://plugins.krajee.com/strength-meter#events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKPassword | $eventChange"); ',
        'toggle' => ' console.log("ZKPassword | $eventToggle"); ',
        'reset' => ' console.log("ZKPassword | $eventReset"); ',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="md-form  {class}" {readonly}>  
            {iconCode} 
            <div class="{margin}">  
                {password}
            </div>
</div>
HTML,
        'icon' => <<<HTML
        <i class="icon-prefix prefix {icon}"></i>
HTML,
    ];

    public function codes()
    {
        $this->options = [
            'bsVersion' => $this->bsVersion,
            'language' => Az::$app->language,
            'size' => $this->_config['size'],
            'togglePlacement' => $this->_config['togglePlacement'],
            'options' => [
                'id' => $this->id,
                'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            ],
            'pluginOptions' => [
                'toggleMask' => $this->_config['toggleMask'],
                'showMeter' => true,
                'showToggle' => $this->_config['isShowToggle'],
                //   'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">{toggle}</span></div>',
                'inputNoToggleTemplate' => '{input}',
                'meterTemplate' => '<div class="kv-scorebar-border">{scorebar}{score}</div>{verdict}',
                'meterClass' => 'kv-meter',
                'scoreBarClass' => 'kv-scorebar',
                'scoreClass' => 'kv-score',
                'verdictClass' => 'kv-verdict',
                'containerClass' => 'kv-password',
                'inputClass' => 'form-control',
                'toggleClass' => 'kv-toggle',
                'verdictTitles' => [
                    '1Too Short',
                    '1Very Weak',
                    '1Weak',
                    '1Good',
                    '1Strong',
                    '1Very Strong',
                ],
                'verdictClasses' => [
                    'badge badge-default',
                    'badge badge-danger',
                    'badge badge-warning',
                    'badge badge-info',
                    'badge badge-primary',
                    'badge badge-success',
                ],
                'rules' => [
                    'midChar' => $this->_config['midChar'],
                    'consecAlphaUC' => $this->_config['consecAlphaUC'],
                    'consecAlphaLC' => $this->_config['consecAlphaLC'],
                    'consecNumber' => $this->_config['consecNumber'],
                    'seqAlpha' => $this->_config['seqAlpha'],
                    'seqNumber' => $this->_config['seqNumber'],
                    'seqSymbol' => $this->_config['seqSymbol'],
                    'length' => $this->_config['length'],
                    'number' => $this->_config['number'],
                    'symbol' => $this->_config['symbol'],
                ]
            ],
            'name' => $this->name,
            'model' => $this->model,
            'attribute' => $this->attribute,
            /**
             * Plugin Events
             * http://plugins.krajee.com/strength-meter#events
             */
            'pluginEvents' => $this->eventsAll([
                'change' => 'change',
                'toggle' => 'toggle',
                'reset' => 'reset',
            ]),
        ];



        $password = PasswordInput::widget($this->options);

        $margin = $this->_config['hasIcon'] ? 'ml-5' : '';

        $iconCode = '';
        if ($this->_config['hasIcon'])
            $iconCode = strtr($this->_layout['icon'],[
                '{icon}' => $this->_config['icon']
            ]);

        $this->htm = strtr($this->_layout['main'], [
            '{class}' => $this->_config['class'],

            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
            '{password}' => $password,
            '{margin}' => $margin,
            '{iconCode}' => $iconCode,
        ]);


    }

}
