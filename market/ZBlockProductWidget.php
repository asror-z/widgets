<?php

namespace zetsoft\widgets\market;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * CreatedBy: Jaxongir Maxamadjonov
 */
class ZBlockProductWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZBlockProductWidget::types['main'],
        'day' => '14',
        'color' => ZColor::color['black'],
        'text' => 'Some example text some example text. John Doe is an architect and engineer',
        'price' => 5,
        'price_old' => 8,
        'url' => 'https://web.lebazar.uz/resources/product/2017/0/19/small_1484813094725080301-00089.jpg',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="col-md-4">
            <div class="card">
                <div class="number-1">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="number"><img class="leaf" src="../laer.jpg" alt="">{day}+</span>
                            <span class="day">дней</span>
                        </div>
                        <div class="col-md-6">
                            <!-- <span class="badge badge-danger">�������</span> -->
                        </div>
                    </div>
                </div>
                <img class="card-img-top" src="{url}" alt="Card image" style="width:100%">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <p class="reviews-rating mt-3">
                                <a href="#" class="star-1 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-2 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-3 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-4 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-5 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                            </p></div>
                        <div class="col-md-3">
                            <a href="#" class="like"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{text}</p>
                    <div class="price">
                        <p class="price"><br>{price}<span>UZB/шт.</span>

                        </p>
                    </div>
                </div>
                <div class="row shop">
                    <div class="col-md-8 pr-1 pl-1">
                        <div class="border-add">
                            <a href="#" class="minus float-left" id="dec-{id}" onclick="decNumber()"><i class="fa fa-minus" aria-hidden="true" ></i></a>
                            <label class="zero" id="display-{id}">0</label>
                            <a href="#" class="plus float-right" id="inc-{id}" onclick="incNumber()"><i class="fas fa-plus" aria-hidden="true" ></i></a>
                        </div>

                    </div>
                    <div class="col-md-4 pl-1 pr-1">
                        <div class="basket">
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
   
HTML,
        'amain' => <<<HTML
    <div class="col-md-4">
            <div class="card">
                <div class="number-1">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="number"><img class="leaf" src="../laer.jpg" alt="">{day}</span>
                            <span class="day">дней</span>
                        </div>
                        <div class="col-md-6">
                            <span class="badge badge-warning">Акция</span>
                        </div>
                    </div>


                </div>
                <img class="card-img-top" src="{url}" alt="Card image" style="width:100%">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <p class="reviews-rating mt-3">
                                <a href="#" class="star-1 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-2 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-3 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-4 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-5 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                            </p></div>
                        <div class="col-md-3">
                            <a href="#" class="like"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{text}</p>
                    <div class="price">
                        <p class="price"><span class="num-1">{price_old}</span> <br> <span class="num">{price}</span> <span>UZB/шт.</span></p>
                    </div>
                </div>
                <div class="row shop">
                    <div class="col-md-8 pr-1 pl-1">
                        <div class="border-add">
                            <a href="#" class="minus float-left" id="dec-{id}" onclick="decNumber()"><i class="fa fa-minus" aria-hidden="true" ></i></a>
                            <label class="zero" id="display-{id}">0</label>
                            <a href="#" class="plus float-right" id="inc-{id}" onclick="incNumber()"><i class="fas fa-plus" aria-hidden="true" ></i></a>
                        </div>

                    </div>
                    <div class="col-md-4 pl-1 pr-1">
                        <div class="basket">
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

      
HTML,
        'new' => <<<HTML
  <div class="col-md-4">
            <div class="card">
                <div class="number-1">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="number"><img class="leaf" src="../laer.jpg" alt="">{day}+</span>
                            <span class="day">дней</span>
                        </div>
                        <div class="col-md-6">
                            <span class="badge badge-danger">Новинка</span>
                        </div>
                    </div>
                </div>
                <img class="card-img-top" src="{url}" alt="Card image" style="width:100%">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <p class="reviews-rating mt-3">
                                <a href="#" class="star-1 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-2 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-3 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-4 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                                <a href="#" class="star-5 star"><i class="fa fa-star" aria-hidden="true"></i></a>
                            </p></div>
                        <div class="col-md-3">
                            <a href="#" class="like"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{text}</p>
                    <div class="price">
                        <p class="price"><br>{price} <span>UZB/шт.</span>

                        </p>
                    </div>
                </div>
                <div class="row shop">
                    <div class="col-md-8 pr-1 pl-1">
                        <div class="border-add">
                            <a href="#" class="minus float-left" id="dec-{id}" onclick="decNumber()"><i class="fa fa-minus" aria-hidden="true" ></i></a>
                            <label class="zero" id="display-{id}">0</label>
                            <a href="#" class="plus float-right" id="inc-{id}" onclick="incNumber()"><i class="fas fa-plus" aria-hidden="true" ></i></a>
                        </div>

                    </div>
                    <div class="col-md-4 pl-1 pr-1">
                        <div class="basket">
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
HTML,
        'js' => <<<JS

 var i = 0;
    $("#inc-{id}").click( function() {
        if (i < 1000) {
            i++;
        } else if (i = 1000) {
            i = 0;
        }
        document.getElementById("display-{id}").innerHTML = i;
    })
 $("#dec-{id}").click( function(){
        if (i > 0) {
            --i;
        } else if (i = 0) {
            i = 1000;
        }
        document.getElementById("display-{id}").innerHTML = i;
    })

   
JS,

        'css' => <<<CSS

   
CSS,
    ];

    public const types = [
        'main' => 'main',
        'amain' => 'amain',
        'new' => 'new'

    ];


    public function asset()
    {
        $this->fileCss('/render/market/ZBlockProductWidget/asset/main.css');
    }


    public function codes()
    {


        $this->_layout['main'] = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{day}' => $this->_config['day'],
            '{text}' => $this->_config['text'],
            '{price}' => $this->_config['price'],
            '{url}' => $this->_config['url'],

        ]);
        $this->_layout['amain'] = strtr($this->_layout['amain'], [
            '{id}' => $this->id,
            '{day}' => $this->_config['day'],
            '{text}' => $this->_config['text'],
            '{price}' => $this->_config['price'],
            '{price_old}' => $this->_config['price_old'],
            '{url}' => $this->_config['url'],


        ]);


        $this->htm = strtr(
            $this->_layout['new'], [
            '{id}' => $this->id,
            '{day}' => $this->_config['day'],
            '{text}' => $this->_config['text'],
            '{price}' => $this->_config['price'],
            '{url}' => $this->_config['url'],
        ]);


        $this->css = strtr($this->_layout['css'], [
            '_color_' => $this->_config['color']
        ]);
        
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
        ]);


    }

}

