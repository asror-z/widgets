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

namespace zetsoft\widgets\inputes;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZGrapeCardWidget extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '/render/inputes/ZFileInputWidget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<b>Title</b>',
    ];

    public $config = [];
    public $_config = [
        'grapes' => true,
        'title' => '',
        'price' => '',
        'lists' => ['first', 'second', 'later'],
        'buttonText' => '',
        'buttonClass' => ZGrapeCardWidget::buttonClass['primary'],
        'icon' => '',
        'buttonSize' => ZGrapeCardWidget::buttonSize['lg'],
        'shadowSize' => ZGrapeCardWidget::shadowSize['sm'],
        'headerColor' => ZGrapeCardWidget::headerColor['primary'],
        'cardBorder' => '',
        'cardBorderRadius' => '',
        'borderColor' => '',
        'animationClass' => ZGrapeCardWidget::animationClass['notAnimation'],
        'cardClass' => ''
    ];
    
    public const animationClass = [
       'transition' => 'transition',
       'only' => 'only',
       'notAnimation' => 'notAnimation',
    ];

    public const buttonClass = [
      'primary' => 'primary',
      'danger' => 'danger',
      'info' => 'info',
      'dark' => 'dark',
      'warning' => 'warning',
    ];

    public const headerColor = [
        'primary' => 'primary',
        'danger' => 'danger',
        'info' => 'info',
        'dark' => 'dark',
        'warning' => 'warning',
    ];

    public const buttonSize = [
      'lg' => 'lg',
      'md' => 'md',
      'sm' => 'sm',
      'block' => 'block',
    ];

    public const shadowSize = [
      'sm' => 'sm',
      'lg' => 'lg',
    ];
    
    public $branch = [];
    public $_branch = [
        'widget' => [
            'title',
            'price',
            'lists',
            'buttonText',
            'buttonClass',
            'icon',
            'buttonSize',
            'shadowSize',
            'headerColor',
            'cardBorder',
            'cardBorderRadius',
            'borderColor',
            'animationClass',
            'cardClass'
        ],
    ];
    public $branchLabel = [];
    public $_branchLabel = [
        'widget' => Azl . 'Опции Card'
    ];


    public $event = [];
    public $_event = [

    ];

    
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="card-deck mb-3 text-center {cardClass}">
            <div class="card mb-4 shadow-{shadowSize} {animationClass}" style="border: {cardBorder}px solid {borderColor};border-radius: {cardBorderRadius}px;">
              <div class="card-header bg-{headerColor}">
                <h4 class="my-0 font-weight-normal">{title}</h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">$ {price} <small class="text-muted">/ mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                  {lists}
                </ul>
                <button type="button" class="btn btn-{buttonSize} btn-outline-{buttonClass}"><i class="fal {icon} mr-2 ml-2"></i>{buttonText}</button>
              </div>
        </div>
HTML,

        'css' => <<<CSS
          .only:hover {
            margin-top: 50px;
            transition: all ease 1s;
          }
          
          .card {
            transition: all ease 0.5s;
          }
          
          .transition:hover {
            margin-top: 20px;
            transition: all ease 0.3s;
          }
      
CSS,
        'lists' => <<<HTML
          <li>{list}</li>
HTML,
        
        'js' => <<<JS
    
JS,
    ];

    public function asset()
    {



    }

    public function codes()
    {

        $lists = '';
        foreach ($this->_config['lists'] as $value) {
            $lists .= strtr($this->_layout['lists'], [
                '{list}' => $value
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{title}' => $this->_config['title'],
            '{lists}' => $lists,
            '{price}' => $this->_config['price'],
            '{buttonText}' => $this->_config['buttonText'],
            '{buttonClass}' => $this->_config['buttonClass'],
            '{icon}' => $this->_config['icon'],
            '{buttonSize}' => $this->_config['buttonSize'],
            '{shadowSize}' => $this->_config['shadowSize'],
            '{headerColor}' => $this->_config['headerColor'],
            '{cardBorder}' => $this->_config['cardBorder'],
            '{cardBorderRadius}' => $this->_config['cardBorderRadius'],
            '{borderColor}' => $this->_config['borderColor'],
            '{animationClass}' => $this->_config['animationClass'],
            '{cardClass}' => $this->_config['cardClass'],
        ]);

        $this->js = strtr($this->_layout['js'], [

        ]);
        
        $this->css = strtr($this->_layout['css'], [

        ]);
        
    }
}
