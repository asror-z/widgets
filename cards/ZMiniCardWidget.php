<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\cards;


use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;

class ZMiniCardWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => Self::type['allCompany'],
        'name' => 'Yapona Mama',
        'distence' => '1.2km',
        'title' => 'lorem ipsum dolor amit set',
        'price_old' => '',
        'price' => '100',
        'currency' => '$',
        'image' => 'https://express24.uz/upload/resize_cache/iblock/41f/180_180_0/41fd9ffb8dbac367b48da7ed03c343d2.png',
    ];

    public const type = [
        'main' => 'main',
        'allCompany' => 'allCompany'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            
                <div class="mini-cards-company p-0 col-md-12 my-2 d-flex flex-row shadow">

                    <div class="mini-card--image--main w-100 pl-0  col-md-4" id="mini-card--image-{name}">
                    <img class="w-100 rounded-lg" src="{image}">
                    </div>

                    <div class="mini-card--desc col-md-6 w-100 d-flex flex-column p-0">
                        <div class="mini-desc d-flex flex-column">
                            <a><h6 class="font-weight-bold fe-08 mb-0">{name}</h6></a>
                            <span class="font-weight-light fe-07 text-muted">{distence}</span>
                        </div>
                        <div class="mini-desc--item">
                           <span class="font-weight-light text-muted fe-08 text-truncate">{title}</span>
                        </div>
                    </div>

                    <div class="events col-md-2 px-0">
                        <div class="event-items d-flex justify-content-center w-100 ">
                            <a><p class="fe-08"><i class="fas fa-truck text-success fe-08"></i>{price}{currency}</p></a>
                        </div>
                            <a class="price_old"><p>{price_old}</p></a>
                    </div>

            </div>
        

HTML,

        'allCompany' => <<<HTML
            
          
            <div class="mini-cards-company col-md-4 my-3 d-flex flex-row align-items-center">

                    <div class="mini-card--image--all col-md-4" id="mini-card--image-{name}">
                        <img class="w-100 h-50" src="{image}">
                    </div>

                    <div class="mini-card--desc col-md-6 w-100 d-flex flex-column p-1">
                        <div class="mini-desc d-flex flex-column">
                            <a><h6 class="font-weight-bold">{name}</h6></a>
                            <span class="font-weight-light text-muted">{distence}</span>
                        </div>
                        <div class="mini-desc--item ml-1">
                           <span class="font-weight-light text-muted">{title}</span>
                        </div>
                    </div>

                    <div class="events col-md-2">
                        <div class="event-items d-flex justify-content-center w-100 ">
                            <a><p>{price}{currency}</p></a>
                        </div>
                            <a class="price_old"><p>{price_old}</p></a>
                    </div>

            </div>


            
            
HTML,

        'css' => <<<CSS
        
          .mini-card--image--all{
            width: 100px;
            height: 100px;
          }
          
           .mini-card--image--main, .mini-card--image--all{
            background-position: center center;
            background-size:  cover;
            background-repeat:  no-repeat;
            border-radius: 10px;
          }
          
          .mini-card--image--main{
            width: 85px;
            height: 85px;
          }
          
          #mini-card--image-_name_{
            background-image: url('{image}');
          }

CSS,
    ];


    public function codes()
    {


        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            '{name}' => $this->_config['name'],
            '{distence}' => $this->_config['distence'],
            '{title}' => $this->_config['title'],
            '{price_old}' => $this->_config['price_old'],
            '{currency}' => $this->_config['currency'],
            '{price}' => $this->_config['price'],
            '{image}' => $this->_config['image'],

        ]);

        $this->css .= strtr($this->_layout['css'], [
            '_name_'=>$this->_config['name'],
            '{image}'=>$this->_config['image']
        ]);
    }


}
