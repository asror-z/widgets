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
 * Class ZMProductCardWidget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Akhrorkhuja Azamkhujaev
 *
 */
class ZHotOfferWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'title' => 'Hot Offer',
        'rebate' => '- 59%',
        'image' => 'https://eldorado.am/upload/iblock/a86/a86eb294ddc01da49fc04402104e5a2d.jpg',
        'day' => '12',
        'hour' => '5',
        'minut' => '35',
        'secund' => '26',
        'itemname' => 'LG Smart Tv',
        'price' => '$189.99',
        'delprice' => '$239.99',
        'class' => '',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<section class="product-area">
    <div class="ht-offer">
        <div class="sec-title">
            <h6>{title}</h6>
        </div>
        <div class="ht-body owl-carousel">
            <div class="ht-item">
                <div class="ht-img">
                    <a href="#"><img src="{image}" alt="alt" class="img-fluid"></a>
                    <span>{rebate}</span>
                    <ul class="list-unstyled list-inline counter-box">
                        <li class="list-inline-item">{day} <p>Days</p></li>
                        <li class="list-inline-item">{hour} <p>Hrs</p></li>
                        <li class="list-inline-item">{minut} <p>Mins</p></li>
                        <li class="list-inline-item">{secund} <p>Sec</p></li>
                    </ul>
                </div>
                <div class="ht-content">
                    <p><a href="">{itemname}</a></p>
                    <ul class="list-unstyled list-inline fav">
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                    </ul>
                    <ul class="list-unstyled list-inline price">
                        <li class="list-inline-item">{price}</li>
                        <li class="list-inline-item">{delprice}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

HTML,


        'js' => <<<JS
        $(document).ready(function(){
	"use strict";

	// Hot Offer
	$(".ht-body").owlCarousel({
		autoplay:false,
    	autoplayHoverPause:true,
    	smartSpeed:500,
		loop: true,
		responsiveClass: true,
		items : 1,
		nav : true,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		margin: 0,
		dots: false,
    });

});
JS,


    ];

    /*public function init()
    {
        parent::init();
        ob_start();
    }*/


    public function asset()
    {
     $this->fileCss('\render\asrorz\theme\light.css');
    }

    public function codes()
    {


        $this->htm .= strtr($this->_layout['main'], [
            '{title}' => $this->_config['title'],
            '{rebate}' => $this->_config['rebate'],
            '{image}' => $this->_config['image'],
            '{day}' => $this->_config['day'],
            '{hour}' => $this->_config['hour'],
            '{minut}' => $this->_config['minut'],
            '{secund}' => $this->_config['secund'],
            '{itemname}' => $this->_config['itemname'],
            '{price}' => $this->_config['price'],
            '{delprice}' => $this->_config['delprice'],
            '{class}' => $this->_config['class'],

        ]);
        $this->css .= strtr($this->_layout['css'], []);
        $this->js .= strtr($this->_layout['js'], []);


    }

}
