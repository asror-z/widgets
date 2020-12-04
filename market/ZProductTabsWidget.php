<?php

/**
 *
 *
 * Author:  Maxamadjonov Jaxongir
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;


use yii\data\Pagination;
use zetsoft\system\column\ZLinkPager;
use zetsoft\system\column\ZScrollPager;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZListViewWidgetOld;
use zetsoft\system\Az;

class ZProductTabsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'widget' => '',
        'categoryId' => null,
        'url' => 'market/main/simgle-product',
        'pager' => ZProductTabsWidget::type['scroll'],
        'addButton' => false
    ];

    public const type = [
        'link' => 'link',
        'scroll' => 'scroll'
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="switch-parent">
                <button class="mr-0 btn btn-success" id="switch_to_col">
                    <i class="fa fa-th-list"></i>
                </button>
                <button class="ml-0 btn btn-outline-success" id="switch_to_list">
                    <i class="fa fa-th-large"></i>
                </button>
            </div>
        </div>
    </div>
        <div class="row wrapper-product">
       {content}

    </div>
        <div class="pagers">
         {pager}
        </div>
    </div>

HTML,
        'js' => <<<JS
let items = $('.pre-tab-item');
$('#switch_to_list').on('click',function () {
    $(this).removeClass('btn-outline-success')
    $(this).addClass('btn-success')
    $('#switch_to_col').addClass('btn-outline-success')
    $('#switch_to_col').removeClass('btn-success')
    for (let i = 0; i < items.length; i++) {
        $(items[i]).removeClass('col-md-12');
        $(items[i]).addClass('col-md-3');
        $(items[i]).addClass('zclass');
    }
})
$('#switch_to_col').on('click',function () {
    $('#switch_to_list').addClass('btn-outline-success')
    $('#switch_to_list').removeClass('btn-success')
    $(this).removeClass('btn-outline-success')
    $(this).addClass('btn-success')
    for (let i = 0; i < items.length; i++) {
        $(items[i]).removeClass('zclass');
        $(items[i]).addClass('col-md-12');
        $(items[i]).removeClass('col-md-3');
    }
})
 function eventload() {
 console.log('ok');
        if ($('#switch_to_list').hasClass('btn-success')){
           items = $('.pre-tab-item');
            for (let i = 0; i < items.length; i++) {
        $(items[i]).removeClass('col-md-12');
        $(items[i]).addClass('col-md-3');
        $(items[i]).addClass('zclass');
                                                     } 
                                            } 
        if ($('#switch_to_col').hasClass('btn-success')){
           items = $('.pre-tab-item');
           for (let i = 0; i < items.length; i++) {
        $(items[i]).removeClass('zclass');
        $(items[i]).addClass('col-md-12');
        $(items[i]).removeClass('col-md-3');
                                                     } 
                                            }                                       
        }
         
JS,

        'css' => <<<CSS
.tab-item2 div{
    display: inline-block!important;
}

.tab-img{
    width: 35%;
}
.item-heading{
    width: 40%;
}
.item-content{
    width: 25%;
}

.zclass  .tab-item2 div{
    display: block!important;
    width: 100%;
}


CSS,

    ];

    public function asset()
    {
        // $this->fileCss('/render/market/Otabek/assets/main.css');
        // $this->fileJs('/render/market/Otabek/assets/main.js');
    }

    public function codes()
    {
        //$this->model = Az::$app->market->product->allProducts($this->_config['categoryId']);

        // $this->pjaxBegin();
        $listview = ZListViewWidgetOld::widget([
            'model' => $this->model,
            'config' => [
                'itemView' => function ($model, $key, $index, $widget) {
                    // echo "<div class=\"pre-tab-item border col-md-12 bg-dark\" style=\"height: 50px\">";
                    echo "  <div class=\"col-md-12 pre-tab-item mb-3\">";
                    echo ZMarketCardsWidget::widget([
                        'config' => [
                            'type' => ZMarketCardsWidget::type['featureVertical'],
                            'url' => $this->_config['url'],
                            'button' => $this->_config['addButton']
                        ],
                        'model' => $model
                    ]);
                    echo "</div>";
                },
                /*'afterItem' => function($model, $key, $index, $widget){
                     return "<br>";
                }*/
                'layout' => '{items}',


            ]
        ]);

        //ZUrl::to(['market/main/simgle-product',
        //  'id' => $model->id
        //]);


        //$this->pjaxEnd();
        $count = \Dash\count($this->model);
        $pagination = new Pagination([
            'totalCount' => $count,
            'pageSize' => 4
        ]);
        /*$pager = LinkPager::widget([
            'pagination' => $pagination,
            'activePageCssClass' => 'bg-success p-2 rounded-sm ',
            'pageCssClass' => 'p-2 m-1',
            'prevPageCssClass' => 'p-2 m-1',
            'nextPageCssClass' => 'p-2 m-1',
        ]);
        //vd(\Dash\count($this->model));
        //vd(\Dash\count($this->model));

        /*$show = ZSelect2Widget::widget([
             'data' => [
                 12 => 12,
                 24 => 24,
                 36 => 36
             ],
             'name' => 'show',
        ]);*/
        $pager = ZLinkPager::widget([

            'pagination' => $pagination,
        ]);
        if ($this->_config['pager'] == 'link') {
            $pager = ZLinkPager::widget([

                'pagination' => $pagination,
            ]);

        } else if ($this->_config['pager'] == 'scroll')
            $pager = ZScrollPager::widget([
                'isGrid' => false,
                'pagination' => $pagination,
                'container' => '.wrapper-product',
                'item' => '.pre-tab-item',//'.tab-item2',
                'paginationSelector' => '.pagers ',
                'triggerTemplate' => '<div class="ias-trigger col-md-12 pre-tab-item mb-3 pt-3" style="text-align: center; cursor: pointer;"><a>{text}</a></div>',
                'eventOnRendered' => 'eventload();',
                'spinnerTemplate' => '<div class="ias-spinner col-md-12 pre-tab-item mb-3 pt-3" style="text-align: center;"><img src="{src}"/></div>',
                

            ]);


        $current = $pagination->getPage() + 1;


        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $listview,
            '{pager}' => $pager,
            '{summary}' => Az::l("Страница {$current} из {$pagination->getPageCount()}"),
        ]);
        $this->js .= $this->_layout['js'];
        $this->css .= $this->_layout['css'];
    }

}
