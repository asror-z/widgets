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


use zetsoft\system\assets\ZColor;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/**
 * Class ZHInputWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#input()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.aspx
 *
 * http://eyuf.zoft.uz/core/tester/asror/main.aspx?path=render\inputs\ZHInputWidget\valids-string_1#menu
 * http://eyuf.zoft.uz/core/tester/asror/main.aspx?path=render\inputs\ZHInputWidget\active-string_1#menu
 *
 */
class ZHInputWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'type' => ZHInputWidget::type['text'],
        'hidden' => false,
        'class' => '',
        'classMain' => '',
        'placeholder' => '',
        'hintRounded' => true,
        'ttText' => 'sdafdsfsa',

        //That config button for weight
        'buttonWeight' => false,
        'classButton' => '',
        'btnClass' => 'pb-5',
        //end
    ];

    public $event = [];
    public $_event = [
        'buttonClick' => <<<JS
           function(event) {
                console.log('buttonClick')
           }
JS,
        'keyup' => <<<JS
        function (e) {
            console.log(e)
           if (e.keyCode === 13) {
                console.log('inHinputs')
           }
        }
JS,


    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="m-0 {classMain}" id="{inputId}">
              {icon}
              {hInput}
            {btn}
        </div>
HTML,

        'btn' => <<<HTML
        <div class="{btnClass}"> 
            {button}
        </div>
HTML,


        //start: JakhongirKudratov
        'icon' => <<<HTML
          <!--<i class="icon-prefix prefix {icon}" title="{tooltip}"></i>-->
          <span class="hint--top-right prefix d-block" aria-label="{tooltip}"><i class="icon-prefix prefix {icon}"></i></span>

HTML,
        //end JakhongirKudratov


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


    public static $grapes = [
        'enable' => true,
        'icon' => null,
        'image' => null,
        'height' => '550px',
        'width' => '500px',
        'dbType' => null,
        'modalWidth' => null,
        'title' => Azl . null,
        'descs' => Azl . null,
    ];


    public function codes()
    {
        //start:JakhongirKudratov


        $margin = $this->_config['hasIcon'] ? '' : 'm-0 ';

        //end:JakhongirKudratov


        //start: MurodovMirbosit 09.10.2020
        $button = '';

        if ($this->_config['buttonWeight']) {
            $button = strtr($this->_layout['btn'], [
                '{button}' => ZButtonWidget::widget([
                    'config' => [
                        'btn' => true,
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                        'btnRounded' => false,
                        'btnFloating' => false,
                        'btnSize' => ZColor::btnSize['btn-micro'],
                        'text' => $this->_config['buttonText'],
                        'class' => 'my-0' . $this->_config['classButton'],
                    ],
                    'active' => [
                        'click' => true
                    ],
                    'event' => [
                        'click' => $this->eventCode('buttonClick'),
                        'keyup' => $this->eventCode('keyup'),
                    ]
                ]),
            ]);
        }

        //  var_dump($this->_config['readonly']);


//        $readonly = $this->model->configs->readonly();
        //end:MurodovMirbosit
        $this->options = [
            'class' => $margin . 'kv-editable-input form-control' . ' ' . $this->_config['class'],
            'id' => $this->id,
            'disabled' => $this->_config['readonly'],
            'value' => $this->value,
            'hidden' => $this->_config['hidden'],
            'label' => $this->_config['placeholder'],
            'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
        ];

        $input = ZHTML::input(
            $this->_config['type'],
            $this->name,
            $this->value,
            $this->options);

        $this->htm = strtr($this->_layout['main'], [
            '{icon}' => $this->_config['iconCode'],
            '{class}' => $this->_config['class'],
            '{btn}' => $button,
            //start: JakhongirKudratov
            '{classMain}' => $this->_config['hasIcon'] ? 'md-form' : $this->_config['classMain'],
            //end JakhongirKudratov
            '{inputId}' => $this->id . '_div',
            '{btnClass}' => $this->_config['btnClass'],
            '{tooltip}' => $this->id . '_div',
            '{hInput}' => $input,

        ]);


    }
}
