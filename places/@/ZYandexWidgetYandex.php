<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev,Khojiakbar Kodirov, Zoirjon Sobirov, Anvar Jabborov
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

class ZYandexWidgetYandex extends ZWidget
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
        <div id="{id}"> </div>                 
                     
HTML,

        'css' => <<<CSS
       html, body {
            width: 100%;
            height: 95%;
            margin: 0;
            padding: 0;
            font-family: Arial;
            font-size: 14px;
        }
        #{id} {
            width: 100%;
            height: 95vh;
        }
        .header {
            padding: 5px;
        }
CSS,
        'js' => <<<JS
 
 ymaps.ready(init);

function init() {
    var myPlacemark,
        myMap = new ymaps.Map('{id }', {
            center: [41.327069, 69.281797],
            zoom: {zoom},
             controls: ['zoomControl', 'searchControl', 'typeSelector',  'fullscreenControl', 'routeButtonControl'],
        }, {
            searchControlProvider: 'yandex#search'
        });
          var l1,l2;
          var data=[]
    // Слушаем клик на карте.
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');

        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getAddress(coords);  
        l1 = coords[0];
        l2 = coords[1];
      
        console.log('address: ',coords[0]);
        console.log('address2: ',coords[1]);
        //console.log('address: ',control.SearchControl([parameters]));
    });

     var massiv=[];
    // Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            preset: 'islands#violetDotIconWithCaption',
            draggable: true
        });
    }
      // Создаем коллекцию.
        myCollection = new ymaps.GeoObjectCollection();
    // Создаем массив с данными.
        myPoints = [];
       
    // Определяем адрес по координатам (обратное геокодирование).
    function getAddress(coords) {
        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            bootbox.prompt("please enter something... ", function(result){ 
    console.log(firstGeoObject.getAddressLine()+' : '+result);
    var resultData = '<b>'+result+'</b><br/>';
     myPoints.push({ coords: [l1, l2], text: resultData +firstGeoObject.getAddressLine()},);
            var data={
                           'address':result+'<br>'+firstGeoObject.getAddressLine(),
                           'lat':l1, 
                           'lng':l2, 
                           };
                           massiv.push(data);
     //myJson=     JSON.stringify(myPoints);
            /* console.log('myPoints', myPoints);
             console.log('myPoints', JSON.stringify(myPoints));*/
              $("<input hidden  type='text' name = 'CoreInput[jsonb_8]' value='" + JSON.stringify(massiv) + "'>").appendTo('#locations');
});
                    // Заполняем коллекцию данными.
    for (var i = 0, l = myPoints.length; i < l; i++) {
        var point = myPoints[i];
        myCollection.add(new ymaps.Placemark(
            point.coords, {
                balloonContentBody: point.text
            }
        ));
    }

    // Добавляем коллекцию меток на карту.
    myMap.geoObjects.add(myCollection);
    
    /*myCollection.events.add('dblclick', function (e) {
        if (!e.get('target').getGeoObjects) {
            e.preventDefault()
            myCollection.remove(e.get('target'));
        }
    });*/
                           
               console.log('ddd',JSON.stringify(massiv));
            myPlacemark.properties
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
        //$this->fileJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=9c3673c0-e4ff-47fb-8214-9ccf58d21b25');
        $this->fileJs('https://api-maps.yandex.ru/2.1/?apikey=5fb7da25-bc18-4612-b304-83ea2266c510&lang=ru_RU');

    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{id}' =>$this->id,
        ]);
        $this->css = strtr($this->_layout['css'], [
        '{id}'=>$this ->id,
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{id}' =>$this->id,
            '{zoom}' => $this->_config['zoom'],
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
