<?php
/**
 *
 * @author Anvar Jabborov
 * @liecence Zoirjon Sobirov
 */

namespace zetsoft\widgets\places;

use kartik\builder\Form;
use kartik\widgets\Typeahead;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\former\ZFormWidget;

class ZYandexWidgetA extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'zoom' => self::zoom['zoom'],
        'controls' => self::controls['routePanelControl'],
        'type' => self::type['auto'],
        'types' => self::types['typse'],
        'fromEnabled' => self::fromEnabled['true'],
        'from' => self::from['from'],
        'toEnabled' => self::toEnabled['true'],
        'allowSwitch' => self::allowSwitch['false'],
        'reverseGeocoding' => self::reverseGeocoding['true'],
        'data' => self::data['data'],
        'options' => self::options['options'],
        'myMap' => 'myMap',
        'idMap' => 'idMap',
        'countMarker' => 1,
        'coordinates' => '0',
        'pointsFromDB' => 'false',
        'depend' => [
            'dependPlace' => true,
            'depend_id' => 'coreinput-string_9',
        ],

    ];
    #region consts
    public const zoom = [
        'zoom' => 9,
    ];
    public const controls = [
        'routePanelControl' => 'routePanelControl',
        'routeButtonControl' => 'routeButtonControl',
    ];
    public const type = [
        'masstransit' => 'masstransit',
        'pedestrian' => 'pedestrian',
        'taxi' => 'taxi',
        'auto' => 'auto',
        'bicycle' => 'bicycle',
    ];
    public const types = [
        'typse' => '{masstransit: true, pedestrian: true, taxi: true, auto: true, bicycle: true,}',
    ];
    public const fromEnabled = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const from = [
        'from' => 'Юнусабадский район, Ташкент, Узбекистан',
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

    #endregion
    public $_layout = [
        'main' => <<<HTML
             <div id="locations"></div>
        <div id="{map}"></div>                 
                     
HTML,

        'css' => <<<CSS
       /*html, body {
            width: 100%;
            height: 95%;
            margin: 0;
            padding: 0;
            font-family: Arial;
            font-size: 14px;
        }*/
        #{map} {
            width: 100%;
            height: 95vh;
        }
       /* .header {
            padding: 5px;
        }*/
CSS,
        'js' => <<<JS
          
  ymaps.ready({init});
        
    function {init}() {
        var suggestView = new ymaps.SuggestView('{testing}', {results: 1, offset: [20, 30]});
        $('#{testing}').on('input',function (event){
         searchControl.search($("#{testing}").val());
        });
        //console.log('suggestView: ',suggestView);
        var data = [];
        var countMarkers = 1;
        var countMarker = {countMarker};
        if (countMarker < 1)
            countMarker = 1;
        // Создаем коллекцию.
        myCollection_{myMap} = new ymaps.GeoObjectCollection();
        var myPlacemark_{myMap},
            {myMap} = new ymaps.Map('{map}', {
                center: [41.327069, 69.281797],
                zoom: {zoom},
                controls: ['zoomControl', 'searchControl', 'typeSelector', 'fullscreenControl', 'routeButtonControl'],
            }, {
                searchControlProvider: 'yandex#search'
            });
        
        // Пример 2
// Если элемент управления уже добавлен на карту по ключу из хранилища control.storage,
// то его экземпляр можно получить с помощью метода control.Manager.get
// менеджера элементов управления control.Manager.
         var nameSearch = 'Tashkent City Park';
var searchControl = {myMap}.controls.get('searchControl');

searchControl.events.add('submit', function () {
    //console.log('request: ' + searchControl.getRequestString());
    nameSearch = searchControl.getRequestString();
    $("#{testing}").val(nameSearch);
    // Поиск координат центра Нижнего Новгорода.
    ymaps.geocode(nameSearch, {
        /**
         * Опции запроса
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
         */
        // Сортировка результатов от центра окна карты.
        // boundedBy: myMap.getBounds(),
        // strictBounds: true,
        // Вместе с опцией boundedBy будет искать строго внутри области, указанной в boundedBy.
        // Если нужен только один результат, экономим трафик пользователей.
        results: 1
    }).then(function (res) {
            // Выбираем первый результат геокодирования.
            var firstGeoObject = res.geoObjects.get(0),
                // Координаты геообъекта.
                coordsSearch = firstGeoObject.geometry.getCoordinates();
                 data = {coords: coordsSearch, text: nameSearch};
            //console.log('coords: ', coordsSearch);
            console.log('data: ', data);

            /**
             * Если нужно добавить по найденным геокодером координатам метку со своими стилями и контентом балуна, создаем новую метку по координатам найденной и добавляем ее на карту вместо найденной.
             */
            /**
             var myPlacemark = new ymaps.Placemark(coords, {
             iconContent: 'моя метка',
             balloonContent: 'Содержимое балуна <strong>моей метки</strong>'
             }, {
             preset: 'islands#violetStretchyIcon'
             });

             myMap.geoObjects.add(myPlacemark);
             */
        });

}, this); 

        var l1, l2;
        
        // Создаем массив с данными.
        myPoints = [];
         
        //////////////////////////////
        //var obj = JSON.parse({coord});
        if ({true}) {
            var obj = {coord};
            for (var i = 0, l = obj.length; i < l; i++) {
                var point = obj[i];
                myCollection_{myMap}.add(new ymaps.Placemark(
                    point.coords, {
                        balloonContentBody: point.text
                    }
                ));
                if (point.coords != null)
                    myPoints.push({coords: point.coords, text: point.text});
            }
            // myPoints = obj;

            ///////////////////
            // Добавляем коллекцию меток на карту.
            {myMap}.geoObjects.add(myCollection_{myMap});
            // Слушаем клик на карте.
        }

        {myMap}.events.add('click', function (e) {
         
            var coords = e.get('coords');
            //console.log('coords: ', coords);
            // Если метка уже создана – просто передвигаем ее.
            if (myPlacemark_{myMap}) {
                myPlacemark_{myMap}.geometry.setCoordinates(coords);
            }
            // Если нет – создаем.
            else {
                myPlacemark_{myMap} = createPlacemark(coords);
                l1 = coords[0];
                l2 = coords[1];
                {myMap}.geoObjects.add(myPlacemark_{myMap});
                // Слушаем событие окончания перетаскивания на метке.
                myPlacemark_{myMap}.events.add('dragend', function () {
                    getAddress(myPlacemark_{myMap}.geometry.getCoordinates());
                });
            }
            getAddress(coords);
            l1 = coords[0];
            l2 = coords[1];
            //console.log('address: ', coords[0]);
            //console.log('address2: ', coords[1]);
            //console.log('search : ',control.SearchControl([parameters]));
            
        });


        // Создание метки.
        function createPlacemark(coords) {
            return new ymaps.Placemark(coords, {
                iconCaption: 'поиск...'
            }, {
                preset: 'islands#violetDotIconWithCaption',
                draggable: true
            });
        }

        // Определяем адрес по координатам (обратное геокодирование).
        function getAddress(coords) {

            myPlacemark_{myMap}.properties.set('iconCaption', 'поиск...');
            ymaps.geocode(coords).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);

                bootbox.prompt("Введите местоположение", function (event) {
                    //console.log(firstGeoObject.getAddressLine() + ' : ' + result);
                    myPlacemark_{myMap}.properties.set('iconCaption', result + ': ' + firstGeoObject.getAddressLine());
                    myPlacemark_{myMap}.properties.set('balloonContent', '<b>' + result + '</b><br> ' + firstGeoObject.getAddressLine());
                    if (countMarker >= countMarkers) {
                        countMarkers++;
                        myPoints.push({
                            coords: [l1, l2],
                            text: '<strong>' + result + '</strong><br>' + firstGeoObject.getAddressLine()
                        });
                        //////////////////////////////////////////////////////////
                        // Функция, устанавливающая для метки макет содержимого ее балуна.
                        function setBalloonContentLayout (placemark, panorama) {
                            // Создание макета содержимого балуна.
                            var BalloonContentLayout = ymaps.templateLayoutFactory.createClass(
                                '<div id="panorama" style="width:256px;height:156px"></div>', {
                                    // Переопределяем функцию build, чтобы при формировании макета
                                    // создавать в нем плеер панорам.
                                    build: function () {
                                        // Сначала вызываем метод build родительского класса.
                                        BalloonContentLayout.superclass.build.call(this);
                                        // Добавляем плеер панорам в содержимое балуна.
                                        this._openPanorama();
                                    },
                                    // Аналогично переопределяем функцию clear, чтобы удалять
                                    // плеер панорам при удалении макета с карты.
                                    clear: function () {
                                        this._destroyPanoramaPlayer();
                                        BalloonContentLayout.superclass.clear.call(this);
                                    },
                                    // Добавление плеера панорам.
                                    _openPanorama: function () {
                                        if (!this._panoramaPlayer) {
                                            // Получаем контейнер, в котором будет размещаться наша панорама.
                                            var el = this.getParentElement().querySelector('#panorama');
                                            this._panoramaPlayer = new ymaps.panorama.Player(el, panorama, {
                                                controls: ['panoramaName']
                                            });
                                        }
                                    },
                                    // Удаление плеера панорамы.
                                    _destroyPanoramaPlayer: function () {
                                        if (this._panoramaPlayer) {
                                            this._panoramaPlayer.destroy();
                                            this._panoramaPlayer = null;
                                        }
                                    }
                                });
                            // Устанавливаем созданный макет в опции метки.
                            placemark.options.set('balloonContentLayout', BalloonContentLayout);
                        }
                                            // В этой функции выполняем проверку на наличие панорамы в данной точке.
                        // Если панорама нашлась, то устанавливаем для балуна макет с этой панорамой,
                        // в противном случае задаем для балуна простое текстовое содержимое.
                        function requestForPanorama (e) {
                            var placemark = e.get('target'),
                                // Координаты точки, для которой будем запрашивать панораму.
                                coords = placemark.geometry.getCoordinates(),
                                // Тип панорамы (воздушная или наземная).
                                panoLayer = placemark.properties.get('panoLayer');
                    
                            placemark.properties.set('balloonContent', "Идет проверка на наличие панорамы...");
                    
                            // Запрашиваем объект панорамы.
                            ymaps.panorama.locate(coords, {
                                layer: panoLayer
                            }).then(
                                function (panoramas) {
                                    if (panoramas.length) {
                                        // Устанавливаем для балуна макет, содержащий найденную панораму.
                                        setBalloonContentLayout(placemark, panoramas[0]);
                                    } else {
                                        // Если панорам не нашлось, задаем
                                        // в содержимом балуна простой текст.
                                        placemark.properties.set('balloonContent', "Для данной точки панорамы нет.");
                                    }
                                },
                                function (err) {
                                    placemark.properties.set('balloonContent',
                                        "При попытке открыть панораму произошла ошибка: " + err.toString());
                                }
                            );
                        }
                    
                        // Слушаем на метках событие 'balloonopen': как только балун будет впервые открыт,
                        // выполняем проверку на наличие панорамы в данной точке и в случае успеха создаем
                        // макет с найденной панорамой.
                        // Событие открытия балуна будем слушать только один раз.
                        myPlacemark_{myMap}.events.once('balloonopen', requestForPanorama);
                        //////////////////////////////////////////////////////////
                       // myPoints.push(data);
                        myJson = JSON.stringify(myPoints);
                        /* console.log('myPoints', myPoints);
                         console.log('myPoints', JSON.stringify(myPoints));*/
                        $("<input hidden type='text' name = 'CoreInput[jsonb_8]' value='" + myJson + "'>").appendTo('#locations');
                        console.log('points ', myPoints)
                    } else {
                        myPoints[myPoints.length - 1] = {
                            coords: [l1, l2],
                            text:'<strong>' + result + '</strong><br>' + firstGeoObject.getAddressLine()
                        };
                       // myPoints.push(data);
                        myJson = JSON.stringify(myPoints);
                        /* console.log('myPoints', myPoints);
                        console.log('myPoints', JSON.stringify(myPoints));*/
                        $("<input hidden type='text' name = 'CoreInput[jsonb_8]' value='" + myJson + "'>").appendTo('#locations');
                        console.log('points ', myPoints)

                    }
                });
                if (countMarker >= countMarkers) {
                    // Заполняем коллекцию данными.
                    for (var i = 0, l = myPoints.length; i < l; i++) {
                        var point = myPoints[i];
                        myCollection_{myMap}.add(new ymaps.Placemark(
                            point.coords, {
                                balloonContentBody: point.text
                            }, {
            // Для данной метки нужно будет открыть воздушную панораму.
            panoLayer: 'yandex#airPanorama'
        }, {
            preset: 'islands#redIcon',
            openEmptyBalloon: true,
            balloonPanelMaxMapArea: 0
        }
                        ));
                    }
                }

                // Добавляем коллекцию меток на карту.
                {myMap}.geoObjects.add(myCollection_{myMap});

                /*myCollection.events.add('dblclick', function (e) {
                    if (!e.get('target').getGeoObjects) {
                        e.preventDefault()
                        myCollection.remove(e.get('target'));
                    }
                });*/

                // console.log('ddd',firstGeoObject.getAddressLine());
                myPlacemark_{myMap}.properties
                    .set({
                        // Формируем строку с данными об объекте.
                        iconCaption: [
                            // Название населенного пункта или вышестоящее административно-территориальное образование.
                            firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                            // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                            firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                        ].filter(Boolean).join(', '),
                        // В качестве контента балуна задаем строку с адресом объекта.
                        balloonContent: firstGeoObject.getAddressLine()
                    });
            });
        }

    }
