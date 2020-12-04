<?php


namespace zetsoft\widgets\navigat;
/**
 *
 *
 * Author:  Qudratov Jahongir
 * Refactored: Toirov Azimjon
 */

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZLocationDetectWidget extends ZWidget
{

    public $config = [];
    public $_config = [
                'data'=>[
                    'name'=>'asdadas'
                ]
    ];

    public $_layout=[

        'main'=><<<HTML
<p>Click the button to get your coordinates.</p>
<!--
<button onclick="getLocation()">Try It</button>-->

<p id="{id}"></p>
HTML,


        'jsGetLocation'=><<<JS
         var x = document.getElementById("{id}");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }

    getLocation();
JS,

    ];

    public function codes()
    {

        $this->htm.=$this->_layout['main'];

        $this->js.=$this->_layout['jsGetLocation'];

    }
}
