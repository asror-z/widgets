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
use zetsoft\service\forms\ZPjax;
use zetsoft\service\utility\Views;
use zetsoft\system\actives\ZActiveData;
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
use zetsoft\system\helpers\ZStringHelper;
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
class ZDynaWidgetOld_10_26_2020 extends ZWidget
{

    /**
     * Configuration
     *
     */
    public $config = [];
    public $_config = [

        /**
         * Titles
         *
         */
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
        'chooseWhere' => [],
        'chooseAndWhere' => [],
        'chooseOrWhere' => [],
        'chooseProcessUrl' => '/api/core/dyna/choose-dyna.aspx',
        'floatHeader' => false,
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
        'leftButtons' => [],
        'isExport' => true,
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
        'btnClone' => true,
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
        'reloadUrl' => '',
        'createUrl' => '{fullUrl}/create.aspx',
        'updateUrl' => '{fullUrl}/update.aspx?id={id}&model={modelClassName}',
        'relateUrl' => '{fullUrl}/relate.aspx?modelClassName={modelClassName}&id={id}',
        'relationsUrl' => '{fullUrl}/item.aspx?modelClassName={modelClassName}&id={id}',
        'relationsMultiUrl' => '{fullUrl}/itemMulti.aspx?modelClassName={modelClassName}&id={id}',
        'expandUrl' => '{fullUrl}/expand.aspx',

        'detailUrl' => '{fullUrl}/detail.aspx?modelClassName={modelClassName}&id={id}',
        'chooseUrl' => '{fullUrl}/choose.aspx?chooseQuery={chooseQuery}&processUrl={processUrl}',
        'tabularUrl' => '{fullUrl}/tabular.aspx',
        'systemUrl' => '{fullUrl}/system.aspx',
        'delDynaUrl' => '{fullUrl}/delete.aspx',
        'homeDynaUrl' => '{fullUrl}/index.aspx',
        'viewUrl' => '{fullUrl}/view.aspx?id={id}&model={modelClassName}',

        'deleteUrl' => '/api/core/dyna/delete.aspx?modelClassName={modelClassName}&id={id}',
        'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}',
        'restoreAllUrl' => '/api/core/dyna/restore-all.aspx?modelClassName={modelClassName}',

        'cloneUrl' => '/api/core/dyna/clone.aspx?modelClassName={modelClassName}&id={id}',
        'cloneAllUrl' => '/api/core/dyna/clone-all.aspx?modelClassName={modelClassName}',

        'exportUrl' => '/api/core/files/excel',

        'summary' => false,
        'showPageSummary' => true,
        'pagerAjax' => false,
        'jsonIrina' => false,
        'pjax' => false,

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
        'action-width' => '200px',
        'hasWidth' => true,
        'heighbody' => '70vh',

        'filter' => true,
        'pagerClass' => null,
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
        'checkAllQuery' => [],
        'relation' => false,
        'relateMany' => false,
        'relateMulti' => false,
        'jsPanelForItems' => true,

        //start|JakhongirKudratov|2020-10-10

        /**
         * Enum Column
         *
         */

        'enum' => [],
        'enumAttr' => '',
        'enumFilter' => [],

        /**
         * Boolean Column
         */

        'booleanAttr' => '',

        //end|JakhongirKudratov|2020-10-10

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

        // start|MuminovUmid
        'clear_update' => [
            'content' => '{clear_update}',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],
        // end|MuminovUmid

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
            'content' => '{jsonExcel}{export}{exportAll}',/*{excelBosya}*/
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],


        'toggleData' => [
            'content' => '{all}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],

        // todo start Tursunaliyev Abdulloh

        'filterPjax' => [
            'content' => '{filterBtn}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],

        // todo end Tursunaliyev Abdulloh

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
            'view' => true,
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
                'create' => Az::l('Создание {title}', [
                    'title' => $this->_config['title']
                ]),
                'update' => Az::l("Редактирование {title}", [
                    'title' => $this->_config['title']
                ]),
                'detail' => Az::l('Детали {title}', [
                    'title' => $this->_config['title']
                ]),
                'view' => Az::l('Просмотр {title}', [
                    'title' => $this->_config['title']
                ]),
                'choose' => Az::l('Подобрать {title}', [
                    'title' => $this->_config['title']
                ]),
            ];

    }

    #region ASSETS

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js');
        if (!$this->_config['border']) {
            $this->fileCss('/render/former/ZDynaWidget/assets/no_border.css');
        }

        $this->fileCss('/render/former/ZDynaWidget/assets/islom.css');

        $this->fileCss('/render/former/ZDynaWidget/assets/main.css');

        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.css');

        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js', Views::position['end']);

