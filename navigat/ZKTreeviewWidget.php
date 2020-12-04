<?php

namespace zetsoft\widgets\navigat;

use zetsoft\widgets\consts\ZTreeviewWidgetConst;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\dialog\Dialog;
use kartik\tree\TreeView;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Class ZKTreeviewWidget
 * @package common\blocker
 * http://demos.krajee.com/tree-manager
 */
class ZKTreeviewWidget extends ZWidget
{


    public $sQuery;
    public $bIsAdmin = true;
    public $iDisplayValue = 1;
    public $sEmptyNodeMsg = 'node name not set';
    public $iAlertFadeDuration = 1000;
    public $sNodeView = '@kvtree/views/_form';
    public $isMultiple = true;
    public $iscolumnCheckbox = false;
    public $bFontAwesome = false;
    public $sLibName = 'krajeeDialog';
    public $bCascadeSelectChildren = true;
    public $sDialogTitle = '';
    public $isShowInactive = false;


    /**
     * $iconEditType
     * TreeView::ICON_RAW
     * Defaults to TreeView::ICON_CSS
     */
    public $iconEditType = TreeView::ICON_CSS;


    /**
     * @var string Plugin Events
     * http://demos.krajee.com/tree-manager#tree-view-input
     */
    public $eventChange = 'function(event, key, name) { console.log("treeview:change"); }';
    public $eventBeforeselect = 'function(event, key, jqXHR, settings) { console.log("treeview:beforeselect");}';
    public $eventSelected = 'function(event, key, jqXHR, settings) { console.log("treeviewWidget | eventSelected");}';
    public $eventSelecterror = 'function(event, key, jqXHR, settings) { console.log("treeviewWidget | eventSelecterror");}';
    public $eventSelectajaxerror = 'function(event, key, jqXHR, textStatus, errorThrown) { console.log("treeviewWidget | eventSelectajaxerror");}';
    public $eventSelectcomplete = 'function(event, jqXHR) { console.log("treeviewWidget | eventSelectcomplete");}';
    public $eventBeforeremove = 'function(event, key, jqXHR, settings) { console.log("treeviewWidget | eventBeforeremove");}';
    public $eventRemove = 'function(event, key, data, textStatus, jqXHR) { console.log("treeview:remove");}';
    public $eventRemoveerror = 'function(event, key, data, textStatus, jqXHR) { console.log("treeview:remove error");}';
    public $eventRemoveajaxerror = 'function(event, key, jqXHR, textStatus, errorThrown) { console.log("treeview:eventRemoveajaxerror");}';
    public $eventRemovecomplete = 'function(event, jqXHR) { console.log("treeview | eventRemovecomplete");}';
    public $eventBeforemove = 'function(event, dir, keyFrom, keyTo, jqXHR, settings) { console.log("treeview:eventBeforemove");}';
    public $eventMove = 'function(event, dir, keyFrom, keyTo, data, textStatus, jqXHR) { console.log("treeview:EventMove");}';
    public $eventMoveerror = 'function(event, dir, keyFrom, keyTo, data, textStatus, jqXHR) { console.log("treeview:eventMoveerror");}';
    public $eventMoveajaxerror = 'function(event, dir, keyFrom, keyTo, jqXHR, textStatus, errorThrown) { console.log("treeview:eventMoveajaxerror");}';
    public $eventMovecomplete = 'function(event, jqXHR) { console.log("treeview:$eventMovecomplete");}';
    public $eventCreate = 'function(event, parent) { console.log("treeview:create");}';
    public $eventCreateroot = 'function(event) { console.log("treeview:createroot");}';
    public $eventExpand = 'function(event, nodeKey) { console.log("treeview:expand");}';
    public $eventCollapse = 'function(event, key) { console.log("treeview:cllapse");}';
    public $eventExpandall = 'function(event) { console.log(\'treeview:expandall\'); }';
    public $eventCollapseall = 'function(event) { console.log(\'treeview:collapseall\'); }';
    public $eventSearch = 'function(event) { console.log(\'treeview:search\'); }';
    public $eventChecked = 'function(event, key) { console.log(\'treeview:checked\'); }';
    public $eventUnchecked = 'function(event, key) { console.log(\'treeview:unchecked\'); }';



