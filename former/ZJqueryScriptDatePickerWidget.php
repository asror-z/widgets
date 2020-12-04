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

namespace zetsoft\widgets\former;

use kartik\popover\PopoverX;
use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\consts\ZPeriodPickerWidgetConst;

/**
 * Class    ZPeriodPickerWidget
 * @package zetsoft\widgets\inputes
 *
 * https://xdsoft.net/jqplugins/periodpicker/
 */
class ZJqueryScriptDatePickerWidget extends ZWidget
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

        /**
         * <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

         */

        $this->fileCss('https://rawcdn.githack.com/qiuyaofan/datepicker/af09df99da5fcc03adb2d55c99a1aa73e7145dec/css/datepicker.css');

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js');
        $this->fileJs('https://rawcdn.githack.com/qiuyaofan/datepicker/af09df99da5fcc03adb2d55c99a1aa73e7145dec/js/datepicker.all.min.js');
        $this->fileJs('/render/former/ZJqueryScriptDatePickerWidget/demo/js/datepicker.en.js');


    }


    public function codes()
    {
        $start = '';
        $end = '';
        $date = [];
        if ($this->value){
            $date = explode(',', $this->value);
            $start = $date[0];
            $end = $date[1];
        }



        $this->layout = [
            'main' => <<<HTML
         <div id="{id}" class="c-datepicker-date-editor J-datepicker-range mt10">
            <i class="c-datepicker-range__icon kxiconfont icon-clock"></i>
            <input id="{id}-start" placeholder="Start" class="c-datepicker-data-input" value="{start}">
            <span class="c-datepicker-range-separator">-</span>
            <input id="{id}-end" placeholder="End" class="c-datepicker-data-input" value="{end}">
            <input id="{id}-hidden" type="hidden" name="{name}"class="hidden-input">
        </div>

HTML,
            'blocks' => <<<JS
        $(function(){
         $('#{id}').datePicker({
            hasShortcut: true,
            language: 'en',
            min: '2018-01-01 06:00:00',
            max: '2029-04-29 20:59:59',
            isRange: true,
            shortcutOptions: [{
                name: 'Yesterday',
                day: '-1,-1',
                time: '00:00:00,23:59:59'
            },{
                name: 'Last Week',
                day: '-7,0',
                time:'00:00:00,'
            }, {
                name: 'Last Month',
                day: '-30,0',
                time: '00:00:00,'
            }, {
                name: 'Last Three Months',
                day: '-90, 0',
                time: '00:00:00,'
            }],
            hide:function(){
                var a = $('#{id}-start').val();
                var b = $('#{id}-end').val();
                var data = [
                    a,
                    b
                ];
                $('#{id}-hidden').attr('value', data);
                console.log($('#{id}-hidden').val());
            },
            
            
        });
        
         
    });

$('.c-datepicker-button').on('click', function() {
          alert('aaaa');
        });

JS,
            ];

            $this->htm = strtr($this->layout['main'], [
                '{id}' => $this->id,
                '{name}' => $this->name,
                '{start}' => $start,
                '{end}' => $end

            ]);
            $this->js = strtr($this->layout['blocks'],[
                '{id}' => $this->id,

            ]);





    }

}



