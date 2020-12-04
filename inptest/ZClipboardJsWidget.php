<?php

namespace zetsoft\widgets\inptest;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


class ZClipboardJsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZCopyToClipboardWidget::type['button'],
    ];

    public const type = [
        'input' => 'input',
        'button' => 'button'
    ];

    public $layout = [];
    public $_layout = [
        'input' => <<<HTML
            <input id="foo" value="hello" class="h-100">

<!-- Trigger -->
<button class="btn btn-light btn-sm mt-0" data-clipboard-target="#foo">
    <i class="fa fa-copy fp-16"></i>
</button>
HTML,
        

     'js' => <<<JS
        var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function (event) {
    e.clearSelection();
});
JS,


    ];
    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['input'], [
        ]);
        $this->js = strtr($this->_layout['js'], []);
}
}
