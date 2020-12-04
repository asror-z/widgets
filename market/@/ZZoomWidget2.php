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

class ZZoomWidget2 extends ZWidget
{
    public $config = [];
    public $_config = [

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

        'js1' => <<<JS
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48989648-2', 'auto');
  ga('send', 'pageview');
  
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
<a href="{src}"><img class="xzoom-gallery xactive" width="80" src="{src}" title="The title goes here"></a>
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
        $this->fileCss('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.css');
        $this->fileJs('/render/market/ZZoomWidget/demo/demo_files/jquery.themepunch.tools.min.js');
        $this->fileJs('/render/market/ZZoomWidget/demo/demo_files/jquery.themepunch.revolution.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/foundation@4.2.1-1/js/foundation/foundation.js');
        $this->fileJs('/render/market/ZZoomWidget/demo/demo_files/jquery.fancybox.js');
        $this->fileJs('/render/market/ZZoomWidget/demo/demo_files/setup.js');
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
