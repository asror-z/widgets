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
class ZSweetAlert2Widget extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => ZSweetAlert2Widget::type['fire'],
        'url' => '/eyuf/cores/main/index.aspx#menu',
        'width' => '',
        'iframeId' => '',
        'height' => 'null',
        'grapes' => true,
        'showCancelButton' => true,
        'funcName' => 'func',
        'option' => '',
        //'callBack' => ZSweetAlert2Widget::type['Deleted'],
        /*'callBackQueue' => 'Swal.fire({ title: \'All done!\',html:\'Your answers: <pre><code>\' +
            JSON.stringify(result.value) +\'</code></pre>\',confirmButtonText: \'Lovely!\' })',
        'callBackSecondBtn' => 'Swal.fire(\'Not Deleted!\', \'Your action has been cancelled.\',\'error\')',*/
        'title' => '',
        'titleText' => '',
        'position' => ZSweetAlert2Widget::type['fire'],
        'cancelButtonText' => 'Cancel',
        'text' => '',
        'icon' => '',
        'confirmButtonColor' => '',
        'cancelButtonColor' => '',
        'focusConfirm' => false,
        'confirmButtonAriaLabel' => '',
        'cancelButtonAriaLabel' => '',
        'allowOutsideClick' => true,
        'footer' => '',
        'imageWidth' => 500,
        'imageHeight' => 600,
        'showConfirmButton' => true,
        'backdrop' => '',
        'background' => '',
        'padding' => '0',
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

    
    window.{funcName} = function {funcName}(url = null) {
        Swal.fire({
            title: '{title}',
            titleText: '',
            text: '',
            html: `{content}`,
            footer: `{footer}`,
            icon: undefined,
            iconHtml: undefined,
            toast: false,
            animation: false,
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
            customClass: {
              container: 'container-class',
              popup: 'popup-class',
              header: 'header-class',
              title: 'title-class',
              closeButton: 'dyna-close-sweet',
              icon: 'icon-class',
              image: 'image-class',
              content: 'content-class',
              input: 'input-class',
              actions: 'actions-class',
              confirmButton: 'confirm-button-class',
              cancelButton: 'cancel-button-class',
              footer: 'footer-class'
            },
            target: 'body',
            backdrop: true,
            heightAuto: true,
            allowOutsideClick: {allowOutsideClick},
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
            showCloseButton: {showCloseButton},
            closeButtonHtml: '<i class="close-sweetalert fas fa-times"></i>',
            closeButtonAriaLabel: 'Close this dialog',
            showLoaderOnConfirm: false,
            url: undefined,
            imageWidth: undefined,
            imageHeight: undefined,
            imageAlt: '',
            timer: undefined,
            timerProgressBar: false,
            width: '{width}',
            padding: '{padding}',
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
            onOpen: {onOpen},
            onClose: {onClose},
            /*onBeforeOpen: undefined,
            onOpen: undefined,
            onRender: undefined,
            onClose: undefined,
            onAfterClose: undefined,
            onDestroy: undefined,*/
        })
 };
   
JS,


        'content' => <<<HTML

     <iframe src="{url}" id="{id}" height="{height}" width="{width}"></iframe>
HTML,


    ];


    public function init()
    {
        parent::init();

        if ($this->_config['begin'])
            ob_start();

    }

    public $event = [];
    public $_event = [
        'result' => ' console.log("ZSweeAlert2Widget" | $eventResult) ',
        'closing' => ' console.log("ZSweeAlert2Widget" | closing) ',
        'onBeforeOpen' => ' console.log("ZSweeAlert2Widget" | onBeforeOpen) ',
        'onOpen' => 'function (event) { 
        
  }',
        'onRender' => ' console.log(ZSweeAlert2Widget | onRender) ',
        'onClose' => ' ',
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

        $content = strtr($this->_layout['content'], [
            '{url}' => $this->_config['url'],
            '{width}' => $this->_config['width'],
            '{id}' => $this->_config['iframeId'],
            '{height}' => $this->_config['height'],
        ]);

        if ($this->_config['begin'])
            $content = ob_get_clean();

        $this->js = strtr($this->_layout['fireFunc'], [
            '{funcName}' => $this->_config['funcName'],
            '{url}' => $this->_config['url'],
            '{height}' => $this->_config['height'],
            '{content}' => $content,
            '{title}' => $this->_config['title'],
            '{width}' => $this->_config['width'],
            '{id}' => $this->_config['iframeId'],
            '{footer}' => $this->_config['footer'],
            '{padding}' => $this->_config['padding'],
            '{allowOutsideClick}' => $this->jscode($this->_config['allowOutsideClick']),
            '{showCloseButton}' => $this->jscode($this->_config['showCloseButton']),
            '{result}' => $this->eventCode('result'),
            '{onClose}' => $this->eventCode('onClose'),
            '{closing}' => $this->eventCode('closing'),
            '{onBeforeOpen}' => $this->eventCode('onBeforeOpen'),
            '{onOpen}' => $this->eventCode('onOpen'),
            '{onRender}' => $this->eventCode('onRender'),
            '{onAfterClose}' => $this->eventCode('onAfterClose'),
            '{onDestroy}' => $this->eventCode('onDestroy'),
        ]);

        $this->css = <<<CSS
        
        .close-sweetalert {
            margin-top: -10px;
            font-size: 20px;
            transition: all 0.2s;
        }
        
        #swal2-title {
            margin-top: 5px;
            font-size: 22px;
            display: flex;
            margin: 1% 30px;
            margin-right: 50px;
        }
        
        .swal2-footer {
            justify-content: flex-end !important;
            margin: 0 !important; 
            padding: 0 20px !important; 
            border: none !important;
        }

CSS;

    }
}
