<?php


namespace zetsoft\widgets\blocks;


use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


class ZMapGlobeWidget extends ZWidget
{
    public $config = [];
    public $_config = [

        'isCircle' => 1,
        'isCircleFill' => 1,
        'useGeodata' => true,
        'dummyData' => true,
        'mapPolygons' => 1,
        'mapColors' => 'rgba(63,94,251,.5)',
        'mapLineColors' => ZMapGlobeWidget::mapColor['white'],
        'mapColorsHover' => 'rgba(63,94,251,.7)',
        'mapGlobBack' => 'rgba(2,0,36,.4)',

    ];

    public const mapColor = [
        'red' => 'red',
        'white' => 'white',
        'pink' => 'pink',
        'transparent' => 'transparent',
        'deep-purple' => 'deep-purple',
        'indigo' => 'indigo',
        'light-blue' => 'light-blue',
        'cyan' => 'cyan',
        'teal' => 'teal',
        'green' => 'green',
        'light-green' => 'light-green',
        'lime' => 'lime',
        'yellow' => 'yellow',
        'amber' => 'amber',
        'orange' => 'orange',
        'deep-orange' => 'deep-orange',
        'brown' => 'brown',
        'grey' => 'grey',
        'blue-grey' => 'blue-grey',
        'black' => 'black',
        'mdb-color' => 'mdb-color',
        'blue' => 'blue',
        'rgba-red-light' => 'rgba-red-light',
        'rgba-pink-light' => 'rgba-pink-light',
        'rgba-purple-light' => 'rgba-purple-light',
        'rgba-indigo-light' => 'rgba-indigo-light',
        'rgba-cyan-light' => 'rgba-cyan-light',
        'rgba-teal-light' => 'rgba-teal-light',
        'rgba-green-light' => 'rgba-green-light',
        'rgba-white-slight' => 'rgba-white-slight',
        'rgba-stylish-slight' => 'rgba-stylish-slight',
        'rgba-black-slight' => 'rgba-black-slight',
        'rgba-blue-grey-slight' => 'rgba-blue-grey-slight',
        'rgba-grey-slight' => 'rgba-grey-slight',
        'rgba-brown-slight' => 'rgba-brown-slight',
        'rgba-orange-slight' => 'rgba-orange-slight',
        'rgba-yellow-slight' => 'rgba-yellow-slight',
        'rgba-lime-slight' => 'rgba-lime-slight',
        'rgba-green-slight' => 'rgba-green-slight',
        'rgba-teal-slight' => 'rgba-teal-slight',
        'rgba-cyan-slight' => 'rgba-cyan-slight',
        'rgba-indigo-slight' => 'rgba-indigo-slight',
        'rgba-purple-slight' => 'rgba-purple-slight',
        'rgba-pink-slight' => 'rgba-pink-slight',
        'rgba-red-slight' => 'rgba-red-slight',
        'rgba-blue-slight' => ' rgba-blue-slight',
        'rgba-white-strong' => 'rgba-white-strong',
        'rgba-stylish-strong' => 'rgba-stylish-strong',
        'rgba-black-strong' => 'rgba-black-strong',
        'rgba-blue-grey-strong' => 'rgba-blue-grey-strong',
        'rgba-grey-strong' => 'rgba-grey-strong',
        'rgba-brown-strong' => 'rgba-brown-strong',
        'rgba-orange-strong' => 'rgba-orange-strong',
        'rgba-yellow-strong' => 'rgba-yellow-strong',
        'rgba-lime-strong' => 'rgba-lime-strong',
        'rgba-green-strong' => 'rgba-green-strong',
        'rgba-teal-strong' => 'rgba-teal-strong',
        'rgba-cyan-strong' => 'rgba-cyan-strong',
        'rgba-indigo-strong' => 'rgba-indigo-strong',
        'rgba-purple-strong' => 'rgba-purple-strong',
        'rgba-pink-strong' => 'rgba-pink-strong',
        'rgba-red-strong' => 'rgba-red-strong',
        'rgba-blue-strong' => 'rgba-blue-strong',
        'rgba-white-light' => 'rgba-white-light',
        'rgba-stylish-light' => 'rgba-stylish-light',
        'rgba-black-light' => 'rgba-black-light',
        'rgba-blue-grey-light' => 'rgba-blue-grey-light',
        'rgba-grey-light' => 'rgba-grey-light',
        'rgba-lime-light' => 'rgba-lime-light',
        'rgba-yellow-light' => 'rgba-yellow-light',
        'rgba-orange-light' => 'rgba-brown-light',
        'aqua-gradient' => 'aqua-gradient',
        'purple-gradient' => 'purple-gradient',
        'peach-gradient' => 'peach-gradientt',
        'blue-gradient' => 'blue-gradient',
        'warm-flame-gradient' => 'warm-flame-gradient',
        'night-fade-gradient' => 'night-fade-gradient',
        'spring-warmth-gradient' => 'spring-warmth-gradient',
        'near-moon-gradient' => 'near-moon-gradient',
        'rare-wind-gradient' => 'rare-wind-gradient',
        'morpheus-den-gradient' => 'morpheus-den-gradient',
        'cloudy-knoxville-gradient' => 'cloudy-knoxville-gradient',
        'ripe-malinka-gradient' => 'ripe-malinka-gradient',
        'deep-blue-gradient' => 'deep-blue-gradient',
        'mean-fruit-gradient' => 'mean-fruit-gradient',
        'amy-crisp-gradient' => 'amy-crisp-gradient',
        'heavy-rain-gradient' => 'heavy-rain-gradient',
        'tempting-azure-gradient' => 'tempting-azure-gradient',
        'dusty-grass-gradient' => 'dusty-grass-gradient',
        'frozen-dreams-gradient' => 'frozen-dreams-gradient',
        'winter-neva-gradient' => 'winter-neva-gradient',
        'lady-lips-gradient' => 'lady-lips-gradient',
        'sunny-morning-gradient' => 'sunny-morning-gradient',
        'rainy-ashville-gradient' => 'rainy-ashville-gradient',
        'young-passion-gradient' => 'young-passion-gradient',
        'juicy-peach-gradient' => 'juicy-peach-gradient',
    ];



