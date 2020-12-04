<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev,Khojiakbar Kodirov, Zoirjon Sobirov, Anvar Jabborov
 */

namespace zetsoft\widgets\places\test;

use kartik\builder\Form;
use kartik\widgets\Typeahead;
use zetsoft\models\place\PlaceAdress;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\former\ZFormWidget;

class ZYandexRouteWidgetindex extends ZWidget
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
        'points' => 2,
        'waypoints' => true,
        //'MapUseType'=> 'write',
        'mapEditable' => true,
        'coordinaties' => '0',
        'countMarker' => 1,
        'pointsFromDB' => 'false',
    ];
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
    public const progress ='test';
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
    

    public $_layout = [
        'main' => <<<HTML
             <div id="locations"></div>
        <div id="{map}"> </div>  
        <div id="list"></div>               
                     
HTML,

        'css' => <<<CSS
       /*html, body,*/ #{map} {
            width: 100%;
            height: 100vh;
            padding: 0;
            margin: 0;
        }
        #list{
        padding: 10px;}
CSS,
        'js' => <<<JS
// setInterval(function() {
     
 //});

 ymaps.ready({init});
function {init}() {

    var suggestView = new ymaps.SuggestView('testing', {results: 1, offset: [20, 30]});
        $('#testing').on('input',function (event){
         searchControl.search($("#testing").val());
        });
    var {myMap} = new ymaps.Map("{map}", {
            center: [41.30856, 69.31493],
            zoom: {zoom},
            controls:['zoomControl', 'searchControl', 'typeSelector', 'fullscreenControl',],
        }, {
            searchControlProvider: 'yandex#search'
        });
         var nameSearch = 'Tashkent City Park';
var searchControl = {myMap}.controls.get('searchControl');

searchControl.events.add('submit', function () {
    //console.log('request: ' + searchControl.getRequestString());
    nameSearch = searchControl.getRequestString();
    $("#testing").val(nameSearch);
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
            {j1}
           
        
}
     
JS,
        'j1' => <<<JS
    var obj = {coord};
          var obj2=[]; 
          var leng=  {_points};
            if ({_points}>obj.length)
               leng = obj.length;
for(var i =0; i<leng; i++)  {
   obj2.push(obj[i].coords);
    }
            ///////////////////
            // Добавляем коллекцию меток на карту.
            //{myMap}.geoObjects.add(myCollection_{myMap});
    // Добавим на карту схему проезда
    // от улицы Крылатские холмы до станции метро "Кунцевская"
    // через станцию "Молодежная" и затем до станции "Пионерская".
    // Точки маршрута можно задавать 3 способами:
    // как строка, как объект или как массив геокоординат.
    ymaps.route( obj2/*[
          str
   
        obj[0], //'Москва, улица Крылатские холмы',
        {
            point: 'Москва, метро Молодежная',
            // метро "Молодежная" - транзитная точка
            // (проезжать через эту точку, но не останавливаться в ней).
            type: 'viaPoint'
        },
        [55.740867, 37.416619],
        [55.73653252833374, 37.424580296356176],
        
        
        [55.731272, 37.447198], // метро "Кунцевская".
        obj[1],//'Москва, метро Пионерская' ,
    ]*/ ).then(function (route) {
        {myMap}.geoObjects.add(route);
        // Зададим содержание иконок начальной и конечной точкам маршрута.
        // С помощью метода getWayPoints() получаем массив точек маршрута.
        // Массив транзитных точек маршрута можно получить с помощью метода getViaPoints.
        var points = route.getWayPoints(),
            lastPoint = points.getLength() - 1;
        // Задаем стиль метки - иконки будут красного цвета, и
        // их изображения будут растягиваться под контент.
        points.options.set('preset', 'islands#redStretchyIcon');
        // Задаем контент меток в начальной и конечной точках.
        points.get(0).properties.set('iconContent', 'Точка отправления');
        points.get(lastPoint).properties.set('iconContent', 'Точка прибытия');

        // Проанализируем маршрут по сегментам.
        // Сегмент - участок маршрута, который нужно проехать до следующего
        // изменения направления движения.
        // Для того, чтобы получить сегменты маршрута, сначала необходимо получить
        // отдельно каждый путь маршрута.
        // Весь маршрут делится на два пути:
        // 1) от улицы Крылатские холмы до станции "Кунцевская";
        // 2) от станции "Кунцевская" до "Пионерская".

        var moveList = 'Трогаемся,</br>',
            way,
            segments;
        // Получаем массив путей.
        for (var i = 0; i < route.getPaths().getLength(); i++) {
            way = route.getPaths().get(i);
            segments = way.getSegments();
            for (var j = 0; j < segments.length; j++) {
                var street = segments[j].getStreet();
                moveList += ('Едем ' + segments[j].getHumanAction() + (street ? ' на ' + street : '') + ', проезжаем ' + segments[j].getLength() + ' м.,');
                moveList += '</br>'
            }
        }
        moveList += 'Останавливаемся.';
        // Выводим маршрутный лист.
        $('#list').append(moveList);
    }, function (error) {
        alert('Возникла ошибка: ' + error.message);
    });
JS,

        'j2' => <<<JS
       var data = [];
        var countMarkers = 1;
        var countMarker = {countMarker};
        if (countMarker < 1)
            countMarker = 1;
        // Создаем коллекцию.
        myCollection_{myMap} = new ymaps.GeoObjectCollection();
        var myPlacemark_{myMap};
        var l1, l2;
        
        // Создаем массив с данными.
        myPoints = [];
        
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
                console.log(coords);
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
                        console.log('points ', myPointcoos)

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
JS,
   'js3'=><<<JS
   function {init} () {
    /**
     * Создание мультимаршрута.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml
     */
       if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
             var pos= { "coords":[position.coords.latitude, position.coords.longitude]};
      var obj = pos;
          var obj2=[]; 
          
for(var i =0; i<obj.length; i++)  {
   obj2.push(obj[i].coords);
    }
    console.log(obj2);
    var multiRoute = new ymaps.multiRouter.MultiRoute({
        referencePoints: obj2, 
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
            removeWayPoints: true
        });
       
    });
      
    buttonEditor.events.add("deselect", function () {
        // Выключение режима редактирования.
        multiRoute.editor.stop();
        var data = [];
        for (var i = 0; i < multiRoute.properties._data.waypoints.length; i++)  {
            data.push({coords: multiRoute.properties._data.waypoints[i].coordinates,
            text: multiRoute.properties._data.waypoints[i].coordinates,},);
        }
        myJson = JSON.stringify(data);
                        /* console.log('myPoints', myPoints);
                         console.log('myPoints', JSON.stringify(myPoints));*/
                        $("<input hidden type='text' name = 'CoreInput[jsonb_8]' value='" + myJson + "'>").appendTo('#locations');
       // console.log('multiRoute: ',multiRoute.properties._data.waypoints[0].coordinates);
        console.log('multiRoute: ',myJson);
    });

    // Создаем карту с добавленной на нее кнопкой.
    var {myMap} = new ymaps.Map('{map}', {
        center: [41.30856, 69.31493],
        zoom: {zoom},
        controls: [buttonEditor]
    }, {
        buttonMaxWidth: 300
    });

    // Добавляем мультимаршрут на карту.
    {myMap}.geoObjects.add(multiRoute);
}

