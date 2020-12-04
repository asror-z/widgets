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
use rmrevin\yii\fontawesome\FA;
use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\drag\DragConfig;
use zetsoft\models\drag\DragConfigDb;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\shop\ShopOrder;
use zetsoft\service\utility\Views;
use zetsoft\system\actives\ZActiveRecord;
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
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\iconers\ZBarcodeWidget;
use zetsoft\widgets\inputes\ZBarInputManyWidget;
use zetsoft\widgets\inputes\ZBarInputRavWidget;
use zetsoft\widgets\inputes\ZBarInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetOrg;
use zetsoft\widgets\notifier\ZJspanelWidgetRavshan;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\themes\ZCardWidget;

/**
 * Class ZDynaWidget
 * @package widgets\former
 * http://demos.krajee.com/dynagrid
 *
 *
 */
class ZDynaWidgetRavshan extends ZWidget
{

    /**
     * Configuration
     *
     */
    public $config = [];
    public $_config = [

        'allrecord' => 1,
        'checkSelectedClass' => ZColor::color['green lighten-5'],
        'reload' => ZDynaWidget::reload['false'],
        'twoCheck' => false,
        'barCodeMany' => false,
        'hasItems' => true,
        'spa' => true,
        'spaWidth' => [],
        'spaHeight' => [],
        'spaTitle' => [],
        'spaArray' => [],
        'isNewRecord' => false,
        'newRecordValues' => [],
        'perfectScrollbar' => true,
        'chooseQuery' => [],
        'floatHeader' => false,
        'chooseParams' => [],

        'title' => '',
        'viewTitle' => '',
        'updateTitle' => '',
        'detailTitle' => '',
        'titleSummary' => true,

        'itemsTitle' => '',

        'copy' => true,
        'paginationColor' => '#10b410',
        'exportAll' => true,
        'exportSingle' => true,
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
        'isExport' => true,
        //'jsonExportUrl' => '/api/core/files/export_U',
        'checkboxOptions' => [],
        'isExportAll' => true,
        'isUpdate' => false,
        'isExportSingle' => false,
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
        'detailUrl' => '{fullUrl}/detail.aspx',
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
        'viewUrl' => '{fullUrl}/view.aspx?id={id}',
        'summary' => false,
        'showPageSummary' => true,
        'pagerAjax' => false,
        'pjax' => true,
        'storage' => 'db',
        'theme' => self::theme['panel-primary'],

        'contentOptions' => [],
        'headerOptions' => [],
        'options' => [],

    ];

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
    public $type = 'model';
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
        'clear_update' => [
            'content' => '{clear_update}',
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
            'content' => '{statistics}{report}',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'export' => [
            'content' => '{export}{exportAll}{exportRav}{excelExport}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],


        'toggleData' => [
            'content' => '{all}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],

        'filterPjax' => [
            'content' => '{filterBtn}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],

    ];
    public $leftBtn = [];
    public $_leftBtn = [
        'search' => [
            'content' => '{search}',
            'options' => ['class' => ' p-1 mr-0 {btnSize} {iconSize}']
        ],
        /*'barcode' => [
            'content' => '',
            'options' => ['class' => ' p-1 mr-0 {btnSize} {iconSize}']
        ],*/
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

        $this->_config['columnBefore'] = [
            'checkbox',
            'serial',
            'action',
        ];

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

                        $isHref = false;
                        if (!ZArrayHelper::getValue($this->_config['spaArray'], 'update'))
                            $isHref = true;

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
                                '{isHref}' => $isHref,
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

            'exportExcel' => function ($q) {

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

            'items' => function () {

                return [
                    'class' => ZKDataColumn::class,
                    'label' => Az::l('Товары'),

                    'headerOptions' => [
                        'class' => 'numeratsiya'
                    ],
                    'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                        $id = ZArrayHelper::getValue($model, 'id');

                        $itemClass = $this->hasItems();

                        $itemModel = new $itemClass();
                        $title = $itemModel->configs->title . ' ' . $id;

                        $url = ZUrl::to([
                            '/core/dyna/items',
                            'modelClassName' => $this->modelClassName,
                            'id' => $id,
                        ]);

                        return ZButtonWidget::widget([
                            'config' => [
                                'btnSize' => ZColor::btnSize['default'],
                                'class' => 'ZDynaBTN p-1 ',
                                'title' => Az::l('Изменить'),

                                'btnRounded' => false,
                                'btn' => false,
                                'src' => '/render/former/ZDynaWidget/assets/img/items.svg',
                                'img' => true,
                                'hasIcon' => false,
                                'icon' => ''
                            ],
                            'event' => [
                                'click' => <<<JS
                    function() {
                    
                        window.itemsPanel()
                        
                        var iframe = $('#jsPanel-items-dyna-iframe');
                        $('#jsPanel-items-dyna').find('.jsPanel-title').text('{$title}')
                        iframe.attr('src', '{$url}')
                        
                    }
JS,
                            ]
                        ]);
                    }
                ];

            },

            'relations' => function () {


                return [
                    'class' => ZKDataColumn::class,
                    'label' => Az::l('Товары'),
                    'headerOptions' => [
                        'class' => 'numeratsiya'
                    ],
                    'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                        $id = ZArrayHelper::getValue($model, 'id');
                        $className = $this->model->className;

                        $attrMany = ZInflector::underscore($className) . '_id';
                        $btns = '';

                        $many = $this->model->configs->relateMany;
                        $multi = $this->model->configs->relateMulti;

                        if (!empty($many))
                            foreach ($many as $relation) {
                                $arr = explode("\\", $relation);
                                $count = count($arr) - 1;
                                $url = ZUrl::to([
                                    '/core/read/items',
                                    'modelClassName' => $relation,
                                    'id' => $id,
                                    'attr' => $attrMany
                                ]);

                                $btns .= ZButtonWidget::widget([
                                    'config' => [
                                        'text' => '',
                                        'url' => $url,
                                        'hasIcon' => true,
                                        'icon' => Az::$app->utility->mains->icon(true),
                                        'btn' => true,
                                        'title' => $arr[$count],
                                        'class' => 'p-2',
                                        'btnType' => ZButtonWidget::btnType['link'],
                                        'target' => ZButtonWidget::target['_self'],
                                        'pjax' => false

                                    ],

                                ]);

                            }

                        if (!empty($multi))
                            foreach ($multi as $relation) {
                                $attrMulti = ZInflector::underscore($relation) . '_ids';
                                $arr = explode("\\", $attrMulti);
                                $array = explode("\\", $relation);
                                $count = count($array) - 1;
                                $attr = $arr[3];
                                if (is_array($model) && !empty($model[$attr])) {
                                    $url = ZUrl::to([
                                        '/core/read/multiItems',
                                        'modelClassName' => $relation,
                                        'id' => ZArrayHelper::getValue($model, $attr),
                                    ]);

                                    $btns .= ZButtonWidget::widget([
                                        'config' => [
                                            'text' => '',
                                            'url' => $url,
                                            'hasIcon' => true,
                                            'icon' => Az::$app->utility->mains->icon(true),
                                            'btn' => true,
                                            'title' => $array[$count],
                                            'class' => 'p-2',
                                            'btnType' => ZButtonWidget::btnType['link'],
                                            'target' => ZButtonWidget::target['_self'],
                                            'pjax' => false

                                        ],

                                    ]);
                                }

                                if (is_object($model) && !empty($model->$attr)) {
                                    $url = ZUrl::to([
                                        '/core/read/multiItems',
                                        'modelClassName' => $relation,
                                        'id' => $model->$attr,
                                    ]);
                                    $btns .= ZButtonWidget::widget([
                                        'config' => [
                                            'text' => '',
                                            'url' => $url,
                                            'hasIcon' => true,
                                            'icon' => Az::$app->utility->mains->icon(true),
                                            'btn' => true,
                                            'title' => $array[$count],
                                            'class' => 'p-2',
                                            'btnType' => ZButtonWidget::btnType['link'],
                                            'target' => ZButtonWidget::target['_self'],
                                            'pjax' => false

                                        ],

                                    ]);
                                }


                            }


                        return $btns;

                    }
                ];


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
                  positions: positions
              }, 
              success: function (response) {
                  
              }
          });
    
      }

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
      
JS,