    public function asset()
    {
        $this->fileJs('/render/blocks/@/ZMapGlobeWidget/assets/Rotating Globe/assets/core.js');
        $this->fileJs('/render/blocks/@/ZMapGlobeWidget/assets/Rotating Globe/assets/maps.js');
        $this->fileJs('/render/blocks/@/ZMapGlobeWidget/assets/Rotating Globe/assets/continentsLow.js');
        $this->fileJs('/render/blocks/@/ZMapGlobeWidget/assets/Rotating Globe/assets/worldLow.js');
        $this->fileJs('/render/blocks/@/ZMapGlobeWidget/assets/Rotating Globe/assets/animated.js');
        $this->fileJs('/render/places/assets/Maps/Amcharts/amcharts4/themes/frozen.js');
    }

    public function codes()
    {


        $this->css = <<<CSS
 #chartdiv {
            max-width: 100%;
            height: 600px;
            background-color: #fff;
        }
    
CSS;

        $this->htm = <<<HTML
    <div id="chartdiv"></div>         
    <br><br><br>
HTML;

        $this->js = <<<JS
        am4core.ready(function() {
        
        // theme begin
        am4core.useTheme(am4themes_animated);
        // theme end
        
        // Create map instance
        var chart = am4core.create("chartdiv", am4maps.MapChart);
        var interfaceColors = new am4core.InterfaceColorSet();
        
        try {
            chart.geodata = am4geodata_worldLow;
        }
        catch (e) {
            chart.raiseCriticalError(new Error("Map geodata could not be loaded. Please download the latest <a href=\"https://www.amcharts.com/download/download-v4/\">amcharts geodata</a> and extract its contents into the same directory as your amCharts files."));
        }
        
        
        var label = chart.createChild(am4core.Label);
        label.text = "12 months (3/7/2019 data) rolling measles nincidence per 1'000'000 total population.  Bullet size uses logarithmic scale.";
        label.fontSize = 12;
        label.align = "left";
        label.valign = "bottom";
        label.fill = am4core.color("#927459");
        label.background = new am4core.RoundedRectangle()
        label.background.cornerRadius(10,10,10,10);
        label.padding(10,10,10,10);
        label.marginLeft = 30;
        label.marginBottom = 30;
        label.background.strokeOpacity = 0.7;
        label.background.stroke =am4core.color("#927459");
        label.background.fill = am4core.color("#f9e3ce");
        label.background.fillOpacity = 0.6;
        
        var data = chart.createChild(am4core.TextLink)
        data.text = "Data source: ZetSoft Enterprice";
        data.fontSize = 12;
        data.align = "left";
        data.valign = "top";
        data.url = "https://www.who.int/immunization/monitoring_surveillance/burden/vpd/surveillance_type/active/measles_monthlydata/en/"
        data.urlTarget = "_blank";
        data.fill = am4core.color("#927459");
        data.padding(10,10,10,10);
        data.marginLeft = 30;
        data.marginTop = 30;
        
        // Set projection
        chart.projection = new am4maps.projections.Orthographic();
        chart.panBehavior = "rotateLongLat";
        chart.padding(20,20,20,20);
        chart.deltaLongitude = -168;
        var slider = chart.chartAndLegendContainer.createChild(am4core.Slider);
        slider.margin( -50, 0, 0, 0);
        slider.width = -10;
        slider.valign = "top";
        slider.events.on("rangechanged", function(ev) {
          var deltaLongitude = 360 * ev.target.start-90;
          chart.deltaLongitude = deltaLongitude;
          
        });

        
        // Add zoom control
        chart.zoomControl = new am4maps.ZoomControl();
        
        var homeButton = new am4core.Button();
        homeButton.events.on("hit", function(){
          chart.goHome();
        });
        
        homeButton.icon = new am4core.Sprite();
        homeButton.padding(7, 5, 7, 5);
        homeButton.width = 30;
        homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
        homeButton.marginBottom = 10;
        homeButton.parent = chart.zoomControl;
        homeButton.insertBefore(chart.zoomControl.plusButton);
        
        
        //Glob Background
        chart.backgroundSeries.mapPolygons.template.polygon.fill = am4core.color("{$this->_config['mapGlobBack']}");
        chart.backgroundSeries.mapPolygons.template.polygon.fillOpacity ={mapPolygons};
        chart.deltaLongitude = 20;
        chart.deltaLatitude = -20;
        
        
        // Create map polygon series
        
        var shadowPolygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
        shadowPolygonSeries.geodata = am4geodata_continentsLow;
        
        try {
            shadowPolygonSeries.geodata = am4geodata_continentsLow;
        }
        catch (e) {
            shadowPolygonSeries.raiseCriticalError(new Error("Map geodata could not be loaded. Please download the latest <a href=\"https://www.amcharts.com/download/download-v4/\">amcharts geodata</a> and extract its contents into the same directory as your amCharts files."));
        }
        
        shadowPolygonSeries.useGeodata = true;
        shadowPolygonSeries.dx = 2;
        shadowPolygonSeries.dy = 2;
        shadowPolygonSeries.mapPolygons.template.fill = am4core.color("#000");
        shadowPolygonSeries.mapPolygons.template.fillOpacity = 0.2;
        shadowPolygonSeries.mapPolygons.template.strokeOpacity = 0;
        shadowPolygonSeries.fillOpacity = 0.1;
        shadowPolygonSeries.fill = am4core.color("#000");
        
        
        // Create map polygon series
        var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
        polygonSeries.useGeodata ={useGeodata};
        
        polygonSeries.calculateVisualCenter = true;
        polygonSeries.tooltip.background.fillOpacity = 0.2;
        polygonSeries.tooltip.background.cornerRadius = 20;
        
        var template = polygonSeries.mapPolygons.template;
        template.nonScalingStroke = true;
        
        //davlat rangi
        template.fill = am4core.color("{$this->_config['mapColors']}");
        
        //xaritalar liniyasi
        template.stroke = am4core.color("{$this->_config['mapLineColors']}");
        
        polygonSeries.calculateVisualCenter = true;
        template.propertyFields.id = "id";
        template.tooltipPosition = "fixed";
        template.fillOpacity = 1;
        
        template.events.on("over", function (event) {
          if (event.target.dummyData) {
            event.target.dummyData.isHover = {dummyData};
          }
        });
        template.events.on("out", function (event) {
          if (event.target.dummyData) {
            event.target.dummyData.isHover = false;
          }
        }) ;
        
        var hs = polygonSeries.mapPolygons.template.states.create("hover");
        hs.properties.fillOpacity = 1;
        //davlat hover bolganda
        hs.properties.fill = am4core.color("blue");
        
        
        
        var graticuleSeries = chart.series.push(new am4maps.GraticuleSeries());
        graticuleSeries.mapLines.template.stroke = am4core.color("#fff");
        graticuleSeries.fitExtent = false;
        graticuleSeries.mapLines.template.strokeOpacity = 0.2;
        graticuleSeries.mapLines.template.stroke = am4core.color("#fff");
        
        
        var measelsSeries = chart.series.push(new am4maps.MapPolygonSeries()) ;
        measelsSeries.tooltip.background.fillOpacity = 0;
        measelsSeries.tooltip.background.cornerRadius = 20;
        measelsSeries.tooltip.autoTextColor = false;
        measelsSeries.tooltip.label.fill = am4core.color("#000");
        measelsSeries.tooltip.dy = -5;
  
        var measelTemplate = measelsSeries.mapPolygons.template;
        measelTemplate.fill = am4core.color("#bf7569");
        measelTemplate.strokeOpacity ={isCircle};
        measelTemplate.fillOpacity ={isCircleFill};
        measelTemplate.tooltipPosition = "fixed";
        
        
        
        
        polygonSeries.events.on("inited", function () {
          polygonSeries.mapPolygons.each(function (mapPolygon) {
            var count = data[mapPolygon.id];
        
            if (count > 0) {
              var polygon = measelsSeries.mapPolygons.create();
              polygon.multiPolygon = am4maps.getCircle(mapPolygon.visualLongitude, mapPolygon.visualLatitude, Math.max(0.2, Math.log(count) * Math.LN10 / 10));
              polygon.tooltipText = mapPolygon.dataItem.dataContext.name + ": " + count;
              
               /* modal = mapPolygon.dataItem.dataContext.name + "\r\n" + count;*/
               
              mapPolygon.dummyData = polygon;
              polygon.events.on("over", function () {
                mapPolygon.isHover = true;
              });
              polygon.events.on("out", function () {
                mapPolygon.isHover = false;
              })
            }
            else {
              mapPolygon.tooltipText = mapPolygon.dataItem.dataContext.name + ": no data";
              mapPolygon.fillOpacity = 0.9;
            }
        
          })
        });
           
        
        var data = {data};
        
          
        
        })
JS;

        $this->js = strtr($this->js, [

            '{data}' => $this->jscode($this->data),
            '{isCircle}' => $this->jscode($this->_config['isCircle']),
            '{isCircleFill}' => $this->jscode($this->_config['isCircleFill']),
            '{useGeodata}' => $this->jscode($this->_config['useGeodata']),
            '{dummyData}' => $this->jscode($this->_config['dummyData']),
            '{mapPolygons}' => $this->jscode($this->_config['mapPolygons']),


        ]);

    }

}
