<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev,Khojiakbar Kodirov, Zoirjon Sobirov, Anvar Jabborov
 */

namespace zetsoft\widgets\places\test;

use zetsoft\system\kernels\ZWidget;

class ZYandex11WidgetA extends ZWidget
{
    #region Congif
    public const zoom = [
        'zoom' => 9,
    ];
    public const controls = [
        'routePanelControl' => 'routePanelControl',
        'routeButtonControl' => 'routeButtonControl',
    ];
    #endregion
    public const type = [
        'masstransit' => 'masstransit',
    ];
    public const types = [
        'typse' => '{masstransit: true, pedestrian: true, taxi: true}',
    ];
    public const fromEnabled = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const from = [
        'from' => 'Москва, Льва Толстого 16',
    ];
    public const toEnabled = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const allowSwitch = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const reverseGeocoding = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const data = [
        'data' => '{content: "Поменять местами", title: "Поменять точки местами"}',
    ];
    public const options = [
        'options' => '{selectOnClick: false, maxWidth: 160}',
    ];
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        /*'height' => 600,
        'width' => 0,
        'zoom' => 9,
        'disableDoubleClickZoom' => 9,
        'fullScreenControlPosition' => self::fullScreenControlPosition['LEFT_TOP'],
        'MapTypeControlStyle' => self::MapTypeControlStyle['DEFAULT'],
        'mapTypeControlPosition' => self::mapTypeControlPosition['TOP_CENTER'],
        'mapType' => self::mapType['roadmap'],
        'scrollwheel' => true,                   //boolean == true || false
        'zoomControl' => true,                  //boolean == true || false
        'zoomControlPosition' => self::zoomControlPosition['TOP_LEFT'],
        'grapes' => true,                      //boolean == true || false
        'searchAutoComplete' => true,        //boolean == true || false
        'searchPlaceImageShow' => true,     //boolean == true || false
        'depend' => [
            'dependPlace' => true,
            'depend_id' => '',
        ],
        'matkerCount' => 1,        // number min == 1, max == n
        'draggable' => false,     //boolean == true || false
        'mapUseType' => 'write', // options == read || write
        'travel_mode' => ['DRIVING', 'WALKING', 'BICYCLING', 'TRANSIT'],
        'zoom' => self::zoom['zoom'],
        'controls' => self::controls['routeButtonControl'],
        'type' => self::type['masstransit'],
        'types' => self::types['typse'],
        'fromEnabled' => self::fromEnabled['true'],
        'from' => self::from['from'],
        'toEnabled' => self::toEnabled['true'],
        'allowSwitch' => self::allowSwitch['false'],
        'reverseGeocoding' => self::reverseGeocoding['true'],
        'data' => self::data['data'],
        'options' => self::options['options'],*/

    ];
    public $event = [];
    public $_event = [
        'init' => 'function init () {
    /**
     * Создание мультимаршрута.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml
     */
    var multiRoute = new ymaps.multiRouter.MultiRoute({
        referencePoints: ["Москва", "Тверь"]
    }, {
        // Тип промежуточных точек, которые могут быть добавлены при редактировании.
        editorMidPointsType: "via",
        // В режиме добавления новых путевых точек запрещаем ставить точки поверх объектов карты.
        editorDrawOver: false
    });

    var buttonEditor = new ymaps.control.Button({
        data: { content: "Режим редактирования" }
    });

    buttonEditor.events.add("select", function () {
        /**
         * Включение режима редактирования.
         * В качестве опций может быть передан объект с полями:
         * addWayPoints - разрешает добавление новых путевых точек при клике на карту. Значение по умолчанию: false.
         * dragWayPoints - разрешает перетаскивание уже существующих путевых точек. Значение по умолчанию: true.
         * removeWayPoints - разрешает удаление путевых точек при двойном клике по ним. Значение по умолчанию: false.
         * dragViaPoints - разрешает перетаскивание уже существующих транзитных точек. Значение по умолчанию: true.
         * removeViaPoints - разрешает удаление транзитных точек при двойном клике по ним. Значение по умолчанию: true.
         * addMidPoints - разрешает добавление промежуточных транзитных или путевых точек посредством перетаскивания маркера, появляющегося при наведении курсора мыши на активный маршрут. Тип добавляемых точек задается опцией midPointsType. Значение по умолчанию: true
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml#editor
         */
        multiRoute.editor.start({
            addWayPoints: true,
            removeWayPoints: true,
            addMidPoints: true
        });
    });

    buttonEditor.events.add("deselect", function () {
        // Выключение режима редактирования.
        multiRoute.editor.stop();
    });

    // Создаем карту с добавленной на нее кнопкой.
    var myMap = new ymaps.Map(\'map\', {
        center: [56.399625, 36.71120],
        zoom: 7,
        controls: [buttonEditor]
    }, {
        buttonMaxWidth: 300
    });

    // Добавляем мультимаршрут на карту.
    myMap.geoObjects.add(multiRoute);
}',
    ];

    public $_layout = [
        'main' => <<<HTML
                 <div id="locations">
                </div> 
          <div id="map"></div>                 
            <button value="Включить редактор маршрута" id="editor" name="start">Включить редактор маршрута</button>
   
HTML,

        'css' => <<<CSS
       #map {
            width: 100%;
            height: 100vh;
            padding: 0;
            margin: 0;
        }
         #editor {
            padding: 4px;
            margin-top: 10px;
            margin-left: 10px;
            font-size: 14px;
        }
