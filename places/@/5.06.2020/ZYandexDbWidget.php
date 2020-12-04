<?php

/**
 *
 *
 * Author:  AzimjonToirov
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
class ZYandexDbWidget extends ZWidget
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
             var geolocation = ymaps.geolocation,
     

            
            myPlacemark1 = new ymaps.Placemark([41.32, 69.22], {
                balloonContent: 'Маленькая иконка'
            },
            {
               /* iconLayout: 'default#image',*/
                iconImageClipRect: [[69,0], [97, 46]],
                iconImageSize: [35, 63],
                iconImageOffset: [-35, -63]
            }  
                )
            
            /*myMap.geoObjects.add(myPlacemark1);*/
            
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
            
        
              /**
     * Comparing the position calculated from the user's IP address
     * and the position detected using the browser.
     */
    geolocation.get({
        provider: 'yandex',
        mapStateAutoApply: true
    }).then(function (event) {
        // We'll mark the position calculated by IP in red.
        result.geoObjects.options.set('preset', 'islands#redCircleIcon');
        result.geoObjects.get(0).properties.set({
            balloonContentBody: 'My location'
        });
        myMap.geoObjects.add(result.geoObjects);
    });
    
        geolocation.get({
provider: 'browser',
        mapStateAutoApply: true
    }).then(function (event) {
       
        /**
         * We'll mark the position obtained through the browser in blue.
         * If the browser does not support this functionality, the placemark will not be added to the map.
         */
        result.geoObjects.options.set('preset', 'islands#blueCircleIcon');
        myMap.geoObjects.add(result.geoObjects);
    });
        
        
        });
         
JS,

        'style' => <<<CSS
         
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