            'sortablePjax' => <<<JS

JS,

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
        
            
        .dynaActions {
            white-space: nowrap;
        }
        

        
         {column}
        
         
CSS,

            'column' => <<<CSS
        
         .editable-dyna-{attribute} {
            width: {width}!important;
         }
CSS,

            'newCheckBox' => <<<JS

    var numbers = {numbers};
                         
    window.ajaxFor = function () {

        $.ajax({
            type: 'POST',
            url: '{url}',
            data: {
                query: {query},
                orQuery: {orQuery},
                andQuery: {andQuery},
            },
            success: function (response) {
                numbers = response.numbers;
            }
        })
        
    }

    var newChecks = $('.checkbox-{modelClassName}')
    function checkAllNew() {
        
        var selectedAllNew = '';
        for (var item in numbers) {
            var checkbox = $('.checkbox-{modelClassName}[value="' + numbers[item] + '"]')
            if (!checkbox.is(':checked')) {
                selectedAllNew += 'error'
            }
        } 
        
        if (selectedAllNew === '' && numbers.length > 0)
           $('.checkBox-dynawidget-new').prop('checked', true)
        else   
           $('.checkBox-dynawidget-new').prop('checked', false)   
        
    }
      
    checkAllNew()    
      
    newChecks.on('change', function() {
        
        if ($('.checkBox-dynawidget-new').hasClass('all-checks'))
            return; 
                
        checkAllNew()
            
    })