        if ($this->_config['copy'] === true) {
            $this->fileJs('https://cdn.jsdelivr.net/npm/copy-to-clipboard@3.3.1/example/index.js');
        }
    }

    #endregion


    public function getNewCheckbox()
    {
        //start|DavlatovRavshan|2020.10.10

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

        //end | DavlatovRavshan | 10.10.2020

    }

    private function hasItems()
    {

        $className = $this->modelClassName . 'Item';
        $class = $this->bootFull($className);

        if (class_exists($class))
            return $class;

        return false;
    }


    // todo:start JakhongirKudratov

    private function hasRelation()
    {
        if ($this->model->configs->relation && (!empty($this->model->configs->relateMany) || !empty($this->model->configs->relateMulti)))
            return true;

        return false;
    }


    // todo:end JakhongirKudratov

    private function allowFullDelete(){
        global $boot;
        if ($this->model->configs->showDeleted && !$boot->env('enableDeleteFromDb')) {
            return false;
        }

        return true;
    }

    public function codes()
    {

        $allowFullDelete = $this->allowFullDelete();
        $this->paramSet('model', $this->model);

        if ($this->_config['pjax']) {
            /*$this->pjaxBegin(function (ZPjax $pjax) {
                $pjax->id = 'DynaPjax-' . $this->modelClassName;
                return $pjax;
            });*/

        }
        //  echo ZResponsiveTableWidget::widget();

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


            //start|JakhongirKudratov|2020-10-10

            'enum' => function () {
                return [
                    'class' => 'kartik\grid\EnumColumn',
                    'attribute' => $this->_config['enumAttr'],
                    'format' => 'html',
                    'enum' => $this->_config['enum'],
                    // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                    'filter' => $this->_config['enumFilter'],
                ];
            },


            'boolean' => function () {
                return [
                    'class' => '\kartik\grid\BooleanColumn',
                    'attribute' => $this->_config['booleanAttr'],
                    'trueLabel' => 'Yes',
                    'falseLabel' => 'No'
                ];
            },

            //end|JakhongirKudratov|2020-10-10

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
                        'class' => 'd-flex dynaWid'
                    ],
                    'label' => 'action',
                    'value' => function ($model, $keys, $index, DataColumn $dataColumn) {

                        //start|DavlatovRavshan|2020.10.10

                        $key = ZArrayHelper::getValue($model, 'id');

                        $strtrUrl = [
                            '{modelClassName}' => $this->modelClassName,
                            '{fullUrl}' => $this->prelastUrl(),
                            '{id}' => $key,
                        ];

                        $cloneUrl = strtr($this->_config['cloneUrl'], $strtrUrl);
                        $deleteUrl = strtr($this->_config['deleteUrl'], $strtrUrl);

                        $isHref = false;
                        if (!ZArrayHelper::getValue($this->_config['spaArray'], 'update'))
                            $isHref = true;

                        $buttons = [
                            'view' => strtr($this->_layout['actionModal'], [
                                '{title}' => Az::l('Просмотр'),
                                '{class}' => 'dynagrid-action-buttons',
                                '{data-url}' => $this->getUrl('view', $key),
                                '{id}' => 'view-' . $key,
                                '{data-title}' => ZArrayHelper::getValue($this->_config['spaTitle'], 'view'),
                                '{src}' => '/render/former/ZDynaWidget/assets/img/view.svg',
                            ]),
                            'update' => strtr($this->_layout['actionModal'], [
                                '{title}' => Az::l('Изменить'),
                                '{class}' => 'dynagrid-update-buttons',
                                '{data-url}' => $this->getUrl('update', $key),
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

                                // start|MuminovUmid|2020-10-20
                                '{id}' => 'clone-' . $key,
                                // end|MuminovUmid|2020-10-20

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
                                '{data-url}' => $this->getUrl('detail', $key),
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
                                //    'detail'
                            ];

                        $return = '';
                        foreach ($this->_config['actionButtons'] as $actionButton) {
                            $return .= ZArrayHelper::getValue($buttons, $actionButton);
                        }

                        return $return;
                        //end | DavlatovRavshan | 10.10.2020

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
                            'id' => $this->modelClassName,
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
                $url = strtr($this->_config['relateUrl'], [
                    '{fullUrl}' => $this->prelastUrl(),
                ]);
                if (!empty($this->modelConfigs->hasMany) || !empty($this->modelConfigs->hasOne) || !empty($this->modelConfigs->hasMulti)) {
                    return [
                        'class' => ZKDataColumn::class,
                        'label' => Az::l('Связи'),
                        'headerOptions' => [
                            'class' => 'numeratsiya'
                        ],
                        'value' => function ($model, $key, $index, DataColumn $dataColumn) use ($url) {
                            return ZIframeSpaWidget::widget([
                                'id' => $this->modelClassName,
                                'model' => $model,
                                'config' => [
                                    'url' => $url,
                                    'key' => $key,
                                    'size' => ZIframeSpaWidget::sizeIframe['md'],
                                    'type' => ZIframeSpaWidget::type['other'],
                                    'icon' => 'fal text-muted fa-lg fa-link',


                                ],
                            ]);
                        }
                    ];

                }

                return [];
            },

            //start|DavlatovRavshan|2020.10.10
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
                                'title' => Az::l('Товары'),

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
            //end | DavlatovRavshan | 10.10.2020

            // todo:start JakhongirKudratov

            'relateMany' => function () {

                $url = strtr($this->_config['relationsUrl'], [
                    '{fullUrl}' => $this->prelastUrl(),
                ]);

                if (!empty($this->modelConfigs->relateMany)) {
                    return [
                        'class' => ZKDataColumn::class,
                        'label' => Az::l('Связи Many'),
                        'headerOptions' => [
                            'class' => 'numeratsiya'
                        ],
                        'value' => function ($model, $key, $index, DataColumn $dataColumn) use ($url) {
                            //start: MurodovMirbosit 15.10.2020
                            return ZIframePanelWidget::widget([
                                'id' => $this->modelClassName,
                                'model' => $this->model,
                                'config' => [
                                    'btnOptions' => [
                                        'config' => [
                                            'title' => Az::l('Связи Many'),
                                            'btn' => false,
                                            'class' => 'ZDynaBTN p-0',
                                            'btnRounded' => false,
                                            'readonly' => true,
                                            'src' => '/render/former/ZDynaWidget/assets/img/info.svg',
                                            'img' => true,
                                            'hasIcon' => false,
                                            'icon' => '',
                                        ]
                                    ],
                                    'url' => $url,
                                    'key' => $key,
                                    'funcName' => 'bosya',
                                    'size' => ZIframeSpaWidget::sizeIframe['md'],
                                    'type' => ZIframeSpaWidget::type['other'],
                                    'icon' => 'fas fa-link'/*'fas fa-sitemap'*/,
                                ],
                            ]);
                            //end
                        }
                    ];

                }

                return [];
            },
            // todo:end JakhongirKudratov

            //start: MurodovMirbosit 14.10.2020

            'relateMulti' => function () {


                if (!empty($this->modelConfigs->relateMulti)) {


                    return [
                        'class' => ZKDataColumn::class,
                        'label' => Az::l('Связи Multi'),
                        'headerOptions' => [
                            'class' => 'numeratsiya'
                        ],
                        'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                            /*$url = strtr($this->_config['relationsMultiUrl'], [
                                '{fullUrl}' => $this->prelastUrl(),
                                '{modelClassName}' => $model,
                                '{id}' => $key,
                            ]);*/
                            /*$element_id = [];
                            if (!empty($element_id)) {
                                $element_id = []
                                ;
                            }*/
                            /* $url = ZUrl::to([
                                 '/core/read/multiItems',
                                 'modelClassName' => '{modelClassName}',
                                 $this->_config['relations_id']
                             ]);
                          */
                            $url = strtr($this->_config['relationsMultiUrl'], [
                                '{fullUrl}' => $this->prelastUrl(),
                            ]);
                            return ZIframePanelWidget::widget([
                                'id' => $this->modelClassName,
                                'model' => $this->model,
                                'config' => [
                                    'btnOptions' => [
                                        'config' => [
                                            'title' => Az::l('Связи Multi'),
                                            'btn' => false,
                                            'class' => 'ZDynaBTN p-0',
                                            'btnRounded' => false,
                                            'readonly' => true,

                                            'src' => '/render/former/ZDynaWidget/assets/img/info.svg',
                                            'img' => true,
                                            'hasIcon' => false,
                                            'icon' => '',
                                        ]
                                    ],
                                    'url' => $url,
                                    'key' => $key,
                                    'funcName' => 'bosya1',
                                    'size' => ZIframeSpaWidget::sizeIframe['md'],
                                    'type' => ZIframeSpaWidget::type['other'],
                                    'icon' =>  'fas fa-sitemap'/*'fas fa-link'*/,
                                ],
                            ]);
                            /* return ZButtonWidget::widget([
                                 'config' => [
                                     'title' => Az::l('Связи Multi'),
                                     'btn' => false,
                                     'class' => 'ZDynaBTN p-0',
                                     'btnRounded' => false,
                                     'readonly' => true,
                                     'src' => '/render/former/ZDynaWidget/assets/img/items.svg',
                                     'img' => true,
                                     'hasIcon' => false,
                                     'icon' => '',
                                 ],
                                 'event' => [
                                     'click' => <<<JS
             function () {

                 window.relationsPanel()

                 var iframe = $('#jsPanel-relations-iframe');
                 iframe.attr('src', '{$url}')

             }
 JS,

                                 ]
                             ]);*/
                        }
                    ];
                }

                return [];


            },

            //start: MurodovMirbosit 14.10.2020

            /*  'relateMulti' => function () {
                  return [
                      'class' => ZKDataColumn::class,
                      'label' => Az::l('Связи Multi'),
                      'headerOptions' => [
                          'class' => 'numeratsiya'
                      ],
                      'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                          $id = ZArrayHelper::getValue($model, 'id');

                          $btns = '';

                          $multi = $this->model->configs->relateMulti;

                          if (!empty($multi))
                              foreach ($multi as $parametr => $relation) {

                                  $array = explode("\\", $relation);
                                  $count = count($array) - 1;

                                  $key = $relation . $parametr;

                                  if ($key !== 'id') {

                                      $key = $relation . '[' . $parametr . '][]';

                                  }

                                  $url = ZUrl::to([
                                      '/core/read/multiItems',
                                      'modelClassName' => $relation,
                                      $key => $id,
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
                          return $btns;

                      }
                  ];
              },*/

            //end

            //end


            /*
                        'items' => function () {
                            $urll = strtr($this->_config['relateUrl'], [
                                '{fullUrl}' => $this->prelastUrl(),
                            ]);
                            if (!empty($this->model->configs->relationItems)) {
                                return [
                                    'class' => ZKDataColumn::class,
                                    'label' => Az::l('Товары'),
                                    'headerOptions' => [
                                        'class' => 'numeratsiya'
                                    ],
                                    'value' => function ($model, $key, $index, DataColumn $dataColumn) use ($urll) {
                                        return ZButtonWidget::widget([
                                            'config' => [
                                                'text' => Az::l('Айтемы'),
                                                'url'
                                            ]
                                        ]);
                                    }
                                ];

                            }

                            return [];
                        },*/


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

            'btnClone' => function ($model) {
                $url = strtr($this->_config['cloneUrl'], [
                    '{modelClassName}' => $this->modelClassName,
                    '{id}' => ZArrayHelper::getValue($model, 'id')
                ]);

                $modelName = $this->modelClassName;
                if ($this->model->configs->clonable)
                    return ZButtonWidget::widget([
                        'config' => [
                            'title' => Az::l('Клонировать'),
                            'btn' => false,
                            'class' => 'ZDynaBTN p-0',
                            'hasConfirm' => true,
                            'btnRounded' => false,
                            'confirm' => Az::l('Are you sure you want CLONE columns?'),
                            'confirmTitle' => Az::l('Клонировать'),
                            'readonly' => true,
                            'src' => '/render/former/ZDynaWidget/assets/img/clone.svg',
                            'img' => true,
                            'hasIcon' => false,
                            'icon' => 'fas fa-clone',
                        ],
                        'event' => [
                            'confirmEvent' => <<<JS
            $.ajax({
                url: '{$url}',
                success: function() {
                    $('#{$modelName}_Grid_Reset').click()
                }
            });
            console.log('btn');
JS,

                        ]
                    ]);
                return '';
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
                        'icon' => '',
                        'pjax' => false
                    ],
                ]);
            },

            'btnView' => function ($model) {

                $url = strtr($this->_config['viewUrl'], [
                    '{id}' => ZArrayHelper::getValue($model, 'id')
                ]);

                return ZButtonWidget::widget([
                    'config' => [
                        'url' => $url,
                        'btnSize' => ZButtonWidget::btnSize['default'],
                        'class' => 'ZDynaBTN p-1',
                        'title' => Az::l('Просмотр'),
                        'btnRounded' => false,
                        'btn' => false,
                        'src' => '/render/former/ZDynaWidget/assets/img/view.svg',
                        'img' => true,
                        'hasIcon' => false,
                        'icon' => ''
                    ],
                ]);
            },

            'btnDelete' => function ($model) use ($isTrash, $allowFullDelete) {
                /** @var ZActiveRecord $model */
                if (!$allowFullDelete)
                    return null;

                $url = strtr($this->_config['deleteUrl'], [
                    '{modelClassName}' => $this->modelClassName,
                    '{id}' => ZArrayHelper::getValue($model, 'id'),
                ]);

                $modelName = $this->modelClassName;

                return ZButtonWidget::widget([
                    'config' => [
                        'title' => Az::l('Удалить'),
                        'btn' => false,
                        'class' => 'ZDynaBTN p-0',
                        'hasConfirm' => true,
                        'btnRounded' => false,
                        'confirm' => Az::l('Are you sure you want DELETE columns?'),
                        'confirmTitle' => Az::l('Удалить'),
                        'readonly' => true,
                        'src' => '/render/former/ZDynaWidget/assets/img/delete.svg',
                        'img' => true,
                        'hasIcon' => false,
                        'icon' => ''
                    ],
                    'event' => [
                        'confirmEvent' => <<<JS

            $.ajax({
                url: '{$url}',
                data: {
                    isTrash: {$isTrash}
                },
                success: function() {
                    $('#{$modelName}_Grid_Reset').click()
                }
            })
JS,

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
      
      zSortable()
      
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
         
        .pjaxnum{
            padding: 20px!important;
         }
        
         {column}
         
         /* 
        .editable-dyna-id{
             width: 70px!important;
        }
         */
         
CSS,
            'column' => <<<CSS
        
         .editable-dyna-{attribute} {
            width: {td-width}!important;
         }
         
CSS,

            'newCheckBox' => <<<JS

//start|DavlatovRavshan|2020.10.10
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
    
    //end | DavlatovRavshan | 10.10.2020
JS,


            'js' => <<<JS
   
    //start|DavlatovRavshan|2020.10.10
   
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
                           //$('#{modelClassName}_Grid_Reset').click()
                           location.reload()
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
      
       window.dynaPanel{modelName}()
      
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
      
       window.dynaUpdatePanel{modelName}()
       var iframe = $('#' + iframeId)
       $(iframe).attr('src', url)
       
   })
   
   window.closeModal = function() {
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
   //end | DavlatovRavshan | 10.10.2020    
       
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
     
      //start:TursunaliyevAbdulloh 
      
      let pjaxBtn = $('#filterPjax')
      
      pjaxBtn.attr('href', '?' + search)
      pjaxBtn.click()
      
      //end:TursunaliyevAbdulloh
      
   }    
       
   
   $('.filter-dyna-widgets').on('keyup', function(e) {
        
       if (!$(this).attr('name')){
         return;
       }
       
       if (e.keyCode === 13) {
            
          e.preventCancel
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
          // start:TursunaliyevAbdulloh
          setTimeout(function() {
            var pjaxBtn = $('#filterPjax')
      
            pjaxBtn.attr('href', '?' + search)
            pjaxBtn.click()  
          }, 1000)
          // end:TursunaliyevAbdulloh
          console.log($(this))
          
       }
       
   })
   
   
   $('.filter-dyna-widgets').on('change', function(event) {
   
       if (!$(this).attr('name'))
         return;
         
       filterDyna()
       
   })    
        
JS,

            'checkBoxAjax' => <<<JS

        //start|DavlatovRavshan|2020.10.10

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
        //end | DavlatovRavshan | 10.10.2020
JS,

            'checkChild' => <<<JS

        //start|DavlatovRavshan|2020.10.10

        if (typeof response === 'object') {
                        
            for (var item in response) {
                var checkbox = $('.checkbox-{modelClassName}[value="' + response[item] + '"]')
                if (!checkbox.is(':checked')) {
                    checkbox.prop('checked', true)
                    checkbox.trigger('change')
                }
            }
       }
       //end | DavlatovRavshan | 10.10.2020

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
        //start|DavlatovRavshan|2020.10.10

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
        //end | DavlatovRavshan | 10.10.2020
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
            $this->provider = $this->model->search($this->data);
            $this->modelColumnGen();
        }
        //start|DavlatovRavshan|2020.10.11

        if ($this->provider instanceof ZActiveData) {
            $this->provider->where = $this->_config['chooseWhere'];
            $this->provider->andWhere = $this->_config['chooseAndWhere'];
            $this->provider->orWhere = $this->_config['chooseOrWhere'];
        }

        $className = $this->modelClassName;
        $url = $this->urlArrayStr;
        $userId = $this->userIdentity()->id;

        // $name = $this->nameProvider($this);

        $this->sessionSet("Provider-$className-$url-$userId", $this->provider);
        //end|DavlatovRavshan|2020.10.11
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
                    'id' => 'asrork',
                    'class' => 'tbody'
                ],


                // Kim false qilmoqchi bo'lsa +998998113264 ga telefon qilib ruxsat so'rasin
                'perfectScrollbar' => $this->_config['perfectScrollbar'],
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
                'persistResize' => true,
                'hideResizeMobile' => true,
                'resizableColumnsOptions' => [

                ],
                'resizeStorageKey' => App,
                'floatHeader' => $this->_config['floatHeader'],
                'floatOverflowContainer' => false,
                'floatHeaderOptions' => [
                    'scrollingTop' => '0',
                    'position' => 'absolute',
                ],
                'showPageSummary' => $this->_config['showPageSummary'],
                'pageSummaryRowOptions' => ['class' => 'warning'],
                /*kv-page-summary */
                'layout' => '{summary}',
                'summary' => '{begin} - {end} {count} {totalCount} {page} {pageCount}',
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

        $exportAll = ZExportBtnWidget::widget([
            'id' => $this->modelClassName . '-exportAll',
            'model' => $this->model,
            
            'config' => [
                'grapes' => false,
                'hidden' => true,
                'configs' => $this->model->configs,
                'action' => '/api/core/files/exportAll/',
                'class' => $toolbarClasses,
                'modelClassName' => $this->modelClassName,
            ]
        ]);

        $reloadUrl = $this->_config['reloadUrl'];
        if (empty($this->_config['reloadUrl']))
            $reloadUrl = $this->urlArrayStr;


        // start|MuminovUmid
        $clear_update = ZButtonWidget::widget([
            'config' => [
                'url' => $this->resetUrl(),
                'btnType' => ZButtonWidget::btnType['link'],
                //'src' => '/webhtm/shop/agent/manual/edit.png',
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnSize' => ZColor::btnSize['default'],
                'btnRounded' => false,
                'title' => 'Обновить',
                'toggle' => ZButtonWidget::toggle['tooltip'],
                'hasIcon' => false,
                'icon' => 'fal fa-redo',
                'class' => "btn update-dynagrid  {$toolbarClasses}",
                'data-pjax' => 1,
            ],
        ]);
        // start|MuminovUmid

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
                'icon' => 'fal fa-sync-alt',
                'class' => "btn update-dynagrid {$toolbarClasses}",
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

        $filterBtn = ZButtonWidget::widget([
            'id' => 'filterPjax',
            'config' => [
                'title' => 'Ссылка',
                'icon' => 'fas fa-external-link-alt',
                'pjax' => true,
                'url' => '',
                'btnRounded' => false,
                'btn' => true,
                'hasIcon' => true,
                'hidden' => true
            ],
            'active' => [
                'click' => true,
            ],
            'event' => [
                'click' => <<<JS
                console.log(event)
JS,
            ],
        ]);

        //$add = '';
        $add = ZButtonWidget::widget([
            'config' => [
                'url' => $this->getUrl(),
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
                    'isNewRecord' => $this->_config['isNewRecord'],
                    'newRecordValues' => $this->_config['newRecordValues'],
                    'beforeClose' => true,
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
                    'url' => $this->getUrl(),
                    'height' => ZArrayHelper::getValue($this->_config['spaHeight'], 'create'),
                    'width' => ZArrayHelper::getValue($this->_config['spaWidth'], 'create'),
                    'title' => ZArrayHelper::getValue($this->_config['spaTitle'], 'create'),
                    'funcName' => 'dynaCreate' . $this->modelClassName,
                    'changeSave' => $this->model->configs->changeSave,
                    'type' => ZIframeSpaWidget::type['create'],
                    'formId' => $this->modelClassName,
                ]
            ]);
        }
        //start|DavlatovRavshan|2020.10.11

        /*$chooseUrl = strtr($this->_config['chooseUrl'], ZArrayHelper::merge($strtrUrl, [
            '{processUrl}' => $this->_config['chooseProcessUrl']
        ]));*/

        //start|JakhongirKudratov|2020-10-23

        $chooseUrl = strtr($this->getUrl('choose'), [
            '{processUrl}' => $this->_config['chooseProcessUrl']
        ]);

        //end|JakhongirKudratov|2020-10-23


        $choose = '';
        if (!empty($this->model->configs->query)) {
            $choose = ZIframePanelWidget::widget([
                'id' => $this->modelClassName . '-dataPanel',
                'model' => $this->model,
                'config' => [
                    'funcName' => 'choosePanel',
                    'url' => $chooseUrl,
                    'title' => ZArrayHelper::getValue($this->_config['spaTitle'], 'choose'),
                    'btnOptions' => [
                        'config' => [
                            'icon' => 'fas fa-list',
                            'class' => $toolbarClasses,
                            'btnType' => ZButtonWidget::btnType['button']
                        ]
                    ]
                ]
            ]);
        }
        //end|DavlatovRavshan|2020.10.11

        $cloneUrl = strtr($this->_config['cloneAllUrl'], [
            '{modelClassName}' => $this->modelClassName
        ]);

        $deleteUrl = strtr($this->_config['deleteAllUrl'], [
            '{modelClassName}' => $this->modelClassName
        ]);

        $restoreUrl = strtr($this->_config['restoreAllUrl'], [
            '{modelClassName}' => $this->modelClassName
        ]);
        //start|JakhongirKudratov|2020-10-23

        /*
                $delUrl = strtr($this->_config['delDynaUrl'], [
                    '{modelClassName}' => $this->modelClassName,
                    '{fullUrl}' => $this->prelastUrl(),
                ]);*/


        $delUrl = $this->getUrl('delDyna');


        $homeUrl = strtr($this->_config['homeDynaUrl'], [
            '{modelClassName}' => $this->modelClassName,
            '{fullUrl}' => $this->prelastUrl(),
        ]);

       /* $systemUrl = strtr($this->_config['systemUrl'], [
            '{modelClassName}' => $this->modelClassName,
            '{fullUrl}' => $this->prelastUrl(),
        ]);*/



        $systemUrl = $this->getUrl('system');

        //end|JakhongirKudratov|2020-10-23

        $search = '';
        if ($this->_config['search'])
            $search = ZDynaSearchWidget::widget([
                
                'config' => [
                    'grapes' => false,
                    'dyna' => true,
                ]
            ]);

        $clone = '';
        if ($this->model->configs->clonable && $this->type === 'model')
            $clone = ZGetChecksWidget::widget([
                'model' => $this->model,
                
                'config' => [
                    'btnOptions' => [
                        'config' => [
                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnRounded' => false,
                            'confirm' => true,
                            'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                            'title' => 'Клонировать',
                            // start|MuminovUmid|2020-10-16
                            'icon' => 'fal fa-clone',
                            // end|MuminovUmid|2020-10-16
                            'class' => "pb-4 rounded-0 clone-{$this->modelClassName} {$toolbarClasses}",
                            'message' => Az::l('Вы хотите клонировать этот элемент(ы)?'),
                        ]
                    ],
                    'url' => $cloneUrl,
                    'modelClassName' => $this->modelClassName
                ]
            ]);

        $delete = '';
        if ($this->type === 'model' && $allowFullDelete) {
            $delete = ZGetChecksWidget::widget([
                'model' => $this->model,
                
                'config' => [
                    'btnOptions' => [
                        'config' => [
                            'btnType' => ZButtonWidget::btnType['button'],
                            'class' => "pb-4 rounded-0 delete-{$this->modelClassName} {$toolbarClasses}",
                            'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                            'btnRounded' => false,
                            'confirm' => true,
                            // start|MuminovUmid|2020-10-16
                            'title' => 'Удалить',
                            // end|MuminovUmid|2020-10-16
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
        }
        $system = ZButtonWidget::widget([
            'model' => $this->model,
            
            'config' => [
                'pjax' => 0,
                'hasIcon' => true,
                'title' => 'Система',
                'grapes' => false,
                'url' => $systemUrl,
                'class' => 'pb-4 rounded-0',
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnRounded' => false,
                'icon' => 'fal text-muted fa-cogs fa-lg mr-0',
                'confirm' => true,
                'modelClassName' => $this->modelClassName
            ]
        ]);;

        if ($this->model->configs->showSystemColumn && $this->type === 'model') {
            $system = ZButtonWidget::widget([
                'model' => $this->model,
                
                'config' => [
                    'pjax' => 0,
                    'hasIcon' => true,
                    'title' => 'Домой',
                    'grapes' => false,
                    'url' => $homeUrl,
                    'class' => 'pb-4 rounded-0',
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
                    'class' => 'pb-4 rounded-0',
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
                        'class' => 'pb-4 rounded-0',
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
                'btnOptions' => [
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
                        'modelClassName' => $this->modelClassName,
                        'value' => $this->model->configs->showDeleted,
                    ]
                ],
            ]
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

        $applyUrl = ZUrl::to([
            '/core/dynagrid/apply',
            'modelClassName' => $this->modelClassName,
        ]);

        $apply = ZCheckDynaWidget::widget([
            
            'config' => [
                'title' => 'start cruds?',
                'icon' => 'fal fa-file-o',
                'grapes' => false,
                'url' => $applyUrl,
                'class' => 'btn-outline-success text-success simple-' . $this->id,
                'message' => Az::l('Запустить команду cruds/run/apply для этой модели?')
            ]
        ]);

        $normsUrl = ZUrl::to([
            '/core/dynagrid/norms',
            'modelClassName' => $this->modelClassName
        ]);

        $norms = ZCheckDynaWidget::widget([
            
            'config' => [
                'title' => 'normalize?',
                'icon' => 'fal fa-file-o',
                'grapes' => false,
                'url' => $normsUrl,
                'class' => 'simple-' . $this->id,
                'message' => Az::l('Нормализовать эту Форму?')
            ]
        ]);

        $dynaSettings = '';
        if ($this->type === 'model')
            $dynaSettings = ZSettingBtnWidget::widget([
                
                'model' => $this->model,
                'columns' => $this->columns,
                'config' => [
                    'nameOn' => $this->model->configs->nameOn,
                    'nameOff' => $this->model->configs->nameOff,
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
                    'color' => ZColor::color['none'],
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

        /**
         * @license N
         */
        $report = '';
        if ($this->type === 'model')
            $report = ZButtonWidget::widget([
                'config' => [
                    'hasIcon' => true,

                    'icon' => 'fal fa-chart-line',
                    //'class' => $theme . ' ' . $this->_config['btnClass'],
                    'btnRounded' => false,
                    'pjax' => 0,
                    'title' => Az::l('Универсальный отчет'),
                    'toggle' => ZButtonWidget::toggle['tooltip'],
                    'url' => ZUrl::to([
                        '/core/dynagrid/chess',
                        'modelClass' => $this->modelClassName,
                        'query' => $query
                    ]),
                ],
            ]);


        $filter = '';

        /*$filter = ZDynaFilterWidget::widget([
            'id' => 'dynagrid-filter',
            'model' => $this->model,
            'config' => [
                'btnClass' => $toolbarClasses,
            ]
        ]);*/
        /*
                $sort = ZDynaSortWidget::widget([
                    'id' => 'dynagrid-sort',
                    'model' => $this->model,
                    'config' => [
                        'btnClass' => $toolbarClasses,
                    ]
                ]);*/

        $sort = '';

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

        $newbutton = ZButtonWidget::widget([
            'config' => [
                'text' => 'new Button'
            ]
        ]);

        if (!$this->_config['hasToolbar'])
            $this->_rightBtn = [];

        if ($this->_config['barCode']) {

            $this->_leftBtn = ZArrayHelper::merge([
                'barcode' => [
                    'content' => ZInputWidget::widget([
                        'id' => $this->id . '-barcode'
                    ]),
                    'options' => ['class' => ' mt-3 {btnSize} {iconSize}']
                ]
            ], $this->_leftBtn);

        }

        $addCode = false;
        if (!empty($this->model->configs->addCode)) {
            $addCode = $this->model->configs->addCode;
        }

        $barcode = ZBarcodeWidget::widget([
            'config' => [
                'type' => $this->type ?: 'model',
                'addCode' => $addCode,
                'barCode' => $this->_config['barCode'],
                'id' => $this->id,
            ],

        ]);

        $excelExport = ZExportExcelBtnWidget::widget([
            'id' => $this->modelClassName . '-exportU',
            'model' => $this->model,
            
            'config' => [
                'grapes' => false,
                'hidden' => true,
                'configs' => $this->model->configs,
                'action' => '/api/core/files/excel',
                'class' => $toolbarClasses,
                'modelClassName' => $this->modelClassName,
            ]
        ]);

        $exportBtn = Az::$app->forms->export->dynaExport($this);
        //$excelBtn = Az::$app->office->excel->dynaExport($this);

        $toolbar = [];
        $exportExcel = $this->_layout['exportExcel']($query);
        $replace = ZArrayHelper::merge([
            '{search}' => $search,
            '{update}' => $update,
            // start|MuminovUmid
            '{clear_update}' => $clear_update,
            // start|MuminovUmid
            '{add}' => $add,
            '{all}' => $all,
            '{choose}' => $choose,
            '{newbutton}' => $newbutton,
            '{tabular}' => null,
            '{clone}' => $clone,
            '{delete}' => $delete,
            '{restore}' => $restore,
            '{system}' => $system,
            '{delDyna}' => $delDyna,
            '{apply}' => $apply,
            '{norms}' => $norms,
            '{generate}' => $generateButton,
            '{dynagridSettings}' => $dynaSettings,
            '{statistics}' => $statistics,
            '{report}' => $report,
            '{dynagridSort}' => '',
            '{filter}' => '',
            '{exportAll}' => $exportAll,
            '{exportSingle}' => $this->_config['isExportSingle'] ? '{export}' : '',
            '{jsonExcel}' => $exportBtn,
            //'{excelBosya}' => $excelBtn,
            '{excelExport}' => $excelExport,
            '{exportExcel}' => $exportExcel,
            '{filterBtn}' => $filterBtn
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
            //'showpageSummary' => $this->_config['showpageSummary'],
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
                'floatHeader' => true,
                'floatHeaderOptions' => [
                    'scrollingTop' => '50'
                ],
                'filterModel' => $this->_config['filter'] ? $this->model : null,

                'layout' => $summary . '\n{items}\n{pager}',
                'panelHeadingTemplate' => "{title}<div class='clearfix'></div>",
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

        $checkChild = '';
        if ($this->_config['twoCheck'])
            $checkChild = strtr($this->_layout['checkChild'], [
                '{modelClassName}' => $this->jscode($this->modelClassName),
            ]);

        $checkBoxAjax = strtr($this->_layout['checkBoxAjax'], [
            '{modelClassName}' => $this->modelClassName,
            '{checkUrl}' => $this->urlArrayStr,
            '{checkChild}' => $checkChild,
        ]);

        $newCheckbox = '';
        if ($this->type === 'model')
            $newCheckbox = $this->getNewCheckbox();

        //$title = Az::l("Редактировать $column->title");

        $checkChild = '';
        if ($this->_config['twoCheck'])
            $checkChild = strtr($this->_layout['checkChild'], [
                '{modelClassName}' => $this->jscode($this->modelClassName),
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
            '{newCheckbox}' => $newCheckbox,
            '{barcode}' => $barcode,
            '{checkChild}' => $checkChild,
            '{confirmObj}' => Json::encode($confirmObj),
            '{cancelObj}' => Json::encode($cancelObj),
            '{rv-editable-link}' => $this->_config['editableLink'],
            '{modelLower}' => strtolower($this->modelClassName),
            '{checkBoxAjax}' => $this->jscode($checkBoxAjax),
            '{modelClassName}' => $this->jscode($this->modelClassName),
            '{barcodeAttr}' => $this->_config['barCodeAttr'],
            '{counttr}' => $this->provider->count,
            '{numbers}' => $this->jscode($this->_config['numbers']),
            '{card}' => $shadow,
            '{title}' => Az::l('Редактировать '),
            '{checked-tr}' => $this->_config['checkSelectedClass'],
            '{input-id}' => 'barcode-' . $this->id . $this->className,
            '{modelName}' => $this->modelClassName
        ]);

        if ($this->_config['copy'] === true) {
            $this->js .= $this->_layout['copy'];
        }

        if ($this->isCLI())
            return null;

        $count = $this->provider->getCount();
        $total = $this->provider->getTotalCount();

        $summary = Az::l('{count} из {total} записей показаны', [
            'count' => $count,
            'total' => $total,
        ]);

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
<!-- start | FozilZayniddinov | 10.15.2020 -->
        <div class="col-md-12 d-flex align-items-center">
          <h3 class="font-weight-bold text-muted">{$this->_config['title']}</h3>
        <p class="text-muted ml-auto" >$summary</p>
        </div>
<!-- end | FozilZayniddinov | 10.15.2020 -->
HTML;

        }


        /*top Require */
        if ($this->_config['topRequireUrl'])
            echo $this->require($this->_config['topRequireUrl'], [
                //'model' => $this->model,
            ]);

        ZHTML::addCssClass($this->options['gridOptions']['export']['options'], $this->_config['toolbarButtonsClass']);
        /*$this->options['showpageSummary'] = $this->config['showpageSummary'];*/
        echo DynaGrid::widget($this->options);

        /* bottom Require */
        if ($this->_config['bottomRequireUrl'])
            echo $this->require($this->_config['bottomRequireUrl'], [
                'model' => $this->model,
            ]);

        if ($this->_config['isCard'])
            ZCardWidget::end();

        //start|DavlatovRavshan|2020.10.10

        $userid = $this->userIdentity()->id;
        $class = $this->model->className;
        $action = str_replace(end($this->urlArray), 'update', $this->urlArrayStr);

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-update',
            'config' => [
                'funcName' => 'dynaUpdatePanel' . $this->modelClassName,
                'title' => ZArrayHelper::getValue($this->_config['spaTitle'], 'update'),
            ],
            /*'event' => [
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
            ]*/
        ]);

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-dyna',
            'config' => [
                'funcName' => 'dynaPanel' . $this->modelClassName,
            ]
        ]);

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-relations',
            'config' => [
                'funcName' => 'relationsPanel'. $this->modelClassName,
            ]
        ]);

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-related',
            'config' => [
                'funcName' => 'select2Related'. $this->modelClassName,
            ]
        ]);
        //end | DavlatovRavshan | 10.10.2020


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

        #region CRUDS SPA


        ZSweetAlert2Widget::begin([
            
            'config' => [
                'grapes' => false,
                'funcName' => 'dynaSweet',
                'width' => 'auto',
                'height' => 'auto',
                'begin' => true,
                'title' => $this->_config['title'],
                'allowOutsideClick' => 0,
                'showCloseButton' => true,
                'footer' => '',
                'padding' => '0',
            ],
            'event' => [
                'onClose' => <<<JS
                    function() {
                        //$('#{$this->modelClassName}_Grid_Reset').click()
                    }
JS,

            ]
        ]);

        ?>

        <iframe id="dynaIframe"></iframe>

        <?php

        ZSweetAlert2Widget::end();

        ZSweetAlert2Widget::begin([
            
            'config' => [
                'grapes' => false,
                'funcName' => 'dynaUpdate',
                'width' => 'auto',
                'height' => 'auto',
                'begin' => true,
                'title' => $this->_config['title'],
                'allowOutsideClick' => 0,
                'showCloseButton' => true,
                'footer' => '',
                'padding' => '0',
            ],
            'event' => [
                'onClose' => <<<JS
                    function() {
                        //$('#{$this->modelClassName}_Grid_Reset').click()
                    }
JS,
            ]
        ]);

        ?>

        <iframe id="dynaIframe"></iframe>

        <?php

        ZSweetAlert2Widget::end();


        ZSweetAlert2Widget::begin([
            
            'config' => [
                'grapes' => false,
                'funcName' => 'dynaView',
                'width' => 'auto',
                'height' => 'auto',
                'begin' => true,
                'title' => $this->_config['title'],
                'allowOutsideClick' => 0,
                'showCloseButton' => true,
                'footer' => '',
                'padding' => '0',
            ],
        ]);

        ?>

        <iframe id="dynaIframe"></iframe>

        <?php

        ZSweetAlert2Widget::end();

        #endregion

        #region RELATION DYNA

        ZSweetAlert2Widget::begin([
            
            'config' => [
                'grapes' => false,
                'funcName' => 'relationSweet',
                'width' => 'auto',
                'height' => 'auto',
                'begin' => true,
                'title' => $this->_config['title'],
                'allowOutsideClick' => false,
                'showCloseButton' => true,
                'footer' => '',
                'padding' => '0',
            ]
        ]);

        ?>

        <iframe id="relationSweet"></iframe>

        <?php


        ZSweetAlert2Widget::end();

        #endregion

        ZSweetAlert2Widget::begin([
            
            'config' => [
                'funcName' => 'fkTableSelect2',
                'grapes' => false,
                'width' => 'auto',
                'height' => 'auto',
                'begin' => true,
                'allowOutsideClick' => false,
                'showCloseButton' => true,
                'footer' => '',
                'padding' => '0',
            ],
        ]);

        ?>

        <iframe id="fkTableIframe"></iframe>

        <?php

        ZSweetAlert2Widget::end();


        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-items-dyna',
            'config' => [
                'funcName' => 'itemsPanel',
            ]
        ]);

        //start: MurodovMirbosit 14.10.2020
        /* if ($this->_config['jsPanelForItems']) {

             ZSweetAlert2Widget::begin([
                 
                 'config' => [
                     'funcName' => 'PanelTable',
                     'grapes' => false,
                     'width' => 'auto',
                     'height' => 'auto',
                     'begin' => true,
                     'allowOutsideClick' => false,
                     'showCloseButton' => true,
                     'footer' => '',
                     'padding' => '0',
                 ],
             ]);
             */ ?><!--

            <iframe id="PanelTableIframe"></iframe>

            --><?php
        /*            ZSweetAlert2Widget::end();

            echo ZJspanelWidgetRavshan::widget([
                'model' => $this->model,
                'id' => 'jsPanel-items-dyna-iframes',
                'config' => [
                    'funcName' => 'itemsPanelIframe',
                ]
            ]);
        }*/
        //end
        /* if ($this->_config['pjax'])
             $this->pjaxEnd();*/

        /* ZJspanelWidgetOrg::begin([
             'id' => 'dyna-editable-js-panel',
             'config' => [
                 'begin' => true,
                 'width' => '500px',
                 'height' => '400px',
                 'footerToolbar' => ZButtonWidget::widget([
                         'id' => 'dynaResetPanel',
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
                         'id' => 'dynaSubmitPanel',
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
                     ])
             ]
         ])
         */ ?><!--

        <iframe id="ravshanDynaPanel" class="p-3 text-center ravshanFrame"></iframe>

        --><?php
        /*        ZJspanelWidgetOrg::end();*/


    }

    private function modelColumnGen()
    {

        if (!empty($this->columns))
            return false;

        $bool = empty($this->_config['columnBefore']);
        if (empty($this->_config['columnBefore']) && $this->_config['columnBefore'] !== false)
            $this->_config['columnBefore'] = [
                'serial',
                'sort',
                'checkbox',
                'action',
                //'formula',
                //'boolean',
                //'enum',
                //'items',
                //  'expand',
            ];

        if (!ZArrayHelper::keyExists('sort', $this->model->columns)) {
            ZArrayHelper::removeValue($this->_config['columnBefore'], 'sort');
        }

        if ($this->type === self::type['form'] && $bool) {
            $this->_config['columnBefore'] = [
                'serial',
                'sort',
                'checkbox',
            ];
        }

        //vdd($this->relations());


        if ($this->hasRelation() && $this->_config['relation'])
            $this->_config['columnBefore'][] = 'relation';

        if ($this->hasRelation() && $this->_config['relateMany'])
            $this->_config['columnBefore'][] = 'relateMany';

        if ($this->hasRelation() && $this->_config['relateMulti'])
            $this->_config['columnBefore'][] = 'relateMulti';

        $hasItems = $this->hasItems();

        if ($hasItems !== false && $this->_config['hasItems'])
            $this->_config['columnBefore'][] = 'items';

        if (!empty($this->_config['columnBefore']))
            foreach ($this->_config['columnBefore'] as $columnBefore) {

                $val = ZArrayHelper::getValue($this->_layout, $columnBefore);

                if ($val !== null)
                    $this->columns[] = $val();
            }

        Az::$app->forms->dynas->clean();
        Az::$app->forms->dynas->columns = $this->columns;
        Az::$app->forms->dynas->provider = $this->provider;
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


    //start|DavlatovRavshan|2020.10.16

    private function getUrl($type = 'create', $id = null)
    {

        $index = $type . 'Url';

        if (!ZArrayHelper::keyExists($index, $this->_config))
            return null;

        $strtr = [
            '{modelClassName}' => $this->modelClassName,
            '{modelName}' => $this->modelClassName,
            '{key}' => $id,
            '{id}' => $id,
        ];

        $preUrl = $this->_config[$index];
        $url = strtr($preUrl, ZArrayHelper::merge($strtr, [
            '{fullUrl}' => $this->prelastUrl(),
        ]));

        $tableName = ZInflector::underscore($this->modelClassName);
        if (!$this->fileExists($url)) {
            $url = strtr($preUrl, ZArrayHelper::merge($strtr, [
                '{fullUrl}' => "/crud/$tableName",
            ]));
        }

        $url = $this->getSpaUrl($url, $type);

        return $url;

    }

    private function getSpaUrl($url, $type)
    {

        $append = '';
        if (ZArrayHelper::getValue($this->_config['spaArray'], $type)) {

            if (ZStringHelper::find($url, '?'))
                $append = '&spa=1';
            else
                $append = '?spa=1';

        }

        return $url . $append;

    }


    private function fileExists($url)
    {

        preg_match('/(.*)\.aspx.*/', $url, $match);

        $file = ZArrayHelper::getValue($match, 1);

        $file = Root . '/webhtm' . $file . '.php';

        if (file_exists($file))
            return true;

        return false;

    }

    //end|DavlatovRavshan|2020.10.16


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

        if ($this->_config['btnClone'] === null)
            $this->_config['btnClone'] = $this->_layout['btnClone'];

        if ($this->_config['btnEdit'] === null)
            $this->_config['btnEdit'] = $this->_layout['btnEdit'];

        if ($this->_config['btnView'] === null)
            $this->_config['btnView'] = $this->_layout['btnView'];

        if ($this->_config['btnDelete'] === null)
            $this->_config['btnDelete'] = $this->_layout['btnDelete'];

    }

    private function resetUrl()
    {
        $urlArray = Az::$app->request->queryParams;

        if (empty($urlArray))
            return ZUrl::to([
                $this->urlArrayStr
            ]);

        if (isset($urlArray[$this->modelClassName]))
            unset($urlArray[$this->modelClassName]);


        $myArray = [$this->urlArrayStr];
        $url = ZUrl::to(ZArrayHelper::merge($myArray, $urlArray));

        return $url;
    }
}
