<?php
/**
 *
 * Class ZLeafletWidget
 * @author Zoirjon Sobirov
 *  Telegram : https://t.me/Zoirjon_Sobirov
 */

namespace zetsoft\widgets\places;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use yii\web\View;

class ZMapsHybridWidet  extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $widgetId;
    public $config = [];
    public $_config = [
        'height'                => 600, // height in vh
        'width'                 => 100, //width in %
        'zoom'                  => 9,
        'markerCount'           => 2,
        '{mapUseType}'          =>'read', //read && write
        'mapVision'             => 'typical', //'typical', '3d'
        'mapDegree'             => 0, //same as mapVision but its in number
        'mapType'               => 'google',   //'leaflet', 'mapBox','osm','osrm','mapTalks','yandex' ;
        'scrollwheel'           => true,
        'zoomControl'           => true,
        'searchAutoComplete'    => true,
        'searchPlaceImageShow'  => false,
        'dependPlace'           => true,
        'depend_id'             => '',
        'draggable'             => false,
        'dependAttr'            => '',
        'matkerCount'           => 1,            // number min == 1, max == n
        'limitWayPoints'        => 10,          // number min == 2, max == n(but there's a limit for google api request https://developers.google.com/maps/documentation/directions/usage-and-billing)
        'mapUseType'            => 'read',   //string == write || read
        'optimizeWaypoints'     => true,    //boolean == true || false
        'isDepend'              => '',
        '{savedCoordinates}'    => []
    ];


    #endregion

    public $_layout = [
        'main' => <<<HTML
         <div class="row">
         <div class="border rounded px-2 burgerDiv">     
          </div>
          <div id="{id}" style="height: 600px; width: 100%" ><div>
    </div>
                           
             
HTML,
        'css' => <<<CSS
      .pac-container {
        z-index: 99999;
        position: relative!important; top:-99%!important; display: block;
      } 
      .burgerDiv{
         z-index: 999999;
         position: absolute;
         top: 5%;
         left: 15%;
         background-color: white;
         padding: 5px;
       }     
      .container{width:100%;height:100%}
      .attr{background-color:#34495e;color:#fff;padding:0px 4px;font:16px sans-serif}
    

CSS,
        'js' => <<<JS
//#region global vars
/*API key*/
var key = 'AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo';
/*Is show in map input search auto complete*/
var searchAutoComplete = {searchAutoComplete};

/*Is show image*/
var searchPlaceImageShow = {searchPlaceImageShow};
//#endregion

var mapIdType = '{mapTypes}'

if (mapIdType == 'google'){
    createGoogleMap();
}else if (mapIdType == 'leaflet'){
    createLeafletMap();
}else if (mapIdType == 'mapBox'){
    createMapBoxMap();
}else if (mapIdType == 'osm'){
    createOsmMap();
}else if (mapIdType == 'osrm'){
    createOsrmMap();
}else if (mapIdType == 'mapTalks'){
    createMaptalksMap();
}else if (mapIdType == 'yandex'){
    createYandexMap();
}
function createGoogleMap() {

/*If loaded show map*/
$('#{id}').ready(
    function () {
        /*For direction Render global*/
        var directionsRenderer;
        
        console.log("{id} map creating...")
        
        var cnt_ind = 0;
                 
        var map;
        
        /*For save searched place_id*/
        var searchPlaceId = "";
        
        /*For save markers on map*/
        var allMarkers = [];
        
        /*For config max marker count*/
        var count_markers = {matkerCount};
        
        /*For direction Service*/
        var directionsService;
        
        /*For change markers*/
        var cnt_edited = 0;
        
        var mapUseType = '{mapUseType}';
     
        //#region init
        var options = {
            center:{lat:41.32, lng: 69.22},
            zoom: {zoom},
            mapTypeId: '{mapType}'
        }
        map = new google.maps.Map(document.getElementById('{id}'),options);
        
        var savedData = mapValueInstalization();
        console.log(savedData);
        allMarkers = savedData.map(function(location, i) {
            var marker = new google.maps.Marker({
                position: {lat:parseFloat(location.lat), lng: parseFloat(location.lng)},
                label: 'Z' + i,
            });
            return marker;
        });
        console.log(allMarkers);
        
            // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, allMarkers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        
        //endregion 
        
if (mapUseType === 'read') {
    createReadMap();
} else createWriteMap();


//region Write Map    
function createWriteMap()
{
    map.addListener('click', function(event) {
        /*If selected place id*/
        if (allMarkers.length < count_markers)
        {
            var marker = new google.maps.Marker({
                position: event.latLng,
                draggable: {draggable},
                title: '' ,
                map: map
            });
            
            pushData(map, event.latLng.lat(), event.latLng.lng(), marker, allMarkers.length, 'push');
            
            allMarkers.push(marker);
            console.log('saqlandi');
            console.log(count_markers);
        }
        else if (allMarkers.length >= count_markers) {
            console.log("Oграниченный маркер!!");
            var marker = new google.maps.Marker({
                position: event.latLng,
                draggable: {draggable},
                title: '' ,
                map: map
            });
            allMarkers.forEach(function (m) {m.setMap(null);});
            
            
            var editing_index = allMarkers.length - count_markers + cnt_edited;
            allMarkers[editing_index] = marker;
            console.log(editing_index);
            console.log(allMarkers);
            for (var i = 0; i < allMarkers.length; i++) {
              allMarkers[i].setMap(map);
            }
            pushData(map,  event.latLng.lat(), event.latLng.lng(), marker, editing_index, 'edit');
            
            cnt_edited = (cnt_edited + 1) % count_markers;
        }
        else {
            alert("Пожалуйста сначала выберите место на панели поиска!")
        }
    });
    //#region Search with depend
    var Placeinput = document.getElementById('{depend_id}');
    var searchBoxPlace = new google.maps.places.SearchBox(Placeinput);

    map.addListener('bounds_changed', function () {
        searchBoxPlace.setBounds(map.getBounds());
    });

    var markers = [];

    searchBoxPlace.addListener('places_changed', function () {
        var places = searchBoxPlace.getPlaces();

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
            console.log('Topildi ');
            console.log(p.place_id);
            searchPlaceId = p.place_id;
             
            
            getPlaceImage(searchPlaceId);

            if(p.geometry.viewport)
                bounds.union(p.geometry.viewport);
            else bounds.union(p.geometry.location);
        })
        map.fitBounds(bounds);
        
    })
    //#endregion
    
    
    /*********************************************************************************/
         /*IP address*/
    var btn_address = document.getElementById('getmyAddress');
    $(btn_address).on('click', function() {
        infoWindow = new google.maps.InfoWindow;
        var location = navigator.geolocation;
       
        if (location) {
        location.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent();
               
                markers.push(new google.maps.Marker({
                map:map,
                title: pos.name,
                position:pos,
                // icon: 'https://maps.google.com/maps/contrib/104742213001054094436',
            }));
                /*infoWindow.open(map);*/
                
                map.setCenter(pos);
                
                 var urlLink2 = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&key='+key;
                 fetch(urlLink2)
                    .then(response => response.json()) 
                     .then(data => {
                         var dataFet = data.results[0].formatted_address;
                        console.log(data);
                        var contentString = dataFet;
                        var infowindow = new google.maps.InfoWindow({
                                content: contentString
                        });
                        
                        infowindow.open(map, marker,document.contentString.insertAdjacentHTML(
                           "beforeend",                                                 
                        ));
                    })
                    .catch(err => console.warn(err.message));
            },
           function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: Служба геолокации не удалась.' :
            'Error: Ваш браузер не поддерживает геолокацию.');
        infoWindow.open(map);
    }
}
//#endregion

    });
    /*load data to showing map*/
function mapValueInstalization() {
    var data = {generateAlreadySaved};
    var index = 0;
    for(var i = 0; i < data.length; i++)
    {
        $("<input hidden type='text' name = '{name}[" + index + "][place_id]' value='" + data[i].place_id + "'>").appendTo('#{id}-locations');
        $("<input hidden type='text' name = '{name}[" + index + "][address]' value='" + data[i].address+ "'>").appendTo('#{id}-locations');
        $("<input hidden type='text' name = '{name}[" + index + "][user_entered_address]' value='" + data[i].user_entered_address + "'>").appendTo('#{id}-locations');
        $("<input hidden type='text' name = '{name}[" + index + "][lat]' value=" + data[i].lat + ">").appendTo('#{id}-locations');
        $("<input hidden type='text' name = '{name}[" + index + "][lng]' value=" + data[i].lng + ">").appendTo('#{id}-locations');
        $("<hr>").appendTo('#{id}-locations');
        index++;
    }
    return data;
}

   {google.js}
}

