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


use kcfinder\fastImage;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZHInputWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#input()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 *
 * Clean Css By: Jasur Shukurov
 *
 */
class ZInputUniverseWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => self::type['text'],
        'hidden' => false,
        'validType' => self::validType['lotin'],
        'readonly' => false,
        'grapes' => true,
    ];


    public const type = [
        'button' => 'button',
        'checkbox' => 'checkbox',
        'color' => 'color',
        'date' => 'date',
        'datetime-local' => 'datetime-local',
        'email' => 'email',
        'file' => 'file',
        'hidden' => 'hidden',
        'image' => 'image',
        'month' => 'month',
        'number' => 'number',
        'password' => 'password',
        'radio' => 'radio',
        'range' => 'range',
        'reset' => 'reset',
        'search' => 'search',
        'submit' => 'submit',
        'tel' => 'tel',
        'text' => 'text',
        'time' => 'time',
        'url' => 'url',
        'week' => 'week'
    ];

    public const validType = [
        'krill' => 'krill',
        'number' => 'number',
        'lotin' => 'lotin',
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div class="md-form m-0" {readonly} >
               {icon}
               {hInput}
            </div>
HTML,
        //start:JakhongirKudratov
        'icon' => <<<HTML
          <!--<i class="icon-prefix prefix {icon}" title="{tooltip}"></i>-->
          <span class="hint--top-right prefix d-block" aria-label="{tooltip}"><i class="icon-prefix prefix {icon}"></i></span>

HTML,
        //end:JakhongirKudratov

        'krill' => <<<JS
    $("#{id}").keypress(function (event) {
        var verified_email = String.fromCharCode(event.which).match(/[a-zA-Z-]/);
        if (verified_email) {
            event.preventDefault();
        }
    });
JS,
        'number' => <<<JS
    document.oninput = function() {
    var input = document.querySelector('#{id}');
    input.value = input.value.replace (/\D/g, '');
    }
JS,
        'lotin' => <<<JS
   $("#{id}").keypress(function (event) {
        var verified_email = String.fromCharCode(event.which).match(/[^a-w]/ig,'');
        if (verified_email) {
       event.preventDefault();
        }
      })
JS,
    ];

    public function codes()
    {


        /*$iconCode = '';
        if ($this->_config['hasIcon']) {
            $iconCode = strtr($this->layout['icon'], [
                '{icon}' => $this->_config['icon']
            ]);
        }*/

        $this->options = [
            'class' => 'kv-editable-input form-control ' . ' ' . $this->_config['class'],
            'id' => $this->id,
            'disabled' => $this->_config['readonly'],
            'value' => $this->value,
            'hidden' => $this->_config['hidden'],
            'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
        ];

        if (!$this->modelCheck())
            $input = ZHTML::input(
                $this->_config['type'],
                $this->name,
                $this->value,
                $this->options);
        else
            $input = ZHTML::activeInput(
                $this->_config['type'],
                $this->model,
                $this->attribute,
                $this->options);


        $this->htm = strtr($this->_layout['main'], [
            '{icon}' => $this->_config['iconCode'],
            '{hInput}' => $input,
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',

            /*'{readonly}' => $this->_config['readonly'] ? 'readonly' :'{type}' => $this->_config['type'],*/

        ]);

        $this->js = strtr($this->_layout[$this->_config['validType']], [
            '{id}' => $this->id
        ]);
    }
}
