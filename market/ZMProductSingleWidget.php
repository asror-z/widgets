<?php

namespace zetsoft\widgets\market;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Maftuna Kodirova

 */

class ZMProductSingleWidget extends ZWidget
{


    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];



      public $layout =[];
      public $_layout =[
          'main' => <<<HTML

     <div class="container">
            <div class="row">
        <div class="col-lg-4 h-flex item">
            <span class="status active"><i class="fa fa-circle"></i> Есть в наличии</span>
            <div class="img">
                <a href="demo_files/3502" tabindex="0">
                    <img class="img-responsive" src="demo_files/Xiaomi_Redmi_8A_Dual_32_Sky_White.jpg" alt="Смартфон Xiaomi Redmi 8A Dual 32 ГБ Sky White">
                    <img class="icon" src="demo_files/hurry-02-02.svg" alt="Успейте купить">
                </a>
            </div>
            <h3 class="title"><a href="demo_files/3502" tabindex="0">Смартфон Xiaomi Redmi 8A Dual 32 ГБ Sky White</a></h3>
            <div class="col-xs-12">
                <button class="btn pull-right add-to-cart">&nbsp;</button>
            </div>
            <div class="clearfix"></div>
            <div class="rating-container rating-xs rating-animate">
                <div class="rating">
                    <span class="empty-stars">
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                    </span>
                    <span class="filled-stars" style="width: 54.4867%;">
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                        <span class="star">
                            <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                    </span>

                </div>
            </div>
            <span class="old-price">1 744 000 сум</span>
            <br>
            <span class="price">1 430 000 сум</span>
            <br>
            <div class="timer">
                <span class="time-icon">
                    <i class="fa fa-clock-o"></i>
                </span>
                <span id="clock" class="count-down"></span>
                <span class="count"><b>34</b><br><small>шт.</small></span>
            </div>
        </div>
    </div>
</div>
        

HTML,

     'css' => <<<CSS

    
    
CSS,

      ];


    public function asset()
    {
        $this->fileCss("https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css");
    }

    public function codes()
    {
        $this ->htm = strtr($this ->_layout['carditem'],[

            '{readonly}' => $this->_config['readonly'] ? 'readonly' :'',
        ]);
        
        $this ->css = strtr($this ->_layout['css'],[

        ]);


    }

}
