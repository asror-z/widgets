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
class ZZoomWidget1 extends ZWidget
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
            <main class="ps-main">
    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                </div>
            </div>
        </div>
    </div>
    <div class="ps-product--detail pt-60">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-lg-offset-1">
                    <div class="ps-product__thumbnail">
                        <div class="ps-product__preview">
                            <div class="ps-product__variants">
                                <div class="item"><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""></div>
                                <div class="item"><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""></div>
                                <div class="item"><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""></div>
                                <div class="item"><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""></div>
                                <div class="item"><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""></div>
                            </div><a class="popup-youtube ps-product__video" href="http://www.youtube.com/watch?v=0O2aH4XLbto"><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""><i class="fa fa-play"></i></a>
                        </div>
                        <div class="ps-product__image">
                            <div class="item"><img class="zoom" src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt="" data-zoom-image="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg"></div>
                            <div class="item"><img class="zoom" src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt="" data-zoom-image="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg"></div>
                            <div class="item"><img class="zoom" src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt="" data-zoom-image="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg"></div>
                        </div>
                    </div>
                    <div class="ps-product__thumbnail--mobile">
                        <div class="ps-product__main-img"><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""></div>
                        <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""><img src="https://mobimg.b-cdn.net/pic/v2/gallery/preview/fon-kapli-obekty-47133.jpg" alt=""></div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</main>
HTML,


        'js' => <<<JS
            
JS,


        'style' => <<<CSS

CSS,

    ];

    public function asset()
    {
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/font-awesome/css/font-awesome.min.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/ps-icon/material.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/owl-carousel/owl.carousel.min.js');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/slick/slick/slick.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/bootstrap-select/dist/css/bootstrap-select.min.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/Magnific-Popup/dist/magnific-popup.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/jquery-ui/jquery-ui.min.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/revolution/css/settings.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/revolution/css/layers.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/plugins/revolution/css/navigation.css');
        $this->fileCss('/render/animo/ZZoomWidget/template/css/material.css');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/jquery-bar-rating/dist/jquery.barrating.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/gmap3.min.js');
        $this->fileJs('/render/animo/ZZoomWidget/template/plugins/bootstrap-select/dist/js/bootstrap-select.min.js');
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
