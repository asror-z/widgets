<?php

namespace zetsoft\widgets\themes;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: Umid Abdurakhmonov
 * Refactored: Umid Abdurakhmonov
 */
class ZMarketAdminCardWidget1 extends ZWidget
{

    public $config = [];
    public $_config = [
        'percent' => 53,
        'title' => 'Bounce rate',
        'info' => 'More info',
        'infoUrl' => '/shop/user/main-common/main.aspx',
        'class' => 'align-items-center',
        'icon' => 'fa-th-large',
        'iconclass' => '',
        'isPercent' => true,
        'bg-color' => '#eeee',
        'theme' => true
    ];

    public $event = [];
    public $_event = [
        'click' => ' console.log("ZadminCardWidget | $eventClick") ',
        'dblclick' => ' console.log("ZButtonWidget | $eventDblclick") ',
        'mouseenter' => ' console.log("ZButtonWidget | $eventMouseEnter") ',
        'mouseleave' => ' console.log("ZButtonWidget | $eventMouseLeave") ',
        'keyup' => ' console.log("ZButtonWidget | $eventKeyup") ',
    ];

    public const textPosition = [
        'textLeft' => 'textLeft',
        'textRight' => 'textRight',
    ];

    public const align = [
        'center' => 'text-center',
        'right' => 'text-right',
        'left' => 'text-left',
    ];

    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
                    <a href="{infoUrl}" target="_blank" class="rounde d-flex justify-content-center align-items-center" style="background-color: {bg-color}">
                        <div class="row p-0 m-0 d-flex">
                            <div class="col-12 ">
                                <div class=" pt-3 {iconclass}">
                                    <i class="iconic fal {icon} fa-3x"></i>
                                </div>
                                <div class=" pt-3  {class}">
                                    <h3 class="">{percent}<sup style="font-size: 20px">{isPercent}</sup></h3>
                                    <p>{title}</p>
                                </div>
                            </div>
                        </div>
                    </a>
            
HTML,

        'theme' => <<<HTML
       
                    <a href="{infoUrl}" target="_blank" class="card-admin border">
                        <div class="card-body-admin d-flex justify-content-center align-items-center">
                            <div>
                                <div class="d-flex justify-content-center align-items-center mb-3">
                                    <span class="opacity-7 "><i class="fal {icon} fa-3x"></i></span>
                                </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h2 class=" mb-1 font-weight-medium">{percent}</h2>
                                    </div>
                                    <h6 class=" font-weight-normal mb-0 w-100 text-truncate">{title}</h6>
                            </div>
                        </div>
                    </a>
                
HTML,


        'event' => <<<JS
            /* $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave});*/
JS,

        'css' => <<<CSS
           .aclass{
            background: rgba(0,0,0,.1);
           }
           
           .rounded{
            border: 3px solid;
            border-color: #eeee;
           }
           .iconic{
           color: #eeee;
           }
           .card-admin {
            color: #37f;
            transition: background-color .3s ease-in-out;
           }
           .card-admin:hover {
            background-color: #37f;
            cursor: pointer;
           }
           .card-admin:hover *   {
            color: #fff!important;
           }
         /* .hvr-grow {
              -webkit-transform: perspective(1px) translateZ(0);
              transform: perspective(1px) translateZ(0);
              box-shadow: 0 0 1px rgba(0, 0, 0, 0);
              -webkit-transition-duration: 0.3s;
              transition-duration: 0.3s;
              -webkit-transition-property: transform;
              transition-property: transform;
            }  
            .hvr-grow:hover, .hvr-grow:focus, .hvr-grow:active {
              -webkit-transform: scale(1.0);
              transform: scale(1.0);
            }  */ 
CSS,


    ];

    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css');
        $this->fileCss('/render/asrorz/css/admines.css');

    }

    public function codes()
    {

        if ($this->_config['theme'])
            $this->htm = strtr($this->_layout['theme'], [
                '{id}' => $this->id,
                '{percent}' => (float)$this->_config['percent'],
                '{title}' => $this->_config['title'],
                '{info}' => $this->_config['info'],
                '{class}' => $this->_config['class'],
                '{iconclass}' => $this->_config['iconclass'],
                '{infoUrl}' => $this->_config['infoUrl'],
                '{icon}' => $this->_config['icon'],
                '{isPercent}' => $this->_config['isPercent'] ? '%' : '',
                '{bg-color}' => $this->_config['bg-color']
            ]);
        else {
            $this->htm = strtr($this->_layout['main'], [
                '{id}' => $this->id,
                '{percent}' => (float)$this->_config['percent'],
                '{title}' => $this->_config['title'],
                '{info}' => $this->_config['info'],
                '{class}' => $this->_config['class'],
                '{iconclass}' => $this->_config['iconclass'],
                '{infoUrl}' => $this->_config['infoUrl'],
                '{icon}' => $this->_config['icon'],
                '{isPercent}' => $this->_config['isPercent'] ? '%' : '',
                '{bg-color}' => $this->_config['bg-color']
            ]);

        }


        $this->js = strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);


        $this->css = strtr($this->_layout['css'], [
        ]);
    }
}
