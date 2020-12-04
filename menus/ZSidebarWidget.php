<?php

/**
 *
 *
 * Author: Shahzod Gulomqodirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 * Creat By: Shahzod Gulomqodirov
 *
 */

namespace zetsoft\widgets\menus;

use zetsoft\system\Az;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;

class ZSidebarWidget extends ZWidget
{
    public $config = [];
    public $_config = [];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   <div class="position-relative float-right align-middle h-100">
    <div>
        <div id="sidenavslider">
            <span id="side-menu-slider-right" class="h-100 position-absolute "><i
                        class="rounded-circle pl-1 d-flex align-items-center justify-content-center white-text fas fa-chevron-right fa-lg"></i></span>
            <span id="side-menu-slider-left" class=" h-100 position-absolute d-none"><i
                        class="rounded-circle d-flex align-items-center justify-content-center white-text fas fa-chevron-left fa-lg"></i></span>
        </div>
    </div>
    <ul class="menu-left misopen" id="side-icon-bar">

        <li>
            <a class="font-weight-bold hint--left hint--rounded hint--bounce" aria-label="Купоны" href="#">
                <span class="fas fa-archive"></span>
            </a>
        </li>
        <li>
            <a class="font-weight-bold hint--left hint--bounce" aria-label="Cписок пожеланий" href="#">
                <span class="far fa-heart"></span>
            </a></li>
        <li>
            <a class="font-weight-bold hint--left hint--rounded hint--bounce" aria-label="Панель" href="#">
                <span class="far fa-list-alt"></span>
            </a></li>
        <li>
            <a class="font-weight-bold hint--left hint--rounded" aria-label="История" href="#"><span
                        class="fas fa-history"></span>
            </a></li>

        <li class="mtop">
            <a class="font-weight-bold hint--left hint--rounded hint--bounce" aria-label="Поделиться" href="#">
                <span class="fas fa-share-alt"></span>
            </a>
        </li>
        <li>
            <a class="font-weight-bold hint--left" aria-label="Обратная связь" href="#">
                <span class="fas fa-pen"></span>
            </a>
        </li>
        <li class="scroll_top_">
            <font class="font-weight-bold hint--left hint--rounded hint--bounce"
               aria-label="Вверх" href="#">
                <span class="fas fa-chevron-up">
                
</span>
            </font>
        </li>
    </ul>
</div>
HTML,

        'css' => <<<CSS



CSS,
        'js' => <<<JS
    var sidenavslider = $('#sidenavslider');
   
    var sideiconbar = $('#side-icon-bar');
    var state = window.localStorage.getItem('sideBarStatus');
    if (state === 'open'){
            sideiconbar.show(100);
            sideiconbar.addClass('misopen');
            $('#side-menu-slider-right').removeClass('d-none');
            $('#side-menu-slider-left').addClass('d-none');
            sidenavslider.css('right', '80px');
            $('.ilon-mask').css({'width': '98%', 'transition': '0.5s'});
            $('body').css({'width': '98%', 'transition': '0.5s'});
            $('.content-footer').css({'width': '98%', 'transition': '0.5s'});
            
    } else {
            sideiconbar.hide(100);
            sideiconbar.removeClass('misopen');
            $('#side-menu-slider-left').removeClass('d-none');
            $('#side-menu-slider-right').addClass('d-none');
            sidenavslider.css('right','40px');
            $('.ilon-mask').css({'width': '100%', 'transition': '0.5s'});
            $('.main-sectio').css({'width': '100%', 'transition': '0.5s'});
            $('.content-footer').css({'width': '100%', 'transition': '0.5s'});
            $('.sticky-menu').css({'width': '100%', 'transition': '0.5s'});
    }
   // } 
   // else {
   //      if (!sideiconbar.hasClass('misopen')){}else{
   //            sideiconbar.removeClass('misopen');
   //      } 
   // }
    sidenavslider.find('i').css({'height': '35px', 'width': '35px', 'background-color': 'lightgray'});
    sidenavslider.find('i').mouseover(function(){
        $(this).addClass('z-depth-2');
        sidenavslider.find('i').removeClass('white-text');
        sidenavslider.find('i').addClass('green-text');
        sidenavslider.find('i').css({'background-color': 'white'});
    })
    sidenavslider.find('i').mouseleave(function(){
        $(this).removeClass('z-depth-2');
        sidenavslider.find('i').addClass('white-text');
        sidenavslider.find('i').removeClass('green-text');
        sidenavslider.find('i').css('background-color', 'lightgray');
    })
    sidenavslider.css({
        'background': 'none !important',
        'box-shadow': 'none !important',
        'position': 'absolute',
        'top': '50vh',
        'transition': 'top 100',
        'z-index': '1'
    });
    (state === 'open') ? sidenavslider.css('right', '80px') : sidenavslider.css('right', '40px');
    sidenavslider.click(function (event) {
        if (sideiconbar.hasClass('misopen')) {
          window.localStorage.setItem('sideBarStatus','open');
            sidenavslider.css({'right': '80px', 'transition': '0.5s'});
            $('.menu-left').css('transition', '1s')
            sideiconbar.toggle(100);
            sideiconbar.toggleClass('misopen');
            $('.ilon-mask').css({'width': '98%', 'transition': '0.5s'});
            $('.container-fluid').css({'width': '98%', 'transition': '0.5s'});
            $('.content-footer').css({'width': '98%', 'transition': '0.5s'});
            $('#side-menu-slider-right').toggleClass('d-none', 1000);
            $('#side-menu-slider-left').toggleClass('d-none', 1000);
        } else {
           window.localStorage.setItem('sideBarStatus','closed');
            sideiconbar.toggle(100);
            sideiconbar.toggleClass('misopen');
            $('#side-menu-slider-right').toggleClass('d-none', 1000);
            $('#side-menu-slider-left').toggleClass('d-none', 1000);
            sidenavslider.css({'right': '40px', 'transition': '0.5s'});
            $('.ilon-mask').css({'width': '100%', 'transition': '0.5s'});
            $('.container-fluid').css({'width': '100%', 'transition': '0.5s'});
            $('.content-footer').css({'width': '100%', 'transition': '0.5s'}); 
        }
    });


    $(window).scroll(function (event) {
        var height = $(window).scrollTop();
        var lineHeight = $(window).height() / 2;
        sidenavslider.fadeIn().css('top', 'calc(40vh + ' + height + 'px)');
    })

    $('.scroll_top_').click(function () {
        $('html, body').animate({scrollTop: 0}, 1000);
    });
    $('.fa-list-alt').click(function () {
        $('.jsPanel').toggle();
    });
  
JS,
    ];


    public function asset()
    {
        $this->fileCss('/render/menus/ZSidebarWidget/assets/style.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.6.0/hint.min.css');
    }


    public function codes()
    {

        /*ZModalNewWidget::begin([
            'id' => 'loggerPanel',
            'config' => [
                'title' => az::l('panel'),
                'size' => ZModalNewWidget::size['lg']
            ]
        ]);
        echo ZJspanelWidget::widget();

        ZModalNewWidget::end();*/
        
        echo ZJspanelWidget::widget([
            'config' => [
                /*'iconbar' => [
                    [
                        'icon' => 'fa-eraser',
                        'func' => 'panel.content.innerHTML = \'\';'
                    ],
                    [
                        'icon' => 'fa-stop-circle',
                        'func' =>  ""
                    ],
                ],*/
                'headt' => Az::l('Процесс')
            ]
        ]);

        $this->htm = strtr($this->_layout['main'], []);

        $this->css = strtr($this->_layout['css'], []);

        $this->js = strtr($this->_layout['js'], []);

    }
}
