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
class ZColumn6xWidget extends ZColumnWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'count' => 6
    ];

    
    public $event = [];
    public $_event = [
        'click' => ' console.log("Column 6x | $eventClick") ',
        'dblclick' => ' console.log("Column 6x | $eventDblclick") ',
        'mouseenter' => ' console.log("Column 6x | $eventMouseEnter") ',
        'mouseleave' => ' console.log("Column 6x | $eventMouseLeave") ',
        'keyup' => ' console.log("Column 6x | $eventKeyup") ',
    ];

}
