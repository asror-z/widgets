<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\cards;


use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZLebazarCardWidget extends Zwidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['featureVertical'],
        'name' => 'Hello!!!',
        'currency' => '$',
        'price' => '100',
        'price_old' => '70',
        'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'cardImage100x100' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'cardImage650x700' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'categoryName' => 'SMart LEd',
        'isSale' => 'd-none',
    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [
        'click' => ' console.log("ZCartReviewWidget | $eventClick") ',
        'dblclick' => ' console.log("ZCartReviewWidget | $eventDblclick") ',
        'mouseenter' => ' console.log("ZCartReviewWidget | $eventMouseEnter") ',
        'mouseleave' => ' console.log("ZCartReviewWidget | $eventMouseLeave") ',
        'keyup' => ' console.log("ZCartReviewWidget | $eventKeyup") ',
        'onload' => 'console.log("ZCartReviewWidget | $eventOnLoad")',
        'onclick' => 'console.log("ZCartReviewWidget | $eventOnClick")',
    ];

    /*
     * Constants
     * */
    public const type = [
        'featureHorizontal' => 'featureHorizontal',
        'featureVertical' => 'featureVertical',
        'bestDeals' => 'bestDeals',
    ];


    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'featureVertical' => <<<HTML
            <div class="row">
            <div class="col-md-12">
             <div class="col-md-4 card-lb">
                <div class="card-lb-header">
                    <img src="{cardImage650x700}" alt="">
                </div>
                <div class="card-lb-content">
                    <h3>{name}</h3>
                    <div class="d-flex card-lb-content--items">
                        <p class="card-lb-price">{currency}{price}</p>
                        <p class="card-price-env">UZS for 1pc</p>
                    </div>
                </div>
                <div class="card-lb-footer">
                    <button class="btn btn-outline-success card-lb-btn" id="{id}">Add to card</button>
                </div>
            </div>
</div>
</div>
            

   
      
HTML,

        'featureHorizontal' => <<<HTML
 <div class="col-md-3 card-lb">
                <div class="card-lb-header">
                    <img src="{cardImage650x700}" alt="">
                </div>
                <div class="card-lb-content">
                    <h3>{name}</h3>
                    <div class="d-flex card-lb-content--items">
                        <p class="card-lb-price">{currency}{price}</p>
                        <p class="card-price-env">UZS for 1pc</p>
                    </div>
                </div>
                <div class="card-lb-footer" id="card_footer_{id}">
                    <button class="btn btn-outline-success card-lb-btn" id="{id}">Add to card</button>
                </div>
            </div>
                                          
HTML,

        'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave})
            .on('onload',{onload})
            .on('onclick',{onclick});


            
JS,

        'css' => <<<CSS


CSS,

        'js' => <<<JS
            
    $('#{id}').hide();
    $('.card-lb').mouseleave(  function() {
        $('#{id}').hide();
    })

    $('.card-lb').mouseover( function() {
        $('#{id}').show();
    });

    let templ = "<div class='card-lb-counter d-flex' style='margin-left:10%'>" +
        "<button id='minCount' onclick='minus()' type='button' disabled class='btn btn-success minCounter' style='opacity: 0.2; cursor: no-drop'" +
         "'>-</button>"+ "<div style='width: 50%; border: 1px solid lightgray' " +
          "class='counters'>1</div>" +"<button class='btn btn-success addCounter{id}' type='button' '" +
           " '>+</button>"+
        "</div>";

    let shopIcon = "<i id='iconShop' class=\"fas fa-shopping-cart ml-auto\"></i>";

    let badge = "<div class='badge-counter' style='width: 50px; text-align: center; height: 50px;background-color:green; color: white; border-radius: 50%;position: absolute; top: 2%;right: 5%'>1</div>";




    let cardLengt = $('.card-lb').length;
    
    
    let butt = $('.card-lb-btn');
    butt.on('click', function () {
        counts = 0;
        
        let btn = $(this);
        let parent_s_header = null;
        let parent_s_footer = btn.parent('.card-lb-footer');
        parent_s_header = parent_s_footer.siblings('.card-lb-header');
        parent_s_header.append(badge);
        $(this).remove();
        parent_s_footer.html(templ);
        let url = "/render/market/LeBazar Card/counter.js";
        $.ajax({
            url: url,
            method:'GET',
            success: function(response) {
              
            },
            error: function (event) {
              console.log(e);
            }
        })
      /*  $.getScript(url, function() {
            $('.addCounter').click(function() {
               let counters_parent = $(this).siblings(getHTMLElement);
               console.log(counters_parent);
               counters_parent.text(count+=1);
               let plusValue = $('.counters').html();
               $('.minCounter').removeAttr('disabled');
               $('#minCount').css({'opacity':'1', 'cursor':'pointer'});
                $('#badgeCounter').html(plusValue);
                $('#basketBadge').html(plusValue);
            })
        });*/
    });
   
               
  
    

    function minCounter() {
        $('#cardCounter').html(count -=1);
        $('#badgeCounter').html(count -=0);
        $('#basketBadge').html(count -=0);
    }



    /***** Shopping Cart *****/
    $('.cart-btn').on('click', function (event){
        e.preventDefault();
        $('.cart-overlay').addClass('visible');
        $('.cart-body').addClass('open');
    });
    $('.close-cart, .cart-overlay').on('click', function (event){
        e.preventDefault();
        $('.cart-overlay').removeClass('visible');
        $('.cart-body').removeClass('open');
    });







