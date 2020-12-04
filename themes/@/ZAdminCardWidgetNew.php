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
class ZAdminCardWidgetNew extends ZWidget
{

    public $config = [];
    public $_config = [
        'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
        'isCardHeader' => false,
        'cardTitleBool' => true,
        'headerTitle' => 'headerTitle',
        'bodyTitle' => 'Body tittle',
        'bodyText' => '',
        'footerColor' => ZColor::color['success-color-dark'],
        'footerText' => 'Footer text',
        'BadgeBgColor' => ZColor::color['stylish-color-dark'],
        'badge' => 29,
        'isImage' => false,
        'ImageSize' => 10,
        'horizontal_OR_vertical' => 'vertical',
        'cardWidth' => '100%',
        'Icon' => '',
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

    public function codes()
    {
        $addStyle = '';
        if (strlen($this->_config['bodyText']) < 40) {
            $addStyle = 'addStyle';
        }


        $isCardHeader = !($this->_config['isCardHeader']) ? $this->jscode('d-none') : $this->jscode('d-block');
        $isHorOrVer = $this->_config['horizontal_OR_vertical'] === 'horizontal' ? $this->jscode('d-block') : $this->jscode('d-flex');


        $this->layout = [
            'main' => <<<HTML
        <div id="{id}">
            <div class="card hover_pointer border-rounded" >
                <div class="{$isCardHeader} {color}">
                    <h3 class="headerTitle">{headerTitle}</h3>
                </div>
                <div class="card-body" style="padding: 0!important;">
                     
                    <div class="addMin_width  {$isHorOrVer} {color}">
                    
                        {leftText}
                    
                        <div class="cardContent card-content w-75">
                        <div class="{$addStyle}">
                            <h1 class="titleText">{bodyTitle}</h1>
                            <p class="card-text myClass textCenter">{bodyText}</p> 
                          </div>
                        </div>
 
                         {rightText}

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
            @media screen and (max-width: 1200px) {
               .hover_pointer{
                    min-width:261px
               }
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
           /* .element-text img {
                width: 70px;
            }*/
            .headerTitle{
                font-size: 18px;
            }
             .titleText{
                font-size: 55px;
                font-weight: 700;
                margin: 0 10px;
             }
             .myClass{
                font-size: 15px;
                margin-right: 10px
             }
             .card-icon{
                margin-top: 10px;
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
               /* padding-bottom: 24px;*/ 
            }
            .headerTitle{
                padding-left: 20px;
                padding-top: 10px;
            }
            .AdminiconColor{
                font-size: 40px;
            }          
CSS,
/*'imageCss' => <<<CSS
        .myClass{
          margin-top: 20px;
        }
CSS,*/


        ];

        $text = <<<HTML
                <div class="card-icon element-text">
                    <i class="AdminiconColor {Icon} {color}"></i>
                </div>
                
HTML;

        if ($this->_config['isImage']) {
         $this->htm = strtr($text,[
             '{ImageSize}' => $this->_config['ImageSize'],
             $text = <<<HTML
                     <div class="card-icon element-text">
                    &nbsp;&nbsp;&nbsp;<img src="{Icon}" width="90px" height="90px"/>
                        </div>
HTML,
         ]);

            $this->css =
                <<<CSS
                 .card-text{
                   font-size: large;
                   background-color: black!important;
                 }
CSS
;

        }



        $leftText = '';
        $rightText = '';
        if ($this->_config['textPosition'] === 'textLeft')
            $leftText = strtr($text, [
                '{Icon}' => $this->_config['Icon'],
                '{color}' => $this->_config['color']
            ]);
        else
            $rightText = strtr($text, [
                '{Icon}' => $this->_config['Icon'],
                '{color}' => $this->_config['color'],

            ]);


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
            '{iconColor}' => $this->_config['iconColor']
        ]);
    }
}
