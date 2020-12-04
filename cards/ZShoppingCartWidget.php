<?php

/**
 *
 *
 * Author:  Shahzod Gulomqodirov
 *
 */

namespace zetsoft\widgets\cards;


use zetsoft\system\kernels\ZWidget;

class ZShoppingCartWidget extends ZWidget
{
    public static $grapes = [
        'enable' => true,
        'icon' => 'fas fa-trash-alt',
        'height' => '600px',
        'width' => '840px',
        'image' => 'https://eldorado.am/upload/iblock/a86/a86eb294ddc01da49fc04402104e5a2d.jpg',
        'name' => Azl . 'ShoppingCart',
        'title' => Azl . '<b>shoppingcart</b>',
    ];
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
         'grapes'=>true,
        'image' => 'https://eldorado.am/upload/iblock/a86/a86eb294ddc01da49fc04402104e5a2d.jpg',
        'color' => 'Black',
        'size' => 'M',
        'nametele' => 'Samsung Smart TV',
        'price' => '$189.00',
        'tolal' => '$278.00',
        'val' => 2
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];
    public $branch = [];
    public $_branch = [
        'widget' => [
            'image',
            'color',
            'size',
            'nametele',
            'price',
            'tolal',
            'val'
        ],
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
           <div class="container bg-white embed-responsive">
        <table class="table">
        <thead class="">
        <tr class="p-5 text-uppercase">
            <th><h6 class="font-weight-bold text-left">Product</h6></th>

            <th><h6 class="font-weight-bold text-center">Price</h6></th>

            <th><h6 class="font-weight-bold text-center">Quantity</h6></th>

            <th><h6 class="font-weight-bold text-center">Total</h6></th>

            <th class=""></th>
        </tr>
        </thead>
        <tbody>
        <!---->
        <tr class="d-print-table-row border-bottom">
            <td class="align-middle">
                <div class="row d-flex">
                    <img src="{image}" class="mt-1" alt="" width="100" height="100">
                    <div class="ml-4">
                        <h6><a href="#">{nametele}</a></h6>
                        <ul class="list-unstyled list-inline text-warning small">
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        </ul>
                        <ul class="list-unstyled col-sz">
                            <li><span class="text-black-50">Color : </span>{color}</li>
                            <li><span class="text-black-50">Size : </span>{size}</li>
                        </ul>
                    </div>
                </div>
            </td>
            <td class="align-middle text-center">
                <!---->
                <div>
                    <h6 class="font-weight-bold">{price}</h6>
                </div><!---->
                <!---->
            </td>
            <td class="align-middle text-center">
                <!---->
                
                <div class="btn-group numer w-50 " role="group">
                     <input class="form-control-sm" type="number" value="{val}" min="0" max="100" step="1">
                </div>

            </td>
            <td class="align-middle text-center">
                <!---->

                <div>
                    <h6 class="font-weight-bold">{total}</h6>
                </div><!---->
            </td>
            <td class="align-middle text-center">
                <div style="border: 1px solid darkgrey; border-radius: 50%; width: 22px; height: 22px; position:relative;">
                    <a href="#"><i class="small fas fa-trash-alt m-1" style="position:absolute; left: 1px"></i></a>
                </div>
            </td>
        </tr><!----><!---->

        </tbody>


    </table>
</div>
          
HTML,
        'js' => <<<JS
        $("input[type='number']").inputSpinner();
        var config = {
    decrementButton: "<strong>-</strong>", // button text
    incrementButton: "<strong>+</strong>", // ..
    groupClass: "", // css class of the resulting input-group
    buttonsClass: "btn-outline-dark",
    buttonsWidth: "1rem",
    textAlign: "center",
    autoDelay: 500, // ms holding before auto value change
    autoInterval: 100, // speed of auto value change
    boostThreshold: 10, // boost after these steps
    boostMultiplier: "auto" // you can also set a constant number as multiplier
}
       
JS,
        'css' => <<<CSS
   

CSS,


    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css');
//        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
//        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');
//        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css');
//        $this->fileCss('/render/asrorz/mdb/css/mdb.min.css');
//        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js');
        $this->fileJs('https://rawcdn.githack.com/shaack/bootstrap-input-spinner/661ee7a1424acd10985b87b4d64ed1b93b61a85a/src/bootstrap-input-spinner.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{color}' => $this->_config['color'],
            '{image}' => $this->_config['image'],
            '{nametele}' => $this->_config['nametele'],
            '{size}' => $this->_config['size'],
            '{price}' => $this->_config['price'],
            '{total}' => $this->_config['tolal'],
            '{val}' => $this->_config['val'],
        ]);
        $this->js = strtr($this->_layout['js'], []);
        $this->css = strtr($this->_layout['css'], []);
    }

}

