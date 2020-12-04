<?php

namespace zetsoft\widgets\inptest;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


class ZCopyToClipboardWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZCopyToClipboardWidget::type['input'],
    ];

    public const type = [
        'input' => 'input',
        'button' => 'button'
    ];

    public $layout = [];
    public $_layout = [
        'input' => <<<HTML
            <input class="copy-clipboard w-100 border-top-0 border-bottom-0 border-left-0" type="text" value="{value}" id="myInput" readonly>
HTML,

        'button' => <<<HTML
           <input class="copy-clipboard h-100" type="text" value="" id="myInput" readonly>
           <button class="copyToClipboard btn btn-light btn-sm mt-0"><i class="fa fa-copy fp-16"></i></button> 
HTML,

     'js' => <<<JS
        $(".copyToClipboard").on("click", function() {
            var copyTextParent = $(this).parent();
            var copyText = copyTextParent.children('.copy-clipboard')[0];
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            console.log(copyText);
        });
        
        $(".copy-clipboard").on("click", function() {
            var copyText = $(this)[0];
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            console.log(copyText);
            
        });
        
JS,


    ];


    public function codes()
    {
        $this->htm = strtr($this->_layout[$this->_config['type']], [
        '{value}' => $this->value
        ]);
        $this->js = strtr($this->_layout['js'], []);
}
}
