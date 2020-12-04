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

class ZJqueryConfirmWidget extends ZWidget
{
    public $config = [];
    public $_config = [

    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZJqueryConfirmWidget/image/icon.png',
        'name' => Azl . 'JqueryConfirm',
        'title' => Azl . '<b>safasfsa</b>',

    ];

    public function asset()
    {
  /*      $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js');
        $this->fileCss("https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css");*/
        
        $this->fileCss("https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.2/css/jquery-confirm.css");
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.2/dist/jquery-confirm.min.js');

    }

    public $layout = [];
    public $_layout = [

    'main' => <<<HTML
        <body>
            <button class="btn btn-primary example2"  '>example confirm</button>
        </body>
HTML,

       'js' => <<<JS
$('.example2').on('click', function() {
            $.confirm({
    title: 'Confirm!',
    content: 'Simple confirm!',
    buttons: {
        
        confirm: {
            text: 'Confirm',
            btnClass: 'btn-blue',
            display: 'inline-block',
            keys: ['enter', 'shift'],
            action: function(){
                $.alert('Confirm');
            }
        },
        
        cancel: {
            text: 'Cancel',
            btnClass: 'btn-blue',
            keys: ['enter', 'shift'],
            action: function(){
                $.alert('Canceled!');
            }
        },
        
        somethingElse: {
            text: 'Something else',
            btnClass: 'btn-blue',
            keys: ['enter', 'shift'],
            action: function(){
                $.alert('Something else?');
            }
        }
    }
});
    
        });
JS,
        'css' => <<<CSS
.btn-default {
 baground-color: blue!important;
}
CSS,
    ];

    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'], [
            
            //'{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);
        $this->js .= strtr($this->_layout['js'], [

        ]);
        $this->css .= strtr($this->_layout['css'], [

        ]);

    }
}