JS,


    ];

    public function asset()
    {
        $this->fileCss('/render/market/LeBazar Card/card.css');
        $this->fileJs('/render/market/LeBazar Card/card.js');
    }

    public function codes()
    {
        /*$str = $this->model->title;
        if (strlen($str) > 10)
            $str = substr($str, 0, 7) . '...';*/

        $button_text = '';
        if ($this->_config['type'] === self::type['featureHorizontal']) $button_text = Az::l("Add To Cart");
        //vd($this->model->id);
        if ($this->model->id !== null)
        $addCart = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'icon' => 'fa fa-' . FA::_SHOPPING_CART,
                'text' => $button_text,
                //'type' => ZAjaxWidget::type['post'],
                //'color' => ZColor::color['white']
                /*'btnPaddingLeft' => ZButtonWidget::btnScale['0'],
                'btnPaddingRight' => ZButtonWidget::btnScale['0'],
                'btnPaddingTop' => ZButtonWidget::btnScale['0'],
                'btnPaddingBottom' => ZButtonWidget::btnScale['0'],*/
                'btnIconSize' => ZButtonWidget::btnScale['2.5'],
                'ajax' => true,
                'url' => ZUrl::to("/core/product/addToCart.aspx"),
                'data' => '{product_id:' . $this->model->id . '}'
            ],
            'event' => [
                'complete' => "function(data , textStatus , jqXHR){
                     console.log(data['responseText']);
                     $('#cart_total_amount').html(data['responseText']);
                }"
            ]
        ]);
        $addWish = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'icon' => 'fa fa-' . FA::_SHOPPING_CART,
                'text' => $button_text,
                //'type' => ZAjaxWidget::type['post'],
                //'color' => ZColor::color['white']
                /*'btnPaddingLeft' => ZButtonWidget::btnScale['0'],
                'btnPaddingRight' => ZButtonWidget::btnScale['0'],
                'btnPaddingTop' => ZButtonWidget::btnScale['0'],
                'btnPaddingBottom' => ZButtonWidget::btnScale['0'],*/
                'btnIconSize' => ZButtonWidget::btnScale['2.5'],
                'ajax' => true,
                'url' => ZUrl::to("/core/product/addToWish.aspx"),
                'data' => "{product_id:" . $this->model->id . '}'
            ],
            'event' => [
                'complete' => "function(data , textStatus , jqXHR){
                     console.log(data['responseText']);
                     $('#cart_total_amount').html(data['responseText']);
                }"
            ]
        ]);
        if (\Dash\count($this->model->properties) == 0) $addCart = '';
        /*vd($this->model->price);*/
        $min = Curry\min($this->model->price);
        $max = Curry\max($this->model->price);
        $minOld = Curry\min($this->model->price_old);
        $maxOld = Curry\max($this->model->price_old);
        if ($min !== $max)
            $price = Curry\min($this->model->price) . ' - ' . Curry\max($this->model->price);
        else
            $price = $min;
        $price_old = '';
        $isSale = 'd-none';
        if (!empty($this->model->price_old) && $this->model->price_old !== null) {
            if ($minOld !== $maxOld)
                $price_old = $minOld. ' - ' . $maxOld;
            else
                $price_old = $minOld;
            $isSale = '';
        }
        if (empty($this->model->price_old))
        {
            $isSale = 'd-none';
        }
            
        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{name}' => $this->model->name,
            '{price}' => $price,
            '{price_old}' => $price_old,
            '{cardImage100x100}' => $this->model->images[0],
            '{cardImage650x700}' => $this->model->images[0],
            '{currency}' => $this->model->currency,
            '{title}' => $this->model->title,
            '{categoryName}' => $this->model->categoryName,
            '{isSale}' => $isSale,
            '{addCart}' => $addCart,
            '{product_id}' => $this->model->id,
        ]);

        /*
         * Events
         * */
        $this->js = strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
          //  '{options}' => $this->model->properties,
        ]);
        /*
         * Css Code
         * */
        $this->css = $this->_layout['css'];
        $this->js =strtr($this->_layout['js'], [
            '{id}' => $this->id
    ]);
    }
}

