<?php

namespace zetsoft\widgets\market;

use zetsoft\system\kernels\ZWidget;

/**
 * http://demos.krajee.com/widget-details/select2
 * /core/tester/asror/main.aspx?path=render/market/ZMediaCardWidget/Sample.php
 *
 * Created By: Ulugbek Mamatkulov
 */

class ZMediaCardWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'items' => [
            [
                'name' => 'Samsung TV',
                'price' => 1000,
                'old-price' => 8000,
                'title' => 'Наслаждайтесь комфортным просмотром вместе с телевизором Roison RE-55777. На его 55-дюймовом экране отображается чёткое и насыщенное изображение...'

            ],
            [
                'name' => 'Samsung TV',
                'price' => 1000,
                'old-price' => 8000,
                'title' => 'Наслаждайтесь комфортным просмотром вместе с телевизором Roison RE-55777. На его 55-дюймовом экране отображается чёткое и насыщенное изображение...'

            ],
            [
                'name' => 'Samsung TV',
                'price' => 1000,
                'old-price' => 8000,
                'title' => 'Наслаждайтесь комфортным просмотром вместе с телевизором Roison RE-55777. На его 55-дюймовом экране отображается чёткое и насыщенное изображение...'

            ]
        ],
        'order-btn' => 'Заказать'
    ];
    public $assets = "/render/market/ZMediaCardWidget/asset/assets";
    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public function asset()
    {
        $this->fileCss("https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css");
        $this->fileCss("$this->assets/css/star-rating.min.css");
        $this->fileCss("$this->assets/css/material.css");
        $this->fileJs("https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js ");
        $this->fileJs("https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js");
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
                <div class="content page-products">
                    <div class="col-md-7 col-lg-8 center">
                        <div class="row" style="text-align: right;">
                            <div class="title" style="width: 100%;">
                                <div class="btn-group">
                                    <button type="button" class="btn-grid btn disabled"> <i class="fa fa-th-large"></i>
                                    </button>
                                    <button type="button" class="btn-list btn"> <i class="fa fa-th-list"></i>
                                    </button>
                                </div>
                                
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="block-view grid">{items}</div>
                        </div>
                    </div>
                </div>
HTML,

        'item' => <<<HTML
            <div class="view-item" style="padding: 0px;">
                <div class="col-12">
                    <div class="rating-container rating-xs rating-animate">
                        <div class="rating">
                            <span class="empty-stars">
                                 <span class="star">
                                      <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                 </span>
                                 <span class="star">
                                      <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                 </span>
                                 <span class="star">
                                       <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                 </span>
                                 <span class="star">
                                       <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                 </span>
                                 <span class="star">
                                       <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                 </span>
                            </span>
                            <span class="filled-stars" style="width: 49.6%;">
                                 <span class="star">
                                      <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                 </span>
                                 <span class="star">
                                      <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                 </span>
                                 <span class="star">
                                      <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                 </span>
                                 <span class="star">
                                      <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                 </span>
                                 <span class="star">
                                      <svg class="bi bi-star-fill" width="1em" height="1em" viewbox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                 </span>
                            </span>
                        </div>
                    </div>
                    <div class="ribbon-icons">
                        <img src="{assets}/img/1.svg" alt="" title="">
                        <img src="{assets}/img/2.svg" alt="" title="">
                        <img src="{assets}/img/3.svg" alt="" title="">
                    </div>
                    <a href="#" data-pjax="false">
                        <img class="img-fluid" src="{assets}/img/tv.jpg" alt="">
                    </a>
                    <span class="status active">
                       <i class="fa fa-circle"></i> Есть в наличии <br>Код № 8806088737547
                    </span>
                </div>
                <div class="col-12">
                     <h3 class="title {title}">
                        <a href="#" data-pjax="false">{name}</a>
                     </h3>
                     <p>
                        <span class="old-price float-right">60 975 000</span><br>
                        <span class="float-left currency">Цена (сум):</span>
                        <span class="price float-right">{price}</span>
                        <br>
                    </p>
                    <p>
                        <span class="saving-price">Экономия: <span>10 976 000 сум</span></span>
                    </p>
                </div>
                <div class="col-12">
                    <div class="title">
                        <p>С помощью телевизора Samsung 65Q900R 8K Smart QLED вы почувствуете каждую сцену на экране с потрясающе точной цветопередачей, максимальной детализацией...</p>
                    </div>
                    <ul class="service">
                        <li>Бесплатная доставкада  
                            <i data-toggle="tooltip" data-placement="top" title="sdfsdfsdfsdfs" class="fa fa-question-circle-o" data-original-title="Something to say"></i>
                            <span class="float-right">да</span>
                        </li>
                        <li>Самовывоз
                            <i data-toggle="tooltip" data-placement="top" title="asdasdasdadad" class="fa fa-question-circle-o" data-original-title="Something to say"></i>
                            <span class="float-right" style="margin-right: -15px;">да</span>
                        </li>
                        <li></li>
                    </ul>
                    <div class="checkbox">
                        <label class="form-check-label" for="{checkbox-id}-check">
                            <input class="add-to-compare form-check-input" type="checkbox" id="{checkbox-id}-check" style="opacity: 1;">
                            Сравнить
                        </label>
                    </div>
                    <div>
                        <a class="btn btn-lg quick-checkout" href="#" data-pjax="0">{order-btn}</a>
                        <button class="btn add-to-cart float-right" data-item="3802">&#xA0;</button>
                    </div>
                </div>
            </div>

HTML,

        'js' => <<<JS
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
                
                var btnGrid = $('.btn-grid');
                var btnList = $('.btn-list');
                var productsView = $('.block-view');
        
                btnList.click(function (event) {
                    productsView.removeClass('grid');
                    productsView.addClass('list');
                    
                    var columns = $('.col-12');
                    columns.removeClass('col-12');
                    columns.addClass('list-view');

                    $(this).addClass('disabled');
                    btnGrid.removeClass('disabled');
                });
        
                btnGrid.click(function (event) {
                    productsView.removeClass('list');
                    productsView.addClass('grid');

                    var columns = $('.list-view');
                    columns.removeClass('list-view');
                    columns.addClass('col-12');

                    $(this).addClass('disabled');
                    btnList.removeClass('disabled');
                });
            });      
JS,
        'css' => <<<HTML
            .{title} {
                font-weight: 600;
            }
            .view-item > div > div > a, .view-item > div > div > button {
                border-radius: 7px;
            }
HTML
    ];

    public function generate($items)
    {
        $output = '';
        foreach ($items as $item) {
            $output .= strtr($this->_layout['item'], [
                '{name}' => $item['name'],
                '{price}' => $item['price'],
                '{assets}' => $this->assets,
                '{checkbox-id}' => rand(),
                '{order-btn}' => $this->_config['order-btn'],
                '{title}' => $this->id . '-title'
            ]);
        }
        return $output;
    }

    public function codes()
    {
        $rand = rand();
        $this->htm = strtr($this->_layout['main'], [
            '{items}' => $this->generate($this->_config['items']),
        ]);

        $this->js = strtr($this->_layout['js'], []);

        $this->css = strtr($this->_layout['css'], ['{title}' => $this->id . '-title']);
    }

}
