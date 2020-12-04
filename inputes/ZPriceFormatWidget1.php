<?php

/**
 *
 *
 * @author: SherzodMangliyev
 *
 */

namespace zetsoft\widgets\inputes;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * ZRadioButtonGroup
 * @package widgets\inputes
 * https://getbootstrap.com/docs/4.3/components/button-group/
 */
class ZPriceFormatWidget1 extends ZWidget
{

    public $config = [];
    public $_config = [
        'priceClassName' => 'price-format'
    ];




    public $layout=[];
    public $_layout=[




    'js' => <<<JS
    $(document).ready( function() {
        $('.{priceClassName}').number(true, 2, '.', ' ');
        $(document).on('click','body *',function(){
            $('.{priceClassName}').number(true, 2, '.', ' ');
        })
    })
JS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.statically.io/gh/customd/jquery-number/a502e75a/jquery.number.min.js');
    }

    public function codes()
    {
      
        $this->js = strtr($this->_layout['js'],[
            '{priceClassName}' => $this->_config['priceClassName']
        ]);
    }
}
