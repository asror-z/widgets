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



class ZGoogleDb7Widget extends ZWidget
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
            <div id="floating-panel">
                <input onclick="getmyLocation()" type=button value="My location">
            </div>
           <div class="row">
                {saveForm}
                <div id="locations">
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7" id="search_area"  style="position: relative;  top: 50px;left: 20%; z-index: 5;">
                    {search}
                </div>                
                <div class="col-md-12">
                    <div id="map">
                       
                    </div>
                </div>
                <button id="SaveAllData" type="button" class="btn btn-outline-success">Save All Data</button>
                {img}
            </div>

            <div id="modalAddress" class="modal-dialog modal-dialog-centered" role="document" style="display: none; margin-top: -100%" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                            {modalTitle}
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body container">
                        <input type="text"  id="address_area_input" style="width:320px;value=" name="" value="default value with input" required >
                        <button id="save_address_btn" type="button" class="btn btn-outline-success">Save</button>
                   </div>
                </div>
             </div>   
                      
HTML,

        'css' => <<<CSS
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
CSS,
        'js' => <<<JS
                var map;
var cnt_ind;
var savedData;
var searchPlaceId = "";
var placesLatLng = [];
var count_markers = {matkerCount};
function createMap() {
    var options = {
        center:{lat:41.32, lng: 69.22},
        zoom: {zoom},
        mapTypeId: '{mapType}'
    }
    map = new google.maps.Map(document.getElementById('map'),options);
    


    // Create markers.
    for (var i = 0; i < savedData.length; i++) {
        var marker = new google.maps.Marker({
            map: map,
            title: "ZetSoft Markets " + i,
            position: {lat: parseFloat(savedData[i].lat), lng: parseFloat(savedData[i].lng)},
            icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/info-i_maps.png',
        });

    };

    
    map.addListener('click', function(event) {
        
        /*If selected place id*/
        if (searchPlaceId.length > 0 && placesLatLng.length < count_markers)
        {
            var marker = new google.maps.Marker({
                position: event.latLng,
                draggable: true,
                title: '' ,
                map: map
            });
            placesLatLng.push([event.latLng.lat(),event.latLng.lng()]);
            console.log(placesLatLng);
        }
        else if (placesLatLng.length >= count_markers) {
            alert("Makerlar soni oshib ketdi!")
        }
        else {
            alert("Iltimos avval qidiruv tizimi orqali mo'ljalni tanlang!")
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


$('#SaveAllData').on('click', function() {
    
    //$('#modalAddress').modal('show');
    
    var valueOfInput = document.getElementById('address_area_input');
    var address_area_input = $(valueOfInput).val();

          
    CreateInputs(address_area_input);
    
    
    $('#modalAddress').hide();
    
    console.log('saqlandi');
});

/*Get image searching */
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

/*Create hidden inputes*/
function CreateInputs(Address)
{
    console.log('salsasasd salom');
    for (var i = 0; i < placesLatLng.length; i++)
    {
        /*Convert COORDINaTE to human readable address*/
        var ltd  = placesLatLng[i][0];
        var lng =  placesLatLng[i][1];
        var key = 'AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo';
        var urlLink = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+ltd+','+lng+'&key='+key;
        var Address;
        fetch(urlLink)
            .then(response => response.json()) 
            .then(data => {
                var dataFet = data.results[0].formatted_address;
                console.log(data);
                Address = data.resul
        
        })
        .catch(err => console.warn(err.message));
        
        $("<input type='text' name = '{name}[" + cnt_ind + "][place_id]' value=" + searchPlaceId + ">").appendTo('#locations');
        $("<input type='text' name = '{name}[" + cnt_ind + "][address]' value='" + Address + "'>").appendTo('#locations');
        $("<input type='text' name = '{name}[" + cnt_ind + "][lat]' value=" + placesLatLng[i][0] + ">").appendTo('#locations');
        $("<input type='text' name = '{name}[" + cnt_ind + "][lng]' value=" + placesLatLng[i][1] + ">").appendTo('#locations');
        cnt_ind ++;
    }
    
    searchPlaceId = "";
    console.log(Address + "addres");
    console.log(placesLatLng);
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
}

JS,


    ];

    public function asset()
    {
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
            <img id="place_image" style="width:200px; height: 200px;  position: relative; bottom: 430px; left: 82%;" src="https://maps.googleapis.com/maps/api/place/photo?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&maxwidth=580
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
