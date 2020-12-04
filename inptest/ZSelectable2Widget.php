<?php

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

namespace zetsoft\widgets\inptest;
use yii\helpers\Json;
use yii\web\JsExpression;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZSelectableBoxWidget
 * @package common\blocker
 *
 * Docs
 * https://mobius1.github.io/Selectable/index.html
 */

class ZSelectable2Widget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'items' => [],
        'containerClass' => 'ul',
        'itemTag' => 'li',
        'itemClass' => 'ui-selectable',
        'selectableVar' => 'selectable',
        'appendTo' => 'selectable-container',
        'multiple' => true,
        'lassoSelect' => ZSelectable2Widget::Lasso['lasso select normal'],
        'tolerance' => ZSelectable2Widget::Tolerance['tolerance fit'],
    ];


    /**
     *
     * Constants
     */
    public const Lasso = [
        'lasso select normal' => 'normal',
        'lasso select sequential' => 'sequential',
    ];

    public const Tolerance = [
        'tolerance touch' => 'touch',
        'tolerance fit' => 'fit',
    ];
    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];



    public $eventInit = 'function() {console.log("ZSelectableWidget | eventInit")}';
    public $eventStart = 'function(e, item) {
        console.log("ZSelectableWidget | eventStart");
        if(item !== undefined){
            console.log("item innerHTML: " + item.node.innerHTML);
        }
    }';
    public $eventDrag = 'function(e, coords) {
        console.log("ZSelectableWidget | eventDrag | coords x1: " + coords.x1 + ", x2:" + coords.x2 + ", y1:" + coords.y1 + ", y2: " + coords.y2); 
    }';
    public $eventEnd = 'function(e, selected, unselected) {
        console.log("ZSelectableWidget | eventEnd");
        selected.forEach(function(selectedElement){
            var containerId = selectedElement.node.offsetParent.id;
            var select = $("#" + containerId).find("select");
            var selectedValue = selectedElement.node.dataset.value;
            select.find(\'option[value=\' + selectedValue + \']\').prop("selected", true);
            console.log("selected: " + selectedValue);
        });
        unselected.forEach(function(unselectedElement){
            var containerId = unselectedElement.node.offsetParent.id;
            var select = $("#" + containerId).find("select");
            var unselectedValue = unselectedElement.node.dataset.value;
            select.find(\'option[value=\' + unselectedValue + \']\').prop("selected", false);
            console.log("unselected: " + unselectedValue);
        });                
    }';

    public $eventSelectedItem = 'function(item) { 
        console.log("ZSelectableWidget | eventSelectedItem | item innerHTML: " + item.node.innerHTML); 
    }';

    public $eventDeselectedItem = 'function(item) {
        console.log("ZSelectableWidget | eventDeselectedItem | item innerHTML: " + item.node.innerHTML);
    }';

    public $eventAddedItem = 'function(item) {
        console.log("ZSelectableWidget | eventAddedItem | item innerHTML: " + item.node.innerHTML);
    }';
    public $eventRemovedItem = 'function(item) {
        console.log("ZSelectableWidget | eventRemovedItem | item innerHTML: " + item.node.innerHTML);
    }';
    public $eventEnabled = 'function() {
        console.log("ZSelectableWidget | eventEnabled");
    }';

    public $eventDisabled = 'function() {
        console.log("ZSelectableWidget | eventDisabled")
    }';



    public function asset()
    {

    /*
     *
     *
     * public $baseUrl = Cdn . '/assets/inputs/assets/Selectable';

    public $css = [
        'selectable.css'
    ];

    public $js = [
        'selectable.js',
    ];*/

//        $this->fileJs('/publish/yarner/selectable.js/selectable.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/selectable.js@0.17.4/selectable.js');
    }


    public function codes()
    {
        $this->options = [
            'appendTo' => "#{$this->_config['appendTo']}",
            'autoRefresh' => true,
            'autoScroll' => [
                'threshold' => 0,
                'increment' => 10
            ],
            'classes' => [
                'lasso' => "ui-lasso",
                'selected' => "ui-selected",
                'container' => "ui-container",
                'selecting' => "ui-selecting",
                'selectable' => "ui-selectable",
                'deselecting' => "ui-deselecting"
            ],
            'filter' => ".{$this->_config['itemClass']}",
            'ignore' => false,
            'lasso' => [
                'border' => '1px dotted #000',
                'backgroundColor' => 'rgba(52, 152, 219, 0.2)',
            ],
            'lassoSelect' => "{$this->_config['lassoSelect']}",
            'maxSelectable' => false,
            'saveState' => false,
            'throttle' => 50,
            'toggle' => false,
            'tolerance' => "{$this->_config['tolerance']}",
            'keys' => ['shiftKey', 'ctrlKey', 'metaKey', ""],
        ];


$this->htm = <<<HTML
        <ul id="items1">
HTML;

    foreach($this->_config['items'] as $key => $item) :

    if($key % 5 === 0) {
       $this->htm .= <<<HTML

HTML;


    }
        $this->htm .= <<<HTML
         
    <li class="item">$item</li>

HTML;
    endforeach;

$this->htm .= <<<HTML
        </ul>
HTML;

    $this->js = <<<JS
        const selectable = new Selectable({
            filter: ".item",
            appendTo: ".items1",
            multiple: false,
        });
JS;



    }

}

