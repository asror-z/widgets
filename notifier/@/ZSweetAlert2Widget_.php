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

class ZSweetAlert2Widget_ extends ZWidget
{

    public $config = [];
    public $_config = [
        'showCancelButton' => true,
        'funcName' => 'func',
        'type' => ZSweetAlert2Widget::type['fire'],
        'option' => '',
        'callBack' => '\'Deleted!\',\'Your file has been deleted.\',\'success\'',
        'callBackQueue' => 'Swal.fire({ title: \'All done!\',html:\'Your answers: <pre><code>\' +
            JSON.stringify(result.value) +\'</code></pre>\',confirmButtonText: \'Lovely!\' })',
        'callBackSecondBtn' => 'Swal.fire(\'Not Deleted!\', \'Your action has been cancelled.\',\'error\')',
        'title' => '',
        'titleText' => '',
        'position' => ZSweetAlert2Widget::type['question'],
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
        'width' => 500,
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

    public $layout  = [];
    public $_layout = [
        'sampleFireFunc' => <<<JS
    function {funcName}(title = null, text = null,  icon = null) {
                       
    if (title === null)
      title = '{title}';
      
    Swal.fire({
        title: title,
        text: '{text}',
        icon: '{icon}',
        confirmButtonColor: '{confirmButtonColor}',
        cancelButtonColor: '{cancelButtonColor}',
        focusConfirm: {focusConfirm},
        confirmButtonAriaLabel: '{confirmButtonAriaLabel}',
        cancelButtonAriaLabel: '{cancelButtonAriaLabel}',
        footer: '{footer}',
        position: '{position}',
        showCancelButton: {showCancelButton},
        showConfirmButton: {showConfirmButton},
        url: '{url}',
        imageWidth: {imageWidth},
        imageHeight: {imageHeight},
        imageAlt: '{imageAlt}',
        width: {width},
        padding: '{padding}',
        background: '{background}',
        backdrop: '{backdrop}',
        html: `{html}`,
        timerProgressBar: {timerProgressBar},
        iconHtml: '{iconHtml}',
        reverseButtons: {reverseButtons},
        cancelButtonText: '{cancelButtonText}',
        showCloseButton: {showCloseButton},
        inputAttributes: {
            autocapitalize: '{autocapitalize}'
        },
        showLoaderOnConfirm: {showLoaderOnConfirm},
    }).then((result) => {
      if (result.value) {
           {result}
      }
      else if (result.dismiss === Swal.DismissReason.cancel){
        {notresult}
      }
      
    });
  }  
     
JS,

        'sampleQueueFunc' => <<<JS
    
    function  {funcName}() {
    Swal.mixin({
        input: '{inputType}',
        confirmButtonText: '{confirmButtonText}',
        cancelButtonText: '{cancelButtonText}',
        showCancelButton: {showCancelButton},
        //progressSteps: {progressSteps},
        title: '{title}',
        text: '{text}',
        icon: '{icon}',
        confirmButtonColor: '{confirmButtonColor}',
        cancelButtonColor: '{cancelButtonColor}',
        focusConfirm: {focusConfirm},
        confirmButtonAriaLabel: '{confirmButtonAriaLabel}',
        cancelButtonAriaLabel: '{cancelButtonAriaLabel}',
        footer: '{footer}',
        position: '{position}',
        showConfirmButton: {showConfirmButton},
        url: '{url}',
        imageWidth: {imageWidth},
        imageHeight: {imageHeight},
        imageAlt: '{imageAlt}',
        width: {width},
        padding: '{padding}',
        background: '{background}',
        backdrop: '{backdrop}',
        html: `{html}`,
        timerProgressBar: {timerProgressBar},
        iconHtml: '{iconHtml}',
        showCloseButton: {showCloseButton},
        inputAttributes: {
            autocapitalize: '{autocapitalize}'
        },
        showLoaderOnConfirm: {showLoaderOnConfirm},
    }).queue( {step}, [
      {
        /*title: '{question}',*/
        text: '{questionText}'
      },
      
    ]).then((result) => {
      if (result.value) {
        Swal.fire({callBack}, {
          title: '{AfterQueueTitle}',
          html: '{AfterQueueText}',
          confirmButtonText: '{confirmButtonAfterQueueText}'
        })
      }
      else{
        {callBackSecondBtn}
      }
    })
  }   
JS,
    ];




    public $event = [];
    public $_event = [
        'result' => 'console.log("result")',
        'notresult' => 'console.log("notresult")',
    ];

    private $_aStepTitle;
    private $_aStep;

    public const type = [
        'info' => 'info',
        'error' => 'error',
        'success' => 'success',
        'warning' => 'warning',
        'question' => 'question',
        'text' => 'text',
        'email' => 'email',
        'password' => 'password',
        'number' => 'number',
        'range' => 'range',
        'textarea' => 'textarea',
        'select' => 'select',
        'radio' => 'radio',
        'checkbox' => 'checkbox',
        'file' => 'file',
        'fire' => 'fire',
        'mixin' => 'mixin',
        'script' => 'script',
    ];


    public function asset()
    {
        /*      $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.3/dist/sweetalert2.min.js');
              $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.3/dist/sweetalert2.all.min.js');
              $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.3/dist/sweetalert2.min.css');*/

        $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.all.min.js');
    }

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        ob_start();
    }