    public function codes()
    {
        $this->options = [
            'query' => $this->sQuery,
            'fontAwesome' => $this->bFontAwesome,
            'isAdmin' => $this->bIsAdmin,
            'displayValue' => $this->iDisplayValue,
            'softDelete' => true,
            'cacheSettings' => [
                'enableCache' => true,
                'cacheTimeout' => 300000
            ],
            'emptyNodeMsg' => $this->sEmptyNodeMsg,
            'emptyNodeMsgOptions' => [
                'class' => 'kv-node-message'
            ],
            'showIDAttribute' => true,
            'showFormButtons' => true,
            'breadcrumbs' => [
                'depth' => '',
                'glue' => '&raquo;',
                'activeCss' => 'kv-crumb-active',
                'untitled' => 'Untitled'
            ],
            'nodeFormOptions' => [],
            'alertFadeDuration' => $this->iAlertFadeDuration,
            'nodeLabel' => [],
//            'nodeActions' => [
//                Module::NODE_MANAGE => Url::to(['/treemanager/node/manage']),
//                Module::NODE_SAVE => Url::to(['/treemanager/node/save']),
//                Module::NODE_REMOVE => Url::to(['/treemanager/node/remove']),
//                Module::NODE_MOVE => Url::to(['/treemanager/node/move']),
//            ],
//            'nodeAddlViews' => [
//                self::VIEW_PART_1 => '',
//                self::VIEW_PART_2 => '',
//                self::VIEW_PART_3 => '',
//                self::VIEW_PART_4 => '',
//                self::VIEW_PART_5 => '',
//            ],
            'columnCheckbox' => $this->iscolumnCheckbox,
            'multiple' => $this->multiple,
            'cascadeSelectChildren' => $this->bCascadeSelectChildren,
            'showInactive' => $this->isShowInactive,
            'iconEditSettings' => [
                'show' => 'list',
                'type' => $this->iconEditType,
                'listData' => $this->iconEditListData()
            ],
            'toolbar' => $this->getToolBar(),
            'toolbarOptions' => [],
            'buttonGroupOptions' => ['class' => 'btn-group-sm'],
            'buttonOptions' => ['class' => 'btn btn-secondary'],
            'buttonIconOptions' => [],
            'showTooltips' => true,
            'defaultChildNodeIcon' => $this->bFontAwesome ? '<i class="fas fa-folder"></i>' : '<i class="glyphicon glyphicon-folder-close"></i>',
            'defaultParentNodeIcon' => $this->bFontAwesome ? '<i class="fas fa-folder"></i>' : '<i class="glyphicon glyphicon-folder-close"></i>',
            'defaultParentNodeOpenIcon' => $this->bFontAwesome ? '<i class="fas fa-folder-open"></i>' : '<i class="fas fa-folder-open"></i>',
            'childNodeIconOptions' => ['class' => 'text-info'],
            'parentNodeIconOptions' => ['class' => 'text-warning'],
            'allowNewRoots' => true,
            'clientMessages' => $this->getClientMessages(),
            'rootOptions' => ['class' => 'text-primary'],
            'rootNodeToggleOptions' => ['class' => 'text-muted'],
            'rootNodeCheckboxOptions' => ['class' => 'text-success'],
            'nodeToggleOptions' => ['class' => 'text-muted'],
            'nodeCheckboxOptions' => ['class' => 'text-success'],
            'collapseNodeOptions' => [
                'label' => $this->bFontAwesome ? '<i class="fas fa-minus-square-o"></i>' : '<i class="glyphicon glyphicon-collapse-down"></i>'
            ],
            'expandNodeOptions' => [
                'label' => $this->bFontAwesome ? '<i class="fas fa-plus-square-o"></i>' : '<i class="glyphicon glyphicon-expand"></i>'
            ],
            'checkedNodeOptions' => [
                'label' => $this->bFontAwesome ? ' <i class="fas fa-check-square-o"></i>>' : '<i class="glyphicon glyphicon-checked"></i>'
            ],
            'uncheckedNodeOptions' => [
                'label' => $this->bFontAwesome ? ' <i class="fas fa-check-square-o"></i>>' : '<i class="glyphicon glyphicon-unchecked"></i>'
            ],
            'treeWrapperOptions' => ['class' => 'kv-tree-wrapper form-control'],
            'headingOptions' => ['class' => 'kv-tree-heading'],
            /**
             * headerOptions
             * array, the HTML attributes for the tree header container
             */
            'headerOptions' => [],
            'hideUnmatchedSearchItems' => true,
            'searchContainerOptions' => ['class' => 'kv-search-sm'],
            'searchOptions' => ['class' => 'input-sm'],
            'searchClearOptions' => ['class' => 'close'],
            'footerOptions' => [],
            'treeOptions' => ['style' => 'height:410px'],
            'detailOptions' => ['style' => 'height:410px'],
            //'options' => ['class' => 'form-control hide'],
            /**
             * krajeeDialogSettings
             * http://demos.krajee.com/dialog
             */
            'krajeeDialogSettings' => $this->krajeeDialogSetting(),
            'mainTemplate' => '<div class="row"><div class="col-sm-3">{wrapper}</div><div class="col-sm-9">{detail}</div></div>',
            'wrapperTemplate' => '{header}{tree}{footer}',
            'headerTemplate' => '<div class="row"><div class="col-sm-6">{heading}</div><div class="col-sm-6">{search}</div></div>',
            'footerTemplate' => '{toolbar}',
            'nodeView' => $this->sNodeView,
            'pluginEvents' => $this->pluginEvents()
        ];

        $this->htm = TreeView::widget($this->options);
        
    }

