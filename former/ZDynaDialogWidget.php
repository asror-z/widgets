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
use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZDynaDialogWidget extends ZWidget
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
        'content' => '',
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

     <form id="status_universe_form" type="post">{widget}</form>
     
HTML,

        'click' => <<<JS
    function () {
    
        var checkKeys = [];
        
        $('.checkbox-ShopOrder').each(function() {
            
            var value = parseInt($(this).val())
        
            if ($(this).prop('checked'))
                checkKeys.push(value)
                
        })   
        
        if (checkKeys.length < 1) {
        
            Swal.fire({
               icon: 'warning',
               title: '{errorTitle}',
            })
            
            return;
        }
        
        Swal.fire({
           title: '{title}',
           html: `{content}`,
           showCloseButton: true,
        }).then((result) => {
          if (result.value) {
              
              var form = $(document).find('#status_universe_form')
              
              $.ajax({
                  type: 'POST',
                  url: '/api/shop/orders/status.aspx?' + form.serialize(),
                  data: {
                      checkKeys: checkKeys,
                      url: '{fullUrl}',                      

                  },
                  success: function(response) {
                       alert(response)
                       return 
                      if (response.error) {
                         alert(response.error) 
                      }
                    
                      $('#{modelClassName}_Grid_Reset').click()
                      $.ajax({
                          url: '/api/core/dyna/deleteSession.aspx',
                          data: {
                               sessionKey: '{sessionKey}',
                          }
                      })
                      
                  }
              })
              
          }
        })
                
    }
JS,

    ];

    public function codes()
    {

        $className = $this->modelClassName;
        $url = $this->urlArrayStr;
        $userId = $this->userIdentity()->id;
        $sessionKey = "Checkdyna-$className-$url-$userId";
        
        $content = strtr($this->_layout['main'], [
            '{widget}' => $this->_config['content'],
        ]);

        $click = strtr($this->_layout['click'], [
            '{content}' => $content,
            '{sessionKey}' => $sessionKey,
            '{fullUrl}' => $this->prelastUrl(),
            '{modelClassName}' => $this->modelClassName,
            '{title}' => Az::l('Выбрать статус'),
            '{errorTitle}' => Az::l('Элементы не выбраны'),
        ]);

        $this->htm = ZButtonWidget::widget([
            'config' => [
                'text' => Az::l('Скопировать по статусу'),
                'isPjax' => true,
                'btnType' => ZButtonWidget::btnType['button'],
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                'btnRounded' => false,
            ],
            'event' => [
                'click' => $click
            ]
        ]);

    }

}
