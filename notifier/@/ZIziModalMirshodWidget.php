<?php
namespace zetsoft\widgets\notifier;


/**
 *
 * https://izimodal.marcelodolza.com//#modal-default
 *
 * Created By: Dilmurod Axmadov
 *
 */
use zetsoft\system\kernels\ZWidget;

class ZIziModalMirshodWidget extends ZWidget
{
    public $config = [];
    public $_config = [

    ];

    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js');
    }
    public function codes()
    {
        $this->layout = [
        'main' =>  <<<HTML
<div id="modal">
    </div>
<a class="trigger">Modal</a>
HTML,
           'js' => <<<JS
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
    iframeURL: null,
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
    fullscreen: false,
    openFullscreen: false,
    closeOnEscape: true,
    closeButton: true,
    appendTo: 'body', // or false
    appendToOverlay: 'body', // or false
    overlay: true,
    overlayClose: true,
    overlayColor: 'rgba(0, 0, 0, 0.4)',
    timeout: false,
    timeoutProgressbar: false,
    pauseOnHover: false,
    timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
    transitionIn: 'comingIn',
    transitionOut: 'comingOut',
    transitionInOverlay: 'fadeIn',
    transitionOutOverlay: 'fadeOut',
    onFullscreen: ,
    onResize: ,
    onOpening: ,
    onOpened: ,
    onClosing: ,
    onClosed: ,
    afterRender: 
});
$('#modal').iziModal('resetContent');
//$('#modal').iziModal('setGroup', 'alerts');
// $('#modal').iziModal('next' ,{
//     transitionIn: 'bounceInDown',
//     transitionOut: 'bounceOutDown',
// });
$("#modal").iziModal('setContent', {
    content: '<p>Example</p>',
    default: true
})
$('#modal').iziModal('prev' ,{
    transitionIn: 'bounceInDown',
    transitionOut: 'bounceOutDown',
});
$('#modal').iziModal('startLoading');
$('#modal').iziModal('stopLoading');
$(document).on('click', '.trigger', function (event) {
    $('#modal').iziModal('open');
});



JS,



            ];

        $this->htm = strtr($this->layout['main'],[]);
        $this->js = strtr($this->layout['js'],[]);

    }
}
