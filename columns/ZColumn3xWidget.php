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
class ZColumn3xWidget extends ZColumnWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'count' => 3,

    ];

    
    public $event = [];
    public $_event = [
        'click' => ' console.log("Column 3 | $eventClick") ',
        'dblclick' => ' console.log("Column 3 | $eventDblclick") ',
        'mouseenter' => ' console.log("Column 3 | $eventMouseEnter") ',
        'mouseleave' => ' console.log("Column 3 | $eventMouseLeave") ',
        'keyup' => ' console.log("Column 3 | $eventKeyup") ',
    ];

}
