<?php


namespace zetsoft\widgets\yandex;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;


use zetsoft\widgets\market\ZCartReviewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
class ZYPriceWidget extends ZWidget
{
    public $config = [


    ];
    public $_config = [

        'img' => 'https://pbs.twimg.com/profile_images/823569976342773760/c2RLAG7h_400x400.jpg',
        'product_url' => 'https://market.yandex.ru/product--fotoapparat-canon-eos-m50-kit/30898326/offers?track=tabs&local-offers-first=0',
        'product_name' => 'Fotografiya',
        'about' => 'Духовой шкаф электрический',
        'market_info' => 'Наличный, б/н расчёт. Бесплатная утилизация!',
        'feedback_count' => '885 654 отзывов',
        'to_favorites' => 'В избранное',
        'discount' => '79 7876 $',
        'price' => '77 558 $',
        'map' => 'Пункты самовывоза на карте',
        'order' => 'на заказ',
        'payment' => 'Оплата наличными курьеру',
        'chat' => '<i class="fas fa-comment mr-1"></i>Чат',
        'delivery' => 'Все варианты доставки',
        'phone' => 'Показать телефон',
        'market' => 'market.ru',
        'to_market' => 'В магазин',
        'phone_number' => '+998998154828',
        'is_sale'=>true,
    ];

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="container mn-container">
            <div class="row pt-4">
                {items}
            </div>
        </div>
HTML,
        'info' => <<<HTML
     <div class="col-md-6">
            <div class="row">
                <div class="col-md-2 pt-2">
                    <div class=">
                        <a href="{product_url}">
                        <span>
                            <img src="{img}" class="w-100 rounded-circle pre-img" >
                        </span>
                    </a>
                    </div>
                </div>
                <div class="col-md-10">

                    <a href="" class="text-decoration-none">
                        <h3 class="pr-font">{product_name}</h3>
                    </a>
                    <div>
                        <p>{about}</p>
                    </div>

                    <div>
                        <p>{market_info}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{product_url}" class="text-decoration-none m-font">{market}</a>
                        </div>
                        <div class="col-md-4">
                            {starRating}
                        </div>
                        <div class="col-md-4">
                            <a href="" class="text-decoration-none  small fd-font">{feedback_count}</a>
                        </div>
                    </div>
                    <div class="row ml-6">
                        <div class="col-md-4">
                            <a href="#"  class="fav-click text-decoration-none text-muted" ><i class="far fa-heart mr-2 rev-fav"></i>{to_favorites}</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="show-phone text-decoration-none text-muted"><i class="fas fa-phone-alt mr-2 rev-phone"></i><span class="show-phone-number">{phone}</span></a>
                        </div>
                    </div>
                </div>

            </div>            

        </div>
    <div class="col-md-4 offset-md-2">
            <div class="row">
                <a class="row col-md-7 d-{sale} text-decoration-none">
                    <h5 class="price-font pr-sale">{discount}</h5>
                </a>
                <a class="row col-md-7 text-decoration-none" href="">
                    <h3 class="price-font">{price}</h3>
                </a>

            </div>
            <div class="row small">
                <a href="" class="text-decoration-none text-muted">
                    <span><i class="fas fa-map-marker-alt ml-1 mr-3"></i>{map}</span>
                </a>
            </div>
            <div class="row text-decoration-none  text-muted small">  <span><i class="fas fa-truck mr-2"></i>{order}</span></div>
            <div class="row">
                <a href="" class="text-decoration-none text-muted small">
                    <span>{delivery}</span>
                </a>
            </div>
            <div class="row text-decoration-none  small text-muted">{payment}</div>
            <div class="row pt-4">
                <div class="col-mad-6">
                    {to_market}
                </div>
                <div class="col-mad-6">
                    {chat}
                </div>
            </div>

             



        </div>  
HTML,

        'css' => <<<CSS
 .pre-img{
        padding: 1px;
        border:2px solid limegreen;
        border-radius: 50px;

    }
    .mn-container div,span,p,a {
         font-family: YS;
     }
    .mn-container{
        border: 1px solid limegreen;
        border-radius: 15px;
        font-family: YS;
    }
    .pr-font{
        font-family: YS;
        /*font-family: Lucida Bright;*/
        color: #0f0f0f;
    }
    .price-font{
        /*font-family: Garamond;*/
        font-family: YS;
        color: #0f0f0f;

    }
    .fd-font{
        color: #0f0f0f;
        font-family: YS;

    }
    .m-font{
        font-family: YS;
        color: #0f0f0f;
    }

    .pr-sale{
        font-family: YS;
        text-decoration: line-through;
        color: #e30800;

    }
    .rating-md {
        font-size: 0;
    }
    .rating-md .caption{
        display: none;
        
    }
 

    
 
CSS,
        'jscode' => <<<JS
        $(document).ready(function(){
        $(".fav-click").click(function(){
        let element = document.querySelector(".rev-fav");
        element.style.color=element.style.color=='red'?'#6c757d':'red';
        });
        $(".show-phone").click(function(){
        let element = document.querySelector(".rev-phone");
        element.style.color=element.style.color=='limegreen'?'#6c757d':'limegreen';
        let phone = document.getElementsByClassName('show-phone-number');
        phone[0].innerHTML=element.style.color=='limegreen'?`{phone_number}`:`{phone}`;
        });
        });
        
        
        
JS,


    ];

    public function asset()
    {

    }

    public function codes()
    {

        $model = new UserCompany();



        $this->htm = strtr($this->_layout['main'], [
            '{starRating}' => ZKStarRatingWidget::widget([

            ]),
            '{items}' => strtr($this->_layout['info'], [

                '{starRating}' => ZKStarRatingWidget::widget([
                    'model' => $model,
                    'attribute' => 'name',

                ]),

                '{img}' => $this->_config['img'],
                '{product_url}' => $this->_config['product_url'],
                '{product_name}' => $this->_config['product_name'],
                '{about}' => $this->_config['about'],
                '{market_info}' => $this->_config['market_info'],
                '{feedback_count}' => $this->_config['feedback_count'],
                '{to_favorites}' => $this->_config['to_favorites'],
                '{phone}' => $this->_config['phone'],
                '{market}' => $this->_config['market'],
                '{order}' => $this->_config['order'],
                '{delivery}' => $this->_config['delivery'],
                '{chat}' => ZButtonWidget::widget([
                    'config' => [
                        'text'=>$this->_config['chat'],
                        'class'=>'btn btn-outline-primary ml-2',
                        'btnRounded'=>false
                    ]
                ]),
                '{to_market}' => ZButtonWidget::widget([
                         'config' => [
                            'text'=>$this->_config['to_market'],
                             'class'=>'btn btn-success',
                             'btnRounded'=>false
                         ]
                ]),
                '{price}' => $this->_config['price'],
                '{map}' => $this->_config['map'],
                '{payment}' => $this->_config['payment'],
                '{discount}' => $this->_config['discount']?$this->_config['discount']:'',

            ]),
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['jscode'], [
            '{phone_number}' => $this->_config['phone_number'],
            '{phone}' => $this->_config['phone']
        ]);


    }
}
