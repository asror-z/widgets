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
class ZColumn8xWidget extends ZColumnWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'count' => 8
    ];

    
    public $event = [];
    public $_event = [
        'click' => ' console.log("Column 8x | $eventClick") ',
        'dblclick' => ' console.log("Column 8x | $eventDblclick") ',
        'mouseenter' => ' console.log("Column 8x | $eventMouseEnter") ',
        'mouseleave' => ' console.log("Column 8x | $eventMouseLeave") ',
        'keyup' => ' console.log("Column 8x | $eventKeyup") ',
    ];

}
