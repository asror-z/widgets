<?php

/**
 * @author AzimjonToirov
 * Model berilsa uni ajax bn olib kelib jadval korinishida chiqarib beradi
 *
 */

namespace zetsoft\widgets\former;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;


/**
 * https://github.com/Mobius1/Selectable-Table-Plugin
 * https://cdpn.io/Mobius1/debug/XxBQOa
 *
 */
class ZDatatableAjaxWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'ajaxUrl' => '/render/former/ZDatatableWidget/demo/ajax/data/objects_salary',
        'modelClass' => 'User',
    ];

    public $layout = [];
    public $_layout = [
        'mainHtml' => <<<HTML
            
            <table id="{id}" class="display nowrap" style="width:100%; overflow: scroll" >
                <thead>
                    <tr>
                        {tableHeader} 
                    </tr>
                    <tr>
                        
                    </tr>
                </thead>
            </table>
                
HTML,
        'tableHeader' => <<<HTML
            
            <th>{tableHeader}</th>

HTML,


        'mainJs' => <<<JS
           
        $(document).ready(function() {
            $('#{id}').DataTable({
                responsive: true,
                searching:  true,
                colReorder: false,
                 columnDefs: [
                    { responsivePriority: 1, target: 0 },
                    { responsivePriority: 2, target: -1 }
                ],
                "paging":   true,
                "ordering": true,
                "info":     false,
                "ajax": {   
                    "url": "{ajaxUrl}",
                    "data": {
                        modelClass: `{modelClass}`
                    }
                },
                columns: [{data}],
            })
            
        });
           
JS,

        'data' => /** @lang JavaScript */
        <<<JS
        { data: '{attributes}'},
JS,


    ];

    public function asset()
    {
        $this->fileJs('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
        $this->fileJs('https://cdn.datatables.net/1.10.21/js/dataTables.uikit.min.js');
        $this->fileJs('https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js');
        $this->fileJs('https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js');
        $this->fileJs('https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js');
        $this->fileJs('https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css');
        $this->fileCss('https://cdn.datatables.net/1.10.21/css/dataTables.uikit.min.css');
        $this->fileCss('https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css');
        $this->fileCss('https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css');
        $this->fileCss('https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css');
    }

    public function codes()
    {
        $tableHeader = '';
        $bodyValues = '';
        foreach ($this->model->attributes as $attribute => $value) {
            $tableHeader .= strtr($this->_layout['tableHeader'], [
                '{tableHeader}' => $attribute
            ]);

            $bodyValues .= strtr($this->_layout['data'], [
                '{attributes}' => $attribute
            ]);

        }

        $this->htm = strtr($this->_layout['mainHtml'], [
            '{id}' => $this->id,
            '{tableHeader}' => $tableHeader
        ]);

        $this->js = strtr($this->_layout['mainJs'], [
            '{id}' => $this->id,
            '{data}' => $bodyValues,
            '{ajaxUrl}' => $this->_config['ajaxUrl'],
            '{modelClass}' => $this->model->className,
        ]);
    }
}

