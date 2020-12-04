<?php

/**
 *If you dont know how to make a WIDGET, dont touch these codes. !!!!!!!!
 *
 * Author: Zoirjon Sobirov
 *
 */

namespace zetsoft\widgets\market;

use zetsoft\models\App\eyuf\TreeProduct;
use zetsoft\system\kernels\ZWidget;

class ZProductBoxWidget extends ZWidget
{
    /**
     * Configuration
     */




// Enter the vaild data only
    public $config = [];
    public $_config = [
        'currency'      =>'$',
        'sort'          =>['Price','Name','Order','Value'],
        'quantities'    =>["10","20","30","40"],
        'heart_icon'    => "far fa-heart fa-lg",
        'compare_icon'  =>"fas fa-link fa-lg",
        'addToCartIcon' =>'fas fa-cart-arrow-down fa-lg',
        'currentPage'   =>5,
        'lastPage'      =>15,
        'products'      =>[
            [
                'srcImg'            => 'https://planimetria.com.ua/img/catalogue/bb/12/bb-16d4079b7f6b0.jpg',
                'altImgText'        => 'To see the image here You need to update your Browser ',
                'productGroup'      => 'Home Applience',
                'productType'       => 'Smart Led',
                'productName'       => 'Samsung Smart Led Tv 42',
                'productDetailText' =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem atque dolores aliquid culpa maiores beatae est quod officia veniam fugit? Molestiae, illum voluptatibus nisi error recusandae cum expedita. Laborum, expedita!',
                'star'              => 4,         //Maximum 5 !
                'layer_link'        => '#',      //Link of product detail
                'price'             => 120.00,
                'discountPrice'     => 150.00,

            ],

            

        ],

    ];

/***************************************************    DO   NOT    TOUCH   *************************************************************/
    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public function asset(){
        $this->fileCss('https://cdn.jsdelivr.net/npm/animate.css@3.7.2/animate.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css');
        $this->fileCss('\render\market\ZProductBoxWidget\assets\css\style.css');

    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                <div class="product-box">
                    <div class="cat-box d-flex justify-content-between">
                        <!-- Nav tabs -->
                        <div class="view">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#grid"><i class="fa fa-th-list"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#list"><i class="fa fa-th-large"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="sortby">
                            <span>Sort By</span>
                            <select class="sort-box">
                                {sort}
                            </select>
                        </div>
                        <div class="show-item">
                            <span>Show</span>
                            <select class="show-box">
                                {quantityOfProducts}
                            </select>
                        </div>
                        <div class="page">
                            <p>Page {currentPage} of {lastPage}</p>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="list" role="tabpanel">
                               <div class="row">
                                  {content}
                              </div>
                            
                        </div>                           
                          <div class="tab-pane fade" id="grid" role="tabpanel">
                            {tabDiv}                               
                         </div>
                    </div>
               </div>
HTML,
 'js'=> <<<JS
    
    // Add To Cart Ajax Utilization
    // $('button').click(function (event) {
    //     overlay.show();
    //     var itemId = parseInt($(this).data('item'));
    //     $.ajax({
    //         type: "POST",
    //         url: '/products/add-to-cart-utilization',
    //         data: {id: itemId},
    //         success: function (response) {
    //             $.pjax.reload({
    //                 container: "#header_cart"
    //             }).done(function () {
    //                 if ($("#page_cart").length) {
    //                     $.pjax.reload({
    //                         container: "#page_cart"
    //                     }).done(function () {
    //                         overlay.hide();
    //                     });
    //                 } else {
    //                     overlay.hide();
    //                 }
    //             });
    //         },
    //         error: function (response) {
    //             console.log(response);
    //         }
    //     });
    //     e.preventDefault();
    // });

JS,


        'css' => <<<CSS
   .tab-content > .tab-pane, .pill-content > .pill-pane {
    display: block;
    height: 0;
    overflow-y: inherit;
    }
    .fa-lg {
    padding: 15px 10px;
    }
    .category .product-box .tab-content .tab-pane .tab-item .img-content a {
    width: 50px;
    height: 50px;
    padding: 0px;
    }
    
CSS,
    ];

