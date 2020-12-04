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
 
class ZSweetAlert2WidgetNew extends ZWidget
{

    public $config = [];
    public $_config = [

        'layoutType'=> ZSweetAlert2Widget2New::type['basicMessage'],

        'showCancelButton' => false,
        'funcName' => 'sampleQueueFunc',
        'callBack' => '\'Deleted!\',\'Your file has been deleted.\',\'success\'',
        'callBackQueue' => 'Swal.mixin({ title: \'All done!\',html:\'Your answers: <pre><code>\' +
            JSON.stringify(result.value) +\'</code></pre>\',confirmButtonText: \'Lovely!\' })',
        'callBackSecondBtn' => 'Swal.fire(\'Not Deleted!\', \'Your action has been cancelled.\',\'error\')',
        'title' => '',
        'titleText' => '',

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
        /*'padding' => '',
        'width' => 500,*/
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

                /*Options*/
        'inputTypes' =>ZSweetAlert2Widget2New::inputType['radio'],
        'width' => 600,
        'padding' => '3em',
        'position' => ZSweetAlert2Widget2New::position['center'],
        'grow' => ZSweetAlert2Widget2New::grow['false'],


        /*VARIABLES FOR QUEUE TYPE*/
        'inputType' => '',
        'confirmButtonText' => 'Text',
        'progressSteps' => [],


    ];

    public $layout  = [];
    public $_layout = [
        'basicMessage' => <<<JS
    function {funcName}() {
            Swal.fire('Any fool can use a computer')
  }    
JS,

        'modal' => <<<JS
    function {funcName}() {
            Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!',
                  footer: '<a href>Why do I have this issue?</a>'
                })
  }    
JS,

        'modalWindow' => <<<JS
    function {funcName}() {
            Swal.fire({
              url: 'https://placeholder.pics/svg/300x1500',
              imageHeight: 1500,
              imageAlt: 'A tall image'
})
  }    
JS,

        'customHtmldesc' => <<<JS
    function {funcName}() {
            Swal.fire({
              title: '<strong>HTML <u>example</u></strong>',
              icon: 'info',
              html:
                'You can use <b>bold text</b>, ' +
                '<a href="//sweetalert2.github.io">links</a> ' +
                'and other HTML tags',
              showCloseButton: true,
              showCancelButton: true,
              focusConfirm: false,
              confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Great!',
              confirmButtonAriaLabel: 'Thumbs up, great!',
              cancelButtonText:
                '<i class="fa fa-thumbs-down"></i>',
              cancelButtonAriaLabel: 'Thumbs down'
            })
  }    
JS,

        'customDialog' => <<<JS
    function {funcName}() {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1500,
               title: 'Sweet!',          
})
  }    
JS,

        'customAnimate' => <<<JS
    function {funcName}() {
            Swal.fire({
  title: 'Custom animation with Animate.css',
  showClass: {
    popup: 'animated fadeInDown faster'
  },
  hideClass: {
    popup: 'animated fadeOutUp faster'
  }
})
  }    
JS,

        'confirmDialog' => <<<JS
    function {funcName}() {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success' 
                  )}})}    
JS,

        'byPassingNoCancel' => <<<JS
    function {funcName}() {
            const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })
        
                swalWithBootstrapButtons.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, delete it!',
                  cancelButtonText: 'No, cancel!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {
                    swalWithBootstrapButtons.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelled',
                      'Your imaginary file is safe :)',
                      'error'
    )
  }
})
                  
                  }    
JS,

        'customMessage' => <<<JS
    function {funcName}() {
            Swal.fire({
              text: 'Modal with a custom image.',
              url: 'https://unsplash.it/400/200',
              imageWidth: 400,
              imageHeight: 200,
              imageAlt: 'Custom image',
})
  }    
JS,

        'messAutoCloseTimer' => <<<JS
    function {funcName}() {
           let timerInterval
            Swal.fire({
              title: 'Auto close alert!',
              html: 'I will close in <b></b> milliseconds.',
              timer: 2000,
              timerProgressBar: true,
              onBeforeOpen: () => {
                Swal.showLoading()
                timerInterval = setInterval(() => {
                  const content = Swal.getContent()
                  if (content) {
                    const b = content.querySelector('b')
                    if (b) {
                      b.textContent = Swal.getTimerLeft()
                    }
                  }
                }, 100)
              },
              onClose: () => {
                clearInterval(timerInterval)
              }
            }).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
              }
})
  }    
JS,

        'queueModals' => <<<JS
    function {funcName}() {
            Swal.mixin({
  input: 'text',
  confirmButtonText: 'Next &rarr;',
  showCancelButton: true,
  progressSteps: ['1', '2', '3']
}).queue([
  {
    title: 'Question 1',
    text: 'Chaining swal2 modals is easy'
  },
  'Question 2',
  'Question 3'
]).then((result) => {
  if (result.value) {
    const answers = JSON.stringify(result.value)
    Swal.fire({
      title: 'All done!',
      html: `
        Your answers:
        <pre><code> YOUR ANSWER </code></pre>
      `,
      confirmButtonText: 'Lovely!'
    })
  }
})
  }    
