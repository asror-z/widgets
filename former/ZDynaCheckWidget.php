<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;


use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZDynaCheckWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'text' => '',
        'btnType' => ZButtonWidget::btnType['button'],
        'class' => 'sampleCoreInput',
        'widgetClass' => ZHInputWidget::class,
        'widgetOptions' => [],
        'btnOptions' => [],
        'url' => null,
        'btnUrl' => '#',
        'message' => null,
        'buttonId' => 'id',
        'timeout' => 4000,
        'modelClassName' => '',
        'inputAttr' => '',
        'attr' => null,
        'value' => null,
        'failMessage' => 'Элемент не выбран.',

    ];
    public $event = [];
    public $_event = [
        'ajaxSuccess' => <<<JS
    function() {
            $('#{modelClassName}_Grid_Reset').click();
        }
JS,
        'confirmSuccess' => <<<JS
    function (event) {
        if (event === true) {
            {ajaxCode}
        }
    }
JS   ,
    'ajaxComplete' => <<<JS
   function () {
          console.log('Ajax complete')
   }
JS

    ];

    public const widget = [
        'select2' => ZKSelect2Widget::class,
        'dropdown' => ZKSelect2Widget::class,
    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="row">
           
             <div class="col-md-10 p-1"> <form id="form-{name}">{widgetClass}</form></div>
            
            <div class="col-2">{button}</div>
              
        </div>
HTML,


        'confirm' => <<<JS
    function () {
    
    var radioKeys = [];
    
    $('.radio-{modelClassName}').each(function (index) {
        
        if ($(this).prop('checked')) {
            radioKeys.push($(this).val());
        }
        
    });
    
    $(document).on('select2:select', '#statusCall', function() {
        var selectedValue = $(this).val();
        console.log(selectedValue);
        console.log('asdadadad');  
    })

    var checkKeys = [];
    
    $('.checkbox-{modelClassName}').each(function (index) {
        
        if ($(this).prop('checked')) {
            checkKeys.push($(this).val());
        }
        
    });
    
    if (radioKeys.length < 1 && checkKeys.length < 1) {
        console.log('nulll')
        bootbox.confirm({
            title: "{warning}",
            message: "{failMes}",
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> OK'
                },
                cancel: {
                    label: 'No',
                    className: 'd-none'
                }
            },
            callback: function (result) {
                if (result === true)
                    return null;
                else
                    console.log(result);
            }
        });
    } else {
        bootbox.confirm({
            title: "{warning}",
            message: "{message}",
            buttons: {
                cancel: {
                    label: "<i class='fa fa-times'></i> {cancel}"
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> {ok}'
                }
            },
            callback: function (result) {
                                if (result === true) {
                    {ajaxCode}
                 //   window.location.href = '{btnUrl}';
                }
            }   
        });
    }
        
}
JS,
        'noConfirm' => <<<JS
    function() {
    
    var keys = '';
    
    $('.{class}').each(function (index) {
        if ($(this).prop("checked")) {
            keys += $(this).val() + "|";
        }
    });
    
    if (keys === "") {
        bootbox.confirm({
            title: "{warning}",
            message: "{failMes}",
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> OK'
                },
                cancel: {
                    label: 'No',
                    className: 'd-none'
                }
            },
            callback: function (result) {
                if (result === true)
                    return null;
                else
                    console.log(result);
            }
        });
    } 
    else {
        {ajaxCode}
    }
    
   
}
JS,
        'ajaxCode' => <<<JS
    var values = {};
    $.each($('#form-{name}').serializeArray(), function (i, field) {
        values['{inputAttr}'] = field.value;
    });
    
    buttonAttr = "{buttonAttr}";
    buttonValue = "{buttonValue}";
    if (buttonAttr !== null && buttonValue !== null)
        values[buttonAttr] = buttonValue; 
     
    $.ajax({
        type: "POST",
        url: '{url}',
        data: {
            value: values,
            checkKeys: checkKeys,
            radioKeys: radioKeys,
            modelClassName: '{modelClassName}',
        },
        timeout: {timeout},
        success: function() {
            $('#{modelClassName}_Grid_Reset').click();
        },
        complete: {ajaxComplete}
    });
JS,
    ];

    public function codes()
    {
        if ($this->_config['url'] === null)
            $this->_config['url'] = ZUrl::to([
                '/api/core/app/check-new',
                'modelClassName' => $this->_config['modelClassName']
            ]);
        $name = $this->_config['modelClassName'] . '_' . $this->id . '_input';
        $success = strtr($this->_event['ajaxSuccess'], [
            '{modelClassName}' => $this->_config['modelClassName'],
        ])  ;
        $ajaxCode = strtr($this->_layout['ajaxCode'], [
            '{url}' => $this->_config['url'],
            '{ajaxSuccess}' => $success,
            '{timeout}' => $this->_config['timeout'],
            '{modelClassName}' => $this->_config['modelClassName'],
            '{name}' => $name,
            '{inputAttr}' =>$this->jscode( $this->_config['inputAttr']),
            '{buttonAttr}' => $this->jscode($this->_config['attr']),
            '{buttonValue}' => $this->jscode($this->_config['value']),
            '{ajaxComplete}' => $this->eventCode('ajaxComplete')
        ]);

        if ($this->_config['message'] === null) {
            $this->_config['message'] = Az::l('Вы уверены ?');
        }

        if ($this->_config['confirm']) {
            $click = strtr($this->_layout['confirm'], [
                '{modelClassName}' => $this->_config['modelClassName'],
                '{class}' => $this->_config['class'],
                '{warning}' => Az::l('Предупреждение'),
                '{failMes}' => $this->_config['failMessage'],
                '{message}' => $this->_config['message'],
                '{ok}' => Az::l('Да'),
                '{cancel}' => Az::l('Нет'),
                '{ajaxCode}' => $ajaxCode
            ]);
        } else {
            $click = strtr($this->_layout['noConfirm'], [
                '{class}' => $this->_config['class'],
                '{ajaxCode}' => $ajaxCode,
                '{failMes}' => $this->_config['failMessage'],
                '{warning}' => Az::l('Предупреждение')
            ]);
        }


        $widgetOptions = ZArrayHelper::merge([
            'name' => $name
        ], $this->_config['widgetOptions']);

        
        $widget = $this->_config['widgetClass']::widget($widgetOptions);


        $btnOptions = [
            'config' => [
                'url' => $this->_config['btnUrl'],
                'isPjax' => true,
                'text' => $this->_config['text'],
                'cancelLabelText' => 'cancel',
                'confirmLabelText' => 'ok',
            ],
            'event' => [
                'click' => $click
            ]
        ];

        $btnOptionsMarged = ZArrayHelper::merge($btnOptions, $this->_config['btnOptions']);

        $this->htm = strtr($this->_layout['main'], [
            '{widgetClass}' => $widget,
            '{button}' => ZButtonWidget::widget($btnOptionsMarged),
            '{name}' => $name,
        ]);

    }
}
