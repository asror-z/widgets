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

use MatthiasMullie\Minify\JS;
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
class ZPeriodPickerWidgetNew extends ZWidget implements ZPeriodPickerWidgetConst
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
        'timePicker' => false,
        'norange' => false,
        'resizeButton' => false,
        'fullsizeButton' => false,
        'fullsizeOnDblClick' => false,
        'todayButton' => false,
        'hours' => true,
        'minutes' => false,
        'seconds' => false,
        'ampm' => true,
        'saveOnChange' => false,


    ];

    public $event = [];
    public $_event = [
        'onClearButtonClick' => 'console.log("ZPeriodPickerWidget | onClearButtonClick")',
        'onToChanged' => 'function (event){console.log("ZPeriodPickerWidget | onToChanged")}',
        'onToSelected' => 'console.log("ZPeriodPickerWidget | onToSelected")',
        'onFromChanged' => 'console.log("ZPeriodPickerWidget | onFromChanged")',
        'onFromSelected' => 'console.log("ZPeriodPickerWidget | onFromSelected")',
        'onChangePeriod' => 'console.log("ZPeriodPickerWidget | onChangePeriod")',
        'onChange' => 'console.log("ZPeriodPickerWidget | onChange")',
        'onTodayButtonClick' => 'console.log("ZPeriodPickerWidget | onTodayButtonClick")',
        'onOkButtonClick' => 'console.log("ZPeriodPickerWidget | onOkButtonClick")',

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


    public function codes()
    {
        $st1 = "";
        $st2 = "";

        if ($this->value) {
            $st1 = $this->value[0];
            $st2 = $this->value[1];
        }

        $this->layout = [
            'main' => <<<HTML
     <div id="{id}" class="form-control">
         
        <input id="{id}-periodpickerstart" name="{modelClassName}[{attribute}][]" placeholder="{placeholder}" type="text" value="{st1}">
        
        <input id="{id}-periodpickerend" name="{modelClassName}[{attribute}][]" type="text" value="{st2}">
    
     </div>    

HTML,
            'blocks' => <<<JS
    
       $('#{id}-periodpickerstart').periodpicker({
        
            end: '#{id}-periodpickerend',
            formatDate: 'MM/DD/YYYY HH:mm',
            formatDateTime: 'MM/DD/YYYY HH:mm',
            formatDecoreDate: 'MM/DD/YYYY HH:mm',
            formatDecoreDateTime: 'MM/DD/YYYY HH:mm',
            formatDecoreDateWithYear: 'MM/DD/YYYY HH:mm',
            formatDecoreDateTimeWithYear: 'MM/DD/YYYY HH:mm',
            lang: 'en',
            norange: false,
            cells: [1, 2], 
            todayButton: {todayButton},
            resizeButton: {resizeButton},
            fullsizeButton: {fullsizeButton},
            fullsizeOnDblClick: {fullsizeOnDblClick},
            timepicker: {timePicker},
            timepickerOptions: {
                hours: {hours},
                minutes: {minutes},
                seconds: {seconds},
                ampm: {ampm},
                saveOnChange: {saveOnChange}
            },
            onOkButtonClick: {onOkButtonClick},
            onTodayButtonClick: {onTodayButtonClick},
            onChange: {onChange},
            onChangePeriod: {onChangePeriod},
            onFromSelected: {onFromSelected},
            onFromChanged: {onFromChanged},
            onToSelected: {onToSelected},
            onToChanged: {onToChanged},
            onClearButtonClick: {onClearButtonClick},
            
       });

JS,
        ];

        $this->htm = strtr($this->layout['main'], [
            '{id}' => $this->id,
            '{modelClassName}' => $this->modelClassName,
            '{attribute}' => $this->attribute,
            '{placeholder}' => $this->_config['placeholder'],
            '{st1}' => $st1,
            '{st2}' => $st2,

        ]);


        $this->js = strtr($this->layout['blocks'], [
            '{id}' => $this->id,
            '{timePicker}' => $this->_config['timePicker'] ? 'true' : 'false',
            '{norange}' => $this->_config['norange'] ? 'true' : 'false',
            '{resizeButton}' => $this->_config['resizeButton'] ? 'true' : 'false',
            '{fullsizeButton}' => $this->_config['fullsizeButton']? 'true' : 'false',
            '{fullsizeOnDblClick}' => $this->_config['fullsizeOnDblClick'] ? 'true' : 'false',
            '{todayButton}' => $this->_config['todayButton'] ? 'true' : 'false',
            '{hours}' => $this->_config['hours'] ? 'true' : 'false',
            '{minutes}' => $this->_config['minutes'] ? 'true' : 'false',
            '{seconds}' => $this->_config['seconds'] ? 'true' : 'false',
            '{ampm}' => $this->_config['ampm'] ? 'true' : 'false',
            '{saveOnChange}' => $this->_config['saveOnChange'] ? 'true' : 'false',


            /**
             * events
             *
             *
             */
            '{onClearButtonClick}' => $this->eventCode('onClearButtonClick'),
            '{onToChanged}' => $this->eventCode('onToChanged'),
            '{onToSelected}' => $this->eventCode('onToSelected'),
            '{onFromChanged}' => $this->eventCode('onFromChanged'),
            '{onFromSelected}' => $this->eventCode('onFromSelected'),
            '{onChangePeriod}' => $this->eventCode('onChangePeriod'),
            '{onChange}' => $this->eventCode('onChange'),
            '{onTodayButtonClick}' => $this->eventCode('onTodayButtonClick'),
            '{onOkButtonClick}' => $this->eventCode('onOkButtonClick'),


        ]);

    }

}



