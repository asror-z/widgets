<?php

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;


/**
 *
 *
 * CreatedBy: PRZafar
 */
class ZLazyLoadTuupolaWidget extends ZWidget
{







    public function asset()
    {
        
    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <section class="product-area">
                <div class="bt-deal">
                    <div class="sec-title">
                        <h6>{title}</h6>
                    </div>
                    <div class="bt-body owl-carousel">
                        <div class="bt-items">
                            {content}
                        </div>
                        <div class="bt-items">
                            {content}
                        </div>
                    </div>
                </div>
            </section>            
HTML,
        'css' => <<<CSS
            .fa-angle-left{
              position: absolute;
              top: 4px;
              right: 8px; 
            }
             .fa-angle-right{
              position: absolute;
              top: 4px;
              left: 7px; 
             }
       
CSS,
        'js' => <<<JS
              $(".bt-body").owlCarousel({
        autoplay:false,
        autoplayHoverPause:true,
        smartSpeed:500,
        loop: true,
        responsiveClass: true,
        items : 1,
        nav : true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        margin: 0,
        dots: false,
    });
JS,


    ];


    public function codes()
    {
        $content = '';
        foreach ($this->_config['products'] as $product) {
            $src = $product['imageSrc'];
            $productName = $product['product-name'];
            $discount = $product['discountPrice'];
            $actual = $product['actualPrice'];
            $currency = $this->_config['currency'];

            $content .= "
                <div class='bt-box d-flex'>
                    <div class='bt-img'>
                        <a href=''><img src='$src' alt=''></a>
                    </div>
                    <div class='bt-content'>
                         <p><a href=''>$productName</a></p>
                         <ul class='list-unstyled list-inline fav'>
                            <li class='list-inline-item'><i class='fa fa-star'></i></li>
                            <li class='list-inline-item'><i class='fa fa-star'></i></li>
                            <li class='list-inline-item'><i class='fa fa-star'></i></li>
                            <li class='list-inline-item'><i class='fa fa-star'></i></li>
                            <li class='list-inline-item'><i class='fa fa-star-o'></i></li>
                         </ul>
                         <ul class='list-unstyled list-inline price'>
                            <li class='list-inline-item'>$currency$discount</li>
                            <li class='list-inline-item'>$currency$actual</li>
                         </ul>
                    </div>
                </div>
            ";

        }



        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
            '{title}' => $this->_config['title'],
        ]);
        $this->css = ($this->_layout['css']);
        $this->js = ($this->_layout['js']);
    }

}
