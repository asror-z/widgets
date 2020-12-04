<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\ajaxify;


use zetsoft\system\kernels\ZWidget;

class ZAjaxWidget extends ZWidget
{
    public $config = [];
    public $_config = [

        'func' => 'ajaxTest',
        'url' => '',
        'data' => null,
        'attr' => '',
        'type' => ZAjaxWidget::type['get'], //"POST", "GET", "PUT"
        'crossDomain' => true,
        'password' => '',
        'username' => '',
        'context' => 'document.body', // this
        'contentType' => '', // example : application/json
        'async' => 0, // Use false when dataType : 'jsonp'
        'dataType' => 'json', //xml, json, script, or html
        'cache' => true, //true, false for dataType 'script' and 'jsonp'
        'jsonp' => false,
        'jsonpCallback' => '',
        'timeout' => 2000,
        'traditional' => true,
        //'method' => 'POST'

    ];
    public $event = [];
    public $_event = [
        'beforeSend' => "
              console.log('ZAjaxWidget | beforesend');
          ",
        'success' => "
              console.log('ZAjaxWidget | succes')
          ",
        'error' => " 
            // if error occured
              console.log('ZAjaxWidget | error');
          ",
        'complete' => "
              console.log('ZAjaxWidget | complete');
          ",
        'done' => "
            // do smth when you get yourVariable
            // return smthVariable
            console.log('ZAjaxWidget | done')
        ",
        'fail' => "
           // do smth when you get yourVariable
             console.log('ZAjaxWidget | fail')
        ",
        'always' => "
            // do smth when you get yourVariable
            console.log('ZAjaxWidget | always')
        "
    ];

    public const type = [
        'post' => 'POST',
        'get' => 'GET',
        'put' => 'PUT'
    ];

    public $layout = [];
    public $_layout = [
        'js' => <<<JS
           function {funcName}(zurl = null) {
    
    if (zurl === null)
      zurl = '{url}';
    
   $.ajax({
          url: zurl,
          method: '{method}',
          {data}
          type: '{type}',
          crossDomain : {crossDomain},
          password : '{password}',
          username : '{username}',
          context : '{context}',
          async: {async}, // Use false when dataType : 'jsonp'
          dataType: '{dataType}', //mycustomtype
          cache:{cache}, //  false for dataType 'script' and 'jsonp'
          jsonp:"{jsonp}", // String or Boolean
          jsonpCallback: '{jsonpCallback}',
          timeout : '{timeout}',
          traditional: {traditional},
          success : {success},
          complete: {complete},
          error : {error},
          beforeSend: {beforeSend},
          
          
        }).done({done}).fail({fail}).always({always});  
}           
JS,
        'data' => <<<HTML
        data : {data},
HTML,

    ];

    /**
     *
     * Function  codes
     *
     *
     *

    url: zurl,
    method: '{method}',
    {data}
    type: '{type}',
    crossDomain : {crossDomain},
    password : '{password}',
    username : '{username}',
    context : '{context}',
    async: {async}, // Use false when dataType : 'jsonp'
    dataType: '{dataType}', //mycustomtype
    cache:{cache}, //  false for dataType 'script' and 'jsonp'
    jsonp:"{jsonp}", // String or Boolean
    jsonpCallback: '{jsonpCallback}',
    timeout : '{timeout}',
    traditional: {traditional},
    success : {success},
    complete: {complete},
    error : {error},
    beforeSend: {beforeSend},
    statusCode: {
    404: function() {
    console.error('page not found');
    }
    }
    ,
     */

    public function codes()
    {
        $data = '';


        if (isset($this->_config['data']))
            $data = strtr($this->_layout['data'], [
                '{data}' => $this->jscode($this->_config['data'])
            ]);

        //vdd($data);
        $this->js = strtr($this->_layout['js'], [
            '{funcName}' => $this->jscode($this->_config['func']),
            '{url}' => $this->jscode($this->_config['url']),
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
            '{attr}' => $this->jscode($this->_config['attr']),
            '{method}' => $this->_config['type']
        ]);
    }
}
