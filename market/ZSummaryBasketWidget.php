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

class ZSummaryBasketWidget extends ZWidget
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
        
                  <div class="col-12 d-flex justify-content-between">
                       <div class=""><span class="">Общая сумма:</span></div>
                       <div class=""><span id="subtotals" class="price-format">0</span></div>
</div>                                   
HTML,

        'js' => <<<JS
        {priceFormat}
         var total = 0;
         console.log(total)
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
                    amount  : 0,
                },
                success: function(data){
                     el.parents(".product_item:first").remove();
                     let total = 0;
                     console.log($(".totals")) ;
                     $.each( $(".totals"), function( key, value ) {total += Number(value.innerHTML);});
                     $("#subtotals").html(total);
                     $("#totalsum").html(Number($("#shipping").html())+Number($("#subtotals").html()));
                   
                },
                error:  function() {
                    alert('error');
                }
            });
        });
        /*$("#cartReview").remove();*/
        $(".{class}").inputSpinner().on("change", function () {
            console.log('asddsfdsf') ;
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

