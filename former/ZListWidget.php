<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 * Created by:
 * Refactored: Sherzod Mangliyev
 */

namespace zetsoft\widgets\former;


use zetsoft\system\kernels\ZWidget;


class ZListWidget extends ZWidget
{

    public $config = [];
    public $_config = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

  <div class="list-widget">
    <ul class="list-ul shadow">
       {content} 
    </ul>
    
  </div>       
HTML,

        'content' => <<<HTML

<li class="list-li bg-{bgcolor} {class}" data-item="{data-item}">{getIcon}{text}</li>

HTML,

        'icon' => <<<HTML
     <i class="{icon}"></i>&nbsp;&nbsp;
HTML,


    ];


    public function codes()
    {

        $icon = '';
        if ($this->_config['hasIcon'])
            $icon = strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon']
            ]);


        $content = '';

        foreach ($this->data as $key => $value)
            $content .= strtr($this->_layout['content'], [
                '{text}' => $value,
                '{getIcon}' => $icon,
                '{data-item}' => $key,
                '{class}' => $this->_config['class'],
                '{bgcolor}' => $this->_config['bgcolor'],
            ]);


        $this->htm = strtr($this->_layout['main'], [
            '{content}'  => $content
        ]);


        $this->css = <<<CSS

    .list-ul {
        display: flex;
        list-style: none;
        flex-direction: column;
        text-align: left;
        background: #ffff;
        border: 1px solid #eeeeee;
        min-width: 100px;
        padding: 0;
        margin: 0;
        border-radius: 5px;
        
    }

    .list-li {
        border: 1px solid #eeeeee;
        color: #ffffff;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 500;
    }

    .list-li:last-child {
        border-bottom: none;
    }
    
    .list-li:hover {
        background: #eeeeee;
        color: #ffffff;
        cursor: pointer;
        padding: 10px 20px;
        transition: all 0.2s ease-in-out;
    }
    
CSS;


    }


}
