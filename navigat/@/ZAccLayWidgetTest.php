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

class ZAccLayWidgetTest extends ZWidget
{
    public $config = [];
    public $_config = [
        'bgColor' => ZAccLayWidgetTest::bgColor['bg-primary-dark'],
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

        $id = $this ->id;

        $this->layout = [
            'item' => <<<HTML
             
         <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i> What is HTML?</button>									
                </h2>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <p>HTML stands for HyperText Markup Language. HTML is the standard markup language for describing the structure of web pages. <a href="https://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>
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
   .bs-example{
        margin: 20px;
    }
    .accordion .fa{
        margin-right: 0.5rem;
    }
CSS;
        $this->js = <<<JS
           $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
JS;
    }
}