JS,


    ];

    public function asset()
    {
        //$this->fileJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=9c3673c0-e4ff-47fb-8214-9ccf58d21b25');ymaps-2-1-76-searchbox-input__input
        $this->fileJs('https://api-maps.yandex.ru/2.1/?apikey=5fb7da25-bc18-4612-b304-83ea2266c510&lang=ru_RU');

    }

    public function codes()
    {       //vd($this->id);
        $this->htm = strtr($this->_layout['main'], [
            '{map}' => 'map_' . $this->getId(),
        ]);
        $this->css = strtr($this->_layout['css'], [
            '{map}' => 'map_' . $this->getId(),
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{testing}' => $this->id,
            '{map}' => 'map_' . $this->getId(),
            '{init}' => $this->getId() . '_func',
            '{zoom}' => $this->_config['zoom'],
            '{myMap}' => $this->getId(),//$this->_config['myMap'],
            '{coord}' => ($this->_config['coordinates'] !== null && $this->_config['coordinates'] !== '') ? $this->_config['coordinates'] : '0',
            '{countMarker}' => $this->_config['countMarker'],
            '{true}' => $this->_config['pointsFromDB'],
            //'{depend_id}' => ($this->_config['depend']['dependPlace'] == true) ? $this->_config['depend']['depend_id'] : 'none',
            /*'{routePanelControl}'=>$this->_config['controls'],
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
