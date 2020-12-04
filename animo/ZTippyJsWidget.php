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


use zetsoft\system\kernels\ZWidget;

class ZTippyJsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'id' => 'ajax-tippy',
        'grapes' => true,
        'class' => '',
        'content' => 'asd123',
        'followCursor' => 'horizontal',
        'image' => [
            'url' => 'https://unsplash.it/200/?random',
            'width' => '200',
            'height' => '200'
        ],

    ];

    public $layout = [];
    public $_layout = [
        'css' => <<<CSS
     #ajax-tippy {
            -webkit-tap-highlight-color: transparent;
            font-family: inherit;
            line-height: 1.15;
            overflow: visible;
            text-transform: none;
            -webkit-appearance: button;
            border: 2px dashed #5183f5;
            will-change: opacity;
            font-size: 16px;
            font-weight: 600;
            padding: 10px 16px;
            border-radius: 4px;
            transition: background 0.2s, color 0.1s;
            outline: 0;
            margin: 5px;
            background: white;
            color: #5183f5;
        }

        #ajax-tippy:hover {
            background: #5183f5;
            color: white;
        }
CSS,

        'main' => <<<HTML
     <button id="{id}">Hover for a new image</button>
<div id="container" class="{class}"></div>
HTML,

        'js' => <<<JS
     tippy('#'+'{id}',{
     content:'{content}',
     onShow:'{image.url}'?function(instance) {
            fetch('{image.url}')
                .then((response) => response.blob())
                .then((blob) => {
                    const url = URL.createObjectURL(blob);
                    const image = new Image();
                    image.width = parseInt('{image.width}');
                    image.height = parseInt('{image.height}');
                    image.style.display = 'block';
                    image.src = url;
                    instance.setContent(image);
                })
        }:function() {}, 
      flipOnUpdate: true,
      followCursor: '{followCursor}', //true,horizontal,vertical
    });

JS,

    ];

    public function asset()
    {
        $this->fileJs('https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js');
        $this->fileJs('https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js');
    }


    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->_config['id'],
            '{class}' => $this->_config['class'],
        ]);

        $this->css = strtr($this->_layout['css'], [
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{content}' => $this->jscode($this->_config['content']),
            '{followCursor}' => $this->jscode($this->_config['followCursor']),
            '{id}' => $this->jscode($this->_config['id']),
            '{image.url}' => $this->jscode($this->_config['image']['url']),
            '{image.width}' => $this->jscode($this->_config['image']['width']),
            '{image.height}' => $this->jscode($this->_config['image']['height']),
        ]);


    }
}
