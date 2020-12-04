<?php

/**
 *
 *
 * Created By: Shakxzod Namazbaev
 * Created_at: 03.12.2019
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZButtonWidgetNewX extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        /**
         *
         * ALL
         */

        'text' => '',
        'title' => '',
        'btn' => true,
        'btnType' => ZButtonWidget::btnType['link'],
        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
        'btnSize' => ZButtonWidget::btnSize['btn-micro'],
        'btnRounded' => true,
        'btnFloating' => false,

        'toggle' => ZButtonWidget::toggle['tooltip'],
        'color' => ZColor::color['none'],

        /**
         *
         * Button
         */
        'dataTarget' => '',
        'ic-target' => '',
        'ic-push-url' => true,


        'btnPaddingLeft' => ZButtonWidget::btnScale['default'],
        'btnPaddingRight' => ZButtonWidget::btnScale['default'],
        'btnPaddingTop' => ZButtonWidget::btnScale['default'],
        'btnPaddingBottom' => ZButtonWidget::btnScale['default'],
        'btnIconSize' => ZButtonWidget::btnScale['default'],
        'btnFontSize' => ZButtonWidget::btnScale['default'],
        'btnHeight' => ZButtonWidget::btnScale['default'],
        'btnIconPadding' => ZButtonWidget::btnScale['default'],
        /**
         *
         * Links
         */
        'url' => '#',
        'target' => ZButtonWidget::target['_self'],
        'method' => ZButtonWidget::method['none'],
        'iconsSm' => false,


        /**
         *
         * Badge
         */
        'badge' => '100',
        'badgeType' => ZButtonWidget::badgeType['badge-default'],


        /**
         *
         * Confirm
         */
        'hasConfirm' => false,
        'confirm' => 'Вы уверены?',
        'confirmTitle' => 'Подтверждение',
        'canselLabelText' => 'cancel',
        'confirmLabelText' => 'ok',
        'blank' => false,


        /**
         *
         * Tooltip
         */
        'hintRounded' => true,
        'ttSize' => ZButtonWidget::ttSize['medium'],
        'ttSide' => ZButtonWidget::ttSide['top'],
        'ttColor' => ZButtonWidget::ttColor['info'],
        'ttAnimate' => ZButtonWidget::ttAnimate['bounce'],
        /**
         *
         * Icon
         */


        'iconColor' => ZColor::color['warning-color'],

        'download' => false,
        'class' => '',
        'iconSizePx' => ''
    ];

    /**
     *
     * Constants
     *
     */


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */


    public $event = [];
    public $_event = [
        'click' => ' console.log("ZButtonWidget | $eventClick") ',
        'dblclick' => ' console.log("ZButtonWidget | $eventDblclick") ',
        'mouseenter' => ' console.log("ZButtonWidget | $eventMouseEnter") ',
        'mouseleave' => ' console.log("ZButtonWidget | $eventMouseLeave") ',
        'keyup' => ' console.log("ZButtonWidget | $eventKeyup") ',
    ];

    public const btnType = [
        'link' => 'link',
        'reset' => 'reset',
        'button' => 'button',
        'submit' => 'submit'
    ];

    public const btnSize = [
        'btn-lg' => 'btn-lg',
        'btn-md' => 'btn-md',
        'btn-sm' => 'btn-sm',
        'btn-micro' => 'btn-micro',
        'btn-mini' => 'btn-mini',
        'btn-manual' => 'btn-manual',
        'default' => ''
    ];

    public const target = [
        '_blank' => '_blank',
        '_self' => '_self',
        '_top' => '_top',
    ];

    public const toggle = [
        'tooltip' => 'tooltip',
        'collapse' => 'collapse',
        'dropdown' => 'dropdown',
        'modal' => 'modal',
        'tab' => 'tab',
        'pill' => 'pill',
        'button' => 'button',
        'buttons' => 'buttons',
    ];
    public const iconSize = [
        'default' => '',
        '0' => 'fa-0',
        '1x' => 'fa-1x',
        '2x' => 'fa-2x',
        '3x' => 'fa-3x',
        '4x' => 'fa-4x',
        '5x' => 'fa-5x',
    ];

    public const btnScale = [
        'default' => '',
        '0' => '0rem',
        '0.1' => '0.1rem',
        '0.2' => '0.2rem',
        '0.3' => '0.3rem',
        '0.4' => '0.4rem',
        '0.5' => '0.5rem',
        '0.6' => '0.6rem',
        '0.7' => '0.7rem',
        '0.8' => '0.8rem',
        '0.9' => '0.9rem',
        '1' => '1rem',
        '1.1' => '1.1rem',
        '1.2' => '1.2rem',
        '1.3' => '1.3rem',
        '1.4' => '1.4rem',
        '1.5' => '1.5rem',
        '1.6' => '1.6rem',
        '1.7' => '1.7rem',
        '1.8' => '1.8rem',
        '1.9' => '1.9rem',
        '2' => '2rem',
        '2.1' => '2.1rem',
        '2.2' => '2.2rem',
        '2.3' => '2.3rem',
        '2.4' => '2.4rem',
        '2.5' => '2.5rem',
    ];


    public $layout = [];
    public $_layout = [

        'attr' => <<<HTML
             id="{id}"
             title="{title}" 
             data-toggle="{data-toggle}" 
   
             data-pjax="{data-pjax}"
             class="{btn} {btn-rounded} ovr-button {btn-floating} {icons-sm} {btnStyle} {color} {btnSize} hint--{ttSide} hint--{ttColor} hint--{ttSize} hint--{ttAnimate} {hint--rounded} {class}"
             aria-label="{title}" 
             aria-hidden="{aria-hidden}"
HTML,

        'button' => <<<HTML
             <button 
                class="{btnSize}" 
               data-target="{data-target}"
               type="{btn-type}"
               {attrCode} name="{name}">
                 {iconCode}
                 {text}
             </button> 
             {badgeCode}
                
HTML,
        'cooler' => <<<HTML
             <button 
                type="{btn-type}" 
                ic-post-to="{url}"
                ic-push-url="{ic-push-url}"
                ic-target="{ic-target}"
                ic-select-from-response=""
                {attrCode}
             >
                 {iconCode}
                 {text}
             </button> 
             {badgeCode}
                
HTML,

        'link' => <<<HTML
             <a 
             href="{url}" 
             target="{target}"  
             {data-method}
             {download}
             {attrCode}
             >
                 {iconCode}
                 {text}
             </a> 
             {badgeCode}
                
HTML,

        'confirm' => <<<JS
              $(document).on("click", '#{id}' ,function (event) {
                bootbox.confirm({
                title: "{confirmTitle}",
                message: "{confirm}",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> {canselLabelText}'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> {confirmLabelText}'
                    }
                },
                callback: function (result) {
                if (result === true)
                  /*window.open('{url}');*/
                  /*console.log(result);*/                     
                  location.href = '{url}';

                else
                console.log(event); 
            }
});
                

        });