JS,

        'dynamicQueue' => <<<JS
    function {funcName}() {
            const ipAPI = '//api.ipify.org?format=json'

Swal.queue([{
  title: 'Your public IP',
  confirmButtonText: 'Show my public IP',
  text:
    'Your public IP will be received ' +
    'via AJAX request',
  showLoaderOnConfirm: true,
  preConfirm: () => {
    return fetch(ipAPI)
      .then(response => response.json())
      .then(data => Swal.insertQueueStep(data.ip))
      .catch(() => {
        Swal.insertQueueStep({
          icon: 'error',
          title: 'Unable to get your public IP'
        })
      })
  }
}])
  }    
JS,

        'mixinGrowl' => <<<JS
    function {funcName}() {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'success',
              title: 'Signed in successfully'
            })
  }    
JS,
    ];


    public $event = [];
    public $_event = [
        'result' => 'console.log("result")',
        'notresult' => 'console.log("notresult")',
    ];

    private $stepTitle;
    private $_aStep;

    public const type = [
        'basicMessage'=>'basicMessage',
        'modal'=>'modal',
        'modalWindow'=>'modalWindow',
        'customHtmldesc'=>'customHtmldesc',
        'customDialog'=>'customDialog',
        'customAnimate'=>'customAnimate',
        'confirmDialog'=>'confirmDialog',
        'byPassingNoCancel'=>'byPassingNoCancel',
        'customMessage'=>'customMessage',
        'messAutoCloseTimer'=>'messAutoCloseTimer',
        'queueModals'=>'queueModals',
        'dynamicQueue'=>'dynamicQueue',
        'mixinGrowl'=>'mixinGrowl',
    ];
    
    public const inputType = [
    'text' => 'text',
    'email' => 'email',
    'password' => 'password',
    'number' => 'number',
    'tel' => 'tel',
    'range' => 'range',
    'textarea' => 'textarea',
    'select' => 'select',
    'radio' => 'radio',
    'checkbox' => 'checkbox',
    'file' => 'file',
    'url' => 'url'
    ];

    public const position = [
        'top' => 'top',
        'top-start' => 'top-start',
        'top-end' => 'top-end',
        'center' => 'center',
        'center-start' => 'center-start',
        'center-end' => 'center-end',
        'bottom' => 'bottom',
        'bottom-start' => 'bottom-start',
        'bottom-end' => 'bottom-end',
    ];

    public const grow = [
        'row' => 'row',
        'column' => 'column',
        'fullscreen' => 'fullscreen',
        'false' => false,
    ];


    public function asset()
    {
       $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.all.min.js');
    }
    

    public function codes()
    {
        ob_start();
        $this->options = [
            'title' => $this->_config['title'],
            'titleText' => $this->_config['titleText'],
            'text' => null,
            'type' => true,
            'footer' => null,
            'backdrop' => true,//Can be either a boolean or a string which will be assigned to the CSS background property
            'toast' => false,
            'target' => 'body',
            'input' => $this->_config['inputTypes'],
            'width' => $this->_config['width'],
            'padding' => $this->_config['padding'],
            'background' => '{background}',   //  '#fff url(/images/trees.png)'
            'position' => $this->_config['position'],
            'grow' => $this->_config['grow'],
           
            'customClass' => '',
            /*'customClass' => [
                'container' => 'container-class',
                 'popup' => 'popup-class',
                 'header' => 'header-class',
                 'title' => 'title-class',
                 'closeButton' => 'close-button-class',
                 'image' => 'image-class',
                 'content' => 'content-class',
                 'input' => 'input-class',
                 'actions' => 'actions-class',
                 'confirmButton' => 'confirm-button-class',
                 'cancelButton' => 'cancel-button-class',
                 'footer' => 'footer-class'
             ],*/
            'timer' => true,
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
            'confirmButtonColor' => true,
            'cancelButtonColor' => true,
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

        /*if (!empty($this->data))
            foreach ($this->data as $data) {
                $this->_aStep[] = [
                    'title' => $data['title'],
                    'text' => $data['text'],
                    'input' => $data['input'],
                    'inputOptions' => isset($data['inputOptions']) ? $data['inputOptions'] : null,
                ];

                $this->stepTitle[] = $data['step'];
            }*/



        $this->htm .= strtr($this->_layout[$this->_config['layoutType']], [
                        '{funcName}' => $this->_config['funcName'],
                        '{callBack}' => $this->jscode($this->_config['callBack']),
                        '{callBackSecondBtn}' => $this->jscode($this->_config['callBackSecondBtn']),
                ]);


        $this->js = strtr($this->js, [
            '{funcName}' => $this->jscode($this->_config['funcName']),'{callBack}' => $this->jscode($this->_config['callBack']),
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
            '{inputTypes}' => $this->jscode($this->_config['inputTypes']),
            '{progressSteps}' => $this->jscode($this->_config['progressSteps']),
            '{showCancelButton}' => $this->jscode($this->_config['showCancelButton']),
            /*'{question}' => $this->jscode($this->_config['question']),*/
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
