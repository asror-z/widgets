<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;

use zetsoft\models\shop\ShopOrder;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetRavshan;

class ZIframePanelWidget extends ZWidget
{

    public const type = [
        'create' => 'create',
        'choose' => 'choose',
        'other' => 'other',
        'view' => 'view',
        'update' => 'update',
        'detail' => 'detail',
        'return' => 'return',
    ];

    public const sizeIframe = [
        'xs' => 'xs-iframe',
        'sm' => 'sm-iframe',
        'md' => 'md-iframe',
        'lg' => 'lg-iframe',
        'xl' => 'xl-iframe',
    ];

    public $columns;
    public $config = [];
    public $_config = [
        'theme' => ZDynaWidget::theme['panel-success'],
        'modalId' => 'dynaModal',
        'btnOptions' => [],
        'url' => '',
        'hasIcon' => false,
        'beforeClose' => false,
        'grapes' => false,
        'width' => '1400px',
        'height' => '800px',
        'type' => ZIframeSpaWidget::type['create'],
        'isSession' => false,
        'options' => [],
        'formId' => '',
        'chooseQuery' => null,
        'key' => '',
        'title' => '',
        'defaultTitle' => '',
        'btnText' => '',
        'urlParam' => false,
        'btnClass' => '',
        'isNewRecord' => false,
        'newRecordValues' => [],
        'funcName' => 'dynaSweet',
        'buttonId' => '',
        'src' => '',
        'img' => '',
        'size' => ZIframeSpaWidget::sizeIframe['xl'],
        'getParams' => [],
        'changeSave' => 0,
    ];


    public $layout = [];
    public $_layout = [

        'js' => <<<JS

JS,


        'click' => <<<JS

    function () {
        {funcName}()
    }
    
JS,


        'isNewClick' => <<<JS
    
        function() {
          
            $.ajax({
                url: '{newUrl}',
                success: function() {
                    //window.dynaReload('{modelClassName}')
                    location.reload()
                }
            })
            
        }
    
JS,

        'cancelClick' => <<<JS
        function() {
          
            Swal.fire({
              title: '{confirmTitle}',
              icon: 'warning',
              showCancelButton: true,          
              confirmButtonText: '{confirmBtn}',
              cancelButtonText: '{cancelBtn}',
            }).then((result) => {
              if (result.value) {
                window.parent.closeSweet()
              }
            })
          
            
        }
JS,

        'cancelClickAuto' => <<<JS
        //start | DavlatovRavshan | 10.10.2020

        function(jsPanel) {
            
            if (jsPanel.isClosed === true) {
                return true
            }
            
            Swal.fire({
               title: '{confirmTitle}',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: '{confirmBtn}',
               cancelButtonText: '{cancelBtn}',
            }).then((result) => {
              if (result.value) {
                
                var iframe = document.getElementById('jsPanel-dyna-create-iframe')
                var url_string = iframe.contentWindow.document.location.href;
                var url = new URL(url_string);
                var id = url.searchParams.get('id');
                
                $.ajax({
                    type: 'GET',
                    url: '{cancelUrl}',
                    data: {
                        modelId: id,
                    },
                    success: function() {
                        jsPanel.isClosed = true
                        jsPanel.close()
                    }
                })
                
              }
              
            })
            
        }
JS,
        //end|DavlatovRavshan|2020.10.10

        //start|DavlatovRavshan|2020.10.10
        'emptyUrl' => '{url}?id={key}&spa={spa}&modelClassName={modelClassName}&action={action}',

        'url' => '{url}&id={key}&spa={spa}&modelClassName={modelClassName}&action={action}',
        //end|DavlatovRavshan|2020.10.10
        'css' => <<<CSS
    .swal2-container {
        z-index: 999999!important;
    }
CSS,


    ];

    public function codes()
    {

        $strtr = [
            '{url}' => $this->_config['url'],
            '{action}' => $this->urlArrayStr,
            '{key}' => $this->_config['key'],
            '{spa}' => 1,
            '{modelClassName}' => $this->modelClassName,
        ];

        $url = strtr($this->_layout['emptyUrl'], $strtr);
        if (ZStringHelper::find($this->_config['url'], '?')) {
            $url = strtr($this->_layout['url'], $strtr);
        }

        //start | DavlatovRavshan | 10.10.2020
        $userid = $this->userIdentity()->id;
        $class = $this->modelClassName;
        $action = str_replace(end($this->urlArray), 'create', $this->urlArrayStr);

        $closeClick = strtr($this->_layout['cancelClickAuto'], [
            '{cancelUrl}' => ZUrl::to([
                '/api/core/dyna/cancel',
                'modelName' => $this->modelClassName,
                'modelId' => ZArrayHelper::getValue($this->model, 'id'),
                'fullWebId' => $this->urlArrayStr,
                'sessionKey' => "Cancel-$class-$action-$userid",
                'isNew' => $this->jscode(true),
            ]),
            '{type}' => $this->_config['type'],
            '{cancelBtn}' => Az::l('Отмена'),
            '{confirmBtn}' => Az::l('Да'),
            '{confirmTitle}' => Az::l('Вы уверены что хотите Отменить действия?'),
            '{confirmText}' => Az::l('Все ваши действия будут отменены'),
        ]);

        $event = [];
        if ($this->model->configs->changeSave === true && $this->_config['beforeClose'])
            $event = [
                'onbeforeclose' => $closeClick
            ];


        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-dyna-create',
            'config' => [
                'title' => $this->_config['title'],
                'iframeSrc' => $url,
                'iframeId' => $this->_config['funcName'],
                'funcName' => $this->_config['funcName'],
                'width' => $this->_config['width'],
                'height' => $this->_config['height'],
            ],
            'event' => $event
        ]);
        //start | DavlatovRavshan | 10.10.2020

        $click = strtr($this->_layout['click'], [
            '{funcName}' => $this->jscode($this->_config['funcName']),
            '{modelName}' => $this->modelClassName,
        ]);

        if ($this->_config['isNewRecord'])
            $click = strtr($this->_layout['isNewClick'], [
                '{modelClassName}' => $this->modelClassName,
                '{newUrl}' => ZUrl::to([
                    '/api/core/dyna/record',
                    'modelClassName' => $this->modelClassName,
                    'newRecordValues' => $this->_config['newRecordValues']
                ])
            ]);

        $btnOptions = ZArrayHelper::merge($this->_config['btnOptions'], [
            'event' => [
                'click' => $click
            ],
        ]);

        $this->htm = ZButtonWidget::widget($btnOptions);
        $this->css = strtr($this->_layout['css'], []);
        $this->js = strtr($this->_layout['js'], []);
    }

}
