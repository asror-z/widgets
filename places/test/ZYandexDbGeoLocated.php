<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *  
 * Made by Khojiakbar Kodirov
*/

namespace zetsoft\widgets\places;

use kartik\builder\Form;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\former\ZFormWidget;





class ZYandexDbGeoLocated extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        
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
        <div id="map"></div>
HTML,

        'js' => <<<JS
             
        ymaps.ready(function () {
        var map;
        ymaps.geolocation.get().then(function (res) {
            var mapContainer = $('#map'),
                bounds = res.geoObjects.get(0).properties.get('boundedBy'),
                // Calculating the viewport for the user's current location.
                mapState = ymaps.util.bounds.getCenterAndZoom(
                    bounds,
                    [mapContainer.width(), mapContainer.height()]
                );
            createMap(mapState);
        }, function (e) {
            // If the location cannot be obtained, we just create a map.
            createMap({
                center: [55.751574, 37.573856],
                zoom: 2
            });
        });

        function createMap (state) {
            map = new ymaps.Map('map', state);
        }
    });
JS,

        'style' => <<<CSS
         
         #map {
            width: 100%; height: 900px;
        }
         
CSS,

    ];


    public function asset()
    {
        $this->fileJs('https://api-maps.yandex.ru/2.1/?lang=en_RU&apikey=5fb7da25-bc18-4612-b304-83ea2266c510');

    }


    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [

        ]);

        $this->js = strtr($this->_layout['js'], [
            
        ]);

        $this->css = strtr($this->_layout['style'], []);
    }
}
