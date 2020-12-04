<?php

namespace zetsoft\widgets\former;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;


/**
 * @author Shahzod Gulomqodirov
 *
 *
 */
class ZResponsiveTableWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'width' => '768px',
        'grapes' => false,
    ];


    public $layout = [];
    public $_layout = [

        'js' => <<<JS
     $(document).ready(function() {
         $.responsiveTables('{width}');
     });
     
     $(document).on('pjax:end', function () {
         $.responsiveTables('{width}');
       });
JS,

    ];

    public function asset()
    {
    }

    public function codes()
    {
        $this->js = strtr($this->_layout['js'], [
            '{width}' => $this->_config['width'],
        ]);
    }

}

