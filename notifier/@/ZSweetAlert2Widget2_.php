<?php

namespace zetsoft\widgets\notifier;

use zetsoft\assets\blocks\ZSweetAlert2Asset;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 *
 *
 *
 * https://sweetalert2.github.io/#usage
 * https://github.com/Dominus77/yii2-sweetalert2-widget
 *
 *
 * Alert widget renders a message from session flash or custom messages.
 * @see https://sweetalert2.github.io/
 * @package dominus77\sweetalert2
 */
class ZSweetAlert2Widget2_ extends ZWidget
{

    public $config = [];
    public $_config = [
        'funcName' => 'exampleFunc',
        'type' => ZSweetAlert2Widget::type['fire'],
        'width' => 500,
        'url' => 'http://eyuf.zettest.uz/cores/main/index.aspx#menu',
        'padding' => '0',
        'iframeWidth' => '500px',
        'iframeHeight' => '500px',
    ];

    public $layout = [];
    public $_layout = [
        'fireFunc' => <<<JS
    function {funcName}(title = null, text = null,  icon = null) {
    
    Swal.fire({
        title: '<iframe src="{url}" height="{iframeHeight}" width="{iframeWidth}"></iframe>',
        titleText: '',
        text: '',
        html: '',
        footer: '',
        icon: undefined,
        iconHtml: undefined,
        toast: false,
        animation: true,
        showClass: {
          popup: 'swal2-show',
          backdrop: 'swal2-backdrop-show',
          icon: 'swal2-icon-show'
        },
        hideClass: {
          popup: 'swal2-hide',
          backdrop: 'swal2-backdrop-hide',
          icon: 'swal2-icon-hide'
        },
        customClass: undefined,
        target: 'body',
        backdrop: true,
        heightAuto: true,
        allowOutsideClick: true,
        allowEscapeKey: true,
        allowEnterKey: true,
        stopKeydownPropagation: true,
        keydownListenerCapture: false,
        showConfirmButton: false,
        showCancelButton: false,
        preConfirm: undefined,
        confirmButtonText: 'OK',
        confirmButtonAriaLabel: '',
        confirmButtonColor: undefined,
        cancelButtonText: 'Cancel',
        cancelButtonAriaLabel: '',
        cancelButtonColor: undefined,
        buttonsStyling: true,
        reverseButtons: false,
        focusConfirm: true,
        focusCancel: false,
        showCloseButton: false,
        closeButtonHtml: '&times;',
        closeButtonAriaLabel: 'Close this dialog',
        showLoaderOnConfirm: false,
        url: undefined,
        imageWidth: undefined,
        imageHeight: undefined,
        imageAlt: '',
        timer: undefined,
        timerProgressBar: false,
        width: {width},
        padding: {padding},
        background: undefined,
        input: undefined,
        inputPlaceholder: '',
        inputValue: '',
        inputOptions: {},
        inputAutoTrim: true,
        inputAttributes: {},
        inputValidator: undefined,
        validationMessage: undefined,
        grow: false,
        position: 'center',
        progressSteps: [],
        currentProgressStep: undefined,
        progressStepsDistance: undefined,
        scrollbarPadding: true,
        onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
        /*onBeforeOpen: undefined,
        onOpen: undefined,
        onRender: undefined,
        onClose: undefined,
        onAfterClose: undefined,
        onDestroy: undefined,*/
 
    
    })
    
 }  
JS,
    ];

    public $event = [];
    public $_event = [
        'result' => ' console.log("ZSweeAlert2Widget" | $eventResult) ',
        'closing' => ' console.log("ZSweeAlert2Widget" | closing) ',
        'onBeforeOpen' => ' console.log("ZSweeAlert2Widget" | onBeforeOpen) ',
        'onOpen' => ' console.log(ZSweeAlert2Widget | onOpen) ',
        'onRender' => ' console.log(ZSweeAlert2Widget | onRender) ',
        'onClose' => ' console.log(ZSweeAlert2Widget | onClose) ',
        'onAfterClose' => ' console.log(ZSweeAlert2Widget | onAfterClose) ',
        'onDestroy' => ' console.log(ZSweeAlert2Widget | onDestroy) ',

    ];

    private $stepTitle;
    private $_aStep;

    public const type = [
        'fire' => 'fire',
        'mixin' => 'mixin',
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.all.min.js');
    }

    public function codes()
    {

        $this->js = strtr($this->_layout['fireFunc'], [
            '{funcName}' => $this->_config['funcName'],
            '{url}' => $this->_config['url'],
            '{iframeWidth}' => $this->_config['iframeWidth'],
            '{iframeHeight}' => $this->_config['iframeHeight'],
            '{width}' => $this->_config['width'],
            '{padding}' => $this->_config['padding'],

            '{result}' =>  $this->eventCode('result'),
            '{closing}' =>  $this->eventCode('closing'),
            '{onBeforeOpen}' =>  $this->eventCode('onBeforeOpen'),
            '{onOpen}' =>  $this->eventCode('onOpen'),
            '{onRender}' =>  $this->eventCode('onRender'),
            '{onClose}' =>  $this->eventCode('onClose'),
            '{onAfterClose}' =>  $this->eventCode('onAfterClose'),
            '{onDestroy}' =>  $this->eventCode('onDestroy'),



        ]);

    }
}
