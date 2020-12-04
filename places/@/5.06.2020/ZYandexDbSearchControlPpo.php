<?php

/**
 * Made by Khojiakbar Kodirov
 */

namespace zetsoft\widgets\places;


use zetsoft\system\kernels\ZWidget;

class ZYandexDbSearchControlPpo extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'center' => '[55.74, 37.58]',
        'zoom'=>13,

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
        function init() {
        var myMap = new ymaps.Map('map', {
            center: {center},
            zoom: {zoom},
            controls: []
        });

        /**
         * Creating an instance of the "Search on map" control
         * with the option enabled for the business search data provider.
         */
        var searchControl = new ymaps.control.SearchControl({
            options: {
                provider: 'yandex#search'
            }
        });

        myMap.controls.add(searchControl);

        /**
         * Programmatically performing a search for specific cafes within the
         * rectangular map area.
         */
        searchControl.search('Shokoladnitsa');
    }

    ymaps.ready(init);


JS,

        'style' => <<<CSS
         #map {
            width: 100%; height: 900px; padding: 0; margin: 0;
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
            '{zoom}'=>$this->_config['zoom'],
        ]);

        $this->css = strtr($this->_layout['style'], []);
    }
}
