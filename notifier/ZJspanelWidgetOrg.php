<?php

/*
 *
 *
 * Created By: Shahzod Gulomqodirov
 *
 *
 */


namespace zetsoft\widgets\notifier;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZJspanelWidgetOrg extends ZWidget
{
    public $config = [];
    public $_config = [
        'content' => '',
        'headt' => 'This Title',
        'begin' => false,
        'width' => '600px',
        'height' => '400px',
        'footerToolbar' => '<button>save</button>',
        'iconbar' => [],

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

    public $layout = [];
    public $_layout = [
        'editable' => <<<HTML
<div class="rv-editable-link {class} d-flex justify-content-center">
    <span style="width:100%; cursor:pointer; color: royalblue!important;" id="editable-{id}" class=" modal-trigger-button dyna-editable">
      {value}
    </span>    
</div>
HTML,

        'js' => <<<JS
    


        var tbar = '{tbar}';
        var myJsPanel = jsPanel.create({
            id: '{id}',
            contentSize: ({
                width: '{width}',
                height: '{height}', 
            }),
            position: {
                my: 'center',
                at: 'center',
                autoposition: 'down',
                offsetX: -40,
                offsetY: 0
            },
            headerTitle: '{headt}',
            theme: 'crimson',
            animateIn: 'jsPanelFadeIn',
            animateOut: 'jsPanelFadeOut',
            content: `{content}`,
            headerControls: {
                close: 'remove'
            },
            footerToolbar: '{footerToolbar}',
            
        })
        .addToolbar('header', tbar, function (panel) {
            var tb = this.headertoolbar;
            {func}
            
            
            Array.prototype.slice.call(tb.querySelectorAll('span')).forEach(function (item) {
                item.style.cursor = 'pointer';
                item.style.margin = '3px 8px 1px 0';
            });
        })
        .addControl({
              html: '<span class="fa fa-stop-circle"></span>',
              name: 'stop',
              handler: function(panel, control){
                
              }
        })
        .addControl({
              html: '<span class="fa fa-eraser"></span>',
              name: 'clear',
              handler: function(panel, control){
                panel.content.innerHTML = '';
              }
        })
        .addControl({
            html: '<span class="fa fa-close"></span>',
            name: 'close',
            handler: function(panel, control){
                $('.jsPanel').hide();
            },
            position: 7,
            afterInsert: function(control){
              
            }
        })
        .setBorderRadius('0.7rem')

        .setTheme({
            bgPanel: 'linear-gradient(120deg,#1BE7FF,#8100BA)',
            colorHeader: '#ffffff',
            colorContent: '#000000',
            border: '4px solid #157B75'
        })
        
        $('.jsPanel').hide();
         
JS,

        'tb' => <<<HTML
     <span id="btn-{icon}"><i class="fa {icon}"></i></span>
HTML,

        'func' =>
            <<<JS
    
    tb.querySelector('#btn-{icon}').addEventListener('click', function () {
        {func}
    },false);

JS,


    ];

    public function init()
    {
        parent::init();
        if ($this->_config['begin'])
            ob_start();
    }

    public function codes()
    {
        $tbar = '';
        $func = '';
        $contrl = '';
        foreach ($this->_config['iconbar'] as $value) {

            $tbar .= strtr($this->_layout['tb'], [
                '{icon}' => $value['icon']
            ]);
            $func .= strtr($this->_layout['func'], [
                '{icon}' => $value['icon'],
                '{func}' => $value['func'],
            ]);

        }

        foreach ($this->_config['iconbar'] as $value) {
            $contrl .= strtr($this->_layout['control'], [
                '{icon}' => $value['icon'],
                '{func}' => $value['func'],
            ]);
        }

           /* $button = strtr($this->_layout['editable'], [
                '{id}' => $this->id,
                '{value}' => $this->getValue(),
                '{class}' => $this->_config['class'],
            ]);


            $this->htm = $button;*/

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{content}' => $this->_config['begin'] ? ob_get_clean() : $this->_config['content'],
            '{headt}' => $this->_config['headt'],
            '{tbar}' => $tbar,
            '{func}' => $func,
            '{width}' => $this->_config['width'],
            '{height}' => $this->_config['height'],
            '{footerToolbar}' => $this->_config['footerToolbar']
        ]);

        $this->css = <<<CSS
    .jsPanel{
        z-index: 9999!important;
    }
CSS;


    }

   /* private function getValue()
    {



        Az::$app->forms->wiData->clean();
        Az::$app->forms->wiData->model = $this->model;
        Az::$app->forms->wiData->attribute = $this->attribute;
        $value = Az::$app->forms->wiData->value();

        if (empty($value))
            $value = $this->valueIfNull;

        return $value;

    }*/
}
