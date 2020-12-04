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





class ZYandexDbGeoLocationControl extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
       'center'=>'[55.751574, 37.573856]',
       'zoom'=>9,
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
             
     ymaps.ready(function () {
        var myMap = new ymaps.Map('map', {
            center: {center},
            zoom: {zoom},
            controls: ['geolocationControl']
        });
    });
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
