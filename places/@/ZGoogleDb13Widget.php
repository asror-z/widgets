<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev,Khojiakbar Kodirov, Zoirjon Sobirov
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
use yii\bootstrap\Widget;

class ZGoogleDb13Widget extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'height'=>600 ,
        'zoom' => 9,
        'multiple' => true,
        'disableDoubleClickZoom' => 9,
        'fullScreenControlPosition' => self::fullScreenControlPosition['LEFT_TOP'],
        'MapTypeControlStyle' => self::MapTypeControlStyle['DEFAULT'],
        'mapTypeControlPosition' => self::mapTypeControlPosition['TOP_CENTER'],
        'mapType' => self::mapType['roadmap'],
        'scrollwheel' => true,
        'zoomControl' => true,
        'zoomControlPosition' => self::zoomControlPosition['TOP_LEFT'],
        'grapes' =>true,
        'searchAutoComplete' => true,
        'searchPlaceImageShow' => true,
        'depend' => [
            'dependPlace' => true,
            'depend_id' => '',
        ],
        'matkerCount' => 1,
        'draggable' => false,
    ];

    public const fullScreenControlPosition = [
        'BOTTOM_CENTER' => 'BOTTOM_CENTER',
        'TOP_RIGHT' => 'TOP_RIGHT',
        'BOTTOM_LEFT' => 'BOTTOM_LEFT',
        'BOTTOM_RIGHT' => 'BOTTOM_RIGHT',
        'LEFT_BOTTOM' => 'LEFT_BOTTOM',
        'LEFT_CENTER' => 'LEFT_CENTER',
        'LEFT_TOP' => 'LEFT_TOP',
        'RIGHT_BOTTOM' => 'RIGHT_BOTTOM',
        'RIGHT_CENTER' => 'RIGHT_CENTER',
        'RIGHT_TOP' => 'RIGHT_TOP',
        'TOP_CENTER' => 'TOP_CENTER',
        'TOP_LEFT' => 'TOP_LEFT',
    ];

    public const MapTypeControlStyle = [
        'DEFAULT' => 'DEFAULT',
        'DROPDOWN_MENU' => 'DROPDOWN_MENU',
        'HORIZONTAL_BAR' => 'HORIZONTAL_BAR',
    ];

    public const mapTypeControlPosition = [
        'BOTTOM_CENTER' => 'BOTTOM_CENTER',
        'TOP_RIGHT' => 'TOP_RIGHT',
        'BOTTOM_LEFT' => 'BOTTOM_LEFT',
        'BOTTOM_RIGHT' => 'BOTTOM_RIGHT',
        'LEFT_BOTTOM' => 'LEFT_BOTTOM',
        'LEFT_CENTER' => 'LEFT_CENTER',
        'LEFT_TOP' => 'LEFT_TOP',
        'RIGHT_BOTTOM' => 'RIGHT_BOTTOM',
        'RIGHT_CENTER' => 'RIGHT_CENTER',
        'RIGHT_TOP' => 'RIGHT_TOP',
        'TOP_CENTER' => 'TOP_CENTER',
        'TOP_LEFT' => 'TOP_LEFT',

    ];

    public const mapType = [
        'roadmap' => 'roadmap',
        'satellite' => 'satellite',
        'hybrid' => 'hybrid',
        'terrain' => 'terrain',
    ];
    #endregion

    public $_layout = [
        'main' => <<<HTML
         <div>
            <div id="{id}"> 
        </div>                    
             
HTML,

        'css' => <<<CSS
            #{id}{
                height: 400px;
            }
       
CSS,
        'js' => <<<JS
function createMap{id}() {
    console.log('map');
    var options = {
        center: {lat: 41.32, lng: 69.22},
        zoom: 12,
    }
    var map = new google.maps.Map(document.getElementById('{id}'), options);
    
    
}

JS,


    ];

    public function asset()
    {
        $id = "map".substr($this->id, 19);
        $url = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places&callback=createMap'.$id;

        $this->fileJs($url, 3);
    }

    public const zoomControlPosition = [
        'BOTTOM_CENTER' => 'BOTTOM_CENTER',
        'TOP_RIGHT' => 'TOP_RIGHT',
        'BOTTOM_LEFT' => 'BOTTOM_LEFT',
        'BOTTOM_RIGHT' => 'BOTTOM_RIGHT',
        'LEFT_BOTTOM' => 'LEFT_BOTTOM',
        'LEFT_CENTER' => 'LEFT_CENTER',
        'LEFT_TOP' => 'LEFT_TOP',
        'RIGHT_BOTTOM' => 'RIGHT_BOTTOM',
        'RIGHT_CENTER' => 'RIGHT_CENTER',
        'RIGHT_TOP' => 'RIGHT_TOP',
        'TOP_CENTER' => 'TOP_CENTER',
        'TOP_LEFT' => 'TOP_LEFT',
    ];

    public function codes()
    {
        $id = "map".substr($this->id, 19);
        $this->htm = strtr($this->_layout['main'], [
            //'{hInput}'  => $input,
            '{id}'        => $id,
            '{name}'      => $this->name,
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{id}'                      => $id,
        ]);

    }

    public function run()
    {
        $id = "map".substr($this->id, 19);

        $js = strtr($this->_layout['js'], [
            '{id}'                      => $id,
            '{name}'                    => $this->name,
            '{zoom}'                    => $this->_config['zoom'],
            '{mapType}'                 => $this->_config['mapType'],
            '{matkerCount}'             => $this->_config['matkerCount'],
            '{draggable}'               => ($this->_config['draggable'])? 'true': 'false',
            '{depend_id}'               => ($this->_config['depend']['dependPlace'] == true)?$this->_config['depend']['depend_id']: 'none',
            '{searchAutoComplete}'      => ($this->_config['searchAutoComplete'])? 'true': 'false',
            '{searchPlaceImageShow}'    => ($this->_config['searchPlaceImageShow'])? 'true': 'false',
            '{generateAlreadySaved}'    => (isset($this->value) > 0)?json_encode($this->value) :json_encode([])
        ]);

        $this->view->registerJs($js, 1);
        return parent::run();
    }

}
