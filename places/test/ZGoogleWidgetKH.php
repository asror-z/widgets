<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev,Khojiakbar Kodirov, Zoirjon Sobirov
 */
namespace zetsoft\widgets\places\test;


use kartik\builder\Form;
use kartik\widgets\Typeahead;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\places\ZGoogleSideBarWidget ;



class ZGoogleWidgetKH extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
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
            <a type="button" class="btn btn-primary" href="/render/places/ZGoogleWidget/PopUpMap.html" up-modal=".map">My location</a>

           
            <div id="floating-panel">
                <input onclick="getmyLocation()" type=button value="My location">
            </div>
           <div class="row">
                {saveForm}
                <div id="locations">
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7" id="search_area"  style="position: absolute;  top: 100px; left: 30%; z-index: 5;">
                    {search}
                </div>
                                
                <div class="col-md-12">
                    {sidebar}
                    <div id="map" style="position: relative; width: 100%; height: 700px;">
                       
                    </div>
                </div>
                {img}
            </div>

            <div class="modal" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Adding Location</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                         </div>
                      <div class="modal-body">
                            <input type="text" id="address_area_input" value="" name=""  required>
                            <button id="save_address_btn" type="button" class="btn btn-outline-success">SAVE</button> 
                      </div>
                    
                    </div>
                </div>
            </div>  
                      
HTML,

        'css' => <<<CSS
            #my_location {
                height: 100%;
            }
      /* Optional: Makes the sample page fill the window. */
      
            #map {
                height: 600px;
            }
            #floating-panel {
                position: absolute;
                top: 10px;
                left: 25%;
                z-index: 5;
                background-color: #fff;
                padding: 5px;
                border: 1px solid #999;
                text-align: center;
                font-family: 'Roboto','sans-serif';
                line-height: 30px;
                padding-left: 10px;
            }
            @media (min-width: 1025px) {
                 #search_map{
                    width: 100%;
                 }
                 #place_image{
                    width:200px ;
                    height: 200px ;
                 }
            }
            @media (min-width: 768px) and (max-width: 1024px) {
                 #search_map{
                    width: 150px;
                 }
                 #place_image{
                    width:100px ;
                    height:100px ;
                 }
            }
            @media (max-width: 767px) {
                 #search_map{
                    width: 50px;
                 }
                 #place_image{
                    width:50px ;
                    height:50px ;
                 }
            }
CSS,
        'js' => <<<JS
        var map;
        var cnt_ind;
        var savedData;
        var searchPlaceId = "";
        function createMap() {
            var options = {
                center:{lat:41.32, lng: 69.22},
                zoom: {zoom},
                mapTypeId: '{mapType}'
            }
        map = new google.maps.Map(document.getElementById('map'),options);
    //Create a sidebar
    


    // Create markers.
    for (var i = 0; i < savedData.length; i++) {
        var marker = new google.maps.Marker({
            map: map,
            title: "ZetSoft Markets " + i,
            position: {lat: parseFloat(savedData[i].lat), lng: parseFloat(savedData[i].lng)},
            icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/info-i_maps.png',
        });

    };


    var contentString = document.getElementById("modalAddress");
    //var contentString = document.getElementById("marker_saver");

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    map.addListener('click', function(event) {
        
        /*If selected place id*/
        if (searchPlaceId.length > 0)
        {
            var marker = new google.maps.Marker({
                position: event.latLng,
                draggable: true,
                title: '' ,
                map: map
            });
            
             $('#map').on('click',function () {
                $('.modal').modal('show') ;

            }) ;
            


            var valueOfInput = document.getElementById('address_area_input');
            $('#save_address_btn').on('click', function() {
                var address_area_input = $(valueOfInput).val();
    
                $("<input hidden type='text' name = '{name}[" + cnt_ind + "][place_id]' value=" + searchPlaceId + ">").appendTo('#locations');
                $("<input hidden type='text' name = '{name}[" + cnt_ind + "][address]' value='" + address_area_input + "'>").appendTo('#locations');
                $("<input hidden type='text' name = '{name}[" + cnt_ind + "][lat]' value=" + event.latLng.lat() + ">").appendTo('#locations');
                $("<input hidden type='text' name = '{name}[" + cnt_ind + "][lng]' value=" + event.latLng.lng() + ">").appendTo('#locations');
                cnt_ind ++;
                searchPlaceId = "";
                console.log('saqlandi');
            });
            $('#save_address_btn').on('click', function() {
                $('#modalAddress').hide();
            });
        }
        else alert('Place_id tanlanmadi')
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
            google.maps.event.addListener(marker, "rightclick", function (point) {delMarker(marker)});
            
            console.log('User qidirdi va topildi');
            console.log(p.place_id);
            
            var delMarker = function (markerPar) {
                markerPar.setMap(null);
            }
            
            getPlaceImage(p.place_id);

            if(p.geometry.viewport)
                bounds.union(p.geometry.viewport);
            else bounds.union(p.geometry.location);
        })
        map.fitBounds(bounds);
    })
}

  
/*Prevent to press ENTER button in search area*/
$('#search_area').keydown(function(event){
    if(event.keyCode === 13) {
        event.preventDefault();
        return false;
    }
});

function getPlaceImage(place_id)
{
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
/*If loaded show map*/
window.onload = function() {

    savedData = {generateAlreadySaved};
    cnt_ind = 0;
    for(var i = 0; i < savedData.length; i++)
    {
        console.log(savedData[i]);
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][place_id]' value='" + savedData[i].place_id + "'>").appendTo('#locations'); 
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][address]' value='" + savedData[i].address+ "'>").appendTo('#locations');
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][lat]' value=" + savedData[i].lat + ">").appendTo('#locations');
        $("<input hidden type='text' name = '{name}[" + cnt_ind + "][lng]' value=" + savedData[i].lng + ">").appendTo('#locations');
        cnt_ind++;
    }
    createMap();
    
    function getmyLocation() {
    infoWindow = new google.maps.InfoWindow;
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}
}

JS,


    ];

    public function asset()
    {
        $this->fileCss('https://unpkg.com/unpoly@0.61.1/dist/unpoly.min.css') ;
        $this->fileJs('https://unpkg.com/unpoly@0.61.1/dist/unpoly.min.js') ;
        $this->fileJs('https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places');
        $this->fileJs('\render\places\ZGoogleWidget\assets\js\main.js');

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
        $sidebar = ZGoogleSideBarWidget::widget([

        ]);

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
            <img id="place_image" style="  position: absolute; bottom: 430px; left: 80%;" src="https://maps.googleapis.com/maps/api/place/photo?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&maxwidth=580
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
            '{sidebar}'=>$sidebar,
        ]);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{depend_id}' => ($this->_config['depend']['dependPlace'] == true)?$this->_config['depend']['depend_id']: 'none',
            '{zoom}' => $this->_config['zoom'],
            '{mapType}' => $this->_config['mapType'],
            '{generateAlreadySaved}' => (isset($this->value) > 0)?json_encode($this->value) :json_encode([])
        ]);

    }

}
