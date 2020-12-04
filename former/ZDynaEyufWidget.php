<?php

namespace zetsoft\widgets\former;

use kartik\dynagrid\DynaGrid;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\ExpandRowColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use kartik\sortable\Sortable;
use kop\y2sp\ScrollPager;
use kotchuprik\sortable\grid\Column as SortableColumn;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZCheckColumn;
use zetsoft\system\column\ZExpandRowColumn;
use zetsoft\system\column\ZFormulaColumn;
use zetsoft\system\column\ZScrollPager;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZIcon;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZPopoverXWidget;
use function foo\func;

/**
 * Class ZDynaEyufWidget
 * @package widgets\former
 * http://demos.krajee.com/dynagrid
 */
class ZDynaEyufWidget extends ZWidget
{
    /** @var ActiveDataProvider $provider */
    public $provider;

    public $columns;
    public $formula;

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'title' => '',
        'titleSummary' => true,
        'exportAll' => true,

        'search' => true,
        'filename' => 'Table Export',
        'hasToolbar' => true,
        'toolbar' => [],
        'columnAction' => true,

        'actionView' => true,
        'actionEdit' => true,
        'actionDelete' => true,
        'actionClone' => true,
        'actionDetail' => true,

        'btnView' => null,
        'btnEdit' => null,
        'btnDelete' => null,
        'btnClone' => null,
        'btnDetail' => null,

        'columnID' => true,
        'columnSerial' => true,

        'columnCheckbox' => true,
        'columnExpand' => true,
        'columnFormula' => false,
        'columnRelation' => true,


        'topCreate' => true,
        'topUpdate' => true,
        'topFilter' => true,
        'topSort' => true,
        'topSetting' => true,
        'topExport' => true,

        'export' => '',


        'titleCreate' => '',
        'titleRefresh' => '',
        'titleDeleteAll' => '',
        'titleCloneAll' => '',

        'createUrl' => ['create'],
        'updateUrl' => 'update',
        'expandUrl' => 'expand',
        'detailUrl' => 'detail',
        'deleteUrl' => 'delete',

        'cloneUrl' => 'clone',
        'viewUrl' => 'view',
        'exportUrl' => 'excel',


        'summary' => false,
        'pagerAjax' => false,

        'theme' => self::theme['panel-primary'],
        'storage' => 'db',


        'beforePjax' => '',
        'afterPjax' => '',
        'beforeHeaderContent' => '',
        'afterHeaderContent' => '',
        'beforeFooterContent' => '',
        'afterFooterContent' => '',

        'panelType' => self::panelType['primary'],
        'panelIcon' => 'chart-pie',

        'panelFooter' => '',
        'panelBefore' => '',
        'panelAfter' => false,

