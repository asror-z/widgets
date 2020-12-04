<?php

namespace zetsoft\widgets\notifier;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://sweetalert2.github.io/#usage
 * https://github.com/Dominus77/yii2-sweetalert2-widget
 *
 *
 * Alert widget renders a message from session flash or custom messages.
 * @see https://sweetalert2.github.io/
 * @package dominus77\sweetalert2
 */

class ZSweetAlert2Widget4 extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => ZSweetAlert2Widget4::type['fire'],
        'url' => '',
        'width' => null,
        'height' => null,
        'grapes' => true,
        'showCancelButton' => true,
        'funcName' => 'func',
        'option' => '',
        'callBack' => ZSweetAlert2Widget4::type['warning'],
        'title' => '',
        'titleText' => '',
        'position' => ZSweetAlert2Widget4::type['fire'],
        'cancelButtonText' => 'Cancel',
        'text' => '',
        'url' => '',
        'icon' => '',
        'confirmButtonColor' => '',
        'cancelButtonColor' => '',
        'focusConfirm' => false,
        'confirmButtonAriaLabel' => '',
        'cancelButtonAriaLabel' => '',
        'footer' => '',
        'imageWidth' => 500,
        'imageHeight' => 600,
        'showConfirmButton' => true,
        'backdrop' => '',
        'background' => '',
        'padding' => '',
        'showLoaderOnConfirm' => false,
        'autocapitalize' => '',
        'showCloseButton' => false,
        'iconHtml' => '',
        'timerProgressBar' => 5000,
        'question' => '',
        'questionText' => '',
        'confirmButtonAfterQueueText' => '',
        'AfterQueueText' => 'Good!',
        'AfterQueueTitle' => '',
        'reverseButtons' => true,

        /*VARIABLES FOR QUEUE TYPE*/
        'inputType' => '',
        'confirmButtonText' => 'Text',
        'progressSteps' => [],

    ];

    public $layout = [];
    public $_layout = [
        'fireFunc' => <<<JS
    function {funcName}(title = null, text = null,  icon = null,){
    Swal.fire({
        title: '<iframe src="{url}" height="{height}" width="{width}"></iframe>',
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

        'warning' => <<<JS
      
JS,

        'error' => <<<JS
          swal({
  title: "Good job!",
  text: "You clicked the button!",
  icon: "error",
  button: "Aww yiss!",
}); 
JS,

        'success' => <<<JS
          swal({
  title: "Good job!",
  text: "You clicked the button!",
  icon: "success",
  button: "Aww yiss!",
});
JS,

        'info'  => <<<HTML
       <script>function warning(){
       Swal.fire({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
}</script>
         <button class="show-example-btn" aria-label="Try me! Example: A basic message" onclick="warning()">
        Try me! height_long
    </button> 
HTML,

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
        'warning' => 'warning',
        'error' => 'error',
        'success' => 'success',
        'info' => 'info',
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
            '{height}' => $this->_config['height'],
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

        $this->htm = strtr($this->_layout['info'],[

        ]);
        $this->js .= strtr($this->_layout['warning'],[

        ]);

    }
}
