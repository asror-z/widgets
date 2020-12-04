<?php

namespace zetsoft\widgets\former;

use kartik\dynagrid\DynaGrid;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use kartik\sortable\Sortable;
use kotchuprik\sortable\grid\Column as SortableColumn;
use lysenkobv\GeoIP\Location;
use PHPUnit\Util\Log\JSON;
use rmrevin\yii\fontawesome\FA;
use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\drag\DragConfig;
use zetsoft\models\drag\DragConfigDb;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZCheckColumn;
use zetsoft\system\column\ZExpandRowColumn;
use zetsoft\system\column\ZFormulaColumn;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\column\ZLinkPager;
use zetsoft\system\column\ZRadioColumn;
use zetsoft\system\column\ZScrollPager;
use zetsoft\system\column\ZSortableColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZBarInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetOrg;
use zetsoft\widgets\notifier\ZJspanelWidgetRavshan;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\themes\ZCardWidget;

/**
 * Class ZDynaWidgetRav
 * @package widgets\former
 * http://demos.krajee.com/dynagrid
 */
class ZDynaWidgetRav extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        /**
         * Titles
         *
         */
        'allrecord' => 1,
        'checkSelectedClass' => ZColor::color['green lighten-5'],
        'reload' => ZDynaWidgetRav::reload['false'],
        'twoCheck' => false,

        'spa' => true,
        'spaWidth' => [],
        'spaHeight' => [],
        'spaTitle' => [],
        'spaArray' => [],
        'isNewRecord' => false,
        'newRecordValues' => [],

        'chooseQuery' => [],
        'floatHeader' => false,
        'chooseParams' => [],

        'title' => '',
        'viewTitle' => '',
        'updateTitle' => '',
        'detailTitle' => '',
        'titleSummary' => true,

        'copy' => true,
        'paginationColor' => '#10b410',
        'exportAll' => true,
        'search' => true,
        'barCode' => false,
        'barCodeAttr' => 'id',
        'filename' => 'Table Export',
        'hasToolbar' => true,
        'editableLink' => true,
        'border' => false,
        'actionButtons' => [],
        'leftButtons' => [

        ],


        /**
         * Ko'rish kerak
         */

        'btnView' => null,
        'btnEdit' => null,
        'btnDelete' => null,
        'btnClone' => null,
        'btnDetail' => null,
        'generate' => null,
        'numbers' => [],

        'iconSize' => ZButtonWidget::iconSize['2x'],

        'grapes' => true,
        'radio' => null,

        'columnBefore' => [],
        'columnAfter' => [],


        'titleCreate' => '',
        'titleRefresh' => '',
        'titleDeleteAll' => '',
        'titleCloneAll' => '',

        'createUrl' => '{fullUrl}/create.aspx',
        'updateUrl' => '{fullUrl}/update.aspx?id={id}&model={modelClassName}',
        'relateUrl' => '{fullUrl}/relate.aspx',
        'reloadUrl' => '',

        'expandUrl' => '{fullUrl}/expand.aspx',
        'detailUrl' => '{fullUrl}/detail.aspx?id={id}',
        'viewUrl' => '{fullUrl}/view.aspx?id={id}',
        'chooseUrl' => '{fullUrl}/choose.aspx',

        'tabularUrl' => '{fullUrl}/tabular.aspx',
        'deleteUrl' => '/api/core/dyna/delete.aspx?modelClassName={modelClassName}&id={id}',
        'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}',
        'restoreAllUrl' => '/api/core/dyna/restore-all.aspx?modelClassName={modelClassName}',
        'systemUrl' => '{fullUrl}/system.aspx',
        'delDynaUrl' => '{fullUrl}/delete.aspx',
        'homeDynaUrl' => '{fullUrl}/index.aspx',

        'cloneUrl' => '/api/core/dyna/clone.aspx?modelClassName={modelClassName}&id={id}',
        'cloneAllUrl' => '/api/core/dyna/clone-all.aspx?modelClassName={modelClassName}',
        //'exportUrl' => '/web/dyna/excel.aspx?modelClassName={modelClassName}&query={query}',
        'exportUrl' => '/api/core/files/excel',

        'summary' => false,
        'pagerAjax' => false,

        'pjax' => true,

        'storage' => 'db',

        'theme' => self::theme['panel-primary'],
        'beforePjax' => '',
        'afterPjax' => '',
        'beforeHeaderContent' => '',
        'afterHeaderContent' => '',
        'beforeFooterContent' => '',
        'afterFooterContent' => '',

        'headerIcon' => 'fal fa-chart-pie',

        'panelFooter' => '',
        'panelBefore' => '',
        'panelAfter' => false,


        /**
         * Ko'rish kerak alohida, toolbar dizayn buzilib ketdi o'chirsam
         */
        'btnSize' => ZButtonWidget::btnSize['btn-mini'],
        'btnPaddingLeft' => ZButtonWidget::btnScale['default'],
        'btnPaddingRight' => ZButtonWidget::btnScale['default'],
        'btnPaddingTop' => ZButtonWidget::btnScale['default'],
        'btnPaddingBottom' => ZButtonWidget::btnScale['default'],
        'btnIconSize' => ZButtonWidget::btnScale['default'],
        'btnFontSize' => ZButtonWidget::btnScale['default'],
        'btnHeight' => ZButtonWidget::btnScale['default'],
        'btnIconPadding' => ZButtonWidget::btnScale['default'],

        'tableOptions' => [],
        'footerRowOptions' => [],
        'captionOptions' => [
            'class' => 'kv-table-caption',
        ],
        'footerOptions' => [],
        'headerRowOptions' => [],
        'bordered' => false,
        'striped' => true,
        'border-none' => 'none',
        'width' => '800px',
        'action-width' => '',
        'hasWidth' => true,

        'heighbody' => '70vh',

        'filter' => true,

        'pagerClass' => null,
        /*    'panelTemplate' => "{panelHeading}{panelBefore}{items}{panelAfter}{panelFooter}",   */
        'panelTemplate' => '{panelBefore}{items}{panelAfter}{panelFooter}',
        'idColumnTitle' => '#',

        'contentOptions' => [],
        'headerOptions' => [],
        'options' => [],

        'topRequireUrl' => null,
        'bottomRequireUrl' => null,

        'pageSummaryTotal' => true,

        'dynaFilter' => false,
        'dynaSort' => false,
        'dynaSettings' => false,
        'isCard' => false,
        'cardOptions' => [],

        'toolbarButtonsClass' => 'text-muted btn-transparent btn',
        'checkAllQuery' => []
    ];

    public $type = self::type['model'];

    public const type = [
        'item' => 'item',
        'form' => 'form',
        'model' => 'model',
        'array' => 'array',
    ];

    public const columns = [
        'checkbox' => 'checkbox',
        'radio' => 'radio',
        'action' => 'action',
        'id' => 'id',
    ];

    public const reload = [
        'true' => true,
        'false' => false,
    ];

    public const theme = [
        'default' => 'default',
        'panel-danger' => 'panel-danger',
        'panel-info' => 'panel-info',
        'panel-warning' => 'panel-warning',
        'panel-default' => 'panel-default',
        'panel-primary' => 'panel-primary',
        'panel-success' => 'panel-success',
    ];
    
    public const iconSize = [
        'fa-xs' => 'fa-xs',
        'fa-lg' => 'fa-lg',
        'fa-2x' => 'fa-2x',
        'fa-3x' => 'fa-3x',
        'fa-4x' => 'fa-4x',
        'fa-5x' => 'fa-5x',
        'fa-6x' => 'fa-6x',
        'fa-7x' => 'fa-7x',
        'fa-8x' => 'fa-8x',
        'fa-9x' => 'fa-9x',
        'fa-10x' => 'fa-10x',
    ];
    
    public static $grapes = [
        'enable' => true,
        'icon' => 'fal fa-table',
        'src' => '/render/former/ZDynaWidget/image/icon.png',
        'title' => Azl . 'DynaGrid widget',
        'content' => Azl . 'This widget is for visual edit tables from Database',

    ];
    /** @var ActiveDataProvider $provider */
    public $provider;

    public $columns;
    public $formula;

    public $replace = [];
    public $leftb = [];
    public $_leftb = [
        'update' => [
            'content' => '{update}',
            'options' => [
                'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
            ]
        ],
    ];


    public $rightBtn = [];
    public $_rightBtn = [
        'update' => [
            'content' => '{update}',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'system' => [
            'content' => '{system}{delDyna}',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'add-clone-delete' => [
            'content' => '{choose}{add}{tabular}{clone}{delete}',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'filter-sort-id' => [
            'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'statistics' => [
            'content' => '{statistics}',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'export' => [
            'content' => '{export}{exportAll}{exportExcel}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],


        'toggleData' => [
            'content' => '{all}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],
    ];
    public $leftBtn = [];
    public $_leftBtn = [
        'search' => [
            'content' => '{search}',
            'options' => ['class' => ' p-1 mr-0 {btnSize} {iconSize}']
        ],
        /**/
    ];
    public $event = [];
    public $_event = [
        'eventSortUpdate' => ' console.log("EventSortUpdate"); ',
        'eventSortStart' => ' console.log("EventSortStart"); ',
        'eventSortStop' => ' console.log("EventSortStop"); ',
    ];

    public function init()
    {

        parent::init();

        $this->_config['spaArray'] = ZArrayHelper::merge([
            'create' => true,
            'update' => true,
            'detail' => true
        ], $this->_config['spaArray']);

        $this->_config['spaHeight'] = ZArrayHelper::merge([
            'create' => '700px',
            'update' => '700px',
            'detail' => '700px',
            'view' => '700px',
            'choose' => '700px',
        ], $this->_config['spaHeight']);

        $this->_config['spaWidth'] = ZArrayHelper::merge([
            'create' => '1000px',
            'update' => '1000px',
            'detail' => '900px',
            'view' => '900px',
            'choose' => '900px',
        ], $this->_config['spaWidth']);


        if (empty($this->_config['title']) && $this->model)
            $this->_config['title'] = $this->model->configs->title;

        if (empty($this->_config['spaTitle']))
            $this->_config['spaTitle'] = [
                'create' => Az::l("Создание {$this->_config['title']}"),
                'update' => Az::l("Редактирование {$this->_config['title']}"),
                'detail' => Az::l("Детали {$this->_config['title']}"),
                'view' => Az::l("Просмотр {$this->_config['title']}"),
                'choose' => Az::l("Подобрать {$this->_config['title']}"),
            ];


    }

    #region ASSETS

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/onscan.js@1.5.2/onscan.js');
        if (!$this->_config['border']) {
            $this->fileCss('/render/former/ZDynaWidget/assets/no_border.css');
        }

        $this->fileCss('/render/former/ZDynaWidget/assets/islom.css');
        $this->fileCss('/render/former/ZDynaWidget/assets/main.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.css');

        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js');

        if ($this->_config['copy'] === true) {
            $this->fileJs('https://cdn.jsdelivr.net/npm/copy-to-clipboard@3.3.1/example/index.js');
        }
        
    }

    #endregion

    public function codes()
    {
           
        $this->paramSet('model', $this->model);

        /* @var Models $sample */
        $sample = $this->model;

        //   echo ZResponsiveTableWidget::widget();

        if (!empty($this->model->configs->dynaButtons))
            $this->_rightBtn = $this->model->configs->dynaButtons;

        if (!empty($this->model->configs->showDeleted))
            $this->_rightBtn['add-clone-delete'] = [
                'content' => '{restore}{delete}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ];


        if ($this->model->configs->spa === false)
            $this->_config['spa'] = false;

        $expandUrl = strtr($this->_config['expandUrl'], [
            '{fullUrl}' => $this->prelastUrl(),
        ]);
        
        $isTrash = ZVarDumper::jscode($this->model->configs->showDeleted ?? false);
        
        $this->_layout = [
        
            'formula' => function () {
                return ZArrayHelper::merge([
                    'class' => ZFormulaColumn::class
                ], ZFormulaColumn::run($this->model, $this->formula));
            },
            'serial' => function () {

                return [
                    'class' => SerialColumn::class,
                    'headerOptions' => [
                        'class' => 'numeratsiya dynaActions'
                    ],
                    'header' => $this->_config['idColumnTitle']
                ];
            },
            'sort' => function () {
                if (ZArrayHelper::keyExists('sort', $this->model->columns))
                    return [
                        'class' => ZSortableColumn::class,
                    ];
                return [];
            },
            'action' => function () {
                
                return [
                    'class' => ZKDataColumn::class,
                    'header' => Az::l('Действия'),
                    'headerOptions' => [
                        'class' => 'width-deystviya dynaActions'
                    ],
                    'mergeHeader' => true,
                    'contentOptions' => [
                        'class' => 'width-deystviya dynaActions'
                    ],
                    'label' => 'action',
                    'value' => function ($model, $keys, $index, DataColumn $dataColumn) {
                        
                        $key = ZArrayHelper::getValue($model, 'id');

                        $strtrUrl = [
                            '{modelClassName}' => $this->modelClassName,
                            '{fullUrl}' => $this->prelastUrl(),
                            '{id}' => $key,
                        ];

                        $viewUrl = strtr($this->_config['viewUrl'], $strtrUrl);
                        $updateUrl = strtr($this->_config['updateUrl'], $strtrUrl);
                        $detailUrl = strtr($this->_config['detailUrl'], $strtrUrl);

                        $cloneUrl = strtr($this->_config['cloneUrl'], $strtrUrl);
                        $deleteUrl = strtr($this->_config['deleteUrl'], $strtrUrl);

                        $buttons = [
                            'view' => strtr($this->_layout['actionModal'], [
                                '{title}' => Az::l('Просмотр'),
                                '{class}' => 'dynagrid-action-buttons',
                                '{data-url}' => "{$viewUrl}&spa=1",
                                '{id}' => 'view-' . $key,
                                '{data-title}' => ZArrayHelper::getValue($this->_config['spaTitle'], 'view'),
                                '{src}' => '/render/former/ZDynaWidget/assets/img/view.svg',
                            ]),
                            'update' => strtr($this->_layout['actionModal'], [
                                '{title}' => Az::l('Изменить'),
                                '{class}' => 'dynagrid-update-buttons',
                                '{data-url}' => "{$updateUrl}&spa=1",
                                '{data-iframe}' => 'jsPanel-update-iframe',
                                '{id}' => 'update-' . $key,
                                '{data-title}' => ZArrayHelper::getValue($this->_config['spaTitle'], 'update'),
                                '{src}' => '/render/former/ZDynaWidget/assets/img/edit.svg',
                            ]),
                            'clone' => strtr($this->_layout['actionConfirm'], [
                                '{title}' => Az::l('Клонировать'),
                                '{class}' => 'dyna-confirm-button',
                                '{data-url}' => $cloneUrl,
                                '{data-type}' => 'clone',
                                '{src}' => '/render/former/ZDynaWidget/assets/img/clone.svg',
                            ]),
                            'delete' => strtr($this->_layout['actionConfirm'], [
                                '{title}' => Az::l('Удалить'),
                                '{class}' => 'dyna-confirm-button',
                                '{data-url}' => $deleteUrl,
                                '{data-type}' => 'delete',
                                '{src}' => '/render/former/ZDynaWidget/assets/img/delete.svg',
                            ]),
                            'detail' => strtr($this->_layout['actionModal'], [
                                '{title}' => Az::l('Детали'),
                                '{class}' => 'dynagrid-action-buttons',
                                '{id}' => 'detail-' . $key,
                                '{data-url}' => "{$detailUrl}&spa=1",
                                '{data-title}' => ZArrayHelper::getValue($this->_config['spaTitle'], 'detail'),
                                '{src}' => '/render/former/ZDynaWidget/assets/img/info.svg',
                            ]),
                        ];

                        if (empty($this->_config['actionButtons']))
                            $this->_config['actionButtons'] = [
                                'update',
                                'view',
                                'clone',
                                'delete',
                                'detail'
                            ];

                        $return = '';
                        foreach ($this->_config['actionButtons'] as $actionButton) {
                            $return .= ZArrayHelper::getValue($buttons, $actionButton);
                        }

                        return $return;

                    }

                ];

            },
            'checkbox' => function () {
                return [
                    'class' => ZCheckColumn::class,
                    'headerOptions' => [
                        'class' => 'align-middle'
                    ],
                    'modelClassName' => $this->modelClassName,
                    'twoCheckBox' => $this->_config['twoCheck'],
                    'checkboxOptions' => [
                        'class' => 'kv-row-checkbox checkbox-' . $this->modelClassName
                    ],
                    'rowSelectedClass' => $this->_config['checkSelectedClass']
                ];
            },
            'radio' => function () {
                return [
                    'class' => ZRadioColumn::class,
                    'headerOptions' => [
                        'class' => 'numeratsiya'
                    ],
                    'value' => $this->_config['radio'],
                    'modelClassName' => $this->modelClassName
                ];
            },
            'expand' => static function () use ($expandUrl) {

                return [
                
                    'class' => ZExpandRowColumn::class,
                    'headerOptions' => [
                        'class' => 'numeratsiya'
                    ],
                    'value' => function ($model, $key, $index) use ($expandUrl) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detailUrl' => $expandUrl

                ];
            },
            
            'orderItems' => function () {

                return [
                    'class' => ZKDataColumn::class,
                    'label' => Az::l('Просмотр товаров заказа'),

                    'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                        $name = ZArrayHelper::getValue($model, 'name');

                        return ZIframeSpaWidget::widget([
                            'id' => $model->className,
                            'model' => $model,
                            'config' => [
                                'url' => '/seller/shop-order-item/index.aspx',
                                'key' => $key,
                                'width' => '100%',
                                'type' => ZIframeSpaWidget::type['other'],
                                'title' => Az::l("Товары заказа $name"),
                                'icon' => 'fal fa-lg fa-' . FA::_EYE
                            ],
                        ]);
                    }
                ];
            },

            'relation' => function () {

                $b1 = !empty($this->modelConfigs->hasMany);
                $b2 = !empty($this->modelConfigs->hasOne);
                $b3 = !empty($this->modelConfigs->hasMulti);

                if ($b1 || $b2 || $b3) {
                    return [
                        'class' => ZKDataColumn::class,
                        'label' => Az::l('Связи'),
                        'headerOptions' => [
                            'class' => 'numeratsiya'
                        ],
                        'value' => function ($model, $keys, $index, DataColumn $dataColumn) {

                            $key = ZArrayHelper::getValue($model, 'id');

                            $url = strtr($this->_config['relateUrl'], [
                                '{fullUrl}' => $this->prelastUrl(),
                            ]);

                            return strtr($this->_layout['actionModal'], [
                                '{title}' => Az::l("Связи c $this->modelClassName"),
                                '{class}' => 'dynagrid-action-buttons',
                                '{id}' => 'relation-' . $key,
                                '{data-url}' => "{$url}?id=$key&spa=1",
                                '{data-title}' => Az::l("Связи c $this->modelClassName"),
                                '{src}' => '/render/former/ZDynaWidget/assets/img/link.svg',
                            ]);
                        }
                    ];

                }

                return [];
            },
            'btnDetail' => function ($model, $url) {

                return ZButtonWidget::widget([
                    'config' => [
                        'url' => $url,
                        'btnSize' => ZColor::btnSize['default'],
                        'title' => Az::l('Show Details'),
                        'hasIcon' => true,
                        'class' => 'ZDynaBTN p-1',
                        'icon' => 'fal text-muted fa-lg fa-' . FA::_INFO_CIRCLE,
                        'btn' => false,
                        'hasConfirm' => false,
                        'btnRounded' => false,
                    ],

                ]);
            },
            'btnEdit' => function ($model, $url) {

                return ZButtonWidget::widget([
                    'id' => 'update_button_' . $this->modelClassName . '_' . ZArrayHelper::getValue($model, 'id'),
                    'config' => [
                        'url' => $url,
                        'btnSize' => ZColor::btnSize['default'],
                        'class' => 'ZDynaBTN p-1 ',
                        'title' => Az::l('Изменить'),
                        'btnRounded' => false,
                        'btn' => false,
                        'confirm' => 'Are you sure you want DELETE columns?',
                        'src' => '/render/former/ZDynaWidget/assets/img/edit.svg',
                        'img' => true,
                        'hasIcon' => false,
                        'icon' => ''
                    ],
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
                        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                        'btnSize' => ZButtonWidget::btnSize['default'],
                        'btnRounded' => false,
                        'btnFloating' => false,

                        /*'title' => 'Export',*/
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                        'class' => $this->_config['toolbarButtonsClass'],
                        'hasIcon' => true,
                        'icon' => 'fal fa-file-excel-o text-muted',
                        'title' => 'Экспорт все'
                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault(); window.open(this.href, "_blank")}',
                    ]
                ]);

            },

            'sortable' => <<<JS

      function saveNewPositions(url) {
      
          var positions = [];
          $('.updated').each(function () {
              positions.push([$(this).attr('data-key'), $(this).attr('data-order')]);
              $(this).removeClass('updated');
          });
          
          var activeItem = $(document).find('.page-item.active');
          var pageText = $(activeItem).find('.page-link').text();
          
          $.ajax({
              url: '{url}',
              method: 'POST',
              dataType: 'text',
              data: {
                  update: 1,
                  page: pageText,
                  pageSize: 7,
                  positions: positions
              }, 
              success: function (response) {
                  
              }
          });
    
      }

      function zSortable() {
      
          $('table tbody').sortable({
          
            update: function (event, ui) {
                    
                $(this).children().each(function (index, row) {
                
                    if ($(this).attr('data-order') != (index + 1)) {
                        $(this).attr('data-order', (index + 1)).addClass('updated') 
                    }
                
                })
                
                saveNewPositions()
                
            }
            
          });
                  
      }
      
      {sortablePjax}
      
JS,
            'sortablePjax' => <<<JS
       zSortable();
       $(document).on('pjax:end', function () {
         zSortable();
       });
JS,

            #region CSS LAYOUT

            'css' => <<<CSS
        
        .overflow-no {
            overflow: hidden!important;
        }    
        
        .readonly {
            cursor:pointer;
            color:#000000!important; 
        }
        
        .point-raw {
            width:auto;
            color: #544d9d;
            cursor:pointer;
        }
        
        .numeratsiya{
           width: 3%!important;
            white-space: nowrap;
        }
            
        .dynaActions {
            white-space: nowrap;
        }
        
        .width-deystviya{
            width: {action-width}!important;
        }

        .content-footer{
            line-height: 16px!important;
        }
        
        .tbody {
            height: {heighbody}!important;
            padding-right: 3px!important;
            padding-left: 3px!important;
            padding-bottom: 13px!important;
            overflow-x: hidden!important;
        }
  
        .grid-view .card{
            border: {border-none} !important;
        }
        
        .tscroll{
            height: 0.1rem;
        }
         
         {column}
CSS,
            'column' => <<<CSS
        
         .editable-dyna-{attribute} {
            width: {td-width}!important;
         }
         
         .pjaxnum{
            padding: 20px!important;
         }
         
         .editable-dyna-id{
             width: 70px!important;
         }

CSS,

            #endregion
            
            'js' => <<<JS

    $('.select-on-check-all').on('change', function(event) {
        
        event.preventDefault()
      
    })

    $(document).on('click', '.dyna-confirm-button', function() {
      
        var url = $(this).data('url')
        var type = $(this).data('type')
        var confirm = {confirmObj}
        if (type === 'delete')
            confirm = {cancelObj}
      
        bootbox.confirm({
           title: confirm.title,
           message: confirm.message,
           buttons: {
               confirm: {
                   label: confirm.confirm
               },
               cancel: {
                   label: confirm.cancel
               },
               
           },
           callback: function (result) {
                                if (result === true) {
                   $.ajax({
                       url: url,
                       success: function() {
                           $('#{modelClassName}_Grid_Reset').click()
                       }
                   });
               }
           }   
       });
      
    })

    $(document).on('click', '.dyna-editable', function () {
        
        if ($(this).hasClass('readonly'))
            return;     
        
        window.dynaEditable()
        
        var options = $(this).attr('options')
        
        var widgetOptions = $(this).attr('widget-options')
        
        options = JSON.parse(options)

        //$('.swal2-content').loader('show')
        $('#swal2-title').html(options.title)
    
        var iframe = $('#ravshanDyna')
        
        $('#editable-key-{modelClassName}').val(options.key)
        $('#editable-index-{modelClassName}').val(options.index)
        $('#editable-attribute-{modelClassName}').val(options.attribute)
        $('#editable-options-{modelClassName}').val(widgetOptions)
        $('#editable-widgetClass-{modelClassName}').val(options.widgetClass)
        
        $('#editable-form-{modelClassName}').submit()
        
        iframe.attr('width', options.width)
        iframe.attr('height', options.height)
    
        iframe.on('load', function() {
            $('.swal2-content').loader('hide')
        })
        
        $('.jsPanel-btn-close').on('click', function() {
           iframe.attr('src', '') 
        })
        
    });
    
    $(document).on('click', '.dynagrid-action-buttons', function() {
      
        var url = $(this).data('url')
        var title = $(this).data('title')
        var iframeId = $(this).data('iframe')
       
        window.dynaPanel()
       
        var iframe = $('#jsPanel-dyna-iframe')
        $(iframe).attr('src', url)
        $('#jsPanel-dyna').find('.jsPanel-title').text(title)
        
    })

    $(document).on('click', '.dynagrid-update-buttons', function() {
      
        var url = $(this).data('url')
        var iframeId = $(this).data('iframe')
       
        window.dynaUpdatePanel()
       
        var iframe = $('#' + iframeId)
        $(iframe).attr('src', url)
        
    })

    window.closeModal = function() {
        $('#ravshan-modal').modal('hide');
    };
        
    window.closeSweet = function() {
        swal.close();
    };
    
    function checkingCol() {
     
        let trs = $('.tr-dynawidget')
        let values = $('#{input-id}').val()
        let filterCode = $('#shoporder-code')
        
        trs.each(function(key, value) {                
            
           let code = $(value).find('[data-code]').attr('data-code')
             
           if (values === code) {
              filterCode.val(values)
              filterCode.trigger('change')
              $('#{input-id}').val('');
              $(value).click();
              
           }
           
        }) 
          
    }
    
    function checkedTr() {
       
        $('.tr-dynawidget').on('click', function(event) {
          
            const excludesClass = [
                'point-raw',
                'kv-editable-link',
                'kv-editable-value',
                'checkBox-label',
                'checkBox-dynawidget',
                'modal',
                'ZDynaBTN',
                'dyna-editable',
                'btn',
            ];
          
            for(const value in excludesClass) {
                
                var item = excludesClass[value]
                if ($(event.target).hasClass(item) || $(event.target).closest('.' + item).length > 0)
                    return;
            }
            
            var checkBox = $(this).find('.kv-row-checkbox')
            var radio = $(this).find('.kv-row-radio')
            
            if (!checkBox.is(':checked'))
                checkBox.prop('checked', true)
            else
                checkBox.prop('checked', false)
                
            checkBox.trigger('change') 
               
            radio.prop('checked', true)
            radio.trigger('change')
                                        
        })
        
        {checkBoxAjax}
        
    }
    
    checkedTr();
    
    function func() {
        let hig = $('.tr-dynawidget').height() * {counttr} + 150
        $('tbody').addClass('tbody').css('height', hig+'px') 
    } 
    
    func() 
    
    $(document).on('pjax:end', function () {
    
        checkedTr()
        func()
        
        if ($('.empty')) {
            $('th td').addClass('pjaxnum').css('white-space', 'nowrap');
        }
        
    });
    
    $('.kv-all-select').css('width', '2' + '!important');
    if (!$('body').hasClass("card-header") && {card}) {
       $('.grid-view').addClass('shadow') 
    }
    
    $( document ).ready(function() {
        if (window.screen.width <= 800)
            $('body').removeClass('mm-wrapper_sidebar-collapsed');
        else
            $('body').addClass('mm-wrapper_sidebar-collapsed');
    });
    
JS,

            'checkBoxAjax' => <<<JS

        $('.checkbox-{modelClassName}').on('change', function() {
            
            var value = $(this).attr('value')
            var url = '/api/core/dyna/checkDel.aspx'
            if (this.checked)
                url = '/api/core/dyna/checkSet.aspx' 
            
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    modelId: value,
                    url: '{checkUrl}',
                    modelClassName: '{modelClassName}'
                },
                success: function(response) {
                   console.log(response)
                }
                
            })
            
        })
        
JS,

            'copy' => <<<JS

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
    
JS,
            'barcode' => <<<JS
    
    /*function checkingCol() {
          let trs = $('.tr-dynawidget')
          let values = $('#{input-id}').val()
          let filterCode = $('#shoporder-code')
          
          trs.each(function(key, value) {                
              
             let code = $(value).find('[data-code]').attr('data-code')
               
             if (values === code) {
                filterCode.val(values)
                filterCode.trigger('change')
                $('#{input-id}').val('');
                $(value).click();
                filterCode.val('')
             }
             
          }) 
    }
    
    $('#{input-id}').on('change', function() {
    
          let trs = $('.tr-dynawidget')
          let values = $('#{input-id}').val()
          let filterCode = $('#shoporder-code')
          
          trs.each(function(key, value) {                
              
             let code = $(value).find('[data-code]').attr('data-code')
               
             if (values === code) {
                filterCode.val(values)
                filterCode.trigger('change')
                $('#{input-id}').val('');
                $(value).click();
                
             }
             
          })
    })
    
    function scanning() {
        onScan.attachTo(document, {
            suffixKeyCodes: [13],
            reactToPaste: false, 
                onScan: function(sCode, iQty) {
                    $('#{input-id}').focus().val(sCode);
                    checkingCol()  
                }, 
         })
    }*/
    
    
    
    
    
    /*$(document).on('scan', function() {
       console.log('scand')
        onScan.detachFrom(document)
        scanning()
    })*/
   
  
   /* $(document).on('pjax:end', function() {
    
        onScan.detachFrom(document);
        $('#{input-id}').focus();
        onScan.attachTo(document, {
            suffixKeyCodes: [13],
            reactToPaste: true, 
            onScan: function(sCode, iQty) {
                $('#{input-id}').focus().val(sCode);
                checkingCol()  
            }, 
        })  
    })*/
JS,


            'actionModal' => <<<HTML
    <a data-url="{data-url}" data-iframe="{data-iframe}" data-title="{data-title}" id="{id}" data-toggle="tooltip" data-pjax="1" class="btn-lg ovr-button btn-transparent hint--top hint--default hint--medium hint--bounce hint--rounded p-0 ZDynaBTN {class}" aria-label="{title}" aria-hidden="true">
        <img src="{src}" alt="{alt}" width="42px" height="42px">
    </a>
HTML,

            'actionConfirm' => <<<HTML
    <a data-url="{data-url}" data-title="{title}" data-type="{data-type}" id="update-1856" data-toggle="tooltip" data-pjax="1" class="btn-lg ovr-button btn-transparent hint--top hint--default hint--medium hint--bounce hint--rounded p-0 ZDynaBTN {class}" aria-label="{title}" aria-hidden="true">
        <img src="{src}" alt="{alt}" width="42px" height="42px">
    </a>
HTML,



            'formEditable' => <<<HTML

HTML,


            'cancelClickAuto' => <<<JS
        function(jsPanel) {

            if (jsPanel.isClosed === true) {
                return true
            }
          
            Swal.fire({
              title: '{confirmTitle}',
              icon: 'info',
              showCancelButton: true,
              confirmButtonText: '{confirmBtn}',
              cancelButtonText: '{cancelBtn}',
            }).then((result) => {
              if (result.value) {
                location.reload()
              } else {
              
                var iframe = document.getElementById('jsPanel-update-iframe')
                var url_string = iframe.contentWindow.document.location.href;
                var url = new URL(url_string);
                var id = url.searchParams.get('id');
              
                $.ajax({
                    url: '{cancelUrl}&modelId=' + id,
                    type: 'GET',
                    success: function() {
                        jsPanel.isClosed = true
                        jsPanel.close() 
                    }
                })
                
              }
              
            })
          
        }
JS,


        ];

        $this->visualSettings();

        if ($this->type === null) {
            switch (true) {

                case (!empty($this->model) && empty($this->data)) :
                    $this->type = 'model';
                    break;

                case (!empty($this->model) && !empty($this->data)):
                    $this->type = 'form';
                    break;

                case (empty($this->model) && !empty($this->data)):
                    $this->type = 'item';
                    break;

                default:
                    throw new ExpressionErrorException('Ваши данные неверны.');
                    break;
            }
        }

        /**
         *
         * Set Provider
         */

        if ($this->provider === null) {
            $this->model->search = true;
            $this->provider = $this->model->search($this->data, true);
            $this->modelColumnGen();
        }

        $before = '';
        $config = $this->_config;

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
            'userSpecific' => false,
            'dbUpdateNameOnly' => false,
            'enableMultiSort' => true,
            'showFilter' => $this->_config['dynaFilter'],
            'showSort' => $this->_config['dynaSort'],
            'showPersonalize' => $this->_config['dynaSettings'],
            'allowPageSetting' => false,
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
                'showHeader' => false,
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
                     *  placeholder: '<tr><td colspan="7"> </td></tr>',
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
            /*'columns' => [
                        'selectable' => true,
                ],*/
            'gridOptions' => [
                'pager' => null,
                'pjax' => $this->_config['pjax'],
                'toolbar' => [],

                'dataProvider' => null,
                'filterModel' => null,
                'striped' => $this->_config['striped'],
                'condensed' => true,
                'responsive' => false,
                'responsiveWrap' => false,
                'hover' => true,
                'containerOptions' => [
                    'class' => 'tbody'
                ],
                'perfectScrollbar' => true,
                'perfectScrollbarOptions' => [],
                'tableOptions' => $this->_config['tableOptions'],
                'footerRowOptions' => $this->_config['footerRowOptions'],
                'captionOptions' => $this->_config['captionOptions'],
                'headerRowOptions' => $this->_config['headerRowOptions'],
                'rowOptions' => static function ($model, $key, $index, $grid) use ($config) {
                    return [
                        'class' => 'tr-dynawidget',
                        'data-order' => $index + 1,
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
                'resizableColumns' => false,
                'persistResize' => false,
                'hideResizeMobile' => true,
                'resizableColumnsOptions' => [],
                'resizeStorageKey' => App,
                'floatHeader' => $this->_config['floatHeader'],
                'floatOverflowContainer' => false,
                'floatHeaderOptions' => [
                    'scrollingTop' => '0',
                    'position' => 'absolute',
                ],
                'showPageSummary' => $this->_config['summary'],
                'pageSummaryRowOptions' => ['class' => 'kv-page-summary warning'],

                /*'layout' => '{summary}',
                'summary' => "{begin} - {end} {count} {totalCount} {page} {pageCount}",*/
                'panelTemplate' => $this->_config['panelTemplate'],
                'panelHeadingTemplate' => null,
                'panelBeforeTemplate' => "{toolbarContainer} {before}<div class='clearfix {btnSize}'></div>",
                'panelAfterTemplate' => '{after}',
                'panelFooterTemplate' => "<div class='kv-panel-pager'>{pager}</div>{footer}<div class='clearfix'></div>",

                'replaceTags' => [
                    '{custom}' => function ($widget) {
                        if ($widget->panel === false) {
                            return '';
                        }

                        return '';
                    }
                ],
                'bordered' => $this->_config['bordered'],

            ],
            'options' => [
                'id' => $this->modelClassName . '-' . $this->userIdentity()->id
            ],

        ];
        
        $this->actionButtons();

        $query = null;
        if (isset($this->model->configs->query))
            $query = serialize($this->model->configs->query->where);

        #region ToolbarButtons

        $toolbarClasses = $this->_config['toolbarButtonsClass'];
/*
        $exportAll = ZExportBtnWidget::widget([
            'id' => $this->modelClassName . '-exportAll',

            'config' => [
                'grapes' => false,
                'hidden' => true,
                'configs' => $this->model->configs,
                'action' => '/api/core/files/export/',
                'class' => $toolbarClasses,
                'modelClassName' => $this->modelClassName,
            ]
        ]);*/

        $exportExcel = $this->_layout['expotExcel']($query);

        $reloadUrl = $this->_config['reloadUrl'];
        if (empty($this->_config['reloadUrl']))
            $reloadUrl = $this->urlArrayStr;

        $update = ZButtonWidget::widget([
            'id' => "{$this->modelClassName}_Grid_Reset",
            'config' => [
                'url' => $this->urlTo([
                    $reloadUrl
                ], true),
                'btnType' => ZButtonWidget::btnType['link'],
                //'src' => '/webhtm/shop/agent/manual/edit.png',
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnSize' => ZColor::btnSize['default'],
                'btnRounded' => false,
                'title' => 'Перезагрузить',
                'toggle' => ZButtonWidget::toggle['tooltip'],

                'hasIcon' => false,
                'icon' => 'fal fa-redo',
                'class' => "btn-round update-dynagrid  {$toolbarClasses}",
                'data-pjax' => 1,
            ],
        ]);

        $strtrUrl = [
            '{actionId}' => $this->actionId,
            '{fullUrl}' => $this->prelastUrl(),
        ];
        $createUrl = strtr($this->_config['createUrl'], $strtrUrl);

        $url = $this->urlArray;
        $getAll = $this->httpGet('all');
        $getAll = $getAll ? 0 : 1;
        $text = Az::l('Страницы');
        $allIcon = 'fas fa-compress';
        $title = Az::l('Показать страницы');

        if ($getAll) {
            $text = Az::l('Все');
            $allIcon = 'fas fa-expand';
            $title = Az::l('Показать все страницы');
        }

        $url['all'] = $getAll;
        $url[0] = $this->urlArrayStr;

        $allUrl = $this->urlTo($url, false);
        $all = ZButtonWidget::widget([
            'config' => [
                'text' => $text,
                'url' => $allUrl,
                'isPjax' => false,
                'btnType' => ZButtonWidget::btnType['link'],
                'btnSize' => ZColor::btnSize['default'],
                'btnRounded' => false,
                'btnFloating' => false,
                'title' => $title,
                'toggle' => ZButtonWidget::toggle['tooltip'],
                'hasIcon' => true,
                'icon' => $allIcon,
                'class' => "{$toolbarClasses}",

            ],
            'event' => [
                'click' => <<<JS
function(){
    window.location.replace('{$this->urlGetBase()}{$allUrl}')   
}
JS,

            ]
        ]);

        $add = ZButtonWidget::widget([
            'config' => [
                'url' => $createUrl,
                'btnType' => ZButtonWidget::btnType['link'],
                'btnSize' => ZColor::btnSize['default'],
                'btnRounded' => false,
                'btnFloating' => false,
                'title' => Az::l('Добавить'),
                'toggle' => ZButtonWidget::toggle['tooltip'],
                'hasIcon' => true,
                'icon' => 'fal fa-plus',
                'class' => "{$toolbarClasses}",

            ],
        ]);

        if (ZArrayHelper::getValue($this->_config['spaArray'], 'create')) {
            $add = ZIframePanelWidget::widget([
                'id' => $this->modelClassName,
                'model' => $this->model,
                'config' => [
                    'btnOptions' => [
                        'config' => [
                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnSize' => ZColor::btnSize['default'],
                            'btnRounded' => false,
                            'btnFloating' => false,

                            'title' => Az::l('Добавить'),
                            'toggle' => ZButtonWidget::toggle['tooltip'],
                            'hasIcon' => true,
                            'icon' => 'fas fa-plus',
                            'ic-push-url' => true,
                        ],
                    ],
                    'url' => $createUrl,
                    'height' => ZArrayHelper::getValue($this->_config['spaHeight'], 'create'),
                    'width' => ZArrayHelper::getValue($this->_config['spaWidth'], 'create'),
                    'title' => ZArrayHelper::getValue($this->_config['spaTitle'], 'create'),
                    'funcName' => 'dynaCreate',
                    'changeSave' => $this->model->configs->changeSave,
                    'type' => ZIframeSpaWidget::type['create'],
                    'formId' => $this->modelClassName,
                ]
            ]);
        }

        $chooseUrl = strtr($this->_config['chooseUrl'], $strtrUrl);

        $choose = '';
        if (!empty($this->model->configs->query)) {
            $choose = ZIframeSpaWidget::widget([
                'id' => $this->modelClassName,
                'model' => $this->model,
                'config' => [
                    'url' => $chooseUrl,
                    'type' => ZIframeSpaWidget::type['choose'],
                    'width' => ZArrayHelper::getValue($this->_config['spaWidth'], 'choose'),
                    'height' => ZArrayHelper::getValue($this->_config['spaHeight'], 'choose'),
                    'getParams' => $this->_config['chooseParams'],
                    'parentQuery' => $this->model->configs->query,
                    'chooseQuery' => $this->_config['chooseQuery'],
                    'title' => ZArrayHelper::getValue($this->_config['spaTitle'], 'choose'),
                    'icon' => $this->_config['headerIcon'],
                    'btnClass' => $toolbarClasses,
                ]
            ]);
        }

        $cloneUrl = strtr($this->_config['cloneAllUrl'], [
            '{modelClassName}' => $this->modelClassName
        ]);

        $deleteUrl = strtr($this->_config['deleteAllUrl'], [
            '{modelClassName}' => $this->modelClassName
        ]);

        $restoreUrl = strtr($this->_config['restoreAllUrl'], [
            '{modelClassName}' => $this->modelClassName
        ]);

        $delUrl = strtr($this->_config['delDynaUrl'], [
            '{modelClassName}' => $this->modelClassName,
            '{fullUrl}' => $this->prelastUrl(),
        ]);

        $homeUrl = strtr($this->_config['homeDynaUrl'], [
            '{modelClassName}' => $this->modelClassName,
            '{fullUrl}' => $this->prelastUrl(),
        ]);

        $systemUrl = strtr($this->_config['systemUrl'], [
            '{modelClassName}' => $this->modelClassName,
            '{fullUrl}' => $this->prelastUrl(),
        ]);

        $search = '';
        if ($this->_config['search'])
            $search = ZDynaSearchWidget::widget([

                'config' => [
                    'grapes' => false,
                    'dyna' => true,
                ]
            ]);

        $clone = '';
        if ($this->model->configs->clonable)
            $clone = ZGetChecksWidget::widget([
                'model' => $this->model,

                'config' => [
                    'btnOptions' => [
                        'config' => [

                            'hasIcon' => true,
                            'grapes' => false,
                            'icon' => 'fal text-muted fa-clone fa-lg',
                            'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                            'btnType' => ZButtonWidget::btnType['button'],
                            'title' => 'Клонировать',
                            'class' => "checkbox-{$this->modelClassName} {$toolbarClasses}",
                            'message' => Az::l('Вы хотите клонировать этот элемент(ы)?'),
                        ]
                    ],
                    'url' => $cloneUrl,
                    'modelClassName' => $this->modelClassName
                ]
            ]);

        $delete = ZGetChecksWidget::widget([
            'model' => $this->model,

            'config' => [
                'btnOptions' => [
                    'config' => [

                        'class' => "pb-4 rounded-0 checkbox-{$this->modelClassName} {$toolbarClasses}",
                        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                        'btnRounded' => false,
                        'confirm' => true,
                        'icon' => 'fal fa-trash',
                        'message' => Az::l('Вы хотите удалить этот элемент(ы)?'),
                    ]
                ],
                'comment' => $this->model->isAddColumn('Del') && !$this->model->configs->showDeleted,
                'title' => 'удалить',
                'grapes' => false,
                'url' => $deleteUrl,
                'modelClassName' => $this->modelClassName,
                'value' => $this->model->configs->showDeleted,
            ]
        ]);

        $system = ZButtonWidget::widget([
            'model' => $this->model,

            'config' => [
                'hasIcon' => true,
                'pjax' => 0,
                'title' => 'история',
                'grapes' => false,
                'url' => $systemUrl,
                'class' => 'pb-4 rounded-0',
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnRounded' => false,
                'icon' => 'fal text-muted fa-history fa-lg',
            ]
        ]);

        if ($this->model->configs->showSystemColumn) {
            $system = ZButtonWidget::widget([
                'model' => $this->model,

                'config' => [
                    'pjax' => 0,
                    'hasIcon' => true,
                    'title' => 'Домой',
                    'grapes' => false,
                    'url' => $homeUrl,
                    'class' => "pb-4 rounded-0",
                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                    'btnRounded' => false,
                    'icon' => 'fal text-muted fa-home fa-lg mr-0',
                    'confirm' => true,
                    'modelClassName' => $this->modelClassName
                ]
            ]);
        }

        $delDyna = '';
        if ($this->model->isAddColumn('Del')) {
            $delDyna = ZButtonWidget::widget([
                'model' => $this->model,

                'config' => [
                    'hasIcon' => true,
                    'title' => 'удалённые записи',
                    'grapes' => false,
                    'pjax' => 0,
                    'url' => $delUrl,
                    'class' => "pb-4 rounded-0",
                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                    'btnRounded' => false,
                    'icon' => 'fal text-muted fa-calendar-times-o  fa-lg',
                    'confirm' => true,
                    'modelClassName' => $this->modelClassName
                ]
            ]);

            if ($this->model->configs->showDeleted) {
                $delDyna = ZButtonWidget::widget([
                    'model' => $this->model,

                    'config' => [
                        'hasIcon' => true,
                        'pjax' => 0,
                        'title' => Az::l('Домой'),
                        'grapes' => false,
                        'url' => $homeUrl,
                        'class' => "pb-4 rounded-0",
                        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                        'btnRounded' => false,
                        'icon' => 'fal text-muted fa-home fa-lg mr-0',
                        'confirm' => true,
                        'modelClassName' => $this->modelClassName
                    ]
                ]);

            }

        }

        $restore = ZGetChecksWidget::widget([
            'model' => $this->model,

            'config' => [
                'hasIcon' => true,
                'title' => 'восстановить',
                'grapes' => false,
                'url' => $restoreUrl,
                'class' => "pb-4 rounded-0 checkbox-{$this->modelClassName} {$toolbarClasses}",
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnRounded' => false,
                'icon' => 'text-muted fal fa-trash-undo-alt fa-lg',
                'confirm' => true,
                'message' => Az::l('Вы хотите восстановить этот элемент(ы)?'),
                'modelClassName' => $this->modelClassName
            ],
        ]);

        #endregion

        #region Pager

        $pagers = [];
        switch (true) {

            case $this->_config['pagerAjax']:
                $pagers = [
                    'class' => ZScrollPager::class,
                ];
                break;

            case !empty($this->_config['pagerClass']):
                $pagers = $this->_config['pagerClass'];
                break;

            default:
                $pagers = [
                    'class' => ZLinkPager::class,
                ];
                break;

        }

        #endregion

        /**
         *
         * Core Options
         */

        $summary = ($this->_config['titleSummary']) ? '{summary}' : ' ';

        $dynaSettings = '';
        if ($this->type === 'model')
            $dynaSettings = ZSettingBtnWidget::widget([

                'model' => $this->model,
                'columns' => $this->columns,
                'config' => [
                    'theme' => $this->_config['theme'],
                    'grapes' => false,
                    'btnClass' => $this->_config['toolbarButtonsClass'],
                ]
            ]);

        $statistics = '';
        if ($this->type === 'model')
            $statistics = ZButtonWidget::widget([
                'config' => [

                    'hasIcon' => true,

                    'icon' => 'fal fa-chart-pie',
                    //'class' => $theme . ' ' . $this->_config['btnClass'],
                    'btnRounded' => false,
                    'pjax' => 0,
                    'title' => Az::l('Статистика'),
                    'toggle' => ZButtonWidget::toggle['tooltip'],
                    'url' => ZUrl::to([
                        '/core/dynagrid/statistics',
                        'dynaId' => Az::$app->forms->dynas->dynaId($this->modelClassName),
                        'url' => $this->urlArrayStr,
                        'modelName' => $this->modelClassName,
                        //'theme' => $this->_config['theme']
                    ]),

                ],

            ]);
/*
        $barCode = ZBarInputWidget::widget([
            'id' => 'barcode-' . $this->id . $this->className,
            'config' => [
                'placeholder' => 'Штрихкод',
                'class' => 'md-form',
            ]
        ]);*/

        $generateButton = ZButtonWidget::widget([
            'config' => [
                'text' => 'Генерация',
                //'pjax' => 0,
                'btnRounded' => false,
                'btn' => true,
                'hasIcon' => true,
            ],
            'event' => [
                'click' => "function (event) {
                    $.ajax({
                      type: 'POST',
                      url: '',
                      data: {generate: true},
                      success: function(data){
                        if(data === 'true') {
                            alert('Генерация прошла успешно');
                            location.reload();
                        }
                        if(data === 'false') {
                            alert('ошибка при генераций');
                        }
                      }
                    });  
                }"
            ]
        ]);

        if (!$this->_config['hasToolbar'])
            $this->_rightBtn = [];

        $toolbar = [];

        $replace = ZArrayHelper::merge([
            '{search}' => $search,
            '{update}' => $update,
            '{add}' => $add,
            '{all}' => $all,
            '{choose}' => $choose,
            '{tabular}' => null,
            '{clone}' => $clone,
            '{delete}' => $delete,
            '{restore}' => $restore,
            '{system}' => $system,
            '{delDyna}' => $delDyna,
            //'{apply}' => $apply,
            //'{norms}' => $norms,
            '{generate}' => $generateButton,
            '{dynagridSettings}' => $dynaSettings,
            '{statistics}' => $statistics,
            '{dynagridSort}' => '',
            '{filter}' => '',
            '{exportAll}' => '',
            '{exportExcel}' => $exportExcel,
        ], $this->replace);

        $lefts = '<div class="btn-toolbar kv-grid-toolbar toolbar-container float-left">';
        foreach ($this->_leftBtn as $value) {
            if (is_array($value)) {
                $value['content'] = strtr($value['content'], $replace);
                $lefts .= ZHTML::tag('div', $value['content'], $value['options']);
            }
        }
        $lefts .= '</div>';

        $before = $lefts;

        foreach ($this->_rightBtn as $value) {
            if (is_array($value)) {
                $value['content'] = strtr($value['content'], $replace);
                $value['options']['class'] = strtr($value['options']['class'], [
                    '{iconSize}' => $this->_config['iconSize'],
                    '{btnPaddingLeft}' => $this->_config['btnPaddingLeft'],
                    '{btnSize}' => $this->_config['btnSize'],
                    '{btnPaddingRight}' => $this->_config['btnPaddingRight'],
                    '{btnPaddingTop}' => $this->_config['btnPaddingTop'],
                    '{btnPaddingBottom}' => $this->_config['btnPaddingBottom'],
                    '{btnIconSize}' => $this->_config['btnIconSize'],
                    '{btnFontSize}' => $this->_config['btnFontSize'],
                    '{btnHeight}' => $this->_config['btnHeight'],
                    '{btnIconPadding}' => $this->_config['btnIconPadding'],
                ]);
                $toolbar[] = $value;
            }
        }
        
        $this->options = ZArrayHelper::merge($this->options, [
            'columns' => $this->columns,
            'enableMultiSort' => true,
            'gridOptions' => [
                'pager' => $pagers,
                'toolbar' => $toolbar,
                'panel' => [
                    'heading' => "<i class='dynagrid-icon " . $this->_config['headerIcon'] . "'></i>&nbsp;&nbsp;<span class='dynagrid-title'>  " . $this->_config['title'] . '</span>',

                    'headingOptions' => [
                        // 'class' => 'card-header'
                    ],
                    'footer' => $this->_config['panelFooter'],
                    'footerOptions' => $this->_config['footerOptions'],
                    'before' => $before . $this->_config['panelBefore'],
                    'beforeOptions' => [
                        // 'class' => 'kv-panel-before'
                    ],
                    'after' => $this->_config['panelAfter'],
                    'afterOptions' => [
                        // 'class' => 'kv-panel-after'
                    ],
                ],
                'dataProvider' => $this->provider,
                'filterModel' => $this->_config['filter'] ? $this->model : null,

                'layout' => $summary . '\n{items}\n{pager}',
                'panelHeadingTemplate' => "$summary {title}<div class='clearfix'></div>",
                'panelBeforeTemplate' => "{toolbarContainer} {before}<div class='clearfix'></div>",
                'panelFooterTemplate' => "<div class='kv-panel-pager'>{pager}</div>{footer}<div class='clearfix'></div>",
            ],

        ]);

        if (ZArrayHelper::keyExists('sort', $this->model->columns))
            $this->js .= strtr($this->_layout['sortable'], [
                '{url}' => ZUrl::to([
                    '/api/core/sort/sortable',
                    'modelClassName' => $this->modelClassName
                ]),
                '{sortablePjax}' => $this->_layout['sortablePjax'],
            ]);

        $col = '';
        foreach ($this->model->columns as $key => $column) {
            $col .= strtr($this->_layout['column'], [
                '{td-width}' => $this->_config['hasWidth'] ? $column->width : 'auto',
                '{attribute}' => $key,

            ]);
        }

        $this->css = strtr($this->_layout['css'], [
            '{column}' => $col,
            '{heighbody}' => $this->_config['heighbody'],
            '{border-none}' => $this->_config['border-none'],
            '{bodyWidth}' => $this->_config['width'],
            '{action-width}' => $this->_config['action-width'],
        ]);

        $shadow = $this->_config['isCard'];
        if (!$this->_config['isCard']) {
            $shadow = '0';
        }

        $checkBoxAjax = strtr($this->_layout['checkBoxAjax'], [
            '{modelClassName}' => $this->modelClassName,
            '{checkUrl}' => $this->urlArrayStr,

        ]);

        $confirmObj = [
            'title' => Az::l('Подтверждение'),
            'message' => Az::l('Вы уверены, что хотите клонировать?'),
            'confirm' => Az::l('Клонировать'),
            'cancel' => Az::l('Отмена'),
        ];

        $cancelObj = [
            'title' => Az::l('Подтверждение'),
            'message' => Az::l('Вы уверены, что хотите удалить?'),
            'confirm' => Az::l('Удалить'),
            'cancel' => Az::l('Отмена'),
        ];


        $this->js .= strtr($this->_layout['js'], [
            '{rv-editable-link}' => $this->_config['editableLink'],
            '{confirmObj}' => \yii\helpers\Json::encode($confirmObj),
            '{cancelObj}' => \yii\helpers\Json::encode($cancelObj),
            '{modelLower}' => strtolower($this->modelClassName),
            '{checkBoxAjax}' => $this->jscode($checkBoxAjax),
            '{modelClassName}' => $this->jscode($this->modelClassName),
            '{barcodeAttr}' => $this->_config['barCodeAttr'],
            '{counttr}' => $this->provider->count,
            '{numbers}' => $this->jscode($this->_config['numbers']),
            '{card}' => $shadow,
            '{checked-tr}' => $this->_config['checkSelectedClass'],
            '{input-id}' => 'barcode-' . $this->id . $this->className
        ]);

        if (ZArrayHelper::keyExists('barcode', $this->leftBtn))
            $this->js .= strtr($this->_layout['barcode'], [
                '{input-id}' => 'barcode-' . $this->id . $this->className
            ]);

        if ($this->_config['copy'] === true) {
            $this->js .= $this->_layout['copy'];
        }

        if ($this->isCLI())
            return null;

        $count = $this->provider->getCount();
        $total = $this->provider->getTotalCount();
        $summary = Az::l("{$count} из {$total} записей показаны");
        $theme = str_replace('panel-', '', $this->_config['theme']);

        $cardOptions = ZArrayHelper::merge($this->_config['cardOptions'], [
            'config' => [
                'title' => $this->_config['title'],
                'type' => ZCardWidget::type['dynCard'],
                'headerRight' => $summary,
                'classHeadColor' => 'bg-' . $theme,
                'hasIcon' => true,
                'icon' => $this->_config['headerIcon']
            ]
        ]);

        if ($this->_config['isCard']) {
            ZCardWidget::begin($cardOptions);
        }

        $this->options['storage'] = $this->_config['storage'];

        if (!$this->_config['isCard'] && !$this->_config['summary']) {
            echo <<<HTML
        <div class="col-md-12 row">
          <h3 class=" text-muted">{$this->_config['title']}</h3>
        <p class="text-muted ml-auto mt-3" >$summary</p>
</div>
        
HTML;

        }


        /*top Require */
        if ($this->_config['topRequireUrl'])
            echo $this->require( $this->_config['topRequireUrl'], [
                //'model' => $this->model,
            ]);

        ZHTML::addCssClass($this->options['gridOptions']['export']['options'], $this->_config['toolbarButtonsClass']);

        echo DynaGrid::widget($this->options);

        /*  bottom Require */
        if ($this->_config['bottomRequireUrl'])
            echo $this->require( $this->_config['bottomRequireUrl'], [
                'model' => $this->model,
            ]);

        if ($this->_config['isCard'])
            ZCardWidget::end();

        $this->htm .= strtr($this->_layout['formEditable'], [
            '{modelName}' => $this->modelClassName,
            '{configs}' => json_encode($this->model->configs),
            '{columns}' => json_encode($this->model->columns),
            '{cards}' => json_encode($this->model->cards),
        ]);

        $userid = $this->userIdentity()->id;
        $class = $this->model->className;
        $action = str_replace(end($this->urlArray), 'update', $this->urlArrayStr);

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-update',
            'config' => [
                'funcName' => 'dynaUpdatePanel',
                'title' => ZArrayHelper::getValue($this->_config['spaTitle'], 'update'),
            ],
            'event' => [
                'onbeforeclose' => strtr($this->_layout['cancelClickAuto'], [
                    '{cancelUrl}' => ZUrl::to([
                        '/api/core/dyna/cancel',
                        'modelName' => $class,
                        'fullWebId' => $action,
                        'sessionKey' => "Cancel-$class-$action-$userid",
                        'isNew' => false,
                    ]),
                    '{cancelBtn}' => Az::l('Нет'),
                    '{confirmBtn}' => Az::l('Да'),
                    '{confirmTitle}' => Az::l('Сохранить изменения?'),
                ]),
            ]
        ]);

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-dyna',
            'config' => [
                'funcName' => 'dynaPanel',
            ]
        ]);

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-related',
            'config' => [
                'funcName' => 'select2Related',
            ]
        ]);

        #region EDITABLE DYNA


        ZSweetAlert2Widget::begin([

            'config' => [
                'grapes' => false,
                'funcName' => 'dynaEditable',
                'width' => 'auto',
                'height' => 'auto',
                'begin' => true,
                'title' => $this->_config['title'],
                'allowOutsideClick' => 0,
                'showCloseButton' => true,
                'footer' => ZButtonWidget::widget([
                        'id' => 'dynaReset',
                        'config' => [
                            'text' => 'Удалить',
                            'btnType' => ZButtonWidget::btnType['submit'],
                            'btnRounded' => false,
                            'hasIcon' => true,
                            'btnSize' => ZColor::btnSize['btn-md'],
                            'icon' => 'fas fa-trash',
                            'class' => 'reset-rightBtn',
                            'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
                        ],

                    ]) .

                    ZButtonWidget::widget([
                        'id' => 'dynaSubmit',
                        'config' => [
                            'text' => 'Применять',
                            'btnType' => ZButtonWidget::btnType['submit'],
                            'hasIcon' => true,
                            'btnRounded' => false,
                            'icon' => 'fas fa-save',
                            'btnSize' => ZColor::btnSize['btn-md'],
                            'class' => 'submit-rightBtn',
                            'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                        ],
                    ]),
                'padding' => '0',
            ]
        ]);

        ?>
        <iframe id="ravshanDyna" name="editable-iframe" src="/core/edit/editable.aspx"
                class="p-3 text-center ravshanFrame"></iframe>
        <?php

        ZSweetAlert2Widget::end();


        #endregion




    }

    private function modelColumnGen()
    {

        if (!empty($this->columns))
            return false;

        if (empty($this->_config['columnBefore']) && $this->_config['columnAfter'] !== false)
            $this->_config['columnBefore'] = [
                'serial',
                'sort',
                'checkbox',
                paramAction,
                'relation',
                'expand',
            ];

        if (!ZArrayHelper::keyExists('sort', $this->model->columns)) {
            ZArrayHelper::removeValue($this->_config['columnBefore'], 'sort');
        }

        if ($this->type === self::type['form']) {
            $this->_config['columnBefore'] = [
                'serial',
                'sort',
                'checkbox',
            ];
        }

        if (!empty($this->_config['columnBefore']))
            foreach ($this->_config['columnBefore'] as $columnBefore) {
                $val = ZArrayHelper::getValue($this->_layout, $columnBefore);

                if ($val !== null)
                    $this->columns[] = $val();
            }

        Az::$app->forms->dynas->clean();
        Az::$app->forms->dynas->columns = $this->columns;
        Az::$app->forms->dynas->model = $this->model;
        Az::$app->forms->dynas->contentOptions = $this->_config['contentOptions'];
        Az::$app->forms->dynas->headerOptions = $this->_config['headerOptions'];
        Az::$app->forms->dynas->options = $this->_config['options'];

        switch ($this->type) {
            case  self::type['model']:
                Az::$app->forms->dynas->model();
                break;

            case self::type['form']:
                Az::$app->forms->dynas->form();
                break;
        }

        $this->columns = Az::$app->forms->dynas->columns;

        if (empty($this->_config['columnAfter']) && $this->_config['columnAfter'] !== false)
            $this->_config['columnAfter'] = [
                'radio'
            ];

        if (!empty($this->_config['columnAfter'])) {
            foreach ($this->_config['columnAfter'] as $columnAfter) {
                $val = ZArrayHelper::getValue($this->_layout, $columnAfter);

            }
            if ($val !== null)
                $this->columns[] = $val();
        }

    }


    private function visualSettings()
    {

        $dynaId = Az::$app->forms->dynas->dynaId($this->modelClassName);
        $coreDyna = DynaConfig::findOne([
            'dynaId' => $dynaId,
            'active' => true
        ]);

        $columns = [];
        if ($coreDyna && $coreDyna->config) {
            $columns = $coreDyna->config;
        }

        foreach ($columns as $key => $value) {

            if (ZArrayHelper::keyExists($key, $this->_config) && !empty($value)) {
                $this->_config[$key] = ZVarDumper::ajaxValue($value);
            }

            $this->model->configs->$key = ZArrayHelper::getValue($columns, $key);

        }

    }

    private function actionButtons()
    {

        if ($this->_config['btnDetail'] === null)
            $this->_config['btnDetail'] = $this->_layout['btnDetail'];

        if ($this->_config['btnEdit'] === null)
            $this->_config['btnEdit'] = $this->_layout['btnEdit'];

    }
}
