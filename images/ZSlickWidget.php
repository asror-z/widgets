<?php

namespace zetsoft\widgets\images;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\kernels\ZWidget;


/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Jahongir Qudratov
 * Refacted By: Shuhrat Xaitov
 */
class ZSlickWidget extends ZWidget
{
     /**
     * Configuration
     */

    public $config = [];
    public $_config = [
        'dots' => true,
        'slidesToShow' => 1,
        'slidesToScroll' => 1,
        'autoplay' => true,
        'autoplaySpeed' => 2000,
        'items' => [],
        'id' => 'asdsa',
        'class' => 'slicker',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="col-md-12 my-5">
        <div class="slider-K slider-S {class}" id="{id}"  role="toolbar">
            {items}           
        </div>
        </div>

HTML,
        'item' => <<<HTML
        <div class ="slider-block mx-2" data-slick-index="0" aria-hidden="true"  tabindex="-1">
              {item_content}
        </div>
HTML,
    'css' =><<<CSS
        
            
 
CSS,



        'js' => <<<JS
     $(document).ready(function () {
        $('#{id}').slick({
           dots : {dots},
           slidesToShow: {slidesToShow},
           slidesToScroll: {slidesToScroll},
           autoplay:  {autoplay},
           autoplaySpeed:  {autoplaySpeed}
           
                
});
            
            /*accessibility: true,
            adaptiveHeight : false,
            arrows : {arrows},
            rows : {rows},
            easing : 'ease',
            centerPadding : '{centerPadding}',
            infinite : {infinite},
            speed : {speed},
            touchMove : {touchMove},
            cssEase : 'ease',
            fade : {fade},
            centerMode : {centerMode},
            slidesPerRow : 1,
            rtl : {rtl},
            responsive : [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: {slidesToScroll},
                        infinite: true,
                        dots: true
                    }
                },
               {
                    breakpoint: 600,
                   settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 2
                    }
                } ],
            mobileFirst : false,
            pauseOnFocus : false,
            pauseOnHover : false,
            pauseOnDotsHover : false,
            focusOnSelect : false,
            touchThreshold : 5,
            asNavFor : null,
            zIndex : 1000,
            slide : '',
            vertical : false,
            initialSlide : 1,
            useCSS : true,
            waitForAnimate : true,
            swipe : true,
            swipeToSlide : true,
            useTransform : true,
            variableWidth : false,
            edgeFriction : 0.15,
            verticalSwiping : false,*/

        });
JS,

    ];

    public function codes()
    {
        $items = '';
        $pagIndex='';
        foreach ($this->_config['items'] as $value) {
            $items .= strtr($this->_layout['item'], [
                '{item_content}' => $value
            ]);
//            $pagIndex .= $this->_layout['pagination'];
        }

        $this->htm = strtr($this->_layout['main'], [
            '{items}' => $items,
            '{id}' => $this->_config['id'],
            '{class}' => $this->_config['class']
//            '{pagIndex}' => $pagIndex
        ]);

        $this->css = strtr($this->_layout['css'],[
        

        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->jscode($this->_config['id']),
            '{dots}' => $this->jscode($this->_config['dots']),
            '{slidesToShow}' => $this->jscode($this->_config['slidesToShow']),
            '{slidesToScroll}' => $this->jscode($this->_config['slidesToScroll']),
            '{autoplay}' => $this->jscode($this->_config['autoplay']),
            '{autoplaySpeed}' => $this->jscode($this->_config['autoplaySpeed']),


       ]);


        $this->css = <<<CSS
                .slicker{                
                //box-shadow: inset 0px 0px 18px 1px rgba(0,0,0,0.1);
                padding: 10px 0;
                vertical-align: middle;
                }
                
                .slick-prev,.slick-next{
                    background-color: lightgrey!important;
                    font-size: 0!important;
                    border-radius: 50%;
                }   
                .slick-prev:hover,.slick-next:hover {
                    background-color: lightgrey!important;
                }
                
                /*section {*/
               /* width: 100%;
                position: relative;
                !*background-color: blue;*!
                !*}*!
                .content {
                margin: auto;
                padding: 20px;
                width: 800px;*/
                
                /*}*/
                
                /*.slider-Z {*/
                /*text-align: center;*/
                /*padding: 10px 0;*/
                /*}*/
                /*div .slider-block {*/
                /*position: relative;*/
                /*text-align: center;*/
                /*background-color: white;*/
                /*height: auto;*/
                /*}*/
     
CSS;

    }

}
