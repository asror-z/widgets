<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\places;

use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZIconPickerWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZYandexWidgetAzizjon extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'trafficControl' => true,
        'routeButtonControl' => true,
        'zoomControl' => true,
        'searchControl' => true,
        'typeSelector' => true,
        'geolocationControl' => true,
        'fullscreenControl' => true,
        'customControl' => true,
        'rulerControl' => true,
        'routeButtonControl' => true,

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
           
        <div id="map" ></div>
HTML,

        'js' => <<<JS
            
          ymaps.ready(function () {
         
         

            var myMap = new ymaps.Map('map', {
                center: [55.753994, 37.622093],
                zoom: 9,
                // Добавим кнопку для построения маршрутов на карту.

                behaviors: 'default',

                type: 'yandex#map',
                autoFitToViewport: 'ifNull',
                exitFullscreenByEsc: true,
                fullscreenZIndex: 10000,
                mapAutoFocus: true,
                maxAnimationZoomDifference: 5,
                nativeFullscreen: false,
                /*projection: ,*/
                suppressMapOpenBlock: false,
                suppressObsoleteBrowserNotifier: false,
                yandexMapAutoSwitch: true,
                yandexMapDisablePoiInteractivity: true,


                
                 
                controls: [
                    /*'button',          // got config
                    'cityList',        // got config
                     'managerControl', // got config*/
                    '{trafficControl}',
                    //'{routeButtonControl}',
                    '{zoomControl}',
                    '{searchControl}',
                    '{typeSelector}',
                    '{geolocationControl}',
                    '{fullscreenControl}',
                    //'{customControl}',
                    '{rulerControl}',

                ],

            },
            
                   
                    ({searchControlProvider: 'yandex#search'})
                );

             

           /* let control = myMap.controls.get('routeButtonControl');

            // Зададим координаты пункта отправления с помощью геолокации.
            control.routePanel.geolocate('from');

            // Откроем панель для построения маршрутов.
            control.state.set('expanded', true);*/




            

            
            var balloon = new ymaps.Balloon(myMap);
            
            balloon.options.setParent(myMap.options);

            
            balloon.open(myMap.getCenter());


            myMap.balloon.open([41.3, 69.25], "HERE I",
                {
                    // Option: do not show the close button.
                    closeButton: false,
                    autoPan: true,
                    autoPanCheckZoomRange: true,
                    autoPanDuration: 200,
                    autoPanMargin: 34,
                    autoPanUseMapMargin: true,
                    closeTimeout: 700,
                   
                    layout: 'islands#balloon',
                    maxHeight: 1400,
                    maxWidht: 1000,
                    minHeight: 100,
                    minWidht: 100,
                    ofset: '',
                    _openTimeout: 1500,
                    pane: 'ballon',
                    panelContentLayout: null,
                    panelMaxHeightRatio: 0,  //need 0
                    panelMaxMapArea: 1,
                    shadow: true,
                    
                    shadowOffset: [0, 0],
                    zIndex: '2',
                });




            
            myMap.behaviors
                
                .disable(['drag', 'rightMouseButtonMagnifier'])

                .enable('unruler');   // need <--RULER
            
            myMap.options.set('scrollZoomSpeed', 0, {
                DblClickZoom: {
                    centering: true,
                    duration: 100,
                    UseMapMargin: true,
                },


                Drag: {
                    actionCursor: 'grabbing',
                    cursor: 'grab',
                    inertia: true,
                    inertiaDuration: true,
                    tremor: 2
                },

                LeftMouseButtonMagnifier: {
                    actionCursor: 'crosshari',
                    cursor: 'zoom',
                    duration: 300
                },

                MultiTouch: {
                    tremor: 20

                },

                RightMouseButtonMagnifie: {
                    actionCursor: 'crosshari',
                    duration: 300
                },

                ScrollZoom: {
                    maximumDelta: 5,
                    speed: 5,
                }
            });






           
            var circle = new ymaps.Circle([[50, 75], 1000000], {
                geodesic: true,
                cursor: 'pointer',
                draggable: false,
                fill: true,
                fillColor: '0066ff99',
                fillMethod: 'stretch',
                fillOpacity: 1,
                hasBallon: true,
                hashInt: true,
                hideIconOnBalloonOpen: true,
                interactiveZIndex: false,
                interactivityModel: "default#geoObject",
                opacity: 1,
                openBalloonOnClick: true,
                openEmptyBalloon: false,
                openEmptyHint: false,
                openHintOnHover: true,
                outline: true,
                pane: "areas",
                strokeColor: "0066ffff",
                strokeOpacity: 1,
                syncOverlayInit: false,
                useMapMarginInDragging: true,
            });


            myMap.controls.add(circle);



            

            // Creating a button and adding it to the map.
            /*var button = new ymaps.control.Button({
                data: {
                    // Setting an icon for the button.
                    image: 'images/button.jpg',
                    // Text on the icon.
                    content: 'Save',
                    // Text for the popup hint.
                    title: 'Click to save the route'
                },
                options: {
                    // Setting up the button options.

                    selectOnClick: true,
                    adjustMapMargin: false,
                    float: 'right',
                    floatIndex: 0,
                    position_bottom: 'auto',
                    position_left: 'auto',
                    position_right: 'auto',
                    position_top: 'auto',
                    size: 'auto',
                    visible: true,
                    enbled: true,
                    selected: false,

                    // The button will have three states-icon, text, and icon + text.
                    // So we'll define three values for the button width for all states.
                    maxWidth: [30, 100, 150]
                }
            });
            myMap.controls.add(button, { float: 'left', floatIndex: 100 });*/




           

            // Adding the control to the map and immediately switching it
            // to the full-screen mode.
            var fullscreenControl = new ymaps.control.FullscreenControl(
                {
                    options: {
                        adjustMapMargin: false,
                        float: 'right',
                        floatIndex: 300,
                        maxWidth: 28,
                        position_bottom: 'auto',
                        position_left: 'auto',
                        position_right: 'auto',
                        position_top: 'auto',
                        visible: true,
                        enbled: true,
                        selected: false,
                    }
                }
            );
            myMap.controls.add(fullscreenControl);
            fullscreenControl.enterFullscreen();



            

            // Adding the control with a custom geolocation placemark on the map.
            var geolocationControl = new ymaps.control.GeolocationControl({
                options: {
                    noPlacemark: true,
                    adjustMapMargin: false,
                    float: 'right',
                    floatIndex: 300,
                    maxWidth: 28,
                    position_bottom: 'auto',
                    position_left: 'auto',
                    position_right: 'auto',
                    position_top: 'auto',
                    visible: true,
                    useMapMargin: true,

                }

            });

            myMap.controls.add(geolocationControl);




            var cityList = new ymaps.control.ListBox({
                data: {
                    content: 'Select a city'
                },
                items: [
                    new ymaps.control.ListBoxItem('Moscow'),
                    new ymaps.control.ListBoxItem('Novosibirsk'),
                    new ymaps.control.ListBoxItem({
                        options: {
                            type: 'separator',
                            adjustMapMargin: false,
                            collapseOnBlur: true,
                            expandOnClick: true,
                            float: 'right',
                            floatIndex: 0,
                            maxWidth: 90,
                          
                            position_bottom: 'auto',
                            position_left: 'auto',
                            position_right: 'auto',
                            position_top: 'auto',
                            visible: true,
                            useMapMargin: true,
                        }
                    }),
                    new ymaps.control.ListBoxItem('New York'),
                ]
            });
            cityList.get(0).events.add('click', function () {
                myMap.setCenter([55.752736, 37.606815]);
            });
            cityList.get(1).events.add('click', function () {
                myMap.setCenter([55.026366, 82.907803]);
            });
            cityList.get(3).events.add('click', function () {
                myMap.setCenter([40.695537, -73.97552]);
            });
            myMap.controls.add(cityList, { floatIndex: 0 });



           
            // Creating a RouteButton control and adding it to the map.
            var routeButton = new ymaps.control.RouteButton({
                options: {
                    adjustMapMargin: false,
                    collapseOnBlur: true,
                    autofocus: true,
                    float: 'right',
                    floatIndex: 0,
                    popupWidth: '210px',
                    popupFloat: 'auto',
                    position_bottom: 'auto',
                    position_left: 10,
                    position_right: 'auto',
                    size: 'auto',
                    position_top: 108,
                    visible: true,
                    expanded: false,
                }
            });
            myMap.controls.add(routeButton);


           
            // Creating 300px-wide route panel with header with filled starting point.
            myMap.controls.add('routePanelControl', {
                maxWidth: 300,
            });
         var routePanel = myMap.controls.get('routePanelControl').routePanel;
            routePanel.options.set('adjustMapMargin', true, {
                autofocus: true,
                float: "left",
                floatIndex: 0,
                maxWidth: '210px',
                title: 'Routes',
                visible: true,

            }

            );
            routePanel.state.set({
                fromEnabled: false,
                from: "moscow",
                to: "saint petersburg",
                type: "auto"
            }
            );



            

            var rulerControl = new ymaps.control.RulerControl({
                options: {
                    adjustMapMargin: false,
                    position_bottom: '30',
                    position_left: 'auto',
                    position_right: 10,
                    visible: true,
                    scaleLine: true,
                    position_top: 'auto',
                    layout: 'round#rulerLayout'
                }
            });
            myMap.controls.add(rulerControl);


            
           /*var managerControl = new ymaps.control.ManagerControl({
               options: {
                margin: 10,
                states: ['small', 'medium', 'large'],
                float: "right",
                floatIndex: 0,
                position: {
                    bottom: 'auto',
                    left: 'auto',
                    right: 'auto',
                    top: 'auto'
                    },
                }
            });
            myMap.controls.add(managerControl);*/

            
            // Creating a control and adding it to the map.

            var searchControl = new ymaps.control.SearchControl({
                options: {
                    float: 'left',
                    formLayout: 'islands#searchControlFormLayout',
                    kind: 'house',
                    layout: 'islands#searchControlLayout',
                    floatIndex: 200,
                    maxWidth: [30, 72, 315],
                    noCentering: false,
                    noPlacemark: false,
                    adjustMapMargin: false,
                    noSelect: false,
                    noSuggestPanel: false,
                    popupLayout: 'islands#searchControlPopupLayout',
                    position_bottom: 'auto',
                    position_left: 'auto',
                    position_right: 'auto',
                    provider: 'yandex#map',
                    searchCoordOrder: 'latlong',
                    size: 'auto',
                    suppressYandexSearch: false,
                    position_top: 'auto',
                    fitMaxWidth: false,
                    zoomMargin: 0,
                    useMapMargin: true,
                }
            });
            myMap.controls.add(searchControl);




           


            var trafficControl = new ymaps.control.TrafficControl({
                state: {
                    adjustMapMargin: false,
                    collapseOnBlur: true,
                    float: 'right',
                    floatIndex: 100,
                    maxWidht: [26, 195, 195],
                    popupWidth: '210px',
                    position_bottom: 'auto',
                    position_left: 10,
                    position_right: 'auto',
                    size: 'auto',
                    position_top: 108,
                    visible: true,
                    trafficShown: false,
                    providerKey: 'traffic#actual',

                }
            });
            myMap.controls.add(trafficControl, { top: 10, left: 10 });


            


            // Creating a small zoom control and adding it to the map.
            var zoomControl = new ymaps.control.ZoomControl({
                options: {
                    adjustMapMargin: false,
                    position_bottom: 'auto',
                    position_left: 10,
                    position_right: 'auto',
                    position_top: 108,
                    size: 'auto',
                    visible: true,
                    zoomDuration: 200,
                    zoomStep: 1,
                }
            });
            myMap.controls.add(zoomControl);




           
            // Creating the source for hotspot data. We aren't setting the key value,
            // so the name of the handler function (padding jsonp in the request) is generated automatically.

            var tileUrlTemplate = 'hotspot_data/%z/tile_x=%x&y=%y',

               
                keyTemplate = 'testCallback_tile_%c',

                
                imgUrlTemplate = 'images/%z/tile_x=%x&y=%y.png',

                // Creating the data source for the hotpsot layer.
                objSource = new ymaps.hotspot.ObjectSource(tileUrlTemplate, keyTemplate),

                // Creating the images layer and the hotspot layer.
                imgLayer = new ymaps.Layer(imgUrlTemplate, { tileTransparent: true }),
                hotspotLayer = new ymaps.hotspot.Layer(objSource, {
                    cursor: 'pointer',
                    dontChangeCursor: false,
                    hasBalloon: true,
                    hashInt: true,
                    interactivityModel: 'default#layer',
                    openBalloonOnClick: true,
                    openEmptyBalloon: false,
                    openEmptyHint: false,
                    openHintOnHover: true,
                    pane: 'events',
                });

            // Adding layers to the map.
            myMap.layers.add(hotspotLayer);
            myMap.layers.add(imgLayer);






           
          /* layer.tileContainer.CanvasContainer(layer[{
                options: {
                    notFoundTile: null,
                    tileClass: 'default#canvas',
                    tileTransparent: false,

                }
            }]);
            


*/
            layer.tileContainer.DomContainer(layer[{
                options: {
                    // notFoundTile: null,
                    // tileClass: 'default#dom',
                    tileTransparent: false,
                }
            }]);




            

            // Adds an OSM layer to the map.
            myMap.layers.add(new ymaps.Layer('http://tile.openstreetmap.org/%z/%x/%y.png', {
                projection: ymaps.projection.sphericalMercator
            }));
            myMap.copyrights.add('&amp;copy; OpenStreetMap contributors, CC-BY-SA');

            Layer(tileUrlTemplate[{
                options: {
                    brightness: 0.5,
                    notFoundTile: null,
                    pane: 'ground',
                    titleSize: [256, 256],
                    tileTransparent: false,
                    

                }
            }]);



           
            // Creating a round placemark with a 20-pixel radius.
            var placemark = new ymaps.Placemark([59.936952, 30.343334], null, {
                iconLayout: 'default#image',
                iconImageHref: '/render/Images/Galleries/CSSJS/Fancyapps Fancybox/html_files/604514162_640.jpg',
                iconImageSize: [40, 40],
                iconImageOffset: [-20, -20],
                // Defining a hotspot on top of the image.
                iconShape: {
                    type: 'Circle',
                    coordinates: [0, 0],
                    radius: 20
                },
            });





            var geoObject = new ymaps.Placemark([55.25, 37.43], {
                // Data for generating a diagram.
                data: [
                    { weight: 5, color: '#224080' },
                    { weight: 3, color: '#408022' },
                    { weight: 2, color: '#802240' },
                    {
                        options: {
                            pieChartRadius: 25 + 2,
                            pieChartCoreFillStyle: 'white',
                            pieChartCoreRadius: 15,
                            pieChartStrokeStyle: 'white',
                            pieChartStrokeWidth: 2,
                        }

                    }
                ]
            }, {
                iconLayout: 'default#pieChart',
                // You can also use the "icon" prefix to redefine layout options.
                iconPieChartCoreRadius: 15
            });

            myMap.geoObjects.add(geoObject);




            


            var objectManager = new ymaps.LoadingObjectManager('http://myServer.com/tile?bbox=%b', {
                // Enabling clustering.
                clusterize: true,
                // Cluster options are set with the "cluster" prefix.
                clusterHasBalloon: false,
                // Geo object options are set with the "geoObject" prefix.
                geoObjectOpenBalloonOnClick: false
            });

            // You can set options directly for child collections.
            objectManager.clusters.options.set({
                preset: 'islands#grayClusterIcons',
                clusterize: false,
                loadTileSize: 256,
                paddingParamName: 'callback',
                paddingTemplate: null,
                splitRequests: false,
                syncOverlayInit: false,
                viewportMargin: 128,
                hintContentLayout: ymaps.templateLayoutFactory.createClass('Group of objects'),
            });
            objectManager.objects.options.set('preset', 'islands#grayIcon');


            // Initializing a map with a known view area.
            // We assume that jQuery is enabled on the page.




            // Initializing a map from geocoding results.




            

            myMap.layer.Manager(map[{
                options: {
                    rafficImageZIndex: 201,
                    trafficInfoZIndex: 1,
                    trafficJamZIndex: 0,

                }
            }]);



            multiRouter.Editor(multiRoute[state[{
                options: {
                    drawOver: true,
                    midPointsType: "way",

                }
            }]]);





            let multiRoute = new ymaps.multiRouter.MultiRoute({
                referencePoints: ['Moscow, Leninsky Prospekt', 'Moscow, Kulakov pereulok'],
            }, {
                editorDrawOver: false,
                wayPointDraggable: true,
                viaPointDraggable: true,
                // Setting a custom design for multi-route lines.
                routeStrokeColor: "000088",
                routeActiveStrokeColor: "ff0000",
                pinIconFillColor: "ff0000",
                activeRouteAutoSelection: true,
                boundsAutoApply: false,
                useMapMargin: true,
                zoomMargin: 0,
                preventDragUpdate: false,
            });
            myMap.geoObjectsW.add(multiRoute);



            
/*
            overlay.Circle(geometry[data[{
                options: {
                    fillMethod: 'stretch',
                    interactive: true,

                }
            }]]);


            


            overlay.hotspot.Placemark(geometry[data[{
                options:
                {
                    interactive: 'true',
                    interactivityModel: 'default#geoObject',
                    offset: [0, 0],
                    pane: 'places',
                }
            }]]);





           

            



           
            overlay.html.Balloon(geometry[data[{
                options: {
                    interactivityModel: "default#opaque",
                    offset: [0, 0],
                    pane: 'ballon',
                    shadow: true,
                    shadowOffset: [0, 0],
                    shadowsPane: 'shadows'
                }
            }]]);





           

            overlay.html.Hint(geometry[data[{
                options: {
                    interactivityModel: "default#opaque",
                    pane: 'outerHint',

                }
            }]]);





            overlay.html.Placemark(geometry[data[{
                options: {
                    interactivityModel: "default#geoObject",
                    offset: [0, 0],
                    pane: 'places',
                    shadow: false,
                    shadowOffset: [0, 0],
                    shadowsPane: 'shadows'
                }
            }]]);



            

            overlay.html.Restangle(geometry[data[{
                options: {
                    fillMethod: 'stretch',
                    interactivityModel: "default#geoObject",
                    pane: 'areas',
                }
            }]]);*/






            

            /*{ vow.Promise } panorama.createPlayer(element, point[{
                options: {
                    direction: 'auto',
                    layer: 'yandex#panorama',
                    span: 'auto',

                }
            }])*/



            /*panorama.Player(element, panorama[{
                option: {
                    autoFitToViewport: 'always',
                    // controls:,
                    direction: 'auto',
                    hotkeysEnabled: false,
                    scrollZoomBehavior: true,
                    span: 'auto',
                    suppressMapOpenBlock: false,
                }
            }])*/


            
            var placemark = new ymaps.Placemark([55.75, 37.61], {
                balloonContent: '&lt;img src="/render/images/assets/image/filter_images/img1.jpg" /&gt;',
                iconContent: "Azerbaijan"
            }, {
                preset: "islands#yellowStretchyIcon",
                // Disabling the close balloon button.
                balloonCloseButton: false,
                // The balloon will open and close when the placemark icon is clicked.
                hideIconOnBalloonOpen: false,
                cursor: "pointer",
                draggable: false,
                hasBalloon: true,
                hasHint: true,
                hideIconOnBalloonOpen: true,
                // iconOffset:,
                interactiveZIndex: true,
                interactivityModel: "default#geoObject",
                openBalloonOnClick: true,
                openEmptyBalloon: false,
                openEmptyHint: false,
                openHintOnHover: true,
                pane: 'places',
                pointOverlay: "default#placemark",
                syncOverlayInit: false,
                useMapMarginInDragging: false,
                visible: true,

            });
            myMap.geoObjects.add(placemark);



            /*
            var polygon = new ymaps.Polygon([
                // Coordinates of the outer contour.
                [[-80, 60], [-90, 50], [-60, 40], [-80, 60]],
                // Coordinates of the inner contour.
                [[-90, 80], [-90, 30], [-20, 40], [-90, 80]],
                [{
                    cursor: 'pointer',
                    draggable: 'false',
                    fill: 'true',
                    fillColor: "0066ff99",
                    // fillImageHref:,
                    fillMethod: 'stretch',
                    fillOpacity: 1,
                    hasBalloon: true,
                    hasHint: true,
                    interactiveZIndex: false,
                    interactivityModel: "default#geoObject",
                    opacity: 1,
                    openBalloonOnClick: true,
                    openEmptyBalloon: false,
                    openEmptyHint: false,
                    openHintOnHover: true,
                    outline: true,
                    pane: "areas",
                    polygonOverlay: "default#polygon",
                    strokeColor: "0066ffff",
                    strokeOpacity: 1,
                    // strokeStyle:,
                    strokeWidth: 1,
                    syncOverlayInit: false,
                    useMapMarginInDragging: true,
                    visible: true,

                }]
            ], {
                hintContent: "Polygon"
            }, {
                fillColor: '#6699ff',
                // Making the polygon transparent for map events.
                interactivityModel: 'default#transparent',
                strokeWidth: 8,
                opacity: 0.5
            });
            myMap.geoObjects.add(polygon);
            myMap.setBounds(polygon.geometry.getBounds());*/




            // Creating a polyline
            var polyline = new ymaps.Polyline([
                [-80, 60], [-90, 50], [-60, 40], [-80, 60]
            ], {
                hintContent: "Polyline"
            }, {
                cursor: 'pointer',
                hasBalloon: true,
                hasHint: true,
                interactiveZIndex: false,
                interactivityModel: 'default#geoObject',
                lineStringOverlay: 'default#polyline',
                opacity: 1,
                openBalloonOnClick: true,
                openEmptyBalloon: false,
                openEmptyHint: false,
                openHintOnHover: true,
                pane: 'areas',
                strokeColor: "0066ffff",
                strokeOpacity: 1,
                strokeWidth: 1,
                syncOverlayInit: false,
                useMapMarginInDragging: true,
                visible: true,
                //zIndex:,
                draggable: false,
                strokeWidth: 4,
                // The first number sets the stroke length. The second number sets the gap length.
                strokeStyle: '1 5'
            });
            // Adding the polyline to the map.
            myMap.geoObjects.add(polyline);
            // Setting the polyline borders for the map.
            myMap.setBounds(polyline.geometry.getBounds());


            
            /*Popup(map[{
                closeTimeout: 700,
                // interactivityModel:,
                openTimeout: 150,
                // pane:,
                // projection:,
                // zIndex:,

            }]);*/


           
            // Creating a geodesic circle with a radius of 1000 kilometers.
            var circle = new ymaps.Circle([[50, 50], 1000000], {}, {
                draggable: true
            });
            // Adding the circle to the map.
            myMap.geoObjects.add(circle);

            // Creating a rectangle based on the circle's boundaries.
            var rectangle = new ymaps.Rectangle(circle.geometry.getBounds(), {}, {
                cursor: "pointer",
                draggable: false,
                fillColor: "0066ff99",
                // fillImageHref:,
                fillMethod: 'stretch',
                fillOpacity: 1,
                hasBalloon: true,
                hasHint: true,
                interactiveZIndex: false,
                interactivityModel: "default#geoObject",
                opacity: 1,
                openBalloonOnClick: true,
                openEmptyBalloon: false,
                openEmptyHint: false,
                openHintOnHover: true,
                outline: true,
                pane: "places",
                rectangleOverlay: "default#rectangle",
                strokeColor: "0066ffff",
                strokeOpacity: 1,
                // strokeStyle:,
                strokeWidth: 1,
                syncOverlayInit: false,
                useMapMarginInDragging: true,
                visible: true,
                // zIndex:,
                fill: true,
                coordRendering: "boundsPath",
                strokeWidth: 4
            });
            // Adding the rectangle to the map.
            myMap.geoObjects.add(rectangle);

            // Updating the rectangle's coordinates when changing the circle geometry.
            circle.geometry.events.add("change", function (event) {
                this.geometry.setCoordinates(event.get("target").getBounds());
            }, rectangle);



            
            ymaps.regions.load('RU', {
                lang: 'en', quality: 1,
            }).then(function (event) {
                geoMap.geoObjects.add(result.geoObjects);
            });



            
            var objectManager = new ymaps.RemoteObjectManager('http://myServer.com/tile?bbox=%b', {
                // Cluster options are set with the "cluster" prefix.
                clusterHasBalloon: false,
                // Geo object options are set with the "geoObject" prefix.
                geoObjectOpenBalloonOnClick: false,
                loadTileSize: 256,
                paddingParamName: 'callback',
                paddingTemplate: null,
                splitRequests: false,
                syncOverlayInit: false
            });

            // You can set options directly for child collections.
            objectManager.clusters.options.set({
                preset: 'islands#grayClusterIcons',
                hintContentLayout: ymaps.templateLayoutFactory.createClass('Group of objects')
            });
            objectManager.objects.options.set('preset', 'islands#grayIcon');



            

            // Building the route from Korolev to Krasnogorsk via Khimki and Mytischi,
            // where Mytischi is a throughpoint. Setting coordinates for Krasnogorsk.
            /*ymaps.route([
                'Korolev',
                { type: 'viaPoint', point: 'Mytischi' },
                'Himki',
                { type: 'wayPoint', point: [55.811511, 37.312518] }
            ], {
                mapStateAutoApply: true
            }).then(function (route) {
                route.getPaths().options.set({
                    // the balloon only shows information about the travel time with traffic
                    balloonContentLayout: ymaps.templateLayoutFactory.createClass('{{ properties.humanJamsTime }}'),
                    // you can make settings for route graphics
                    strokeColor: '0000ffff',
                    opacity: 0.9,
                    avoidTrafficJams:false,
                    // boundedBy:,
                    mapStateAutoApply:false,
                    multiRoute:false,
                    reverseGeocoding:false,
                    routingMode:'auto',
                    // searchCoordOrder:,
                    strictBounds:false,
                    useMapMargin:true,
                    viaIndexes:[],
                    zoomMargin:0
                });
                // adding the route to the map
                myMap.geoObjects.add(route);
            }); */




        });
         
