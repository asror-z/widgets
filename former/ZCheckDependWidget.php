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
use zetsoft\widgets\navigat\ZButtonWidget;

class ZCheckDependWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'text' => '',
        'title' => '',
        'btnType' => ZButtonWidget::btnType['button'],
        'icon' => '',
        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
        'btnSize' => ZButtonWidget::btnSize['default'],
        'class' => 'sampleCoreInput',
        'url' => null,
        'btnUrl' => '#',
        'message' => null,
        'hasIcon' => true,
        'buttonId' => 'id',
        'timeout' => 0,
        'dependId' => null,
        'dependAttr' => null,
        'modelClassName' => '',
        'failMessage' => 'Элемент не выбран.',
        'attr' => 'name',
        'value' => 'value',
        'btnOptions' => []
    ];
    public $event = [];
    public $_event = [

        'confirmSuccess' => <<<JS
    function (event) {
        if (event === true) {
            {ajaxCode}
        }
    }
JS,
    'ajaxComplete' => <<<JS
    function () {
        console.log('AJAX complete')      
    }
JS,

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
    } 
    else {
        {ajaxCode}
    }
}
JS,
        'ajaxCode' => <<<JS
    dependId = '{dependId}';
    dependAttr = '{dependAttr}';
    value = {};
    if (dependId !== '' || dependAttr !== '') {
        
        dependVal = $('#' + dependId).val();
        value[dependAttr] = dependVal;
    }
   
   value['{attribute}'] = '{value}';
   
    $.ajax({
        type: "POST",
        url: '{url}',
        data: {
            checkKeys: checkKeys,
            radioKeys: radioKeys,
            modelClassName: '{modelClassName}',
            value: value
        },
        timeout: {timeout},
        success:  function() {
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
        $ajaxCode = strtr($this->_layout['ajaxCode'], [
            '{url}' => $this->_config['url'],
            '{timeout}' => $this->_config['timeout'],
            '{modelClassName}' => $this->_config['modelClassName'],
            '{attribute}' => $this->_config['attr'],
            '{value}' => $this->_config['value'],
            '{dependId}' => $this->_config['dependId'],
            '{dependAttr}' => $this->_config['dependAttr'],
            '{ajaxComplete}' => $this->eventCode('ajaxComplete'),
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
                '{warning}' => Az::l('Предупреждение'),
                '{modelClassName}' => $this->_config['modelClassName'],
            ]);
        }

        $btnOptions = ZArrayHelper::merge([
            'event' => [
                'click' => $click,
            ],
        ], $this->_config['btnOptions']);

        $this->htm = ZButtonWidget::widget($btnOptions);
    }
}
