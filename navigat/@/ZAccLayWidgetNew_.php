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

class ZAccLayWidgetNew_ extends ZWidget
{
    public $config = [];
    public $_config = [
        'bgColor' => ZAccLayWidgetNew::bgColor['bg-primary-dark'],
        'textColor' => '',
        'text' => '',
        'name' => 'lorem',
        'icon' => '',
        'class' => 'accordion'
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


    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
             <div class="{class}"{}>
    <div class="accordion-item">
      <span>{name}</span>
      <div class="content">
        {text}
      </div>
    </div>
  </div>
  
HTML,

        'css' => <<<CSS
    *, *:before, *:after {
  -webkit-box-sizing: inherit;
  -moz-box-sizing: inherit;
  box-sizing: inherit;
}

html {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}


.accordion span {
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
  flex-direction: column;
  width: 100%;
  padding: 1rem 3rem 1rem 1rem;
  color: #fff;
  background: #125188;
  font-size: 1.15rem;
  font-weight: 400;
  border: 1px solid #125188;
  border-radius: 6px;
}

.accordion span:hover,
.accordion span:hover::after {
  cursor: pointer;
  color: #fff;
}

.accordion span:hover::after {
  border: 1px solid #fff;
}

.accordion span.active {
  color: #fff;
  border-bottom: 1px solid #fff;
}

.accordion span::after {
  font-family: 'Ionicons';
  content: '+';
  position: absolute;
  float: right;
  right: 1rem;
  font-size: 1rem;
  color: #fff;
  padding: 3px;
  width: 30px;
  height: 30px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  border: 1px solid #fff;
  text-align: center;
}

.accordion span.active::after {
  font-family: 'Ionicons';
  content: '-';
  color: #fff;
  border: 1px solid #fff;
}

.accordion .content {
  display: none;
  padding: 1rem;
  border: 1px solid #125188ff;
  border-radius: 6px;
  overflow: hidden;
}

.accordion .content p {
  font-size: 1rem;
  font-weight: 300;
}
CSS,
        'js' => <<<JS
            $(document).ready(function() {
  $('.{class} span').click(function(){
    $(this).toggleClass('active');
    $(this).next('.content').slideToggle(200);
   });
});
JS,
    ];

    public function asset()
    {
      // $this->fileCss('/render/navigat/ZAccLayWidget/acclay.css');
    }


    public function codes()
    {
            $this->htm = strtr($this->_layout['item'], [
            '{class}' => $this->_config['class'],
            '{text}' => $this->_config['text'],
            '{name}' => $this->_config['name'],
            '{icon}' => $this->_config['icon'],
            '{bgColor}' => $this->_config['bgColor'],
            '{textColor}' => $this->_config['textColor'],
        ]);
        $this->css = strtr($this->_layout['css'],[]);
        $this->js = strtr($this->_layout['js'],[
            '{class}' => $this->jscode($this->_config['class']),
        ]);


    }
}
