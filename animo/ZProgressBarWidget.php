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

namespace zetsoft\widgets\animo;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZProgressBarWidget extends ZWidget

{
    public $config = [];
    public $_config = [

        'items' => [
        ]
    ];
    private $progress_item = [
        'type' => ZProgressBarWidget:: type['md_progress'],
        'isStriped' => true,
        'isAnimated' => false,
        'bgColor' => ZProgressBarWidget::btncolor['btn-success'],
        'width' => '50',
        'label' => 'Label'
    ];
    public const type = [
        'default' => '',
        'md_progress' => 'md-progress',

    ];

    public const btncolor = [

        'btn-primary' => 'btn-primary',
        'btn-secondary' => 'btn-secondary',
        'btn-success' => 'btn-success',
        'btn-danger' => 'btn-danger',
        'btn-warning' => 'btn-warning',
        'btn-info' => 'btn-info',
        'btn-light' => 'btn-light',
        'btn-dark' => 'btn-dark',
        'btn-link' => 'btn-link',
        'peach-gradient' => 'peach-gradient',
        'purple-gradient' => 'purple-gradient',
        'blue-gradient' => 'blue-gradient',
        'aqua-gradient' => 'aqua-gradient',
        'btn-outline-primary' => 'btn-outline-primary waves-effect',
        'btn-outline-secondary' => 'btn-outline-secondary waves-effect',
        'btn-outline-success' => 'btn-outline-success waves-effect',
        'btn-outline-danger' => 'btn-outline-danger waves-effect',
        'btn-outline-warning' => 'btn-outline-warning waves-effect',
        'btn-outline-info' => 'btn-outline-info waves-effect',
        'btn-outline-light' => 'btn-outline-light waves-effect',
        'btn-outline-dark' => 'btn-outline-dark waves-effect',
        'btn-outline-link' => 'btn-outline-link waves-effect',

    ];
    
    public function codes()
    {


        $isStriped = !($this->progress_item['isStriped']) ? $this->jscode('progress-bar-striped') : $this->jscode('');
        $isAnimated = !($this->progress_item['isAnimated']) ? $this->jscode('progress-bar-animated') : $this->jscode('');

        $array = '';

        foreach ($this->_config['items'] as  $key => $item){

            $item = ZArrayHelper::merge($this->progress_item,$item);


            $array .= <<<HTML
            <div class="zprogress_bar">
                <div class="text_progress_bar">
                     <span>{$item['label']}</span>
                     <span style="float: right">{$item['width']}%</span>
                </div>
                <div class="progress {$item['type']} mt-1">
                    
                    <div class="progress-bar {$item['isStriped']} {$item['isAnimated']} {$item['bgColor']}" style="width: {$item['width']}%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>       
                </div>
            </div>
            
HTML;

        }


        $this->htm = <<<HTML
        <div style="width: 100%">
            
                {$array}
        </div>
HTML;

        $this->htm = strtr($this->htm, [
            '{progressType}' => $this->jscode($this->progress_item['type']),

        ]);


    }

}
