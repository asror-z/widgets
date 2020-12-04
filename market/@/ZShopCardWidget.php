<?php

/**
 *
 *
 * Author:  Jobir
 *      to'g'ri ishlayapti
 */

namespace zetsoft\widgets\market;


use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZShopCardWidget extends ZWidget
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
    <div class="cart-contento">
  
</div>
        <!---->
        {products}

              
          
HTML,
        'product' => <<<HTML
   <div class="content-item d-flex justify-content-between product_container product_item">
        <div class="cart-img w-25">
            <a href="{url}"><img src="{image}" alt=""></a>
        </div>
        <div class="cart-disc w-50 text-center">
            <p><a href="{url}">{name}</a></p>
            <span>{amount} X </span><span>{price}</span>
        </div>
        <div class="delete-btn w-25 text-center">
            <button  style="z-index: 5"  data-catalogid="{catalog_id}" class = "remove_from_cart_button btn btn-outline-success" <!--data-id="{element_id}"-->>
             <i style="z-index: -1" class="fa fa-trash-o"></i>
             </button>
        </div>
    </div>

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
        $(".remove_from_cart_button").on("click", function() {
                    var catalog_id = $(this).data('catalogid');
                    var el = $(this);
                  $.ajax({
                  type: "GET",
                  url: "/shop/core/product/setToCart.aspx",
                  data: {
                      catalog_id: catalog_id,
                      amount    : 0,
                  },
                  success: function(data){
                     el.parents(".product_item:first").remove();
                  },
                  error:  function() {
                    alert('error');
                  }
               });
        });
        /*$("#cartReview").remove();*/
        $(".{class}").on("change", function () {
            newValue = $(this).val(); 
            var price =  $(this).data('price');
            $('#total'+$(this).attr('id')).html(newValue*price);
            var total = 0;
            var catalog_id = $(this).data('catalogid');
            console.log($(this).data('catalogid'));
            
         $.each( $(".totals"), function( key, value ) {total += Number(value.innerHTML);});
            $("#subtotals").html(total);
            $("#totalsum").html(Number($("#shipping").html())+Number($("#subtotals").html()));
            
            $.ajax({
                  type: "GET",
                  url: "/shop/core/product/setToCart.aspx",
                  data: {
                      catalog_id: catalog_id,
                      amount    : newValue,
                  },
                  success: function(){
                      //save
                      if (".{class}" != ''){
                          console.log('data saved');
                      }
                  },
                  error:  function() {
                    alert('error');
                  }
               });
            
            // $.ajax({
            //     url: "/core/product/addToCart.aspx",
            //     type: 'GET',
            //     data: { 
            //         product_id: '{product_id}',
            //        
            //     },
            //     success: function(res){
            //         console.log(res);
            //     },
            //     error: function(){
            //         alert('Error!');
            //     }
            // });
        })
        
       /* $('#showCartBtn').on('click', function (event){
	    onclick = $(this).attr('onclick');
   $(this).attr('onclick','');
   showConfirm(onclick);
        return false;
	});*/
     
JS,
        'css' => <<<CSS
   
CSS,


    ];


    public function asset()
    {

        $this->fileJs('https://rawcdn.githack.com/shaack/bootstrap-input-spinner/661ee7a1424acd10985b87b4d64ed1b93b61a85a/src/bootstrap-input-spinner.js');
    }

    public function codes()
    {
        /** @var ProductItem[] $products */
        $products = Az::$app->market->product->cartOrders();
        $products_code = '';
        foreach ($products as $key => $product) {
           // $total = $product->amount * $product->price[0];
           // $properties_code = '';
          /*  foreach ($product->properties as $property) {
                $properties_code .= strtr($this->_layout['property'], [
                    '{property}' => $property->name,
                    '{value}' => $property->items[array_key_first ( $property->items )]
                ]);
            }*/
            $products_code .= strtr($this->_layout['product'], [
                '{image}' => $product->image[0],
                '{url}' => $product->url,
                '{name}' => $product->name,
                '{price}' => $product->price[0],
                //'{properties}' => $properties_code,
                //'{total}' => $total,
                //'{currency}' => $product->currency,
                //'{id}' => $key,
                //'{class}' => $this->_config['class'],
                //'{amount}' => $product->cart_amount,
                //'{total}' => $product->price[0]*$product->cart_amount,
                '{catalog_id}' => $product->id ?? 0
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

