<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\kernels\ZWidget;

class ZAccLayWidget_ extends ZWidget
{
    public $config = [];
    public $_config = [
        'bgColor' => ZAccLayWidget::bgColor['bg-primary-dark'],
        'textColor' => '',
        'text' => '',
        'name' => '',
        'icon' => ''
    ];
    public const bgColor = [
        'bg-primary' => 'bg-primary',
        'bg-primary-dark' => 'bg-primary-dark',
        'bg-secondary' => 'bg-secondary',
        'bg-success' => 'bg-success',
        'bg-danger' => 'bg-danger',
        'bg-warning' => 'bg-warning',
        'bg-info' => 'bg-info',
        'bg-light' => 'bg-light',
        'bg-dark' => 'bg-dark',
        'bg-white' => 'bg-white'
    ];

    public const textColor = [
        'text-primary' => 'text-primary',
        'text-secondary' => 'text-secondary',
        'text-success' => 'text-success',
        'text-danger' => 'text-danger',
        'text-warning' => 'text-warning',
        'text-info' => 'text-info',
        'text-light' => 'text-light',
        'text-dark' => 'text-dark',
        'text-white' => 'text-white'
    ];

    public function codes()
    {
        $this->layout = [
            'item' => <<<HTML
             <div class="accordion">
                <div class="card mb-0 {bgColor}">
                    
                    <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                    <i class="{icon} mr-1"></i>
                        <a class="card-title">
                            {name}
                        </a>
                    </div>
                    <div id="collapseOne" class="card-body collapse" data-parent=".accordion" >
                        {text}
                    </div>
                    
                </div>
    </div>
HTML,
        ];

        $this->htm = strtr($this->layout['item'], [
            '{text}' => $this->_config['text'],
            '{name}' => $this->_config['name'],
            '{icon}' => $this->_config['icon'],
            '{bgColor}' => $this->_config['bgColor'],
            '{textColor}' => $this->_config['textColor'],
        ]);

        $this->css = <<<CSS
    .accordion .card-header:after {
    font-family: 'FontAwesome';  
    content: "-";
    float: right; 
    color: white;
    cursor: grab;
}
CSS;
        $this->js = <<<JS
         
JS;
    }
}
