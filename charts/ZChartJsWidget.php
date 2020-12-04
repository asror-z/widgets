<?php

namespace zetsoft\widgets\charts;

use phpDocumentor\Reflection\Types\Self_;
use zetsoft\former\chart\ChartForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use Fusonic\Linq\Linq;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use function Spatie\SslCertificate\length;


/**
 *
 *
 * Author:  FozilZayniddinov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZChartJsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['line'],
        'label' => Azl . '',
        'data' => '5, 2, 3, 4, 12, 7, 5, 6 , 4, 8, 5, 6',
        'title' => 'Объем продаж',
        'beginAtZero' => false,
        'color' => 'rgba(51, 119, 255, .6)',
        'dataLabel' => ['0', '1', '2', '3', '4', '5', '6','7', '8', '9', '10', '11'],
        'colors' => self::colors['#3355ff'],
    ];
    public $provider = null;
    public const type = [
        'line' => 'line',
        'bar' => 'bar',
        'pie' => 'pie',
        'radar' => 'radar',
        'doughnut' => 'doughnut',
        'polarArea' => 'polarArea',
        'bubble' => 'bubble'
    ];

    public const colors = [
      '#f38b4a' => '#f38b4a',
      '#56d798' => '#56d798',
      '#ff8397' => '#ff8397',
      '#69f0d5' => '#69f0d5',
      '#ffff97' => '#ffff97',
      '#6970ff' => '#6970ff',
      '#3355ff' => '#3355ff',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

        <canvas id="{id}" class="bg-white"></canvas>
HTML,


        'js' => <<<JS
 var ctx = document.getElementById('{id}').getContext('2d');
    var myChart = new Chart(ctx, {
        type: '{line}',
        data: {
            labels: {dataLabel},
            datasets: [{
                label: '# of Votes',
                data: [{data}],
                fill: false,
                backgroundColor: '{colors}',
                borderColor: [
                    'rgba(51, 119, 255, 1)'
                ],
                borderWidth: 2
            },
                {
                    label: '{label}',
                    data: [{data}],
                    fill: false,
                    borderColor: [
                        'rgba(51, 119, 255, .6)'
                    ],
                    borderWidth: 2
                }
            ]
        },
        options: {
            legend: {
            display: false
    },
            title: {
            display: true,
            text: '{title}'
        },
            scales: {
                xAxes: [{
                    stacked: true,
                    ticks: {
                        beginAtZero: '{beginAtZero}'
                    },
                    gridLines:{
                        display: false,
                        color: "#FFFFFF"
                    },
                }],
                yAxes: [{
                    stacked: true,
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            gridLines:{
               display: false,
                color: "#FFFFFF"
            },
            animation: {
                duration: 3000
            }
        }
    });
JS,
    ];
    public $event = [];
    public $_event = [

    ];

    public function asset()
    {

            $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js');
            $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js');
    }


    public function codes()
    {

        $this->htm = strtr($this->_layout['main'],[
            '{id}' => $this->id
        ]);
        $this->js = strtr($this->_layout['js'],[
         '{id}' => $this->id,
         '{line}' => $this->_config['type'],
         '{label}' => $this->_config['label'],
         '{data}' => $this->_config['data'],
         '{color}' => $this->_config['color'],
         '{title}' => $this->_config['title'],
         '{beginAtZero}' => $this->_config['beginAtZero'],
         '{dataLabel}' => $this->jscode($this->_config['dataLabel']),
         '{colors}' => $this->jscode($this->_config['colors'])
        ]);

    }
}
