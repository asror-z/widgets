<?php

namespace zetsoft\widgets\charts;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZMapGlobeWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 * Refactored:Zoxidjon Ergashev
 */
class ZXYChartWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'types' => ZXYChartWidget::types['XYChart'],
        'isCircle' => 0,
        'isCircleFill' => 0,
        'useGeodata' => true,
        'dummyData' => false,
        'mapPolygons' => 1,
        'mapColors' => 'rgba(63,94,251,.5)',
        'mapColorsHover' => 'rgba(63,94,251,.7)',
        'mapGlobBack' => 'rgba(2,0,36,.4)',
        'grapes' => false,
    ];


    public const types = [

        'PieChart' => 'PieChart',
        'XYChart' => 'XYChart',
        'MapChart' => 'MapChart',
        'RadarChart' => 'RadarChart',
        'TreeMap' => 'TreeMap',
        'SankeyDiagram' => 'SankeyDiagram',
        'GaugeChart' => 'GaugeChart',
        'SlicedChart' => 'SlicedChart',
        ///am4plugins_sunburst
        'Sunburst' => 'Sunburst',
        'WordCloud' => 'WordCloud',
        'ForceDirectedTree' => 'ForceDirectedTree',


    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div id="chartdiv" '   {readonly}></div>
HTML,

        'css' => <<<CSS
           #chartdiv {
              width: 100%;
              height: 500px;
           }
CSS,

        'js' => <<<JS
  am4core.ready(function() {

// theme begin
        am4core.useTheme(am4themes_animated);
// theme end

// Create chart instance
        var chart = am4core.create("chartdiv", am4charts.{types});
       var types=chart['_className'];
       console.log(types)
        switch (types) {
        case 'PieChart':
         chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
    
    chart.legend = new am4charts.Legend();
    
    chart.data = [
      {
        country: "Lithuania",
        litres: 501.9
      },
      {
        country: "Czech Republic",
        litres: 301.9
      },
      {
        country: "Ireland",
        litres: 201.1
      },
      {
        country: "Germany",
        litres: 165.8
      },
      {
        country: "Australia",
        litres: 139.9
      },
      {
        country: "Austria",
        litres: 128.3
      },
      {
        country: "UK",
        litres: 99
      },
      {
        country: "Belgium",
        litres: 60
      },
      {
        country: "The Netherlands",
        litres: 50
      }
    ];
    
    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "litres";
    series.dataFields.category = "country";
        break;
        case 'SlicedChart':
        console.log("SlicedChart")
        break;
        case 'GaugeChart':
        
        break;
        case 'SankeyDiagram':
        
        break;
        case 'TreeMap':
        
        break;
        case 'RadarChart':
        
        break;
        case 'MapChart':
        
        break;
        case 'XYChart':
            chart.data = [{
            "country": "USA",
            "visits": 4025
        }, {
            "country": "China",
            "visits": 1882
        }, {
            "country": "Japan",
            "visits": 1809
        }, {
            "country": "Germany",
            "visits": 1322
        }, {
            "country": "UK",
            "visits": 1122
        }, {
            "country": "France",
            "visits": 1114
        }, {
            "country": "India",
            "visits": 984
        }, {
            "country": "Spain",
            "visits": 711
        }, {
            "country": "Netherlands",
            "visits": 665
        }, {
            "country": "Russia",
            "visits": 580
        }, {
            "country": "South Korea",
            "visits": 443
        }, {
            "country": "Canada",
            "visits": 441
        }, {
            "country": "Brazil",
            "visits": 395
        }, {
            "country": "Italy",
            "visits": 386
        }, {
            "country": "Australia",
            "visits": 384
        }, {
            "country": "Taiwan",
            "visits": 338
        }, {
            "country": "Poland",
            "visits": 328
        }];
           // Create axes
        let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.labels.template.rotation = 270;
        categoryAxis.renderer.labels.template.hideOversized = false;
        categoryAxis.renderer.minGridDistance = 20;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.tooltip.label.rotation = 270;
        categoryAxis.tooltip.label.horizontalCenter = "right";
        categoryAxis.tooltip.label.verticalCenter = "middle";

        //https://www.amcharts.com/docs/v4/reference/valueaxis/

        let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Countries";
        valueAxis.title.fontWeight = "bold";

// Create series
        var series = chart.series.push(new am4charts.ColumnSeries3D());
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.name = "Visits";
        series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        series.columns.template.fillOpacity = .8;

        var columnTemplate = series.columns.template;
        columnTemplate.strokeWidth = 2;
        columnTemplate.strokeOpacity = 1;
        columnTemplate.stroke = am4core.color("#FFFFFF");

        columnTemplate.adapter.add("fill", function(fill, target) {
            return chart.colors.getIndex(target.dataItem.index);
        })

        columnTemplate.adapter.add("stroke", function(stroke, target) {
            return chart.colors.getIndex(target.dataItem.index);
        })

        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineX.strokeOpacity = 0;
        chart.cursor.lineY.strokeOpacity = 0; 
        break;
        
          
        }
        
        
      

// Add data
        
        // https://www.amcharts.com/docs/v4/reference/categoryaxis/
        // https://www.amcharts.com/docs/v4/



    }); // end am4core.ready()
JS,

    ];

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js');
        $this->fileJs('/render/places/assets/Maps/Amcharts/core.js');
        $this->fileJs('/render/places/assets/Maps/Amcharts/charts.js');
        $this->fileJs('/render/places/assets/Maps/Amcharts/animated.js');

    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [

            '{\'{readonly}\' => $this->_config[\'readonly\'] ? \'readonly\' : \'\',types}' => $this->_config['types'],
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);
        $this->css = strtr($this->_layout['css'], []);
        $this->js = strtr($this->_layout['js'], []);

        $this->js = strtr($this->js, [
            '{types}' => $this->jscode($this->_config['types']),

        ]);

    }


}
