<?php

namespace zetsoft\widgets\cards\newWidgets;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;


class ZVerticalCardWidget1 extends ZWidget
{
    public $config = [];
    public $_config = [
        'itemName' => '',
        
    ];
    public $event = [];
    public $_event = [];

    public function asset()
    {
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
         <div class="card m-2">

            <div class="position-relative overflow-hidden">
                <div class="position-absolute p-2 d-flex">
                    
                    <div class="pl-3">
                        
                    </div>
                </div>
                <span style="right: 2%; top: 4%" class="position-absolute ml-auto danger-color pl-2 pr-2 py-2 mr-2 text-white rounded fe-10">
                -10 %
            </span>

                <img src="https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="card-img-top" alt="...">
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-title fe-12">{itemName}</div>
                    <div class="d-flex mt-1">
                        <i class="far fa-heart grey-text mr-2 h5"></i>
                        <i class="fa fa-chart-bar grey-text h5"></i>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="text-success fe-12">{itemAmount}</div>
                    <div class="text-muted card-text"><!--Art: 34234234--></div>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <div class="d-flex flex-wrap"><div class="text-success h4"></div><div class="text-muted d-flex align-items-center">сум. за 1 шт</div></div>
                        <div class="text-danger mt-n2"><strike class="h5">18,890</strike></div>
                    </div>
                    <div class="card-text">
                        
                        <h6 class="card-text text-muted text-center">(2 отзыва)</h6>
                    </div>
                </div>

                <div>

                </div>
            </div>
            <button class="btn button-bg-color text-white add-cart">Добавить в корзину</button>


            <div class="touch-main d-none">
                <div class="d-flex justify-content-center">
                    <div class="d-flex parent-clear w-75">
                        
                    </div>
                    <div>
                        


                    </div>
                </div>
            </div>
        </div>
HTML,
    ];

    public function codes()
    {
        foreach ($this->model as $key => $value){
         
        }
    }
}