    $(document).on('change', '.checkBox-dynawidget-new', function (event) {

          var selectAll = $(this); 
          
          selectAll.addClass('all-checks')
          
          var checkboxes = $(document).find('.checkbox-{modelClassName}');
               
          var checks = [];
          checkboxes.each(function() {
            if (numbers.includes(parseInt($(this).attr('value'))))
                checks.push($(this).attr('value'))
          })     
           
          var bool = false
          var url = '/api/core/dyna/checkAllDel.aspx'
          if (this.checked) {
              url = '/api/core/dyna/checkAll.aspx' 
              bool = true
          }
          
          checkboxes.each(function (index) {
                     
              var value = parseInt($(this).attr('value'))
              
              if (numbers.includes(value)) {
                  if (bool === true) {
                      $(this).prop('checked', true);
                  } else {
                      $(this).prop('checked', false);
                  }
                  
                  $(this).trigger('change');
              }
              
          });     
           
          $.ajax({
              type: 'GET',
              url: url,
              data: {
                  checks: checks,
                  url: '{checkUrl}',
                  modelClassName: '{modelClassName}' 
              },
              success: function(response) {
                 selectAll.removeClass('all-checks')
              }
              
          })
        
    });
JS,

            'js' => <<<JS
   
   function checkCheckbox(checkBox) {
     
        if (!checkBox.is(':checked'))
            checkBox.prop('checked', true)
        else
            checkBox.prop('checked', false)

        checkBox.trigger('change')
     
   } 
   
   {newCheckbox}

   {barcode} 
   
