<?php


namespace zetsoft\widgets\places;


use zetsoft\system\kernels\ZWidget;
use kartik\builder\Form;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\places\ZYandexDbWidget;

class ZYandexDbEditorIconLayoutWidget extends ZWidget
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
       <div id="map"></div> 
HTML,

        'js' => <<<JS
        ymaps.ready(init);

        function init() {
            // Создаем карту.
            var myMap = new ymaps.Map("map", {
                center: [90, 15],
                zoom: 20,
                controls: []
            }, {
                searchControlProvider: 'yandex#search'
            });

            // Создаем ломаную.
            var myPolyline = new ymaps.Polyline([
                // Указываем координаты вершин.
                [70, 20],
                [70, 40],
                [90, 15],
                [70, -10]
            ], {}, {
                // Задаем опции геообъекта.
                // Цвет с прозрачностью.
                strokeColor: '#FF008888'
            });



            // Добавляем линию на карту.
            myMap.geoObjects.add(myPolyline);

            // Включаем режим редактирования.
            myPolyline.editor.startEditing();
        }


JS,

        'style' => <<<CSS
        html, body, #map {
            width: 100%; height: 900px; padding: 0; margin: 0;
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
