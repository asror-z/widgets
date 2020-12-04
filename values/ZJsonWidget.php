<?php

namespace zetsoft\widgets\values;

use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
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
class ZJsonWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
         'formClass' => null,
         'formModel' => null,
         'formAttr' => null,
         'formSession' => null,
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
    ];


    public function codes()
    {
        vd($this->value);

    }

}


