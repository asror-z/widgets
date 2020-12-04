<?php

/**
 *
 *
 * Author:  Khojiakbar Kodirov
 *
 */

namespace zetsoft\widgets\other\market;


use zetsoft\system\kernels\ZWidget;

class ZSlickWidgetOld extends ZWidget
{

    public $config =[];
    public $_config =[
        'products' =>[
            [
                'imageSrc'=>'https://images-na.ssl-images-amazon.com/images/I/81onGam-RcL._AC_SX355_.jpg',
                'product-name'=>'Product Name Here',
                'title'=>'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
                'comment'=>'You can type here aby additional comment',

            ],
            [
                'imageSrc'=>'https://bit.ly/2zetKEP',
                'product-name'=>'Product Name Here',
                'title'=>'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
                'comment'=>'You can type here aby additional comment',
            ],
            [
                'imageSrc'=>'https://bit.ly/2zetKEP',
                'product-name'=>'Product Name Here',
                'title'=>'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
                'comment'=>'You can type here aby additional comment',
            ],
            [
                'imageSrc'=>'https://bit.ly/2zetKEP',
                'product-name'=>'Product Name Here',
                'title'=>'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
                'comment'=>'You can type here aby additional comment',
            ],

        ]


    ];



    public $event =[];
    public $_event=[];


    public function asset()
    {
  /*      $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css');
        $this->fileCss('"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');*/
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js');

    }

    public $layout=[];
    public $_layout=[
        'main' => <<<HTML
           <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bt-deal">
                                <div class="bt-body owl-carousel">
                                  {content}   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
            </div>
HTML,

        'css' => <<<CSS
        .bt-deal {
            padding: 20px 20px 0;
            margin-bottom: 30px;
        }

        .bt-items{
          margin: 10px ;
        }
        
         
        
        .owl-prev {
          width: 15px;
          height: 50px;
          position: absolute;
          top: 40%;
          margin-left: -20px;
          display: block !important;
          border:0px solid black;
        }

        .owl-next {
          width: 15px;
          height: 50px;
          position: absolute;
          top: 40%;
          right: -25px;
          display: block !important;
          border:0px solid black;
        }
        .owl-prev i, .owl-next i {transform : scale(1,6); color: #ccc;}
        .card-body{
            border-left: 1px solid grey ;
        }
CSS,
        'js' => <<<JS
            $(document).ready(function(){
                $(".bt-body").owlCarousel({
                autoplay:true,
                autoplayHoverPause:false,
                smartSpeed:500,
                loop: true,
                responsiveClass: true,
                items : 2,
                nav : true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                margin:0,
                dots: false,
            });   
            }) ;
            

JS,

    ];

    public function codes()
    {
        $content = '';
        foreach ($this->_config['products'] as $product) {
            $src            = $product['imageSrc'];
            $productName    = $product['product-name'] ;
            $description    = $product['title'] ;
            $comment        = $product['comment'] ;

            $content .= "
                                    <div class='bt-items'>
                                        <div class='card mb-3' style='width: 540px;'>
                                            <div class='row no-gutters'>
                                                <div class='col-md-4'>
                                                    <img src='$src' class='card-img' alt='ImagePlace>
                                                </div>
                                                <div class='col-md-8'>
                                                     <div class='card-body'>
                                                        <h5 class='card-title'>$productName</h5>
                                                        <p class='card-text'>$description</p>
                                                        <p class='card-text'><small class='text-muted'>$comment</small></p>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            ";

        }
        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
        ]);

        $this->css .= ($this->_layout['css']);
        $this->js .= ($this->_layout['js']);
    }
}
