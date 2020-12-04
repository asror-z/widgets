<?php

namespace zetsoft\widgets\themes;

use PhpOffice\PhpWord\Reader\HTML;
use PHPUnit\Util\Log\JSON;
use rmrevin\yii\fontawesome\FA;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZSampleWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: AzimjonToirov
 * Refactored: AzimjonToirov
 */
class ZAdminCardWidget_OLD extends ZWidget
{

    public $config = [];
    public $_config = [
        'textPosition' => ZAdminCardWidget_OLD::textPosition['textLeft'],
        'isCardHeader' => false,
        'cardTitleBool' => true,
        'headerTitle' => 'headerTitle',
        'bodyTitle' => 'Body tittle',
        'bodyText' => 'Body text',
        'footerColor' => ZColor::color['success-color-dark'],
        'footerText' => 'Footer text',
        'BadgeBgColor' => ZColor::color['stylish-color-dark'],
        'badge' => 29,

        'horizontal_OR_vertical' => 'vertical',
        'cardWidth' => '100%',
        'color' => ZColor::color['success-color-dark'],
        'Icon' => '',
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


    public function codes()
    {
        $addStyle = '';
        if(strlen($this->_config['bodyText'])<46){
            $addStyle = 'addStyle';
        }


        $isCardHeader = !($this->_config['isCardHeader']) ? $this->jscode('d-none') : $this->jscode('d-block');
        $isHorOrVer = $this->_config['horizontal_OR_vertical'] === 'horizontal' ? $this->jscode('d-block') : $this->jscode('d-flex');


        $this->layout = [
            'main' => <<<HTML
        <div id="{id}">
            <div class="card hover_pointer" >
                <div class="{$isCardHeader}">
                    <h3>{headerTitle}</h3>
                </div>
                <div class="card-body" style="padding: 0!important;">
                     
                    <div class="addMin_width  {$isHorOrVer} {color}">
                    
                        {leftText}
                    
                        <div class="cardContent card-content w-75 {color}">
                        <div class="{$addStyle}">
                            <h1 class="titleText">{bodyTitle}</h1>
                            <p class="card-text myClass">{bodyText}</p> 
                          </div>
                        </div>
                        
                         {rightText}
                        
                        <!--<div class="card-icon element-text">
                                <i class="icon {Icon}"></i>
                        </div>-->
                    </div>
                    
                    
                        <div class="card-text card-footer {footerColor} elementcenter footerOfCard"><a class="card-text" href="">{footerText}</a>
                            <sup class="badge {BadgeBgColor}">{badge}</sup>
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
            
          /*  .elementcenter{
                text-align: center;
            }
            */
            @media screen and (max-width: 1200px) {
               .hover_pointer{
                    min-width:261px
               }
             }
            .icon-element{
                    color:{color};            
            }
            
            .icon{
                font-size: 80px;
            }
            
            .element-text{
                color: white!important;
                padding-left: 10px;
                font-size: 20px!important;
                font-weight: bold;
            }
            
            .element-text img {
                width: 70px;
            }
            
             .card-text{
               color: white!important;
            }          
                
             .titleText{
                font-size: 75px;
                font-weight: bold;
                margin-left: 10px   ;
             }
             .myClass{
                font-size: 25px!important;
                margin-top: 10%;
                
             }
             .myClass:first-child{
             }
             .addMin_width{
                height: 120px;    
             }
             
             .card-icon{
                margin: auto;
               /* padding-right: 15px;
                padding-left: 15px;*/
             }
             .footerOfCard{
                height: 30px;
             }
             .footerOfCard a{
                font-size: 20px!important;   
             }
             
             }
             .hover_pointer{
                cursor: pointer;
             }
             
             .hover_pointer:hover{
                box-shadow: 0 0 10px #000;
             }
            .card-text{ 
               text-align: center;
             }
             .cardContent{
                text-align: center;
             }
             .addStyle{
                    padding-top:10px;
               }
CSS,
        ];

        $text = <<<HTML
                <div class="card-icon element-text">
                    <img src="{Icon}">
                </div>
HTML;

        $leftText = '';
        $rightText = '';
        if ($this->_config['textPosition'] === 'textLeft') {
            $leftText = strtr($text, [
                '{Icon}' => $this->_config['Icon']
            ]);
        } else {
            $rightText = strtr($text, [
                '{Icon}' => $this->_config['Icon']
            ]);
        }


        $this->htm = strtr($this->layout['main'], [
            '{id}' => $this->id,
            '{headerTitle}' => $this->_config['headerTitle'],
            '{color}' => $this->_config['color'],
            '{bodyTitle}' => $this->_config['bodyTitle'],
            '{bodyText}' => $this->_config['bodyText'],
            '{footerColor}' => $this->_config['footerColor'],
            '{footerText}' => $this->_config['footerText'],
            '{BadgeBgColor}' => $this->_config['BadgeBgColor'],
            '{badge}' => $this->_config['badge'],
            '{leftText}' => $leftText,
            '{rightText}' => $rightText,
            '{Icon}' => $this->_config['Icon'],
        ]);

        $this->js = strtr($this->layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);


        $this->css = strtr($this->layout['css'], [
            '{color}' => $this->_config['color']
        ]);
    }
}
