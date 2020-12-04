<?php

namespace zetsoft\widgets\blocks;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 *
 * Created By: Toirov Azimjon
 */
class ZLineChartWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
    ];

    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
                
        <div id="{id}" style="width: 450px; height: 200px">
        
           </div>
HTML,
        'js' => <<<JS
                  var dom = document.getElementById("{id}");
    var myChart = echarts.init(dom);
    var data = [120, 200, 150, 80, 70, 110, 130],
        option = null;
    option = {
        title: {
            show: false,
            text: "Your name of chart",
            link: "",
            target: "blank",
            textStyle: {
                color: "#333",
                fontSize: 15,
                /**
                 //      *'normal'
                 //      *'bold'
                 //      *'bolder'
                 //      *'lighter'
                 //      *100 | 200 | 300 | 400...
                 //      */
                fontStyle: "normal",
                lineHeight: 8,
                width: 25,
                height: 25,
                textBorderColor: "transparent",
                textBorderWidth: 0,
                textShadowColor: "2px 2px #ff0000",
                textShadowBlur: 0,
                textShadowOffsetX: 0,
                textShadowOffsetY: 0
            },
            subtext: "Your decribtion of chart",
            sublink: "",
            subtarget: "blank",
            subtextStyle: {
                color: "#333",
                fontSize: 10,
                /**
                 *'normal'
                 *'bold'
                 *'bolder'
                 *'lighter'
                 *100 | 200 | 300 | 400...
                 */
                fontStyle: "normal",
                lineHeight: 8,
                width: 135,
                height: 15,
                textBorderColor: "transparent",
                textBorderWidth: 0,
                textShadowColor: "2px 2px #ff0000",
                textShadowBlur: 0,
                textShadowOffsetX: 0,
                textShadowOffsetY: 0
            },
            /**
             *'auto', 'left', 'right', 'center'
             */
            textAlign: "left",
            /**
             *'auto', 'top', 'bottom', 'middle'
             */
            textVerticalAlign: "auto",
            triggerEvent: false,
            padding: 25,
            itemGap: 10,
            zlevel: 0,
            z: 2,
            left: "10px",
            top: "2%",
            right: "auto",
            bottom: "auto",
            backgroundColor: "transparent",
            borderColor: "#ccc",
            borderWidth: 1,
        },
        legend: {
            width: 23,
            height: 80,
            data: ['Week']
        },
        toolbox: {
            show: true,
            showTitle: false, // hide the default text so they don't overlap each other
            feature: {
                saveAsImage: {
                    show: true,
                    title: 'Save as image'
                },
                dataView: {
                    show: true,
                    title: 'data view',
                    lang: ['data view', 'turn off', 'refresh']
                },
                magicType: {
                    show: true,
                    type: ['line', 'bar', 'stack', 'tiled'],

                    title: {
                        line: 'for line charts',
                        bar: 'for bar charts',
                        stack: 'for stacked charts',
                        tiled: 'for tiled charts',
                    }
                },

                dataZoom: {
                    yAxisIndex: 'none'
                },
                restore: {}
            },
            tooltip: { // same as option.tooltip
                show: true,
                formatter: (param) => '<div>' + param.title + '</div>',
                backgroundColor: '#222',
                textStyle: {
                    fontSize: 12,
                },
                axisPointer: {
                    type: 'cross',
                    label: {
                        backgroundColor: '#6a7985'
                    }
                }

            }
        },
        grid: {
            left: '0',
            right: '20%',
            bottom: '20%',
            top: '20%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['Пон', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вос']
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: '{value} W'
            },
            axisPointer: {
                snap: true
            }
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                animation: false,
                label: {
                    backgroundColor: '#505765'
                }
            }
        },
        series: [{
            data: data,
            markPoint: {
                data: [
                    {type: 'max', name: 'Tue'},
                    {type: 'min', name: 'Fri'}
                ]
            },
            markLine: {
                data: [
                    {type: 'average', name: 'Wed'}
                ]
            },
            type: 'line',
            /*
            * circle, triangle, rect 
            */
            symbol: 'circle',
            symbolSize: 20,
            smooth: true,
            lineStyle: {
                color: '#ea3221',
                width: 4,
                type: 'solid'
            },
            itemStyle: {
                borderWidth: 3,
                borderColor: '#3212a3',
                color: '#fae213'
            }
        }],
        animation: true,
        animationThreshold: 2000,
        animationDuration: 8000,
        animationDelay: 0,
        animationDurationUpdate: 300,
        /*blendMode: 'source-over',*/
    };

    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
JS,


    ];

    public function asset()
    {


        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/dist/echarts.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts-gl@1.1.1/dist/echarts-gl.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts-stat@1.1.1/dist/ecStat.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/dist/extension/dataTool.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/map/js/china.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/map/js/world.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/dist/extension/bmap.min.js');
    }


    public function codes()
    {

        $this->_layout;

        $this->htm = strtr($this->_layout['main'],[
            '{id}' => $this->id,
        ]) ;

        $this->js = strtr($this->_layout['js'],[
            '{id}' => $this->id
        ]) ;
    }

}
