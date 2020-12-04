<?php

namespace zetsoft\widgets\blocks\archive;

use kartik\tree\Module;
use kartik\tree\TreeView;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use zetsoft\models\TreeProduct;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 * CreatedBy: Javohir Abdufattokhov
 *
 * https://demos.krajee.com/tree-manager
 * https://demos.krajee.com/tree-manager-demo/tree-view-input
 */
class ZKTreeViewWidget extends ZWidget {
    /**
     *
     * Configuration
     */
    public $config = [];
    public $_config = [
        'query' => null,
        'displayValue' => 1,        // initial display value
        'emptyNodeMsg' => '',
        'emptyNodeMsgOptions' =>  ['class'=>'kv-node-message'],
        'showIDAttribute' => true,
        'showFormButtons' => true,
        'breadcrumbs' => [
            'depth' => 0,
            'glue' => '&raquo;',
            'activeCss' => 'kv-crumb-active',
            'untitled' => 'untitled',
        ],
        'nodeFormOptions' => [],
        'alertFadeDuration' => 1000,
        'nodeLabel' =>ZKTreeViewWidget::nodeLabel[1],
        'isAdmin' => false,         // optional (toggle to enable admin mode)
        'softDelete' => true,       // defaults to true
        'showCheckbox' => false,
        'multiple' => true,
        'cascadeSelectChildren' => true,
        'cacheSettings' => ZKTreeViewWidget::cacheSetting, // defaults to true
        'showInactive' =>false,
        'fontAwesome' => true,     // optional
        'iconEditSettings' => [],
        'toolbar' => ZKTreeViewWidget::toolbar,
        'toolbarOptions' => [],
        'buttonGroupOptions' => ['class' => 'btn-group-sm'],
        'buttonOptions' => ['class' => 'btn btn-secondary'],
        'buttonIconOptions' => [],
        'showTooltips' => true,
        /*'childNodeIconOptions' => ['class' => 'text-info'],
        'parentNodeIconOptions' => ['class' => 'text-warning'],*/
        'allowNewRoots' => true,
      //  'rootOptions' => ['class' => 'text-primary'],
        'headingOptions' => ZKTreeViewWidget::headingOptions,





    ];

    public const toolbar =[
        TreeView::BTN_CREATE => [
            'icon' => 'plus',
            'alwaysDisabled' => false,
      //      'options' => ['title' => Yii::t('kvtree', 'Add new'), 'disabled' => true]
        ],
        TreeView::BTN_CREATE_ROOT => [
            'icon' => 'tree',
            'alwaysDisabled' => false,
     //       'options' => ['title' => Yii::t('kvtree', 'Add new root')]
        ],
        TreeView::BTN_REMOVE => [
            'icon' => 'trash',
            'alwaysDisabled' => false,
      //      'options' => ['title' => Yii::t('kvtree', 'Delete'), 'disabled' => true]
        ],
        TreeView::BTN_SEPARATOR,
        TreeView::BTN_MOVE_UP => [
            'icon' => 'arrow-up',
            'alwaysDisabled' => false,
      //      'options' => ['title' => Yii::t('kvtree', 'Move Up'), 'disabled' => true]
        ],
        TreeView::BTN_MOVE_DOWN => [
            'icon' => 'arrow-down',
            'alwaysDisabled' => false,
     //       'options' => ['title' => Yii::t('kvtree', 'Move Down'), 'disabled' => true]
        ],
        TreeView::BTN_MOVE_LEFT => [
            'icon' => 'arrow-left',
            'alwaysDisabled' => false,
      //      'options' => ['title' => Yii::t('kvtree', 'Move Left'), 'disabled' => true]
        ],
        TreeView::BTN_MOVE_RIGHT => [
            'icon' => 'arrow-right',
            'alwaysDisabled' => false,
      //      'options' => ['title' => Yii::t('kvtree', 'Move Right'), 'disabled' => true]
        ],
        TreeView::BTN_SEPARATOR,
        TreeView::BTN_REFRESH => [
            'icon' => 'refresh',
            'alwaysDisabled' => false,
     //       'options' => ['title' => Yii::t('kvtree', 'Refresh')],
       //     'url' => Yii::$app->request->url
        ],
    ];
    public const nodeLabel = [
        1 => 'Phones Custom', // original name is Phones
        2 => 'Laptops Custom', // original name is Laptops
    ];


    public const headingOptions = [
        'label' => 'Categories',
    ];

    public const cacheSetting = [
        'enableCache' => true   // defaults to true
    ];

