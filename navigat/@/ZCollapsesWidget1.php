<?php

/**
 *
 *
 * Author:  Obidov Yasin
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZCollapsesWidget1 extends ZWidget
{
    public $config = [];
    public $_config = [
        //'bgColor' => ZCollapsesWidget1 ::bgColor['bg-primary-dark'],
        'textColor' => '',
        'content' => 'Lorem',
        'title' => 'Accordion',
        'grapes' => true,

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

    public function asset()
    {


        
    }

    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
            <div class="panel-group wrap" id="{id}" role="tablist" aria-multiselectable="true"  {readonly}>
                <div class="panel {class}">
                    <div class="panel-heading " role="tab" id="{id}">
                        <h4 class="panel-title">
                            <a role="button" class="accordion" data-toggle="collapse" data-parent="#{id}" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                {title}
                            </a>
                        </h4>
                    </div>
                    <div id="{id}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                          {content}
                    </div>
                </div>
            </div>
            <!-- end of panel -->
            </div>

HTML,
        'css' => <<<CSS

        .panel-group {
            margin: 0; 
        }
        .wrap {
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
            border-radius: 4px;
        }

        .accordion:focus,
        .accordion:hover,
        .accordion:active {
            outline: 0;
            text-decoration: none;
        }

        .panel {
            border-width: 0 0 1px 0;
            border-style: solid;
            border-color: #fff;
            background: none;
            box-shadow: none;
        }

        .panel:last-child {
            border-bottom: none;
        }

        .panel-group > .panel:first-child .panel-heading {
            border-radius: 4px 4px 0 0;
        }

        .panel-group .panel {
            border-radius: 0;
        }

        .panel-group .panel + .panel {
            margin-top: 0;
        }

        .panel-heading {
            background-color: #009688;
            border-radius: 0;
            border: none;
            color: #fff;
            padding: 0;
        }

        .panel-title .accordion {
            display: block;
            color: #fff;
            padding: 15px;
            position: relative;
            font-size: 16px;
            font-weight: 400;
        }

        .panel-body {
            padding: 0 10px 10px;
            background: #fff;
        }

        .panel:last-child .panel-body {
            border-radius: 0 0 4px 4px;
        }

        .panel:last-child .panel-heading {
            border-radius: 0 0 4px 4px;
            transition: border-radius 0.3s linear 0.2s;
        }

        .panel:last-child .panel-heading.active {
            border-radius: 0;
            transition: border-radius linear 0s;
        }
        /* #bs-collapse icon scale option */
        .panel-heading .accordion:before {
            content: '\e146';
            position: absolute;
            font-family: 'Material Icons',sans-serif;
            right: -65px;
            top: 10px;
            font-size: 24px;
            transition: all 0.5s;
            transform: scale(1);
        }

        .panel-heading.active .accordion:before {
            content: ' ';
            transition: all 0.5s;
            transform: scale(0);
        }

        #bs-collapse .panel-heading .accordion:after {
            content: ' ';
            font-size: 24px;
            position: absolute;
            font-family: 'Material Icons',sans-serif;
            right: 5px;
            top: 10px;
            transform: scale(0);
            transition: all 0.5s;
        }

        #bs-collapse .panel-heading.active .accordion:after {
            content: '\e909';
            transform: scale(1);
            transition: all 0.5s;
        }
      
CSS,
        'js' => <<<JS
             $(document).ready(function() {
               $('.collapse.in').prev('.panel-heading').addClass('active');
               $(' #{id}, #{id}')
                   .on('show.bs.collapse', function(a) {
                       $(a.target).prev('.panel-heading').addClass('active');
                   })
                   .on('hide.bs.collapse', function(a) {
                       $(a.target).prev('.panel-heading').removeClass('active');
                   });
           });
JS,
    ];


    public function codes()
    {
        $this->htm = strtr($this->_layout['item'], [
            '{class}' => $this->_config['class'],
            '{content}' => $this->_config['content'],
            '{title}' => $this->_config['title'],
            '{id}' =>  $this->id,
            
            '{readonly}'=> $this->_config['readonly']? 'readonly' : '',
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->jscode($this->_config['class']),
            '{id}' => $this->id,
        ]);


    }
}

