<?php

namespace zetsoft\widgets\former;

use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use kop\y2sp\ScrollPager;
use zetsoft\service\forms\Dynas;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZCheckColumn;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\column\ZScrollPager;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\navigat\ZButtonWidget;

/**
 * Class ZDynaWidget
 * @package widgets\former
 * http://demos.krajee.com/dynagrid
 */
class ZArrayWidget extends ZDynaWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'pageSummaryTotal' => true,
        'dynaSettings' => false,
        'title' => '',
        'titleSummary' => true,
        'pagerAjax' => true,

        'search' => true,
        'hasToolbar' => true,
        'toolbar' => [],
        'summary' => true,

        'actionView' => true,
        'actionEdit' => true,
        'actionDelete' => true,
        'actionClone' => true,

        'filename' => 'Export',
        'columnID' => true,
        'columnSerial' => true,
        'columnAction' => true,
        'columnCheckbox' => true,
        'columnExpand' => false,
        'columnFormula' => false,

        'exportUrl' => 'excel',
        'exportBtn' => '',

        'topCreate' => true,
        'topUpdate' => true,
        'topFilter' => true,
        'topSort' => true,
        'topSetting' => false,
        'topExport' => true,
        'bordered' => false,
        'showToolbar' => true,


        'theme' => self::theme['panel-primary'],
        'storage' => 'db',
        'exportHeader' => 'Экспортировать',
        'exportLabel' => 'Экспорт',
        'beforePjax' => '',
        'afterPjax' => '',
        'beforeHeaderContent' => '',
        'afterHeaderContent' => '',
        'beforeFooterContent' => '',
        'afterFooterContent' => '',

        //'panelType' => self::panelType['primary'],
        'panelIcon' => 'chart-pie',

        'panelFooter' => '',
        'panelBefore' => 'PanelBefore',
        'panelAfter' => 'PanelAfter',

        'striped' => true,
        'tableOptions' => [],
        'footerRowOptions' => [],
        'captionOptions' => [
            'class' => 'kv-table-caption',

        ],
        'headerRowOptions' => [],
        'headerIcon' => 'fas fa-chart-pie',
        'footerOptions' => [],
        //'checkboxColumnPos' => self::columnPos['right'],
        //'checkBoxType' => ZDynaWidget::checkBoxType['checkbox'],
        'panelTemplate' => "{panelHeading}{panelBefore}{items}{panelAfter}{panelFooter}",
        'idColumnTitle' => '#',


        'border' => false,
        'copy' => true,

    ];

    public $event = [];
    public $_event = [
        'eventSortUpdate' => ' console.log("EventSortUpdate"); ',
        'eventSortStart' => ' console.log("EventSortStart"); ',
        'eventSortStop' => ' console.log("EventSortStop"); ',
    ];

    public $replace = [];

    public $button = [];
    public $_button = [
        [
            'content' => '{toolbar}',
            'options' => ['class' => 'btn-group mr-2']
        ],
        [
            'content' => '{export} {exportAll}',
            'options' => ['class' => 'btn-group mr-2']
        ],
        [
            'content' => '{toggleData}',
            'options' => ['class' => 'btn-group mr-2']
        ],

        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'exportContainer' => ['class' => 'btn-group mr-2']
    ];

    public function codes()
    {

        $exportBtn = ZButtonWidget::widget([
            'config' => [
                'url' => $this->urlTo([
                    $this->_config['exportUrl'],
                    'modelClassName' => $this->modelClassName,
                    'query' => $this->model->configs->query,
                ]),
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                'btnSize' => ZButtonWidget::btnSize['default'],
                'btnRounded' => false,
                'btnFloating' => false,


                'title' => 'Export',
                'toggle' => ZButtonWidget::toggle['tooltip'],
                'color' => ZColor::color['none'],
                'iconSize' => ZButtonWidget::iconSize['2x'],
                'hasIcon' => true,
                'icon' => 'fiv-viv fiv-icon-xls',
            ],
            'event' => [
                'click' => 'function (event){e.preventDefault(); window.open(this.href, "_blank")}',
            ]
        ]);


        $exportAll = $this->_config['exportBtn'];

        if ($this->_config['search'])
            $this->_config['panelBefore'] = ZDynaSearchWidget::widget();

        $toolbar = '';

        if ($this->_config['topUpdate'])
            $toolbar .= ZHTML::a('<i class="fas fa-redo"></i>',
                    [$this->actionId],
                    [
                        'id' => "{$this->id}_Grid_Reset",
                        'data-pjax' => 1,
                        'class' => 'btn btn-rounded btn-outline-primary',
                        'title' => Az::l('Перезагрузить'),
                    ]) . ZCheckButtonWidget::widget([
                    'config' => [
                        'text' => '',
                        'url' => '/',
                        'icon' => 'fas fa-copy',
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                        'class' => 'sampleCoreInput',

                    ]
                ]);

        $pagers = [];
        if ($this->_config['pagerAjax'])
            $pagers = [
                'class' => ZScrollPager::class,
                'enabledExtensions' => [
                    ScrollPager::EXTENSION_TRIGGER,
                    ScrollPager::EXTENSION_SPINNER,
                    ScrollPager::EXTENSION_NONE_LEFT,
                    ScrollPager::EXTENSION_PAGING,
                ],

            ];


        $counts = new $this->model();
        //vdd($this->data);
        foreach ($this->data as $data) {

            if (isset($data->attributes)) {
                foreach ($data->attributes as $key => $item)
                    if (is_int($item))
                        $counts->$key += $data->$key;
            } else {
                foreach ($data as $key => $item)
                    if (is_int($item))
                        $counts->$key += $data[$key];
            }
        }

        $columns = [];

      /*  if ($this->_config['columnID'])
            $columns[] = $this->_layout['columnID'];*/


        foreach ($this->model->columns as $key => $column) {

            $configs = $this->model->configs;

            if (empty($column->filterWidget)) {
                $column->filterWidget = $column->widget;
                $column->filterOptions = $column->options;
            }

            if ($this->_config['pageSummaryTotal'])
                $summary = $counts->$key;
            else
                $summary = (new Dynas())->summaryCheck($key, $column, $configs);
/*
            $filter = (new DyGrid())->filterCheck($key, $column, $configs);

            if (!$filter)
                $column->mergeHeader = true;
*/


            if (!empty($column->roleShow))
                foreach ($column->roleShow as $deny) {
                    if ($this->hasRole($deny))
                        continue;
                }

            if (!empty($configs->roleShow))
                foreach ($configs->roleShow as $deny) {
                    if ($this->hasRole($deny))
                        continue;
                }

            $columns[] = [
                'class' => ZKDataColumn::class,
                'attribute' => $key,
             //   'filter' => $filter,
                'filterType' => $column->filterWidget,
                'format' => $column->format,
                'width' => $column->width,
                'mergeHeader' => $column->mergeHeader,
                'hiddenFromExport' => $column->hiddenFromExport,
                'pageSummary' => $summary,
                'pageSummaryFunc' => GridView::F_SUM,

                'filterWidgetOptions' => [
                    'config' => [
                        'hasIcon' => false
                    ]
                ],
            ];


            $this->css = strtr($this->css, [
                '{td-width}' => $column->width
            ]);

        }
        
        if ($this->_config['columnCheckbox'])
            $columns[] = [
                'class' => ZCheckColumn::class,
                'order' => DynaGrid::ORDER_FIX_RIGHT,
                'checkboxOptions' => [
                    'class' => 'kv-row-checkbox simple-' . $this->id
                ],
            ];

        $this->provider = $this->model->searchForm($this->data);
        $toolbarBtn = [];

        $this->_config['toolbar'] = ZArrayHelper::merge($this->_button, $this->_config['toolbar']);
        foreach ($this->_config['toolbar'] as $button) {
            if (is_array($button) && key_exists('content', $button)) {

                $button['content'] = strtr($button['content'], [
                    '{toolbar}' => $toolbar,
                    '{exportAll}' => $exportAll,
                ]);
                $toolbarBtn[] = $button;
            }
        }

        $this->options = ZArrayHelper::merge($this->options, [
            'userSpecific' => false,
            'columns' => $columns,
            'showPersonalize' => false,
            'gridOptions' => [
                'toolbar' => $this->_config['showToolbar'] ? $toolbarBtn : [],

                'dataProvider' => $this->provider,
                'filterModel' => $this->model,
                'rowOptions' => ['class' => 'kv-dyna-rows'],
                'showPageSummary' => $this->model->configs->pageSummary,
                'panel' => [
                    'heading' => $this->_config['title'],
                    /**
                     *
                     * This allow to take config from database
                     */
                    //   'type' => $this->sPanelType,
                    'headingOptions' => [
                        // 'class' => 'card-header'
                    ],
                    'footerOptions' => [
                        //  'class' => 'panel-footer'
                    ],
                    'before' => $this->_config['panelBefore'],
                    'beforeOptions' => [
                        // 'class' => 'kv-panel-before'
                    ],
                    'after' => $this->_config['panelAfter'],
                    'afterOptions' => [
                        // 'class' => 'kv-panel-after'
                    ],
                ],
                'layout' => '{summary}\n{items}\n{pager}',
                'panelTemplate' => $this->_config['panelTemplate'],
                'panelHeadingTemplate' => "{summary} {title}<div class='clearfix'></div>",
                'panelBeforeTemplate' => "{toolbarContainer} {before}<div class='clearfix'></div>",
                'panelAfterTemplate' => "{after}",
                'panelFooterTemplate' => "<div class='kv-panel-pager'>{pager}</div>{footer}<div class='clearfix'></div>",
            ],
            'options' => [
                'id' => $this->modelClassName . '-' . $this->userIdentity()->id
            ],
        ]);

        $this->js .= <<<JS
    $("td").on('click', function(){
       var range = document.createRange();
       range.selectNodeContents(this);
       var text = range['startContainer']['innerText'];
       copyToClipboard(text);
       console.log('Copied: ' + text);
       
   });
JS;

        $this->css = <<<CSS
    .kv-page-summary{
     background-color: #f5f5d7 !important;
     text-align: center;
    }
    
    .kv-dyna-rows {
     text-align: center;
    }
    
     .tr-dynawidget td {
        width: {td-width} !important; 
     }
         
CSS;

        if ($this->isCLI())
            return null;
            $this->options['showPersonalize'] = false;
        $this->htm = DynaGrid::widget($this->options);

    }


}
