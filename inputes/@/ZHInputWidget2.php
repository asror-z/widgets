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
 * Class ZHInputWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#input()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 *
 * http://eyuf.zoft.uz/core/tester/asror/main.aspx?path=render\inputs\ZHInputWidget\valids-string_1#menu
 * http://eyuf.zoft.uz/core/tester/asror/main.aspx?path=render\inputs\ZHInputWidget\active-string_1#menu
 *
 */
class ZHInputWidget2 extends ZWidget
{


    public $config = [];
    public $_config = [
        'type' => ZHInputWidget::type['text'],
        'hidden' => false,
        'class' => '',
        'placeholder' => '',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
     
           <div class="m-0 {classMain}" id="{inputId}">
           {icon}
           {hInput}
</div>

      

HTML,


        'icon' => <<<HTML
          <i class="icon-prefix prefix {icon}" title="{tooltip}" aria-label="{title}"></i>
HTML,


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
        //start: JakhongirKudratov
        $margin =  $this->_config['hasIcon']? '': 'm-0 ';
        //end JakhongirKudratov

        $this->options = [
            'class' => $margin . 'kv-editable-input form-control' . ' ' . $this->_config['class'],
            'id' => $this->id,
            'disabled' => $this->_config['readonly'],
            'value' => $this->value,
            'hidden' => $this->_config['hidden'],
            'label' => $this->_config['placeholder'],
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
            '{class}' => $this->_config['class'],
            //start: JakhongirKudratov
            '{classMain}' => $this->_config['hasIcon']? 'md-form' : $this->_config['classMain'],
            //end JakhongirKudratov
            '{inputId}' => $this->id . '_div',
            '{tooltip}' => $this->id . '_div',
            '{hInput}' => $input,
        ]);


    }
}