JS,
        'method' => <<<HTML
                data-method="{data-method}" 
             
HTML,
        'icon' => <<<HTML
                <i class="{icon} {iconSize} iconColor-{id}"></i>
                
HTML,
        'ic-icon' => <<<HTML
                <i class="ic-indicator fa fa-spinner fa-spin" style="display: none"></i>
                
HTML,
        'badge' => <<<HTML
                <span class="badge {badgeType} counter">{badge}</span>
             
HTML,


        'style' => <<<CSS
            /*this css for intercooler*/
            #content{
            transition: all .3s;
            }
            #content.ic-transitioning{
                opacity: 0;
            }
                
            .color-icon{
                color: transparent;
            }
            .ovr-button{
              overflow : visible!important;
              
            }
            
            .iconColor-{id} {
              color: {iconColor} !important;
              font-size: {iconSize}px !important;
            /*  padding: 5px !important;
              padding-right: 10px !important;*/
            }
            .my-btn-icon{
              position: relative;
               left: 3px;
            }
            
            .counter{
              margin-left: -21px !important;
            }
            .eyeNoHover:hover{
              background: #fff!important;
            }
            
            .full-width{
                width: 100% !important;
            }
            
             .btn-micro {
          height: 2rem!important;
          font-size: 0.6rem!important;
          padding-right: 0.7rem!important; 
         padding-top: 0.5rem!important;
         /*padding-bottom: 0.5rem;*/
         padding-left: 0.7rem!important; 
         }

         .btn-micro .btn{
         font-size: 0.6rem!important;
         padding-right: 0.7rem!important; 
         padding-top: 0.5rem!important;
         /*padding-bottom: 0.5rem;*/
         padding-left: 0.7rem!important;             
         }
         .btn-micro i{
         font-size: 0.7rem!important;
         padding: 0.1rem!important;
         }
         
         .btn-mini {
         font-size: 0.9rem!important;
          height: 2.3rem!important;
          padding-right: 0.9rem!important; 
         padding-top: 0.5rem!important;
         padding-bottom: 0.9rem!important;
         padding-left: 0.9rem!important;
         }
         .btn-mini .btn{
         font-size: 0.9rem;
         padding-right: 0.9rem!important; 
         padding-top: 0.5rem!important;
         padding-bottom: 0.9rem!important;
         padding-left: 0.9rem!important;             
         }
         .btn-mini i{
         font-size: 0.9rem!important;
         padding: 0.1rem;
         }
         
         .btn-manual {
         font-size: {btnFontSize}!important;
          height: {btnHeight}!important;
          padding-right: {btnPaddingRight}!important; 
         padding-top: {btnPaddingTop}!important;
         padding-bottom: {btnPaddingBottom}!important;
         padding-left: {btnPaddingLeft}!important; 
         }
         
         .btn-manual .btn{
         font-size: {btnFontSize}!important;
         padding-right: {btnPaddingRight}!important; 
         padding-top: {btnPaddingTop}!important;
         padding-bottom: {btnPaddingBottom}!important;
         padding-left: {btnPaddingLeft}!important;             
         }
         .btn-manual i{
         font-size: {btnIconSize}!important;
         padding: {btnIconPadding}!important;
         }
         

