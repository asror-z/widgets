<?php

namespace zetsoft\widgets\charts;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use Fusonic\Linq\Linq;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;


/**
 *
 *
 * Author:  Asror Zakirov
 *  Refactored:Zoxidjon Ergashev, Shukurullo Odilov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZChartFormLayoutWidget extends ZWidget
{

    public $layout = [];
    public $_layout = [];

    public $config = [];
    public $_config = [
        'type' => self::type['line'],
        'theme' => self::theme['vintage'],
        'title' => 'Zetsoft Enterprice LLC',
        'height' => 420,
        'pieColumn' => 0,
        'startValue' => null,
        'endValue' => null,
        'start' => null,
        'end' => null,
        'responsive' => true,
        'align' => self::align['center'],
        'columnsList' => null,
        'grapes' => false,
    ];

    public const type = [
        'line' => 1,
        'lineStack' => 2,
        'bar' => 3,
        'pie' => 4,
    ];

    public const theme = [
        'macarons' => 'macarons',
        'infographic' => 'infographic',
        'roma' => 'roma',
        'shine' => 'shine',
        'dark' => 'dark',
        'vintage' => 'vintage',
    ];

    public const align = [
        'auto' => 'auto',
        'center' => 'center',
        'right' => 'right',
        'left' => 'left',
    ];

    public const fontSize = [
        'large' => '13',
        'medium' => '12',
        'small' => '11',
        'smallEx' => '10',
    ];

    public const color = [
        'white' => 'white',
        'black' => 'black',
        'blue' => 'blue',
        'red' => 'red',
        'pink' => 'pink',

    ];

    public const fontWieght = [
        'normal' => 'normal',
        'bold' => 'bold',
        'bolder' => 'bolder',
        'lighter' => 'lighter',

    ];

    public const position = [
        'top' => 'top',
        'middle' => 'middle',
        'bottom' => 'bottom',
    ];

    public const   lineType = [
        'solid' => 'solid',
        'dashed' => 'dashed',
        'dotted' => 'dotted',
    ];

    public const   axisType = [
        'category' => 'category',
        'time' => 'time',
        'value' => 'value',
    ];

    public const fontStyle = [
        'normal' => 'normal',
        'italic' => 'italic',
        'oblique' => 'oblique',
    ];

    public const orientation = [
        'vertical' => 'horizontal',
        'horizontal' => 'horizontal',
    ];

    public const trigger = [
        'item' => 'item',
        'axis' => 'axis',
    ];

    public const tooltipTrigger = [
        'mousemove' => 'mousemove',
        'click' => 'click',
        'mousemoveClick' => 'mousemove|click',
        'noneEx' => 'none',
    ];

    public const axisPointerType = [
        'cross' => 'cross',
        'line' => 'line',
        'shadow' => 'shadow',
    ];

    public const   filterMode = [
        'filter' => 'filter',
        'weakFilter' => 'weakFilter',
        'empty' => 'empty',
        'none' => 'none',
    ];

    public const seriesLayout = [
        'column' => 'column',
        'row' => 'row',
    ];

    public const lineSymbol = [
        'circle' => 'circle',
        'rect' => 'rect',
        'roundRect' => 'roundRect',
        'triangle' => 'triangle',
        'diamond' => 'diamond',
        'pin' => 'pin',
        'arrow' => 'arrow',
    ];

    public const   sampling = [
        'average' => 'average',
        'max' => 'max',
        'min' => 'min',
        'sum' => 'sum',
    ];

    public const labelPosition = [
        'top' => 'top',
        'left' => 'left',
        'right' => 'right',
        'bottom' => 'bottom',
        'inside' => 'inside',
        'insideLeft' => 'insideLeft',
        'insideRight' => 'insideRight',
        'insideTop' => 'insideTop',
        'insideBottom' => 'insideBottom',
        'insideTopLeft' => 'insideTopLeft',
        'insideTopRight' => 'insideTopRight',
        'insideBottomLeft' => 'insideBottomLeft',
        'insideBottomRight' => 'insideBottomRight',

    ];

    public $event = [];


    public $option = [

        'title' => [],
        'legend' => [],
        'dataZoom' => [],
        'grid' => [],
        'tooltip' => [],
        'axisPointer' => [],
        'toolbox' => [],
        'textStyle' => [],
        'animation' => true,
        'useUTC' => false,
        'xAxis' => [],
        'yAxis' => [],
        'dataset' => [
            'source' => []
        ],
        'series' => []
    ];


    /**
     *
     *
     * Private Vars
     */
    private $sOption = '{}';


    /**
     *
     *
     * Options Arrays
     */


    /**
     * Renders the widget.
     */
    public function codes()
    {
        $this->_layout = [
            'aChart_Series_Pie' => [
                'type' => 'pie',
                'seriesLayoutBy' => self::seriesLayout['row'],
                'selectedMode' => true,
                'selectedOffset' => 20,
                'clockwise' => true,
                'startAngle' => 90,
                'minAngle' => 0,
                'roseType' => false,
                'avoidLabelOverlap' => true,
                'stillShowZeroSum' => true,

                'radius' => [0, '80%'],
                'center' => ['50%', '50%'],

                'label' => [
                    'position' => self::labelPosition['top'],
                ],

                'labelLine' => [
                    'show' => true,
                ],
            ],
            "chartAxisCore" => [

                'show' => true,

                'name' => '',
                'nameLocation' => self::align['center'],
                'nameTextStyle' => [
                    'fontSize' => self::fontSize['large'],
                ],

                'nameGap' => 30,
                'nameRotate' => null,

                'axisLabel' => [
                    'show' => true,
                    'interval' => 'auto',
                    'color' => self::color['black'],
                    'fontWeight' => self::fontWieght['bold'],
                    'inside' => false,
                    'rotate' => 0,  // 90 | 180
                    'fontSize' => self::fontSize['small'],
                    'align' => self::align['center'],
                    'verticalAlign' => self::position['middle'],
                ],

                'splitLine' => [
                    'show' => true,
                ],

                'axisLine' => [
                    'show' => true,
                    'symbol' => 'none',
                    'lineStyle' => [
                        'type' => self::lineType['solid'],
                    ],
                ],
                'axisTick' => [
                    'show' => true,
                ],

            ],
            'aChart_YAxis' => [

                'position' => 'left',
                'offset' => 0,
                'type' => self::axisType['value'],

                'inverse' => false,
                'boundaryGap' => ['0%', '10%'],

                'scale' => true,
                'splitNumber' => 5,

                'axisPointer' => [
                    'show' => true,
                    'triggerTooltip' => false,
                ],

                'axisLabel' => [
                    'margin' => 25,
                ],

            ],
            "aChart_XAxis" => [

                'type' => self::axisType['category'],
                'position' => self::position['bottom'],
                'offset' => -21,

                'inverse' => false,
                'boundaryGap' => true,

                'scale' => true,
                'splitNumber' => 10,

                'axisLabel' => [
                    'margin' => 35,
                ],
            ],
            "aChart_Textstyle" => [
                'fontStyle' => self::fontStyle['normal'],
                'fontWeight' => self::fontWieght['bold'],
                'fontFamily' => 'Verdana',
                'fontSize' => self::fontSize['medium'],
                'align' => self::align['center'],
                'verticalAlign' => self::position['middle'],
            ],
            "aChart_AxisPointer" => [
                'show' => true,
                'type' => 'line',     //  line | shadow
                'label' => [
                    'show' => true,
                    'precision' => 2,
                    'fontSize' => self::fontSize['small'],
                ],
                'handle' => [
                    'show' => true,
                    'size' => 25,
                    'throttle' => 15,
                ],
            ],
            "aChart_Toolbox" => [
                'show' => false,
                'orient' => self::orientation['horizontal'], //  horizontal
                'itemSize' => 18,
                'itemGap' => 10,
                'left' => 'auto',
                'right' => 0,
                'top' => 0,
                'bottom' => 'auto',

                'showTitle' => true,
                'feature' => [
                    'saveAsImage' => [],
                    'restore' => [],
                    'dataView' => [],
                    'dataZoom' => [
                        'yAxisIndex' => 'none'
                    ],
                    'magicType' => [],
                ]
            ],
            "aChart_Tooltip" => [
                'show' => true,
                'trigger' => self::trigger['axis'],
                'alwaysShowContent' => false,
                'showContent' => true,

                'showDelay' => 0,
                'hideDelay' => 100,
                'enterable' => false,
                'confine' => false,
                'transitionDuration' => 0.4,
                'padding' => 20,
                'position' => '{tooltip.position}',

                'triggerOn' => self::tooltipTrigger['mousemove'],
                'textStyle' => [
                    'fontStyle' => self::fontStyle['normal'],
                    'fontSize' => self::fontSize['small'],
                    'fontWeight' => self::fontWieght['normal'],
                ],
                'axisPointer' => [
                    'type' => self::axisPointerType['cross'],
                    'label' => []
                ]
            ],
            "aChart_Grid" => [
                'show' => true,
                'left' => '2%',
                'right' => '18%',
                'top' => '9%',
                'bottom' => '4%',
                'containLabel' => true,
                'tooltip' => [
                    'show' => true,
                ]
            ],
            "aChart_Legend" => [
                'show' => true,
                'type' => 'scroll',

                'selectedMode' => 'multiple',    // single  /   false / true
                'orient' => self::orientation['vertical'],

                'align ' => self::align['right'],

                'left' => '83%',
                'top' => '10%',
                'right' => 'auto',
                'bottom' => 'auto',

                'height' => '85%',

                'padding' => 5,
                'itemGap' => 10,
                'animation' => true,
                'symbolKeepAspect' => true,
                'textStyle' => [
                    'fontSize' => self::fontSize['medium'],
                ],
                'tooltip' => [
                    'show' => true,
                ]
            ],
            "aChart_Title" => [
                'show' => true,
                'text' => '',
                'link' => '',
                'subtext' => '',
                'itemGap' => 5,
                'textStyle' => [
                    'fontSize' => self::fontSize['large'],
                    'fontWeight' => self::fontWieght['bold'],
                    'align' => self::align['right'],
                ],

                'padding' => [
                    10,  // up
                    10, // right
                    10,  // down
                    60, // left
                ],

            ],
            "aChart_DataZoom" => [
                [
                    'show' => true,
                    'type' => 'inside',
                ],
                [
                    'show' => true,
                    'type' => 'slider',
                    'filterMode' => self::filterMode['filter'],
                    'handleSize' => '100%',

                    'showDataShadow' => true,

                    'handleStyle' => [
                        'color' => self::color['black'],
                        'shadowBlur' => 3,
                        'shadowColor' => 'rgba(0, 0, 0, 0.6)',
                        'shadowOffsetX' => 4,
                        'shadowOffsetY' => 4
                    ],

                    'orient' => self::orientation['vertical'],
                    'zoomLock' => false,
                    'showDetail' => true,
                    'textStyle' => [
                        'fontSize' => self::fontSize['small'],
                        'fontWeight' => self::fontWieght['normal'],

                    ],

                ],
            ],
            'aChart_Series_ALL' => [
                'seriesLayoutBy' => self::seriesLayout['column'],
                'label' => [
                    'show' => true,
                    'fontSize' => self::fontSize['small'],
                    'align' => self::align['center'],
                    'verticalAlign' => self::position['middle'],
                    'emphasis' => [
                        'show' => false,
                        'shadowBlur' => 10,
                        'shadowOffsetX' => 0,
                        'shadowColor' => 'rgba(0, 0, 0, 0.5)',
                    ]
                ],
            ],
            "aChart_Series_Line_Stack" => [
                'areaStyle' => [
                    'normal' => []
                ],

            ],
            "aChart_Series_Line" => [
                'type' => 'line',

                'symbol' => self::lineSymbol['circle'],
                'symbolSize' => 6,
                'symbolKeepAspect' => true,
                'showSymbol' => true,
                'showAllSymbol' => false,
                'smooth' => true,
                'sampling' => self::sampling['max'],

                'itemStyle' => [
                    'color' => null,  // black
                ],
                'label' => [
                    'position' => self::labelPosition['inside'],
                    'offset' => [-10, -10],
                    'padding' => [0, 0],
                    'color' => 'auto',  // black
                ],
            ],
            "aChart_Series_Bar" => [
                'type' => 'bar',

                'barWidth' => null,
                'barMaxWidth' => null,
                'barMinHeight' => 0,
                'barGap' => '30%',
                'barCategoryGap' => '20%',

                'label' => [
                    'position' => self::labelPosition['inside'],
                ],
            ],
            "aChart_Series_LineStack" => [
                'type' => 'pie',
                'seriesLayoutBy' => self::seriesLayout['row'],
                'selectedMode' => true,
                'selectedOffset' => 20,
                'clockwise' => true,
                'startAngle' => 90,
                'minAngle' => 0,
                'roseType' => false,
                'avoidLabelOverlap' => true,
                'stillShowZeroSum' => true,

                'radius' => [0, '80%'],
                'center' => ['50%', '50%'],

                'label' => [
                    'position' => self::labelPosition['top'],
                ],

                'labelLine' => [
                    'show' => true,
                ],
            ],
        ];

        //Process Method//
        $keys = $this->model->columnsList();

        $data[] = $keys;
        foreach ($this->data as $key => $item) {
            foreach ($keys as $k => $value) {
                $data[$key + 1][$k] = $item->$value;
            }
        }

        $this->data = $data;

        Az::start(__METHOD__);

        $this->id = "zChart_{$this->id}";

        if (!empty($this->data)) {
            {

                Az::start(__METHOD__);


                /**
                 *
                 * Series Init
                 */

                $this->_layout['aChart_Series_Pie'] = ArrayHelper::merge(
                    $this->_layout['aChart_Series_ALL'],
                    $this->_layout['aChart_Series_Pie']
                );

                $this->_layout['aChart_Series_Line'] = ArrayHelper::merge(
                    $this->_layout['aChart_Series_ALL'],
                    $this->_layout['aChart_Series_Line']
                );

                $this->_layout['aChart_Series_Bar'] = ArrayHelper::merge(
                    $this->_layout['aChart_Series_ALL'],
                    $this->_layout['aChart_Series_Bar']
                );

                $this->_layout['aChart_Series_Line_Stack'] = ArrayHelper::merge(
                    $this->_layout['aChart_Series_Line'],
                    $this->_layout['aChart_Series_Line_Stack']
                );

                $this->_layout['aChart_XAxis'] = ArrayHelper::merge(
                    $this->_layout['aChart_XAxis'],
                    $this->_layout['chartAxisCore']);

                $this->_layout['aChart_YAxis'] = ArrayHelper::merge(
                    $this->_layout['aChart_YAxis'],
                    $this->_layout['chartAxisCore']);


                /**
                 *
                 *
                 * Fill Series Content
                 */

                $aSeries = [];

                switch ($this->_config['type']) {
                    case self::type['line']:
                        $aSeries = $this->_layout['aChart_Series_Line'];
                        break;

                    case self::type['lineStack']:
                        $aSeries = $this->_layout['aChart_Series_LineStack'];
                        break;

                    case self::type['bar']:
                        $aSeries = $this->_layout['aChart_Series_Bar'];
                        break;

                    case self::type['pie']:
                        $aSeries = $this->_layout['aChart_Series_Pie'];
                        break;
                }

                $iColumnCount = \count($this->data[0]) - 1;

                if ($this->_config['type'] === self::type['pie'])
                    $this->option['series'][] = $aSeries;
                else
                    for ($i = 1; $i <= $iColumnCount; $i++) {
                        $this->option['series'][] = $aSeries;
                    }


                /**
                 *
                 * Fill Array Contents
                 */


                if (empty($this->_config['pieColumn']))
                    $this->option['dataset']['source'] = $this->data;
                else {
                    Az::trace($this->_config['pieColumn'], 'Set IPie Column to');

                    $iPieColumn = $this->_config['pieColumn'];
                    $aData_New = [];

                    Linq::from($this->data)
                        ->each(function (array $aDataItem) use (&$iPieColumn, &$aData_New) {

                            $aDataItem_New = [];

                            $aDataItem_New[] = $aDataItem[0];
                            $aDataItem_New[] = $aDataItem[$iPieColumn];

                            $aData_New[] = $aDataItem_New;
                        });

                    $this->option['dataset']['source'] = $aData_New;
                }


                if ($this->_config['type'] !== self::type['pie']) {

                    $this->option['grid'] = $this->_layout['aChart_Grid'];
                    $this->option['xAxis'] = $this->_layout['aChart_XAxis'];
                    $this->option['yAxis'] = $this->_layout['aChart_YAxis'];


                    /**
                     *
                     * DataZoom
                     */


                    $aDataZoom = [
                        'startValue' => $this->_config['startValue'],
                        'endValue' => $this->_config['endValue'],
                        'start' => $this->_config['start'],
                        'end' => $this->_config['end'],
                    ];

                    $this->_layout['aChart_DataZoom'][0] = ArrayHelper::merge(
                        $this->_layout['aChart_DataZoom'][0],
                        $aDataZoom
                    );

                    $this->_layout['aChart_DataZoom'][1] = ArrayHelper::merge(
                        $this->_layout['aChart_DataZoom'][1],
                        $aDataZoom
                    );

                    $this->option['dataZoom'] = $this->_layout['aChart_DataZoom'];

                } else {
                    $this->_layout['aChart_Tooltip']['trigger'] = self::trigger['item'];
                    $this->_layout['aChart_Tooltip']['position'] = null;
                }

                $this->option['title'] = $this->_layout['aChart_Title'];
                $this->option['tooltip'] = $this->_layout['aChart_Tooltip'];
                $this->option['axisPointer'] = $this->_layout['aChart_AxisPointer'];
                $this->option['toolbox'] = $this->_layout['aChart_Toolbox'];
                $this->option['textStyle'] = $this->_layout['aChart_Textstyle'];
                $this->option['legend'] = $this->_layout['aChart_Legend'];
                $this->option['title']['text'] = $this->_config['title'];

            }
            Az::trace(true, 'Options Gotten From DATA');
        } else
            Az::trace(true, 'Options Gotten From RAW');


        $this->sOption = Json::encode($this->option, JSON_PRETTY_PRINT);


        /**
         *
         * tooltip.position
         */


        $sCallable = 'function (point, params, dom, rect, size) {
			var left = point[0] + 100;
			var top = 0;
			 
	      return {left: left, top: top};
        }';

        $this->sOption = str_replace('"{tooltip.position}"', $sCallable, $this->sOption);


        $this->js = "var {$this->id} = echarts.init(document.getElementById('{$this->id}'), " . $this->_quote($this->_config['theme']) . ');';

        $this->js .= "{$this->id}.setOption({$this->sOption});";

        if (isset($this->option['group'])) {
            $this->js .= "{$this->id}.group = " . $this->_quote($this->option['group']) . ';';
        }

        if ($this->_config['responsive']) {
            $this->js .= "$(window).resize(function () {{$this->id}.resize()});";
        }

        foreach ($this->event as $name => $handlers) {
            $handlers = (array)$handlers;
            foreach ($handlers as $handler) {
                $this->js .= "{$this->id}.on(" . $this->_quote($name) . ", $handler);";
            }
        }


        $this->htm .= Html::tag('div', '', [
            'id' => $this->id,
            'style' => "height: {$this->_config['height']}px;"
        ]);


    }


    public function asset()
    {

        //YARN
        /* $this->fileJs('/render/blocks/ZEChartWidget/1/demo_files/echarts.min.js');
           $this->fileJs('https://cdn.jsdelivr.net/npm/echarts-gl@1.1.1/dist/echarts-gl.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.9.0-stat/dist/ecStat.min.js');

        */


        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/dist/echarts.min.js');

        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts-stat@1.1.1/dist/ecStat.min.js');

        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts-gl@1.1.1/dist/echarts-gl.min.js');


        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/dist/extension/dataTool.min.js');

        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/azul.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/bee-inspired.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/blue.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/caravan.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/carp.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/cool.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/dark.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/dark-blue.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/dark-bold.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/dark-digerati.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/dark-fresh-cut.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/dark-mushroom.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/eduardo.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/forest.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/fresh-cut.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/fruit.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/gray.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/green.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/helianthus.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/infographic.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/inspired.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/jazz.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/london.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/macarons.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/macarons2.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/mint.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/red.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/red-velvet.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/roma.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/royal.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/sakura.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/shine.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/tech-blue.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/echarts@4.6.0/theme/vintage.js');
    }


    /**
     * Quotes a string for use in JavaScript.
     *
     * @param string $string
     * @return string the quoted string
     */
    private function _quote($string)
    {
        return "'" . addcslashes($string, "'") . "'";
    }


}
