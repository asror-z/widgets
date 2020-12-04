<?php

/**
 *
 *
 * Created By: Shakxzod Namazbaev
 * Created_at: 03.12.2019
 * Refactored By: Xakimjon Ergashov
 * Refactored_at 05.05.2020
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use function Amp\Parallel\Worker\factory;

class ZButtonWidget_2 extends ZWidget
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

        'btnRounded' => true,
        'btnFloating' => false,


        'toggle' => ZButtonWidget::toggle['tooltip'],
        
        'color' => ZColor::color['none'],
        'colorHover' => ZColor::color['none'],
        'colorFocus' => ZColor::color['green'],
        'colorActive' => ZColor::color['none'],
        'class' => 'border-none',
        'hidden' => false,

        /**
         *
         * Button
         */
        'dataTarget' => '',
        'ic-target' => '',
        'ic-push-url' => true,

        'btnSize' => ZColor::btnSize['default'],
        'btnPaddingLeft' => ZButtonWidget::btnScale['default'],
        'btnPaddingRight' => ZButtonWidget::btnScale['default'],
        'btnPaddingTop' => ZButtonWidget::btnScale['default'],
        'btnPaddingBottom' => ZButtonWidget::btnScale['default'],
        'btnIconSize' => ZButtonWidget::btnScale['default'],
        'btnFontSize' => ZButtonWidget::btnScale['default'],
        'btnHeight' => ZButtonWidget::btnScale['default'],
        'btnIconPadding' => ZButtonWidget::btnScale['default'],

        /*
    * ajax settings
    * */
        'ajax' => false,
        'type' => ZAjaxWidget::type['get'], //"POST", "GET", "PUT"
        'data' => '{id:'. 2 .'}',
        'attr' => '',
        'crossDomain' => false,
        'password' => '',
        'username' => '',
        'context' => 'document.body', // this
        'contentType' => '', // example : application/json
        'async' => true, // Use false when dataType : 'jsonp'
        'dataType' => 'json', //xml, json, script, or html
        'cache' => true, //true, false for dataType 'script' and 'jsonp'
        'jsonp' => false,
        'jsonpCallback' => '',
        'timeout' => 2000,
        'traditional' => true,

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
        /*'class' => '',*/
        'iconSizePx' => '',
        'icon' => ''
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
        'beforeSend' => "function( jqXHR , settings) {
              console.log('ZButtonWidget | beforesend');
          }",
        'success' => "function(data , textStatus , jqXHR) {
              console.log('ZButtonWidget | succes')
          }",
        'error' => "function( jqXHR,  textStatus,  errorThrown) { 
            // if error occured
              console.log('ZButtonWidget | error');
          }",
        'complete' => "function(jqXHR, textStatus) {
              console.log('ZButtonWidget | complete');
          }",
        'done' => "function(yourVariable) {
            // do smth when you get yourVariable
            // return smthVariable
            console.log('ZButtonWidget | done')
        }",
        'fail' => "function(yourVariable) {
           // do smth when you get yourVariable
             console.log('ZButtonWidget | fail')
        }",
        'always' => "function(yourVariable) {
            // do smth when you get yourVariable
            console.log('ZButtonWidget | always')
        }"
    ];

    public const btnType = [
        'link' => 'link',
        'reset' => 'reset',
        'button' => 'button',
        'submit' => 'submit',
        'settingBtn' => 'settingBtn',
        'sweetBtn' => 'sweetBtn'
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
        '10' => '10rem'
    ];


    public $layout = [];
    public $_layout = [

        'attr' => <<<HTML
             id="{id}"
              
             data-toggle="{data-toggle}" 
   
             data-pjax="{data-pjax}"
             class="{btnSize} {btn} {btn-rounded} ovr-button {btn-floating}  {icons-sm} {btnStyle} {color} hint--{ttSide} hint--{ttColor} hint--{ttSize} hint--{ttAnimate} {hint--rounded} {class}" 
             aria-label="{title}" 
             aria-hidden="{aria-hidden}"
             {hidden}
HTML,

        'button' => <<<HTML
             <button  
               data-target="{data-target}"
               type="{btn-type}" {attrCode} name="{name}">
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
              $('#{id}').on("click", function (event) {
              
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

        'ajax' => <<<JS
function (){
    $.ajax({
        url: '{url}',
        type: '{type}',
         
        crossDomain : {crossDomain},  
        password : '{password}',  
        username : '{username}',
        context : '{context}',
        contentType: '{contentType}',
        async: {async}, // Use false when dataType : 'jsonp'
        dataType: '{dataType}', //mycustomtype
        cache:{cache}, //  false for dataType 'script' and 'jsonp'
        jsonp:{jsonp}, // String or Boolean
        jsonpCallback: '{jsonpCallback}',
	    timeout : '{timeout}',
	    traditional: {traditional},
        success : {success},
        complete: {complete},
        error : {error},
	    beforeSend: {beforeSend},
        statusCode: {
            404: function() {
                  alert( "page not found" );
            }
        },
        {data}          
    }).done({done}).fail({fail}).always({always}); 
}
JS,
        'data' => <<<HTML
data: {data}
HTML,


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
            .iconColor-{id} {
              color: {iconColor} !important;
              font-size: {iconSize}px !important;
            }

CSS,

        'event' => <<<JS
            $(document)
            .on('click', '#{id}', {click})
            .on('dblclick', '#{id}',{dblclick})
            .on('keyup', '#{id}',{keyup})
            .on('mouseenter', '#{id}',{mouseenter})
            .on('mouseleave', '#{id}',{mouseleave});
            {confirmCode}
            {clickCode}
JS,

    ];


    public function asset()
    {

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

        $data = '';
        if (isset($this->_config['data']))
            $data = strtr($this->_layout['data'], [
                '{data}' => $this->jscode($this->_config['data'])
            ]);

        $ajax = '';
        if ($this->_config['ajax']) {
            $ajax .= strtr($this->_layout['ajax'], [
                '{url}' => $this->_config['url'],
                '{data}' => $data,
                '{type}' => $this->jscode($this->_config['type']),
                '{crossDomain}' => $this->jscode($this->_config['crossDomain']),
                '{password}' => $this->jscode($this->_config['password']),
                '{username}' => $this->jscode($this->_config['username']),
                '{context}' => $this->jscode($this->_config['context']),
                '{contentType}' => $this->jscode($this->_config['contentType']),
                '{async}' => $this->jscode($this->_config['async']),
                '{dataType}' => $this->jscode($this->_config['dataType']),
                '{cache}' => $this->jscode($this->_config['cache']),
                '{jsonp}' => $this->jscode($this->_config['jsonp']),
                '{jsonpCallback}' => $this->jscode($this->_config['jsonpCallback']),
                '{timeout}' => $this->jscode($this->_config['timeout']),
                '{traditional}' => $this->jscode($this->_config['traditional']),
                '{beforeSend}' => $this->eventCode('beforeSend'),
                '{always}' => $this->eventCode('always'),
                '{fail}' => $this->eventCode('fail'),
                '{done}' => $this->eventCode('done'),
                '{complete}' => $this->eventCode('complete'),
                '{error}' => $this->eventCode('error'),
                '{success}' => $this->eventCode('success'),
            ]);
            $this->js = strtr($this->_layout['event'], [
                '{id}' => $this->id,
                '{click}' => $this->jscode($ajax),
                '{keyup}' => $this->eventCode('keyup'),
                '{dblclick}' => $this->eventCode('dblclick'),
                '{mouseenter}' => $this->eventCode('mouseenter'),
                '{mouseleave}' => $this->eventCode('mouseleave'),
                '{confirmCode}' => $confirmCode,
                '{clickCode}' => $clickCode
            ]);
            $this->_config['btnType'] = 'button';
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

        $this->htm = strtr($this->_layout['icon'], [
            '{btnSize}' => $this->_config['btnSize'],
        ]);
        $this->htm .= strtr($this->_layout['ic-icon'], [
            '{btnSize}' => $this->_config['btnSize'],
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

     /*   $this->css .= strtr($this->_layout['color'], [
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

        ]);*/





        $badgeCode = '';
        if ($this->_config['hasBadge'])
            $badgeCode = strtr($this->_layout['badge'], [
                '{badge}' => $this->_config['badge'],
                '{badgeType}' => $this->_config['badgeType'],
            ]);


        $iconCode = '';
        if ($this->_config['hasIcon'])
            $iconCode = strtr($this->_layout['icon'], [
                '{btnHeight }' => $this->_config['btnHeight'],
                '{icon}' => $this->_config['icon'],
                '{iconSize}' => $this->_config['iconSize'],
                '{id}' => $this->id,
            ]);


        $dataMethod = '';
        if ($this->_config['method'] !== self::method['none'])
            $dataMethod = strtr($this->_layout['method'], [
                '{data-method}' => $this->_config['method'],
            ]);

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
            '{hidden}' => $this->_config['hidden'] ? 'hidden="hidden"' : '',


        ]);

        if ($this->_config['btnType'] === ZButtonWidget::btnType['link'])
            $_layout = $this->_layout['link'];
        else
            $_layout = $this->_layout['button'];

        if ($this->_config['cooler']) {
            $_layout = strtr($this->_layout['cooler'], [
                '{btnSize}' => $this->_config['btnSize'],
                '{ic-target}' => $this->_config['ic-target'],
                '{ic-push-url}' => $this->_config['ic-push-url']
            ]);
            if ($this->_config['hasIcon'])
                $iconCode = $this->_layout['ic-icon'];
        }

        if (is_array($this->value)) $this->value = ZVarDumper::beauty($this->value);
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
                /*'{btnSize}' => $this->_config['btnSize'],*/

            ]);
    }
}
