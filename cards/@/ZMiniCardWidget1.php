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

class ZMiniCardWidget1 extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => Self::type['main'],
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
            
                <div class="mini-cards-company col-md-3 my-2 d-flex flex-row align-items-center">

                    <div class="mini-card--image w-100 col-md-4" id="mini-card--image-{name}">
                    <!--<img class="w-100 h-50" src="{image}">-->
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

        'allCompany' => <<<HTML
            
          
            <div class="mini-cards-company col-md-4 my-2 d-flex flex-row align-items-center">

                    <div class="mini-card--image w-100 col-md-4" id="mini-card--image-{name}">
                    <!--<img class="w-100 h-50" src="{image}">-->
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
        
          .mini-card--image{
            width: 100px;
            height: 100px;
            background-position: center center;
            background-size:  cover;
            background-repeat:  no-repeat;
            border-radius: 10px;
          }
          
          #mini-card--image-_name_{
            background-image: url("_image_");
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
            '{image}' => $this->_config['image']
        ]);

        $this->css .= strtr($this->_layout['css'], [
            '_name_'=>$this->_config['name'],
            '_image_'=>$this->_config['image']
        ]);
    }


}
