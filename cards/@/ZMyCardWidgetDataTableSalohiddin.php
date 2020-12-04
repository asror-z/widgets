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
use zetsoft\widgets\market\ZMyProductSummaryWidget;
use zetsoft\widgets\market\ZSummaryBasketWidget;

class ZMyCardWidgetDataTableSalohiddin extends ZWidget
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

<div class="crt-sumry border rounded mt-3 p-2 tablesize Mstyle">
        <table id="example" class="display mdl-data-table uk-table uk-table-hover uk-table-striped">
        <thead>
        <tr class="text-uppercase text-success">
            <th></th>
            
            <th class="p-2"><h5 class="font-weight-bold text-center">Товар</h5></th>

            <th class="p-2"><h5 class="font-weight-bold text-center px-5">Цена</h5></th>
            
            <th class="p-2 d-none"><h5 class="font-weight-bold text-center ">Магазин</h5></th>

            <th class="p-2"><h5 class="font-weight-bold text-center">Количество</h5></th>

            <th class="p-2"><h5 class="font-weight-bold text-center px-5">Всего</h5></th>
            
            <th class="p-2"><h5 class="font-weight-bold text-center">Действии</h5></th>

        </tr>
        </thead>
        <tbody>
        <!---->
        {products}

        </tbody>

    </table>
    <div class="justify-content-end">{summ}</div>
</div>
                        
                                    
          
HTML,

        'product' => <<<HTML
        <tr class="d-print-table-row border-bottom product_item" >
            <td></td>
            <td class="align-middle">
                <div class="d-md-flex d-sm-block d-block flex-md-column flex-lg-row">
                    
                   <div class="img-fluid basket-image d-md-flex d-sm-block d-block" style="background-image: url('{image}')"></div>
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
                        <span class="mb-2 mr-1">{currency_left} </span><h6 class="font-weight-medium price-format">
                        {price} {currency_right}</h6>
                    </div>
                </td>
            <td class="d-none align-middle text-center px-0"><a href="{company_url}" class="text-dark text-center">{company_name}</a> 
            </td>
            <td class="align-middle text-center px-1 w-20">
                 {Spinner}
            </td>
            <td class="align-middle text-center px-0">
                <div class="d-flex align-items-center justify-content-center">
                <p class="mb-2 mr-1">{currency_left}</p>
                    <h6 class="font-weight-medium"> <span id="total{id}" class="
                   totals price-format ztotal">{total}</span> {currency_right}</h6>
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

        'css' => <<<CSS
    @media (max-width: 768px) {
         .myCardwidth{
              max-width: 100%!important;   
         }                 
                    
    }
    @media (min-width: 769px) {
         .myCardwidth{
              max-width: 25%!important;   
         }                 
                    
    }
    
    .basket-image{
        width: 100%;
        height: 150px;
        background-repeat:no-repeat;
        background-position:center;
        background-size:cover;
    }
    
CSS,

        'property' => <<<HTML
            <li><span class="text-black-50">{property} : </span>{value}</li>
HTML,

        'js' => <<<JS

    $(document).ready(function() {
        var t = $('#example').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false,
            responsive: true,
            colReorder: true,
            columnDefs: [
                 { responsivePriority: 1, target: 0 },
                 { responsivePriority: 2, target: -1 }
            ],
            rowGroup: {
                dataSrc:[
                    3
                 ]
            },
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "target": 0
        } ],
            "order": [[ 1, 'asc' ]],
            autoWidth: false,
            "pagingType": "simple_numbers",
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
        },
            "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
                               
         let arr = api
                .column( 5 )
                .data();
         let tolatishe=0;
         var totals = $('.ztotal');
         totals.each(function(key, view) {
           tolatishe+= parseInt($(view).text().trim())

           
         })
         
	    $( api.column( 0 ).footer() ).html('Total');
             $( api.column( 4 ).footer() ).html(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'UZS' }).format(tolatishe));
             
        },
            "processing": true,
            });
             t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
        
    });
    
   
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
                    amount: 0,
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
            var newTotal = String(value.innerHTML).split(" ");
                sum = '';
                $.each(newTotal,function(key,value) {
                     sum+=value;
                });
             
                total += parseFloat(sum);
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
        $this->fileJs('https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js');
        $this->fileJs('https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js');

        $this->fileCss('https://cdn.datatables.net/1.10.21/css/dataTables.uikit.min.css');
        $this->fileCss('https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css');
        $this->fileCss('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css');
        $this->fileCss('https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css');
        $this->fileCss('https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css');
    }

    public function codes()
    {

        /** @var SingleProductItem[] $cart */
        $cart = Az::$app->market->cart->cartOrders(null, false);

        //vdd($cart);
        $products_code = '';

        foreach ($cart as $key => $product) {
            $properties_code = '';
            foreach ($product->properties as $property) {
                $properties_code .= strtr($this->_layout['property'], [
                    '{property}' => $property->name,
                    '{value}' => $property->items[array_key_first($property->items)] ?? ''
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
                '{company_name}' => $product->company_name,
                '{company_url}' => $product->company_url,
                '{image}' => $product->images[0],
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

                '{catalog_id}' => $product->catalogId ?? 0
            ]);
            //break;
        }

        $this->htm = strtr($this->_layout['main'], [
            '{products}' => $products_code,
            '{summ}' => ZSummaryBasketWidget::widget()
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->_config['class'],
            '{priceFormat}' => ZPriceFormatWidget1::widget([

            ]),
        ]);

    }

}

