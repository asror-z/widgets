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





class ZYandexDbGeoLocation extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'center'=>'[55, 34]',
        'zoom'=>9
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
             
        ymaps.ready(init);

    function init() {
        var geolocation = ymaps.geolocation,
            myMap = new ymaps.Map('map', {
                center: {center},
                zoom: {zoom}
            }, {
                searchControlProvider: 'yandex#search'
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
    }
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
           '{center}'=>$this->_config['center'],
           '{zoom}'=>$this->_config['zoom']
        ]);

        $this->css = strtr($this->_layout['style'], []);
    }
}