        'exportBtn' => null
    ];

    public $event = [];
    public $_event = [
        'eventSortUpdate' => ' console.log("EventSortUpdate"); ',
        'eventSortStart' => ' console.log("EventSortStart"); ',
        'eventSortStop' => ' console.log("EventSortStop"); ',
    ];

    public const theme = [
        'panel-danger' => 'panel-danger',
        'panel-info' => 'panel-info',
        'panel-warning' => 'panel-warning',
        'panel-default' => 'panel-default',
        'panel-primary' => 'panel-primary',
        'panel-success' => 'panel-success',
    ];

    public const format = [
        'raw' => 'raw',
        'text' => 'text',
        'html' => 'html',
    ];

    public const panelType = [
        'default' => 'default',
        'primary' => 'primary',
        'info' => 'info',
        'danger' => 'danger',
        'success' => 'success',
        'active' => 'active',
    ];

    public function init()
    {
        parent::init();


        if ($this->_config['search'])
            $this->_config['panelBefore'] = ZDynaSearchWidget::widget();

        if (empty($this->_config['title']))
            $this->_config['title'] = $this->model->configs->title;
        
        $this->options = [
            'bsVersion' => $this->bsVersion,

            /**
             * storage
             * 'session' or DynaGrid::TYPE_SESSION:
             * 'cookie' or DynaGrid::TYPE_COOKIE
             * 'db' or DynaGrid::TYPE_DB
             */
            'storage' => $this->_config['storage'],
            'theme' => $this->_config['theme'],
            'userSpecific' => true,
            'dbUpdateNameOnly' => false,
            'enableMultiSort' => true,
            'showFilter' => $this->_config['topFilter'],
            'showSort' => $this->_config['topSort'],
            'showPersonalize' => $this->_config['topSetting'],
            'allowPageSetting' => true,
            'allowThemeSetting' => true,
            'allowFilterSetting' => true,
            'allowSortSetting' => true,
            'matchPanelStyle' => true,
            'toggleButtonGrid' => [
                'label' => '<span class="fas fa-wrench fa-fw"></span>',
                'title' => Az::l('Personalize grid settings'),
                'data-pjax' => true,
            ],
            'toggleButtonFilter' => [
                'label' => '<span class="fas fa-filter fa-fw"></span>',
                'title' => Az::l('Save / edit grid filter'),
                'data-pjax' => true,
            ],
            'toggleButtonSort' => [
                'label' => '<span class="fas fa-sort fa-fw"></span>',
                'title' => Az::l('Save / edit grid sort'),
                'data-pjax' => true,
            ],

            /**
             * sortable options
             * http://demos.krajee.com/sortable
             */
            'sortableOptions' => [
                /**
                 * list
                 * Sortable::TYPE_LIST or list
                 * Sortable::TYPE_GRID or grid
                 */
                'type' => Sortable::TYPE_LIST,
                'connected' => false,
                'disabled' => false,
                'showHandle' => false,
                //  'handleLabel' => '<i class="fas fa-arrows-alt"><i>',
                'itemOptions' => [],
                /*   'items' => [
                       'content' => '',
                       'disabled' => false,
                       'options' => ''
                   ],*/
                'options' => [],
                /**
                 * pluginOptions
                 * https://github.com/lukasoppermann/html5sortable
                 */
                'pluginOptions' => [
                    /**
                     *
                     *  items: ':not(.disabled)',
                     *  handle: 'h2',
                     *  forcePlaceholderSize: true,
                     *  onnectWith: 'connected',
                     *  acceptFrom: '.selector,.anotherSortable',
                     *  placeholder: '<tr><td colspan="7">&nbsp;</td></tr>',
                     *  hoverClass: 'is-hovered is-hovered-class' // Defaults to false
                     *  maxItems: 3 // Defaults to 0 (no limit)
                     *  copy: true // Defaults to false
                     */
                ],
                /**
                 * pluginEvents
                 * https://github.com/lukasoppermann/html5sortable
                 */
                'pluginEvents' => [
                    'sortstart' => $this->eventCode('eventSortStart'),
                    'sortstop' => $this->eventCode('eventSortStop'),
                    'sortupdate' => $this->eventCode('eventSortUpdate'),
                ],

            ],
            'sortableHeader' => ['class' => 'alert alert-info dynagrid-column-header'],
            'submitMessage' => Az::l('Saving and applying configuration'),
            'deleteMessage' => Az::l('Trashing all personalizations'),
            'messageOptions' => [],
            'deleteConfirmation' => Az::l(' Are you sure you want to delete the setting?'),
            'submitButtonOptions' => [
                'icon' => 'save',
                'label' => '',
                'title' => Az::l('Save grid settings'),
            ],
            'resetButtonOptions' => [
                'icon' => 'redo',
                'label' => '',
                'title' => Az::l('trashRemove saved grid setting'),
            ],
            'iconVisibleColumn' => '<i class="fas fa-eye-open"></i>',
            'iconHiddenColumn' => '<i class="fas fa-eye-close"></i>',
            'columns' => null,
            'gridOptions' => [
                'pager' => null,
                'pjax' => true,
                'toolbar' => [],

                'dataProvider' => null,
                'filterModel' => null,
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'responsiveWrap' => true,
                'hover' => true,
                'containerOptions' => [],
                'perfectScrollbar' => true,
                'perfectScrollbarOptions' => [],
                'tableOptions' => [],
                'footerRowOptions' => [
                    // 'class' => 'kv-table-footer'
                ],
                'captionOptions' => [
                    'class' => 'kv-table-caption',

                ],
                'headerRowOptions' => [],
                'rowOptions' => static function ($model, $key, $index, $grid) {

                    return [
                        //'class' => GridView::TYPE_ACTIVE,
                        'class' => 'tr-dynawidget',
                        'data-id' => $model->id ?? null,
                        'data-copy' => $model->id,
                        'data-position' => $model->sort ?? null,
                    ];

                },
                'pjaxSettings' => [
                    'neverTimeout' => true,
                    'beforeGrid' => $this->_config['beforePjax'],
                    'afterGrid' => $this->_config['afterPjax'],
                    'options' => [],
                    'loadingCssClass' => 'kv-grid-loading',

                ],
                'beforeHeader' => [
                    'columns' => [
                        'content' => $this->_config['beforeHeaderContent'],
                        'tag' => '',
                        'options' => [],
                    ],
                    'options' => [],
                ],
                'afterHeader' => [
                    'columns' => [
                        'content' => $this->_config['afterHeaderContent'],
                        'tag' => '',
                        'options' => [],
                    ],
                    'options' => [],
                ],
                'beforeFooter' => [
                    'columns' => [
                        'content' => $this->_config['beforeFooterContent'],
                        'tag' => '',
                        'options' => [],
                    ],
                    'options' => [],
                ],
                'afterFooter' => [
                    'columns' => [
                        'content' => $this->_config['afterFooterContent'],
                        'tag' => '',
                        'options' => [],
                    ],
                    'options' => [],
                ],
                'resizableColumns' => true,
                'persistResize' => false,
                'hideResizeMobile' => true,
                'resizableColumnsOptions' => [],
                'resizeStorageKey' => App,
                'floatHeader' => false,
                'floatOverflowContainer' => false,
                'floatHeaderOptions' => [
                    'scrollingTop' => 50
                ],
                'showPageSummary' => $this->_config['summary'],
                'pageSummaryRowOptions' => ['class' => 'kv-page-summary warning'],
                'panel' => [
                    'heading' => $this->_config['title'],

                    //   'type' => $this->sPanelType,
                    'headingOptions' => [
                        // 'class' => 'card-header'
                    ],
                    'footer' => $this->_config['panelFooter'],
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
                'layout' => null,
                'panelTemplate' => "<div class='panel {type}'>
                    {panelHeading}
                    {panelBefore}
                    {items}
                    {panelAfter}
                    {panelFooter}
                </div>",
                'panelHeadingTemplate' => null,
                'panelBeforeTemplate' => "{toolbarContainer} {before}<div class='clearfix'></div>",
                'panelAfterTemplate' => "{after}",
                'panelFooterTemplate' => "<div class='kv-panel-pager'>{pager}</div>{footer}<div class='clearfix'></div>",

                'replaceTags' => [
                    '{custom}' => function ($widget) {
                        if ($widget->panel === false) {
                            return '';
                        }

                        return '';
                    }
                ],
                'bordered' => true,

            ],
            'options' => [
                'id' => null
            ],

        ];


        $this->_layout = [

            'columnFormula' => [
                'class' => ZFormulaColumn::class,
                'attribute' => 'formula',
                'label' => Az::l('Общее'),
                'options' => [

                ],
                'value' => function ($model) {

                    $summ = 0;
                    if (!empty($this->formula)) {

                        foreach ($this->formula as $item) {
                            $summ += $model->{$item};
                        }

                        return $summ;
                    }


                    /** @var Models $model */
                    $columns = $model->columns();

                    foreach ($columns as $key => $item) {
                        $in = $item->dbType === dbTypeInteger;
                        $id = !ZStringHelper::endsWith($key, '_id');
                        $ids = !ZStringHelper::endsWith($key, '_ids');

                        if ($in && $id && $ids)
                            $summ += $model->{$key};

                    }

                    return $summ;
                }
            ],


            'columnID' => [
                'class' => SerialColumn::class,
                'order' => DynaGrid::ORDER_FIX_LEFT,
            ],


            'columnSort' => [
                'class' => SortableColumn::class,
            ],


            'columnAction' => function ($template) {

                return [
                    'class' => ActionColumn::class,
                    'header' => Az::l('Действия'),
                    'template' => $template,
                    'dropdown' => false,
                    'width' => '30px',
                    'order' => DynaGrid::ORDER_FIX_LEFT,
                    'buttons' => [

                        'clone' => $this->_config['btnClone'],

                        'delete' => $this->_config['btnDelete'],

                        'update' => $this->_config['btnEdit'],

                        'view' => $this->_config['btnView'],

                        'detail' => $this->_config['btnDetail']
                    ],
                ];

            },


            'columnCheckbox' => [
                'class' => ZCheckColumn::class,
                'order' => DynaGrid::ORDER_FIX_RIGHT,
                'checkboxOptions' => [
                    'class' => 'kv-row-checkbox simple-' . $this->id
                ],
            ],


            'columnExpand' => [
                'class' => ZExpandRowColumn::class,
                'attribute' => 'expand',
                'value' => function ($model, $key, $index) {
                    return GridView::ROW_COLLAPSED;
                },
                /*'detail' => function ($model, $key, $index, $column) {
                    return Az::$app->controller->renderPartial('detail', ['model' => $model, 'key' => $key]);
                },*/
                'detailUrl' => ZUrl::to(['expand'])

            ],


            'columnRelation' => function ($hasMany, $isBtn) {

                return [
                    'class' => ActionColumn::class,
                    'template' => '{clone}',
                    'dropdown' => false,
                    'header' => Az::l('Связи'),
                    'width' => '30px',
                    'order' => DynaGrid::ORDER_FIX_LEFT,
                    'buttons' => [
                        'clone' =>
                            function ($url, $model) use ($hasMany, $isBtn) {

                                /* @var Models $model */

                                $returns = '';


                                foreach ($hasMany as $className => $relation) {

                                    $relatedTable = ZArrayHelper::getValue(array_keys($relation), 0);

                                    $relatedColumn = ZArrayHelper::getValue(array_values($relation), 0);

                                    $url = $className . '[' . $relatedTable . ']';

                                    $url = [ZInflector::dash($className) . '/index', $url => $model->{$relatedColumn}];

                                    $class = $this->bootFull($className);

                                    if (!class_exists($class))
                                        continue;

                                    /** @var Models $item */
                                    $item = new $class();
                                    $title = $item->configs()->title;


                                    /**
                                     *
                                     * Icon
                                     */


                                    $icon = $this->utils->mains->icon();

                                    $returns .= ZButtonWidget::widget([
                                        'config' => [
                                            'text' => $title,
                                            'url' => ZUrl::to($url),
                                            'icon' => $icon,
                                            'pjax' => 0,
                                            'btnRounded' => false,
                                            'btn' => true,
                                            'target' => ZButtonWidget::target['_self'],
                                            'btnSize' => ZButtonWidget::btnSize['default'],
                                            'btnStyle' => ZButtonWidget::btnStyle['none'],
                                            'blank' => true,
                                            'hasIcon' => true,

                                        ],
                                        'event' => [
                                            'click' => 'function (event){e.preventDefault()}'
                                        ]

                                    ]);

                                }

                                return ZPopoverXWidget::widget([
                                    'config' => [
                                        'content' => $returns,
                                        'titleHeader' => $title,
                                        'buttonIcon' => 'far fa-' . FA::_COMMENT_ALT,
                                        'size' => ZPopoverXWidget::size['sm'],
                                        'isBtn' => $isBtn
                                    ]
                                ]);

                            },
                    ],
                ];

            },


            'pagers' => [
                'class' => ZScrollPager::class,
            ],


            'btnDetail' => function ($url, $model) {
                return ZButtonWidget::widget([
                    'config' => [
                        'title' => Az::l('Show Details'),
                        'url' => $this->urlTo([
                            $this->_config['detailUrl'],
                            'modelClassName' => $this->modelClassName,
                            'id' => $model->id,
                        ]),
                        'hasIcon' => true,
                        'icon' => 'fa fa-' . FA::_INFO_CIRCLE,
                        'btn' => false,
                        'hasConfirm' => false,
                        'btnRounded' => false,

                    ],
                ]);
            },


            'btnClone' => function ($url, $model) {
                return ZButtonWidget::widget([
                    'config' => [
                        'title' => Az::l('Клонировать'),
                        'url' => $this->urlTo([
                            $this->_config['cloneUrl'],
                            'modelClassName' => $this->modelClassName,
                            'id' => $model->id,
                        ]),
                        'hasIcon' => true,
                        'icon' => 'fa fa-' . FA::_CLONE,
                        'btn' => false,
                        'hasConfirm' => true,
                        'btnRounded' => false,
                        'confirm' => Az::l('Are you sure you want CLONE columns?'),
                        'confirmTitle' => Az::l('Клонировать')

                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault()}'
                    ]
                ]);
            },


            'btnEdit' => function ($url, $model) {

                return ZButtonWidget::widget([
                    'config' => [

                        'title' => Az::l('Изменить'),
                        'url' => $this->urlTo([
                            $this->_config['updateUrl'],
                            'id' => $model->id,
                        ]),
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'btn' => false,
                        'icon' => 'fa fa-' . FA::_EDIT,
                        'confirm' => 'Are you sure you want DELETE columns?'
                    ]
                ]);
            },

            'btnView' => function ($url, $model) {

                return ZButtonWidget::widget([
                    'config' => [
                        'title' => Az::l('Просмотр'),
                        'url' => $this->urlTo([
                            $this->_config['viewUrl'],
                            'id' => $model->id,
                        ]),
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'btn' => false,
                        'icon' => 'fa fa-' . FA::_EYE,
                    ]
                ]);
            },


            'btnDelete' => function ($url, $model) {

                return ZButtonWidget::widget([
                    'config' => [
                        'title' => Az::l('Удалить'),
                        'url' => ZUrl::to([
                            $this->_config['deleteUrl'],
                            'modelClassName' => $this->modelClassName,
                            'id' => $model->id,
                        ]),
                        'hasIcon' => true,
                        'icon' => 'fas fa-' . FA::_TRASH,
                        'btnRounded' => false,
                        'btn' => false,
                        'hasConfirm' => true,
                        'confirmTitle' => Az::l('Удалить'),
                        'сonfirm' => Az::l('Are you sure you want DELETE columns?'),
                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault()}'
                    ]
                ]);
            },


            'expotExcel' => function ($q) {

                return ZButtonWidget::widget([
                    'config' => [
                        'url' => $this->urlTo([
                            $this->_config['exportUrl'],
                            'modelClassName' => $this->modelClassName,
                            'query' => $q,
                        ]),
                        'btnType' => ZButtonWidget::btnType['link'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                        'btnSize' => ZButtonWidget::btnSize['default'],
                        'btnRounded' => false,
                        'btnFloating' => false,

                        'title' => 'Export',
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                        'color' => ZColor::color['none'],
                        'iconSize' => ZButtonWidget::iconSize['default'],
                        'hasIcon' => true,
                        'icon' => 'fiv-viv fiv-icon-xls',
                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault(); window.open(this.href, "_blank")}',
                    ]
                ]);

            },


            'update' => function () {

                return ZHTML::a('<i class="fas fa-redo">&nbsp;&nbsp;' . $this->_config['titleRefresh'] . '</i>',
                    [$this->actionId],
                    [
                        'id' => "{$this->id}_Grid_Reset",
                        'data-pjax' => 1,
                        'class' => 'btn btn-rounded btn-outline-primary update-dynagrid',
                        'title' => Az::l('Перезагрузить'),
                    ]);

            },


            'sortable' => <<<JS
      
      function zSortable() {
          $('table tbody').sortable({
                    update: function (event, ui) {
                        $(this).children().each(function (index) {
                        let position = parseInt($(this).attr('data-position'));
                        
                            if (position !== (index + 1)) {
                                $(this).attr('data-position', (index + 1)).addClass('updated');
        
                            }
                        });
                        saveNewPositions('{url}');
                    }
                });        
      }
      
      {sortablePjax}

      
JS,

            'sortablePjax' => <<<JS
        zSortable();
      
       jQuery(document).on('pjax:end', function () {
          zSortable();
          });
JS,


        ];

    }


    private function actionButtons()
    {

        if ($this->_config['btnDetail'] === null)
            $this->_config['btnDetail'] = $this->_layout['btnDetail'];

        if ($this->_config['btnClone'] === null)
            $this->_config['btnClone'] = $this->_layout['btnClone'];

        if ($this->_config['btnEdit'] === null)
            $this->_config['btnEdit'] = $this->_layout['btnEdit'];

        if ($this->_config['btnView'] === null)
            $this->_config['btnView'] = $this->_layout['btnView'];

        if ($this->_config['btnDelete'] === null)
            $this->_config['btnDelete'] = $this->_layout['btnDelete'];

    }


    private function columns()
    {

        if (!empty($this->columns))
            return false;

        if ($this->_config['columnID'])
            $this->columns[] = $this->_layout['columnID'];

        if ($this->_config['columnFormula'])
            $this->columns[] = $this->_layout['columnFormula'];

        if (ZArrayHelper::keyExists('sort', $this->model->columns()))
            $this->columns[] = $this->_layout['columnSort'];

        if ($this->_config['columnAction']) {

            $template = '';

            if ($this->_config['actionView'])
                $template .= '{view}';

            if ($this->_config['actionEdit'])
                $template .= '{update}';

            if ($this->_config['actionDelete'])
                $template .= '{delete}';

            if ($this->_config['actionClone'])
                $template .= '{clone}';

            if ($this->_config['actionDetail'])
                $template .= '{detail}';

            $this->columns[] = $this->_layout['columnAction']($template);

        }

        if ($this->_config['columnRelation'])
            if (!empty($this->modelConfigs->hasMany)) {
                $hasMany = $this->modelConfigs->hasMany;
                $isBtn = $this->modelConfigs->relationBtn;
                $width = $this->modelConfigs->relationWidth;

                $this->columns[] = $this->_layout['columnRelation']($hasMany, $isBtn);
            }

        if ($this->_config['columnCheckbox'])
            $this->columns[] = $this->_layout['columnCheckbox'];

        if (!$this->_config['columnAction'])
            $this->_config['columnCheckbox'] = false;

        if ($this->_config['columnExpand'])
            $this->columns[] = $this->_layout['columnExpand'];

        $this->forms->dyGrid->clean();
        $this->forms->dyGrid->columns = $this->columns;
        $this->forms->dyGrid->model = $this->model;

        $this->forms->dyGrid->run();
        $this->columns = $this->forms->dyGrid->columns;

    }

    public $toolbar = [

        'update' => [
            'content' => '{update}',
            'options' => ['class' => 'btn-group p-0 mr-2']
        ],

        'add-clone-delete' => [
            'content' => "{add}{clone}{delete}",
            'options' => ['class' => 'btn-group p-0 mr-2']
        ],

        'filter-sort-id' => [
            'content' => '{dynagridFilter}{dynagridSort}{dynagrid}',
            'options' => ['class' => 'btn-group p-0 mr-2']
        ],

        'export' => [
            'content' => '{export}',
            'options' => ['class' => 'btn-group mr-2']
        ],

        'exportAll' => [
            'content' => '{exportAll}',
            'options' => ['class' => 'btn-group mr-2']
        ],

        'exportExcel' => [
            'content' => "{exportExcel}",
            'options' => ['class' => 'btn-group mr-2']
        ],

        'toggleData' => [
            'content' => '{toggleData}',
            'options' => ['class' => 'btn-group mr-2']
        ],
    ];


    public function codes()
    {

        $this->actionButtons();
        /**
         *
         * Set Provider
         */

        if ($this->provider === null) {
            $this->model->search = true;
            $this->provider = $this->model->search();
        }


        /**
         *
         * Columns Config
         */

        $this->columns();


        $query = null;
        if (isset($this->model->configs->query))
            $query = serialize($this->model->configs->query->where);
        $exportAll = ZExportBtnWidget::widget([
            'config' => [
                'hidden' => true,
                'action' => 'export',
                'modelClassName' => $this->modelClassName,
            ]
        ]);

        $exportExcel = $this->_layout['expotExcel']($query);

        $update = '';
        if ($this->_config['topUpdate'])
            $update = ZHTML::a('<i class="fas fa-redo">&nbsp;&nbsp;' . $this->_config['titleRefresh'] . '</i>',
                [$this->actionId],
                [
                    'id' => "{$this->id}_Grid_Reset",
                    'data-pjax' => 1,
                    'class' => 'btn btn-rounded btn-outline-primary update-dynagrid',
                    'title' => Az::l('Перезагрузить'),
                ]);

        /**
         *
         * Manager Buttons
         */

        $add = '';
        $clone = '';
        $delete = '';

        if ($this->_config['topCreate'])
            $add .= ZHTML::a('<i class="fas fa-plus">&nbsp;&nbsp;' . '</i>' . $this->_config['titleCreate'],
                $this->urlMerge($this->_config['createUrl']),
                [

                    'class' => 'btn btn-rounded btn-outline-primary create-dynagrid',
                    'title' => Az::l('Добавить'),
                ]);

        $cloneUrl = ZUrl::to([
            'clone-all',
            'modelClassName' => $this->modelClassName
        ]);


        $deleteUrl = ZUrl::to([
            'delete-all',
            'modelClassName' => $this->modelClassName
        ]);

        if ($this->_config['actionClone'])
            $clone .= ZDynaCheckWidget::widget([
                'config' => [
                    'url' => $cloneUrl,
                    'class' => 'simple-' . $this->id,
                    'message' => Az::l("Вы хотите клонировать этот элемент(ы)?")
                ]
            ]);

        if ($this->_config['actionDelete'])
            $delete .= ZDynaCheckWidget::widget([
                'config' => [
                    'url' => $deleteUrl,
                    'class' => 'simple-' . $this->id,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger'],
                    'icon' => 'fas fa-trash-alt',
                    'message' => Az::l("Вы хотите удалить этот элемент(ы)?"),
                ]
            ]);


        /**
         *
         * Pager
         */

        $pagers = [];

        if ($this->_config['pagerAjax'])
            $pagers = $this->_layout['pagers'];

        /**
         *
         * Core Options
         */

        $summary = ($this->_config['titleSummary']) ? '{summary}' : '';
        if ($this->_config['hasToolbar'])
            $this->_config['toolbar'] = ZArrayHelper::merge($this->toolbar, $this->_config['toolbar']);

        $toolbar = [];
        foreach ($this->_config['toolbar'] as $value) {
            if (is_array($value)):
                $value['content'] = strtr($value['content'], [
                    '{update}' => $update,
                    '{add}' => $add,
                    '{clone}' => $clone,
                    '{delete}' => $delete,
                    '{exportAll}' => $exportAll,
                    '{exportExcel}' => $exportExcel,
                ]);
                $toolbar[] = $value;
            endif;
        }


        $this->options = ZArrayHelper::merge($this->options, [

            'columns' => $this->columns,
            'gridOptions' => [
                'pager' => $pagers,
                'toolbar' => $toolbar,

                'dataProvider' => $this->provider,
                'filterModel' => $this->model,

                'layout' => $summary . '\n{items}\n{pager}',
                'panelHeadingTemplate' => "$summary {title}<div class='clearfix'></div>",
                'panelBeforeTemplate' => "{toolbarContainer} {before}<div class='clearfix'></div>",
                'panelFooterTemplate' => "<div class='kv-panel-pager'>{pager}</div>{footer}<div class='clearfix'></div>",
            ],
            'options' => [
                'id' => $this->modelClassName . '-' . $this->userIdentity()->id
            ],

        ]);


        if (ZArrayHelper::keyExists('sort', $this->model->columns()))
            $this->js .= strtr($this->_layout['sortable'], [
                '{url}' => ZUrl::to([
                    'sortable',
                    'modelClassName' => $this->modelClassName
                ]),
                '{sortablePjax}' => $this->_layout['sortablePjax']
            ]);


        /*$this->js .= ZDynaCheckWidget::widget([
            'config' => [
                'buttonId' => 'cloneAll',
                'class' => 'simple-' . $this->id,
                'url' => $cloneUrl,
                'message' => Az::l('Вы действительно хотите клонировать все эти данные?'),
            ]
        ]);

        $this->js .= ZDynaCheckWidget::widget([
            'config' => [
                'buttonId' => 'deleteAll',
                'class' => 'simple-' . $this->id,
                'url' => $deleteUrl,
                'message' => Az::l('Вы действительно хотите удалить все эти данные?'),
            ]
        ]);*/


        foreach ($this->model->columns() as $key => $column) {

            $this->css = strtr($this->css, [
                '{td-width}' => $column->width
            ]);

        }


        $this->css = <<<CSS

       .dropdown-toggle::after {
         margin-left: 6px !important; 
         }
         .bootstrap-switch-container {
         display: flex!important;
         }
         
         .tr-dynawidget td {
            
            width: {td-width} !important; 
         
         }
         
         
         

CSS;


        $this->js .= <<<JS
   $(document).on('click', 'td', function (e) {
   var target = $( e.target );
   if (target.is('td')){
   var range = document.createRange();
       range.selectNodeContents(this);
       var text = range['startContainer']['innerText'];
       copyToClipboard(text);
       e.stopPropagation();
       console.log('Copied: ' + text);
   }
});

JS;

        if ($this->isCLI())
            return null;

        $this->htm = DynaGrid::widget($this->options);
    }


}
