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
class ZYandexDbPolygonWidget extends ZWidget
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
    var myMap = new ymaps.Map("map", {
        center: [55.73, 37.75],
        zoom: 10
    }, {
        searchControlProvider: 'yandex#search'
    });

    // Создаем многоугольник, используя класс GeoObject.
    var myGeoObject = new ymaps.GeoObject({
        // Описываем геометрию геообъекта.
        geometry: {
            // Тип геометрии - "Многоугольник".
            type: "Polygon",
            // Указываем координаты вершин многоугольника.
            coordinates: [
                // Координаты вершин внешнего контура.
                [
                    [55.75, 37.80],
                    [55.80, 37.90],
                    [55.75, 38.00],
                    [55.70, 38.00],
                    [55.70, 37.80]
                ],
                // Координаты вершин внутреннего контура.
                [
                    [55.75, 37.82],
                    [55.75, 37.98],
                    [55.65, 37.90]
                ]
            ],
            // Задаем правило заливки внутренних контуров по алгоритму "nonZero".
            fillRule: "nonZero"
        },
        // Описываем свойства геообъекта.
        properties:{
            // Содержимое балуна.
            balloonContent: "Многоугольник"
        }
    }, {
        // Описываем опции геообъекта.
        // Цвет заливки.
        fillColor: '#00FF00',
        // Цвет обводки.
        strokeColor: '#0000FF',
        // Общая прозрачность (как для заливки, так и для обводки).
        opacity: 0.5,
        // Ширина обводки.
        strokeWidth: 5,
        // Стиль обводки.
        strokeStyle: 'shortdash'
    });

    // Добавляем многоугольник на карту.
    myMap.geoObjects.add(myGeoObject);

    // Создаем многоугольник, используя вспомогательный класс Polygon.
    var myPolygon = new ymaps.Polygon([
        // Указываем координаты вершин многоугольника.
        // Координаты вершин внешнего контура.
        [
            [55.75, 37.50],
            [55.80, 37.60],
            [55.75, 37.70],
            [55.70, 37.70],
            [55.70, 37.50]
        ],
        // Координаты вершин внутреннего контура.
        [
            [55.75, 37.52],
            [55.75, 37.68],
            [55.65, 37.60]
        ]
    ], {
        // Описываем свойства геообъекта.
        // Содержимое балуна.
        hintContent: "Многоугольник"
    }, {
        // Задаем опции геообъекта.
        // Цвет заливки.
        fillColor: '#00FF0088',
        // Ширина обводки.
        strokeWidth: 5
    });

    // Добавляем многоугольник на карту.
    myMap.geoObjects.add(myPolygon);
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
