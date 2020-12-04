<?php
/**
 *
 *
 * Author:  Jasur Sh.
 *
 */

namespace zetsoft\widgets\ajaxify;


use phpDocumentor\Reflection\Type;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\actions\crud\ZIndexAjaxAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\Zicon;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingOnlyWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZIconCardWidget;
use zetsoft\widgets\market\ZSingleProductWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


class ZInfinityScrollAjaxWidget_Asror extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'appendTo' => 'appendTo',
        'item' => null,
        'pageAttribute' => 'page',
        'limitAttribute' => 'limit',
        'url' => 'infinity.aspx',
        'limit' => 12,
        'requireUrl' => '/webhtm/shop/user/filter-market/blocks/vertical_horizontal.php',
        'defaultItem' => 'item',
        'grid' => 'row w-100',
        'cols' => 3,
        'params' => 'params',

        'ajaxMethod' => ZInfinityScrollAjaxWidget::method['get'],
        'namespace' => 'market',
        'service' => 'product',
        'method' => 'allProducts',
        'args' => '{categoryId}|{status}|{page}|{limit}|{params}',

        'test' => false,
        'isCommon' => true,
        'type' => ZInfinityScrollAjaxWidget::type['type'],
        'btn-style' => 'outline-success',

    ];

    public const type = [
        'scroll' => 'scroll',
        'type' => 'type'
    ];

    public const method = [
        'post' => 'POST',
        'get' => 'GET',
        'patch' => 'PATCH',
        'put' => 'PUT'
    ];

    public $event = [];
    public $_event = [
    ];

    public static $type = [
        'type',
        'ajax'
    ];
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
    <div class="{appendTo} {grid} ml-0" id="{appendTo}">
        
    </div>
    
    
    {button}
        
    <div class="row w-100 my-2" style="display: none" id="no_content">
        <div class="col-md-4 offset-md-4  text-dark text-center">
             <!--<h4 class="border-primary  p-3">
                {no-content} <a class="fa fa-arrow-up p-2 text-dark" href="#{appendTo}" id="toAppend"></a>
            </h4> -->
            <h3 class="text-muted mt-2" >В данной категории товаров не осталось</h3>
        </div>
    </div>
HTML,

        'button' => <<<HTML
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-4 offset-md-3">
          
</div>
</div>
</div>
<div class="d-flex justify-content-center my-3 w-100" >
        {loader}
          <button class="btn btn-{btn_style}" id="show_more" style="display:none;">
                {string_show_more}
           </button>
    </div>
HTML,


    ];


    public function asset()
    {
        //    $this->fileJs(Root . '/rendedr/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js');
    }


    public function codes()
    {
        $js = file_get_contents(Root . '/render/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js');


        $code = $this->require( $this->_config['requireUrl'], [
            'item' => $this->_config['item'],
            'col' => $this->_config['cols']
        ]);

        $show_more = strtr($this->_layout['button'], [
            '{btn_style}' => $this->_config['btn-style'],
            '{string_show_more}' => Azl . 'Показать ещё',
            '{loader}' => $this->require( '/render/market/ZCategoryCardWidget/demo/clean_loader_3.php'),
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{appendTo}' => $this->_config['appendTo'],
            '{grid}' => $this->_config['grid'],
            '{no-content}' => Az::l('Нет продутков'),
            '{button}' => $this->_config['type'] === 'type' ? $show_more : ''
        ]);

        $args = $this->_config['args'];

        foreach ($this->httpGet() as $key => $value) {
            $args = str_replace("{{$key}}", $value, $args);
        }
  //      vdd($args);
        $this->js = strtr($js, [
            '{appendTo}' => $this->_config['appendTo'],
            '{item}' => $code,
            '{url}' => $this->_config['url'],
            '{pageAttribute}' => $this->_config['pageAttribute'],
            '{limitAttribute}' => $this->_config['limitAttribute'],
            '{limit}' => $this->_config['limit'],
            '{requireUrl}' => $this->_config['requireUrl'],
            '{ajaxMethod}' => $this->_config['ajaxMethod'],
            '{namespace}' => $this->_config['namespace'],
            '{service}' => $this->_config['service'],
            '{method}' => $this->_config['method'],
            '{test}' => $this->_config['test'],
            '{isCommon}' => $this->_config['isCommon'],
            '{categoryId}' => $this->httpGet('id'),
            '{type}' => $this->_config['type'],
            '{args}' => $args,
            '{params}' => $this->_config['params']
        ]);
    }

}

