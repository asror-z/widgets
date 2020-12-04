<?php

namespace zetsoft\widgets\cards;

use zetsoft\system\kernels\ZWidget;

/**
 * https://www.figma.com/file/phwYNQp2ce9O6Kd9dMrReU/ProductCard?node-id=0%3A1
 *
 */

class ZCard_1Widget extends ZWidget
{
    public $config = [];
    public $_config = [
        'image' => '',
        'name' => '',
        'price' => '',
        'cardclass'=>'',
    ];
    public $event = [];
    public $_event = [];

    public function asset()
    {

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

        <div class="card text-center p-2 {cardclass} shadow-none">
        <div class="image "></div>    
            <div class="card-body p-">
              <div class="fe-10 text-truncate">{name}</div>
            <h5>{price}</h5><br>
            <button type="button" class="btn btn-success p-2 px-3"><i class="fas fa-cart-plus fa"></i></button>
            </div>
        </div>

HTML,
    'css'=><<<CSS
       .image {
        background-image: url("{image}");
        width: 100%;
    height: 140px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
        
       }   
CSS



    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{image}' => $this->_config['image'],
            '{price}' => $this->_config['price'],
            '{name}' => $this->_config['name'],
            '{cardclass}' => $this->_config['cardclass'],
        ]);

        $this->css = strtr($this->_layout['css'],[
              '{image}'=>$this->_config['image']

        ]);
    }
}