function createLeafletMap() {
   console.log('Leaflet')
}
function createMapBoxMap() {
   console.log('MapBox')
}
function createOsmMap() {
   console.log('Osm')
}
function createOsrmMap() {
   console.log('Osrm')
}
function createMaptalksMap() {
   console.log('Maptalks')
}
function createYandexMap() {
   console.log('yandex')
}
JS,


    ];


    public function asset()
    {
        $this->fileCss('https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
        $this->fileJs('https://unpkg.com/leaflet@1.7.1/dist/leaflet.js');
        $this->fileCss('https://rawcdn.githack.com/stefanocudini/leaflet-search/10de9b0d00c34f487b2c296f19f3b83bb152b822/src/leaflet-search.css');
        $this->fileJs('https://rawcdn.githack.com/stefanocudini/leaflet-search/10de9b0d00c34f487b2c296f19f3b83bb152b822/src/leaflet-search.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/maptalks/dist/maptalks.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/maptalks@0.49.1/dist/maptalks.min.js');
        $this->fileJs('https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js', 2);
        $url = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places';
        $this->fileJs($url, 3);
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js', View::POS_END);
        $this->fileCss('\render\places\ZGoogleWidget\asset\main\css\style.css');
        
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            //'{hInput}'  => $input,
            '{id}' => $this->getId(),
            '{name}' => $this->name,
            '{modalTitle}' => Az::l('Adding Location'),
            '{height}' => $this->_config['height'],
            //'{width}'     =>$this->_config['width'],
        ]);
        $mapFunc = file_get_contents(Root . '/render/places/ZGoogleWidget/asset/main/js/google.js');

        $this->js = strtr($this->_layout['js'], [
            '{id}'                 => $this->getId(),
            '{name}'               => $this->name,
            '{zoom}'               => $this->_config['zoom'],
            '{markerCount}'        => $this->_config['markerCount'],
            '{mapDegree}'          => $this->_config['mapDegree'],
            '{mapTypes}'           => $this->_config['mapType'],
            '{savedCoordinates}'   => (isset($this->value) > 0)?json_encode($this->value) :json_encode([]),
            '{google.js}'          => $mapFunc,
            '{matkerCount}'        => $this->_config['matkerCount'],
            /*'{leafletMap.js}'      => $mapFunc,
            '{mapBox.js}'          => $mapFunc,
            '{osmMap.js}'          => $mapFunc,
            '{osrmMap.js}'         => $mapFunc,  */
            '{generateAlreadySaved}'    => (isset($this->value) > 0)?json_encode($this->value) :json_encode([])
        ]);

    }

}
