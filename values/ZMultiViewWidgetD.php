<?php

namespace zetsoft\widgets\values;

use zetsoft\dbitem\data\Form;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Jahongir Qudratov
 */
class ZMultiViewWidgetD extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public static $grapes = [
        'enable' => false,
        'icon' => '',
        'modalWidth' => '1000px',
        'image' => '/render/former/ZMultiWidget/image/icon.png',
        'name' => Azl . 'Multi',
        'title' => Azl . '<b>Titile</b><img src="/render/former/ZMultiWidget/image/icon.png"/>',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <table class="table-download w-100">
            {content}
        </table>

              
HTML,
        'option' => <<<HTML
        <tr>
            <td>{key}</td>
            <td>{value}</td>
        </tr>
HTML,
    ];


    /**
     *
     * Constants
     */


    public function asset()
    {

    }


    public function codes()
    {

          $this->htm = ZVarDumper::beauty($this->value);

    }

}
