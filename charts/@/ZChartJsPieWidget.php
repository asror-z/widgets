<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\charts;


use zetsoft\system\kernels\ZWidget;

class ZChartJsPieWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'id' => 'chart11'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
     <canvas id="{id}"></canvas>
HTML,


        'js' => <<<JS
   
var ctx = document.getElementById('{id}');
    new Chart(ctx, {
        type: 'doughnut',
        data:  {
            datasets: [{
                data: {dataset},
                backgroundColor:{colors}
            }],
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: {labels}
        },
    });


JS,


    ];


    public $event = [];
    public $_event = [];

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js');
    }

    public function codes()
    {
        $items = $this->data;
        $dataset = [];
        $colors = [];
        $label=[];
        foreach ($items as $item) {
            $dataset[] = $item->amount;
            $colors[] = $item->color;
            $labels[] = $item->status;
        }

        $this->js = strtr($this->_layout['js'], [
            '{dataset}' => json_encode($dataset),
            '{colors}' => json_encode($colors),
            '{labels}' => json_encode($labels),
            '{id}' => $this->_config['id']
        ]);

$this->htm=strtr($this->_layout['main'],[
   '{id}'=>$this->_config['id']
]);

    }


}
