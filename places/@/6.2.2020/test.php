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

class ZAllInOneGoogleWidget extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'height'=>600 ,
        'width'=>0,
        'zoom' => 9,
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
            'dependPlace' => false,
            'depend_id' => '',
        ],
        'matkerCount' => 1,
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
         <div class="row">
                {saveForm}
                <div id="locations">
                </div>             
                <div class="col-md-12">
                    <div class="col-lg-7 col-md-7 col-sm-7" id="search_area">      
                         {search}
                    </div> 
                    <div id="map" style=" height: {height}px;width:content-box  "> 
                                                                   
                    </div>                 
                </div>
                {img}
            </div>                    
             
HTML,

        'css' => <<<CSS
           input[id^="input-slider"] {
                padding: 5px;
           }
        
CSS,
        'js' => <<<JS
var map;
var cnt_ind;

/*For get already saved data*/
var savedData;

/*For save searched place_id*/
var searchPlaceId = "";

/*For save markers on map*/
var allMarkers = [];

/*For config max marker count*/
var count_markers = {matkerCount};

/*For change markers*/
var cnt_edited = 0;

var key = 'AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo';
function createMap() {
    var options = {
        center:{lat:41.32, lng: 69.22},
        zoom: {zoom},
        mapTypeId: '{mapType}'
    }
    map = new google.maps.Map(document.getElementById('map'),options);
   
    var markersOnMap = savedData.map(function(location, i) {
        
        var marker = new google.maps.Marker({
            position: {lat:parseFloat(location.lat), lng: parseFloat(location.lng)},
            label: 'Z' + i,
        });
        allMarkers.push(marker);
        return marker;
    });
    // Add a marker clusterer to manage the markers.
    var markerCluster = new MarkerClusterer(map, markersOnMap,
        {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    
    
   
    map.addListener('click', function(event) {
        
        /*If selected place id*/
        if (searchPlaceId.length > 0 && allMarkers.length < count_markers)
        {
            pushData(event.latLng.lat(), event.latLng.lng(), cnt_ind, 'push');
            
            cnt_ind ++;
            console.log('saqlandi');
            console.log(count_markers);
        }
        else if (allMarkers.length >= count_markers) {
            //alert("Oграниченный маркер!!");
            
            allMarkers.forEach(function (m) {m.setMap(null);});
            
            var editing_index = cnt_ind - count_markers + cnt_edited;
            
            pushData(event.latLng.lat(), event.latLng.lng(), editing_index, 'edit');
            
            cnt_edited = (cnt_edited + 1) % count_markers;
        }
        else {
            alert("Пожалуйста сначала выберите место на панели поиска!")
        }
    });

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
        document.getElementById('search_map').value = document.getElementById('{depend_id}').value;
        
    })
        
    
    
    
    
    var input = document.getElementById('search_map');
    var searchBox = new google.maps.places.SearchBox(input);

    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });
    /*Prevent to press ENTER button in search area*/
            
             $(window).keydown(function(event){
                if(event.keyCode == 13) {
                  event.preventDefault();
                  return false;
                }
              });
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

/*********************************************************************************/
     markers = [];
    /*For in search in map*/
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
            console.log('User qidirdi va topildi');
            console.log(p.place_id);
            var place_id = p.place_id;
            $("<input hidden type='text' name = '{name}[" + cnt_ind + "][place_id]' value=" + place_id + ">").appendTo('#locations'); 
            
            getPlaceImage(p.place_id);
             
            if(p.geometry.viewport)
                bounds.union(p.geometry.viewport);
            else bounds.union(p.geometry.location);
        })
        
        map.fitBounds(bounds);
        document.getElementById('{depend_id}').value = document.getElementById('search_map').value;
   
    })

}

 //Sending request via AJAX to get image of countries    
function getPlaceImage(place_id){
    //404 image
    var imageNotFound = 'https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled-1150x647.png';
     //Ajax request
     $.ajax({url: "\service.aspx?namespace=inputs&service=depDrops&method=map&args=" + place_id, success: function(result){
            if (result!=='https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled-1150x647.png'){
                
                $('#place_image').css('display','') ;
                document.getElementById("place_image").src = result;
            }
            else{
                $('#place_image').css('display','none');
            }
    }});
}

