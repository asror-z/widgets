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
class ZHInputPopoverWidget extends ZWidget
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
         
                            <!-- Default dropup button -->
            <div class="btn-group dropup parent-pos">
              <button id="{id}-button" type="button" class="btn btn-sm btn-secondary">
               <i class="fas fa-info-circle py-2"></i>
              </button>
              <div class="d-none drop-pop border p-3" id="{id}-drop">
                <div class="d-block">
                <h2>Токены</h2> 
</div>
               <ul style="list-style: decimal;">
                        <li>{status} - Статус лида (“waiting” – создан, “approved” - подтвержден, “canceled” - отклонен, “trash” - трэш)</li>
                        <li>{offer_id}- id оффера</li>
                        <li>{offer_name} - назание оффера</li> 
                        <li>{flow_id} - id потока</li>
                        <li>{track_id} - id заказа</li>
                        <li>{created_at} - дата заказа</li>
                        <li>{ip_address} - ip пользователя</li>
                        <li>{sub1} - SUB1</li>
                        <li>{sub2} - SUB2</li>
                        <li>{sub3} - SUB3</li>
                        <li>{sub4} - SUB4</li>
                        <li>{sub5} - SUB5</li>
                        <li>{country} - страна пользователя  </li>
                        <li>{city} - город пользователя </li>
                        <li>{region} - регион пользователя </li>
                        <li>{timezone} - часовой пояс </li>
                        <li>{device_model} - модель устройства</li>
                        <li>{browser}  - браузер</li>
                        <li>{cost} - cтоимость</li>
                        <li>{currency} - валюта </li>
                        <li>{device_os} - ОС устройства </li>
                       
                        </ul>
                  
              </div>
            </div>
         <!--
         
          <li>{utm_source}</li>
                        <li>{utm_term}</li>
                        <li>{utm_content}</li>
                        <li>{utm_campaign}</li>
                        <li>{source}</li>
                        <li>{revenue}</li>
                        <li>{keyword}</li>
                        <li>{external_id}</li>
                        <li>{creative_id}</li>
                        <li>{ad_campaign_id}</li>
         -->   

           
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
       
       .parent-pos{
            position: relative;
       }
       
       .drop-pop{
            position: absolute;
            right: 40px;
            top: -520px;
            z-index: 999;
            background-color: #fff;
            font-size: 12px;
            width: 270px;
       } 
        
CSS,

      'js' => <<<JS
        $('#{id}-button').on('click', function() {
            $('#{id}-drop').toggleClass('d-none');
        });
        
        /*$(document).on('click', function() {
            if (!$( "#{id}-drop" ).hasClass( "d-none" )){
                $('#{id}-drop').addClass('d-none');
            }
          
        });*/
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
            '{id}' => $this->id
        ]);



        $this->htm = strtr($this->_layout['main'], [
            '{icon}' => $iconCode,
            '{class}' => $this->_config['class'],
            '{placeholder}' => $iconCode,
            '{inputId}' => $this->id . '_div',
            '{hInput}' => $input,
            '{popover}' => $popover
        ]);

        $this->css = strtr($this->_layout['css'], [
            
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id
        ]);


    }
}
