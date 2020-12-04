<?php


namespace zetsoft\widgets\columns;
use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

class ZFluidContainerWidget extends ZWidget{

    public $config = [];
    public $_config = [

    ];

    public $grape=[
        'enable'=>true
    ];

    public $event = [];
    public $_event = [];
    public const type = [
        'main'=>'main',
    ];
    public $layout = [];
    public $_layout = [
        'main'=><<<HTML

 	<div class="row" data-gjs-droppable="div" data-gjs-type="default" data-highlightable="1" draggable="true" >
                {content}
    </div>
HTML,

        'css'=><<<CSS

CSS,
    ];


    
    public function codes(){

        $content = <<<HTML
    <div data-gjs-type="default" data-gjs-draggable=".row" readonly="true" draggable="true" data-highlightable="1" droppable="true" class="container-fluid selfColumn" style="min-height: 75px;"></div>
HTML;

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $content
        ]);
    }

}
