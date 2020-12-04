<?php

namespace zetsoft\widgets\inputes;


use rmrevin\yii\fontawesome\FA;
use zetsoft\service\cores\Date;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\date\DatePicker;


/**
 * Class ZKDatepickerWidget
 * @package widgets\inputes
 * http://demos.krajee.com/widget-details/datepicker
 *
 * Refactored: Doston Rakhmatov
 */
class ZKDatepickerWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'title' => '',
        'name2' => '',
        'value' => '',
        'value2' => true,
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'size' => ZKDatepickerWidget::size['md'],
        'pickerIcon' => 'fas fa-calendar-alt',
        'pickerButton' => [],
        'removeIcon' => 'fal fa-window-close',
        'removeButton' => null,
        'layout' => false,
        'attribute2' => false,
        'options2' => false,
        'separator' => 'to',
        'format' => Date::fbFormatDate,
        'isAssumeNearbyYear' => false,
        'isCalendarWeeks' => false,
        'datesDisabled' => [],
        'daysOfWeekHighlighted' => [],
        'defaulttViewDate' => '',
        'startDate' => null,
        'endDate' => '',
        'maxViewMode' => 4,
        'minViewMode' => 0,
        'isMultidate' => false,
        'startView' => 0,
        'zIndexOffset' => 10000,
        'daysOfWeekDisabled' => [],
        'placeholderDate' => '',
        'disabled' => false,
        'readonly' => false,
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZKDatepickerWidget/image/icon.png',
        'height' => '400px',
        'width' => '500px',
        'name' => Azl . 'Datepicker',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZKDatepickerWidget/image/icon.png"/>',

    ];
    /**
     *
     * Constants
     */
    public const orientation = [
        'auto' => 'auto',
        'left' => 'left',
        'right' => 'right',
        'top' => 'top',
        'bottom' => 'bottom',
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
        'xs' => 'xs'
    ];

    public $event = [];
    public $_event = [
        'hide' => 'function (event) { console.log("daepicker | $eventHide") }',
        'show' => 'function (event) { console.log("daepicker | $eventShow") }',
        'cleardate' => 'function (event) { console.log("daepicker | $eventClearDate") }',
        'changedate' => 'function (event) { console.log("daepicker | $eventChangeDate") }',
        'changeyear' => 'function (event) { console.log("daepicker | $eventChangeYear") }',
        'changemonth' => 'function (event) { console.log("daepicker | $eventChangeMonth") }',
    ];


    /**
     *
     * @throws \Exception
     * @var int
     * $type
     * DatePicker::TYPE_INLINE;
     * DatePicker::TYPE_COMPONENT_PREPEND;
     * DatePicker::TYPE_COMPONENT_APPEND;
     * DatePicker::TYPE_RANGE;
     * DatePicker::TYPE_BUTTON;
     * DatePicker::TYPE_INPUT;
     */


    public function codes()
    {
        if (empty($this->_config['name2']))
            $this->_config['name2'] = "DatePickerName2_{$this->id}";

        $this->options = [
            'name' => $this->name,
            'name2' => $this->_config['name2'],
            /*'model' => $this->model,
            'attribute' => $this->attribute,*/
            'bsVersion' => $this->bsVersion,
            'language' => Az::$app->language,
            'type' => $this->_config['type'],
            'size' => $this->_config['size'],
            'value' => $this->value,
            'value2' => $this->_config['value2'],
            'convertFormat' => false,
            'buttonOptions' => ['class' => 'btn btn-secondary'],
            'pickerIcon' => "<i class='{$this->_config['pickerIcon']}'></i>",

            'pickerButton' => $this->_config['pickerButton'],
            'removeIcon' => "<i class='{$this->_config['removeIcon']}'></i>",
            'removeButton' => $this->_config['removeButton'],
            'disabled' => $this->_config['readonly'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                'id' => $this->id,
                'placeholder' => ($this->_config['hasPlace']) ? $this->_config['placeholder'] : '',
                'class' => $this->_config['class'],
                'autocomplete' => 'off',
            ],
            'layout' => $this->_config['layout'],
            'attribute2' => $this->_config['attribute2'],
            'options2' => $this->_config['options2'],
            'separator' => $this->_config['separator'],
            'pluginOptions' => array(

                'orientation' => ZKDatepickerWidget::orientation['bottom'],
                'autoclose' => true,
                'assumeNearbyYear' => $this->_config['isAssumeNearbyYear'],
                'calendarWeeks' => $this->_config['isCalendarWeeks'],
                //'clearBtn' => true,
                'container' => 'body',
                'datesDisabled' => $this->_config["datesDisabled"],
                'daysOfWeekDisabled' => $this->_config["daysOfWeekDisabled"],
                'daysOfWeekHighlighted' => $this->_config["daysOfWeekHighlighted"],
                //'defaultViewDate' => $this->_config["defaulttViewDate"],
                /**
                 * disableTouchKeyboard
                 * If true, no keyboard will show on mobile devices
                 */
                'disableTouchKeyboard' => true,
                /**
                 * enableOnReadonly
                 * If false the datepicker will not show on a readonly datepicker field.
                 */
                'enableOnReadonly' => true,
                'endDate' => $this->_config['endDate'],
                'forceParse' => true,
                'format' => $this->_config['format'],
                'immediateUpdates' => false,
                /**
                 * inputs A list of inputs to be used in a range picker, which will be attached to the selected element. Allows for explicitly creating a range picker on a non-standard element.
                 */
                //'inputs' => [],
                'keepEmptyValues' => false,
                'keyboardNavigation' => true,
                'language' => Az::$app->language,
                'maxViewMode' => $this->_config['maxViewMode'],
                'minViewMode' => $this->_config["minViewMode"],
                'multidate' => $this->_config["isMultidate"],
                'multidateSeparator' => ',',
                'showOnFocus' => true,
                'startDate' => $this->_config['startDate'],
                'startView' => $this->_config["startView"],
                'showWeekDays' => true,
                'templates' => (object)array(
                    'leftArrow' => '&laquo;',
                    'rightArrow' => '&raquo;'
                ),
                'title' => $this->_config['title'],
                'todayBtn' => false,
                'todayHighlight' => true,
                'toggleActive' => true,

                /**
                 * weekStart
                 * Day of the week start. 0 (Sunday) to 6 (Saturday)
                 */
                'weekStart' => 0,

                'zIndexOffset' => $this->_config['zIndexOffset']

            ),
            'pluginEvents' => $this->eventsAll([
                'show' => 'show',
                'hide' => 'hide',
                'clearDate' => 'clearDate',
                'changeDate' => 'changeDate',
                'changeYear' => 'changeYear',
                'changeMonth' => 'changeMonth',
            ]),
        ];


        $this->htm = DatePicker::widget($this->options);

    }
}