function pushData(lat, lng, index, type)
{

    var marker = new google.maps.Marker({
        position: {lat:lat, lng: lng},
        //draggable: true,
        title: '' ,
        map: map
    });
    
    if (type === 'push') {
        allMarkers.push(marker);
    }
    else if(type === 'edit') {
        allMarkers[index] = marker;
        
        for (var i = 0; i < allMarkers.length; i++) {
          allMarkers[i].setMap(map);
        }
    }
    /************************************************************************/
    var urlLink = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+ lat +','+ lng +'&key='+key;
    
    /******************************************************************/
    bootbox.prompt({
        title: "добавить ваше местоположение!", 
        centerVertical: true,
        callback: function(result){ 
            console.log(result);
            
            fetch(urlLink)
            .then(response => response.json()) 
            .then(data => {
                var address = data.results[0].formatted_address;
                /*console.log(data);*/
                var contentString = '<b style="text-align:center">'+result+'</b><br>'+address;
                var infowindow = new google.maps.InfoWindow({
                content: contentString 
                });
                infowindow.open(map, marker) 
                
                /* var address_area_input = $(valueOfInput).val();*/
                
                if (type === 'push') {
                    $("<input type='text' name = '{name}[" +index + "][place_id]' value='" + searchPlaceId + "'>").appendTo('#locations'); 
                    $("<input type='text' name = '{name}["+ index + "][address]' value='" + address + "'>").appendTo('#locations');
                    $("<input type='text' name = '{name}["+ index + "][user_entered_address]' value='" + result + "'>").appendTo('#locations');
                    $("<input type='text' name = '{name}["+ index + "][lat]' value=" + lat + ">").appendTo('#locations');
                    $("<input type='text' name = '{name}["+ index + "][lng]' value=" + lng + ">").appendTo('#locations');
                }
                else if (type === 'edit') {
                    
                    $("input[name='{name}["+ index + "][address]'").val(address);
                    $("input[name='{name}["+ index + "][user_entered_address]'").val(result);
                    $("input[name='{name}["+ index + "][lat]'").val(lat);
                    $("input[name='{name}["+ index + "][lng]'").val(lng);
                }
            
            })
            .catch(err => console.warn(err.message));
              
            }
        });
} 

/*If loaded show map*/
window.onload = function() {

    savedData = {generateAlreadySaved};
    cnt_ind = 0;
    for(var i = 0; i < savedData.length; i++)
    {
        console.log(savedData[i]);
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][place_id]' value='" + savedData[i].place_id + "'>").appendTo('#locations'); 
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][user_entered_address]' value='" + savedData[i].result + "'>").appendTo('#locations'); 
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][address]' value='" + savedData[i].address+ "'>").appendTo('#locations');
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][lat]' value=" + savedData[i].lat + ">").appendTo('#locations');
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][lng]' value=" + savedData[i].lng + ">").appendTo('#locations');
        cnt_ind++;
    }
    createMap();
}   

JS,


    ];

    public function asset()
    {
        $this->fileJs('https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places');
        /*$this->fileJs('\render\places\ZGoogleWidget\asset\js\main.js');*/
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js');
        $this->fileJs('https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js');
        $this->fileCss('\render\places\ZGoogleWidget\asset\css\style.css');


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

        $typeAHead = \zetsoft\widgets\inputes\ZKTypeaheadWidget::widget([
            'id' => 'ZKTypeaheadWidget_74514',
            'data' => [],
            'config' => [
                'minLength' => 1,
                'limit' => 5,
                'display' => 'value',
                'remote' => [
                    'method' => 'ajax',
                ],
            ],
            'model' => new \zetsoft\models\core\CoreInput(),
            'attribute' => 'string_2',
        ]);

        $saveForm = '';

        $saveForm = strtr($saveForm, [
           "{typeAhead}" => $typeAHead,
        ]);


        $search='' ;
        $image='' ;

        if($this->_config['searchAutoComplete'])
        {
            $search='
                <input id="search_map" type="tel" class="form-control" placeholder="Search ..."/>
            ' ;
        }

        if($this->_config['searchPlaceImageShow'])
        {
            $image='
            <img id="place_image" style="width:200px; height: 200px;  position: relative; bottom: 550px; left: 88%;" src="https://maps.googleapis.com/maps/api/place/photo?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&maxwidth=580
&photoreference=CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU" />
           ' ;

        }

        if(isset($this->config['depend']['dependPlace']) && $this->config['depend']['dependPlace']){
            $this->_config['depend']['depend_id'] = $this->config['depend']['depend_id'];
        }

        $this->htm = strtr($this->_layout['main'], [
            //'{hInput}' => $input,
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{modalTitle}' => Az::l('Adding Location'),
            '{search}' => $search,
            '{img}' => $image,
            '{saveForm}' => $saveForm,
            '{height}'  =>$this->_config['height'],
            '{width}'  =>$this->_config['width'],
        ]);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{depend_id}' => ($this->_config['depend']['dependPlace'] == true)?$this->_config['depend']['depend_id']: 'none',
            '{matkerCount}' => $this->_config['matkerCount'],
            '{zoom}' => $this->_config['zoom'],
            '{mapType}' => $this->_config['mapType'],
            '{generateAlreadySaved}' => (isset($this->value) > 0)?json_encode($this->value) :json_encode([])
        ]);

    }

}
