<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\widgets\consts\ZPeriodPickerWidgetConst;
use yii\bootstrap\Html;
use zetsoft\system\kernels\ZWidget;
use kartik\popover\PopoverX;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Json;

/**
 * Class    ZPeriodPickerWidget
 * @package zetsoft\widgets\inputes
 *
 * https://xdsoft.net/jqplugins/periodpicker/
 */
class ZPeriodPickerSingleWidget extends ZWidget implements ZPeriodPickerWidgetConst
{

    public static $grapes = [
        'enable' => true,
        'icon' => null,
        'image' => null,
        'height' => '500px',
        'width' => '700px',
        'dbType' => null,
        'modalWidth' => null,
        'title' => Azl . null,
        'descs' => Azl . null,
    ];


    public $config = [];
    public $_config = [
        'title' => 'ZCore Interactive Calendar v4',
        'buttonTitle' => 'Получить данные',
        'popType' => '',
        'layout' => 'Layout_6_6',
        'isPop' => true,
        'popIcon' => FA::_CALENDAR,
        'popPlace' => PopoverX::ALIGN_AUTO_RIGHT,
        'popClass' => 'fa-2x',
        'popWidth' => '60%',
        'valueStart' => '',
        'valueEnd' => '',
        'format' => 'unixtime',
        'formatDateTime' => 'YYYY-MM-DD HH:mm:ss',
        'formDate' => 'YYYY-MM-DD',
        'defaultEndTime' => '23:59:59',
        'defaultTime' => '00:00:00',

    ];

    /**
     *
     *
     *  Private Data
     */

    private $_id_Start;
    private $_id_End;
    private $_dates;


    public function asset()
    {
        $this->fileCss('/render/inputes/ZPeriodPickerWidget/assets/PeriodPicker/jquery.periodpicker.css');
        $this->fileJs('/render/inputes/ZPeriodPickerWidget/assets/PeriodPicker/jquery.periodpicker.full.min.js');

    }

    public function option()
    {

        $this->options = [

            'end' => "#{$this->_id_End}",
            'title' => true,
            'yearsLine' => true,
            'clearButtonInButton' => true,
            'clearButton' => true,
            'resizeButton' => true,
            'fullsizeButton' => true,
            'fullsizeOnDblClick' => true,
            'formatDateTime' => $this->_config['formatDateTime'],
            'formatDate' => $this->_config['formDate'],
            'navigate' => true,
            'defaultEndTime' => $this->_config['defaultEndTime'],
            'draggable' => true,
            'mousewheel' => true,
            'format' => $this->_config['format'],
            'reverseMouseWheel' => true,
            'mousewheelYearsLine' => true,
            'lang' => Az::$app->language,
            'timepicker' => true,
            'animation' => true,
            'tabIndex' => true,
            'okButton' => true,
            'timepickerOptions' => [
                'dragAndDrop' => true,
                'mouseWheel' => true,
                'clickAndSelect' => true,
                'inverseMouseWheel' => true,
                //'saveOnChange' => true,
                'twelveHoursFormat' => false,
                'hours' => true,
                'minutes' => true,
                'seconds' => false,
                'ampm' => false,
                'defaultTime' => $this->_config['defaultTime']
            ]

        ];
    }

    public function codes()
    {
        $st1 = null;
        $st2 = null;

        if ($this->value) {
            $st1 = $this->value[0];
            $st2 = $this->value[1];
        }

        $this->layout = [
            'main' => <<<HTML
         <div id="{id}" class="form-control">
         
        <input id="periodpickerstart-{id}" placeholder="{placeholder}"  type="text" value="$st1">
        <input id="periodpickerend-{id}" type="text" value="$st2">
            
        <input name="{modelClassName}[{attribute}][]" type="hidden" value="start  end">
    
</div>    

HTML,
            'blocks' => <<<JS

    $('#periodpickerstart-{id}').periodpicker({
       /* end: '#periodpickerend-{id}',
        norange: false, // use only one value
        cells: [1, 2], // show only one month

        resizeButton: false, // deny resize picker
        fullsizeButton: false,
        fullsizeOnDblClick: false,*/
        /*onOkButtonClick: function () {
             var idStart = $('#periodpickerstart-{id}').val();
             var idEnd = $('#periodpickerend-{id}').val();
             $('#{idStart}').attr('value', idStart);
             $('#{idEnd}').attr('value', idEnd);
        },*/
        /*onTodayButtonClick: function () {
            this.month = 1;
            this.year = 2027;
            this.regenerate();
            return false;
        },
        onChange: function () {
            console.log("ZPeriodPickerWidget | changed");
        },
        onChangePeriod: function () {
            console.log("ZPeriodPickerWidget | period changed");
        },
        onFromSelected: function () {
            console.log("ZPeriodPickerWidget | first period selected");
        },
        onFromChanged: function () {
            console.log("ZPeriodPickerWidget | first period changed");
        },
        onToSelected: function () {
            console.log("ZPeriodPickerWidget | second period selected");
        },
        onToChanged: function () {             
            console.log("ZPeriodPickerWidget | second period changed");
        },
        onClearButtonClick: function () {
        },*/
        /*timepicker: true, // use timepicker
        timepickerOptions: {
            hours: true,
            minutes: true,
            seconds: false,
            ampm: true,
            saveOnChange: true
        }*/
    });
    
JS,
        ];

        $periodNameStart = ZHTML::getInputName($this->model, $this->attribute);
        $periodNameEnd = ZHTML::getInputName($this->model, $this->attribute);
        $periodIdStart = ZHTML::getInputId($this->model, $this->attribute);
        $periodIdEnd = ZHTML::getInputId($this->model, $this->attribute);


        $this->htm = strtr($this->layout['main'], [
            '{modelClassName}' => $this->modelClassName,
            '{attribute}' => $this->attribute,
            '{periodIdStart}' => $periodIdStart,
            '{periodNameStart}' => $periodNameStart,
            '{periodIdEnd}' => $periodIdEnd,
            '{periodNameEnd}' => $periodNameEnd,
            '{id}' => $this->id,
            '{placeholder}' => $this->_config['placeholder']
        ]);


        $this->js = strtr($this->layout['blocks'], [
            '{idStart}' => $periodIdStart,
            '{idEnd}' => $periodIdEnd,
            '{id}' => $this->id,
        ]);

    }

}



