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

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\former\ZArrayWidget;
use zetsoft\former\eyuf\EyufProgramForm;

class  ZExportBtnWidgetCheck extends ZWidget
{

    public $config = [];
    public $_config = [
        'configs' => [],
        'action' => 'export',
        'modelClassName' => 'Document',
        'btnSize' => '',
        'exportWidth' => '200',
        'class' => '',
        'btnIcons' => [
            'html' => 'text-info fas fa-file-alt',
            'csv' => 'text-primary fas fa-file-code',
            'txt' => 'text-muted far fa-file-alt',
            'pdf' => 'text-danger far fa-file-pdf',
            'xls' => 'text-success far fa-file-excel',
            'xlsx' => 'text-success far fa-file-excel',
            'json' => 'text-warning far fa-file-code',

        ]
    ];

    public $layout = [];
    public $_layout = [
        'exportBtn' => <<<HTML
    <div class="btn-group">
         <input type="submit" id="submit" class="btn btn-transparent {btnSize} dropdown-toggle" title="Экспортировать" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <a class="btn ovr-button btn-transparent hint--top  hint--medium hint--bounce hint--rounded {class}" title="Экспортировать" data-toggle="dropdown" aria-label="Экспортировать" aria-haspopup="true" aria-expanded="false"> <i class="text-muted fas fa-external-link-alt fal fa-file-export"></i></a>        
       
        <div  class="dropdown-menu">
            {json}              
            {xls}
            {xlsx}
        </div>
    </div>  

HTML,

        'css' => <<<CSS

      i.fas.fa-file-export::after{
            display: inline-block;
            margin-left: 6px !important;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }
        .dropdown-menu{
            width: {exportWidth};
        }

CSS,

        'js' => <<<JS
jQuery(document).on('pjax:end', function () {
    $('this').on('click', function (event){
           e.preventDefault(); 
           window.open(this.href, "_blank")
       }) 
    
});
JS,


    ];


    public function codes()
    {


        $exportTypes = [
//            'html' => 'html',
//            'csv' => 'csv',
//            'txt' => 'txt',
//            'pdf' => 'pdf',
            'xls' => 'xls',
            'xlsx' => 'xlsx',
            'json' => '',
            'jsonAll' => '',
        ];

        foreach ($exportTypes as $type => $widgetOptions) {
            $icon = $type;
            $text = $type;
            if ($type === 'jsonAll') {
                $icon = 'json';
                $text = 'общий json';
            }
            $exportTypes[$type] = ZButtonWidget::widget([
                'id' => $this->id,
                'config' => [

                    'hasIcon' => true,
                    //'icon'        => 'text-info fas fa-' . FA::_DOWNLOAD,
                    'icon' => $this->_config['btnIcons'][$icon],
                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                    'text' => strtoupper($text),
                    'btnRounded' => false,

                    'btn' => false,
                    'url' => $this->urlTo([
                            $this->_config[paramAction],
                            'configs' => $this->_config['configs'],
                            'modelClassName' => $this->_config['modelClassName']
                        ]) . '&exportType=' . ucfirst($type),

                    'class' => 'export-full-html dropdown-item'
                ],
                'event' => [
                    'click' => <<<JS
                     function (event){
                        e.preventDefault();
                        window.open(this.href, "_blank")
                     }
JS,
                ],
            ]);
        }


        $this->css = <<<CSS
             i.fas.fa-file-export::after{
                display: inline-block;
                margin-left: 6px !important;
                vertical-align: .255em;
                content: "";
                border-top: .3em solid;
                border-right: .3em solid transparent;
                border-bottom: 0;
                border-left: .3em solid transparent;
            }
            .dropdown-menu{
                width: 250px;
            }

CSS;

        $url = ZUrl::to([
            '/api/core/files/export_U',
            'exportType' => 'JsonAll',
            'nameOn' => $this->model->configs->nameOn
        ]);

        $className = $this->modelClassName;
        $userId = $this->userIdentity()->id;
        $sessionKey = "Checkdyna-$className-$this->urlArrayStr-$userId";

        $this->htm = strtr($this->_layout['exportBtn'], [
            '{action}' =>
                $this->urlTo([
                    $this->_config[paramAction],
                    'modelClassName' => $this->_config['modelClassName'],
                ]),

            '{class}' => $this->_config['class'],
//            '{html}' => $exportTypes['html'],
//            '{txt}' => $exportTypes['txt'],
//            '{csv}' => $exportTypes['csv'],
            '{xls}' => $exportTypes['xls'],
//            '{pdf}' => $exportTypes['pdf'],
            '{xlsx}' => $exportTypes['xlsx'],
            '{json}' => ZGetChecksWidget::widget([
                'model' => $this->model,
                'config' => [
                    'noConfirm' => true,
                    'url' => ZUrl::to([
                        '/api/core/files/export_U',
                        'exportType' => 'json',
                        'nameOn' => $this->model->configs->nameOn
                    ]),
                    'btnOptions' => [
                        'config' => [
                            'hasIcon' => true,
                            'icon' => $this->_config['btnIcons']['json'],
                            'btnRounded' => false,
                            'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                            'text' => strtoupper('json для выделенных'),
                            'class' => 'export-full-html dropdown-item',

                            'btn' => false,
                            'btnType' => ZButtonWidget::btnType['button'],
                            'grapes' => false,
                            'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                            'title' => Az::l('Подборка'),
                            'message' => Az::l('Вы хотите подобрать эти элементы?'),
                        ]
                    ]
                ],
                'event' => [
                    'ajaxComplete' => <<<JS
          function () {
               $('#{$this->modelClassName}_Grid_Reset').click()
               $.ajax({
                   url: '/api/core/dyna/deleteSession.aspx',
                   data: {
                        sessionKey: '{$sessionKey}',
                   }
               })
          }
JS,

                ]
            ]),
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{exportWidth}' => $this->_config['exportWidth']
        ]);

        $this->js = strtr($this->_layout['js'], []);


    }


}
