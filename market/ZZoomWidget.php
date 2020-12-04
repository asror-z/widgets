<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\market;


use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZZoomWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'position' => self::position['right']
    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [

    ];
    public const position = [
        'fullscreen' => 'fullscreen',
        'lens' => 'lens',
        'inside' => 'inside',
        'bottom' => 'bottom',
        'right' => 'right',
        'left' => 'left',
        'top' => 'top',
        'id' => '#id',
    ];

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="xzoom-container row">
          <img class="xzoom" src="{src}" xoriginal="{src}"">
          <div class="xzoom-thumbs">
            {items}
          </div>
        </div>
HTML,
        'item' => <<<HTML
        <a 
            href="{src}"><img 
            class="xzoom-gallery xactive" 
            width="50" 
            src="{src}" 
            title="The title goes here"
            xpreview="{src}"
        ></a>
HTML,

        'css' => <<<CSS
     .xzoom{
        z-index: 1000;
     } 
     .xzoom-preview{
        z-index: 10000000;
     }  
CSS,

        'js' => <<<JS
        $('.xzoom, .xzoom-gallery').xzoom({
            zoomWidth: 100, 
            title: true, 
            tint: '#333', 
            Xoffset: 15,
            Yoffset: 0,
            position: '{position}', //top, left, right, bottom, inside, lens, fullscreen, #ID
            mposition: 'inside', //inside, fullscreen
            rootOutput: true,
            fadeIn: true,
            fadeTrans: true,
            fadeOut: true,
            smooth: true,
            smoothZoomMove: 3,
            smoothLensMove: 1,
            smoothScale: 6,
            defaultScale: 0, //from -1 to 1, that means -100% till 100% scale
            scroll: true,
            tintOpacity: .8,
            lens: false, //'#color'
            lensOpacity: 0.5,
            lensShape: 'circle', //'box', 'circle'
            zoomHeight: 'auto',
            sourceClass: 'xzoom-source',
            loadingClass: 'xzoom-loading',
            lensClass: 'xzoom-lens',
            zoomClass: 'xzoom-preview',
            activeClass: 'xactive',
            hover: false,
            adaptive: true,
            lensReverse: false,
            adaptiveReverse: false,
            titleClass: 'xzoom-caption',
            bg: true //zoom image output as background
        });
JS,


    ];

    private function generateData(){
        $code = '';
        foreach ($this->data as $value){
            $code .= strtr($this->_layout['item'],[
                '{src}' => $value
            ]);
        }

        return $code;
    }

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.css');
        $this->fileJs('https://raw.githubusercontent.com/payalord/xZoom/master/example/js/setup.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js');
    }

    public function codes(){

        $code = '';
        foreach ($this->data as $value){
            $code .= strtr($this->_layout['item'],[
                '{src}' => $value
            ]);
        }

        $this->htm = strtr($this->_layout['main'],[
            '{items}' => $code,
            '{src}' => ZArrayHelper::getValue($this->data, 0)
        ]);

        $this->css = $this->_layout['css'];
    }
}
