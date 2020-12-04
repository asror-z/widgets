<?php


namespace zetsoft\widgets\market;



use zetsoft\system\kernels\ZWidget;


/**
 * Created by Khojikabar Kodirov

 */

class ZSliderWidget extends ZWidget
{
    public $config = [];
    public $_config = [

    ];
    public $event = [];
    public $_event = [];

    public $layout = [];
    public $_layout = [
        'main'=> <<<HTML
        <section class="slider-area2">
        <div class="slider-wrapper owl-carousel">
            <div class="slider-item slider1">
            <div class="slider-table">
                <div class="slider-tablecell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-0">
                                <div class="img1" >
                                    <img src="https://bit.ly/3fzWbh6" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="slider-box">
                                    <div class="">
                                        <h4>Smartphone Deal</h4>
                                    </div>
                                    <div class="">
                                        <h1>Samsung Galaxy S8 | 89+</h1>
                                    </div>
                                    <div class="">
                                        <p>The Camera Re-Imagined</p>
                                    </div>
                                    <div class="">
                                        <a href="#">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="slider-item slider2">
            <div class="slider-table">
                <div class="slider-tablecell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-0">
                                <div class="img1" >
                                    <img src="https://bit.ly/3fzWbh6" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="slider-box">
                                    <div class="">
                                        <h4>Smartphone Deal</h4>
                                    </div>
                                    <div class="">
                                        <h1>Samsung Galaxy S9 | S9+</h1>
                                    </div>
                                    <div class="">
                                        <p>The Camera Re-Imagined</p>
                                    </div>
                                    <div class="">
                                        <a href="#">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
 HTML,
        'css'=><<<CSS
        
        .slider-area2 {
            margin-bottom: 30px;
        }

        .slider-area2 .slider-wrapper {
            position: relative;
            overflow: hidden;
        }

        .slider-area2 .slider-wrapper .slider-item {
            background: #f5f5f5;
            height: 600px;
        }

        .slider-area2 .slider-wrapper .slider-item .slider-table {
            display: table;
            width: 100%;
            height: 100%;
        }

        .slider-area2 .slider-wrapper .slider-item .slider-table .slider-tablecell {
            display: table-cell;
            vertical-align: middle;
        }

        .slider-area2 .slider-wrapper .slider-item .slider-table .slider-tablecell .slider-box {
            padding-top: 13%;
            padding-left: 50px;
        }

        .slider-area2 .slider-wrapper .slider-item .slider-table .slider-tablecell .slider-box .effect h4 {
            color: #e45151;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .slider-area2 .slider-wrapper .slider-item .slider-table .slider-tablecell .slider-box  h1 {
            font-size: 52px;
            color: #444444;
            letter-spacing: 0;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .slider-area2 .slider-wrapper .slider-item .slider-table .slider-tablecell .slider-box  p {
            font-size: 30px;
            margin-bottom: 35px;
        }

        .slider-area2 .slider-wrapper .slider-item .slider-table .slider-tablecell .slider-box  a {
            font-size: 16px;
            color: #fff;
            background: #5677fc;
            padding: 8px 20px;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            -ms-border-radius: 30px;
            border-radius: 30px;
        }

        .slider-area2 .slider-wrapper .slider-item .slider-table .slider-tablecell .slider-box a:hover {
            background: #e45151;
        }

        .slider-area2 .slider-wrapper .slider-item.slider2 .slider-table .slider-tablecell .slider-box {
            padding-left: 0;
        }

        .slider-area2 .slider-wrapper .owl-nav div {
            background: #fff;
            position: absolute;
            top: 50%;
            left: -45px;
            width: 42px;
            height: 42px;
            text-align-last: center;
            padding-top: 9px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            border-radius: 50%;
            z-index: 999;
            margin-top: -20px;
            -webkit-transition: 0.3s ease;
            -moz-transition: 0.3s ease;
            -ms-transition: 0.3s ease;
            -o-transition: 0.3s ease;
            transition: 0.3s ease;
            -webkit-box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
        }

        .slider-area2 .slider-wrapper .owl-nav div.owl-next {
            left: inherit;
            right: -45px;
        }
        .slider-area2 .slider-wrapper .owl-dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            margin-left: -15px;
        }

        .slider-area2 .slider-wrapper .owl-dots .owl-dot {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 2px solid #e45151;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            border-radius: 50%;
            margin: 2px;
        }

        .slider-area2 .slider-wrapper .owl-dots .owl-dot.active {
            background: #e45151;
        }

        .slider-area2 .slider-wrapper:hover .owl-nav div {
            opacity: 1;
            visibility: visible;
            left: 15px;
        }
        .owl-prev {
            width: 15px;
            height: 100px;
            position: absolute;
            top: 40%;
            left: 0px;
            display: block !important;
            border:0px solid black;
        }

        .owl-next {
            width: 15px;
            height: 100px;
            position: absolute;
            top: 40%;
            right: 20px;
            display: block !important;
            border:0px solid black;
        }
        .owl-prev i, .owl-next i {
            transform : scale(1,2);
            color: #fcaf56;
            border: 1px solid #fff8e1;
            border-radius: 5px ;

        }

CSS,

        'js' => <<<JS
            $(".slider-wrapper").owlCarousel({
                autoplay:true,
               // autoplayTimeout:5000,
               // animateOut: 'fadeOut',
               // animateIn: 'fadeIn',
                autoplayHoverPause:true,
                smartSpeed:200,
                loop: true,
                responsiveClass: true,
                items : 1,
                nav : true,
                navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
                margin: 0,
                dots: true
             });

         JS,
    ];
    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.css') ;
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css') ;
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css') ;
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
//        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js') ;
    }


    public function codes()
    {
        $this->htm .= ($this->_layout['main']);
        $this->css .= ($this->_layout['css']);
        $this->js .= ($this->_layout['js']) ;

    }
}
