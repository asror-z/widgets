<?php

/**
 *
 *
 * Author:  Widget vi
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\kernels\ZWidget;

class ZMyCardExampleWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'products'
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

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
        {products}

        </tbody>


    </table>
</div>
          
HTML,
        'product' => <<<HTML
        <tr class="d-print-table-row border-bottom">
            <td class="align-middle">
                <div class="row d-flex">
                    <img src="{image}" class="mt-1" alt="" width="100" height="100">
                    <div class="ml-4">
                        <h6><a href="{url}">{name}</a></h6>
<!--                        <ul class="list-unstyled list-inline text-warning small">-->
<!--                            <li class="list-inline-item"><i class="fa fa-star"></i></li>-->
<!--                            <li class="list-inline-item"><i class="fa fa-star"></i></li>-->
<!--                            <li class="list-inline-item"><i class="fa fa-star"></i></li>-->
<!--                            <li class="list-inline-item"><i class="fa fa-star"></i></li>-->
<!--                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>-->
<!--                        </ul>-->
                        <ul class="list-unstyled col-sz">
                            {properties}
                        </ul>
                    </div>
                </div>
            </td>
            <td class="align-middle text-center">
                <!---->
                <div>
                    <h6 class="font-weight-bold">{currency}{price}</h6>
                </div><!---->
                <!---->
            </td>
            <td class="align-middle text-center">
                <!---->
                
                <div class="btn-group numer" role="group">
                     <input class="form-control-sm" type="number" value="{amount}" min="0" max="100" step="1" style="width: 50px!important;"/>
                </div>

            </td>
            <td class="align-middle text-center">
                <!---->

                <div>
                    <h6 id="total{id}" class="font-weight-bold">{total}</h6>
                </div><!---->
            </td>
            <td class="align-middle text-center">
                <div style="border: 1px solid darkgrey; border-radius: 50%; width: 22px; height: 22px; position:relative;">
                    <a href="{delete_url}"><i class="small fa fa-trash-o m-1" style="position:absolute; left: 1px"></i></a>
                </div>
            </td>
        </tr><!----><!---->
HTML,
        'property' => <<<HTML
            <li><span class="text-black-50">{property} : </span>{value}</li>
HTML,


            'js' => <<<JS
        $("input[type='number']").inputSpinner();
        var config = {
    decrementButton: "<strong id="minus{id}">-</strong>", // button text
    incrementButton: "<strong id="plus{id}">+</strong>", // ..
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
    .numer{
        width: 120px!important;
    }
    .input-group-sm>.form-control:not(textarea) {
    height: calc(1.5em + .5rem + 8px);
}
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
        /** @var ProductItem[] $products */
        $products = $this->_config['products'];

        $products_code = '';
        foreach ($products as $key => $product)
        {
            $total = $product->amount*$product->price;
            $properties_code = '';
            foreach ($product->properties as $property)
            {
                $properties_code .= strtr($this->_layout['property'], [
                    '{property}' => $property->property,
                    '{value}' => $property->value[0]
                ]);
            }
            $products_code .= strtr($this->_layout['product'], [
                '{image}' => $product->image[0],
                 '{url}' => $product->url,
                 '{name}' => $product->name,
                '{price}' => $product->price,
                '{amount}' => $product->amount,
                "{delete_url}" => 'asdfas.fasdfas',
                "{properties}" => $properties_code,
                "{total}" => $total,
                '{currency}' => $product->currency,
                '{id}' => $key
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
           '{products}' => $products_code
        ]);
        /*$this->js= strtr($this->_layout['js'], [
            '{id}' => ''
        ]);*/
        $this->css= strtr($this->_layout['css'], []);
    }

}

