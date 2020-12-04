<?php

namespace zetsoft\widgets\values;

use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Axmadov Dilmurod
 */
class ZLinkWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'link' => '#',
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

        $link = ZUrl::to([
            $this->_config['link'],
            'number' => $this->model->number,
            'attribute' => $this->attribute,
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{link}' => $link,
            '{linkText}' => $this->value,
        ]);

           
    }

}


