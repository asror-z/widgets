<?php

namespace zetsoft\widgets\values;

use zetsoft\dbitem\data\Form;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;

/**
 * @author Daho
 */
class ZHtmlWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];





    public function codes()
    {


        $this->htm = $this->value;

    }

}
