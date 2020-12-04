<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZBootsrapKhisravWidget extends ZWidget
{

    public $config = [];
    public $_config = [
  
    ];
    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];

    public const size = [
      '1' => '1',
      '2' => '2',
      '3' => '3',
      '4' => '4',
      '5' => '5',
      '6' => '6',
      '7' => '7',
      '8' => '8',
      '9' => '9',
      '10' => '10',
      '11' => '11',
      '12' => '12',
    ];

    public $event = [];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="custom-control  custom-checkbox image-checkbox">
                <input type="checkbox">
                <label class="thumbnail">
                    <img src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Fuji/2019/July/amazonbasics_520x520._SY304_CB442725065_.jpg" alt="#"  class="img-fluid">
                </label>
            </div>
        </div>
    </div>
</div>
HTML,



        'css' => <<<CSS
     .borderIn{
        border:3px solid red;
        opacity: 0.5;
    }
    .thumbnail:hover{
        border:3px solid red;
        opacity: 0.6;
    }
      
CSS,

        'js' => <<<JS
   $('.custom-checkbox > label').on("click", function () {
        //$("label").removeClass('borderIn');
        $(this).toggleClass('borderIn');
        /*$(this).addClass('borderIn');
        $(label).toggle('borderIn')*/
    })
    
JS,
    ];

    public function asset()
    {
        /*$this->fileCss('https://cdn.statically.io/gh/iqbalfn/bootstrap-image-checkbox/master/dist/css/bootstrap-image-checkbox.css');*/
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [

        ]);
   
        $this->js = strtr($this->_layout['js'], [

        ]);
        $this->css .= strtr($this->_layout['css'], [
        ]);
    }
}
