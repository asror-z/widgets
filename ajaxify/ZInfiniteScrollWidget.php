<?php
/**
 *
 *
 * Author:  Jasur Sh.
 *
 */
namespace zetsoft\widgets\ajaxify;


use phpDocumentor\Reflection\Type;
use zetsoft\actions\crud\ZIndexAjaxAction;
use zetsoft\system\helpers\Zicon;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingOnlyWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZIconCardWidget;
use zetsoft\widgets\market\ZSingleProductWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


class ZInfiniteScrollWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
          
    ];


    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

   'main' =><<<HTML
    <div class="example">
    <ul id="{id}" style="width: 600px; height: 550px; overflow-x: hidden;">
        <li>
          <div class="row">
             <div class="col-md-3">
                  <div>{name}<br>{rating}</div>
             <div class="col-md-3">
                  {icon}  
              </div>
             <div class="col-md-3">
                   {price}
              </div>
             <div class="col-md-3">
                  {button}
            </div>
          </div>
        </li>

    </ul>
</div>

HTML,

        'js' => <<<JS
             $(function() {
            $('#{id}').scrollTop(101);
            var images = $("ul#{id}").clone().find("li");
            $('#{id}').endlessScroll({
                pagesToKeep: 5,
                inflowPixels: 100,
                fireDelay: 10,
                content: function(i, p, d) {
                    console.log(i, p, d)
                    return images.eq(Math.floor(Math.random()*8))[0].outerHTML;
                }
            });
        });
JS,


    ];


    public function asset()
    {
    $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js');
    $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery-endless-scroll/1.8.0/js/jquery.endless-scroll.min.js');
    }


    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
        '{id}' => $this->id
        ]);

        $this->js = strtr($this->_layout['js'], []);

    }

}

