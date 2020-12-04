<?php

/**
 *
 *
 * Author:  Jobir
 *      to'g'ri ishlayapti
 */

namespace zetsoft\widgets\cards;


use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZPriceFormatWidget1;
use zetsoft\widgets\market\ZInputSpinnerWidget;

class ZMyCardWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'class' => 'quantity',
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

<div class="crt-sumry border rounded mt-3 p-2 tablesize"style="border-color: #c5decf ">
        <table class="table">
        <thead>
        <tr class="text-uppercase text-success">
            <th class="p-2"><h6 class="font-weight-normal text-center">Товар</h6></th>

            <th class="p-2"><h6 class="font-weight-medium text-center">Цена</h6></th>

            <th class="p-2"><h6 class="font-weight-medium text-center">Количество</h6></th>

            <th class="p-2"><h6 class="font-weight-medium text-center">Всего</h6></th>
            
            <th class="p-2"><h6 class="font-weight-medium text-center"></h6></th>

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
        <tr class="d-print-table-row border-bottom product_item" >
            <td class="align-middle">
                <div class="d-flex">
                    <img class="w-25 ml-4" src="{image}" class="mt-1 pl-2" alt="">
                    <div class="ml-4 my-auto">
                        <h6 class="mt-1"><a href="{url}">{name}</a></h6>
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
                <div class="d-flex align-items-center">
                    <span class="mb-2 mr-1">{currency_left} </span><h6 class="font-weight-medium price-format">{price} {currency_right}</h6>
                </div><!---->
                <!---->
            </td>
            <td class="align-middle text-center w-20">
                <!---->
                 {Spinner}
                 
            </td>
            <td class="align-middle text-center">
                <!---->

                <div class="d-flex align-items-center">
                <span class="mb-2 mr-1">{currency_left}</span>
                    <h6 class="font-weight-medium"> <span id="total{id}" class="
                   totals price-format">{total}</span> {currency_right}</h6>
                </div><!---->
            </td>
            <td class="align-middle text-center">
                <div class="p-0" style="width: 22px; height: 30px; position: relative;">
                    <a  data-catalogid="{catalog_id}" class="delete_product_from_cart"><i class="small far fa-trash-alt fp-25 text-success" style="position:absolute; left: 1px"></i>
                    </a>
                </div>
            </td>
        </tr><!----><!---->

HTML,
        'property' => <<<HTML
            <li><span class="text-black-50">{property} : </span>{value}</li>
HTML,


        'js' => <<<JS
        
        {priceFormat}
        
        calculateTotals();
        function calculateTotals()
        {
            var total = 0;
            let parsed=0;
            $.each( $(".totals"), function( key, value ) {
                total += Number(value.innerHTML);
                parsed = parseFloat(total);
            });
            $("#subtotals").html(parsed);
            $("#totalsum").html(+10000);
            $(".{class}").inputSpinner();
        }
        $(".delete_product_from_cart").on("click", function() {
            var catalog_id = $(this).data('catalogid');
            console.log(catalog_id);
            var el = $(this);
            $.ajax({
                method: "GET",
                url: "/shop/core/product/setToCart.aspx",
                data: {
                    catalog_id: catalog_id,
                    amount    : 0,
                },
                success: function(data){
                    el.parents(".product_item:first").remove();
                    calculateTotals();
                },
                error:  function() {
                    alert('error');
                }
            });
        });
        /*$("#cartReview").remove();*/
        function inputchange()
        {
            var newValue = $(this).val();
            var price =  $(this).data('price');
            
            $('#total'+$(this).data('id')).html(newValue*price);
            var total = 0;
            var catalog_id = $(this).data('catalogid');
            
            $.each($(".totals"), function( key, value ) {
                total += Number(value.innerHTML);
            });
            let parsed = parseFloat(total);
            
            $("#subtotals").html(parsed);
            $("#totalsum").html(Number($("#shipping").html())+Number($("#subtotals").html()));
            
            $.ajax({
                method: "GET",
                url: "/shop/core/product/setToCart.aspx",
                data: {
                    catalog_id: catalog_id,
                    amount    : newValue,
                },
                success: function(data){
                    $(".wishCount").html(data);
                },
                error:  function() {
                    alert('error');
                }
            });
        }
        $("#totalsum").html(Number($("#shipping").html())+Number($("#subtotals").html()));
        
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
        /*UIMD*/


        /*UIMD*/

        /** @var SingleProductItem[] $products */
        $products = Az::$app->market->product->cartOrders();
        //vdd($products);
        $products_code = '';
        foreach ($products as $key => $product) {
            $properties_code = '';
            foreach ($product->properties as $property) {
                $properties_code .= strtr($this->_layout['property'], [
                    '{property}' => $property->name,
                    '{value}' => $property->items[array_key_first($property->items)]
                ]);
            }
            /*UIMD*/

            if ($product->currencyType == ProductItem::currencyType['after']) {
                $currency_left = '';
                $currency_right = $product->currency;
            } elseif ($product->currencyType == ProductItem::currencyType['before']) {
                $currency_left = $product->currency;
                $currency_right = '';
            }

            /*UIMD*/

            $catalog_id = $product->catalogId ?? 0;
            $price = $product->new_price;
            $id = $key;
            $attr = "data-catalogid='$catalog_id' data-price='$price' data-id='$id'";
            $products_code .= strtr($this->_layout['product'], [
                '{image}' => $product->image[0],
                '{url}' => $product->url,
                '{name}' => $product->name,
                '{price}' => $product->new_price,
                '{properties}' => $properties_code,
                '{Spinner}' => ZInputSpinnerWidget::widget([
                    'value' => $product->cart_amount,
                    'config' => [
                        'attr' => $attr,
                        'decimals' => '0'
                    ],
                    'event' => [
                        'change' => "inputchange"
                    ]
                ]),
                '{currency_right}' => $currency_right,
                '{currency_left}' => $currency_left,
                '{id}' => $key,
                '{class}' => $this->_config['class'],
                '{total}' => $product->new_price * $product->cart_amount,
                '{catalog_id}' => $product->id ?? 0
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{products}' => $products_code
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->_config['class'],
            '{priceFormat}' =>ZPriceFormatWidget1::widget()
        ]);

    }

}

