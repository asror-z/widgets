<?php


namespace zetsoft\widgets\market\AUWs;


use zetsoft\system\kernels\ZWidget;

class ZCheckOutWidget extends ZWidget
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
        <section class="compare-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="comp-table table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="heading">
                                        <td class="col-name text-center">Product</td>
                                        <td class="text-center">
                                            <i class="fa fa-trash-o"></i>
                                            <a href="">
                                                <img src="/render/market/@Weak/AUWs/ZCheckOutWidget/demo/images/mega-b-1.jpg" alt="">
                                                <div class="tag-title text-left">
                                                    <span>Camera</span>
                                                    <h6>Samsung Smart Led Tv</h6>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-trash-o"></i>
                                            <a href="">
                                                <img src="/render/market/@Weak/AUWs/ZCheckOutWidget/demo/images/mega-b-2.jpg" alt="">
                                                <div class="tag-title text-left">
                                                    <span>Mouse</span>
                                                    <h6>Samsung Smart Led Tv</h6>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-trash-o"></i>
                                            <a href="">
                                                <img src="/render/market/@Weak/AUWs/ZCheckOutWidget/demo/images/mega-b-3.jpg" alt="">
                                                <div class="tag-title text-left">
                                                    <span>Speaker</span>
                                                    <h6>Samsung Smart Led Tv</h6>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="desc">
                                        <td class="col-name text-center">Description</td>
                                        <td><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque suscipit harum praesentium est? Quae et quam saepe, ab libero similique cum magnam.</p></td>
                                        <td><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque suscipit harum praesentium est? Quae et quam saepe, ab libero similique cum magnam.</p></td>
                                        <td><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque suscipit harum praesentium est? Quae et quam saepe, ab libero similique cum magnam.</p></td>
                                    </tr>
                                    <tr class="rating text-center">
                                        <td class="col-name">Rating</td>
                                        <td class="text-center">
                                            <ul class="list-unstyled list-inline rate">
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled list-inline rate">
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled list-inline rate">
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="price text-center">
                                        <td class="col-name">Price</td>
                                        <td><p>$399.00</p></td>
                                        <td><p>$399.00</p></td>
                                        <td><p>$399.00</p></td>
                                    </tr>
                                    <tr class="stock text-center">
                                        <td class="col-name">Price</td>
                                        <td><p>In Stock</p></td>
                                        <td><p>In Stock</p></td>
                                        <td><p>In Stock</p></td>
                                    </tr>
                                    <tr class="color text-center">
                                        <td class="col-name">Color</td>
                                        <td>
                                            <ul class="list-unstyled list-inline clr">
                                                <li class="list-inline-item"><span></span></li>
                                                <li class="list-inline-item"><span></span></li>
                                                <li class="list-inline-item"><span></span></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled list-inline clr">
                                                <li class="list-inline-item"><span></span></li>
                                                <li class="list-inline-item"><span></span></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled list-inline clr">
                                                <li class="list-inline-item"><span></span></li>
                                                <li class="list-inline-item"><span></span></li>
                                                <li class="list-inline-item"><span></span></li>
                                                <li class="list-inline-item"><span></span></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="add-cart text-center">
                                        <td></td>
                                        <td><button type="button">Add To Cart</button></td>
                                        <td><button type="button">Add To Cart</button></td>
                                        <td><button type="button">Add To Cart</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
          
HTML,
        'js' => <<<JS
 
    
JS,
        'css' => <<<CSS
 
    
CSS,



    ];



    public function asset()
    {
        $this->fileCss("https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css");
        $this->fileCss("https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900");
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

