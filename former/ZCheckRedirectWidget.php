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

class ZCheckRedirectWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'ajaxreload' =>true,
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
        'value' => 'value'
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
                   window.location.href = '{url}?id=' + radioKey
                    //window.location.href = '{btnUrl}';
                }
            }   
        });
    }
        
}
JS,
        'noConfirm' => <<<JS
    function() {
    
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
    } 
    else {
        window.location.href = '{url}&id=' + radioKey
    }
}
JS,

    ];

    public function codes()
    {

        if ($this->_config['message'] === null) {
            $this->_config['message'] = Az::l('Вы уверены ?');
        }
        $comment = '';

        if($this->_config['comment']){
            $comment = <<<HTML
<br/><input class="w-100" value="" id="{$this->modelClassName}-comment" name="" placeholder="комментарий для удаления">
HTML;
        }

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
                '{url}' => $this->_config['url']
            ]);
        } else {
            $click = strtr($this->_layout['noConfirm'], [
                '{class}' => $this->_config['class'],
                '{url}' => $this->_config['url'],
                '{failMes}' => $this->_config['failMessage'],
                '{warning}' => Az::l('Предупреждение'),
                '{modelClassName}' => $this->modelClassName,
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