    public function codes()
    {
        $content = '';
        $products = TreeProduct::find()->all();
        foreach ($products as $product) {
            $imgSrc         = $product['photo']; //from db
            $altImgText     = $this->_config['products']['altImgText'];
            $productGroup   = $this->_config['products']['productGroup'];
            $productType    = $this->_config['products']['productType'];
            $productName    = $product['name']; //from db
            $star           = $this->_config['products']['star'];
            $layer_link     = $this->_config['products']['layer_link'];
            $price          = $product['price'];
            $disCountPrice  = $product['discountPrice'];
            $IconHeart      = $this->_config['heart_icon'];
            $IconCompare    = $this->_config['compare_icon'];
            $addTocartIcon  = $this->_config['addToCartIcon'];
            $currency       = $this->_config['currency'];
            $content .= "
                    <div class='col-md-4'>  
                       <div class='tab-item'>
                        <div class='tab-img'>
                            <img class='main-img img-fluid' src='$imgSrc' alt='$altImgText'>             <div class='layer-box'>
                               <a href='' class='it-comp' data-toggle='tooltip' data-placement='left' title='' data-original-title='Compare'>
                                   <i class=' implode($IconHeart)'></i>
                               </a>
                               <a href='' class='it-fav' data-toggle='tooltip' data-placement='left' title='' data-original-title='Favourite'>
                                     <i class=' implode($IconCompare)'></i>
                               </a>
                                 </div>
                         </div>
                         <div class='tab-heading'>
                              <p><a href=''>$productName</a></p>
                         </div>
                         <div class='img-content d-flex justify-content-between'>
                             <div>
                                <ul class='list-unstyled list-inline fav'>
                                   <li class='list-inline - item'>
                                   
                                       <i class='fa fa-star'></i>
                                       
                                   </li>        
                                </ul>
                                <ul class='list-unstyled list-inline price'>
                                    <li class='list-inline-item'>$currency$price</li>
                                       <li class='list-inline-item'>$currency$disCountPrice</li>
                                </ul>
                             </div>
                         <div>
                            <a href='#' data-toggle='tooltip' data-placement='top' title='' data-original-title='Add to Cart' id='addToCart_id'><i class='$addTocartIcon'></i></a>
                          </div>
                   </div>
                 </div>
                 </div>";


        }
        $tabDiv='';

        foreach ($this->_config['products'] as $tabMenu) {
            $imgSrcTab              = $tabMenu['srcImg'];
            $altImgText             = $tabMenu['altImgText'];
            $productGroupTab        = $tabMenu['productGroup'];
            $productTypeTab         = $tabMenu['productType'];
            $productNameTab         = $tabMenu['productName'];
            $starTab                = $tabMenu['star'];
            $ProductDetailTextTab   = $tabMenu['productDetailText'];
            $layer_linkTab          = $tabMenu['layer_link'];
            $priceTab               = $tabMenu['price'];
            $disCountPriceTab       = $tabMenu['discountPrice'];
            $IconHeartTab           = $this->_config['heart_icon'];
            $IconCompareTab         = $this->_config['compare_icon'];
            $addTocartIconTab       = $this->_config['addToCartIcon'];
            $currencyTab            = $this->_config['currency'];
            $currentPage            = $this->_config['currentPage'];

$tabDiv .= "<div class='col-lg-12 col-md-6'>
                                    <div class='tab-item2'>
                                        <div class='row'>
                                            <div class='col-lg-4 col-md-12'>
                                                <div class='tab-img'>
                                                    <img class='main-img img-fluid' src='$imgSrcTab' alt='$altImgText'>
                                                </div>
                                            </div>
                                            <div class='col-lg-8 col-md-12'>
                                                <div class='item-heading d-flex justify-content-between'>
                                                    <div class='item-top'>
                                                        <ul class='list-unstyled list-inline cate'>
                                                            <li class='list-inline-item'><a href='#'>$productGroupTab</a></li>
                                                            <li class='list-inline-item'><a href='#'>$productTypeTab</a></li>
                                                        </ul>
                                                        <p><a href=''>$productNameTab'</a></p>
                                                        <ul class='list-unstyled list-inline fav'>
                                                           
                                                            <li class='list-inline - item'>
                                                               <i class='fa fa-star'></i>
                                                            </li>
                                                       
                                                        </ul>
                                                    </div>
                                                    <div class='item-price'>
                                                        <ul class='list-unstyled list-inline price'>
                                                            <li class='list-inline-item'>$currencyTab$priceTab</li>
                                                            <li class='list-inline-item'>$currencyTab$disCountPriceTab</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class='item-content'>
                                                    <p>$ProductDetailTextTab</p>
                                                        <a href='' class='it-cart'><span class='it-img'><i class='$addTocartIconTab' ></i></span><span class='it-title'>Add To Cart</span></a>
                                                         <a href='' class='it-fav' data-toggle='tooltip' data-placement='top' title='' data-original-title='Favourite'></a>
                                                         <a href='' class='it-comp' data-toggle='tooltip' data-placement='top' title='' data-original-title='Compare'><i class='fa fa-line fa-lg'> </i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
        }

        $sortDiv ='';
        foreach ($this->_config['sort'] as $sort) {
            $sortDiv .= "<option> $sort </option>";
        }
        $quan='';
        foreach ($this->_config['quantities'] as $quantity) {
            $quan .="
                 <option>$quantity</option>";
        }
        $currentPage = $this -> _config['currentPage'];
        $lastpage    = $this -> _config['lastPage'];

        $this->htm .= strtr($this->_layout['main'], [
            '{sort}'                => $sortDiv,
            '{quantityOfProducts}'  => $quan,
            '{content}'             => $content,
            '{tabDiv}'              =>$tabDiv,
            '{currentPage}'         => $currentPage,
            '{lastPage}'            => $lastpage,
        ]);

        $this->css = strtr($this->_layout['css'], []);
    }

}

