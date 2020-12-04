<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

class ZJqueryResizableWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'h' => ZJqueryResizableWidget::Hstyle['h1'],
        'grapes' => true,
    ];


    public const Hstyle =
        [
            'h1' => 'h1',
            'h2' => 'h2',
            'h3' => 'h3',

        ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
    <div id="resizable" class="ui-widget-content"  '>
    <{h} class="ui-widget-header">Resizable</{h}>
HTML,

        'css' => <<<CSS
        #resizable { width: 150px; height: 150px; padding: 0.5em; }
        #resizable h3 { text-align: center; margin: 0; }
    CSS,

        'js' => <<<JS
        $( function() {
            $( "#resizable" ).resizable();
        } );
JS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jqueryui@1.11.1/jquery-ui.css');
        /*$this->fileCss('/render/actions/ZAllResizableWidget/assets/css/material.css');*/
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jqueryui@1.11.1/jquery-ui.js');

    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            '{h}' => $this->_config['h'],
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
            ]);

        $this->css = strtr($this->_layout['css'], []);
        $this->js = strtr($this->_layout['js'], []);


    }
}
