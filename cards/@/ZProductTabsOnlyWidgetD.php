<?php

/**
 *
 *
 * Author:  Maxamadjonov Jaxongir
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\cards;


use yii\data\Pagination;
use yii\data\Sort;
use zetsoft\system\column\ZLinkPager;
use zetsoft\system\column\ZScrollPager;
use zetsoft\system\column\ZSorter;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZListViewWidgetOld;
use zetsoft\system\Az;
use zetsoft\widgets\sorter\ZLinkSorterWidget;

class ZProductTabsOnlyWidgetD extends ZWidget
{
    public $config = [];
    public $_config = [
        'widget' => '',
        'categoryId' => null,
        'url' => 'market/main/simgle-product',
        'pager' => ZProductTabsOnlyWidget::type['scroll'],
        'addButton' => false,
        'cols' => 3,
        'sort' => ['price'],
        'key' => [SORT_DESC],
        'withFilter' => true,
        'withSort' => true
    ];

    public const type = [
        'link' => 'link',
        'scroll' => 'scroll'
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div  class="container-fluid my-2"> 
    <div class="row {filter_class}">
    
        <div class="col-md-3">
            <div class="switch-parent">
                <button class="mx-0 btn btn-success" id="switch_to_col">
                    <i class="fa fa-th-list"></i>
                </button>
                <button class="mx-0 btn btn-outline-success" id="switch_to_list">
                    <i class="fa fa-th-large"></i>
                </button>
            </div>
        </div>
        <div class="col-md-9 d-flex justify-content-start box-shadow p-2 mb-4 rounded d-block">
            <p class="p-0 m-0">Сортирировать по:</p>    {filter}
        </div>
        
    </div>
    
    <div class="row wrapper-product">
        
        {content}
        
    
    </div>
    
    <div class="dilshod">
        {pager}
    </div>     
</div>     
<p id="oxir"> </p>   
   
    
   

HTML,
        'js' => <<<JS
let pre_items = $('.pre-tab-item');

let cols = $('.zcol');
let lists = $('.zlist');

cols.show();
lists.hide();


$('#switch_to_list, #switch_to_col').on('click',function () {
    cols = $('.zcol');
    lists = $('.zlist');
    pre_items = $('.pre-tab-item')
   
    
    $(this).removeClass('btn-outline-success')
    $(this).addClass('btn-success')
    
    if ($(this).attr('id')==='switch_to_list'){
        for (let i=0;i<lists.length;i++){
            $(lists[i]).show();
            $(cols[i]).hide();
            $(pre_items[i]).addClass('col-md-12')
            $(pre_items[i]).removeClass('col-sm-6 col-md-4 col-lg-3 col-xl-2')
        }
        $('#switch_to_col').addClass('btn-outline-success')
        $('#switch_to_col').removeClass('btn-success')                                          
    }
    if ($(this).attr('id')==='switch_to_col'){
         for (let i=0;i<lists.length;i++){
            $(lists[i]).hide();
            $(cols[i]).show();
            $(pre_items[i]).addClass('col-sm-6 col-md-4 col-lg-3 col-xl-2')
            $(pre_items[i]).removeClass('col-md-12')
        }
        $('#switch_to_list').addClass('btn-outline-success')
        $('#switch_to_list').removeClass('btn-success') 
    } 
})

function eventload() {
    cols = $('.zcol');
    pre_items = $('.pre-tab-item')
    lists = $('.zlist');
  
    let inputs = $(".inputhide")
    for (let i=0;i<inputs.length;i++){
        $(inputs[i]).hide()
    }
    if ($('#switch_to_col').hasClass('btn-success')){
        for (let i=0;i<cols.length;i++){
            $(lists[i]).hide();
            $(cols[i]).show();
            $(pre_items[i]).removeClass('col-md-12')
            $(pre_items[i]).addClass('col-sm-6 col-md-4 col-lg-3 col-xl-3')
        }                                                
    }
    if ($('#switch_to_list').hasClass('btn-success')){
        for (let i=0;i<lists.length;i++){
            $(lists[i]).show();
            $(cols[i]).hide();
            $(pre_items[i]).addClass('col-md-12')
            $(pre_items[i]).removeClass('col-sm-6 col-md-4 col-lg-3 col-xl-3')
        }
    }
}

JS,

        'css' => <<<CSS

CSS,

    ];


    public function codes()
    {


        $sort = new Sort([
            'attributes' => [
                'name' => [
                    'label' => Az::l('По названию'),
                ],
                'price' => [
                    'label' => Az::l('По цене')
                ],
            ],
        ]);

        $sorter = ZLinkSorterWidget::widget([
            'sort' => $sort,


            // umumiy container uchun tag nomi va optionlari
            'containerTag' => 'div',
           

            // har bir linkni tashqarisidagi teg nomi va optionlari
            // har bir link shu tegni ichida bo'ladi
            'wrapperTag' => 'i',
            'wrapperTagOptions' => [
                'style' => 'd-inline-block sort-items',
            ],

            // link uchun optionlar
            'linkOptions' => [
                'class' => 'text-success mx-3'
            ],


        ]) ;
        $listview = ZListViewWidgetOld::widget([
            'model' => $this->model,
            'data' => $this->data,
            'config' => [
                'itemView' => function ($model, $key, $index, $widget) {
                    echo "  <div class=\"pre-tab-item px-0 col-sm-6 col-md-4 col-lg-3 col-xl-2  mb-3\">";

                    echo ZMarketCardsOnlyWidget::widget([
                        'config' => [
                            'url' => $this->_config['url'],
                            'button' => $this->_config['addButton']
                        ],
                        'model' => $model
                    ]);
                    echo "</div></div>";
                },
                'layout' => '{items}',
                'pageSize' => 10,

                //'sorter' => $sorter,
                'sort' => $sort
            ]
        ]);

        $count = \Dash\count($this->model);
        $pagination = new Pagination([
            'totalCount' => $count,
            'pageSize' => 5,
        ]);

        if ($this->_config['pager'] === 'link') {
            $pager = ZLinkPager::widget([
                'pagination' => $pagination,
            ]);
        } else if ($this->_config['pager'] === 'scroll')
            $pager = ZScrollPager::widget([
                'isGrid' => false,
                'pagination' => $pagination,
                'container' => '.wrapper-product',
                'item' => '.pre-tab-item',
                'paginationSelector' => '.dilshod .pagination ',
                'triggerTemplate' => '<div class="ias-trigger col-md-12 pre-tab-items mb-3 pt-3" style="text-align: center; cursor: pointer;"><a>{text}</a></div>',
                'eventOnRendered' => 'eventload();',
                'spinnerTemplate' => '<div class="ias-spinner col-md-12 pre-tab-items mb-3 pt-3" style="text-align: center;"><img src="{src}"/></div>',
            ]);


        $current = $pagination->getPage() + 1;

        $this->pjaxBegin();
        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $listview,
            '{pager}' => $pager,
            '{filter}' => $sorter,
            '{filter_class}' => !$this->_config['withFilter'] ? 'd-none' : ''

            //'{summary}' => Az::l("Страница {$current} из {$pagination->getPageCount()}"),
        ]);
        $this->pjaxEnd();
        $this->js .= $this->_layout['js'];
        $this->css .= $this->_layout['css'];
        $this->js = strtr($this->_layout['js'], [
            '{cols}' => $this->_config['cols']
        ]);
    }

}
