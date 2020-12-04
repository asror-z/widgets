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
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\former\ZArrayWidget;
use zetsoft\former\eyuf\EyufProgramForm;

class  ZExportBtnWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'configs' => [],
        'action' => 'export',
        'modelClassName' => 'Document',
        'btnSize' => '',
        'exportWidth' => '200',
        'session' => null,
        'class' => '',
        'btnIcons' => [
            'html' => 'text-info fas fa-file-alt',
            'csv' => 'text-primary fas fa-file-code',
            'txt' => 'text-muted far fa-file-alt',
            'pdf' => 'text-danger far fa-file-pdf',
            'xls' => 'text-success far fa-file-excel',
            'xlsx' => 'text-success far fa-file-excel',
        ]
    ];

    public $layout = [];
    public $_layout = [
        'exportBtn' => <<<HTML
    <div class="btn-group">
         <!--<input type="submit" id="{id}_submit" class="btn  btn-transparent {btnSize} dropdown-toggle" title="Экспортировать" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
         <a class="btn ovr-button btn-transparent hint--top  hint--medium hint--bounce hint--rounded {class}" title="Экспортировать" data-toggle="dropdown" aria-label="Экспортировать" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-upload"></i><i class="fas fa-sort-up"></i></a>        
        <div  class="dropdown-menu">
            {html}       
            {csv}       
            <!--{txt}
            {pdf}-->
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
/*jQuery(document).on('pjax:end', function (event) {
    $(this).on('click', function(e){
           e.preventDefault(); 
           window.open(this.href, "_blank");
       }) 
    
});*/

JS,
    ];


    public function codes()
    {
        $exportTypes = [
            'html' => '',
            'csv' => '',
            'txt' => '',
            'pdf' => '',
            'xls' => '',
            'xlsx' => '',
        ];

        $url = $this->urlArrayStr;

        foreach ($exportTypes as $type => $widgetOptions) {

            $exportTypes[$type] = ZButtonWidget::widget([
                'id' => $this->id,
                'config' => [
                    'hasIcon' => true,
                    'icon' => $this->_config['btnIcons'][$type],
                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                    'text' => strtoupper($type),
                    'btnRounded' => false,
                    'target' => ZButtonWidget::target['_blank'],
                    'btn' => false,
                    'pjax' => false,
                    'url' => $this->urlTo([
                            $this->_config['action'],
                            'configs' => $this->_config['configs'],
                            'type' => $this->_config['type'],
                            'modelClassName' => $this->_config['modelClassName'],
                            'urlArrayStr' => $url,
                        ]) . '&exportType=' . ucfirst($type),

                    'class' => 'export-full-html dropdown-item'
                ],
                'event' => [
                    'click' => <<<JS
                        event.preventDefault(); 
                        window.open(this.href, "_blank");
                     
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

        $this->htm = strtr($this->_layout['exportBtn'], [
            '{id}' => $this->id,
            '{action}' => $this->urlTo([
                $this->_config['action'],
                'modelClassName' => $this->_config['modelClassName'],
            ]),
            '{class}' => $this->_config['class'],
            '{html}' => $exportTypes['html'],
            '{txt}' => $exportTypes['txt'],
            '{csv}' => $exportTypes['csv'],
            '{xls}' => $exportTypes['xls'],
            '{pdf}' => $exportTypes['pdf'],
            '{xlsx}' => $exportTypes['xlsx'],

        ]);

        $this->css = strtr($this->_layout['css'], [
            '{exportWidth}' => $this->_config['exportWidth']
        ]);

        $this->js = strtr($this->_layout['js'], []);


    }


}