JS,

        'style' => <<<CSS
         
         html,
        body,
        #map {
            width: 100%;
            height: 50vh;
            padding: 0;
            margin: 0;
        }
        .ymaps-2-1-75-map, .ymaps-2-1-75-i-ua_js {
        width: 100%!important;
        height: 100%!important;
        }
         
CSS,

    ];


    public function asset(){
        $this->fileJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=5fb7da25-bc18-4612-b304-83ea2266c510');

    }


    public function codes()
    {


        $this->htm = strtr($this->_layout['main'], []);

        $this->js = strtr($this->_layout['js'], [
            '{routeButtonControl}' => $this->_config['routeButtonControl'] ? 'routeButtonControl' : '',
            '{zoomControl}' => $this->_config['zoomControl'] ? 'zoomControl' : '',
            '{searchControl}' => $this->_config['searchControl'] ? 'searchControl' : '',
            '{typeSelector}' => $this->_config['typeSelector'] ? 'typeSelector' : '',
            '{geolocationControl}' => $this->_config['geolocationControl'] ? 'geolocationControl' : '',
            '{fullscreenControl}' => $this->_config['fullscreenControl'] ? 'fullscreenControl' : '',
            '{customControl}' => $this->_config['customControl'] ? 'customControl' : '',
            '{rulerControl}' => $this->_config['rulerControl'] ? 'rulerControl' : '',
            '{trafficControl}' => $this->_config['trafficControl'] ? 'trafficControl' : '',

        ]);

        $this->css = strtr($this->_layout['style'], []);
    }
}
