<?php

namespace zetsoft\widgets\inputes;

use kartik\helpers\Html;
use zetsoft\system\kernels\ZWidget;
use kartik\sortable\Sortable;
use kartik\sortinput\SortableInput;
use yii\web\JsExpression;

/**
 * Class ZKSortableInputKWidget
 * http://demos.krajee.com/sortable-input
 *
 */
class ZKSortableInputWidget extends ZWidget
{

    public $data = [
        'item',
        'item',
        'item',
        'item',
        'item',
    ];
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'bHideInput' => true,
        'bConnected' => true,
        'itemType' => '',
        'isShowHandle' => false,
        'contentBefore' => '',
        'iMaxItems' => 9999,
        'type' => ZKSortableInputWidget::type['list'],

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZKSortableInputWidget/image/icon.png',
        'name' => Azl . 'SortableInput',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZKSortableInputWidget/image/icon.png"/>',

    ];

//    public $label = [];
//    public $_label = [
//        'bHideInput' => Azl . 'Скрыть элемент',
//        'bConnected' => Azl . '',
//        'isShowHandle' => true,
//        'contentBefore' => '',
//        'iMaxItems' => 15,
//        'type' => Azl . 'Тип',
//    ];


    /**
     *
     * Constants
     */


    public const type = [
        'list' => Sortable::TYPE_LIST,
        'grid' => Sortable::TYPE_GRID,
    ];

    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',
        'sortUpdate' => ' console.log("ZKSelect2Widget | $eventSortUpdate") ',
        'sortStart' => ' console.log("ZKSelect2Widget | $eventSortStart") ',
        'sortStop' => ' console.log("ZKSelect2Widget | $eventSortStop") ',
    ];


    /**
     * Plugin Events
     * https://github.com/lukasoppermann/html5sortable
     */

    public $layout = [];
    public $_layout = [
        'icon' => <<<HTML
        <i class="icon-prefix prefix {icon}"></i>
HTML,

    ];

    public function codes()
    {
        $handle = $this->_config['isShowHandle'];
        $getIcon = '';
        if ($this->_config['hasIcon'] == true and $handle == true) {
            $getIcon = $this->htm .= strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon'],
            ]);
        }

        $this->options = [
            'bsVersion' => $this->bsVersion,
            'delimiter' => ',',
            'items' => $this->items(),
            'name' => $this->name,
            'model' => $this->model,
            'value' => $this->value,
            'attribute' => $this->attribute,
            'readonly' => $this->_config['readonly'],

            'sortableOptions' => [

                /**
                 * http://demos.krajee.com/sortable
                 */

                'type' => $this->_config['type'],
                'disabled' => $this->_config['disabled'],
                'showHandle' => $handle,
                'connected' => true,
                'itemOptions' => [
                    'class' => $this->_config['itemType']
                ],
                'options' => [
                    'id' => $this->id,
                    'handleLabel' => '',
                ],
                'pluginOptions' => [
                    /**
                     * https://github.com/lukasoppermann/html5sortable
                     */
                    'forcePlaceholderSize' => true,
                    'acceptFrom' => null,
                    'hoverClass' => false,
                    'maxItems' => $this->_config['iMaxItems'],
                    'copy' => false,
                ],
                /**
                 * https://github.com/lukasoppermann/html5sortable
                 * 
                 */
                'pluginEvents' => $this->eventsAll([
                    'sortstart' => 'sortstart',
                    'sortstop' => 'sortstop',
                    'sortupdate' => 'sortupdate',
                ]),

            ],

            'hideInput' => $this->_config['bHideInput'],
            'options' => [
                'disabled' => $this->_config['disabled'],
                'class' => 'form-control' . ' ' . $this->_config['class'],
                'id' => $this->id,
                'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
                'value' => $this->value,

            ]
        ];

        $this->htm = SortableInput::widget($this->options);

        $this->css = <<<CSS
.sortable-text {
    font-size: 24px;
    font-weight: 400;
}
CSS;


    }

    private function items()
    {
        $items = [];

        $items['placeholder'] = [
            'content' => $this->_config['placeholder'],
            'options' => [
                'class' => 'alert alert-info'
            ],
            'disabled' => true
        ];

        foreach ($this->data as $key => $item)
            $items[$key] = [
                'content' => $item,
                'disabled' => $this->_config['disabled']
            ];

        return $items;


    }


}
