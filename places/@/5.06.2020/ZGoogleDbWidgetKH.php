<?php

namespace zetsoft\widgets\places;


use zetsoft\system\kernels\ZWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use kartik\builder\Form;
use zetsoft\widgets\inputes\ZHInputGroupWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\system\Az;


/**
 *
 * Class ZGoogleWidget
 * Created By: Khojiakbar Kodirov
 *
 */
class ZGoogleDbWidgetKH extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'zoom' => 9,
        'mapType' => self::mapType['roadmap'],
        'disableDoubleClickZoom' => 9,
        'fullScreenControlPosition' => self::fullScreenControlPosition['LEFT_TOP'],
        'MapTypeControlStyle' => self::MapTypeControlStyle['DEFAULT'],
        'mapTypeControlPosition' => self::mapTypeControlPosition['TOP_CENTER'],
        'scrollwheel' => true,
        'zoomControl' => true,
        'zoomControlPosition' => self::zoomControlPosition['TOP_LEFT'],
        'grapes' =>true,
        'searchAutoComplete' => true,
        'searchPlaceImageShow' => true,
    ];

    public const mapType = [
        'roadmap' => 'roadmap',
        'satellite' => 'satellite',
        'hybrid' => 'hybrid',
        'terrain' => 'terrain',
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

    public $_layout = [
        'main' => <<<HTML
           <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
            <div class="row">
        <div class="col-md-7" style="position: relative;
            top: 50px;
            left: 20%;
            z-index: 5;">
            {search}
        </div>
    </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
             <i class="fas fa-location-arrow fa-2x" id="my-location" style="position: absolute; top: 47px; right: 82px ; z-index:1; color: Dodgerblue; background-color: white; padding: 5px; border-radius: 5px;"></i>
            <div id="map">

            </div>
            <img id="place_image" style="float:right; position:relative ; bottom:430px ;width:200px; height:200px;" src="https://maps.googleapis.com/maps/api/place/photo?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&maxwidth=580
&photoreference=CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU" />
          <script>
          
        var map;
        function createMap() {
            var options = {
                center:{lat:41.32, lng: 69.22},
                zoom:12,
            }
            map = new google.maps.Map(document.getElementById('map'),options);

           
            var iconBase = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/';
             
            
            $('#my-location').on('click',function() {
            var infoWindow = new google.maps.InfoWindow;
                 if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            console.log(pos) ;

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
      

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);    
            }
            }) ; 
                
           
                
              $('#map').on('dblclick',function () {
                $('#exampleModal').modal('show') ;

            }) ;
            

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
            }
            
            //search By ClassName
             var inputPlace = document.getElementById('coreinput-string_1');
             var searchBoxPlace = new google.maps.places.SearchBox(inputPlace);

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
                    console.log(p);

                    $.ajax({url: "\service.aspx?namespace=inputs&service=depDrops&method=map&args=" + p.place_id, success: function(result){
                    if (result!=='https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled-1150x647.png'){
                        // $("#place_image").src(result);
                        $('#place_image').css('display','') ;
                        document.getElementById("place_image").src = result;
                      }  
                      else{
                         
                         $('#place_image').css('display','none') ;
                      }
                    }});

                    if(p.geometry.viewport)
                        bounds.union(p.geometry.viewport);
                    else bounds.union(p.geometry.location);
                })
                map.fitBounds(bounds);
            })
                
             
            //search By Input 
            var input = document.getElementById('search_map');
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
                    if (result!=='https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled-1150x647.png'){
                        // $("#place_image").src(result);
                        $('#place_image').css('display','') ;
                        document.getElementById("place_image").src = result;
                      }  
                      else{
                         
                         $('#place_image').css('display','none') ;
                      }
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places&callback=createMap"
        async defer>
    </script>
HTML,

        'css' => <<<CSS
           input[id^="input-slider"] {
                padding: 5px;
           }
CSS,

    ];

    public function asset()
    {
        $this->fileJs('https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places');
        $this->fileJs('https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places');
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
        $model = $this->modelGet(\zetsoft\models\core\CoreInput::class, 7);
        /** @var ZView $this */

        $items = Az::$app->forms->modelz->data();
        $form = $this->activeBegin();
        $modal= ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config'=>[
                'topBtn' => false,
            ],
            'rows' => [

                [
                    'attributes' => [
                        'string_2' => [
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => ZHInputWidget::class,
                            'options' => [
                                'config' => [
                                    'hasPlace' => true,
                                    'hasIcon' => false,
                                ]
                            ]
                        ],

                    ],

                ],

            ],
            'form'=>$this->activeEnd(),
        ]);




        $search='' ;
        $image='' ;

        if($this->_config['searchAutoComplete'])
        {
            $search='
                <input id="search_map" type="tel" class="form-control search" placeholder="Search ..."/>
            ' ;
        }

        /* if($this->_config['searchPlaceImageShow'])
         {
            $image='
             <img id="place_image" style="float:right; position:relative ; bottom:430px ;width:200px; height:200px;" src="https://maps.googleapis.com/maps/api/place/photo?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&maxwidth=580
 &photoreference=CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU" />
            ' ;

         } */


        $this->htm = strtr($this->_layout['main'], [
            '{search}'=>$search,
            // '{img}'=>$image,
            '{modal}'=> '',
        ]);

        $this->css = ($this->_layout['css']);

    }

}
