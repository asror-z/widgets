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


class ZPriceFormatWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'value' => 1234567,
        'items' => [
            '',
        ]
    ];




    public $layout=[];
    public $_layout=[




    'js' => <<<JS
    window.onload = function() {
        var num = {value};
        
    //    .price-format
        
        var s =  num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        document.getElementById("{id}").innerHTML = s;
        console.log("total sum",s);
        }
JS,
    ];

    public function codes()
    {
      
        $this->js = strtr($this->_layout['js'],[
            '{id}' => $this->id,
            '{value}' => $this->_config['value'],
        ]);
    }
}
