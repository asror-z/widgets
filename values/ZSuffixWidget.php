<?php

namespace zetsoft\widgets\values;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Jahongir Qudratov
 */
class ZSuffixWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'suffix' => ''
    ];


    public function codes()
    {
        $value = $this->value;

        $suffix = $this->_config['suffix'];


        if (is_callable($suffix)) {

            $value .= $suffix($this->model, $this->attribute, $this->value);
        } else  $value .= $suffix;
        $this->htm = $value;
    }

}
