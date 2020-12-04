<?php

/**
 *
 * @author: Umid Muminov
 *
 */

namespace zetsoft\widgets\former;

use Nette\Utils\Json;
use zetsoft\dbitem\core\ExportItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class  ZExportWidget extends ZWidget
{
    public $provider = null;

    public $config = [];
    public $_config = [
        'configs' => [],
        'action' => 'export',
        'url' => '',
        'ajaxData' => [],
        'type' => 'model',
    ];

    public const btnIcons = [
        'html' => 'text-info fas fa-file-alt',
        'csv' => 'text-primary fas fa-file-code',
        'txt' => 'text-muted far fa-file-alt',
        'pdf' => 'text-danger far fa-file-pdf',
        'xls' => 'text-success far fa-file-excel',
        'xlsx' => 'text-success far fa-file-excel',
        'json' => 'text-warning far fa-file-code',
    ];

    public $layout = [];
    public $_layout = [
        'exportBtn' => <<<HTML
    <div class="btn-group">
    
     <a class="btn ovr-button btn-transparent hint--top  hint--medium hint--bounce hint--rounded {class}" data-toggle="dropdown" aria-label="Экспорт">
          <i class="text-muted fas fa-download"></i>
          <i class="fas fa-caret-down"></i>
     </a>        
       
     <div  class="dropdown-menu">
         {exports}
     </div>
     
</div>  

HTML,

        'click' => <<<JS
function () {
       
    //start|DavlatovRavshan|2020.10.10
    function sendAjax(checks = null) {
      
        $.ajax({
            type: 'POST',
            url: '{url}',
            data: {
                checkKeys: checks,
                action: '{action}',
                method: '{method}',
                modelClassName: '{modelClassName}',
                type: '{type}',
            }
        })
        
    }  
       
    var checkKeys;
          
    $.ajax({
        type: 'GET',
        url: '/api/core/dyna/getChecks.aspx?sessionKey={sessionKey}',
        success: function(response) {
            checkKeys = response;
            if (!checkKeys) {
                bootbox.confirm({
                   title: '{messageTitle}',
                   message: '{message}',
                   buttons: {
                       confirm: {
                           label: '{confirm}'
                       },
                       cancel: {
                           label: '{cancel}'
                       }
                   },
                   callback: function (result) {
                       if (result) {
                          sendAjax(checkKeys)
                       }
                   }
                });
                
            } else {
                sendAjax(checkKeys)
            }
        }
    })
    //end | DavlatovRavshan | 10.10.2020
    
       
 }

JS,
    ];


    public function codes()
    {
        //start|DavlatovRavshan|2020.10.10

        $className = $this->modelClassName;
        $url = $this->urlArrayStr;
        $userId = $this->userIdentity()->id;
        $sessionKey = "Checkdyna-$className-$url-$userId";

        $exports = '';
        /** @var ExportItem $exportItem */
        foreach ($this->data as $exportItem) {

            $exports .= ZButtonWidget::widget([
                'config' => [
                    'hasIcon' => true,
                    'class' => 'export-full-html dropdown-item exportBtns ' . $exportItem->class,
                    'icon' => $exportItem->icon,
                    'text' => $exportItem->title,
                    'btnRounded' => false,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                    'btn' => false,
                    'btnType' => ZButtonWidget::btnType['button'],
                    'grapes' => false,
                    'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                ],
                'event' => [
                    'click' => strtr($this->_layout['click'], [
                        '{messageTitle}' => Az::l('Подтверждение'),
                        '{message}' => Az::l('Вы хотите экспортировать все данные?'),
                        '{confirm}' => Az::l('Да'),
                        '{cancel}' => Az::l('Отмена'),
                        '{url}' => $exportItem->url . '.aspx',
                        '{modelClassName}' => $this->modelClassName,
                        '{method}' => $exportItem->method,
                        '{sessionKey}' => $sessionKey,
                        '{action}' => $url,
                        '{type}' => $this->_config['type'],
                    ])
                ]
            ]);

        }

        $this->htm = strtr($this->_layout['exportBtn'], [
            '{class}' => $this->_config['class'],
            '{exports}' => $exports,
        ]);
        //end | DavlatovRavshan | 10.10.2020


    }


}
