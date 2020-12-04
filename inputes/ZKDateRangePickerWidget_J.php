<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\daterange\DateRangePicker;
use zetsoft\service\cores\Date;
use yii\helpers\Html;

/**
 * Class ZKDateRangeWidget
 * @package widgets\inputes+
 * http://demos.krajee.com/date-range
 *
 * Refactored: Doston Rakhmatov
 */

class ZKDateRangePickerWidget_J extends ZWidget
{
    public $config = [];
    public $_config = [
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
        'formatDate' => Date::dateTime,
        'isMaxSpanDay' => false,
        'isRanges' => true,
        'attributeStart' => 'created_at',
        'attributeEnd' => 'created_at',
        'isAttributeEnd' => false,

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
        //vdd($this->model);
       //vdd($this->_config['formatDate']);
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
            'convertFormat' => true,
            'containerTemplate' => '',
            'containerOptions' => [],
            'options' => [

            ],

            'i18n' => [],

            /*'startAttribute' => $this->_config['attributeStart'],
            'endAttribute' => $this->_config['attributeEnd'],*/
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
                    'format' => $this->_config['formatDate'],
                    'separator' => '|',
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
      //  $this->option();
        if(!empty($this->model)){
            $this->options['model'] = $this->model;
            $this->options['attribute'] = $this->attribute;
        }
        $this->options['value'] = $this->value();
        $this->options['options'] = [

        ];
          
          //vdd($this->options);
        $datePicker = DateRangePicker::widget($this->options);

        $iconCode = '';
        if($this->_config['hasIcon'])

            $iconCode = <<<HTML
        <i class="{$this->_config['icon']}"></i>
HTML;


        $this->htm = <<<HTML
        <div class="md-form" >
        {$iconCode}
        {$datePicker}
        
</div>
HTML;
        $this->htm = strtr($this->htm, [
                '{class}' => 'form-control',
                '{id}' => $this->id,
                '{placeholder}' => $this->_config['placeholder'],
                /*'{readonly}' => $this->_config['readonly'],*/
            ]);

    }


    public function value() {

        if ($this->value) {
            return $this->value;
        }

        /*$this->value = $this->model_generate_value($this->_config['isValueStart'],$this->_config['isValueEnd']);
        if(!empty($this->model)){
            $start = $this->model->{$this->_config['attributeStart']};
            $end = $this->model->{$this->_config['attributeEnd']};
            $this->value = $this->model_generate_value($start,$end);
        }
        return $this->value;*/
    }

    private function model_generate_value($valueStart,$valueEnd){
        $start = $valueStart;
        $end = $valueEnd;
        if ($start && $end) {
            return implode('-', [$start, $end]);
        }
        return null;
    }

    private function maxSpan() {
        if ($this->_config['isMaxSpanDay']){
            return ['days' => $this->_config['isMaxSpanDay']];
        }
        return false;

    }

}
