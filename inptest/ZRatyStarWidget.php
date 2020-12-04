<?php

/**
 *
 *  class ZTCheckboxWidget
 *
 *  https://github.com/kleinejan/titatoggle
 *  http://kleinejan.github.io/titatoggle/
 *
 *
 * Author: Jasurbek Normurodov
 * Refactored: Jasurbek Normurodov
 *
 */

namespace zetsoft\widgets\inptest;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\SwitchInput;
use yii\web\JsExpression;

class ZRatyStarWidget extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    public const Colors = [
        'default' => '',
    ];

    public $event = [];
    public $_event = [
    ];


    public $layout = [];
    public $_layout = [
            'main' => <<<HTML
                 <div class="rating-area">
    <input type="radio" id="star-5" name="rating" value="5">
    <label for="star-5" title="Оценка «5»"></label>
    <input type="radio" id="star-4" name="rating" value="4">
    <label for="star-4" title="Оценка «4»"></label>
    <input type="radio" id="star-3" name="rating" value="3">
    <label for="star-3" title="Оценка «3»"></label>
    <input type="radio" id="star-2" name="rating" value="2">
    <label for="star-2" title="Оценка «2»"></label>
    <input type="radio" id="star-1" name="rating" value="1">
    <label for="star-1" title="Оценка «1»"></label>
</div>

HTML,
        'css'=><<<CSS
          .rating-area {
                           overflow: hidden;
                           width: 265px;
                           margin: 0 auto;
                       }
        .rating-area:not(:checked) > input {
            display: none;
        }
        .rating-area:not(:checked) > label {
            float: right;
            width: 42px;
            padding: 0;
            cursor: pointer;
            font-size: 50px;
            line-height: 50px;
            color: lightgrey;
            text-shadow: 1px 1px #bbb;
        }
        .rating-area:not(:checked) > label:before {
            content: '★';
        }
        .rating-area > input:checked ~ label {
            color: gold;
            text-shadow: 1px 1px #c60;
        }
        .rating-area:not(:checked) > label:hover,
        .rating-area:not(:checked) > label:hover ~ label {
            color: gold;
        }
        .rating-area > input:checked + label:hover,
        .rating-area > input:checked + label:hover ~ label,
        .rating-area > input:checked ~ label:hover,
        .rating-area > input:checked ~ label:hover ~ label,
        .rating-area > label:hover ~ input:checked ~ label {
            color: gold;
            text-shadow: 1px 1px goldenrod;
        }
        .rate-area > label:active {
            position: relative;
        }
CSS,

      'js' => <<<JS

     (function(){
        ('.container').rating();
    });
JS,

  ];



    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/css-star-rating@1.2.4/css/star-rating.min.css');
        $this->fileJs('https://raw.githubusercontent.com/irfan/jquery-star-rating/master/src/rating.js');
    }


    public function codes()
    {
        

        $this->htm .= strtr($this->_layout['main'], [
                
            ]
        );
        $this->css = strtr($this->_layout['css'], []);
        $this->js = strtr($this->_layout['js'], [
        ]);


    }
}
