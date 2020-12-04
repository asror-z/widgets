<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev, Zoirjon Sobirov
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

class ZGoogleDbWidgetRavshan extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'height'=>600 ,
        'zoom' => 9,
        'multiple' => false,
        'disableDoubleClickZoom' => 9,
        'fullScreenControlPosition' => self::fullScreenControlPosition['LEFT_TOP'],
        'MapTypeControlStyle' => self::MapTypeControlStyle['DEFAULT'],
        'mapTypeControlPosition' => self::mapTypeControlPosition['TOP_CENTER'],
        'mapType' => self::mapType['roadmap'],
        'scrollwheel' => true,
        'zoomControl' => true,
        'zoomControlPosition' => self::zoomControlPosition['TOP_LEFT'],
        'grapes' =>true,
        'mapUseType' => 'read',
        'searchAutoComplete' => true,
        'searchPlaceImageShow' => false,
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

    ];

    public function asset()
    {
       
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
        $id= $this->id;

        $this->htm =  <<<HTML
<style>
    #map{
        height: 500px;
    }
    .slider_div{
        margin-top: 40px;
    }
    input[id^="input-slider"] {
        padding: 5px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="row">
        <div class="col-md-7" style="position: absolute;
            top: 110px;
            left: 20%;
            z-index: 5;">
            <input type="tel" class="form-control search_map" placeholder="Search ..."/>
        </div>
    </div>
    <div class="map">

    </div>
    <img class="place_image" style="float:right; position:relative ; bottom:430px ;width:200px; height:200px;" src="https://maps.googleapis.com/maps/api/place/photo?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&maxwidth=580
&photoreference=CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU"/>
</div>

<script>
    var map;
    function createMap() {
        var options = {
            center:{lat:41.32, lng: 69.22},
            zoom:12,
        }
        map = new google.maps.Map(document.querySelector('.map'),options);


        var iconBase = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/';

        var icons = {
            parking: {
                icon: iconBase + 'parking_lot_maps.png'
            },
            library: {
                icon: iconBase + 'library_maps.png'
            },
            info: {
                icon: iconBase + 'info-i_maps.png'
            }
        };
        var features = [
            {
                position: new google.maps.LatLng(41.31721, 69.22630),
                type: 'info'
            }, {
                position: new google.maps.LatLng(41.30539, 69.20820),
                type: 'info'
            }, {
                position: new google.maps.LatLng(41.31747, 69.24912),
                type: 'info'
            }, {
                position: new google.maps.LatLng(41.30910, 69.19907),
                type: 'info'
            }, {
                position: new google.maps.LatLng(41.32725, 69.28011),
                type: 'info'
            }, {
                position: new google.maps.LatLng(41.33872, 69.23089),
                type: 'info'
            }, {
                position: new google.maps.LatLng(41.30784, 69.23094),
                type: 'info'
            }
        ];

        // Create markers.
        for (var i = 0; i < features.length; i++) {
            var marker = new google.maps.Marker({
                map: map,
                title: "ZetSoft Markets " + i,
                position: features[i].position,
                icon: icons[features[i].type].icon,
            });
        };


        var input = document.querySelector('.search_map');
        var searchBox = new google.maps.places.SearchBox(input);

        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];

        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if(places.length === 0)
                return null;

            markers.forEach(function (m) {m.setMap(null);});
            markers = [];

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (p) {
                if(!p.geometry)
                    return null;

                markers.push(new google.maps.Marker({
                    map:map,
                    title: p.name,
                    position: p.geometry.location,
                    // icon: 'https://maps.google.com/maps/contrib/104742213001054094436',
                }));
                console.log(p);

                $.ajax({url: "\service.aspx?namespace=inputs&service=depDrops&method=map&args=" + p.place_id, success: function(result){
                        // $("#place_image").src(result);
                        document.querySelector("place_image").src = result;
                    }});

                if(p.geometry.viewport)
                    bounds.union(p.geometry.viewport);
                else bounds.union(p.geometry.location);
            })
            map.fitBounds(bounds);
        })

        // 41.30784, 69.23094
        poly = new google.maps.Polyline({
            strokeColor: '#000000',
            strokeOpacity: 1.0,
            strokeWeight: 3
        });
        poly.setMap(map);

        // Add a listener for the click event
        map.addListener('click', addLatLng);
    }

    // Handles click events on a map, and adds a new point to the Polyline.
    function addLatLng(event) {
        var path = poly.getPath();

        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear.
        path.push(event.latLng);

        // Add a new marker at the new plotted point on the polyline.
        var marker = new google.maps.Marker({
            position: event.latLng,
            title: '#' + path.getLength(),
            map: map
        });
    }
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places&callback=createMap" charset="utf-8"></script>

HTML;



    }

}
