<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use kartik\sortable\Sortable;
use yii\web\JsExpression;

/**
 * Class ZKSortableKWidget
 * http://demos.krajee.com/sortable
 *
 */
class ZKSortableWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'bHideInput' => false,
        'bConnected' => false,
        'isShowHandle' => true,
        'contentBefore' => '',
        'iMaxItems' => 5,
        'type' => ZKSortableWidget::type['list'],

    ];


    public $label = [];
    public $_label = [
        'bHideInput' => Azl . 'Скрыть элемент',
        'type' => Azl . 'Тип',
    ];


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
            $getIcon = strtr($this->_layout['icon'], [

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

            'sortableOptions' => [

                /**
                 * http://demos.krajee.com/sortable
                 */

                'type' => $this->_config['type'],
                'disabled' => $this->_config['disabled'],
                'showHandle' => $handle,
                'connected' => $this->_config['bConnected'],
                'itemOptions' => [
                    //  array the HTML attributes to be applied to all items
                ],
                'options' => [
                    'id' => $this->id,
                    //control Icons
                    'handleLabel' => '',
                    // array the HTML attributes for the main sortable widget container.
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
                'class' => 'form-control' . ' ' . $this->_config['class'],
                'id' => $this->id,
                'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
                'value' => $this->value
            ]
        ];


        $this->htm = Sortable::widget($this->options);


    }

    private function items()
    {
        $items = [];

        $k = 1;

        foreach ($this->data as $item) {
            $items[$k++] = ['content' => $item];
        }

        return $items;
    }

}
