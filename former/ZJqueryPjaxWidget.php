<?php

namespace zetsoft\widgets\former;

use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZJqueryPjaxWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'func' => 'jqueryPjax',
        'timeout' => 650,
        'url' => '',
        'replace' => true,
        'maxCacheLength' => 20,
        'version' => '',
        'scrollTo' => 0,
        'type' => ZJqueryPjaxWidget::type['get'],
        'dataType' => ZJqueryPjaxWidget::dataType['html'],
        'push' => true,
        'target' => '',
        'selector' => '',
        'container' => '',
    ];

    public const type = [
        'get' => 'GET',
        'post' => 'POST',
        'put' => 'PUT',
    ];
    public const dataType = [
        'html' => 'html',
        'script' => 'script',
        'json' => 'json',
        'xml' => 'xml',
    ];


    public $event = [];
    public $_event = [
        'popstate' => ' console.log("ZJqueryPjaxWidget | $eventClick") ',
        'end' => ' console.log("ZJqueryPjaxWidget | $eventEnd") ',
        'complete' => ' console.log("ZJqueryPjaxWidget | $eventComplete") ',
        'error' => ' console.log("ZJqueryPjaxWidget | $eventError") ',
        'success' => ' console.log("ZJqueryPjaxWidget | $eventSuccess") ',
        'ontimeout' => ' console.log("ZJqueryPjaxWidget | $eventOnTimeOut") ',
        'clicked' => ' console.log("ZJqueryPjaxWidget | $eventClicked") ',
        'click' => ' console.log("ZJqueryPjaxWidget | $eventClick") ',
        'send' => ' console.log("ZJqueryPjaxWidget | $eventSend") ',
        'start' => ' console.log("ZJqueryPjaxWidget | $eventStart") ',
        'beforeReplace' => ' console.log("ZJqueryPjaxWidget | $eventBeforeReplace") ',
        'beforeSend' => ' console.log("ZJqueryPjaxWidget | $eventBeforeSend") ',
    ];
    public $layout = [];
    public $_layout = [

        'js' => <<<JS
        function {funcName}(zurl = null) {

        if (zurl === null)
            zurl =  '{url}';

        $(document).pjax('{selector}' , '{container}', {
            fragment : '{container}',
            timeout: {timeout}, 
            url: zurl, 
            replace: {replace}, 
            maxCacheLength: {maxCacheLength}, 
            version: '{version}', 
            scrollTo: {scrollTo}, 
            type: '{type}', 
            container: '{container}', 
            dataType: '{dataType}', 
            target: '{target}', 
            push: {push}, 
        });
    }
        
        $(document).on('pjax:send', {send});
        $(document).on('pjax:beforeSend', {beforeSend});
        $(document).on('pjax:start', {start});
        $(document).on('pjax:click', {click});
        $(document).on('pjax:clicked', {clicked});
        $(document).on('pjax:beforeReplace', {beforeReplace});
        $(document).on('pjax:success', {success});
        $(document).on('pjax:timeout', {ontimeout});
        $(document).on('pjax:error', {error});
        $(document).on('pjax:complete', {complete});
        $(document).on('pjax:end', {end});
        $(document).on('pjax:popstate', {popstate});
JS,

    ];
    public function asset()
    {

//        $this->fileJs('/publish/yarner/jquery-pjax/jquery.pjax.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js');
    }


    public function codes()
    {




        $this->js = strtr($this->_layout['js'], [

            '{funcName}' => $this->jscode($this->_config['func']),
            '{timeout}' => $this->jscode($this->_config['timeout']),
            '{url}' => $this->jscode($this->_config['url']),
            '{replace}' => $this->jscode($this->_config['replace']),
            '{maxCacheLength}' => $this->jscode($this->_config['maxCacheLength']),
            '{version}' => $this->jscode($this->_config['version']),
            '{scrollTo}' => $this->jscode($this->_config['scrollTo']),
            '{type}' => $this->jscode($this->_config['type']),
            '{dataType}' => $this->jscode($this->_config['dataType']),
            '{push}' => $this->jscode($this->_config['push']),
            '{target}' => $this->jscode($this->_config['target']),
            '{container}' => $this->jscode($this->_config['container']),
            '{selector}' => $this->jscode($this->_config['selector']),
            /**
             *
             * Events
             */
            '{popstate}' => $this->eventCode('popstate'),
            '{end}' => $this->eventCode('end'),
            '{complete}' => $this->eventCode('complete'),
            '{error}' => $this->eventCode('error'),
            '{success}' => $this->eventCode('success'),
            '{ontimeout}' => $this->eventCode('ontimeout'),
            '{clicked}' => $this->eventCode('clicked'),
            '{click}' => $this->eventCode('click'),
            '{send}' => $this->eventCode('send'),
            '{start}' => $this->eventCode('start'),
            '{beforeReplace}' => $this->eventCode('beforeReplace'),
            '{beforeSend}' => $this->eventCode('beforeSend'),

        ]);

    }
}
