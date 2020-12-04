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
class ZColumnWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'count' => 1,
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

          <div class="row" data-gjs-droppable="div" data-gjs-type="default" data-highlightable="1" draggable="true" >
                {content}
          </div>

HTML,
        'css' => <<<CSS
        
        .row {
            display: flex!important;
        }
        .selfColumn {
            min-height: 75px;
        }
CSS,


    ];

    public function codes()
    {
        $content = '';

        $count = 12 / $this->_config['count'];

        for ($i = 0; $i < $this->_config['count']; $i++) {
            $content .= <<<HTML
        <div data-gjs-type="default" data-gjs-draggable=".row" readonly="true" draggable="true" data-highlightable="1" droppable="true" class="col-lg-{$count} selfColumn" style="min-height: 75px;"></div>
        
HTML;
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{widget}' => str_replace('\\', '/', $this->dataWidget),
            '{config}' => json_encode($this->_config),
            '{content}' => $content
        ]);


    }

}
