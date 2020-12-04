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

class ZMyCardWidgetDT extends ZWidget
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

<div class="crt-sumry border border-success rounded mt-3 p-2 tablesize Mstyle">
        <table id="example" class="display mdl-data-table uk-table uk-table-hover uk-table-striped">
        <thead>
        <tr class="text-uppercase text-success">
            <th></th>
            
            <th class="p-2"><h6 class="font-weight-normal text-center">Товар</h6></th>

            <th class="p-2"><h6 class="font-weight-medium text-center px-5">Цена</h6></th>
            
            <th class="p-2"><h6 class="font-weight-normal text-center ">Магазин</h6></th>

            <th class="p-2"><h6 class="font-weight-medium text-center">Количество</h6></th>

            <th class="p-2"><h6 class="font-weight-medium text-center px-5">Всего</h6></th>
            
            <th class="p-2"><h6 class="font-weight-medium text-center px-5">Всего</h6></th>

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
            <td></td>
            <td class="align-middle">
                <div class="d-flex">
                    <img class="w-25 " src="{image}" class="mt-1 pl-2" alt="">
                    <div class="ml-4 my-auto">
                        <h6 class="mt-1"><a href="{url}">{name}</a></h6>
                        <ul class="list-unstyled col-sz">
                            {properties}
                        </ul>
                    </div>
                </div>
            </td>
            <td class="align-middle text-center px-0">
                <div class="d-flex align-items-center justify-content-center">
                    <span class="mb-2 mr-1">{currency_left} </span><h6 class="font-weight-medium price-format">{price} {currency_right}</h6>
                </div>
            </td>
            <td class="">{company_name}</td>
            <td class="align-middle text-center px-1 w-20">
                 {Spinner}
            </td>
            <td class="align-middle text-center px-0">
                <div class="d-flex align-items-center justify-content-center">
                <span class="mb-2 mr-1">{currency_left}</span>
                    <h6 class="font-weight-medium"> <span id="total{id}" class="
                   totals price-format">{total}</span> {currency_right}</h6>
                </div>
            </td>
            <td class="align-middle text-center">
                <div class="p-0" style="width: 22px; height: 30px; position: relative;">
                    <a  data-catalogid="{catalog_id}" class="delete_product_from_cart"><i class="small far fa-trash-alt fp-25 text-success" style="position:absolute; left: 1px"></i>
                    </a>
                </div>
            </td>
        </tr>

HTML,
        'property' => <<<HTML
            <li><span class="text-black-50">{property} : </span>{value}</li>
HTML,


        'js' => <<<JS

    $(document).ready(function() {
        $('#example').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false,
            order: [[3, 'asc']],
            rowGroup: {
                dataSrc:3
            },
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "target": 0
        } ],
        "order": [[ 1, 'asc' ]],
            autoWidth: fa   lse,
            "pagingType": "simple_numbers",
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
        }
        });
        
    } );
        
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
        $this->fileJs('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
        $this->fileJs('https://cdn.datatables.net/1.10.21/js/dataTables.uikit.min.js');
        $this->fileJs('https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js');
        $this->fileJs('https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css');
        $this->fileCss('https://cdn.datatables.net/1.10.21/css/dataTables.uikit.min.css');
        $this->fileCss('https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css');
    }

    public function codes()
    {
        /*UIMD*/


        /*UIMD*/

        /** @var SingleProductItem[] $products */
        /*$products = Az::$app->market->product->cartOrders();*/
        $products = null;
        if (!isset($products)) {
            $item = new SingleProductItem();
            $item->id = 2;
            $item->name = 'Арахисовая паста с медом 200г';
            $item->title = 'Test Desc';
            $item->new_price = '14825920';
            $item->price_old = '188920';
            $item->barcode = '34234234';
            $item->exist = ProductItem::exists['not'];
            $item->images = [
                'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
            ];
            $item->currency = 'сум';
            $item->currencyType = 'after';
            $item->measure = 'шт';
            $item->rating = 3.5;
            $item->discount = -10;
            $item->catalogId = 19;
            $item->sale = 'sdadsa';
            $item->is_multi = false;
            $item->in_wish = true;
            $item->in_compare = false;
            $item->cart_amount=1;
            $item->company_id=3;
            $products[] = $item;
            $products[] = $item;
            $products[] = $item;


        }

        $company_name='asdasdas';

        $products_code = '';
        foreach ($products as $key => $product) {
            $properties_code = '';
            foreach ($product->properties as $property) {
                $properties_code .= strtr($this->_layout['property'], [
                    '{property}' => $property->name,
                    '{value}' => $property->items[array_key_first($property->items)]
                ]);
            }
            /*UMID*/

            if ($product->currencyType == ProductItem::currencyType['after']) {
                $currency_left = '';
                $currency_right = $product->currency;
            } elseif ($product->currencyType == ProductItem::currencyType['before']) {
                $currency_left = $product->currency;
                $currency_right = '';
            }

            /*UMID*/

            $catalog_id = $product->catalogId ?? 0;
            $price = $product->new_price;
            $id = $key;
            $attr = "data-catalogid='$catalog_id' data-price='$price' data-id='$id'";
            $products_code .= strtr($this->_layout['product'], [
                '{company_name}'=>$company_name,
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
                '{total}' => $product->new_price*$product->cart_amount,

                '{catalog_id}' => $product->id ?? 0
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{products}' => $products_code
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->_config['class'],
            '{priceFormat}' => ZPriceFormatWidget1::widget([])
        ]);

    }

}

