<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\cards;


use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZVerticalCardWidget extends Zwidget
{
    public $config = [];
    public $_config = [
      

    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [
      
    ];

    /*
     * Constants
     * */
 

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [

        'vertical' => <<<HTML
                 <!--Grid row-->
                <div class="row">
                
                  <!--Grid column-->
                  <div class="col-md-6 mb-4">
                
                    <!-- Card -->
                    <div class="card gradient-card p-3 d-flex">
                
                        <div class="card-image col-md-4 p-2">
                          <!-- Content -->
                          <a href="#!">
                            <div class="text-white d-flex h-100 mask blue-gradient-rgba">
                              <div class="first-content align-self-center p-3">
                                <h3 class="card-title">Today's sales</h3>
                                <p class="lead mb-0">Click on this card to see details</p>
                              </div>
                              
                            </div>
                          </a>
                
                        </div>
                
                        <!-- Data -->
                        <div class="third-content ml-auto mr-4 mb-2">
                          <p class="text-uppercase text-muted">Today's sale</p>
                          <h4 class="font-weight-bold float-right">2000$</h4>
                        </div>
                
                        <!-- Content -->
                       
                    </div>
                    <!-- Card -->
                
                  </div>
                  <!--Grid column-->
                </div>
                <!--Grid row-->
                    <!-- Card Regular -->
        
</div>
HTML,

    ];

    public function asset()
    {
    
    }

    public function codes()
    {
      $this->htm = $this->_layout['vertical'];
    }
}