    public function run()
    {
        //$this->option();
        //return $this->codes();
    }

    private function pluginEvents() {

       return [
            'treeview:beforeselect' => new JsExpression($this->eventBeforeselect),
            'treeview:selected' => new JsExpression($this->eventSelected),
            'treeview:selecterror' => new JsExpression($this->eventSelecterror),
            'treeview:selectajaxerror' => new JsExpression($this->eventSelectajaxerror),
            'treeview:selectcomplete' => new JsExpression($this->eventSelectcomplete),
            'treeview:beforeremove' => new JsExpression($this->eventBeforeremove),
            'treeview:remove' => new JsExpression($this->eventRemove),
            'treeview:removeerror' => new JsExpression($this->eventRemoveerror),
            'treeview:removeajaxerror' => new JsExpression($this->eventRemoveajaxerror),
            'treeview:removecomplete' => new JsExpression($this->eventRemovecomplete),
            'treeview:beforemove' => new JsExpression($this->eventBeforemove),
            'treeview:move' => new JsExpression($this->eventMove),
            'treeview:moveerror' => new JsExpression($this->eventMoveerror),
            'treeview:moveajaxerror' => new JsExpression($this->eventMoveajaxerror),
            'treeview:movecomplete' => new JsExpression($this->eventMovecomplete),
            'treeview:create' => new JsExpression($this->eventCreate),
            'treeview:createroot' => new JsExpression($this->eventCreateroot),
            'treeview:expand' => new JsExpression($this->eventExpand),
            'treeview:collapse' => new JsExpression($this->eventCollapse),
            'treeview:expandall' => new JsExpression($this->eventExpandall),
            'treeview:collapseall' => new JsExpression($this->eventCollapseall),
            'treeview:search' => new JsExpression($this->eventSearch),
            'treeview:checked' => new JsExpression($this->eventChecked),
            'treeview:unchecked' => new JsExpression($this->eventUnchecked),
            'treeview:change' => new JsExpression($this->eventChange),
        ];


    }

    private function krajeeDialogSetting() {

        return [
            'useNative' => false,
            'libName' => $this->sLibName,
            'showDraggable' => true,
            'options' => [],
            'jsPosition' => View::POS_HEAD,
            /**
            * DialogDefaults
            * http://demos.krajee.com/dialog
            * Dialog::DIALOG_ALERT or 'alert'
            * Dialog::DIALOG_CONFIRM or 'confirm'
            * Dialog::DIALOG_PROMPT or 'prompt'
            * Dialog::DIALOG_OTHER or 'dialog'
            *
            */
            'dialogDefaults' => [
                Dialog::DIALOG_ALERT => [
                    /**
                    * type
                    *
                    * Dialog::TYPE_DEFAULT or 'type-default'
                    * Dialog::TYPE_PRIMARY or 'type-primary'
                    * Dialog::TYPE_SUCCESS or 'type-success'
                    * Dialog::TYPE_DANGER or 'type-danger'
                    * Dialog::TYPE_WARNING or 'type-warning'
                    * Dialog::TYPE_INFO or 'type-info'
                    */
                    'type' => Dialog::TYPE_SUCCESS,
                    'title' => $this->sDialogTitle,
                    'buttonLabel' => '<i class="fas fa-check"></i> Ok',
                    'btnOKClass' => 'btn-warning',
                    'btnOKLabel' => '<i class="fas fa-check"></i> Ok',
                    'btnCancelLabel' => '<i class="fas fa-ban"></i> Cancel',
                    'draggable' => false,
                    'closable' => true,
                    'buttons' => [
                        [
                            'label' => Az::l('Cancel'),
                            'icon' => ''
                        ],
                        [
                            'label' => Az::l('Ok'),
                            'icon' => '',
                            'class' => 'btn-primary'
                        ],
                    ]
                ]
            ]
        ];

    }

