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

namespace zetsoft\widgets\archive;

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
class ZPeriodPickerWidgetNew2 extends ZWidget implements ZPeriodPickerWidgetConst
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
        $this->fileCss('https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js');

    }


    public function codes()
    {

        $this->layout = [
            'main' => <<<HTML
    <input id="{id}" type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
   

HTML,
            'blocks' => <<<JS
        $('#{id}').daterangepicker({
            "timePicker": true,
            "ranges": {
                "Today": [
                    "2020-08-23T07:35:26.537Z",
                    "2020-08-23T07:35:26.537Z"
                ],
                "Yesterday": [
                    "2020-08-22T07:35:26.537Z",
                    "2020-08-22T07:35:26.537Z"
                ],
                "Last 7 Days": [
                    "2020-08-17T07:35:26.537Z",
                    "2020-08-23T07:35:26.537Z"
                ],
                "Last 30 Days": [
                    "2020-07-25T07:35:26.537Z",
                    "2020-08-23T07:35:26.537Z"
                ],
                "This Month": [
                    "2020-07-31T19:00:00.000Z",
                    "2020-08-31T18:59:59.999Z"
                ],
                "Last Month": [
                    "2020-06-30T19:00:00.000Z",
                    "2020-07-31T18:59:59.999Z"
                ]
            },
            "startDate": "08/17/2020",
            "endDate": "08/23/2020"
        }, function(start, end, label) {
            console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });
   


JS,
        ];




        $this->htm = strtr($this->layout['main'], [
                '{id}' => $this->id
        ]);


        $this->js = strtr($this->layout['blocks'], [
            '{id}' => $this->id

        ]);

    }

}



