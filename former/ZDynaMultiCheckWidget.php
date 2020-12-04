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

class ZDynaMultiCheckWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'noConfirm' => false,
        'btnOptions' => [],
        'url' => ''
    ];

    public $event = [];
    public $_event = [
        'ajaxSuccess' => <<<JS
        function () {
          
        }
JS

    ];


    public $layout = [];
    public $_layout = [

        'confirm' => <<<JS
        
       bootbox.confirm({
           title: "{title}",
           message: '{text}',
           buttons: {
               confirm: {
                   label: '<i class="fa fa-check"></i> {confirmText}'
               },
               cancel: {
                   label: "<i class='fa fa-times'></i> {cancelText}"
               },
               
           },
           callback: function (result) {
                                if (result === true) {
                   {ajaxCode}
               }
           }   
       });
JS,

        'noConfirm' => <<<JS
        
       {ajaxCode}

JS,


        'click' => <<<JS
        function() {
          
            var checkKeys;
          
            $.ajax({
                type: 'GET',
                url: '/api/core/dyna/getChecks.aspx?sessionKey={sessionKey}',
                success: function(response) {
                    
                    checkKeys = response;
                    
                    if (!checkKeys) {
                        bootbox.confirm({
                           title: 'Ошибка',
                           message: 'В данной странице нет выбранных элементов',
                           buttons: {
                               confirm: {
                                   label: '<i class="fa fa-check"></i> OK'
                               },
                               cancel: {
                                   className: 'd-none'
                               }
                           },
                           callback: function (result) {
                               return null
                           }
                        });
                        
                        return null;
                    }    
                    
                    {mainJs}
                    
                }
            })
          
        }
JS,

        'ajax' => <<<JS
       
    $.ajax({
        type: "POST",
        url: '{url}',
        //timeout: 10000, 
        data: {
            checkKeys: checkKeys,
            modelClassName: '{modelClassName}',
            attribute: '{attribute}',
            fullWebId: '{fullWebId}',
        },
        success: {ajaxSuccess},
        complete: function() {
            
        }
    });
    
JS,

    ];

    public function codes()
    {

        $className = $this->modelClassName;
        $url = $this->urlArrayStr;
        $userId = $this->userIdentity()->id;
        $sessionKey = "Checkdyna-$className-$url-$userId";

        $ajaxCode = strtr($this->_layout['ajax'], [
            '{url}' => $this->_config['url'],
            '{ajaxSuccess}' => $this->eventCode('ajaxSuccess'),
            '{sessionKey}' => $this->jscode($sessionKey),
            '{modelClassName}' => $this->modelClassName,
            '{attribute}' => $this->attribute,
            '{fullWebId}' => $this->urlArrayStr
        ]);

        $confirm = strtr($this->_layout['confirm'], [
            '{title}' => Az::l('Подтверждение'),
            '{titleWarn}' => Az::l('Элементы не выбраны'),
            '{text}' => Az::l('Вы уверены?'),
            '{cancelText}' => Az::l('Отмена'),
            '{confirmText}' => Az::l('Да'),
            '{ajaxCode}' => $ajaxCode,
        ]);

        if ($this->_config['noConfirm']) {
            $confirm = strtr($this->_layout['noConfirm'], [
                '{ajaxCode}' => $ajaxCode,
            ]);
        }

        $click = strtr($this->_layout['click'], [
            '{modelClassName}' => $this->modelClassName,
            '{mainJs}' => $confirm,
            '{sessionKey}' => $this->jscode($sessionKey),
            '{titleWarn}' => Az::l('Элементы не выбраны'),
            '{text}' => Az::l('Вы уверены?'),
            '{cancelText}' => Az::l('Отмена'),
            '{confirmText}' => Az::l('Да'),
        ]);
        
        $btnOpts = ZArrayHelper::merge($this->_config['btnOptions'], [
            'event' => [
                'click' => $click
            ]
        ]);

        $this->htm = ZButtonWidget::widget($btnOpts);

    }
}
