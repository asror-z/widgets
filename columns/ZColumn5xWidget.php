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
class ZColumn5xWidget extends ZColumnWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'count' => 5
    ];

    
    public $event = [];
    public $_event = [
        'click' => ' console.log("Column 5x | $eventClick") ',
        'dblclick' => ' console.log("Column 5x | $eventDblclick") ',
        'mouseenter' => ' console.log("Column 5x | $eventMouseEnter") ',
        'mouseleave' => ' console.log("Column 5x | $eventMouseLeave") ',
        'keyup' => ' console.log("Column 5x | $eventKeyup") ',
    ];
}
