<?php

/**
 *
 *
 * Author:  Daho
 *
 */

namespace zetsoft\widgets\cards;


use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;

class ZProductCardWidgetDynamic extends ZWidget
{
    public $config = [];
    public $_config = [
        'card-img' => 'https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg' ,
        'name' => 'Samsung Smart Led Tv 42',
        'price' => '$500',
        'price_old' =>'$650',
        'card_event' => ZProductCardWidgetDynamic::card_name['none'],
        'theme' => self::themes['lightBlue'],
    ];

    public const themes = [
        'default' => 'default',
        'lightBlue' => 'lightBlue',

    ];

    public const card_name = [
        'sale' => 'sale',
        'new' => 'new',
        'none' => 'none',
    ];

    public const event_color = [
        'red' => 'red',
        'blue' => 'blue',
        'none' => 'none'
    ];

    public $layout = [];
    public $_layout = [
         'card' => <<<HTML
        <!-- Card -->
        <div class="card">

  <!-- Card image -->
  <div class="view overlay">
    <img class="card-img-top" src="{card-img}"
      alt="Card image cap">
    <a href="#!">
      <div class="massa" style="color: {color}; display: {display};">{card_event}</div>
    </a>
    <div class="hover_box">
          <a href="#!" class="dume">
           <i class="far fa-heart"></i>
           </a>
           <a href="#!" class="dume">
             <i class="fas fa-exchange-alt"></i>
           </a>
    
</div>
  </div>

  <!-- Card content -->
  <div class="card-body">
        <div class="tab-heading">
            <p><a href="">{name}</a></p>
        </div>
        <div class="img-content d-flex justify-content-between">
            <div>
                <ul class="list-unstyled list-inline fav">
                        {raiting}
                </ul>
                <ul class="list-unstyled list-inline price">
                    <li class="list-inline-item">{price}</li>
                    <li class="list-inline-item"><del>{price_old}</del></li>
                </ul>
            </div>
            <div class="korzina">
                <a href="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
   
  </div>

</div>
<!-- Card -->
HTML,
    'style' => <<<CSS
        .category .product-box .tab-content .tab-pane .tab-item {
            overflow: hidden;
            border: 1px solid #eeeeee;
            margin-bottom: 30px;
        }
        .view .hover_box{
            position: absolute;
            top: 15px;
            right: -50px;
            display:flex;
            flex-direction: column;
            transition: 100ms;
        }
        .view:hover .hover_box{
            right: 10px;
        } 
        .dume{
        background: white;
            display:flex;
            justify-content:center;
            align-items: center;
            padding: 5px 7px;
            border: 1px solid #dddddd;
            border-radius: 50%;
            margin-top: 15px;  
        }
        .tab-img {
            margin-bottom: 10px;
            position: relative;
        }
        .tab-item .tab-img img.main-img {
            /*max-width: 100%;*/

            height: 280px;
            width: 250px;
        }
        .tab-item .tab-img img.sec-img {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            transition: 0.5s ease;
            opacity: 0;
            visibility: hidden;
            max-width: 100%;
        }
        .tab-item .tab-img .layer-box a.it-comp {
            margin-top: 60px;
            -webkit-transition-delay: 0.1s;
            -o-transition-delay: 0.1s;
            transition-delay: 0.1s;
        }
        .tab-item .tab-img .layer-box a {
            border: 1px solid #dddddd;
            padding: 5px 7px;
            border-radius: 50%;
            background: #fff;
            position: absolute;
            top: 0;
            right: -45px;
            margin-right: 10px;
            transition: 0.3s ease;
            z-index: 9;
            opacity: 0;
            visibility: hidden;
        }
        .tab-item .tab-heading p {
            margin-bottom: 6px;
            padding: 0 15px;
        }
        
        .tab-item .tab-heading p a {
            font-size: 16px;
            color: #5677fc;
            font-weight: 600;
        }
        .tab-item .img-content {   /*mawinga img-content d-flex justify-between*/
            padding: 0 15px 10px;
        }
        .tab-item .img-content ul.fav {
            margin-bottom: 6px;
        }
        .tab-item .img-content ul.fav li {
            margin: 0;
        }
        .list-inline-item {
            display: inline-block;
            color:{stars};
        }
        .list-inline {
            padding-left: 0;
            list-style: none;
        }
        .list-inline.price .list-inline-item {
        color: {prices};
        }
        .tab-item .img-content ul.price li {
            font-size: 18px;
            color: #444444;
            font-weight: 600;
            letter-spacing: 0;
        }
        .list-inline-item:not(:last-child) {
            margin-right: .5rem;
        }
        .tab-item .img-content ul.price li:last-child {
            font-size: 14px;
            color: #969696;
            font-weight: normal;
            text-decoration: line-through;
        }
        .tab-item .img-content ul.price li {
            font-size: 18px;
            color: #444444;
            font-weight: 600;
            letter-spacing: 0;
        }
        .tab-item .img-content a {
            background: #eeeeee;
            display: inline-block;
            padding: 10px 12px;
            border: 1px solid #dddddd;
            border-radius: 50%;
            margin-top: 8px;
        }
        .korzina {
            width: 43px;
            height: 42px;
            border: 1px solid grey;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
                
        }
        
        .fa-shopping-cart{
        color: {basket};
        }
        .tab-heading p a{
        color: {headingText};
        }
        
        .massa{
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    background: #e45151;
    text-transform: uppercase;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    text-align: center;
    padding-top: 12px;
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
    margin-left: 10px;
    margin-top: 10px;
}


CSS,


    ];

    public function codes()
    {
        $color = '';
        $display = '';
        $colorNew = ZProductCardWidgetDynamic::card_name['new'];
        $colorSale = ZProductCardWidgetDynamic::card_name['sale'];
        $colorNone = ZProductCardWidgetDynamic::card_name['none'];

        if($colorNew === true) {
          $color = ZProductCardWidgetDynamic::event_color['blue'];
        }else {

        }

        if($colorSale === true) {
            $color = ZProductCardWidgetDynamic::event_color['red'];
        }else {
        }

        if($colorNone === true) {
            $color = '';
           $display = ZProductCardWidgetDynamic::event_color['none'];
        } else {

        }
         $this->htm = strtr($this->_layout['card'],[
            '{card-img}' => $this-> _config['card-img'] ,
            '{name}' => $this-> _config['name'] ,
            '{price}' => $this-> _config['price'],
            '{price_old}' => $this-> _config['price_old'] ,
            '{card_event}' => $this->_config['card_event'] ,
            '{color}' => $color,
            '{display}' => $display,
             '{raiting}' => ZKStarRatingWidget::widget([
                 'name' =>'name']),
         ]);

         $this->css = $this->_layout['style'];

        switch ($this->_config['theme']) {

            case 'default':
            {
                $this->css = strtr($this->_layout['style'], [
                    '{basket}' => ZColor::color['default-color'],
                    '{stars}' => ZColor::color['black'],
                    '{prices}' => ZColor::color['grey'],
                    '{headingText}' => ZColor::color['blue'],
                ]);
                break;
            }
            case 'lightBlue':
            {
                $this->css = strtr($this->_layout['style'], [
                '{basket}' => ZColor::color['blue-grey'],
                '{stars}' => ZColor::color['rgba-blue-grey-slight'],
                '{prices}' => ZColor::color['brown'],
                '{headingText}' => ZColor::color['lighten-blue'],
            ]);
                break;
            }
        }
    }
}
