<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev,Khojiakbar Kodirov, Zoirjon Sobirov, Odilov Shukurullo
 */
namespace zetsoft\widgets\places;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use yii\web\View;

class ZLeafletWidgetX extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];

    public static $grapes = [

    ];

    public $_layout = [
        'main' => <<<HTML
         <div id="map"></div>
         <div id="lat"></div>
         <div id="alpha"></div>
         <div id="beta"></div>
         <div id="gamma"></div>                 
        <script src="/render/places/ZLeafletWidget/demo/device_motions/js/leaflet.js"></script>
    <script src="/render/places/ZLeafletWidget/demo/device_motions/js/leaflet.rotatedMarker.js"></script>     
HTML,

'js' => <<<JS
     var latLng = [0, 0];


        var map = L.map('map', {
            center: [41, 70],
            zoom: 20,
            layers: [
                L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                })
            ]
        });


        var greenIcon = L.icon({
            iconUrl: 'https://cdn.pixabay.com/photo/2013/07/12/11/58/car-145008_960_720.png',
            iconSize:     [20, 40], // size of the icon
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        var m = L.marker(map.getCenter(), {
            //center: latLng,
            icon:  greenIcon,
            rotationAngle: 0,
            draggable: true
        });
       // let heading = geolocationCoordinatesInstance.heading
     
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition)

        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        function showPosition(position) {
            console.log(position.coords)
        }
        if(window.DeviceOrientationEvent) {
            window.addEventListener('deviceorientation', function(event) {
                let alpha = event.alpha;
                let beta = event.beta;
                let gamma = event.gamma;
                //console.log(event)


               
                document.getElementById('lat').innerHTML = "<p>" +
                    'Cordinate ' + latLng + "</br>" +
                    "</p>";
                document.getElementById('alpha').innerHTML = "<p>" +
                    'alpha ' + alpha + "</br>" +
                    "</p>";
                document.getElementById('beta').innerHTML = "<p>" +
                    'beta ' +beta + "</br>" +
                    "</p>";
                document.getElementById('gamma').innerHTML = "<p>" +
                    'gamma '  + gamma + "</br>" +
                    "</p>";

                map.addLayer(m.setRotationAngle(-360 - alpha));

            })
        }
JS,

'css' => <<<CSS
    * {
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        #map {
            width: 100%;
            height: 75vh;
        }

        .block_ac {
            height: 20%;
            width: 100%;
        }
CSS,


    ];


    public function asset()
    {
        $this->fileJs('https://unpkg.com/leaflet@1.7.1/dist/leaflet.js');
        $this->fileCss('https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
    }



    public function codes(){

        $this->htm = strtr($this->_layout['main'],[]);
        $this->js = strtr($this->_layout['js'],[]);

    }

}
