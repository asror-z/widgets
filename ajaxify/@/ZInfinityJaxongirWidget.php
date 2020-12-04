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
use zetsoft\system\Az;
use zetsoft\system\helpers\Zicon;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingOnlyWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZIconCardWidget;
use zetsoft\widgets\market\ZSingleProductWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


class ZInfinityJaxongirWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'appendTo' => 'appendTo',
        'item' => 'testItem',
        'pageAttribute' => 'page',
        'limitAttribute' => 'limit',
        'url' => '/api/market/infinite.aspx',
        'limit'=> 3,
        'requireUrl'=>'/render/cards/ZListViewWidget/demo/vertical_horizontal.php',
        'defaultItem'=>'item',
    ];


    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
    <div class="{appendTo}">
        
    </div>
HTML,

        'js' => <<<JS
let page = 0;
$(document).ready(function () {
        if (page===0){
                $.ajax({
                    url: '{url}',
                    method: 'POST',
                    data: {
                        'page':page,
                        'limit':'{limit}',
                        'requireUrl':'{requireUrl}',
                        'itemAttribute':'{itemAttribute}',
                    },
                    beforeSend: function (data) {
                    },
                    success: function (data) {
                        page ++;      
                        $('.{appendTo}').append(data);
                    },
                    error: function () {
                        console.log('error')
                    }
                })
        }       

        $('body').scroll(function() {
            if($('body').scrollTop() + $('body').height() > $(document).height() - 100) {
                 
                $.ajax({
                    url: '{url}',
                    method: 'POST',
                    data: {
                        'page':page,
                        'limit':'{limit}',
                        'requireUrl':'{requireUrl}',
                        'itemAttribute':'{itemAttribute}',
                    },
                    beforeSend: function (data) {
                    },
                    success: function (data) {
                        page ++;
                        console.log(data)        
                        $('.{appendTo}').append(data);
                    },
                    error: function () {
                        console.log('error')
                    }
                })
            }
        });
    })
JS,


    ];


    public function asset()
    {
    }


    public function codes()
    {
        //$item = Az::$app->market->product->productItemByCatalogId(18);
        $code = $this->require($this->_config['requireUrl'], [
            'item' => $this->_config['item']
        ]);

       

        $this->htm = strtr($this->_layout['main'], [
            '{appendTo}' => $this->_config['appendTo']
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{appendTo}' => $this->_config['appendTo'],
            '{item}' => $code,
            '{url}'=>$this->_config['url'],
            '{pageAttribute}'=>$this->_config['pageAttribute'],
            '{limitAttribute}'=>$this->_config['limitAttribute'],
            '{limit}'=>$this->_config['limit'],
            '{requireUrl}'=>$this->_config['requireUrl'],
        ]);

    }

}

