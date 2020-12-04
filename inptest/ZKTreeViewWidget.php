<?php

/**
 * @author NurbekMakhmudov
 */

namespace zetsoft\widgets\inptest;

use yii\web\JsExpression;
use zetsoft\system\kernels\ZWidget;
use kartik\tree\TreeViewInput;
use kartik\tree\TreeView;

/**
 * Class ZKTreeViewWidget
 * @package widgets\inputes
 * http://demos.krajee.com/tree-manager#tree-view-input
 *
 */
class ZKTreeViewWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'bAsDropdown' => true,
        'multiple' => true,
        'bFontAwesome' => false,
        'aRootOptions' => [],
        'sQuery' => '',
        'readonly' => true,
        'value' => '',
        'aHeadingOptions' => [],
        'isShowToolbar' => false,
        'placeholder' => 'Your placeholder ...'
    ];

    /**
     * @var string Plugin Events
     * http://demos.krajee.com/tree-manager#tree-view-input
     */

    public $event = [];
    public $_event = [
        'change' => 'function(event, key, name) { console.log("treeview:change"); }',
        'beforeselect' => 'function(event, key, jqXHR, settings) { console.log("treeview:beforeselect");}',
        'selected' => 'function(event, key, jqXHR, settings) { console.log("treeviewWidget | eventSelected");}',
        'selecterror' => 'function(event, key, jqXHR, settings) { console.log("treeviewWidget | eventSelecterror");}',
        'selectajaxerror' => 'function(event, key, jqXHR, textStatus, errorThrown) { console.log("treeviewWidget | eventSelectajaxerror");}',
        'selectcomplete' => 'function(event, jqXHR) { console.log("treeviewWidget | eventSelectcomplete");}',
        'beforeremove' => 'function(event, key, jqXHR, settings) { console.log("treeviewWidget | eventBeforeremove");}',
        'remove' => 'function(event, key, data, textStatus, jqXHR) { console.log("treeview:remove");}',
        'removeerror' => 'function(event, key, data, textStatus, jqXHR) { console.log("treeview:remove error");}',
        'removeajaxerror' => 'function(event, key, jqXHR, textStatus, errorThrown) { console.log("treeview:eventRemoveajaxerror");}',
        'removecomplete' => 'function(event, jqXHR) { console.log("treeview | eventRemovecomplete");}',
        'beforemove' => 'function(event, dir, keyFrom, keyTo, jqXHR, settings) { console.log("treeview:eventBeforemove");}',
        'move' => 'function(event, dir, keyFrom, keyTo, data, textStatus, jqXHR) { console.log("treeview:EventMove");}',
        'moveerror' => 'function(event, dir, keyFrom, keyTo, data, textStatus, jqXHR) { console.log("treeview:eventMoveerror");}',
        'moveajaxerror' => 'function(event, dir, keyFrom, keyTo, jqXHR, textStatus, errorThrown) { console.log("treeview:eventMoveajaxerror");}',
        'movecomplete' => 'function(event, jqXHR) { console.log("treeview:$eventMovecomplete");}',
        'create' => 'function(event, parent) { console.log("treeview:create");}',
        'createroot' => 'function(event) { console.log("treeview:createroot");}',
        'expand' => 'function(event, nodeKey) { console.log("treeview:expand");}',
        'collapse' => 'function(event, key) { console.log("treeview:cllapse");}',
        'expandall' => 'function(event) { console.log(\'treeview:expandall\'); }',
        'collapseall' => 'function(event) { console.log(\'treeview:collapseall\'); }',
        'search' => 'function(event) { console.log(\'treeview:search\'); }',
        'checked' => 'function(event, key) { console.log(\'treeview:checked\'); }',
        'unchecked' =>'function(event, key) { console.log(\'treeview:unchecked\'); }'
    ];

    public function codes()
    {
        $this->options = [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'value' => $this->value,

         //    'sQuery' => $this->_config['sQuery'],
          //  'aHeadingOptions' => [],
          //  'name' => $this->name, // input name
          //  'value' => $this->_config['value'],     // values selected (comma separated for multiple select)

            'asDropdown' => $this->_config['bAsDropdown'],   // will render the tree input widget as a dropdown.
            'dropdownConfig' => [
                'input' => [
                    'placeholder' => $this->_config['placeholder']
                ],
                /**
                 * dropdown Html attributes
                 */
                'dropdown' => [],
                'options' => [],
                'caret' => '<div class="kv-carets">
                    <span class="caret kv-dn"></span>
                    <span class="caret kv-up"></span>
                </div>'
            ],

            'multiple' => $this->_config['multiple'],     // set to false if you do not need multiple selection
            'fontAwesome' => $this->_config['bFontAwesome'],  // render font awesome icons
          //  'aRootOptions' => $this->_config['aRootOptions'],

            'options' => [
                'id' => $this->id
            ],

            'showToolbar' => $this->_config['isShowToolbar'],
            'pluginEvents' => [
                'treeview:beforeselect' => $this->eventCode('beforeselect'),
                'treeview:selected' => $this->eventCode('selected'),
                'treeview:selecterror' => $this->eventCode('selecterror'),
                'treeview:selectajaxerror' => $this->eventCode('selectajaxerror'),
                'treeview:selectcomplete' => $this->eventCode('selectcomplete'),
                'treeview:beforeremove' => $this->eventCode('beforeremove'),
                'treeview:remove' => $this->eventCode('remove'),
                'treeview:removeerror' => $this->eventCode('removeerror'),
                'treeview:removeajaxerror' => $this->eventCode('removeajaxerror'),
                'treeview:removecomplete' => $this->eventCode('removecomplete'),
                'treeview:beforemove' => $this->eventCode('beforemove'),
                'treeview:move' => $this->eventCode('move'),
                'treeview:moveerror' => $this->eventCode('moveerror'),
                'treeview:moveajaxerror' => $this->eventCode('moveajaxerror'),
                'treeview:movecomplete' => $this->eventCode('movecomplete'),
                'treeview:create' => $this->eventCode('create'),
                'treeview:createroot' => $this->eventCode('createroot'),
                'treeview:expand' => $this->eventCode('expand'),
                'treeview:collapse' => $this->eventCode('collapse'),
                'treeview:expandall' => $this->eventCode('expandall'),
                'treeview:collapseall' => $this->eventCode('collapseall'),
                'treeview:search' => $this->eventCode('search'),
                'treeview:checked' => $this->eventCode('checked'),
                'treeview:unchecked' => $this->eventCode('unchecked'),
                'treeview:change' => $this->eventCode('change'),
            ]
        ];
        $this->htm = TreeView::widget($this->options);
    }

}
