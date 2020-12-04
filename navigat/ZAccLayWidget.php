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

use zetsoft\system\kernels\ZWidget;



class ZAccLayWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'bgColor' => ZAccLayWidget::bgColor['bg-primary-dark'],
        'textColor' => '',
        'content' => 'acclay',
        'title' => 'lorem',
        'icon' => '',
        'class' => 'accordion',
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',

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
        $this->fileCss('/render/navigat/ZAccLayWidget/asset/style.css');
    }
    
    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
             <div class="{class}"  {readonly}>
    <div class="accordion-item">
      <div class="accordion-name"><i class="{icon}"></i>{title}</div>
      <div class="content">
        {content}
      </div>
    </div>
  </div>
HTML,
        'css' => <<<CSS



CSS,
        'js' => <<<JS
            
              $('.accordion-name').on('click', function(){
                $(this).toggleClass('active');
                $(this).next('.content').slideToggle(200);
                
              });
JS,
    ];



    public function codes()
    {
        $this->htm = strtr($this->_layout['item'], [
            '{class}' => $this->_config['class'],
            '{content}' => $this->_config['content'],
            '{title}' => $this->_config['title'],
            '{icon}' => $this->_config['icon'],
            '{bgColor}z' => $this->_config['bgColor'],
            '{textColor}' => $this->_config['textColor'],

            '{readonly}'=> $this->_config['readonly']? 'readonly' : '',
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->jscode($this->_config['class']),
        ]);


    }
}
