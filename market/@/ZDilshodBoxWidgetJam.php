<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;


use yii\data\Pagination;
use yii\widgets\LinkPager;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZListViewWidgetOld;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\system\Az;

class ZDilshodBoxWidgetJam extends ZWidget
{
    public $config = [];
    public $_config = [
        'widget' => '',
        'categoryId' => null
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
       <div class="product-box">
                    <div class="cat-box d-flex justify-content-between">
                        <!-- Nav tabs -->
                        <div class="view">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#grid"><i class="fa fa-th-list"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#list"><i class="fa fa-th-large"></i></a>
                                </li>
                            </ul>
                        </div>
                        <!--<div class="sortby">
                            &lt;!&ndash;<span>Sort By</span>
                            <select class="sort-box">
                                {sort}
                            </select>&ndash;&gt;
                        </div>
                        <div class="show-item">
                            &lt;!&ndash;{show}&ndash;&gt;
                        </div>-->
                        <div class="page">
                            <p>{summary}</p>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    
                    <div class="tab-content">
                        <div class="tab-pane fade active show p-0 m-0" id="list" role="tabpanel">
                               <div class="row p-0 m-0">
                                  {content}
                              </div>
                            
                        </div>                           
                          <div class="tab-pane fade" id="grid" role="tabpanel">
                            {tabDiv}                               
                         </div>
                    </div>
               </div>
               <div class="dilshod">
               {pager}
</div>
HTML,

    ];

    public function codes()
    {
        $this->model = Az::$app->market->product->allProducts($this->_config['categoryId']);


        // $this->pjaxBegin();
        $listview = ZListViewWidgetOld::widget([
            'model' => $this->model,
            'config' => [
                'itemView' => function ($model, $key, $index, $widget) {
                    echo "<div class='m-1'>";
                    echo ZMarketCardsWidgetJ::widget([
                        'config' => [
                            'type' => ZMarketCardsWidgetJ::type['featureVertical'],

                        ],
                        'model' => $model
                    ]);
                    echo "</div>";
                },
                /*'afterItem' => function($model, $key, $index, $widget){
                     return "<br>";
                }*/
                'layout' => '{items}'

            ]
        ]);

        $listview2 = ZListViewWidgetOld::widget([
            'model' => $this->model,
            'config' => [
                'itemView' => function ($model, $key, $index, $widget) {
                    echo "<div class='m-0'>";
                    echo ZMarketCardsWidgetJ::widget([
                        'config' => [
                            'type' => ZMarketCardsWidgetJ::type['featureHorizontal'],
                        ],
                        'model' => $model
                    ]);

                     echo "</div>";
                    return $model->name;
                },
                /*'afterItem' => function($model, $key, $index, $widget){
                     return "<br>";
                }*/
                'layout' => '{items}'
            ]
        ]);
        //$this->pjaxEnd();
        $count = \Dash\count($this->model);
        $pagination = new Pagination([
            'totalCount' => $count,
            'pageSize' => 12
        ]);
        $pager = LinkPager::widget([
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

        $current = $pagination->getPage() + 1;


        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $listview,
            '{tabDiv}' => $listview2,
//            '{show}' => $show,
            '{pager}' => $pager,
            '{summary}' => Az::l("Страница {$current} из {$pagination->getPageCount()}"),
        ]);
    }

}