   $('.dyna-confirm-button').on('click', function() {
      
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

    $('.dyna-editable').on('click', function () {
        
        if ($(this).hasClass('readonly'))
            return;
        
        window.dynaEditable()
        
        var options = $(this).attr('options')
        
        options = JSON.parse(options)

        //$('.swal2-content').loader('show')
        $('#swal2-title').html('{title}' + options.title)
    
        var iframe = $('#ravshanDyna')
        
        var url = options.url;
             
        iframe.attr('src', url)
        iframe.attr('width', options.width)
        iframe.attr('height', options.height)    
        
        iframe.on('load', function() {
            $('.swal2-content').loader('hide')
        })
        
        $('.jsPanel-btn-close').on('click', function() {
           iframe.attr('src', '') 
        })
        
    });
    
    
    $('.dynagrid-action-buttons').on('click', function() {
      
        var url = $(this).data('url')
        var title = $(this).data('title')
        var iframeId = $(this).data('iframe')
       
        window.dynaPanel()
       
        var iframe = $('#jsPanel-dyna-iframe')
        $(iframe).attr('src', url)
        $('#jsPanel-dyna').find('.jsPanel-title').text(title)
        
    })

    $('.dynagrid-update-buttons').on('click', function() {
      
        var url = $(this).data('url')
        var iframeId = $(this).data('iframe')
       
        var isHref = $(this).data('href')
        if (isHref) {
            window.location.href = url;
            return;
        }
       
        window.dynaUpdatePanel()
       
        var iframe = $('#' + iframeId)
        $(iframe).attr('src', url)
        
    })
    
    window.closeModal = function(){
        $('#ravshan-modal').modal('hide');
    };
        
    window.closeSweet = function(){
        swal.close();
    };
   
    window.dynaReload = function(modelClass){
        $('#' + modelClass + '_Grid_Reset').click()
    };
   
   $('.tr-dynawidget').on('click', function(event) {
           
       const excludesClass = [
           'enable-edit',
           'kv-editable-link',
           'kv-editable-value',
           'checkBox-label',
           'checkBox-dynawidget',
           'modal',
           'ZDynaBTN',
      //     'dyna-editable',
           'btn',
      ];
     
      for (const value in excludesClass) {
          
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
       
   function filterDyna() {
       
      var search = '';
      
      $('.filter-dyna-widgets').each(function() {
         
         var bool1 = $(this).val() !== '';
         var bool2 = $(this).attr('name');
         var bool3 = $(this).val().length > 0;
           
         if (bool1 && bool2 && bool3) {
            var name = $(this).attr('name')
            search += name + '=' + $(this).val() + '&'
         }
         
      }) 
     
      /*var url = xhr.getResponseHeader('X-Pjax-Url');
      if (url) {
         window.location = url;
      }*/
      
      /*window.location.href = '?' + search;*/
     
      // todo start Tursunaliyev Abdulloh 
      
      let pjaxBtn = $('#filterPjax');
      
      pjaxBtn.attr('href', '?' + search)
      pjaxBtn.click()
      
      // todo end Tursunaliyev Abdulloh
      
   }    
       
   
   $('.filter-dyna-widgets').on('keyup', function(event) {
        
       if (!$(this).attr('name'))
         return;
       
       if (event.keyCode === 13) {
           
          var search = '';
      
          $('.filter-dyna-widgets').each(function() {
             
             var bool1 = $(this).val() !== '';
             var bool2 = $(this).attr('name');
             var bool3 = $(this).val().length > 0;
               
             if (bool1 && bool2 && bool3) {
                var name = $(this).attr('name')
                search += name + '=' + $(this).val() + '&'
             }
             
          })
          
          window.location.href = '?' + search
         
       }
       
   })
   
   
   $('.filter-dyna-widgets').on('change', function(event) {
   
       if (!$(this).attr('name'))
         return;
         
       filterDyna()
   })    
        
JS,

            'checkBoxAjax' => <<<JS

        var rows = $('.checkbox-{modelClassName}');
        
        function checkAll() {
        
            var selectedAll = '';
            rows.each(function() {
                if (!$(this).is(':checked'))
                   selectedAll += 'error' 
            })
            
            if (selectedAll === '' && rows.length > 0)
               $('.select-on-check-all').prop('checked', true)
            else   
               $('.select-on-check-all').prop('checked', false)
               
        } 
        
        checkAll()
        
        $('.select-on-check-all').on('change', function(event) {
          
             var selectAll = $(this); 
          
             selectAll.addClass('all-checks')
             
             var checkboxes = $(document).find('.checkbox-{modelClassName}');
                  
             var checks = [];
             checkboxes.each(function() {
                 checks.push($(this).attr('value'))
             })     
              
             var bool = false
             var url = '/api/core/dyna/checkAllDel.aspx'
             if (this.checked) {
                 url = '/api/core/dyna/checkAll.aspx' 
                 bool = true
             }
             
             checkboxes.each(function (index) {
                        
                 if (bool === true) {
                     $(this).prop('checked', true);
                 } else {
                     $(this).prop('checked', false);
                 }
                 
                 $(this).trigger('change');
                 
             });     
             
             $.ajax({
                type: 'GET',
                url: url,
                data: {
                    checks: checks,
                    url: '{checkUrl}',
                    modelClassName: '{modelClassName}' 
                },
                success: function(response) {
                   selectAll.removeClass('all-checks')
                }
                
            })
             
        }) 

        rows.on('change', function(event) {
           
            checkAll()    
                
            var b1 = $('.checkBox-dynawidget-new').hasClass('all-checks')        
            var b2 = $('.select-on-check-all').hasClass('all-checks')   
                
            if (b1 || b2)
                return;    
              
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
                            
                   {checkChild}
                   
                }
                
            })
            
            
        })
        
JS,

            'checkChild' => <<<JS

        if (typeof response === 'object') {
                        
            for (var item in response) {
                var checkbox = $('.checkbox-{modelClassName}[value="' + response[item] + '"]')
                if (!checkbox.is(':checked')) {
                    checkbox.prop('checked', true)
                    checkbox.trigger('change')
                }
            }
         
       }

JS,

            'copy' => <<<JS

   /* $(document).on('click', 'td', function (e) {
        var target = $( e.target );
        if (target.is('td')){
            var range = document.createRange();
            range.selectNodeContents(this);
            var text = range['startContainer']['innerText'];
            copyToClipboard(text);
            e.stopPropagation();
            console.log('Copied: ' + text);
       }
    });*/
    
JS,

            'actionModal' => <<<HTML
    <a data-url="{data-url}" data-iframe="{data-iframe}" data-href="{isHref}" data-title="{data-title}" id="{id}" data-toggle="tooltip" data-pjax="1" class="btn-lg ovr-button btn-transparent hint--top hint--default hint--medium hint--bounce hint--rounded p-0 ZDynaBTN {class}" aria-label="{title}" aria-hidden="true">
        <img src="{src}" alt="{alt}" width="42px" height="42px">
    </a>
HTML,

            'actionConfirm' => <<<HTML
    <a data-url="{data-url}" data-title="{title}" data-type="{data-type}" id="update-1856" data-toggle="tooltip" data-pjax="1" class="btn-lg ovr-button btn-transparent hint--top hint--default hint--medium hint--bounce hint--rounded p-0 ZDynaBTN {class}" aria-label="{title}" aria-hidden="true">
        <img src="{src}" alt="{alt}" width="42px" height="42px">
    </a>
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

    }

    #region ASSETS

    public function asset()
    {

    }

    #endregion


    public function getNewCheckbox()
    {

        $checkboxOptions = $this->_config['checkboxOptions'];

        $query = ZArrayHelper::getValue($checkboxOptions, 'query');
        $orQuery = ZArrayHelper::getValue($checkboxOptions, 'orQuery');
        $andQuery = ZArrayHelper::getValue($checkboxOptions, 'andQuery');

        $Q = $this->modelClass::find();

        /** @var ZActiveRecord $Q */
        $array = [];

        if (!empty($query)) {

            $Q->where($query);
            if (!empty($andQuery))
                $Q->andWhere($andQuery);

            if (!empty($orQuery))
                $Q->orWhere($orQuery);

            $maps = ZArrayHelper::map($Q->all(), 'id', 'id');

            foreach ($maps as $map) {
                $array[] = $map;
            }

        }

        $numbers = '[]';
        if (!empty($array))
            $numbers = $this->jscode($array);

        $query = ZVarDumper::arrayFilterAjax($query);
        $andQuery = ZVarDumper::arrayFilterAjax($andQuery);
        $orQuery = ZVarDumper::arrayFilterAjax($orQuery);

        $queryJs = '{}';
        if (!empty($query))
            $queryJs = Json::encode($query);

        $andQueryJs = '{}';
        if (!empty($andQuery))
            $andQueryJs = Json::encode($andQuery);

        $orQueryJs = '{}';
        if (!empty($orQuery))
            $orQueryJs = Json::encode($orQuery);

        $newCheckbox = '';
        if ($this->_config['twoCheck'])
            $newCheckbox = strtr($this->_layout['newCheckBox'], [
                '{numbers}' => $numbers,
                '{query}' => $this->jscode($queryJs),
                '{orQuery}' => $this->jscode($orQueryJs),
                '{andQuery}' => $this->jscode($andQueryJs),
                '{checkUrl}' => $this->urlArrayStr,
                '{modelClassName}' => $this->modelClassName,
                '{url}' => ZUrl::to([
                    ZArrayHelper::getValue($checkboxOptions, 'url'),
                    'modelClassName' => $this->modelClassName
                ])
            ]);

        return $newCheckbox;

    }

    private function hasItems()
    {

        $className = $this->modelClassName . 'Item';
        $class = $this->bootFull($className);

        if (class_exists($class))
            return $class;

        return false;
    }

    private function hasRelation()
    {
        if ($this->model->configs->relation && !(empty($this->model->configs->relateMany) || empty($this->model->configs->relateMulti)))
            return true;

        return false;
    }


    public function codes()
    {

        $this->paramSet('model', $this->model);

        if (!empty($this->model->configs->dynaButtons))
            $this->_rightBtn = $this->model->configs->dynaButtons;

        if (!empty($this->model->configs->showDeleted))
            $this->_rightBtn['add-clone-delete'] = [
                'content' => '{restore}{delete}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ];

        if ($this->model->configs->spa === false)
            $this->_config['spa'] = false;

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


        $this->columnsBefore();

        if ($this->provider === null) {
            $this->model->search = true;
            $this->provider = $this->model->search($this->data);
            $this->modelColumnGen();
        }

        $this->columnsAfter();

        $this->options = [
            'bsVersion' => $this->bsVersion,
            'storage' => $this->_config['storage'],
            'theme' => $this->_config['theme'],
            'userSpecific' => false,
            'columns' => $this->columns,
            'gridOptions' => [
                //'pager' => null,
                'condensed'=> true,
                'resizableColumns' => false,
                'dataProvider' => $this->provider,
                'filterModel' => $this->model,
                'showPageSummary' => true,
                'floatHeader'=>true,
                'floatHeaderOptions'=>['scrollingTop'=>'50'],
                'pjax'=>true,
                'responsiveWrap'=>false,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="fas fa-book"></i>  Library</h3>',
                    'before' => '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this demo as you scroll</em></div>',
                    'after' => false
                ],
                'toolbar' => [
                    [
                        'content' => '{dynagridFilter}{dynagridSort}{dynagrid}'
                    ],
                    '{export}',
                ]
            ],
            'options' => [
                'id' => $this->modelClassName . '-' . $this->userIdentity()->id
            ],

        ];


        $this->htm = DynaGrid::widget($this->options);

        $columns = '';
        if ($this->model->columns)
            foreach ($this->model->columns as $key => $column) {
                $columns .= strtr($this->_layout['column'], [
                    '{attribute}' => $key,
                    '{width}' => $column->width,
                ]);
            }

        $this->css = strtr($this->_layout['css'], [
            '{column}' => $columns,
        ]);

    }

    private function modelColumnGen()
    {

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

    }


    private function modelColumnGen2()
    {

        foreach ($this->model->columns as $key => $column) {

            $columns = [
                'class' => ZKDataColumn::class,
                'attribute' => $key,
                'vAlign' => 'middle',
                'width' => '300px!important',
                'options' => [
                    'class' => 'col-width-75',
                ],
                'value' => function ($model, $key, $index, $widget) {
                    
                },
                'filterType' => $column->filterWidget,
                'filter' => $column->filter,
                'filterWidgetOptions' => $column->filterOptions,
                'format' => 'raw'
            ];

            $this->columns[$key] = $columns;

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


    private function columnsBefore()
    {

        if (empty($this->_config['columnBefore']))
            return null;

        foreach ($this->_config['columnBefore'] as $columnBefore) {

            $val = ZArrayHelper::getValue($this->_layout, $columnBefore);

            if ($val !== null)
                $this->columns[] = $val();

        }

    }

    private function columnsAfter()
    {

        if (empty($this->_config['columnAfter']))
            return null;

        foreach ($this->_config['columnAfter'] as $columnAfter) {

            $val = ZArrayHelper::getValue($this->_layout, $columnAfter);

            if ($val !== null)
                $this->columns[] = $val();

        }

    }

}
