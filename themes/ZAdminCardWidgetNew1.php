<?php

namespace zetsoft\widgets\themes;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: AzimjonToirov
 * Refactored: AzimjonToirov
 */
class ZAdminCardWidgetNew1 extends ZWidget
{

    public $config = [];
    public $_config = [
        'template' => self::template['main'],
        'color' => ZColor::color['blue lighten-5'],
        'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
        /*'isCardHeader' => false,*/
        'align' => ZAdminCardWidget::align['center'],
        'cardTitleBool' => true,
        'headerTitle' => '',
        'bodyTitle' => '',
        'bodyText' => '',
        'footerColor' => ZColor::color['success-color-dark'],
        'footerText' => 'Footer text',
        'badgeBgColor' => ZColor::color['stylish-color-dark'],
        'badge' => 29,
        'isImage' => false,
        'imageSize' => 10,
        /*'horizontal_OR_vertical' => 'vertical',*/
        /*'cardWidth' => '100%',*/
        'icon' => '',
        'iconColor' => '',
        'grapes' => true,
        'icon-class' => '',
        'iconBack' => ZColor::color['blue-grey darken-1'],
        'footerPersent' => ''
    ];

    public $event = [];
    public $_event = [
        'click' => ' console.log("ZadminCardWidget | $eventClick") ',
        'dblclick' => ' console.log("ZButtonWidget | $eventDblclick") ',
        'mouseenter' => ' console.log("ZButtonWidget | $eventMouseEnter") ',
        'mouseleave' => ' console.log("ZButtonWidget | $eventMouseLeave") ',
        'keyup' => ' console.log("ZButtonWidget | $eventKeyup") ',
    ];

    public const template = [
        'main' => 'main',
        'second' => 'second'
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
        <div id="{id}"  {readonly} >
            <div class="card hover_pointer border-rounded" >
                <div class="card-body cardBody {color}">
                        <div class="{hTitle}">
                            <h3 class="headerTitle">{headerTitle}</h3>
                        </div>
                    <div class="addMin_width d-flex  {color}">                                
                             
                        {leftText}
                        <div class="cardContent card-content w-75">
                        <div class="{addStyle}">
                            <h1 class="titleText">{bodyTitle}</h1>
                            <p class="card-text myClass textCenter {addImageStyle} {align}">{bodyText}</p> 
                          </div>
                        </div>
                         {rightText}
                    </div>
                    <div class="card-text card-footer {footerColor} elementcenter footerOfCard"><a class="card-text" href="">{footerText}</a>
                            <sup class="badge {badgeBgColor}">{badge}</sup>
                        </div>
                </div>
            </div>
        </div>

HTML,

        'second' => <<<HTML
        <div class="second-template shadow border {color} mb-5">
            <div class="row h-75">
                <div class="col-8">
                    <h5 class="second-template-title-text text-uppercase white-text mb-0">{bodyTitle}</h5>
                    <span class="h2 font-weight-bold mb-0">{bodyText}</span>
                    <div class="w-100">
                        <div class="{hTitle}">
                            <h3 class="second-template-header-title p-0 white-text">{headerTitle}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-center">
                    <div class="text-white icon-div d-flex align-items-center justify-content-center {iconBack}">
                        <i class="fas fa-{icon} fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
HTML,

        'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave});
JS,

        'css' => <<<CSS
            @media screen and (max-width: 1200px) {
               .hover_pointer{
                    min-width:261px
               }
             }
             .bodyTitle{
                color: white;
             }
             .second-template{
                height: auto;
                border-radius: 10px;
                transition: all 1s ease;
             }
             .second-template {
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                min-height: 1px;
                padding: 1.25rem !important; 
            }
             .second-template:hover{
                cursor: pointer;
                transform: translateY(-10px);
             }
             .second-template-title-text{
                font-size: 55px;
                font-weight: 400;
                margin-right: 10px;
             }
             .second-template-header-title{
                 font-size: 18px;
             }
             .icon-div{
                width: 70px;
                height: 70px;
                border-radius: 50%;
             }
             .cardBody{
                padding: 0!important;
             }
             .card{
                color: white;
             }
            .icon{
                font-size: 70px;
                color: white;
            }
            .element-text{
                padding-left: 10px;
                font-size: 20px!important;
                font-weight: bold;
            }
            .headerTitle{
                font-size: 18px;

            }
            .titleText{
                font-size: 55px;
                font-weight: 400;
                margin-right: 10px;
            }
             .myClass{
                min-height: 104px;
                font-size: 15px;
                margin-right: 10px
             }
             .card-icon{
             
                margin-top: 5px;
             }
             .footerOfCard{
                height: 30px;
             }
             .footerOfCard a{
                font-size: 10px!important;   
             }   
             .hover_pointer{
                cursor: pointer;
             }            
             .hover_pointer:hover{
                box-shadow: 0 0 10px #000;
                cursor: pointer;
             }
            .card-text{ 
               text-align: right;
               color: white !important;
             }
            .cardContent{
                text-align: right;
             }
            .addStyle{
                /*padding-bottom: 24px;*/
                font-size: 50px!important; 
            }
            .addImageStyle{
                padding-top: 30px;
                font-size: 25px!important;
            }
            .headerTitle{
                padding-left: 20px;
                padding-top: 10px;
            }
            .adminiconColor{
                font-size: 40px;
            }
            .addMin_width{
                padding: 10px;
            }          
CSS,


    ];


