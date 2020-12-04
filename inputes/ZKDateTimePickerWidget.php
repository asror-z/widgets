<?php

namespace zetsoft\widgets\inputes;

use phpDocumentor\Reflection\Types\This;
use zetsoft\service\cores\Date;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\DateTimePicker;

/**
 * Class    ZKDateTimePickerWidget
 * @package widgets\inputes
 * http://demos.krajee.com/widget-details/datetimepicker
 *
 * Refactored: Doston Rakhmatov
 */
class ZKDateTimePickerWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'size' => ZKDateTimePickerWidget::size['md'],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'convertFormat' => '',
        'layout' => false,
        'readonly' => false,
        'pickerButton' => '',
        'removeButton' => '',
        'format' => Date::formatDateTimeViceVersa,
        'weekStart' => 0,
        'startDate' => '',
        'endDate' => '',
        'daysOfWeekDisabled' => '',
        'isAutoclose' => true,
        'startView' => 2,
        'class' => 'border'
    ];

    /**
     *
     * Constants
     */
    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
        'xs' => 'xs'
    ];


    /**
     * Events
     * https://www.malot.fr/bootstrap-datetimepicker/#events
     */
    public $event = [];
    public $_event = [
        'show' => 'function (event) { console.log("ZKDateTimePicccker | $eventShow") }',
        'hide' => 'function (event) { console.log("ZKDateTimePicccker | $eventHide") }',
        'clearDate' => 'function (event) { console.log("ZKDateTimePicccker | $eventClearDate") }',
        'changeDate' => 'function (event) { console.log("ZKDateTimePicccker | $eventChangeDate") }',
        'changeYear' => 'function (event) { console.log("ZKDateTimePicccker | $eventChangeYear") }',
        'changeMonth' => 'function (event) { console.log("ZKDateTimePicccker | $eventChangeMonth") }',
    ];


    public function codes()
    {

        /*$getPlace = '';
        if ($this->_config['hasPlace']) {
            $getPlace = strtr($this->layout['place'], [
                '{placeholder}' => $this->_config['placeholder'],
            ]);
        }*/
        
        $this->options = [
            'bsVersion' => $this->bsVersion,
            'language' => Az::$app->language,
            'type' => $this->_config['type'],
            'size' => $this->_config['size'],
            'pickerButton' => $this->_config['pickerButton'],
            'removeButton' => $this->_config['removeButton'],
            'convertFormat' => $this->_config['convertFormat'],
            'disabled' => $this->_config['readonly'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                'placeholder' => ($this->_config['hasPlace']) ? $this->_config['placeholder'] : '',
                'id' => $this->id,
                'class' => $this->_config['class'],

                //  array, the HTML attributes for the widget input tag
            ],
            'layout' => $this->_config['layout'],
            'pluginOptions' => [
                'format' => $this->_config['format'],
                'weekStart' => $this->_config['weekStart'],
                'startDate' => $this->_config['startDate'],
                'endDate' => $this->_config['endDate'],
                'daysOfWeekDisabled' => $this->_config['daysOfWeekDisabled'],
                'autoclose' => $this->_config['isAutoclose'],
                'startView' => 2,
            ],

            'pluginEvents' => $this->eventsAll([
                'show' => 'show',
                'hide' => 'hide',
                'clearDate' => 'clearDate',
                'changeDate' => 'changeDate',
                'changeYear' => 'changeYear',
                'changeMonth' => 'changeMonth',
            ]),
            'buttonOptions' => [
                'class' => 'btn btn-secondary'
            ],
            'name' => $this->name,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'value' => $this->value,
        ];


       
        
        $this->htm = DateTimePicker::widget($this->options);
    }

}
