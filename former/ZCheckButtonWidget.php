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
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZCheckButtonWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'ajaxreload' => true,
        'btn' => true,
        'text' => '',
        'title' => '',
        'btnType' => ZButtonWidget::btnType['button'],
        'icon' => '',
        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
        'btnSize' => ZButtonWidget::btnSize['default'],
        'class' => 'sampleCoreInput',
        'url' => 'check',
        'btnUrl' => '#',
        'message' => null,
        'isPjaxConfirm' => true,
        'hasIcon' => true,
        'buttonId' => 'id',
        'comment' => false,
        'timeout' => 4000,
        'modelClassName' => '',
        'failMessage' => 'Элемент не выбран.',
        'attr' => 'name',
        'value' => 'value',
        'redirectUrl' => null,
        'src' => '',
        'img' => '',
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

        //evemt
        'ajaxSuccess' => <<<JS
    function () {
        
    }
JS
    ];


    public $layout = [];
    public $_layout = [
        'confirm' => <<<JS
    function () {
    
    var radioKey = '';
    
    $('.radio-{modelClassName}').each(function (index) {
        
        if ($(this).prop('checked')) {
            radioKey = $(this).val();
        }
        
    });

    var checkKeys = [];
    
    $('.checkbox-{modelClassName}').each(function (index) {
        
        if ($(this).prop('checked')) {
            checkKeys.push($(this).val());
        }
        
    });
    
    var newArray = $.merge(checkKeys, {dataArray});
        
    if (radioKey === '' && checkKeys.length < 1) {
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
            message: '{message}{comment}',
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
        console.log('{attribute}');
    $.ajax({
        type: "POST",
        url: '{url}',
        data: {
            comment: $('#{modelClassName}-comment').val(),
            checkKeys: newArray,
            radioKey: radioKey,
            modelClassName: '{modelClassName}',
            attribute: '{attribute}',
            value: '{value}',
            redirectUrl: '{redirectUrl}',
        },
        timeout: {timeout},
        success:  {ajaxSuccess}
    });
JS,
    ];

    public function codes()
    {

        if ($this->_config['redirectUrl'] === null)
            $this->_config['redirectUrl'] = $this->urlParamStr;
            
        $ajaxCode = strtr($this->_layout['ajaxCode'], [
            '{url}' => $this->_config['url'],
            '{ajaxSuccess}' => $this->eventCode('ajaxSuccess'),
            '{timeout}' => $this->_config['timeout'],
            '{modelClassName}' => $this->modelClassName,
            '{attribute}' => $this->_config['attr'],
            '{value}' => $this->_config['value'],
            '{redirectUrl}' => $this->_config['redirectUrl']
        ]);


        if ($this->_config['message'] === null) {
            $this->_config['message'] = Az::l('Вы уверены ?');
        }
        
        $comment = '';

        if ($this->_config['comment']) {
            $comment = <<<HTML
<br/><input class="w-100" value="" id="{$this->modelClassName}-comment" name="" placeholder="комментарий для удаления">
HTML;
        }
        $className = $this->modelClassName;
        $url = $this->urlArrayStr;
        $userId = $this->userIdentity()->id;
        $sessionKey = "$className-$url-$userId";

        $data = '[]';
        if (!empty($this->sessionGet($sessionKey)))
            $data = $this->sessionGet($sessionKey);

        if ($this->_config['confirm']) {
            $click = strtr($this->_layout['confirm'], [
                '{modelClassName}' => $this->modelClassName,
                '{class}' => $this->_config['class'],
                '{warning}' => Az::l('Предупреждение'),
                '{failMes}' => $this->_config['failMessage'],
                '{message}' => $this->_config['message'],
                '{comment}' => $comment,
                '{ok}' => Az::l('Да'),
                '{cancel}' => Az::l('Нет'),
                '{ajaxCode}' => $ajaxCode,
                '{dataArray}' => $this->jscode($data)
            ]);
        } else {
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
                'isPjax' => $this->_config['isPjaxConfirm'],
                'text' => $this->_config['text'],
                'title' => $this->_config['title'],
                'btnType' => $this->_config['btnType'],
                'btnStyle' => $this->_config['btnStyle'],
                'hasIcon' => $this->_config['hasIcon'],
                'icon' => $this->_config['icon'],
                'class' => $this->_config['class'],
                'cancelLabelText' => 'cancel',
                'confirmLabelText' => 'ok',
                'btnRounded' => false,
                'btn' => $this->_config['btn']
            ],
            'event' => [
                'click' => $click
            ]
        ]);
    }
}
