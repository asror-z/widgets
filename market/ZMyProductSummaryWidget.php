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
use zetsoft\widgets\inputes\ZPriceFormatWidget1;

class ZMyProductSummaryWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'class' => 'quantity',
        'buyButton' => '',
        'deliveryPrice' => 0,
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        
            <div class="w-100 p-3 text-center bg-white border border-success rounded">
               <p class="font-weight-bold fz-20">Сводка по счёту</p>
                  <ul class="list-unstyled">
                      <li class="text-left pr-0">
                          <span>Промежуточный итог:</span>
                          <span id="subtotals" class="float-right price-format">0</span>
                      </li>
                      <li class="text-left pr-0 border-bottom border-success w-100 d-flex justify-content-between">
                          <span>Доставка:</span>
                          <span id="shipping" class="float-right price-format">{deliveryPrice}</span>
                      </li>
                      <li class="text-success w-100 pr-0 font-weight-bold fz-18 mt-2 text-left d-flex justify-content-between">
                          <span>Общая сумма:</span>
                          <span id="totalsum" class="float-right price-format">0</span>
                      </li>
                  </ul>
                 <div class="d-flex justify-content-end">
                     {buyButton}                  
                 </div>
            </div>                                    
HTML,

        'js' => <<<JS
        {priceFormat}
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
        $(".{class}").inputSpinner().on("change", function () {
            console.log('asd') ;
            newValue = $(this).val();
            var price =  $(this).data('price');
            $('#total' + $(this).attr('id')).html(newValue*price);
            var total = 0;
            var catalog_id = $(this).data('catalogid');
            //console.log($(this).data('catalogid'));

            $.each( $(".totals"), function( key, value ) {total += Number(value.innerHTML);});
            $("#subtotals").html(total);
            $("#totalsum").html(Number($("#shipping").html())+Number($("#subtotals").html()));
            console.log($("#totalsum").html())
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
        $this->fileJs('https://rawcdn.githack.com/shaack/bootstrap-input-spinner/661ee7a1424acd10985b87b4d64ed1b93b61a85a/src/bootstrap-input-spinner.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{buyButton}' => $this->_config['buyButton'],
            '{deliveryPrice}' => $this->_config['deliveryPrice'],
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->_config['class'],
            '{priceFormat}' => ZPriceFormatWidget1::widget()
        ]);
    }
}

