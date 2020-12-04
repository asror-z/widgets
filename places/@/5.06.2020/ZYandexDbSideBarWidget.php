<?php

/**
 *
 *
 * Author:  Abdulazizkhon AKhmedov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\places;

use kartik\builder\Form;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\former\ZFormWidget;




/**
 * Class    ZIconPickerWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZYandexDbSideBarWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'trafficControl' => true,
        'routeButtonControl' => true,
        'zoomControl' => true,
        'searchControl' => true,
        'typeSelector' => true,
        'geolocationControl' => true,
        'fullscreenControl' => true,
        'customControl' => true,
        'rulerControl' => true,

    ];

    /**
     *
     * Constants
     */

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-classic.min.css">
       <div>
            <div id="Sidebar" class="sidebar text-center"> 
             <input type="text">
             </div>

            <button id="Openbtn" class="openbtn"><i class="fas fa-chevron-right"></i></button> 
        </div>  
        <div class="row">
                {saveForm}
                <div id="locations">
                        </div>       
                <div class="col-md-12">
                    <div class="col-lg-7 col-md-7 col-sm-7" id="search_area">  
                         {search}
                    </div> 
                    <div id="map" style=" height: {height}px;width:content-box  ">                                                            
                    </div>                 
                </div>
                {img}
            </div>     

HTML,

        'js' => <<<JS
             
            
            ymaps.ready(function () {
                
                var openCheck = 0;
                document.getElementById("Openbtn").onclick = function openBtn(){
	                if(openCheck==0){
                            document.getElementById("Sidebar").style.width = "250px";
                            document.getElementById("Openbtn").style.marginLeft = "250px";
                            document.getElementById("Openbtn").style.transform="rotate(180deg)";
                            openCheck = 1;
                        }else{
                            document.getElementById("Sidebar").style.width = "0";
                            document.getElementById("Openbtn").style.marginLeft= "0";
                            document.getElementById("Openbtn").style.transform="rotate(360deg)";
                            openCheck = 0;
                        }
                    }
                
                
             
            var myMap = new ymaps.Map('map', {
                center: [41.32, 69.22],
                zoom: 12,
                 
                controls: [
                    '{trafficControl}',
                    '{searchControl}',
                    '{typeSelector}',
                    '{geolocationControl}',
                    '{fullscreenControl}',
                ],

            });
            
            myPlacemark1 = new ymaps.Placemark([41.32, 69.22], {
                balloonContent: 'Маленькая иконка'
            },
            {
                iconLayout: 'default#image',
                iconImageClipRect: [[69,0], [97, 46]],
                iconImageSize: [35, 63],
                iconImageOffset: [-35, -63]
            }
                ),
            
            myMap.geoObjects.add(myPlacemark1);
            
            // Обработка события, возникающего при щелчке
            // левой кнопкой мыши в любой точке карты.
            // При возникновении такого события откроем балун.
            var cnt_ind = 0;
            myMap.events.add('click', function (e) {
                if (!myMap.balloon.isOpen()) {
                    console.log('sasdjaklsjl')
                    var coords = e.get('coords');
                    $("<input type='text'  name = '{name}[" + cnt_ind + "][lat]' value=" + coords[0].toPrecision(6) + ">").appendTo('#locations');
                    $("<input type='text'  name = '{name}[" + cnt_ind + "][lng]' value=" + coords[1].toPrecision(6) + ">").appendTo('#locations');
                    cnt_ind++;
                }
                else {
                    myMap.balloon.close();
                }
            });
            
        });
         
JS,

        'style' => <<<CSS
         .sidebar {
              height: 100%;
              width: 0;
              position: absolute;
              z-index: 1;
              top: 0;
              left: 0;
              background-color: white;
              /*opacity: 0.95;*/
              overflow-x: hidden;
              transition: 0.5s;
              padding-top: 60px;
            }
            
          .openbtn {
              cursor: pointer;
              background-color:green;
              color: gray;
              width: 20px;
              height: 30px;
              transition: margin-left .5s;
              border: none;
              opacity: 0.95;
              color: white;
            }
         html,
        body,
        #map {
            height: 70vh;
            padding: 0;
        }
         
CSS,

    ];


    public function asset()
    {
        $this->fileJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=5fb7da25-bc18-4612-b304-83ea2266c510');

    }


    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [

        ]);

        $this->js = strtr($this->_layout['js'], [
            '{name}' => $this->name,
            '{routeButtonControl}' => $this->_config['routeButtonControl'] ? 'routeButtonControl' : '',
            '{zoomControl}' => $this->_config['zoomControl'] ? 'zoomControl' : '',
            '{searchControl}' => $this->_config['searchControl'] ? 'searchControl' : '',
            '{typeSelector}' => $this->_config['typeSelector'] ? 'typeSelector' : '',
            '{geolocationControl}' => $this->_config['geolocationControl'] ? 'geolocationControl' : '',
            '{fullscreenControl}' => $this->_config['fullscreenControl'] ? 'fullscreenControl' : '',
            '{customControl}' => $this->_config['customControl'] ? 'customControl' : '',
            '{rulerControl}' => $this->_config['rulerControl'] ? 'rulerControl' : '',
            '{trafficControl}' => $this->_config['trafficControl'] ? 'trafficControl' : '',


        ]);

        $this->css = strtr($this->_layout['style'], []);
    }
}
