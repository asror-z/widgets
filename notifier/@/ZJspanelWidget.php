<?php

/*
 *
 * class ZJqueryConfirmWidget
 *
 * http://craftpip.github.io/jquery-confirm/#quickfeatures
 *
 * Created By: Nigoraxon G'aniyeva
 * Refactored:
 */


namespace zetsoft\widgets\notifier;


use zetsoft\system\kernels\ZWidget;

class ZJspanelWidgetas extends ZWidget
{
    public $config = [];
    public $_config = [
        'content' =>  '',
        'headt' => 'This Title',
        'iconbar' => [
            [
            ],
        ]
    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/jspanel.css');
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

        'tb' => <<<HTML
     <span id="btn-{icon}"><i class="fa {icon}"></i></span>
HTML,

       'js' => <<<JS
    
    var tbar = '{tbar}';
    jsPanel.create({
        id: 'loggerPanel',
        contentSize: ({
            width: function () {
                return window.innerWidth / 2
            },
            height: function () {
                return window.innerHeight / 2
            }, 
         
        }),
        position: {
                my: 'right-bottom',
                at: 'right-bottom',
                autoposition: 'down',
                offsetX: -40,
                offsetY: 0
               
        },
        headerTitle: '{headt}',
        content: '{content}',
        headerControls: {
            close: 'remove'
        },
        footerToolbar: '<i class="fa fa-clock"></i><span class="clock">loading ...</span>',
        callback: function (panel) {

            function clock() {
                var time = new Date(),
                    hours = time.getHours(),
                    minutes = time.getMinutes(),
                    seconds = time.getSeconds();
                panel.footer.querySelectorAll('.clock') [0].innerHTML = harold(hours) + ':' + harold(minutes) + ':' + harold(seconds);
                function harold(standIn) {
                    if (standIn < 3) {
                        standIn = '0' + standIn
                    }
                    return standIn;
                }
            }
            setInterval(clock, 1000);
        }
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
            html: '<span class="fa fa-close"></span>',
            name: 'close',
            handler: function(panel, control){
                $('.jsPanel').hide();
            },
            position: 7,
            afterInsert: function(control){
                // do with the control whatever is needed ...
            }
        }) 
        .setBorderRadius('0.7rem')
        /*.setHeaderLogo('<i class="fa fa-spinner fa-spin"></i>', function() {
            this.headerlogo.querySelector('.fa-spinner').style.marginLeft = '8px';
        })*/
        .setTheme({
            bgPanel: 'linear-gradient(120deg,#1BE7FF,#8100BA)',
            colorHeader: '#ffffff',
            colorContent: 'black',
            border: '4px solid #157B75'
        })
        
         $('.jsPanel').hide();
         
         $(document).ready(function(){

        $('input[type="checkbox"]').click(function(){
         let checkboxes = $('.checkbox');
            if($(this).prop("checked") == true){
                checkboxes.addClass('checked')
            }
            else if($(this).prop("checked") == false){
                checkboxes.removeClass('checked')
            }
        });
    });

JS,


        'func' => /** @lang JavaScript */ <<<JS
    
    tb.querySelector('#btn-{icon}').addEventListener('click', function () {
                    {func}
    },false);
    
JS,

    ];

    public function codes()
    {
        $tbar = '';
        $func = '';
        foreach ($this->config['iconbar'] as $value) {

            $tbar .= strtr($this->_layout['tb'], [
                '{icon}' => $value['icon']
            ]);
            $func .= strtr($this->_layout['func'], [
                '{icon}' => $value['icon'],
                '{func}' => $value['func'],
            ]);

        }


        $this->js .= strtr($this->_layout['js'], [
            '{content}' => $this->_config['content'],
            '{headt}' => $this->_config['headt'],
            '{tbar}' => $tbar,
            '{func}' => $func,
        ]);

    }
}
