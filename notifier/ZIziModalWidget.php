<?php

namespace zetsoft\widgets\notifier;


/**
 *
 * https://izimodal.marcelodolza.com//#modal-default
 *
 * Created By: Dilmurod Axmadov
 *
 */

use zetsoft\models\user\User;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputMaskWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZIziModalWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'resetText' => 'asdas',
        'submitText' => 'asdas',
        'footer' => '',
        'resetId' => 'reset',
        'submitId' => 'submit',
        'pjaxId' => ''

    ];

    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js');
    }

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function codes()
    {

        //$content = ob_get_clean();
        $this->layout = [
            'main' => <<<HTML
<div id="modal" data-iziModal-group="alerts"></div>
<a class="trigger">Modal</a>
<a href="" class="trigger-alert">Alert like</a>


HTML,

            'footer' => <<<HTML
       {reset}
    {submit}   
HTML,

            'js' => <<<JS
    /*function pjaxContent(){*/
    $("#modal").iziModal({
    title: 'asdasd',
    subtitle: 'asdasdasdasd',
    headerColor: '#88A0B9',
    background: null,
    theme: '',  // light
    icon: null,
    iconText: null,
    iconColor: '',
    rtl: false,
    width: 600,
    top: null,
    bottom: null,
    borderBottom: true,
    padding: 0,
    radius: 3,
    zindex: 999,
    iframe: false,
    iframeHeight: 400,
    iframeURL: "https://player.vimeo.com/video/22439234?autoplay=1",
    focusInput: true,
    group: '',
    loop: false,
    arrowKeys: true,
    navigateCaption: true,
    navigateArrows: true, // Boolean, 'closeToModal', 'closeScreenEdge'
    history: false,
    restoreDefaultContent: false,
    autoOpen: 0, // Boolean, Number
    bodyOverflow: false,
    fullscreen: true,
    openFullscreen: false,
    closeOnEscape: true,
    closeButton: true,
    appendTo: '#p0', // or false
    appendToOverlay: '#p0', // or false
    overlay: true,
    overlayClose: true,
    overlayColor: 'rgba(0, 0, 0, 0.4)',
    timeout: true,
    timeoutProgressbar: true,
    pauseOnHover: false,
    timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
    transitionIn: 'comingIn',
    transitionOut: 'comingOut',
    transitionInOverlay: 'fadeIn',
    transitionOutOverlay: 'fadeOut',
    //setGroup: 'alerts',
    //startProgress: true,    
    
    //setContent: '<p>Example</p>',
    onFullscreen: ,
    onResize: ,
    onOpened: ,
    onClosing: ,
    onClosed: ,
    afterRender: ,
    onOpening: 
});

//$('#modal').iziModal('startProgress');


//$('#modal').iziModal('setGroup', 'alerts');
//$('#modal').iziModal('setContent', `{content}`);


$(document).on('click', '.trigger', function (event) {
    $('#modal').iziModal('open');
});

/*}*/

    /*pjaxContent();*/
    
    /*$(document).on('pjax:end',function() {
        pjaxContent()
    })*/

JS,
        ];


        $this->htm = strtr($this->layout['main'], [
            '{footer}' => $this->_config['footer'],
        ]);

        /*if (empty($this->_config['footer'])) {
            $this->_config['footer'] = strtr($this->layout['footer'], [
                '{reset}' => ZButtonWidget::widget([
                    'id' => $this->_config['resetId'],
                    'config' => [
                        'text' => $this->_config['resetText'],
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'btnRounded' => false,
                        'hasIcon' => true,
                        'btnSize' => ZColor::btnSize['btn-md'],
                        'icon' => 'fas fa-trash',
                        'class' => 'reset-button',
                        'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
                    ]
                ]),
                '{submit}' => ZButtonWidget::widget([
                    'id' => $this->_config['submitId'],
                    'config' => [
                        'text' => $this->_config['submitText'],
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'icon' => 'fas fa-save',
                        'btnSize' => ZColor::btnSize['btn-md'],
                        'class' => 'submit-button',
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                    ]
                ])
            ]);
        }*/
        $this->js = strtr($this->layout['js'], [
            '{content}' => ob_get_clean(),
            '{footer}' => $this->_config['footer'],
            '{pjaxId}' => $this->_config['pjaxId'],
        ]);
    }
}
