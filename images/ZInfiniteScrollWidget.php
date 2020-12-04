<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\images;

use zetsoft\system\kernels\ZWidget;


class ZInfiniteScrollWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'url' => "/render/images/ZInfiniteScrollWidget/clean1.html",
        'viewButton' => true,
        'mode' => self::mode['block']
    ];

    public const mode = [
     'block' => 'block',
     'none' => 'none'
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="row" id="{id}"> 
             <h1>Infinite Scroll - button</h1>
            <div class="col-md-12">
             <article class="post">
              {articles}
           </article>
           
        </div>
         
        <div class="page-load-status">
        
           <div class="loader-ellips infinite-scroll-request">
               {span}
           </div>
           
           <p class="infinite-scroll-last">End of content</p>
           
        </div>
      
        </div>
       <p>
            <button class="view-more-button touch d-{mode}">View more</button>
       </p>         
         
HTML,

        'article' => <<<HTML
             <article class="post">
                     {widget}
             </article>
HTML,

        'span' => <<<HTML

            <span class="loader-ellips__dot"></span>
HTML,

        'js' => <<<JS
           $('#{id}').infiniteScroll({
           path: function() {
               return '{url}'
           },
           append: '.post',
           button: '.view-more-button',
           scrollThreshold: '{viewButton}',
           status: '.page-load-status',
       });
JS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/infinite-scroll@3.0.6/dist/infinite-scroll.pkgd.min.js');
        
    }

    public function codes()
    {
        $articles = '';
        $span = '';
        foreach ($this->data as $key => $widget) {
            $articles .= strtr($this->_layout['article'], [
                '{widget}' => $widget,
                '{id}'=>$this->id,
            ]);
            $span .= $this->_layout['span'];
        }
              
        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{articles}' => $articles,
            '{span}' => $span,
            '{mode}' => $this->_config['mode']
        ]);




        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{url}' => $this->_config['url'],
            '{viewButton}' => $this->_config['viewButton'],
        ]);

        
    }
}
