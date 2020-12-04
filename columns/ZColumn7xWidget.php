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
class ZColumn7xWidget extends ZColumnWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'count' => 7
    ];

    
    public $event = [];
    public $_event = [
        'click' => ' console.log("Column 7x | $eventClick") ',
        'dblclick' => ' console.log("Column 7x | $eventDblclick") ',
        'mouseenter' => ' console.log("Column 7x | $eventMouseEnter") ',
        'mouseleave' => ' console.log("Column 7x | $eventMouseLeave") ',
        'keyup' => ' console.log("Column 7x | $eventKeyup") ',
    ];

}
