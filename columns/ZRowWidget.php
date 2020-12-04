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
class ZRowWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
    ];

    
    public $event = [];
    public $_event = [
        'click' => ' console.log("Column 1 | $eventClick") ',
        'dblclick' => ' console.log("Column 1 | $eventDblclick") ',
        'mouseenter' => ' console.log("Column 1 | $eventMouseEnter") ',
        'mouseleave' => ' console.log("Column 1 | $eventMouseLeave") ',
        'keyup' => ' console.log("Column 1 | $eventKeyup") ',
    ];

    public const type = [
        'main' => 'main',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
     <div class="row"  data-gjs-type="default" droppable="true" data-highlightable="1"  draggable="true">
     </div>
HTML,
    ];

    public function codes()
    {
        $content = '';

//        for ($i = 0; $i < $this->_config['count']; $i++) {
//            $content .= <<<HTML
//        <div data-gjs-type="default" data-gjs-droppable="div" data-gjs-draggable=".row" readonly="true" draggable="true" data-highlightable="1" droppable="true" class="cell"></div>
//HTML;
//        }

        $this->htm .= strtr($this->_layout['main'], [
            '{widget}' => str_replace('\\', '/', $this->dataWidget),
            '{config}' => json_encode($this->_config),
            '{content}' => $content
        ]);

        $this->css = <<<CSS
        .row {
            min-height: 75px;
           
        }
CSS;


    }

}
