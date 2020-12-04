<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;

use zetsoft\system\kernels\ZWidget;


/**
 * https://github.com/Mobius1/Selectable-Table-Plugin
 * https://cdpn.io/Mobius1/debug/XxBQOa
 *
 */
class ZDatatableWidgetD extends ZWidget
{

    public $config = [];
    public $_config = [
        'headClass' => '',
        'searching' => false,
        'paging' => false,
        'responsive' => true,
    ];


    public $layout = [];
    public $_layout = [


        'js' => <<<JS
     $(document).ready(function() {
            $('#dilshod').DataTable({
                responsive: true,
                searching:  {searching},
                colReorder: true,
                 columnDefs: [
                    { responsivePriority: 1, target: 0 },
                    { responsivePriority: 2, target: -1 }
                ],
                "paging":   {paging},
                "ordering": true,
                "info":     false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ] ,
                fixedColumns:   {
                    leftColumns: 7,
                    
                }
               
        })
      //   .columns.adjust()
    //.responsive.recalc();
     });
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
        $this->fileJs('/render/cards/ZVMarketWidget/asset/main2.js');

        $this->fileJs('https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js');
        $this->fileJs('https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js');
        $this->fileJs('https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js');
        $this->fileJs('https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js');
        $this->fileJs('https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js');

        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css');
        $this->fileCss('https://cdn.datatables.net/1.10.21/css/dataTables.uikit.min.css');
        $this->fileCss('https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css');
        $this->fileCss('https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css');
        $this->fileCss('https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css');
    }

    public function codes()
    {
        $this->model->configs->readonlyAll = true;
        $this->model->columns();
        $this->htm = ZDynaWidget::widget([
            'model' => $this->model,
            'data' => $this->data,
            'id' => $this->id . '-dataTable',
            'config' => [
                'hasToolbar' => true,
                'pjax' => false,
                'panelTemplate' => "{items}",
                'floatHeader' => false,
                'tableOptions' => [
                    'id' => 'dilshod'
                ],
                'perfectScrollbar' => false,
                'filter' => false,
                'columnBefore' => [
                    'false'
                ],
                'columnAfter' => [
                    'false'
                ]
            ],

        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{paging}' => $this->jscode($this->_config['paging']),
            '{searching}' => $this->jscode($this->_config['searching']),
            '{responsive}' => $this->jscode($this->_config['responsive']),
        ]);
    }
}

