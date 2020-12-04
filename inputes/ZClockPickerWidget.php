<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Created By :ElnurController Suyunov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\kernels\ZWidget;

class ZClockPickerWidget extends ZWidget
{
    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js');
    }

    public $config = [];
    public $_config = [
        'donetext' => 'Done',
        'placement' => self::placement['bottom'],
        'autoclose' => true,
        'default' => 'now',
        'grapes' => true,

    ];

    public $label = [];
    public $_label = [
        'donetext' => Azl . 'Готовый текст',
        'placement' => Azl . 'Размещение',
        'autoclose' => Azl . 'Автоматическое закрытие',
        'default' => Azl . 'По умолчанию',
    ];


    public $branch = [];
    public $_branch = [
        'widget' => [
            'donetext',
            'placement',
            'autoclose',
            'default',
        ]
    ];

    public $branchLabel = [];
    public $_branchLabel = [
        
    ];

    public $event = [];
    public $_event = [
        'init' => ' console.log("colorpicker initiated"); ',
        'beforeShow' => ' console.log("before show"); ',
        'afterShow' => 'console.log("afterShow"); ',
        'beforeHide' => ' console.log("beforeHide"); ',
        'afterHide' => ' console.log("afterHide"); ',
        'beforeHourSelect' => ' console.log("beforeHourSelect"); ',
        'afterHourSelect' => ' console.log("afterHourSelect"); ',
        'beforeDone' => ' console.log("beforeDone"); ',
        'afterDone' => ' console.log("afterDone"); ',
    ];


    public const placement = [
        'bottom' => 'bottom',
        'top' => 'top',
        'left' => 'left',
        'right' => 'right',

    ];

    public $layout = [];
    public $_layout = [


        'main' => <<<HTML

<div id="{id}" {readonly} class="input-group clockpicker">
    <input type="text" class="form-control" value="{value}" name="{name}">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
</div>


HTML,

        'js' => <<<JS
  $(document).ready(function() {
     $('#{id}').clockpicker({


        donetext: "{donetext}",
        placement : "{placement}",
        align : 'left',
        autoclose : {autoclose},
        vibrate : true,
        fromnow : 0,
        'default' : "{default}",
        init: {init},
        beforeShow: {beforeShow},
        afterShow: {afterShow},
        beforeHide: {beforeHide},
        afterHide: {afterHide},
        beforeHourSelect: {beforeHourSelect},
        afterHourSelect: {afterHourSelect},
        beforeDone: {beforeDone},
        afterDone: {afterDone},

    });
  })

JS,
    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            
            '{name}' => $this->name,
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->jscode($this->id),
            '{donetext}' => $this->jscode($this->_config['donetext']),
            '{placement}' => $this->jscode($this->_config['placement']),
            '{autoclose}' => $this->jscode($this->_config['autoclose']),
            '{default}' => $this->jscode($this->_config['default']),

            /**
             *
             * Events
             */

            '{init}' => $this->eventCode('init'),
            '{beforeShow}' => $this->eventCode('beforeShow'),
            '{afterShow}' => $this->eventCode('afterShow'),
            '{beforeHide}' => $this->eventCode('beforeHide'),
            '{afterHide}' => $this->eventCode('afterHide'),
            '{beforeHourSelect}' => $this->eventCode('beforeHourSelect'),
            '{afterHourSelect}' => $this->eventCode('afterHourSelect'),
            '{beforeDone}' => $this->eventCode('beforeDone'),
            '{afterDone}' => $this->eventCode('afterDone'),

        ]);

    }

}