    public function codes()
    {

        $this->options = [
            'title' => $this->_config['title'],
            'titleText' => $this->_config['titleText'],
            'text' => null,
            'type' => true,
            'footer' => null,
            'backdrop' => true,//Can be either a boolean or a string which will be assigned to the CSS background property
            'toast' => false,
            'target' => 'body',
            'input' => '', //Input field type, can be text, email, password, number, tel, range, textarea, select, radio, checkbox, file and url.
            'width' => 600,
            'padding' => '3em',  //
            'background' => null,   //  '#fff url(/images/trees.png)'
            'position' => 'center',//'top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', or 'bottom-end'.
            'grow' => 'false',//'row', 'column', 'fullscreen', or false
            'customClass' => '',//'customClass' => [
            //     'container' => 'container-class',
            //     'popup' => 'popup-class',
            //     'header' => 'header-class',
            //     'title' => 'title-class',
            //     'closeButton' => 'close-button-class',
            //     'image' => 'image-class',
            //     'content' => 'content-class',
            //     'input' => 'input-class',
            //     'actions' => 'actions-class',
            //     'confirmButton' => 'confirm-button-class',
            //     'cancelButton' => 'cancel-button-class',
            //     'footer' => 'footer-class'
            // ]
            'timer' => null,
            'animation' => true,
            'heightAuto' => true,
            'allowOutsideClick' => true,//If set to false, the user can't dismiss the modal by clicking outside it.
            'allowEscapeKey' => true,//If set to false, the user can't dismiss the modal by pressing the Esc key.
            'allowEnterKey' => true,//If set to false, the user can't confirm the modal by pressing the Enter or Space keys, unless they manually focus the confirm button.
            'stopKeydownPropagation' => true,//If set to false, SweetAlert2 will allow keydown events propagation to the document.
            'keydownListenerCapture' => false,
            'showConfirmButton' => false,
            'showCancelButton' => $this->_config['showCancelButton'],
            'confirmButtonText' => $this->_config['confirmButtonText'],
            'cancelButtonText' => $this->_config['cancelButtonText'],
            'confirmButtonColor' => null,
            'cancelButtonColor' => null,
            'confirmButtonAriaLabel' => '',//Use this to change the aria-label for the "Confirm"-button.
            'cancelButtonAriaLabel' => '',//Use this to change the aria-label for the "Cancel"-button.
            'buttonsStyling' => true,//Apply default styling to buttons. If you want to use your own classes set this parameter to false.
            'reverseButtons' => false,//Set to true if you want to invert default buttons positions
            'focusConfirm' => true,
            'focusCancel' => false,
            'showCloseButton' => false,
            'closeButtonAriaLabel' => Az::l("Закрыть этот диалог"),//Use this to change the aria-label for the close button.
            'showLoaderOnConfirm' => false,
            'scrollbarPadding' => true,
            'preConfirm' => null,
            'url' => null,
            'imageWidth' => null,
            'imageHeight' => null,
            'imageAlt' => '',
            'inputPlaceholder' => '',
            'inputValue' => '',//If the input type is text, email, number, tel or textarea a Promise can be accepted as inputValue
            'inputOptions' => [],//If input parameter is set to "select" or "radio", you can provide options.
            'inputAutoTrim' => true,
            'inputAttributes' => [],
            'inputValidator' => null,//see https://sweetalert2.github.io/#input-select.
            'validationMesage' => null,
            'progressSteps' => 'h',//https://sweetalert2.github.io/#chaining-modals
            'currentProgressStep' => null,
            'progressStepsDistance' => '40px',
            'onBeforeOpen' => null,
            'onOpen' => null,
            'onClose' => null,
            'onAfterClose' => null,
        ];

        $this->_layout;

        if (!empty($this->data))
            foreach ($this->data as $data) {
                $this->_aStep[] = [
                    'title' => $data['title'],
                    'text' => $data['text'],
                    'input' => $data['input'],
                    'inputOptions' => isset($data['inputOptions']) ? $data['inputOptions'] : null,
                ];

                $this->_aStepTitle[] = $data['step'];
            }

        $this->options['progressSteps'] = ($this->_config['type'] === self::type['mixin']) ? $this->_aStepTitle : [];
        $this->options['confirmButtonText'] = ($this->_config['type'] === self::type['mixin']) ? "Next &rarr;" : $this->_config['confirmButtonText'];

        switch ($this->_config['type']) {
            case self::type['fire']:

                $this->js = strtr($this->_layout['sampleFireFunc'], [
                    '{funcName}' => $this->_config['funcName'],
                    '{callBack}' => $this->jscode($this->_config['callBack']),
                    '{callBackSecondBtn}' => $this->jscode($this->_config['callBackSecondBtn']),
                ]);

                break;

            case self::type['mixin']:
                $this->js = strtr($this->_layout['sampleQueueFunc'], [
                    '{funcName}' => $this->_config['funcName'],
                    '{step}' => Json::encode($this->_aStep, JSON_PRETTY_PRINT),
                    '{callBack}' => new JsExpression($this->_config['callBackQueue']),
                ]);

                break;

            default:
                break;

        }

        $this->js = strtr($this->js, [
            '{funcName}' => $this->jscode($this->_config['funcName']),
            '{option}' => $this->jscode($this->_config['option']),
            '{callBack}' => $this->jscode($this->_config['callBack']),
            '{title}' => $this->jscode($this->_config['title']),
            '{text}' => $this->jscode($this->_config['text']),
            '{icon}' => $this->jscode($this->_config['icon']),
            '{confirmButtonColor}' => $this->jscode($this->_config['confirmButtonColor']),
            '{cancelButtonColor}' => $this->jscode($this->_config['cancelButtonColor']),
            '{focusConfirm}' => $this->jscode($this->_config['focusConfirm']),
            '{confirmButtonAriaLabel}' => $this->jscode($this->_config['confirmButtonAriaLabel']),
            '{cancelButtonAriaLabel}' => $this->jscode($this->_config['cancelButtonAriaLabel']),
            '{footer}' => $this->jscode($this->_config['footer']),
            '{imageWidth}' => $this->jscode($this->_config['imageWidth']),
            '{imageHeight}' => $this->jscode($this->_config['imageHeight']),
            '{url}' => $this->jscode($this->_config['url']),
            '{position}' => $this->jscode($this->_config['position']),
            '{showConfirmButton}' => $this->jscode($this->_config['showConfirmButton']),
            '{html}' => ob_get_clean(),
            '{backdrop}' => $this->jscode($this->_config['backdrop']),
            '{background}' => $this->jscode($this->_config['background']),
            '{padding}' => $this->jscode($this->_config['padding']),
            '{width}' => $this->jscode($this->_config['width']),
            '{step}' => Json::encode($this->_aStep, JSON_PRETTY_PRINT),
            '{showLoaderOnConfirm}' => $this->jscode($this->_config['showLoaderOnConfirm']),
            '{autocapitalize}' => $this->jscode($this->_config['autocapitalize']),
            '{showCloseButton}' => $this->jscode($this->_config['showCloseButton']),
            '{cancelButtonText}' => $this->jscode($this->_config['cancelButtonText']),
            '{iconHtml}' => $this->jscode($this->_config['iconHtml']),
            '{timerProgressBar}' => $this->jscode($this->_config['timerProgressBar']),
            '{inputType}' => $this->jscode($this->_config['inputType']),
            '{progressSteps}' => $this->jscode($this->_config['progressSteps']),
            '{showCancelButton}' => $this->jscode($this->_config['showCancelButton']),
        /*    '{question}' => $this->jscode($this->_config['question']),*/
            '{questionText}' => $this->jscode($this->_config['questionText']),
            '{confirmButtonAfterQueueText}' => $this->jscode($this->_config['confirmButtonAfterQueueText']),
            '{AfterQueueText}' => $this->jscode($this->_config['AfterQueueText']),
            '{AfterQueueTitle}' => $this->jscode($this->_config['AfterQueueTitle']),
            '{callBackSecondBtn}' => $this->jscode($this->_config['callBackSecondBtn']),
            '{confirmButtonText}' => $this->jscode($this->_config['confirmButtonText']),
            '{reverseButtons}' => $this->jscode($this->_config['reverseButtons']),

            '{result}' => $this->eventCode('result'),
            '{notresult}' => $this->eventCode('notresult'),

        ]);

    }

}
