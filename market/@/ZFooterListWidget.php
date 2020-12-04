<?php


namespace zetsoft\widgets\market\AUWs;


use zetsoft\system\kernels\ZWidget;

class ZFooterListWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

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
        <div style="width: 100%;" >
        <section class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="f-cat">
                            <h5>Categories</h5>
                            <ul class="list-unstyled">
                                <li><a href=""><i class="fa fa-angle-right"></i>Clothing</a></li>
                                <li><a href=""><i class="fa fa-angle-right"></i>Electronics</a></li>
                                <li><a href=""><i class="fa fa-angle-right"></i>Smartphones & Tablets</a></li>
                                <li><a href=""><i class="fa fa-angle-right"></i>Computer & Office</a></li>
                                <li><a href=""><i class="fa fa-angle-right"></i>Home Appliances</a></li>
                                <li><a href=""><i class="fa fa-angle-right"></i>Leather & Shoes</a></li>
                                <li><a href=""><i class="fa fa-angle-right"></i>Kids & Babies</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer-btm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>Copyright &copy; 2020 | Designed With <i class="fa fa-heart"></i> by <a href="#" target="_blank">SnazzyTheme</a></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="/render/market/ZFooterListWidget/demo/images/payment.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="back-to-top text-center">
                <img src="/render/market/ZFooterListWidget/demo/images/backtotop.png" alt="" class="img-fluid">
            </div>
        </section>
    </div>
          
HTML,
        'js' => <<<JS
 
    
JS,
        'css' => <<<CSS
 
    
CSS,



    ];



    public function asset()
    {
        $this->fileCss("https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css");
        $this->fileCss("/render/market/ZFooterListWidget/demo/css/material.css");
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
        ]);
        $this->js= strtr($this->_layout['js'], []);
        $this->css= strtr($this->_layout['css'], []);
    }

}

