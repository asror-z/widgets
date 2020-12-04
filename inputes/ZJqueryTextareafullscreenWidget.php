<?php

/**
 *
 *
 * By: Jasur Shukurov
 *
 */

namespace zetsoft\widgets\inputes;


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZJqueryTextareafullscreenWidget
 * @package zetsoft\widgets\inputes
 *
 * https://www.jqueryscript.net/demo/jQuery-Plugin-For-Textarea-Fullscreen-Mode/
 * https://github.com/CreoArt/jquery.textareafullscreen
 *
 * Author: Omadbek Rahmonov
 */
class ZJqueryTextareafullscreenWidget extends ZWidget
{

    public $config = [];
    public $_config = [

    ];

    public function asset()
    {
       $this->fileCss('https://cdn.statically.io/gh/CreoArt/jquery.textareafullscreen/master/textareafullscreen.css');
        $this->fileJs('/render/inputes/ZJqueryTextareafullscreenWidget/textareafullscreen.js');

    }

    public $layout = [];
    public $_layout = [
    
        'main' => <<<HTML
            <div {readonly}>
                <div class="tx-editor-wrapper position-relative">
                    <div class="tx-editor expanded" style="max-width: 50%; max-height: 50%; top: 100px; left: 50px;">
                    <textarea id="asset" name="{name}" value="{value}"  style="width: 50%; height: 50%; resize: none;">
                    {value}</textarea>
                    </div>
                </div>
            </div>
            
HTML,
        'event' => <<<JS
            $(document).ready(function() {
	$('#asset').textareafullscreen({
		overlay: true, // Overlay
		maxWidth: '80%', // Max width
		maxHeight: '80%', // Max height
		key: 'f' // default null, crtl + key to toggle fullscreen
	});
});
            
            
JS,


    ];
    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}'  => $this->value,

            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);

        $this->js .= strtr($this->_layout['event'],[
            '{id}' => $this->id,
        ]);
        
        

    }
    
}

