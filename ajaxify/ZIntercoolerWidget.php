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

namespace zetsoft\widgets\ajaxify;

use zetsoft\system\kernels\ZWidget;


class ZIntercoolerWidget extends ZWidget
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
        'log' => 'console.log("ZIntercoolerWidget | log")',
        'beforeAjaxSend' => 'console.log("ZIntercoolerWidget | beforeAjaxSend")',
        'beforeHeaders' => 'console.log("ZIntercoolerWidget | beforeHeaders")',
        'afterHeaders' => 'console.log("ZIntercoolerWidget | afterHeaders")',
        'beforeSend' => 'console.log("ZIntercoolerWidget | beforeSend")',
        'success' => 'console.log("ZIntercoolerWidget | success")',
        'afterSuccess' => 'console.log("ZIntercoolerWidget | afterSuccess")',
        'error' => 'console.log("ZIntercoolerWidget | error")',
        'complete' => 'console.log("ZIntercoolerWidget | complete")',
        'onPoll' => 'console.log("ZIntercoolerWidget | onPoll")',
        'handleOnpopstate' => 'console.log("ZIntercoolerWidget | handleOnpopstate")',
        'elementAdded' => 'console.log("ZIntercoolerWidget | elementAdded")',
        'pushUrl' => 'console.log("ZIntercoolerWidget | pushUrl")',
        'beforeHistorySnapshot' => 'console.log("ZIntercoolerWidget | beforeHistorySnapshot")',
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
        <code 
            id="{id}" 
            ic-{method}="{url}"
            ic-target="#content"
            ic-push-url="true"
            class="{class}"
        >
            {text}
        </code>
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

