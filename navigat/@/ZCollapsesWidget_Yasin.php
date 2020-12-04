<?php

/**
 *
 *
 * Author:  Obidov Yasin
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;/*bu widgetga temela bu grapesda turipti hozi*/

class ZCollapsesWidget_Yasin extends ZWidget
{
    public $config = [];
    public $_config = [
        'bgColor' => ZCollapsesWidget_Yasin::bgColor['bg-primary-dark'],
        'textColor' => '',
        'content' => '',
        'class' => 'accordion',
        'name' => 'accordion',
        'grapes' => true,

    ];
    public const bgColor = [
        'bg-primary' => 'bg-primary',
        'bg-primary-dark' => 'bg-primary-dark',
        'bg-secondary' => 'bg-secondary',
    ];

    public function asset()
    {



    }

    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
        <div class="panel-group wrap" id="accordion-wrap-{id}" role="tablist" aria-multiselectable="true" '   {readonly}>

            <div class="panel">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion-wrap-{id}" href="#accordion-{id}" aria-expanded="true" aria-controls="collapseOne">
                            {title}
                        </a>
                    </h4>
                </div>
                <div id="accordion-{id}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="accordion-{id}">
                    <div class="panel-body">
                        {content}
                    </div>
                </div>
            </div>
            <!-- end of panel -->

        </div>
HTML,
        'css' => <<<CSS

        .wrap {
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
            border-radius: 4px;
            margin: 20px 0;
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

        .panel-title a {
            display: block;
            color: #fff;
            padding: 15px;
            position: relative;
            font-size: 16px;
            font-weight: 400;
        }

        .panel-body {
            background: #fff;
            padding: 10px;
            padding-top: 0;
            transition: all 0.3s ease;
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

        .panel-heading a:before {
            content: '\e146';
            position: absolute;
            font-family: 'Material Icons';
            right: -68px;
            top: 10px;
            font-size: 24px;
            transition: all 0.5s;
            transform: scale(1);
        }

        .panel-heading.active a:before {
            content: ' ';
            transition: all 0.5s;
            transform: scale(0);
        }

        #bs-collapse .panel-heading a:after {
            content: ' ';
            font-size: 24px;
            position: absolute;
            font-family: 'Material Icons';
            right: 5px;
            top: 10px;
            transform: scale(0);
            transition: all 0.5s;
        }

        #bs-collapse .panel-heading.active a:after {
            content: '\e909';
            transform: scale(1);
            transition: all 0.5s;
        }
        /* #accordion rotate icon option */

       

        #accordion-wrap-{id} .panel-heading.active a:before {
            transform: rotate(0deg);
            transition: all 0.5s;
        }
        
        .panel-collapse {
            border: solid #009688 2px;
        
        }
      
CSS,
        'js' => <<<JS
              $(document).ready(function() {
               $('.collapse.in').prev('.panel-heading').addClass('active');
               $('#accordion-wrap-{id}, #bs-collapse')
                   .on('show.bs.collapse', function (event) {
                       $(e.target).prev('.panel-heading').addClass('active');
                   })
           });
JS,
    ];


    public function codes()
    {
        $this->htm = strtr($this->_layout['item'], [
            '{class}' => $this->_config['class'],
            '{content}' => $this->_config['content'],
            '{title}' => $this->_config['title'],
            '{id}' => $this->id,
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
            '{\'{readonly}\' => $this->_config[\'readonly\'] ? \'readonly\' : \'\',type}' => $this->_config['type'],
        ]);
        $this->css = strtr($this->_layout['css'], [
            '{id}' => $this->id,

        ]);
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->jscode($this->_config['class']),
            '{id}' => $this->id,

        ]);


    }
}
