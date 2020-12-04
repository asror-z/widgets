<?php

/*
 *
 * Created By: Shahzod Gulomqodirov
 *
 */


namespace zetsoft\widgets\notifier;


use zetsoft\system\kernels\ZWidget;


class ZJspanelWidgetX extends ZWidget
{
    public $config = [];
    public $_config = [
        'funcName' => 'test',
        'content' => '',
        'width' => '60%',
        'height' => '85%',
        'title' => '',
        'iframeSrc' => '',
        'resize' => false,
        'footer' => null,
        'iframeName' => ''
    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/jspanel.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/jspanel.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/modal/jspanel.modal.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/tooltip/jspanel.tooltip.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/hint/jspanel.hint.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/layout/jspanel.layout.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/contextmenu/jspanel.contextmenu.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/dock/jspanel.dock.js');
    }

    public $event = [];
    public $_event = [
        'onClosed' => <<<JS
       
JS,

        'onbeforeclose' => <<<JS
       function() {
          console.log('asfa');
          return true;
       }
JS,

    ];


    public $active = [];
    public $_active = [

        'onbeforeclose' => true,
        'focusout' => true,
        'onClosed' => true
    ];


    public $layout = [];
    public $_layout = [

        'js' => <<<JS
        
        window.{funcName} = function() {
          
            if ($('#{id}').length > 0) 
                return;
          
            $('body').addClass('overflow-no')
          
            jsPanel.create({
                id: '{id}',
                content: `{content}`,
                headerTitle: '{title}',
                theme: 'white',
                borderRadius: '.5rem',
                footerToolbar: `{footer}`,
                headerControls: {
                    close: 'remove'
                },
                overflow: false,
                panelSize: {
                    width: '{width}',
                    height: '{height}'
                },
                resizeit: {resize},
                position: 'center left',
                onmaximized: function (event) {
                    $('body').addClass('overflow-no')
                },
                onminimized: function (event) {
                    $('body').removeClass('overflow-no')
                },
                onnormalized: function (event) {
                    $('body').addClass('overflow-no')
                },
                onclosed: function (event) {
                    {onClosed} 
                    $('body').removeClass('overflow-no')                 
                },
                onbeforeclose: {onbeforeclose},
            }).addControl({
            html: '<span class="fa fa-close"></span>',
            name: 'close',
            handler: function(panel, control) {
              
               if (window.confirm("Хотите закрыть ?")) {
                    panel.close() 
               }
            },
            
            position: 7,
            afterInsert: function(control) {
                // do with the control whatever is needed ...
            }
            
        });
          
            return jsPanel;
          
        }

JS,


        'frame' => <<<HTML
     <iframe src="{url}" name="{name}" width="100%" id="{id}-iframe" height="100%"></iframe>
HTML,


        'css' => <<<CSS
        .jsPanel-title {
            margin: 15px 20px!important;
            font-size: 30px!important;
        }
        
        .jsPanel-content {
            overflow: hidden!important;
        }
CSS,


    ];

    public function codes()
    {

        $content = strtr($this->_layout['frame'], [
            '{url}' => $this->_config['iframeSrc'],
            '{height}' => $this->_config['height'],
            '{width}' => $this->_config['width'],
            '{name}' => $this->_config['iframeName'],
            '{id}' => $this->id,
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{content}' => $content,
            '{funcName}' => $this->_config['funcName'],
            '{footer}' => $this->_config['footer'],
            '{iframeSrc}' => $this->_config['iframeSrc'],
            '{height}' => $this->_config['height'],
            '{width}' => $this->_config['width'],
            '{title}' => $this->_config['title'],
            '{id}' => $this->id,
            '{resize}' => $this->jscode($this->_config['resize']),
            '{onClosed}' => $this->eventCode('onClosed', false),
            '{onbeforeclose}' => $this->eventCode('onbeforeclose'),
        ]);

        $this->css = strtr($this->_layout['css'], []);

    }
}
