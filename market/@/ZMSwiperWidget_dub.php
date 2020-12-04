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


use zetsoft\system\kernels\ZWidget;

class   ZMSwiperWidgetdub extends ZWidget
{
    public $config = [];
    public $_config = [
        'slideWidget' => false,
        'slidesPerView' => 3,
        'spaceBetween' => 30,
        'centeredSlides' => true,
        'pagination.el' => '.swiper-pagination',
        'pagination.clickable' => true,

        'nextEl' => '.swiper-button-next',
        'prevEl' => '.swiper-button-prev',
        'mousewheel' => true,
        'keyboard' => true,
        'loop' => true,
        'effect' => ZMSwiperWidgetdub::effect['fade'],
        'grabCursor' => true,
        'rotate' => 50,
        'stretch' => 0,
        'depth' => 100,
        'modifier' => 1,
        'slideShadows' => true,

    ];

    public const effect = [
        'fade' => 'fade',
        'cube' => 'cube',
        'coverflow' => 'coverflow'
    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   <div class="swiper-container" id="{id}">
    <div class="swiper-wrapper">    
             {slide}   
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Navigation -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
HTML,

        'slide' => <<<HTML
     <div class="swiper-slide">{item}</div>
HTML,


        'image' => <<<HTML
        <div class="swiper-slide"><img src="{src}" alt=""></div>
HTML,
        'jscode' => <<<JS
        swiper = new Swiper('#{id}', {
         slidesPerView: {slidesPerView},
         spaceBetween: {spaceBetween},
         centeredSlides: {centeredSlides},
         mousewheel: {mousewheel},
         keyboard: {keyboard},
         loop: {loop},
         effect: '{fade}',
         grabCursor: {grabCursor},
        
        coverflowEffect: {
        rotate: {rotate},
        stretch: {stretch},
        depth: {depth},
        modifier: {modifier},
        slideShadows : {slideShadows},
      },
         
       
        // direction: 'vertical', kere bop qosa mobodo
         
         pagination: {
            el: "{el}",
            clickable: {clickable},
        },
        navigation: {
            nextEl: '{nextEl}',
            prevEl: '{prevEl}',
        },
     
       }, 
          )
    
JS,

    ];

    public function asset()
    {
        $this->fileCss("https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.3.8/css/swiper.min.css");
        $this->fileJs("https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.3.8/js/swiper.min.js");
    }


    public function codes()
    {

        $slide_code = '';
        foreach ($this->data as $value) {
            if ($this->_config['slideWidget'])
                $slide_code .= strtr($this->_layout['slide'], [
                    '{item}' => $value,
                ]);


            else
                $slide_code .= strtr($this->_layout['image'], [
                    '{src}' => $value
                ]);
        }

        $this->htm = strtr($this->_layout['main'], [

            '{id}' => $this->id,
            '{slide}' => $slide_code
        ]);
        $items = '';


        $this->js = strtr($this->_layout['jscode'], [
            '{slidesPerView}' => $this->_config['slidesPerView'],
            '{spaceBetween}' => $this->_config['spaceBetween'],
            '{centeredSlides}' => $this->_config['centeredSlides'] ? 'true' : 'false',
            '{el}' => $this->_config['pagination.el'],
            '{clickable}' => $this->_config['pagination.clickable'] ? 'true' : 'false',
            '{nextEl}' => $this->_config['nextEl'],
            '{prevEl}' => $this->_config['prevEl'],
            '{id}' => $this->id,
            '{mousewheel}' => $this->_config['mousewheel'] ? 'true' : 'false',
            '{keyboard}' => $this->_config['keyboard'] ? 'true' : 'false',
            '{loop}' => $this->_config['loop'] ? 'true' : 'false',
            '{effect}' => $this->_config['effect'],
            '{grabCursor}' => $this->_config['grabCursor'] ? 'true' : 'false',
            '{rotate}' => $this->_config['rotate'],
            '{stretch}' => $this->_config['stretch'],
            '{depth}' => $this->_config['depth'],
            '{modifier}' => $this->_config['modifier'],
            '{slideShadows}' => $this->_config['slideShadows'] ? 'true' : 'false',


        ]);
    }


}

