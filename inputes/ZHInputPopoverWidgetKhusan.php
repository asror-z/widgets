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


use kcfinder\fastImage;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

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
class ZHInputPopoverWidgetKhusan extends ZWidget
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
     
           <div class="m-0 {class} d-flex align-items-center justify-content-between" id="{inputId}">
           {icon}
           {hInput}
           {placeholder}
           {popover}
           
</div>

HTML,


        'icon' => <<<HTML
          <i class="icon-prefix prefix {icon}"></i>
HTML,

        'popover' => <<<HTML

    <div class="list-block">
        <a href="#" id="btn" class="btn" onclick="addList()"><i class="fas fa-info-circle"></i></a>
        <div class="list position-absolute px-3 py-0 text-white">
            <ul class="p-3 m-0">
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li> Lorem Ipsum</li>
            </ul>
        </div>
    </div>
         
HTML,
        'popover_x' => <<<HTML
     <button type="button" class="btn btn-primary" style="margin-right:15px" data-toggle="popover-x" data-target="#myPopover1a" data-placement="bottom">Primary</button>
    
     <div id="myPopover1a" class="popover popover-x popover-primary hide">
        <div class="arrow"></div>
        <div class="popover-header popover-title"><button type="button" class="close" data-dismiss="popover-x">&times;</button>Title</div>
        <div class="popover-body popover-content">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        </div>
    </div>

HTML,

        'css' => <<<CSS
        .btn {
            background: #f1f1f1;
            width: 40px;
            height: 40px;
        }
        .list-block {
            position: relative;
        }
        .list {
            background: #555;
            padding: 1em;
            left: -47px;
            top: 50px;
            font-size: 14px;
            border-radius: 5px;
        }
        .toggle {
            display: none;
        }
        .list ul {
            list-style: decimal;
        }
        .list ul li {
            border-bottom: 1px solid silver;
            margin: 10px 0;
        }
CSS,
        'js' => <<<JS
     const addList = () => document.querySelector('.list').classList.toggle('toggle');
JS,




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

        $iconCode = '';
        if ($this->_config['hasIcon']) {
            $iconCode = strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon']
            ]);
        }

        $this->options = [
            'class' => 'm-0 kv-editable-input form-control' . ' ' . $this->_config['class'],
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

        $popover = strtr($this->_layout['popover'],[
            //'{id}' => $this->id
        ]);



        $this->htm = strtr($this->_layout['main'], [
            '{icon}' => $iconCode,
            '{class}' => $this->_config['class'],
            '{placeholder}' => $iconCode,
            '{inputId}' => $this->id . '_div',
            '{hInput}' => $input,
            '{popover}' => $popover
        ]);

        $this->js = $this->_layout['js'];



    }
}