CSS,
        'js' => <<<JS
 
    
  ymaps.ready(init);

function init() {
    var myMap = new ymaps.Map("map", {
            center: [57.131311, 34.576128],
            zoom: 5
        }, {
            searchControlProvider: 'yandex#search'
        }),
        // Признак начала редактирования маршрута.
        startEditing = false,
        button = $('#editor');

    // Построение маршрута от станции метро Смоленская до станции Третьяковская.
    // Маршрут должен проходить через метро "Арбатская".
    ymaps.route([
        'Москва, метро Смоленская',
        {
            // Метро Арбатская - транзитная точка (проезжать через эту точку,
            // но не останавливаться в ней).
            type: 'viaPoint',
            point: 'Москва, метро Арбатская'
        },
        // Метро "Третьяковская".
        [55.744568, 37.60118]
    ], {
        // Автоматически позиционировать карту.
        mapStateAutoApply: true
    }).then(function (route) {
        myMap.geoObjects.add(route);
        button.click(function () {
            if (startEditing = !startEditing) {
                // Включаем редактор.
                route.editor.start({addWayPoints: true, removeWayPoints: true});
                button.text('Отключить редактор маршрута');
            } else {
                // Выключаем редактор.
                route.editor.stop();
                button.text('Включить редактор маршрута');
            }
        });
        route.editor.events.add(["waypointadd", "waypointremove", "start"], function () {
            if (route.getWayPoints().getLength() >= 10) {
                // Если на карте больше 9 точек маршрута, отключаем добавление новых точек.
                route.editor.start({addWayPoints: false, removeWayPoints: true});
            }
            else {
                // Включаем добавление новых точек.
                route.editor.start({addWayPoints: true, removeWayPoints: true});
            }
        })
    }, function (error) {
        alert("Возникла ошибка: " + error.message);
    });
}
JS,


    ];

    public function asset()
    {
        $this->fileJs('https://api-maps.yandex.ru/2.1/?apikey=5fb7da25-bc18-4612-b304-83ea2266c510&lang=ru_RU');

    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [

        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'], [
            '{init_func}' => $this->eventCode('init'),
            '{init}' => $this->getId() . '_init',
            /*'{routePanelControl}'=>$this->_config['controls'],
            '{zoom}'=>$this->_config['zoom'],
            '{masstransit}'=>$this->_config['type'],
            '{fromEnabled}'=>$this->_config['fromEnabled'],
            '{from}'=>$this->_config['from'],
            '{toEnabled}'=>$this->_config['toEnabled'],
            '{allowSwitch}'=>$this->_config['allowSwitch'],
            '{reverseGeocoding}'=>$this->_config['reverseGeocoding'],
            '{types}'=>$this->_config['types'],
            '{data}'=>$this->_config['data'],
            '{options}'=>$this->_config['options'],*/
        ]);

    }

}