CSS,

        'event' => <<<JS
            $(document).on('click', '#{id}', {click});
            $('#{id}')
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave});
            {confirmCode}
            {clickCode}
JS,

    ];


    public function asset()
    {
        //css
        $this->fileCss('https://cdn.jsdelivr.net/npm/hint.css@2.6.0/hint.css');
        $this->fileCss("https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-classic.min.css");
        $this->fileCss("https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-square-o.min.css");
        $this->fileCss("https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vivid.min.css");
        $this->fileCss("https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vectors.min.css");

        //js
        $this->fileJs('https://code.jquery.com/jquery-migrate-3.0.0.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js');
    }

    public function codes()
    {


        $confirmCode = '';
        if ($this->_config['hasConfirm'])
            $confirmCode = strtr($this->_layout['confirm'], [

                '{id}' => $this->id,
                '{url}' => $this->_config['url'],
                '{confirm}' => $this->_config['confirm'],
                '{confirmTitle}' => $this->_config['confirmTitle'],
                '{canselLabelText}' => $this->_config['canselLabelText'],
                '{confirmLabelText}' => $this->_config['confirmLabelText']
            ]);

        $clickCode = '';
        if ($this->modelCheck()) {
            if ($this->_config['blank']) {
                $clickCode = <<<JS
            $('#{$this->id}').on('click', function() {
                  window.open('{$this->value}')
            });
JS;

            }
        } else {
            if ($this->_config['blank']) {
                $clickCode = <<<JS
            $('#{$this->id}').on('click', function() {
                  window.open('{$this->_config['url']}')
            });
JS;

            }
        }

        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,

            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
            '{confirmCode}' => $confirmCode,
            '{clickCode}' => $clickCode

        ]);

        $this->css .= strtr($this->_layout['style'], [
            '{iconColor}' => $this->_config['iconColor'],
            '{id}' => $this->id,
            '{iconSize}' => $this->_config['iconSizePx'],
            '{btnPaddingLeft}' => $this->_config['btnPaddingLeft'],
            '{btnSize}' => $this->_config['btnSize'],
            '{btnPaddingRight}' => $this->_config['btnPaddingRight'],
            '{btnPaddingTop}' => $this->_config['btnPaddingTop'],
            '{btnPaddingBottom}' => $this->_config['btnPaddingBottom'],
            '{btnIconSize}' => $this->_config['btnIconSize'],
            '{btnFontSize}' => $this->_config['btnFontSize'],
            '{btnHeight}' => $this->_config['btnHeight'],
            '{btnIconPadding}' => $this->_config['btnIconPadding'],

        ]);


        $badgeCode = '';
        if ($this->_config['hasBadge'])
            $badgeCode = strtr($this->_layout['badge'], [
                '{badge}' => $this->_config['badge'],
                '{badgeType}' => $this->_config['badgeType'],
            ]);


        $iconCode = '';
        if ($this->_config['hasIcon'])
            $iconCode = strtr($this->_layout['icon'], [
                /*'{btnHeight }' => $this->_config['btnHeight'],*/
                '{icon}' => $this->_config['icon'],
                '{iconSize}' => $this->_config['iconSize'],
                '{id}' => $this->id,
            ]);


        $dataMethod = '';
        if ($this->_config['method'] !== self::method['none'])
            $dataMethod = strtr($this->_layout['method'], [
                '{data-method}' => $this->_config['method'],
            ]);


        /*if (empty($this->_config['title']))
            $this->_config['title'] = $this->_config['text'];*/

        $attrCode = strtr($this->_layout['attr'], [

            '{id}' => $this->id,
            '{text}' => $this->_config['text'],
            '{title}' => $this->_config['title'],
            '{class}' => $this->_config['class'],
            '{data-toggle}' => $this->_config['toggle'],
            '{btnStyle}' => $this->_config['btnStyle'],
            '{btnType}' => $this->_config['btnType'],
            '{btnSize}' => $this->_config['btnSize'],

            '{color}' => $this->_config['color'],
            '{data-pjax}' => $this->_config['pjax'] ? true : false,
            '{btn-floating}' => $this->_config['btnFloating'] ? 'btn-floating' : '',
            '{hint--rounded}' => $this->_config['hintRounded'] ? 'hint--rounded' : '',
            '{aria-hidden}' => $this->_config['ariaHidden'] ? 'true' : '',
            '{btn-rounded}' => $this->_config['btnRounded'] ? 'btn-rounded' : '',
            '{btn}' => $this->_config['btn'] ? 'btn' : '',
            '{icons-sm}' => $this->_config['iconsSm'] ? 'icons-sm' : '',

            '{ttSize}' => $this->_config['ttSize'],
            '{ttSide}' => $this->_config['ttSide'],
            '{ttColor}' => $this->_config['ttColor'],
            '{ttAnimate}' => $this->_config['ttAnimate'],


        ]);

        if ($this->_config['btnType'] === ZButtonWidget::btnType['link'])
            $_layout = $this->_layout['link'];
        else
            $_layout = $this->_layout['button'];

        if ($this->_config['cooler']) {
            $_layout = strtr($this->_layout['cooler'], [
                '{ic-target}' => $this->_config['ic-target'],
                '{ic-push-url}' => $this->_config['ic-push-url']
            ]);
            if ($this->_config['hasIcon'])
                $iconCode = $this->_layout['ic-icon'];
        }

        $this->htm = strtr($this->_layout['button'],[
            '{btnSize}' => $this->_config['btnSize']
        ]);


        if ($this->modelCheck())

            $this->htm .= strtr($_layout, [

                /**
                 *
                 * Button
                 */
                '{data-target}' => $this->_config['dataTarget'],
                '{btn-type}' => $this->_config['btnType'],


                /**
                 *
                 * Links
                 */
                '{text}' => $this->_config['text'],
                '{url}' => $this->value,
                '{target}' => $this->_config['target'],
                '{data-method}' => $dataMethod,

                '{attrCode}' => $attrCode,

                '{iconCode}' => $iconCode,
                '{badgeCode}' => $badgeCode,
                '{download}' => $this->_config['download'] ? 'download' : '',
                '{btnSize}' => $this->_config['btnSize'],

            ]);

        else

            $this->htm .= strtr($_layout, [

                /**
                 *
                 * Button
                 */
                '{data-target}' => $this->_config['dataTarget'],
                '{btn-type}' => $this->_config['btnType'],
                '{name}' => empty($this->_config['name']) ? '' : $this->_config['name'],

                /**
                 *
                 * Links
                 */
                '{text}' => $this->_config['text'],
                '{url}' => $this->_config['url'],
                '{target}' => $this->_config['target'],
                '{data-method}' => $dataMethod,

                '{attrCode}' => $attrCode,

                '{iconCode}' => $iconCode,
                '{badgeCode}' => $badgeCode,
                '{download}' => $this->_config['download'] ? 'download' : '',


            ]);




    }


}
