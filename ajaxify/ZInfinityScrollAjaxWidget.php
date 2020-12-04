<?php
/**
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 */

namespace zetsoft\widgets\ajaxify;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;


class ZInfinityScrollAjaxWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'appendTo' => 'appendTo', // kelayotgan response larni {appendTo} berilgan html tag ga qoshib ketadi
        'item' => null,
        'pageAttribute' => 'page', // js ajax data dagi key
        'limitAttribute' => 'limit', // js ajax data dagi key
        'url' => '/core/product/infinity.aspx', // infinity scroll ishlaydigan bussiness logic urli
        'limit' => 12, // response bolgan data larni limit
        'requireUrl' => '/webhtm/shop/user/filter-common/blocks/vertical_horizontal.php',// widget urli
        'defaultItem' => 'item',
        'grid' => 'row w-100',
        'cols' => 3, // datalarni grid da chiqarish
        'params' => 'params',

        'ajaxMethod' => ZInfinityScrollAjaxWidget::method['get'],// ajax post,get,put,delete requestlar
        'namespace' => 'market',
        'service' => 'product',
        'method' => 'allProducts',
        'args' => '{categoryId}|{status}|{page}|{limit}|{params}',

        'test' => false, // test rejimida ishlashi uchunu true
        'isCommon' => true, // market place cardagi common
        'type' => ZInfinityScrollAjaxWidget::type['type'], // infinity scroll ni scroll yoki button click bosganda ishlash type lari
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
            <h3 class="text-muted mt-2">Больше нет товаров</h3>                             
        </div>
    </div>
HTML,

        'button' => <<<HTML
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 offset-md-3"></div>
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
            '{no-content}' => Az::l('Нет продуктов'),
            '{button}' => $this->_config['type'] === 'type' ? $show_more : ''
        ]);

        $args = $this->_config['args'];

        foreach ($this->httpGet() as $key => $value) {
            $args = str_replace("{{$key}}", $value, $args);

        }


        $js = file_get_contents(Root . '/render/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js');

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
            '{args}' => $this->_config['args'],
            '{params}' => $this->_config['params']
        ]);

    }

}

