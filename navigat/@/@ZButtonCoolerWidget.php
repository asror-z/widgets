<?php
/*
 * Author: AzimjonToirov
 * official-site:
 * https://intercoolerjs.org/docs.html
 * github:
 * https://github.com/intercoolerjs/intercooler-js
 * clean:
 * render/ajaxify/SPA/ZIntercoolerJsWidget/clean1.html
 * */

namespace zetsoft\widgets\navigat;

use zetsoft\system\kernels\ZWidget;


class ZButtonCoolerWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'url' => '/cores/faqs/index.aspx',
        'method' => self::type['get-from'],
        'text' => '',
        'hasText' => false
    ];

    /**
     * Plugin Events
     */
    public $event = [];
    public $_event = [
        'log' => 'function(evt, msg, level, elt) { console.log("ZIntercoolerWidget | log") }',
        'beforeAjaxSend' => 'function(evt, ajaxSetting, elt) { console.log("ZIntercoolerWidget | beforeAjaxSend") }',
        'beforeHeaders' => 'function(evt, elt, xhr) { console.log("ZIntercoolerWidget | beforeHeaders") }',
        'afterHeaders' => 'function(evt, elt, xhr) { console.log("ZIntercoolerWidget | afterHeaders") }',
        'beforeSend' => 'function(evt, elt, data, settings, xhr, requestId) { console.log("ZIntercoolerWidget | beforeSend") }',
        'success' => 'function(evt, elt, data, textStatus, xhr, requestId) { console.log("ZIntercoolerWidget | success") }',
        'afterSuccess' => 'function(evt, elt, data, textStatus, xhr, requestId) { console.log("ZIntercoolerWidget | afterSuccess") }',
        'error' => 'function(evt, elt, status, str, xhr) { console.log("ZIntercoolerWidget | error") }',
        'complete' => 'function(evt, elt, data, status, xhr, requestId) { console.log("ZIntercoolerWidget | complete") }',
        'onPoll' => 'function(evt, elt) { console.log("ZIntercoolerWidget | onPoll") }',
        'handleOnpopstate' => 'function(evt) { console.log("ZIntercoolerWidget | handleOnpopstate") }',
        'elementAdded' => 'function(evt) { console.log("ZIntercoolerWidget | elementAdded") }',
        'pushUrl' => 'function(evt, target, data) { console.log("ZIntercoolerWidget | pushUrl") }',
        'beforeHistorySnapshot' => 'function(evt, target) { console.log("ZIntercoolerWidget | beforeHistorySnapshot") }',
    ];

    public const type = [
        'get-from' => 'get-from',
        'post-to' => 'post-to',
        'put-to' => 'put-to',
        'patch-to' => 'patch-to',
        'delete-from' => 'delete-from',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <rightBtn 
            id="{id}" 
            ic-{method}="{url}"
            ic-target="#coolerww"
            ic-push-url="true"
            class="{class}"
        >
            {text}
        </rightBtn>
HTML,
        'js' => <<<JS
        $('#{id}')
        .on('log.ic', {log})
        .on('beforeAjaxSend.ic', {beforeAjaxSend})
        .on('beforeHeaders.ic', {beforeHeaders})
        .on('afterHeaders.ic', {afterHeaders})
        .on('beforeSend.ic', {beforeSend})
        .on('success.ic', {success})
        .on('after.success.ic', {afterSuccess})
        .on('error.ic', {error})
        .on('complete.ic', {complete})
        .on('onPoll.ic', {onPoll})
        .on('handle.onpopstate.ic', {handleOnpopstate})
        .on('elementAdded.ic', {elementAdded})
        .on('pushUrl.ic', {pushUrl})
        .on('beforeHistorySnapshot.ic', {beforeHistorySnapshot})
JS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/intercooler@1.2.3/dist/intercooler.js');
    }

    public function codes()
    {
        $text = '';
        if ($this->_config['hasText'])
            $text = strtr($this->_layout['main'], [
                '{text}' => $this->_config['text'],
            ]);

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{url}' => $this->_config['url'],
            '{method}' => $this->_config['method'],
            '{text}' => $text,
            '{class}' => $this->_config['class'],
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{log}' => $this->eventCode('log'),
            '{beforeAjaxSend}' => $this->eventCode('beforeAjaxSend'),
            '{beforeHeaders}' => $this->eventCode('beforeHeaders'),
            '{afterHeaders}' => $this->eventCode('afterHeaders'),
            '{beforeSend}' => $this->eventCode('beforeSend'),
            '{success}' => $this->eventCode('success'),
            '{afterSuccess}' => $this->eventCode('afterSuccess'),
            '{error}' => $this->eventCode('error'),
            '{complete}' => $this->eventCode('complete'),
            '{onPoll}' => $this->eventCode('onPoll'),
            '{handleOnpopstate}' => $this->eventCode('handleOnpopstate'),
            '{elementAdded}' => $this->eventCode('elementAdded'),
            '{pushUrl}' => $this->eventCode('pushUrl'),
            '{beforeHistorySnapshot}' => $this->eventCode('beforeHistorySnapshot'),
        ]);
    }
}

