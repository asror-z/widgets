<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;


/**
 * @author Shahzod Gulomqodirov
 *
 * https://github.com/Mobius1/Selectable-Table-Plugin
 * https://cdpn.io/Mobius1/debug/XxBQOa
 *
 */
class ZBootboxWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'width' => '768px',
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
        $this->fileCss('https://rawcdn.githack.com/ryanwellsdotcom/jquery-responsive-tables/ad09220e2a6b9ba63c20fb8b2761f617cac6f0ce/css/responsive-tables.min.css');

        $this->fileJs('https://rawcdn.githack.com/ryanwellsdotcom/jquery-responsive-tables/ad09220e2a6b9ba63c20fb8b2761f617cac6f0ce/js/jquery.responsive-tables.min.js');
    }

    public function codes()
    {
        $this->js = strtr($this->_layout['js'], [
            '{width}' => $this->_config['width'],
        ]);
    }

}

