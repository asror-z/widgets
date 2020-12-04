<?php

/**
 *
 *
 * Author:  Jobir
 *      to'g'ri ishlayapti
 */

namespace zetsoft\widgets\market;


use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZMyProductSummaryWidget1 extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'class' => 'quantity',
        'buyButton' => '',
        'delivery' => 1022
    ];


    /**
     *
     * Plugin Eventswebhtm/shop/bozor/main/check-out.php
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        
            <div class="w-100 p-3 text-center bg-white border border-success rounded">
               <p class="font-weight-bold fz-20">Сводка по счёту</p>
                  <ul class="list-unstyled">
                      <li class="text-left pr-0">
                          <span class="w-100">Промежуточный итог:</span>
                          <span id="subtotals" class="float-right">{subtotal}</span>
                      </li>
                      <li class="text-left pr-0 border-bottom border-success w-100 d-flex justify-content-between">
                          <span class="w-100">Доставка:</span>
                          <span id="shipping" class="float-right ">{delivery}</span>
                      </li>
                      <li class="text-success w-100 pr-0 font-weight-bold fz-18 mt-2 text-left d-flex justify-content-between">
                          <span class="w-100">Общая сумма:</span>
                          <span id="totalsum" class="float-right">{total}</span>
                      </li>
                  </ul>
                 <div class="d-flex justify-content-end">
                     {buyButton}                  
                 </div>
            </div>
                              
          
HTML,

        'js' => <<<JS
        
         var total = 0;
         $.each( $(".totals"), function( key, value ) {total += Number(value.innerHTML);});
         $("#subtotals").html(total);
         $("#totalsum").html(total);
         $(".delete_product_from_cart").on("click", function() {
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
            var price = $(this).data('price');
            $('#total' + $(this).attr('id')).html(newValue*price);
            var total = 0;
            var catalog_id = $(this).data('catalogid');
            
            $.each( $(".totals"), function( key, value ) {total += Number(value.innerHTML);});
            $("#subtotals").html(total);
            $("#totalsum").html(Number($("#shipping").html())+Number($("#subtotals").html()));
        })
        
        $('#showCartBtn').on('click', function (event){
	        onclick = $(this).attr('onclick');
            $(this).attr('onclick','');
            showConfirm(onclick);
            return false;
	    });
     
JS,


    ];


    public function asset()
    {

    }

    public function codes()
    {
        //vdd($this->sessionGet('cart'));

        /** @var MultiProductItem $product */
        $product_id = 19;
        $getProducts = Az::$app->market->product->product($product_id);

        $delivery = 1222;
        $subtotal = 12222;

        $carts = $this->sessionGet('cart');
        $cartCount = '';
        foreach ($carts as $key => $cart)
            $cartCount = ZArrayHelper::getValue($cart, 'amount');

        $price = 12321;
        $subtotal = $price * $cartCount;
        $total = $subtotal * $cartCount + $delivery;


        $this->htm = strtr($this->_layout['main'], [
            '{buyButton}' => $this->_config['buyButton'],
            '{subtotal}' => $delivery,
            '{delivery}' => $delivery,
            '{total}' => $total,
        ]);
    }
}