    private function iconEditListData()
    {

        switch ($this->iconEditType) {
            case TreeView::ICON_CSS:
                return [
                    'folder-close' => 'Folder',
                    'file' => 'File',
                    'tag' => 'Tag'
                ];
            case TreeView::ICON_CSS:
                return [
                    '<img src="images/folder.jpg">' => 'Folder',
                    '<img src="images/file.jpg">' => 'File',
                    '<img src="images/tag.jpg">' => 'Tag',
                ];
            default:
                return [];


        }
    }

    private function getToolBar()
    {

        return [

            TreeView::BTN_CREATE => [
                'icon' => 'plus',
                'alwaysDisabled' => false,
                'options' => ['title' => Az::l('Add new'), 'disabled' => true]
            ],
            TreeView::BTN_CREATE_ROOT => [
                'icon' => $this->bFontAwesome ? 'tree' : 'tree-conifer',
                'alwaysDisabled' => false,
                'options' => ['title' => Az::l('Add new root')]
            ],
            TreeView::BTN_REMOVE => [
                'icon' => 'trash',
                'alwaysDisabled' => false,
                'options' => ['title' => Az::l('Delete'), 'disabled' => true]
            ],
            TreeView::BTN_SEPARATOR,
            TreeView::BTN_MOVE_UP => [
                'icon' => 'arrow-up',
                'alwaysDisabled' => false,
                'options' => ['title' => Az::l('Move Up'), 'disabled' => true]
            ],
            TreeView::BTN_MOVE_DOWN => [
                'icon' => 'arrow-down',
                'alwaysDisabled' => false,
                'options' => ['title' => Az::l('Move Down'), 'disabled' => true]
            ],
            TreeView::BTN_MOVE_LEFT => [
                'icon' => 'arrow-left',
                'alwaysDisabled' => false,
                'options' => ['title' => Az::l('Move Left'), 'disabled' => true]
            ],
            TreeView::BTN_MOVE_RIGHT => [
                'icon' => 'arrow-right',
                'alwaysDisabled' => false,
                'options' => ['title' => Az::l('Move Right'), 'disabled' => true]
            ],
            TreeView::BTN_SEPARATOR,
            TreeView::BTN_REFRESH => [
                'icon' => 'refresh',
                'alwaysDisabled' => false,
                'options' => ['title' => Az::l('Refresh')],
                'url' => Az::$app->request->url
            ],

        ];

    }

    private function getClientMessages()
    {

        return [
            'invalidCreateNode' => Az::l('Cannot create node. Parent node is not saved or is invalid.'),
            'emptyNode' => Az::l('(new)'),
            'removeNode' => Az::l('Are you sure you want to remove this node?'),
            'nodeRemoved' => Az::l('The node was removed successfully.'),
            'nodeRemoveError' => Az::l('Error while removing the node. Please try again later.'),
            'nodeNewMove' => Az::l('Cannot move this node as the node details are not saved yet.'),
            'nodeTop' => Az::l('Already at top-most node in the hierarchy.'),
            'nodeBottom' => Az::l('Already at bottom-most node in the hierarchy.'),
            'nodeLeft' => Az::l('Already at left-most node in the hierarchy.'),
            'nodeRight' => Az::l('Already at right-most node in the hierarchy.'),
            'emptyNodeRemoved' => Az::l('The untitled node was removed.'),
            'selectNode' => Az::l('Select a node by clicking on one of the tree items.'),
        ];

    }


}
