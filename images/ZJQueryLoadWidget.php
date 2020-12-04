<?php

namespace zetsoft\widgets\images;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;




class ZJQueryLoadWidget extends ZWidget
{
      /*public $data = [

          'dataAjax' => [
              '/render/images/ZLazySizesWidget/clean/clean1.html',
              '/render/images/ZLazySizesWidget/clean/clean1.html',
              '/render/images/ZLazySizesWidget/clean/clean1.html',
          ],


      ];*/

    /**                         
     * Configuration
     */
    public $config = [];
    public $_config = [
        'class'=>'lazyload',

    ];

    /**
     *
     * Constants
     */
    public const type = [

    ];


    public $event = [];
    public $_event = [

    ];



    public $layout = [];
    public $_layout = [
'main' => <<<HTML
       <div class="lazyload" data-ajax="{dataAjax}" data-expand="0" ></div>   
HTML,

'js' => <<<JS
   (function(){
    var docElem = document.documentElement;

    window.lazySizesConfig = window.lazySizesConfig || {};

    window.lazySizesConfig.loadMode = 1;

    //set expand to a higher value on larger displays
    window.lazySizesConfig.expand = Math.max(Math.min(docElem.clientWidth, docElem.clientHeight, 1222) - 1, 359);
    window.lazySizesConfig.expFactor = lazySizesConfig.expand < 380 ? 3 : 2;
})();
JS,
'layout' => <<<JS
 $(document).on('lazybeforeunveil', function (event){
        var ajax = $(e.target).data('ajax');
        if(ajax){
            $(e.target).load(ajax);
        }
    });
JS,



];



    public function asset()
    {
    $this->fileJs('/render/images/ZLazySizesWidget/asset/main.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/lazysizes@5.2.1-rc1/lazysizes.min.js');
    }

    public function codes()
    {

      
        $values = '';

       $data = Az::$app->market->product->allProducts();
        foreach ($data as $value)
        {
          $values .= strtr($this->_layout['main'],[
              '{dataAjax}' => str_replace('//', '', "/$value->url"),
          ]);
        }
        $this->htm = $values;

      $this->js = strtr($this->_layout['js'],[

      ]);
      $this->js .= strtr($this->_layout['layout'],[

      ]);
    }

}
