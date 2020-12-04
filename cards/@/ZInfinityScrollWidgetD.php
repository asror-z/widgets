<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\cards;


use kop\y2sp\ScrollPager;
use yii\data\ArrayDataProvider;
use yii\data\Sort;
use yii\widgets\ListView;
use zetsoft\dbitem\data\Form;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\sorter\ZLinkSorterWidget;

class ZInfinityScrollWidgetD extends ZWidget
{

    public $pagination;

    public $config = [];
    public $_config = [
        'parentClass'=>'asdasd',
        'targetClass'=>'asdsadsa',
        'loadStatusClass'=>'page-load-status',
        'url' => '/render/cards/ZListViewWidget/demo/vertical_horizontal.php'
    ];


    public $layout=[];
    public $_layout= [
        'main' => <<<HTML
        <div class="{parentClass} row"> 
        {content}
</div>
<div class="page-load-status da-block">
    <div class="loader-ellips infinite-scroll-request">
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
    </div>
    <p class="infinite-scroll-last">End of content</p>
    <p class="infinite-scroll-error">No more pages to load</p>
</div>
HTML,
        'pluginJs' => <<<JS
var grid = $('.{parentClass}').masonry({
            itemSelector: 'none', // select none at first
            percentPosition: true,
            stagger: 30,
            // nicer reveal transition
            visibleStyle: { transform: 'translateY(0)', opacity: 1 },
            hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
        });


        var msnry = grid.data('masonry');


        function getPenPath() {
            //return "{url}";    
            return "/core/tester/asror/main.aspx?path=render/former/ZListViewWidget/sampleForScroll.php";
        }

        grid.infiniteScroll({
            checkLastPage: false,
            path: getPenPath,       // url for next page
            //append: '.grid__item',  // disabled, false,
            append: '.{targetClass}',  // disabled, false,
            prefill: false,
            responseType: 'document',  // text
            outlayer: msnry,           // iso, pckry
            scrollThreshold: 400,       // number or false
            status: '.page-load-status',
            elementScroll: false,    //true, parent element's class
            loadOnScroll: true,          //true

        });
JS
    ];


    public function asset(){
        $this->fileJs('https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.js');
        $this->fileJs('https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js');
    }


    public function codes()
    {


        $content_code=Az::$app->market->product->allProducts();
        $content = '';
        $target = $this->_config['targetClass'];

        foreach ($content_code as $item){
            $content .= "<div class = '$target col-md-3 my-2'>";
            $content .= $this->require( $this->_config['url'],[
                'item' => $item,
                'col' => 12
            ]);
            $content .= "</div>";
        }

        $this->htm=strtr($this->_layout['main'],[
            '{content}'=>$content,
            '{targetClass}'=>$this->_config['targetClass'],
            '{parentClass}'=>$this->_config['parentClass'],
        ]);
        $this->js=strtr($this->_layout['pluginJs'],[
            '{parentClass}' => $this->_config['parentClass'],
            '{targetClass}' => $this->_config['targetClass'],
            '{content}' => $content,
            //'{url}' => $this->_config['url'],
        ]);

    }
}