ymaps.ready({init});
});
            }
JS,

    ];

    public function asset()
    {
        //$this->fileJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=9c3673c0-e4ff-47fb-8214-9ccf58d21b25');
        $this->fileJs('https://api-maps.yandex.ru/2.1/?apikey=5fb7da25-bc18-4612-b304-83ea2266c510&lang=ru_RU');

    }

    public function codes()
    {    //vd($this->_config['coordinaties']);

        $this->htm = strtr($this->_layout['main'], [
            '{map}' => $this->getId() . '_map',
        ]);
        $this->css = strtr($this->_layout['css'], [
            '{map}' => $this->getId() . '_map',
        ]);
        $j1 = strtr($this->_layout['j1'], [
            '{testing}' => $this->id,
            '{_points}' => $this->_config['points'],
            '{map}' => $this->getId() . '_map',
            '{zoom}' => $this->_config['zoom'],
            '{init}' => $this->getId() . '_func',
            '{myMap}' => $this->getId(),
            '{coord}' => ($this->_config['coordinaties'] !== null && $this->_config['coordinaties'] !== '') ? $this->_config['coordinaties'] : '0',

        ]);
        $j2 = strtr($this->_layout['j2'], [
            '{testing}' => $this->id,
            '{map}' => $this->getId() . '_map',
            '{init}' => $this->getId() . '_func',
            '{zoom}' => $this->_config['zoom'],
            '{myMap}' => $this->getId(),//$this->_config['myMap'],
            '{coord}' => ($this->_config['coordinaties'] !== null && $this->_config['coordinaties'] !== '') ? $this->_config['coordinaties'] : '0',
            '{countMarker}' => $this->_config['countMarker'],
            '{true}' => $this->_config['pointsFromDB'],
           // '{depend_id}' => ($this->_config['depend']['dependPlace'] == true) ? $this->_config['depend']['depend_id'] : 'none',

        ]);
        if($this->_config['mapEditable']===true)
        $this->js = strtr($this->_layout['js3'], [
            '{myMap}' => $this->getId(),//$this->_config['myMap'],
            '{coord}' => ($this->_config['coordinaties'] !== null && $this->_config['coordinaties'] !== '') ? $this->_config['coordinaties'] : '0',
            '{init}' => $this->getId() . '_func',
            '{map}' => $this->getId() . '_map',
            '{zoom}' => $this->_config['zoom'],
        ]); else
        $this->js = strtr($this->_layout['js'], [
            '{testing}' => $this->id,
            '{_points}' => $this->_config['points'],
            '{map}' => $this->getId() . '_map',
            '{zoom}' => $this->_config['zoom'],
            '{init}' => $this->getId() . '_func',
            '{myMap}' => $this->getId(),
            '{coord}' => ($this->_config['coordinaties'] !== null && $this->_config['coordinaties'] !== '') ? $this->_config['coordinaties'] : '0',
            '{j1}' => $this->_config['waypoints'] === true ? $j1 : $j2,

        ]);

    }

}
