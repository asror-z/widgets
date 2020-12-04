<?php

namespace zetsoft\widgets\themes;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: Azimjon Toirov
 * Refactored: Azimjon Toirov
 */
class ZAdminCardEyufWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
        /*'isCardHeader' => false,*/
        'align' => ZAdminCardWidget::align['center'],
        'cardTitleBool' => true,
        'headerTitle' => 'headerTitle',
        'bodyTitle' => '',
        'bodyText' => '',
        'footerColor' => ZColor::color['success-color-dark'],
        'footerText' => 'Footer text',
        'badgeBgColor' => ZColor::color['stylish-color-dark'],
        'badge' => 29,
        'isImage' => true,
        'imageSize' => 10,
        /*'horizontal_OR_vertical' => 'vertical',*/
        /*'cardWidth' => '100%',*/
        'icon' => '',
        'iconColor' => '',
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
        <div id="{id}">
            <div class="card hover_pointer border-rounded" >
                <div class="d-none">
                    <h3 class="headerTitle">{headerTitle}</h3>
                </div>
                <div class="card-body cardBody">
                     
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
                font-weight: 700;
                margin: 0 10px;
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
                    <i class="adminiconColor {icon} {color}"></i>
                </div>
                
HTML;

        if ($this->_config['isImage']) {
            $addImageStyle = 'addImageStyle';
            $this->htm = strtr($text, [
                $text = <<<HTML
                     <div class="card-icon element-text">
                    <img src="{icon}" class="p-1" width="85px" height="85px"/>
                        </div>
HTML,
            ]);

        }

        $leftText = '';
        $rightText = '';
        if ($this->_config['textPosition'] === 'textLeft')
            $leftText = strtr($text, [
                '{icon}' => $this->_config['icon'],
                '{color}' => $this->_config['color']
            ]);
        else
            $rightText = strtr($text, [
                '{icon}' => $this->_config['icon'],
                '{color}' => $this->_config['color'],

            ]);


        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{headerTitle}' => $this->_config['headerTitle'],
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
            '{iconColor}' => $this->_config['iconColor']
        ]);
    }
}
