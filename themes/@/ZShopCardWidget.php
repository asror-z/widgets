<?php

namespace zetsoft\widgets\themes;

use phpDocumentor\Reflection\Types\Self_;
use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZIcon;
use zetsoft\widgets\navigat\ZBreadCrumbWidget as ZBreadCrumbWidgetAlias;
use zetsoft\widgets\navigat\ZButtonWidget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: Daho
 *
 */
class ZShopCardWidget extends ZWidget
{


    public $config = [];
    public $_config = [
         'headerTitle' => '<i class="fa fa-leaf"></i> 7+',
         'titleColor' => ZColor::gradient['lady-lips-gradient'],
        'grapes' => true,
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <!-- Card -->
            <div class="card"   >
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="{titleColor}">{headetTitle}</h4>
                            <strong style="margin-left: 2px; padding-top: -16px">дней</strong>
                        </div>
                        <div class="col-md-4 offset-4" >
                            <button type="button" class="btn btn-warning"style="margin-left: 1rem;
                               border-top-left-radius:17%;
                               border-bottom-left-radius:17%;
                               color: black">aksiya</button>
                        </div>
                    </div>
                </div>

                <!-- Card image -->
                <div class="view overlay">

                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Food/8-col/img (5).jpg" alt="Card image cap">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!-- Card content -->
                <div class="card-body">

                    <!-- Title -->

                    <!-- Data -->
                    <ul class="list-unstyled list-inline rating mb-0">
                        <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"> </i></li>
                        <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i></li>
                        <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i></li>
                        <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i></li>
                        <li class="list-inline-item"><i class="fas fa-star-half-alt " ></i></li>
                        <li class="list-inline-item" style="margin-left: 14rem; size: 14px!important;"><p class="text-muted" ><i class="fas fa-heart fa-2x" style="color: red" ></i></p></li>
                    </ul>

                    <!-- Text -->
                    <p class="card-text">Сыр "Tegen" из мираморний говядины 500гр</p>
                    <br>
                    <!-- <hr class="my-4">-->
                    <div>
                        <h6 class="ml-3" style="text-decoration: line-through;">8,700</h6>
                        <h4 class="card-title font-weight-bold  ml-3"> 8,100
                            <a>UZS/Шт</a></h4>

                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-transparent">-</button>
                        <button type="button" class="btn btn-outline-transparent">0</button>
                        <button type="button" class="btn btn-outline-transparent">+</button>
                    </div>
                    <!-- Button -->
                    <a href="#" class="btn btn-success deep-purple-text p-1 mx-0 mb-0" style="width: 60px; height: 42px;text-align: center "><i class="fas fa-shopping-cart fa-2x" style="margin-top:2px; color:white "></i></a>

                </div>

            </div>
            <!-- Card -->
HTML,

    ];


    public function init()
    {
        parent::init();
        ob_start();
    }


    public function codes()
    {
        

           $this->htm = strtr($this->_layout['main'],[
               '{headetTitle}' =>$this->_config['headerTitle'],
               '{titleColor}' =>$this->_config['titleColor'],
               
               '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
           ]);

    }

}
