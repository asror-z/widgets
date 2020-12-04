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
class ZColumn4xWidget extends ZColumnWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'count' => 4
    ];

    
    public $event = [];
    public $_event = [
        'click' => ' console.log("Column 4x | $eventClick") ',
        'dblclick' => ' console.log("Column 4x | $eventDblclick") ',
        'mouseenter' => ' console.log("Column 4x | $eventMouseEnter") ',
        'mouseleave' => ' console.log("Column 4x | $eventMouseLeave") ',
        'keyup' => ' console.log("Column 4x | $eventKeyup") ',
    ];
}
