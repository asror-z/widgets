<?php

namespace zetsoft\widgets\blocks;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\consts\ZChartWidgetConst;
use Fusonic\Linq\Linq;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;


/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZEChartNewWidget extends ZWidget implements ZChartWidgetConst
{
    public $config = [];
    public $_config = [
        'theme' => ZEChartNewWidget::themes['infographic'],
        'type' => ZEChartNewWidget::types['line'],
        'color' => ZEChartNewWidget::colors['red'],
        'style' => ZEChartNewWidget::styles['normal'],
        'wieght' => ZEChartNewWidget::wieghts['bold'],
        'wrapper' => ZEChartNewWidget::wrappers['angular'],
        'axistype' => ZEChartNewWidget::axistypes['value'],
        'filtermode' => ZEChartNewWidget::filtermode['filter'],
        'lineseries' => ZEChartNewWidget::lineseries['average'],
        'orientation' => ZEChartNewWidget::orientations['vertical'],
        'align' => ZEChartNewWidget::align['center'],
        'axisPointerType' => ZEChartNewWidget::axisPointerType['cross'],
        'position' => ZEChartNewWidget::position['top'],
        'seriesLayout' => ZEChartNewWidget::seriesLayout['column'],
        'lineSymbols' => ZEChartNewWidget::lineSymbols['circle'],
        'labelPosition' => ZEChartNewWidget::labelPositions['top'],
        'fontSize' => ZEChartNewWidget::fontSizes['large'],
        'trigger' => ZEChartNewWidget::trigger['item'],
        'tooltipTriggerBy' => ZEChartNewWidget::tooltipTriggerBy['mousemove'],
        'eventContants' => ZEChartNewWidget::eventContants['Click'],
    ];

    public const themes = [
        'infographic' => 'infographic',
        'macarons' => 'macarons',
        'roma' => 'roma',
        'shine' => 'shine',
        'dark' => 'dark',
        'vintage' => 'vintage',
    ];

    public const types = [
        'line' => 'line',
        'linestack' => 2,
        'bar' => 3,
        'pie' => 4,
    ];


    public const colors = [
        'white' => 'white',
        'black' => 'black',
        'blue' => 'blue',
        'red' => 'red',
        'pink' => 'pink',

    ];

    public const styles = [
        'normal' => 'normal',
        'italic' => 'italic',
        'oblique' => 'oblique',
    ];

    public const wieghts = [
        'normal' => 'normal',
        'bold' => 'bold',
        'bolder' => 'bolder',
        'lighter' => 'lighter',

    ];
    public const   wrappers = [
        'angular' => 'angular',
        'bootstrap4' => 'bootstrap4',
    ];

    public const   axistypes = [
        'category' => 'category',
        'time' => 'time',
        'value' => 'value',
    ];

    public const   filtermode = [
        'filter' => 'filter',
        'weakFilter' => 'weakFilter',
        'empty' => 'empty',
        'none' => 'none',
    ];

    public const   lineseries = [
        'average' => 'average',
        'max' => 'max',
        'min' => 'min',
        'sum' => 'sum',
    ];
    public const   lineTypes = [
        'solid' => "solid",
        'dashed' => "dashed",
        'dotted' => "dotted",
    ];

    public const orientations = [
        'vertical' => 'horizontal',
        'horizontal' => 'horizontal',
    ];

    public const align = [
        'auto' => 'auto',
        'center' => 'center',
        'right' => 'right',
        'left' => 'left',
    ];

    public const axisPointerType = [
        'cross' => 'cross',
        'line' => 'line',
        'shadow' => 'shadow',
    ];

    public const position = [
        'top' => 'top',
        'middle' => 'middle',
        'bottom' => 'bottom',
    ];

    public const seriesLayout = [
        'column' => 'column',
        'row' => 'row',
    ];

    public const lineSymbols = [
        'circle' => 'circle',
        'rect' => 'rect',
        'roundRect' => 'roundRect',
        'triangle' => 'triangle',
        'diamond' => 'diamond',
        'pin' => 'pin',
        'arrow' => 'arrow',
    ];

    public const labelPositions = [
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

    public const fontSizes = [
        'large' => '13',
        'medium' => '12',
        'small' => '11',
        'smallEx' => '10',
    ];
    public const trigger = [
        'item' => 'item',
        'axis' => 'axis',
    ];

    public const tooltipTriggerBy = [
        'mousemove' => 'mousemove',
        'click' => 'click',
        'mousemoveClick' => 'mousemove|click',
        'noneEx' => 'none',
    ];

    public const eventContants = [
        'Click' => 'Click',
        'Dblclick' => 'Dblclick',
        'Mousedown' => 'Mousedown',
        'Mousemove' => 'Mousemove',

        'Mouseup' => 'Mouseup',
        'Mouseover' => 'Mouseover',
        'Mouseout' => 'Mouseout',
        'Legendselectchanged' => 'Legendselectchanged',
        'Legendselected' => 'Legendselected',
        'Legendunselected' => 'Legendunselected',
        'Legendscroll' => 'Legendscroll',
        'Datazoom' => 'Datazoom',
        'Datarangeselected' => 'Datarangeselected',
        'Dataviewchanged' => 'Dataviewchanged',
        'Timelinechanged' => 'Timelinechanged',
        'Timelineplaychanged' => 'Timelineplaychanged',
        'Restore' => 'Restore',
        'Magictypechanged' => 'Magictypechanged',
        'Pieselectchanged' => 'Pieselectchanged',
        'Pieselected' => 'Pieselected',
        'Pieunselected' => 'Pieunselected',
        'Axisareaselected' => 'Axisareaselected',
        'Focusnodeadjacency' => 'Focusnodeadjacency',
        'Unfocusnodeadjacency' => 'Unfocusnodeadjacency',
        'Brush' => 'Brush',
        'Brushselected' => 'Brushselected',
    ];


    public $theme;
    public $type;
    public $height = '420';
    public $pieColumn;
    public $startValue;
    public $endValue;
    public $start;
    public $end;
    public $event = [];
    public $isResponsive = true;
    public $options = [

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

    private $option = '{}';

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
 <div id="{id}" style="width: 600px;height:400px;">sad</div>
HTML


    ];

    public function asset()
    {

        /* $this->fileJs("/render/blocks/ZEChartWidget/1/demo_files/echarts.min.js");
         $this->fileJs("https://cdn.jsdelivr.net/npm/echarts-gl@1.1.1/dist/echarts-gl.min.js");
         $this->fileJs("https://cdn.jsdelivr.net/npm/echarts@4.9.0-stat/dist/ecStat.min.js");
         $this->fileJs("/render/blocks/ZEChartWidget/1/demo_files/extension/dataTool.min.js");
         $this->fileJs("/render/blocks/ZEChartWidget/1/demo_fileschina.js");
         $this->fileJs("/render/blocks/ZEChartWidget/1/demo_filesworld.js");*/

        $this->fileJs("https://cdn.jsdelivr.net/npm/echarts@4.6.0/dist/echarts.min.js");
        $this->fileJs("https://cdn.jsdelivr.net/npm/echarts-gl@1.1.1/dist/echarts-gl.min.js");
        $this->fileJs("https://cdn.jsdelivr.net/npm/echarts-stat@1.1.1/dist/ecStat.min.js");
        $this->fileJs("https://cdn.jsdelivr.net/npm/echarts@4.6.0/dist/extension/dataTool.min.js");
        $this->fileJs("https://cdn.jsdelivr.net/npm/echarts@4.6.0/map/js/china.js");
        $this->fileJs("https://cdn.jsdelivr.net/npm/echarts@4.6.0/map/js/world.js");
    }


    public function codes()
    {


        $aChart_YAxis = [

            'position' => 'left',
            'offset' => 0,
            'type' => self::axistypes['value'],

            'inverse' => false,
            'boundaryGap' => ['0%', '10%'],

            'scale' => true,
            'splitNumber' => 5,

            'axisPointer' => [
                'show' => true,
                'triggerTooltip' => false,
            ],

            'axilabel' => [
                'margin' => 25,
            ],

        ];

        $chart_AxisCore = [

            'show' => true,

            'name' => '',
            'nameLocation' => self::align['center'],
            'nameTextStyle' => [
                'fontSize' => self::fontSizes['large'],
            ],

            'nameGap' => 30,
            'nameRotate' => null,

            'axilabel' => [
                'show' => true,
                'interval' => 'auto',
                'color' => self::colors['red'],
                'fontWeight' => self::wieghts['bold'],
                'inside' => false,
                'rotate' => 0,  // 90 | 180
                'fontSize' => self::fontSizes['small'],
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
                    'type' => self::lineTypes['solid'],
                ],
            ],
            'axisTick' => [
                'show' => true,
            ],

        ];


        $aChart_XAxis = [

            'type' => self::axistypes['category'], // category
            'position' => self::position['bottom'],// bottom
            'offset' => -21,

            'inverse' => false,
            'boundaryGap' => true,

            'scale' => true,
            'splitNumber' => 10,

            'axilabel' => [
                'margin' => 35,
            ],
        ];


        $aChart_Textstyle = [
            'fontStyle' => self::styles['normal'],//Normal,
            'fontWeight' => self::wieghts['bold'],//Bold,
            'fontFamily' => 'Verdana',
            'fontSize' => self::fontSizes['medium'],//_Medium,
            'align' => self::align['center'],//Center,
            'verticalAlign' => self::position['middle'],//self::Position_Middle,
        ];

        $aChart_AxisPointer = [
            'show' => true,
            'type' => 'line',     //  line | shadow
            'label' => [
                'show' => true,
                'precision' => 2,
                'fontSize' => self::fontSizes['small'],//self::FontSize_Small,
            ],
            'handle' => [
                'show' => true,
                'size' => 25,
                'throttle' => 15,
            ],
        ];

        $aChart_Toolbox = [
            'show' => true,
            'orient' => self::orientations['horizontal'],//self::Orientation_Horizontal, //  horizontal
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
        ];

        $aChart_Tooltip = [
            'show' => true,
            'trigger' => self::trigger['axis'],//self::Trigger_Axis,
            'alwaysShowContent' => false,
            'showContent' => true,

            'showDelay' => 0,
            'hideDelay' => 100,
            'enterable' => false,
            'confine' => false,
            'transitionDuration' => 0.4,
            'padding' => 20,
            'position' => "{tooltip.position}",

            'triggerOn' => self::tooltipTriggerBy['mousemove'],//self::TooltipTrigger_Mousemove,
            'textStyle' => [
                'fontStyle' => self::styles['normal'], //self::FontStyle_Normal,
                'fontSize' => self::fontSizes['small'], //self::FontSize_Small,
                'fontWeight' => self::wieghts['normal'], //self::FontWeight_Normal,
            ],
            'axisPointer' => [
                'type' => self::axisPointerType['cross'], //self::AxisPointer_Cross,
                'label' => []
            ]
        ];

        $aChart_Grid = [
            'show' => true,
            'left' => '2%',
            'right' => '18%',
            'top' => '9%',
            'bottom' => '4%',
            'containLabel' => true,
            'tooltip' => [
                'show' => true,
            ]
        ];

        $aChart_Legend = [
            'show' => true,
            'type' => 'scroll',
            'selectedMode' => 'multiple',    // single  /   false / true
            'orient' => self::orientations['vertical'],//self::Orientation_Vertical,
            'align ' => self::align['right'],//self::Align_Right,
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
                'fontSize' => self::fontSizes['medium'],//self::FontSize_Medium,
            ],
            'tooltip' => [
                'show' => true,
            ]
        ];

        $aChart_Title = [
            'show' => true,
            'text' => 'ZCore ChartEx Widget v4',
            'link' => '',
            'subtext' => '',
            'itemGap' => 5,
            'textStyle' => [
                'fontSize' => self::fontSizes['large'],//self::FontSize_Large,
                'fontWeight' => self::wieghts['bold'],//self::FontWeight_Bold,
                'align' => self::align['right'],//self::Align_Right,
            ],

            'padding' => [
                10,  // up
                10, // right
                10,  // down
                60, // left
            ],

        ];


        $aChart_DataZoom = [
            [
                'show' => true,
                'type' => 'inside',
            ],
            [
                'show' => true,
                'type' => 'slider',
                'filterMode' => self::filtermode['filter'],//self::FilterMode_Filter,
                'handleSize' => '100%',

                'showDataShadow' => true,
                'handleStyle' => [
                    'color' => self::colors['black'],//self::Color_Black,
                    'shadowBlur' => 3,
                    'shadowColor' => 'rgba(0, 0, 0, 0.6)',
                    'shadowOffsetX' => 4,
                    'shadowOffsetY' => 4
                ],

                'orient' => self::orientations['horizontal'],//self::Orientation_Horizontal,
                'zoomLock' => false,
                'showDetail' => true,
                'textStyle' => [
                    'fontSize' => self::fontSizes['small'],//self::FontSize_Small,
                    'fontWeight' => self::wieghts['normal'],//self::FontWeight_Normal,

                ],

            ],
        ];


        $aChart_Series_ALL = [
            'seriesLayoutBy' => self::seriesLayout['column'],//self::SeriesLayoutBy_Column,
            'label' => [
                'show' => true,
                'fontSize' => self::fontSizes['small'],//self::FontSize_Small,
                'align' => self::align['center'],//self::Align_Center,
                'verticalAlign' => self::position['middle'],//self::Position_Middle,
                'emphasis' => [
                    'show' => false,
                    'shadowBlur' => 10,
                    'shadowOffsetX' => 0,
                    'shadowColor' => 'rgba(0, 0, 0, 0.5)',
                ]
            ],
        ];

        $aChart_Series_Line_Stack = [
            'areaStyle' => [
                'normal' => []
            ],

        ];

        $aChart_Series_Line = [
            'type' => 'line',

            'symbol' => self::lineSymbols['circle'],//self::LineSymbol_Circle,
            'symbolSize' => 6,
            'symbolKeepAspect' => true,
            'showSymbol' => true,
            'showAllSymbol' => false,
            'smooth' => true,
            'sampling' => 'max',//self::Sampling_Max,
            'itemStyle' => [
                'color' => null,  // black
            ],
            'label' => [
                'position' => self::labelPositions['inside'],//self::LabelPosition_Inside,
                'offset' => [-10, -10],
                'padding' => [0, 0],
                'color' => 'auto',  // black
            ],
        ];

        $aChart_Series_Bar = [
            'type' => 'bar',
            'barWidth' => null,
            'barMaxWidth' => null,
            'barMinHeight' => 0,
            'barGap' => '30%',
            'barCategoryGap' => '20%',

            'label' => [
                'position' => self::labelPositions['inside'],//self::LabelPosition_Inside,
            ],
        ];

        $aChart_Series_Pie = [
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
                'position' => self::labelPositions['top'],//Top,
            ],

            'labelLine' => [
                'show' => true,
            ],
        ];


        Az::start(__METHOD__);

        $aChart_Series_Pie = ArrayHelper::merge(
            $aChart_Series_ALL,
            $aChart_Series_Pie
        );

        $aChart_Series_Line = ArrayHelper::merge(
            $aChart_Series_ALL,
            $aChart_Series_Line
        );

        $aChart_Series_Bar = ArrayHelper::merge(
            $aChart_Series_ALL,
            $aChart_Series_Bar
        );

        $aChart_Series_Line_Stack = ArrayHelper::merge(
            $aChart_Series_Line,
            $aChart_Series_Line_Stack
        );

        $aChart_XAxis = ArrayHelper::merge(
            $aChart_XAxis,
            $chart_AxisCore
        );

        $aChart_YAxis = ArrayHelper::merge(
            $aChart_YAxis,
            $chart_AxisCore
        );


        /**
         *
         *
         * Fill Series Content
         */

        $aSeries = [];

        switch ($this->type) {
            case self::types['line']:
                $aSeries = $aChart_Series_Line;
                break;

            case self::types['linestack']:
                $aSeries = $aChart_Series_Line_Stack;
                break;

            case self::types['bar']:
                $aSeries = $aChart_Series_Bar;
                break;

            case self::types['pie']:
                $aSeries = $aChart_Series_Pie;
                break;
        }

       /* $iColumnCount = count($this->data[0]) - 1;

        if ($this->type === self::types['pie'])
            $this->options['series'][] = $aSeries;
        else
            for ($i = 1; $i <= $iColumnCount; $i++) {
                $this->options['series'][] = $aSeries;
            }*/


        /**
         *
         * Fill Array Contents
         */


        if (empty($this->pieColumn))
            $this->options['dataset']['source'] = $this->data;
        else {
            Az::trace($this->pieColumn, 'Set IPie Column to');

            $iPieColumn = $this->pieColumn;
            $data_New = [];

            Linq::from($this->data)
                ->each(function (array $datitems) use (&$iPieColumn, &$data_New) {

                    $datitems_New = [];

                    $datitems_New[] = $datitems[0];
                    $datitems_New[] = $datitems[$iPieColumn];

                    $data_New[] = $datitems_New;
                });

            $this->options['dataset']['source'] = $data_New;
        }


        if ($this->type !== self::types['pie']) {

            $this->options['grid'] = $aChart_Grid;
            $this->options['xAxis'] = $aChart_XAxis;
            $this->options['yAxis'] = $aChart_YAxis;


            /**
             *
             * DataZoom
             */


            $dataZoom = [
                'startValue' => $this->startValue,
                'endValue' => $this->endValue,
                'start' => $this->start,
                'end' => $this->end,
            ];

            $aChart_DataZoom[0] = ArrayHelper::merge(
                $aChart_DataZoom[0],
                $dataZoom
            );


            $aChart_DataZoom[1] = ArrayHelper::merge(
                $aChart_DataZoom[1],
                $dataZoom
            );

            $this->options['dataZoom'] = $aChart_DataZoom;

        } else {
            $aChart_Tooltip['trigger'] = self::Trigger_Item;
            $aChart_Tooltip['position'] = null;
        }

        $this->options['title'] = $aChart_Title;
        $this->options['tooltip'] = $aChart_Tooltip;
        $this->options['axisPointer'] = $aChart_AxisPointer;
        $this->options['toolbox'] = $aChart_Toolbox;
        $this->options['textStyle'] = $aChart_Textstyle;
        $this->options['legend'] = $aChart_Legend;


        /**
         *
         * Series Init
         */

        if (empty($this->type))
            $this->type = Az::$app->utility->mains->random('zChartType', self::type);

        if (empty($this->_config['theme']))
            $this->_config['theme'] = Az::$app->utility->mains->random('zChartType', self::theme);


        if (!empty($this->data)) {
            // $this->_data();
            Az::trace(true, 'Options Gotten From DATA');
        } else
            Az::trace(true, 'Options Gotten From RAW');

        $this->option = Json::encode($this->options, JSON_PRETTY_PRINT);


        $this->all .= Html::tag('div', '', [
            'id' => $this->id,
            'style' => "height: {$this->height}px;"
        ]);

        // return $this->all;


        $this->htm = strtr($this->_layout["main"], [
            '{id}' => $this->id
        ]);


        /*<<<HTML
<div id="{$this->id}" style="width: 600px;height:400px;">sad</div>
HTML;*/

        $this->js = "var {$this->id} = echarts.init(document.getElementById('{$this->id}'), " . $this->_quote($this->theme) . ');';
        $this->js .= "{$this->id}.setOption({$this->option});";
        if (isset($this->options['group'])) {
            $this->js .= "{$this->id}.group = " . $this->_quote($this->options['group']) . ';';
        }
        if ($this->isResponsive) {
            $this->js .= "$(window).resize(function () {{$this->id}.resize()});";
        }
        foreach ($this->event as $name => $handlers) {
            $handlers = (array)$handlers;
            foreach ($handlers as $handler) {
                $this->js .= "{$this->id}.on(" . $this->_quote($name) . ", $handler);";
            }
        }

        /**
         *
         * tooltip.position
         */
        $sCallable = 'function (point, params, dom, rect, size) {
			var left = point[0] + 100;
			var top = 0;
			 
	      return {left: left, top: top};
        }';

        $this->option = str_replace('"{tooltip.position}"', $sCallable, $this->option);
        // vdd($this->js);
    }

    private function _data()
    {
        $aChart_YAxis = [

            'position' => 'left',
            'offset' => 0,
            'type' => self::axistypes['value'],

            'inverse' => false,
            'boundaryGap' => ['0%', '10%'],

            'scale' => true,
            'splitNumber' => 5,

            'axisPointer' => [
                'show' => true,
                'triggerTooltip' => false,
            ],

            'axilabel' => [
                'margin' => 25,
            ],

        ];

        $chart_AxisCore = [

            'show' => true,

            'name' => '',
            'nameLocation' => self::align['center'],
            'nameTextStyle' => [
                'fontSize' => self::fontSizes['large'],
            ],

            'nameGap' => 30,
            'nameRotate' => null,

            'axilabel' => [
                'show' => true,
                'interval' => 'auto',
                'color' => self::colors['red'],
                'fontWeight' => self::wieghts['bold'],
                'inside' => false,
                'rotate' => 0,  // 90 | 180
                'fontSize' => self::fontSizes['small'],
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
                    'type' => self::lineTypes['solid'],
                ],
            ],
            'axisTick' => [
                'show' => true,
            ],

        ];


        $aChart_XAxis = [

            'type' => self::axistypes['category'], // category
            'position' => self::position['bottom'],// bottom
            'offset' => -21,

            'inverse' => false,
            'boundaryGap' => true,

            'scale' => true,
            'splitNumber' => 10,

            'axilabel' => [
                'margin' => 35,
            ],
        ];


        $aChart_Textstyle = [
            'fontStyle' => self::styles['normal'],//Normal,
            'fontWeight' => self::wieghts['bold'],//Bold,
            'fontFamily' => 'Verdana',
            'fontSize' => self::fontSizes['medium'],//_Medium,
            'align' => self::align['center'],//Center,
            'verticalAlign' => self::position['middle'],//self::Position_Middle,
        ];

        $aChart_AxisPointer = [
            'show' => true,
            'type' => 'line',     //  line | shadow
            'label' => [
                'show' => true,
                'precision' => 2,
                'fontSize' => self::fontSizes['small'],//self::FontSize_Small,
            ],
            'handle' => [
                'show' => true,
                'size' => 25,
                'throttle' => 15,
            ],
        ];

        $aChart_Toolbox = [
            'show' => true,
            'orient' => self::orientations['horizontal'],//self::Orientation_Horizontal, //  horizontal
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
        ];

        $aChart_Tooltip = [
            'show' => true,
            'trigger' => self::trigger['axis'],//self::Trigger_Axis,
            'alwaysShowContent' => false,
            'showContent' => true,

            'showDelay' => 0,
            'hideDelay' => 100,
            'enterable' => false,
            'confine' => false,
            'transitionDuration' => 0.4,
            'padding' => 20,
            'position' => "{tooltip.position}",

            'triggerOn' => self::tooltipTriggerBy['mousemove'],//self::TooltipTrigger_Mousemove,
            'textStyle' => [
                'fontStyle' => self::styles['normal'], //self::FontStyle_Normal,
                'fontSize' => self::fontSizes['small'], //self::FontSize_Small,
                'fontWeight' => self::wieghts['normal'], //self::FontWeight_Normal,
            ],
            'axisPointer' => [
                'type' => self::axisPointerType['cross'], //self::AxisPointer_Cross,
                'label' => []
            ]
        ];

        $aChart_Grid = [
            'show' => true,
            'left' => '2%',
            'right' => '18%',
            'top' => '9%',
            'bottom' => '4%',
            'containLabel' => true,
            'tooltip' => [
                'show' => true,
            ]
        ];

        $aChart_Legend = [
            'show' => true,
            'type' => 'scroll',
            'selectedMode' => 'multiple',    // single  /   false / true
            'orient' => self::orientations['vertical'],//self::Orientation_Vertical,
            'align ' => self::align['right'],//self::Align_Right,
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
                'fontSize' => self::fontSizes['medium'],//self::FontSize_Medium,
            ],
            'tooltip' => [
                'show' => true,
            ]
        ];

        $aChart_Title = [
            'show' => true,
            'text' => 'ZCore ChartEx Widget v4',
            'link' => '',
            'subtext' => '',
            'itemGap' => 5,
            'textStyle' => [
                'fontSize' => self::fontSizes['large'],//self::FontSize_Large,
                'fontWeight' => self::wieghts['bold'],//self::FontWeight_Bold,
                'align' => self::align['right'],//self::Align_Right,
            ],

            'padding' => [
                10,  // up
                10, // right
                10,  // down
                60, // left
            ],

        ];


        $aChart_DataZoom = [
            [
                'show' => true,
                'type' => 'inside',
            ],
            [
                'show' => true,
                'type' => 'slider',
                'filterMode' => self::filtermode['filter'],//self::FilterMode_Filter,
                'handleSize' => '100%',

                'showDataShadow' => true,
                'handleStyle' => [
                    'color' => self::colors['black'],//self::Color_Black,
                    'shadowBlur' => 3,
                    'shadowColor' => 'rgba(0, 0, 0, 0.6)',
                    'shadowOffsetX' => 4,
                    'shadowOffsetY' => 4
                ],

                'orient' => self::orientations['horizontal'],//self::Orientation_Horizontal,
                'zoomLock' => false,
                'showDetail' => true,
                'textStyle' => [
                    'fontSize' => self::fontSizes['small'],//self::FontSize_Small,
                    'fontWeight' => self::wieghts['normal'],//self::FontWeight_Normal,

                ],

            ],
        ];


        $aChart_Series_ALL = [
            'seriesLayoutBy' => self::seriesLayout['column'],//self::SeriesLayoutBy_Column,
            'label' => [
                'show' => true,
                'fontSize' => self::fontSizes['small'],//self::FontSize_Small,
                'align' => self::align['center'],//self::Align_Center,
                'verticalAlign' => self::position['middle'],//self::Position_Middle,
                'emphasis' => [
                    'show' => false,
                    'shadowBlur' => 10,
                    'shadowOffsetX' => 0,
                    'shadowColor' => 'rgba(0, 0, 0, 0.5)',
                ]
            ],
        ];

        $aChart_Series_Line_Stack = [
            'areaStyle' => [
                'normal' => []
            ],

        ];

        $aChart_Series_Line = [
            'type' => 'line',

            'symbol' => self::lineSymbols['circle'],//self::LineSymbol_Circle,
            'symbolSize' => 6,
            'symbolKeepAspect' => true,
            'showSymbol' => true,
            'showAllSymbol' => false,
            'smooth' => true,
            'sampling' => 'max',//self::Sampling_Max,
            'itemStyle' => [
                'color' => null,  // black
            ],
            'label' => [
                'position' => self::labelPositions['inside'],//self::LabelPosition_Inside,
                'offset' => [-10, -10],
                'padding' => [0, 0],
                'color' => 'auto',  // black
            ],
        ];

        $aChart_Series_Bar = [
            'type' => 'bar',
            'barWidth' => null,
            'barMaxWidth' => null,
            'barMinHeight' => 0,
            'barGap' => '30%',
            'barCategoryGap' => '20%',

            'label' => [
                'position' => self::labelPositions['inside'],//self::LabelPosition_Inside,
            ],
        ];

        $aChart_Series_Pie = [
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
                'position' => self::labelPositions['top'],//Top,
            ],

            'labelLine' => [
                'show' => true,
            ],
        ];


        Az::start(__METHOD__);


        /**
         *
         * Series Init
         */

        $aChart_Series_Pie = ArrayHelper::merge(
            $aChart_Series_ALL,
            $aChart_Series_Pie
        );

        $aChart_Series_Line = ArrayHelper::merge(
            $aChart_Series_ALL,
            $aChart_Series_Line
        );

        $aChart_Series_Bar = ArrayHelper::merge(
            $aChart_Series_ALL,
            $aChart_Series_Bar
        );

        $aChart_Series_Line_Stack = ArrayHelper::merge(
            $aChart_Series_Line,
            $aChart_Series_Line_Stack
        );

        $aChart_XAxis = ArrayHelper::merge(
            $aChart_XAxis,
            $chart_AxisCore
        );

        $aChart_YAxis = ArrayHelper::merge(
            $aChart_YAxis,
            $chart_AxisCore
        );


        /**
         *
         *
         * Fill Series Content
         */

        $aSeries = [];

        switch ($this->type) {
            case self::types['line']:
                $aSeries = $aChart_Series_Line;
                break;

            case self::types['linestack']:
                $aSeries = $aChart_Series_Line_Stack;
                break;

            case self::types['bar']:
                $aSeries = $aChart_Series_Bar;
                break;

            case self::types['pie']:
                $aSeries = $aChart_Series_Pie;
                break;
        }

        $iColumnCount = \count($this->data[0]) - 1;

        if ($this->type === self::types['pie'])
            $this->options['series'][] = $aSeries;
        else
            for ($i = 1; $i <= $iColumnCount; $i++) {
                $this->options['series'][] = $aSeries;
            }


        /**
         *
         * Fill Array Contents
         */


        if (empty($this->pieColumn))
            $this->options['dataset']['source'] = $this->data;
        else {
            Az::trace($this->pieColumn, 'Set IPie Column to');

            $iPieColumn = $this->pieColumn;
            $data_New = [];

            Linq::from($this->data)
                ->each(function (array $datitems) use (&$iPieColumn, &$data_New) {

                    $datitems_New = [];

                    $datitems_New[] = $datitems[0];
                    $datitems_New[] = $datitems[$iPieColumn];

                    $data_New[] = $datitems_New;
                });

            $this->options['dataset']['source'] = $data_New;
        }


        if ($this->type !== self::types['pie']) {

            $this->options['grid'] = $aChart_Grid;
            $this->options['xAxis'] = $aChart_XAxis;
            $this->options['yAxis'] = $aChart_YAxis;


            /**
             *
             * DataZoom
             */


            $dataZoom = [
                'startValue' => $this->startValue,
                'endValue' => $this->endValue,
                'start' => $this->start,
                'end' => $this->end,
            ];

            $aChart_DataZoom [0] = ArrayHelper::merge(
                $aChart_DataZoom [0],
                $dataZoom
            );

            $aChart_DataZoom [1] = ArrayHelper::merge(
                $aChart_DataZoom [1],
                $dataZoom
            );

            $this->options['dataZoom'] = $aChart_DataZoom;

        } else {
            $aChart_Tooltip['trigger'] = self::trigger['item'];
            $aChart_Tooltip['position'] = null;
        }

        $this->options['title'] = $aChart_Title;
        $this->options['tooltip'] = $aChart_Tooltip;
        $this->options['axisPointer'] = $aChart_AxisPointer;
        $this->options['toolbox'] = $aChart_Toolbox;
        $this->options['textStyle'] = $aChart_Textstyle;
        $this->options['legend'] = $aChart_Legend;

    }

    private function _quote($string)
    {
        return "'" . addcslashes($string, "'") . "'";
    }

}
