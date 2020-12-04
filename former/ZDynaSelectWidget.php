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
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZDynaSelectWidget extends ZWidget
{
    public $config = [];
    public $_config = [

        

        'text' => '',
        'title' => '',
        'btnType' => ZButtonWidget::btnType['button'],
        'icon' => '',
        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
        'class' => 'sampleCoreInput',
        'url' => '#',
        'btnUrl' => '#',
        'message' => null,
        'hasIcon' => true,
        'buttonId' => 'id',
        'timeout' => 4000,
        'modelClassName' => '',
        'failMessage' => 'Элемент не выбран.'
    ];
    public $event = [];
    public $_event = [
        'ajaxSuccess' => <<<JS
    function () {
        
    }
JS,
        'confirmSuccess' => <<<JS
    function (event) {
        if (event === true) {
            {ajaxCode}
        }
    }
JS
    ];


    public $layout = [];
    public $_layout = [
        'confirm' => <<<JS
    function () {
    
    var radioKeys = [];
    
    $('.radio-{modelClassName}').each(function (index) {
        
        if ($(this).prop('checked')) {
            radioKeys.push($(this).val());
        }
        
    });

    var checkKeys = [];
    
    $('.checkbox-{modelClassName}').each(function (index) {
        
        if ($(this).prop('checked')) {
            checkKeys.push($(this).val());
        }
        
    });
    
    if (radioKeys.length < 1 && checkKeys.length < 1) {
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
                    //window.location.href = '{btnUrl}';
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
    $.ajax({
        type: "POST",
        url: '{url}',
        data: {
            checkKeys: checkKeys,
            radioKeys: radioKeys,
            modelClassName: '{modelClassName}'
        },
        timeout: {timeout},
        success: {ajaxSuccess}
    });
JS,
    ];

    public function codes()
    {

        $ajaxCode = strtr($this->_layout['ajaxCode'], [
            '{url}' => $this->_config['url'],
            '{ajaxSuccess}' => strtr($this->_event['ajaxSuccess'], [
                '{btnUrl}' => $this->_config['btnUrl']
            ]),
            '{timeout}' => $this->_config['timeout'],
            '{modelClassName}' => $this->_config['modelClassName']
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
        }
        else {
            $click = strtr($this->_layout['noConfirm'], [
                '{class}' => $this->_config['class'],
                '{ajaxCode}' => $ajaxCode,
                '{failMes}' => $this->_config['failMessage'],
                '{warning}' => Az::l('Предупреждение')
            ]);
        }

        $this->htm = ZButtonWidget::widget([
            'config' => [
                'url' => $this->_config['btnUrl'],
                'isPjax' => true,
                'text' => $this->_config['text'],
                'title' => $this->_config['title'],
                'btnType' => $this->_config['btnType'],
                'btnStyle' => $this->_config['btnStyle'],
                'hasIcon' => $this->_config['hasIcon'],
                'icon' => $this->_config['icon'],
                'cancelLabelText' => 'cancel',
                'confirmLabelText' => 'ok',
            ],
            'event' => [
                'click' => $click
            ]
        ]);
    }
}
