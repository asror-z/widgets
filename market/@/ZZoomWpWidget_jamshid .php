<?php
/*
 * Created By: Shahzod Gulomqodirov
 * */

namespace zetsoft\widgets\market;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZZoomWpWidget_jamshid extends ZWidget
{

    public $data = [
        'https://static-01.daraz.pk/p/83b3c9646204ea3de622893858c80f25.jpg',
        'https://photographyfirm.co.uk/wp-content/uploads/2016/06/WHITE-BACKGROUND-PRODUCT-PHOTOGRAPHY-19.jpg',
        'https://cdn.shopify.com/s/files/1/0072/2609/7731/products/product-image-677529483.jpg?v=1579678093',
        'https://buvelle.com/wp-content/uploads/2019/01/buvelle-sophie-black-mesh-full-black-BV1128-800x800.jpg',
        'https://www.isa-aydin.com/wp-content/uploads/2020/04/product-on-white-sample-2.jpg?x96595',
        'https://www.isa-aydin.com/wp-content/uploads/2020/04/product-on-white-sample-4.jpg?x96595',
    ];

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
     * Layouts
     * */
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

    <div class="bolk">
        <div class="bolk">
                    <a class="wpb-wiz-main-images"
                       href="{mainfoto}">
                        <div  class="zoomWrapper">
                            <img 
                                 src="{mainfoto}"
                                 class="wpb-wiz-main-image wp-post-image"
                                 data-src="{mainfoto}"
                                 data-large_image="{mainfoto}"
                                 data-large_image_width="1000"
                                 data-large_image_height="1000"
                                 data-zoom-image="{mainfoto}"
                                 style="position: absolute;">

                    </a>
                </div>
                <div id="wpb_wiz_gallery" class="thumbnails wpb_wiz_gallery_slider owl-theme owl-carousel owl-loaded owl-drag">

                    <div class="owl-stage">
                    
                        {fotos}
                     
                    </div>
                </div>


        </div>
</div>
HTML,

        'css' => <<<CSS

        
CSS,

        'js' => <<<JS
            jQuery(function ($) {
                  'use strict'

                // The Product gallery Slider
                $(".wpb_wiz_gallery_slider").owlCarousel({
                    //nav: true,
                    navText: ["<i class='fa fa-arrow-left '></i>","<i class='fa fa-arrow-right '></i>"],
                    dots: false,
                    margin: 10,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 4,
                        },
                        480: {
                            items: 4,
                        },
                        768: {
                            items: 4,
                        },
                        1170: {
                            items: 3,
                        },
                        1200: {
                            items: 4,
                        }
                    },  
                    rtl: false,
                });

                // Init the zoom

                if ($.isFunction($.fn.elevateZoom)) {
                    $(".wpb-wiz-main-image").elevateZoom({
                        gallery: 'wpb_wiz_gallery',
                        galleryActiveClass: 'wpb-wiz-active',
                        imageCrossfade: true,
                        loadingIcon: 'http://demo2.wpbean.com/wp-content/uploads/2016/07/AjaxLoader.gif',
                        cursor: "crosshair",
                        lensSize: 200,
                        lensShape: "square",
                        lensColour: "#ffffff",
                        borderSize: 1,
                        borderColour: '#888888',
                        zoomType: "inner",
                        responsive: true,
                        zoomWindowWidth: 500,
                        zoomWindowHeight: 400,
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 500,
                        zoomWindowPosition: 1,
                        zoomWindowOffetx: 10,
                        easing: true, 
                    });
                }

                // Popup With zoom
                $(".wpb-wiz-main-image").bind("click", function (e) {
                    var ez = $('.wpb-wiz-main-image').data('elevateZoom');


                    ez.closeAll(); //NEW: This function force hides the lens, tint and window
                    $.fancybox.close();
                    $.fancybox.open(
                        ez.getGalleryListFancyboxThree(), {});


                    return false;
                });
                let img = $('.single-product .wpb-wiz-main-images img');
                // Remove srcset & size attr
                $("#wpb_wiz_gallery a").on("click", function () {
                    let owl_items = $('.owl-item');
                    owl_items.removeClass('border border-success');
                    $(this).parent('div').addClass('border border-success')
                 
                  
                  img.removeAttr('srcset')
                  img.removeAttr('sizes')
                });
            });
JS,

        'item' => <<<HTML
        <div class="owl-item active my-3 border border-gray">
            <a href="#" data-image="{item}"
               data-zoom-image="{item}">
                <img
                     src="{item}"
                     data-src="{item}"
                     data-large_image="{item}"
                     data-large_image_width="1000" 
                     data-large_image_height="1000">
            </a>
        </div>
HTML,


    ];


    public function asset()
    {
        $this->fileCss('/render/market/ZZoomWpWidget/assets/style.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
        $this->fileCss('https://demo2.wpbean.com/wp-content/plugins/wpb-woocommerce-custom-tab-manager-pro/inc/../assets/css/main-style.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
        $this->fileCss('https://demo2.wpbean.com/wp-content/themes/twentytwelve/css/ie.css');
        $this->fileCss('https://demo2.wpbean.com/wp-content/plugins/wpb-accordion-menu-or-category-pro/admin/assets/css/themify-icons.css');
        $this->fileCss('https://demo2.wpbean.com/wp-content/plugins/wpb-accordion-menu-or-category-pro/assets/css/wpb_wmca_style.css');


        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
        $this->fileJs('/render/market/ZZoomWpWidget_jamshid/assets/main.js');
    }

    public function codes()
    {
        $fotos = '';
        foreach ($this->data as $val) {
            $fotos .= strtr($this->_layout['item'], [
                '{item}' => $val
            ]);
        }


        $this->htm .= strtr($this->_layout['main'], [
            '{mainfoto}' => ZArrayHelper::getValue($this->data, 0),
            '{fotos}' => $fotos,
        ]);
        $this->css .= strtr($this->_layout['css'], []);
        $this->js .= strtr($this->_layout['js'], []);
    }
}