    /**
     *
     * Plugin Events
     *
     */
    public $event = [];
    public $_event = [
        'beforeselect' => ' console.log("ZKTreeViewWidget | $eventBeforeselect")',
        'selected' => ' console.log("ZKTreeViewWidget | $eventSelected")',
        'selecterror' => ' console.log("ZKTreeViewWidget | $eventSelecterror")',
        'selectajaxerror' => ' console.log("ZKTreeViewWidget | $eventSelectajaxerror")',
        'selectcomplete' => ' console.log("ZKTreeViewWidget | $eventSelectcomplete")',
        'beforeremove' => ' console.log("ZKTreeViewWidget | $eventBeforeremove")',
        'remove' => ' console.log("ZKTreeViewWidget | $eventRemove")',
        'removeerror' => ' console.log("ZKTreeViewWidget | $eventRemoveerror")',
        'removeajaxerror' => ' console.log("ZKTreeViewWidget | $eventRemoveajaxerror")',
        'removecomplete' => ' console.log("ZKTreeViewWidget | $eventRemovecomplete")',
        'beforemove' => ' console.log("ZKTreeViewWidget | $eventBeforemove")',
        'move' => ' console.log("ZKTreeViewWidget | $eventMove")',
        'moveerror' => ' console.log("ZKTreeViewWidget | $eventMoveerror")',
        'moveajaxerror' => ' console.log("ZKTreeViewWidget | $eventMoveajaxerror")',
        'movecomplete' => ' console.log("ZKTreeViewWidget | $eventMovecomplete")',
        'create' => ' console.log("ZKTreeViewWidget | $eventCreate")',
        'createroot' => ' console.log("ZKTreeViewWidget | $eventCreateroot")',
        'expand' => ' console.log("ZKTreeViewWidget | $eventExpand")',
        'collapse' => ' console.log("ZKTreeViewWidget | $eventCollapse")',
        'expandall' => ' console.log("ZKTreeViewWidget | $eventExpandall")',
        'collapseall' => ' console.log("ZKTreeViewWidget | $eventCollapseall")',
        'search' => ' console.log("ZKTreeViewWidget | $eventSearch")',
        'checked' => ' console.log("ZKTreeViewWidget | $eventChecked")',
        'change' => ' console.log("ZKTreeViewWidget | $eventChange")',
    ];

    public $layout = [];
    public $_layout = [
    ];

    public function codes()
    {
        $this->options = [
            'query' => $this->_config['query'],
            'displayValue' => $this->_config['displayValue'],        // initial display value
           'emptyNodeMsg' => $this->_config['emptyNodeMsg'],
     /*       'emptyNodeMsgOptions' =>  $this->_config['emptyNodeMsgOptions'],
            'showIDAttribute' => $this->_config['showIDAttribute'],
            'showFormButtons' => $this->_config['showFormButtons'],
            'breadcrumbs' => $this->_config['breadcrumbs'],
            'nodeFormOptions' => $this->_config['nodeFormOptions'],
            'alertFadeDuration' => $this->_config['alertFadeDuration'],
            'nodeLabel' =>$this->_config['nodeLabel'],
            'isAdmin' => $this->_config['isAdmin'],// optional (toggle to enable admin mode)
            'softDelete' => $this->_config['softDelete'],       // defaults to true
            'showCheckbox' =>  $this->_config['showCheckbox'],
            'multiple' =>  $this->_config['multiple'],
            'cascadeSelectChildren' =>  $this->_config['cascadeSelectChildren'],
            'cacheSettings' => $this->_config['cacheSettings'], // defaults to true
            'showInactive' => $this->_config['showInactive'],
            'fontAwesome' => $this->_config['fontAwesome'],     // optional
            'iconEditSettings' =>$this->_config['iconEditSettings'],
            'toolbar' => $this->_config['toolbar'],
            'toolbarOptions' => $this->_config['toolbarOptions'],
            'buttonGroupOptions' => $this->_config['buttonGroupOptions'],
            'buttonOptions' => $this->_config['buttonOptions'],
            'buttonIconOptions' =>  $this->_config['buttonIconOptions'],
            'showTooltips' => true,
            /*'childNodeIconOptions' => ['class' => 'text-info'],
            'parentNodeIconOptions' => ['class' => 'text-warning'],*/
            'allowNewRoots' => true,
            //'rootOptions' => ['class' => 'text-primary'],
            'headingOptions' => ZKTreeViewWidget::headingOptions,



        ];

        $this->htm = TreeView::widget($this->options);

    }

}

