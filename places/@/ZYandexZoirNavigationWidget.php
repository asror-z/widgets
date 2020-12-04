<?php
/**
 *
 * Class ZYandexZoirNavigationWidget
 * Created By: Zoirjon Sobirov
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

class ZYandexZoirNavigationWidget extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'zoom'              => self::zoom['zoom'],
        'controls'          => self::controls['routePanelControl'],
        'type'              => self::type['auto'],
        'types'             => self::types['typse'],
        'fromEnabled'       => self::fromEnabled['true'],
        'from'              => self::from['from'],
        'toEnabled'         => self::toEnabled['true'],
        'allowSwitch'       => self::allowSwitch['false'],
        'reverseGeocoding'  => self::reverseGeocoding['true'],
        'data'              => self::data['data'],
        'options'           => self::options['options'],
        'myMap'             => 'myMap',
        'idMap'             => 'idMap',
        'countMarker'       => 1,
        'place_address_id'  => [],
        'coordinaties'      => '0',
        'pointsFromDB'      => 'false',
        'depend' => [
            'dependPlace'   => true,
            'depend_id'     => 'coreinput-string_9',
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
        #{map} {
            width: 100%;
            height: 95vh;
        }
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
            '{coord}' => ($this->_config['coordinaties'] !== null && $this->_config['coordinaties'] !== '') ? $this->_config['coordinaties'] : '0',
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
