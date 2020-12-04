<?php

namespace zetsoft\widgets\inputes;

use kartik\daterange\DateRangePicker;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;


/**
 * Class ZKDateRangeWidget
 * @package widgets\inputes
 * http://demos.krajee.com/date-range
 * @author NurbekMakhmudov
 */
class ZKDateRangePickerWidgetNodirbekMulti extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => self::type['multi_attr'],
        'delimiter' => '|',

        'opens' => ZKDateRangePickerWidget::open['center'],
        'drops' => ZKDateRangePickerWidget::drop['down'],
        'value' => true,
        'isConvertFormat' => true,
        'isUseWithAddon' => false,
        'isHideInput' => false,
        'isPresetDropdown' => false,
        'isValueStart' => true,
        'isValueEnd' => false,
        'minDate' => 0,
        'maxDate' => '',
        'minYear' => '',
        'maxYear' => 1,
        'isShowWeekNumbers' => true,
        'isShowISOWeekNumbers' => true,
        'isTimePicker' => true,
        'timePickerIncrement' => 0,
        'isTimePicker24Hour' => true,
        'isTimePickerSeconds' => true,
        'rangeStart' => true,
        'rangeEnd' => true,
        'isShowCustomRangeLabel' => true,
        'isAlwaysShowCalendars' => false,
        'isSingleDatePicker' => true,
        'parentEl' => 'body',
        'format' => 'Y-m-d',
        'isMaxSpanDay' => false,
        'isRanges' => true,
        'attributeStart' => 'string_4',
        'attributeEnd' => 'string_5',
        'isAttributeEnd' => false,

    ];

    public const type = [
        'multi_attr' => 'multi_attr',
        'json' => 'json',
        'string' => 'string',
    ];


    /**
     *
     * Constants
     */
    public const open = [
        'left' => 'left',
        'right' => 'right',
        'center' => 'center',
    ];

    public const drop = [
        'up' => 'up',
        'down' => 'down'
    ];

    /**
     * Event Options
     * http://www.daterangepicker.com/#options
     */

    public $event = [];
    public $_event = [
        'hide' => 'function (event) { console.log("daepicker | $eventHide") }',
        'show' => ' console.log("ZKCheckboxX | $eventShow") ',
        'apply' => ' console.log("ZKCheckboxX | $eventApply") ',
        'cancel' => ' console.log("ZKCheckboxX | $eventCancel") ',
        'showCalendar' => ' console.log("ZKCheckboxX | $eventShowCalendar") ',
        'hideCalendar' => ' console.log("ZKCheckboxX | $eventHideCalendar") ',
    ];


    public function codes()
    {
        $this->options = [
            'bsVersion' => $this->bsVersion,
            'callback' => '',
            /*'readonly' => $this->_config['readonly'],*/
            //'value' => $this->_config['placeholder'],
            'autoUpdateOnInit' => false,
            //'placeholder' => $this->_config['placeholder'],
            'hideInput' => $this->_config['isHideInput'],
            //'buttonOptios' => ['class' => 'btn btn-info'],
            'useWithAddon' => $this->_config['isUseWithAddon'],
            'initRangeExpr' => true,
            'presetDropdown' => $this->_config['isPresetDropdown'],
            'convertFormat' => $this->_config['isConvertFormat'],
            'containerTemplate' => '',
            'containerOptions' => [],
            'options' => [

            ],

            'i18n' => [],

            'startAttribute' => $this->_config['attributeStart'],
            'endAttribute' => $this->_config['attributeEnd'],
            'pluginOptions' => [
                //'placeholder' => 'vsdcyu',
                'minDate' => $this->_config['minDate'],
                'maxDate' => $this->_config['maxDate'],
                'maxSpan' => $this->maxSpan(),
                'showDropdowns' => true,
                'minYear' => $this->_config['minYear'],
                'maxYear' => $this->_config['maxYear'],
                'showWeekNumbers' => $this->_config['isShowWeekNumbers'],
                'showISOWeekNumbers' => $this->_config['isShowISOWeekNumbers'],
                'bTimePicker' => $this->_config['isTimePicker'],
                'timePickerIncrement' => $this->_config['timePickerIncrement'],
                'timePicker24Hour' => $this->_config['isTimePicker24Hour'],
                'timePickerSeconds' => $this->_config['isTimePickerSeconds'],
                // 'ranges' => $this->range(),
                'showCustomRangeLabel' => $this->_config['isShowCustomRangeLabel'],
                'alwaysShowCalendars' => $this->_config['isAlwaysShowCalendars'],
                'opens' => $this->_config['opens'],
                'drops' => $this->_config['drops'],
                'locale' => [
                    'format' => $this->_config['format'],
                    'separator' => ',',
                    'applyLabel' => 'Apply',
                    'cancelLabel' => 'Cancel',
                    'fromLabel' => 'Form',
                    'toLabel' => 'To',
                    'customRangeLabel' => 'Custom',
                    'weekLabel' => 'W',
                    'daysOfWeek' => [
                        "Su",
                        "Mo",
                        "Tu",
                        "We",
                        "Th",
                        "Fr",
                        "Sa"
                    ],
                    'monthNames' => [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    'firstDay' => 1
                ]
            ],

            
            'pluginEvents' => $this->eventsAll([
                'show.daterangepicker' => 'show',
                'hide.daterangepicker' => 'hide',
                'apply.daterangepicker' => 'apply',
                'showCalendar.daterangepicker' => 'showCalendar',
                'hideCalendar.daterangepicker' => 'hideCalendar',
                'cancel.daterangepicker' => 'cancel',
            ]),
            'name' => $this->name,
        ];

        if (!empty($this->model)) {
            $this->options['model'] = $this->model;
            $this->options['attribute'] = $this->attribute;
        }
        $this->options['value'] = $this->value();
        $this->options['options'] = [
        ];

        $datePicker = DateRangePicker::widget($this->options);


        switch ($this->_config['type']) {
            case self::type['multi_attr']:

                $this->htm = <<<HTML
        <div class="md-form" >
        {$datePicker}
        </div>
HTML;
                $this->htm = strtr($this->htm, [
                    '{class}' => 'form-control',
                    '{id}' => $this->id,
                    '{placeholder}' => $this->_config['placeholder'],
                ]);

                break;

            case self::type['json']:
                echo 'json';
                break;

            case self::type['string']:
                echo 'string';
                break;
        }
    }


    public function value()
    {

        if ($this->value) {
            return $this->value;
        }

        $this->value = $this->model_generate_value($this->_config['isValueStart'], $this->_config['isValueEnd']);
        if (!empty($this->model)) {
            $start = $this->model->{$this->_config['attributeStart']};
            $end = $this->model->{$this->_config['attributeEnd']};
            $this->value = $this->model_generate_value($start, $end);
        }
        return $this->value;
    }

    private function model_generate_value($valueStart, $valueEnd)
    {
        $start = $valueStart;
        $end = $valueEnd;
        if ($start && $end) {
            return implode('-', [$start, $end]);
        }
        return null;
    }

    private function maxSpan()
    {
        if ($this->_config['isMaxSpanDay']) {
            return ['days' => $this->_config['isMaxSpanDay']];
        }
        return false;

    }

}
