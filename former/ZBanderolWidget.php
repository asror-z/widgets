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

class ZBanderolWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'text' => '',
        'isMyArray' => false,
        'checkKeys' => [],
        'radioKeys' => [],
        'checkedKeys' => '',
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
        'btnOptions' => [],
        'confirm' => true
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
    var checks = '{checks}';
    
    $('.checkbox-{modelClassName}').each(function (index) {
        
        if ($(this).prop('checked')) {
            checkKeys.push($(this).val());
        }
        
    });
    
    if (checkKeys.length < 1 && checks !== '')
        checkKeys.push(checks);
    
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
                } else {
                
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
    var checks = '{checks}';
    
    $('.checkbox-{modelClassName}').each(function (index) {
        
        if ($(this).prop('checked')) {
            checkKeys.push($(this).val());
        }
        
    });
                    
    if (radioKeys.length < 1 && checkKeys.length < 1 && {isMyArray} !== 1) {
        
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
        
    var data = {
        checkKeys: checkKeys,
        radioKeys: radioKeys,
        modelClassName: '{modelClassName}',
        fullWebId: '{fullWebId}',
        sessionKey: '{sessionKey}',
        value: value
    };

    $.ajax({
        type: "POST",
        url: '{url}',
        data: data,
        timeout: {timeout},
        success:  function(data) {
            if (data['redirect']) {
                 if ((window.open(data['data'], '_blank')))
                    location.reload()
            } else {
                bootbox.confirm({
                    title: "{weigth_error_title}",
                    message: "{weight_error_message}",
                    callback: function (result) {
                        if (result === true)
                            $('#'+ data['data']).click();
                        $.ajax({
                            type: "POST",
                            url: '/core/word/clear-session.aspx',
                            
                        })
                    }   
                });
            }
    
        },
        complete: {ajaxComplete}
    });
JS,
    ];

    public function codes()
    {

        $userId = $this->userIdentity()->id;
        $sessionKey = "BanderolKeys-$this->modelClassName-$this->urlArrayStr-$userId";

        $ajaxCode = strtr($this->_layout['ajaxCode'], [
            '{url}' => $this->_config['url'],
            '{timeout}' => $this->_config['timeout'],
            '{modelClassName}' => $this->_config['modelClassName'],
            '{fullWebId}' => $this->urlArrayStr,
            '{sessionKey}' => $sessionKey,
            '{attribute}' => $this->_config['attr'],
            '{value}' => $this->_config['value'],
            '{dependId}' => $this->_config['dependId'],
            '{dependAttr}' => $this->_config['dependAttr'],
            '{ajaxComplete}' => $this->eventCode('ajaxComplete'),
            '{weigth_error_title}' => Az::l('Внимание'),
            '{weight_error_message}' => Az::l('Для начала необходимо указать вес заказа')
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
                '{ajaxCode}' => $ajaxCode,
                '{checks}' => $this->_config['checkedKeys']
            ]);
        } else {
            $click = strtr($this->_layout['noConfirm'], [
                '{class}' => $this->_config['class'],
                '{ajaxCode}' => $ajaxCode,
                '{failMes}' => $this->_config['failMessage'],
                '{warning}' => Az::l('Предупреждение'),
                '{modelClassName}' => $this->_config['modelClassName'],
                '{checks}' => $this->_config['checkedKeys']
            ]);
        }

        $btnOptions = ZArrayHelper::merge([
            'id' => $this->id,
            'event' => [
                'click' => $click,
            ],
        ], $this->_config['btnOptions']);

        $this->htm = ZButtonWidget::widget($btnOptions);
    }
}
