<?php


namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZFooterListWidgetA extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'color'=> '',
        'class'=> 'fa fa-angle-right',

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
        <div class="footer-div list" width: 100%;" >
        <section class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="f-cat">
                            <h5 class="heading-five">Categories</h5>
                            <ul class="list-unstyled">
                            
                                <li><a href=""><i class="{class}"></i>{name}</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="f-link">
                            <h5 class="heading-five">Quick Links</h5>
                            <ul class="list-unstyled">
                            
                                <li><a href=""><i class="{class}"></i>{name}</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="f-sup">
                            <h5 class="heading-five">Support</h5>
                            <ul class="list-unstyled">
                            
                                <li><a href=""><i class="{class}"></i>{name}</a></li>
                           
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
                        <p> 2020 | Bozorboy<i class="fa fa-heart"></i> by <a href="#" target="_blank">ZetSoft</a></p>
                    </div>
                    <div class="col-md-6 text-right" >
<!--                        <img src="/render/market/ZFooterListWidget/demo/images/payment.png" alt="" class="img-fluid">-->
                    </div>
                </div>
            </div>
            <div class="back-to-top text-center">
                   <i class="fa fa-angle-up" ></i>
<!--                <img src="/render/market/ZFooterListWidget/demo/images/backtotop.png" alt="" class="img-fluid">-->
            </div>
        </section>
    </div>
          
HTML,
        'item' => <<<HTML

                            <ul class="list-unstyled">
                                <li><a href=""><i class="{class}"></i>Clothing</a></li>
                            </ul>

HTML,

        'css'=> <<<CSS
            .fa .fa-angle-up{
             font-size: 25px;
             color:{color};
             /*aria-hidden: true;*/
             }
            
            .fa .fa-heart {
                color: {color};"
            }
            
             .fa .fa-heart a{
                    color: {color};
            }
CSS,

    ];



    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{color}'=> $this->_config['color'],
            '{class}'=> $this->_config['class'],
        ]);

        $this->css= strtr($this->_layout['css'], [

        ]);
    }

}