    public function codes()
    {
        $addStyle = '';
        if (strlen($this->_config['bodyText']) < 40) {
            $addStyle = 'addStyle';
        }
        $addImageStyle = '';


        $text = <<<HTML
                <div class="card-icon element-text">
                    <i class="{icon} {class}"></i>
                </div>
                
HTML;

        if ($this->_config['isImage']) {
            $addImageStyle = 'addImageStyle';
            $text = <<<HTML
                 <div class="card-icon element-text">
                    <img src="{imgSrc}" class="p-1" width="85px" height="85px"/>
                </div>
HTML;

        }

        $leftText = '';
        $rightText = '';
        if ($this->_config['textPosition'] === 'textLeft')
            $leftText = strtr($text, [
                '{icon}' => $this->_config['icon'],
                '{color}' => $this->_config['color'],
                '{class}' => $this->_config['icon-class']
            ]);
        else
            $rightText = strtr($text, [
                '{icon}' => $this->_config['icon'],
                '{color}' => $this->_config['color'],
                '{class}' => $this->_config['icon-class']

            ]);

        $this->htm = strtr($this->_layout[$this->_config['template']], [
            '{id}' => $this->id,
            '{headerTitle}' => $this->_config['headerTitle'],
            '{hTitle}' => !empty($this->_config['headerTitle']) ? 'd-block' : 'd-none',
            '{color}' => $this->_config['color'],
            '{bodyTitle}' => $this->_config['bodyTitle'],
            '{bodyText}' => $this->_config['bodyText'],
            '{footerColor}' => $this->_config['footerColor'],
            '{footerText}' => $this->_config['footerText'],
            '{badgeBgColor}' => $this->_config['badgeBgColor'],
            '{badge}' => $this->_config['badge'],
            '{leftText}' => $leftText,
            '{rightText}' => $rightText,
            '{icon}' => $this->_config['icon'],
            '{align}' => $this->_config['align'],
            '{addImageStyle}' => $addImageStyle,
            '{addStyle}' => $addStyle,
            '{iconBack}' => $this->_config['iconBack'],
            '{footerPersent}' => $this->_config['footerPersent'],

            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',

        ]);

        $this->js = strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);


        $this->css = strtr($this->_layout['css'], [
            '{iconColor}' => $this->_config['iconColor'],
        ]);
    }
}
