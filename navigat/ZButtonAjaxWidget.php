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
use zetsoft\widgets\ajaxify\ZAjaxWidget;
use function Amp\Parallel\Worker\factory;

class ZButtonAjaxWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        /*
       * ajax settings
       * */
        'url' => '#',
        'type' => ZAjaxWidget::type['get'], //"POST", "GET", "PUT"
        'data' => '{id:' . 2 . '}',
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
         * ALL
         */
        'class' => 'border-none',
        'text' => '',
        'title' => '',
        'hidden' => false,
        'color' => ZColor::color['none'],

        /*
         * btn settings
         * */
        'btn' => true,
        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
        'btnRounded' => true,
        'btnFloating' => false,

        /**
         *
         * Badge
         */
        'badge' => '100',
        'badgeType' => ZButtonWidget::badgeType['badge-default'],

        /**
         *
         * Tooltip
         */
        'toggle' => ZButtonWidget::toggle['tooltip'],
        'hintRounded' => true,
        'ttSize' => ZButtonWidget::ttSize['medium'],
        'ttSide' => ZButtonWidget::ttSide['top'],
        'ttColor' => ZButtonWidget::ttColor['info'],
        'ttAnimate' => ZButtonWidget::ttAnimate['bounce'],

        /**
         *
         * Icon
         */
        'icon' => 'fa-5',
        'iconsSm' => false,
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
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

    public $layout = [];
    public $_layout = [
        'attr' => <<<HTML
id="{id}" data-toggle="{data-toggle}" class="{btnSize} {btn} {btn-rounded} ovr-button {btn-floating}  {icons-sm} {btnStyle} {color} hint--{ttSide} hint--{ttColor} hint--{ttSize} hint--{ttAnimate} {hint--rounded} {class}" aria-label="{title}" aria-hidden="{aria-hidden}" {hidden} {disabled}
HTML,

        'button' => <<<HTML
    <button type="button" {attrCode}>{iconCode} {text}</button> {badgeCode}
HTML,

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

        'icon' => <<<HTML
            <i class="{icon} {iconSize} iconColor-{id}"></i>
HTML,

        'badge' => <<<HTML
            <span class="badge {badgeType} counter">{badge}</span>
HTML,

        'event' => <<<JS
            $(document).on('click', '#{id}', {click})
JS,

    ];

    public function codes()
    {
        $data = '';
        if (isset($this->_config['data']))
            $data = strtr($this->_layout['data'], [
                '{data}' => $this->jscode($this->_config['data'])
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
                '{btnHeight }' => $this->_config['btnHeight'],
                '{icon}' => $this->_config['icon'],
                '{iconSize}' => $this->_config['iconSize'],
                '{id}' => $this->id,
            ]);

        $attrCode = strtr($this->_layout['attr'], [

            '{id}' => $this->id,
            '{text}' => $this->_config['text'],
            '{title}' => $this->_config['title'],
            '{class}' => $this->_config['class'],
            '{data-toggle}' => $this->_config['toggle'],
            '{btnStyle}' => $this->_config['btnStyle'],
            '{btnSize}' => $this->_config['btnSize'],

            '{color}' => $this->_config['color'],
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
            '{disabled}' => $this->_config['readonly'] ? 'disabled' : '',
        ]);

        $ajax = strtr($this->_layout['ajax'], [
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
        ]);

        $this->htm = strtr($this->_layout['button'], [
            '{btnSize}' => $this->_config['btnSize'],
            '{text}' => $this->_config['text'],
            '{attrCode}' => $attrCode,
            '{badgeCode}' => $badgeCode,
            '{iconCode}' => $iconCode
        ]);
    }
}
