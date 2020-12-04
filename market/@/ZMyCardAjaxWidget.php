<?php

/**
 *
 *
 * Author:
 *      
 */

namespace zetsoft\widgets\market;


use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZMyCardAjaxWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'class' => 'quantity'

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
<div class="row">
           <div class="container bg-white embed-responsive col-md-12 ">
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
                        <div class="crt-sumry  blue lighten-5">
                            <h5>Cart Summery</h5>
                            <ul class="list-unstyled">
                                <li >Subtotal <span id="subtotals">$328.00</span></li>
                                <li>Shipping &amp; Tax <span id="shipping">00.00</span></li>
                                <li>Grand Total <span id="totalsum">$328.00</span></li>
                            </ul>
                            <div class="cart-btns text-right">
                                <button type="button" class="up-cart">Update Cart</button>
                                <button type="button" class="chq-out">Checkout</button>
                            </div>
                        </div>
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
                <div class="btn-group numer" role="group">
                     <input class="form-control-sm {class}" data-price="{price}" id="changedInput{id}" type="number" value="{amount}" min="0" max="100" step="1" style="width: 50px!important;"/>
                </div>
            </td>
            <td class="align-middle text-center">
                <!---->

                <div>
                    <h6 id="totalchangedInput{id}" class="font-weight-bold totals">{total}</h6>
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
        var config = {
            decrementButton: "<strong id='minus{id}'>-</strong>", // button text
            incrementButton: "<strong id='plus{id}'>+++</strong>", // ..
            groupClass: "", // css class of the resulting input-group
            buttonsClass: "btn-outline-dark",
            buttonsWidth: "1rem",
            textAlign: "center",
            autoDelay: 500, // ms holding before auto value change
            autoInterval: 100, // speed of auto value change
            boostThreshold: 10, // boost after these steps
            boostMultiplier: "auto" // you can also set a constant number as multiplier
        };
         var total = 0;
         $.each( $(".totals"), function( key, value ) {total += Number(value.innerHTML);});
            $("#subtotals").html(total);
            $("#totalsum").html(total);
            $(".{class}").inputSpinner();
            $(".{class}").on("change", function () {
            newValue = $(this).val(); 
            var price =  $(this).data('price');
            $('#total'+$(this).attr('id')).html(newValue*price);
            var total = 0;
           
           
            
         $.each( $(".totals"), function( key, value ) {total += Number(value.innerHTML);});
            $("#subtotals").html(total);
            $("#totalsum").html(Number($("#shipping").html())+Number($("#subtotals").html()));
            
        })
     
JS,
        'css' => <<<CSS
   
.crt-sumry {
  background: #f1f1f1;
  padding: 23px 30px 30px;
}

.crt-sumry h5 {
  color: #444444;
  font-weight: 600;
  margin-bottom: 20px;
}

.crt-sumry ul {
  margin-bottom: 30px;
}

.crt-sumry ul li {
  font-size: 15px;
  color: #666666;
  font-weight: 600;
  margin-bottom: 5px;
}

.crt-sumry ul li span {
  float: right;
  color: #444444;
  font-weight: 700;
}

.crt-sumry ul li:nth-child(2) {
  border-bottom: 1px solid #dddddd;
  padding-bottom: 10px;
  margin-bottom: 10px;
}

 .crt-sumry button.up-cart {
  font-size: 15px;
  color: #5677fc;
  background: transparent;
  border: 1px solid #5677fc;
  -webkit-border-radius: 30px;
  -moz-border-radius: 30px;
  -ms-border-radius: 30px;
  border-radius: 30px;
  padding: 5px 18px;
  font-weight: 600;
}

 .crt-sumry button.up-cart:hover {
  color: #fff;
  background: #5677fc;
}

 .crt-sumry button.chq-out {
  font-size: 15px;
  color: #fff;
  background: #e45151;
  border: 1px solid #e45151;
  -webkit-border-radius: 30px;
  -moz-border-radius: 30px;
  -ms-border-radius: 30px;
  border-radius: 30px;
  padding: 5px 18px;
  font-weight: 600;
  margin-left: 10px;
}

 .crt-sumry button.chq-out:hover {
  color: #e45151;
  background: transparent;
}
CSS,


    ];


    public function asset()
    {
    //    $this->fileCss('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css');
//        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
//       $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');
//   $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css');
//        $this->fileCss('/render/asrorz/mdb/css/mdb.min.css');
//        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js');
        $this->fileJs('https://rawcdn.githack.com/shaack/bootstrap-input-spinner/661ee7a1424acd10985b87b4d64ed1b93b61a85a/src/bootstrap-input-spinner.js');
    }

    public function codes()
    {
        /** @var ProductItem[] $products */
        $products = Az::$app->market->product->cartOrders();

        $products_code = '';
        foreach ($products as $key => $product) {
            $total = $product->amount * $product->price[0];
            $properties_code = '';
            foreach ($product->properties as $property) {
                $properties_code .= strtr($this->_layout['property'], [
                    '{property}' => $property->name,
                    '{value}' => $property->items[array_key_first ( $property->items )]
                ]);
            }
            $products_code .= strtr($this->_layout['product'], [
                '{image}' => $product->image[0],
                '{url}' => $product->url,
                '{name}' => $product->name,
                '{price}' => $product->price[0],
                '{amount}' => $product->amount,
                '{delete_url}' => 'asdfas.fasdfas',
                '{properties}' => $properties_code,
                '{total}' => $total,
                '{currency}' => $product->currency,
                '{id}' => $key,
                '{class}' => $this->_config['class']
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{products}' => $products_code
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->_config['class']
        ]);
        $this->css = $this->_layout['css'];
    }

}

