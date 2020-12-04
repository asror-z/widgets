<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;


/**
 *  Created by Muhriddin Pardabayev
 *
 */
class ZZoomWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];

    /**
     *
     * Constants
     */
    public const type = [
       
    ];


    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div class="ps-product__preview">
                            <div class="ps-product__variants">
                                <div class="item"><img src="images/shoe-detail/1.jpg" alt=""></div>
                                <div class="item"><img src="images/shoe-detail/2.jpg" alt=""></div>
                                <div class="item"><img src="images/shoe-detail/3.jpg" alt=""></div>
                                <div class="item"><img src="images/shoe-detail/3.jpg" alt=""></div>
                                <div class="item"><img src="images/shoe-detail/3.jpg" alt=""></div>
                            </div><a class="popup-youtube ps-product__video" href="http://www.youtube.com/watch?v=0O2aH4XLbto"><img src="images/shoe-detail/1.jpg" alt=""><i class="fa fa-play"></i></a>
                        </div>
HTML,
        'main2' => <<<HTML
                 <div class="ps-product__image">
                            <div class="item"><img class="zoom" src="images/shoe-detail/1.jpg" alt="" data-zoom-image="images/shoe-detail/1.jpg"></div>
                            <div class="item"><img class="zoom" src="images/shoe-detail/2.jpg" alt="" data-zoom-image="images/shoe-detail/2.jpg"></div>
                            <div class="item"><img class="zoom" src="images/shoe-detail/3.jpg" alt="" data-zoom-image="images/shoe-detail/3.jpg"></div>
                        </div>
                
HTML,
        'mobile' => <<<HTML
                <div class="ps-product__thumbnail--mobile">
                        <div class="ps-product__main-img"><img src="images/shoe-detail/1.jpg" alt=""></div>
                        <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="images/shoe-detail/1.jpg" alt=""><img src="images/shoe-detail/2.jpg" alt=""><img src="images/shoe-detail/3.jpg" alt=""></div>
                    </div>
HTML,

        'js' => <<<JS
            
JS,


        'style' => <<<CSS

CSS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/ps-icon/material.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-bar-rating@1.2.2/dist/themes/fontawesome-stars.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/css/bootstrap-select.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/revolution/css/settings.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/revolution/css/layers.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/revolution/css/navigation.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/css/material.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-bar-rating@1.2.2/jquery.barrating.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/gmap3.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/js/bootstrap-select.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/slick/slick/slick.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/elevatezoom/jquery.elevatezoom.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/revolution/js/jquery.themepunch.tools.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/revolution/js/jquery.themepunch.revolution.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/revolution/js/extensions/revolution.extension.video.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/revolution/js/extensions/revolution.extension.navigation.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/revolution/js/extensions/revolution.extension.parallax.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/revolution/js/extensions/revolution.extension.actions.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/js/main.js');
    }

    public function codes()
    {
        $this->htm= strtr($this->_layout["main"],[]);
    }


}
