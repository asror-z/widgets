<?php

/**
 *
 *
 * Author:  Daho
 *
 */

namespace zetsoft\widgets\cards;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;

class ZProductCardWidget extends ZWidget

{
    public $config = [];
    public $_config = [

        'card-img' => 'https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg',
        'name' => 'Samsung Smart Led Tv 42',
        'title' => 'Наш интернет-магазин дает возможность телевизоры Samsung купить недорого. ',
        'price' => '$500',
        'price_old' => '$1000',
        'card_event' => ZProductCardWidget::card_name['none'],
        'class' => 'zetColor',

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
    <a href="{url}">
    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/food.jpg" alt="Card image cap">
      <div class="mask rgba-white-slight"></div>
    </a>
  </div>
    <div class="hover_box">
           <a href="#!" class="btn-floating btn-action ml-auto mr-4 purple-gradient float-right" data-toggle="tooltip" title="Like">
              <i class="far fa-heart" aria-hidden="true"></i>
           </a>
           <a href="#!" class="btn-floating btn-action ml-auto mr-4 mdb-color lighten-3 float-right">
             <i class="fas fa-exchange-alt" data-toggle="tooltip" title="Exchange"></i>
           </a>
    </div>

  <!-- Card content -->
  <div class="container card-body">
        <div class="container pt-4">
            <h3>{name}</h3>
            <p>{title}</p>
        </div>
        
        <div class="img-content d-flex justify-content-between">
        
                <div class="container pt-3">
                    {raiting}
                
                
                 <ul class="list-unstyled list-inline price pt-3">
                    <li class="list-inline-item btn-lg"><del>{price_old}</del></li>
                    <span class="counter">-50%</span>
                    <li class="chip btn-lg">{price}</li>
                    
                 </ul>
                

                <a href="" data-toggle="tooltip" data-placement="top" class="btn-floating {class} float-right" title="Add to Cart"><i class="fas fa-shopping-cart {class}"></i>
                </a>
                </div>
        </div>
  </div>

</div>
<!-- Card -->
HTML,
        'js' => <<<JS
 
         $(document).ready(function() {
            $('.rateMe2').mdbRate();
        });
JS,


    ];

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js');
        /*$this->fileCss('render/market/ZProductCardWidget/assets/style.css');*/
    }

    public function codes()
    {
        $color = '';
        $display = '';
        $colorNew = ZProductCardWidget::card_name['new'];
        $colorSale = ZProductCardWidget::card_name['sale'];
        $colorNone = ZProductCardWidget::card_name['none'];

        if ($colorNew === true) {
            $color = ZProductCardWidget::event_color['blue'];
        } else {

        }

        if ($colorSale === true) {
            $color = ZProductCardWidget::event_color['red'];
        } else {
        }

        if ($colorNone === true) {
            $color = '';
            $display = ZProductCardWidget::event_color['none'];
        } else {

        }
        $this->htm = strtr($this->_layout['card'], [
            '{card-img}' => $this->_config['card-img'],
            '{name}' => $this->_config['name'],
            '{title}' => $this->_config['title'],
            '{price}' => $this->_config['price'],
            '{price_old}' => $this->_config['price_old'],
            '{card_event}' => $this->_config['card_event'],
            '{color}' => $color,
            '{display}' => $display,
            '{class}' => $this->_config['class'],
            '{raiting}' => ZKStarRatingWidget::widget([
                'name' => 'name']),
        ]);

        $this->js = $this->_layout['js'];

        /*$this->htm = strtr($this->_config['class'],[
            '{class}' => $this->_config['class']
        ]);*/
    }
}
