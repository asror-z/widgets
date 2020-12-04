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

class ZZoomWidgetX extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['featureVertical'],
        'name' => 'Hello!!!',
        /*'currency' => '$',*/
        'price' => '100',
        'price_old' => '70',
        'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'cardImage100x100' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'cardImage650x700' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'categoryName' => 'SMart LEd',
        'isSale' => 'd-none',
    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [

    ];

    /*
     * Constants
     * */
    public const type = [
        'featureHorizontal' => 'featureHorizontal',
        'featureVertical' => 'featureVertical',
        'bestDeals' => 'bestDeals',
        'counterCard' => 'counterCard'
    ];


    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

 
            <div class="xzoom-container">
              <img class="xzoom" src="{src}" xoriginal="{src}" style="width: 387px;">
              <div class="xzoom-thumbs">
                {items}
              </div>
            </div>
     
HTML,


        'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave})
            .on('onload',{onload})
            .on('onclick',{onclick});
            
            

            
            
JS,

        'js' => <<<JS

 jQuery(document).foundation('reflow');
  jQuery(document).ready(function() {
    jQuery('#banner').show().revolution({
      delay:9000,
      startheight:500,
      fullWidth:"on",
      forceFullWidth: "off",
      fullScreen:"off",
      hideBulletsOnMobile: "on",
      hideArrowsOnMobile:"off",
      startWithSlide:0,
      navigationType:"bullet",
      navigationArrows:"solo",

      touchenabled:"on",
      swipe_velocity:"0.7",
      swipe_max_touches:"1",
      swipe_min_touches:"1",
      hideTimerBar: "on",
      lazyLoad:"on",
      parallaxLevels:[7,4,3,2,5,4,3,2,1,0]
    });
  });
 
JS,


        'css' => <<<CSS

     .xzoom{
        z-index: 1000;
     } 
     .xzoom-preview{
        z-index: 10000000;
     }  

CSS,
        'item' => <<<HTML
<a href="{scr}"><img class="xzoom-gallery xactive" width="80" src="{src}" xpreview="{src}" title="The title goes here"></a>
HTML,


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
        $this->fileJs('/render/market/ZZoomWidget/demo/demo_files/jquery.themepunch.tools.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/foundation@4.2.1-1/js/foundation/foundation.js');
        $this->fileJs('/render/market/ZZoomWidget/demo/demo_files/jquery.fancybox.js');
        $this->fileJs('/render/market/ZZoomWidget/demo/demo_files/setup.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.css');
    }

    public function codes(){

        $this->htm = strtr($this->_layout['main'],[
            '{items}' => $this->generateData(),
            '{src}' => $this->data[0]

        ]);

        $this->js = strtr($this->_layout['js'],[



        ]);

        $this->css = $this->_layout['css'];

      

    }
}
