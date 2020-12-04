<?php
/**
 * Author:  Zoirjon Sobirov
 * @license  Zoirjon Sobirov
 * linkedIn: https://www.linkedin.com/in/zoirjon-sobirov/
 * Telegram: https://t.me/zoirjon_sobirov
 * @copyright zhead, zstart, zend
 */

namespace zetsoft\widgets\places;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use yii\web\View;

class ZMaptalksZoirWidget extends ZWidget
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
        'scrollwheel'           => true,
        'zoomControl'           => true,
        'searchAutoComplete'    => true,
        'searchPlaceImageShow'  => false,
        'dependPlace'           => true,
        'depend_id'             => '',
        'draggable'             => false,
        'dependAttr'            => '',
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
var markerCount = {markerCount}

/*If loaded show map*/
$('#{id}').ready(function () {

console.log("Map creating")
    
var map;
var cnt_ind = 0;

/*For save searched place_id*/
var searchPlaceId = "";

/*For save markers on map*/
var allMarkers = [];

/**db Coordinates **/
var savedCoordinates = {savedCoordinates}
/*For change markers*/
var cnt_edited = 0;


var options = {
        center:{lat:41.32, lng: 69.22},
        zoom: {zoom},
        mapTypeId: '{mapType}'
    }

    var resolutions = [];
    var d = 2 * 6378137 * Math.PI;
    for (var i = 0; i < 21; i++) {
        resolutions[i] = d / (256 * Math.pow(2, i));
    }

      map  = new maptalks.Map('{id}', {
        center:     [69.26248,41.31449],
        zoom:  {zoom},
        pitch: {mapDegree},
        // a custom version of default web-mercator spatial reference
        // map's spatial reference definition
        spatialReference : {
            projection : 'EPSG:3857', // geo projection, can be a string or a function
            resolutions : resolutions,
            fullExtent : {         // map's full extent
                'top': 6378137 * Math.PI,
                'left': -6378137 * Math.PI,
                'bottom': -6378137 * Math.PI,
                'right': 6378137 * Math.PI
            }
        },
        baseLayer : new maptalks.TileLayer('base',{
            urlTemplate: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            subdomains: ['a','b','c'],
            //  tileSystem : [1, -1, -20037508.34, 20037508.34], // tile system
            minZoom : 1,
            maxZoom : 19,
        })
    });
    
       function toolbar(text) {
        var toolbar = new maptalks.control.Toolbar({
          position: 'top-right',
          items: [{
            item: text,
            click: function () {}
          }]
        });
        return toolbar;
      }
       
      var AllMarkers = [];
      class CustomTool extends maptalks.MapTool {
        onEnable() {
          this._markerLayer = new maptalks.VectorLayer('CustomTool_layer')
            .addTo(this.getMap());
        }
        onDisable() {
          if (this._markerLayer) {
            this._markerLayer.remove();
          }
        }
        getEvents() {
          return {
            'click': this._onClick,
            'contextmenu': this._onRightClick
          };
        }
        _onClick(param) {
           if (AllMarkers.length < markerCount){
               var marker = new maptalks.Marker(param.coordinate)               
              this._markerLayer.addGeometry(marker);
              var urlLink ='https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+param.coordinate.y+'&lon='+param.coordinate.x;
                  pushData(param.coordinate.y,param.coordinate.x,AllMarkers)
            }else
             if (allMarkers.length >= markerCount){
                AllMarkers.forEach(function (marker) {marker.clear();})                
                 pushData(param.coordinate.y,param.coordinate.x,AllMarkers)
        }
      }
      }
      var customTool = new CustomTool().addTo(map);
      
})
function pushData(lat, lng, markers, count_edit) {
markers = AllMarkers
 var urlLink ='https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat+'&lon='+lng;
      bootbox.prompt({
                    title: "добавить ваше местоположение!", 
                    centerVertical: true,
                    callback: function(result){
                             console.log(result)
                            fetch(urlLink)
                            .then(response => response.json()) 
                            .then(data => {                                 
                                    var dataFet = data.display_name;
               
                                    marker.setInfoWindow({
                                        'title'     : result,
                                        'content'   : dataFet
                                
                                        // 'autoPan': true,
                                        // 'width': 300,
                                        // 'minHeight': 120,
                                        // 'custom': false,
                                        //'autoOpenOn' : 'click',  //set to null if not to open when clicking on marker
                                        //'autoCloseOn' : 'click'
                                    });
                            
                                    marker.openInfoWindow();
                            })
                            .catch(err => console.warn(err.message));
                            AllMarkers.push(marker)
                            console.log(AllMarkers.length)        
                    }
               })
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


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->getId(),
            '{name}' => $this->name,
            '{zoom}' => $this->_config['zoom'],
            '{markerCount}' => $this->_config['markerCount'],
            '{mapDegree}' => $this->_config['mapDegree'],
            '{savedCoordinates}'   => (isset($this->value) > 0)?json_encode($this->value) :json_encode([])
        ]);

    }

}
