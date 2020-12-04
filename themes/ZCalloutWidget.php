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
namespace zetsoft\widgets\themes;


use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;

class ZCalloutWidget  extends ZWidget
{
     public $config = [];
     public $_config = [
          'color' => ZColor::color['white'],
          'type' => ZCalloutWidget::callout['bs-callout-danger'],
          'content' => 'Lorem ipsum',
         'grapes'=>true,
     ];
     public $layout = [];
     public $_layout = [
         'main' => <<<HTML
                  <!-- Card -->
                <div class="card card-cascade {color} {callout}"  '>
                                   
                  <div class="card-body card-body-cascade" {readonly}>
                 {content}
                  </div>
                 
                </div>
        <!-- Card -->
HTML,

     ];


    public const callout = [
        'bs-callout-default' => 'bs-callout-default',
        'bs-callout-primary' => 'bs-callout-primary',
        'bs-callout-success' => 'bs-callout-success',
        'bs-callout-danger' => 'bs-callout-danger',
        'bs-callout-warning' => 'bs-callout-warning',
        'bs-callout-info' => 'bs-callout-info',
    ];

      public function codes()
      {
         

          $this->htm =  strtr($this->_layout['main'],[
               '{color}' => $this->_config['color'],
              '{callout}' => $this->_config['type'],
              '{content}' => $this->_config['content'],
              
              '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
          ]);

          $this->css = <<<CSS
        .bs-callout-default {
            border-left: 5px solid #777;
            
        }
        
        .bs-callout-primary {
            border-left: 5px solid #428bca;
        }
        .bs-callout-success {
            border-left: 5px solid #5cb85c;
        }

        .bs-callout-danger {
            border-left: 5px solid #d9534f;
        }

        .bs-callout-warning {
            border-left: 5px solid #f0ad4e;
        }

        .bs-callout-info {
            border-left: 5px solid #5bc0de;
        }
CSS;


      }


}
