<?php

namespace zetsoft\widgets\values;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Daho
 */
class ZLinkCallableWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'link' => '#',
        'nullValue' => Azl. 'Не задано',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <a href="{link}">{linkText}</a>
HTML,


    ];


    public function codes()
    {
        $link = $this->_config['link'];
        if (is_callable($link))
            $link = $link($this->model);
        $this->htm = strtr($this->_layout['main'], [
            '{link}' => $link,
            '{linkText}' => $this->value ?? $this->_config['nullValue'],
        ]);
    }

}


