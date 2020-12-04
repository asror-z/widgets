<?php

namespace zetsoft\widgets\bozor;


use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\models\menu\MenuImage;
use zetsoft\service\menu\ALL;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;


/**
 *
 * Class ZAliMenuWidget
 *
 * Created BY: Xakimjon Ergashov
 */
class ZAliMenuWidgetX1 extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'menuTitle' => 'Категории',
        'btnMenu' => false,
        'categoriesTitle' => 'Телефоны и аксессуары',
        'subCategoriesTitle' => 'Чехлы для смартфонов',
        'itemTitle' => 'HUAWEI',
        'brandImageSrc' => '//ae01.alicdn.com/kf/HTB1rbnsAmtYBeNjSspaq6yOOFXaP.jpg',
    ];


    public const mode = [
        'menu' => 'menu',
        'shop' => 'shop',

    ];

    public $menu_data = '';
    public $defaul_image = "/render/market2/ZMenuWidget/asset/images/m-cloth.png";
    public $data = [];
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
        $this->fileCss("//assets.alicdn.com/g/ae-fe/home-ui/0.0.17/page/home.css");
        $this->fileCss("//assets.alicdn.com/g/ae-fe/header-ui/0.0.5/src/ae-header-ru.css");
        $this->fileJs("/render/market/ZMenuWidget/asset/js/custom.js");
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

     <div class="col-md-12">
         <div class="index-page">
    <div class="page-container">
    
            <div class="home-firstscreen-top-bar"></div>
            <div class="container">
            
                <div class="home-firstscreen-main">
                      
        <div id="home-firstscreen" class="home-firstscreen">
                       
                    <div class="categories">
                     <button class="myBtn d-{btnDisplay}" id="myBtn">
                        <img src="/render/bozor/ZAliMenuWidget/assets/image/dropdown.png" alt="">
                    </button>
                        <div id="menuId" class="categories-main new-categories-main categories-main-home d-{menuDisplay}"
                             data-role="category-content" data-spm="16005" data-widget-cid="widget-3">
                            <div class="categories-content-title"><a
                                    href="#"><span>{menuTitle}</span><i class="iconfont icon-arrow-right-x">&nbsp;</i>
                            </a></div>
                            <div class="categories-list-box">
                                         
                                {categoriesListbox}
                                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

HTML,
        'categoriesListbox' => <<<HTML
                    <dl class="cl-item cl-item-phones" 
                            data-role="first-menu" data-spm="103">
                                    <dt class="cate-name" id="cate-name"><span><a
                                            href="#">{categories}</a></span>
                                    </dt>
                                    <dd class="sub-cate" data-path="c-phones-content-ru" data-role="first-menu-main">
                                        <div class="cl-item cl-item-phones" data-role="first-menu" data-spm="104">
                                            <div class="sub-cate-main">
                                                <div class="sub-cate-content float-right"
                                                </div>
                                                
                                                <div class="">
                                                    <div class="sub-menu-class d-flex flex-column">
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                        {subMenu}
                                                
                                                </div>
                                                
                                                
                                                {brandsImages}
                                                {brandsImages}
                                                
                                                
</div>
                                                
                                                
                                                
                                              
                                            </div>
                                        </div>
                                    </dd>
                                </dl>      
HTML,

        'subMenu' => <<<HTML
    <div>

    <div class="sub-cate-row">
                
                    <dl class="sub-cate-items" data-role="two-menu">
                         
                          {subMenuDT}
                          
                           {subMenuDD}
                          
                             
                 </dl>

                     
                       </div>

</div>
                

HTML,

        'subMenuDT' => <<<HTML

                           <dt>
                                 <a href="#"><h7>{subCategories}</h7></a>
                          </dt>   

HTML,

        'subMenuDD' => <<<HTML

                            <dd>
                                <a href="#">{item}</a>
                            </dd>

HTML,


        'brandsImages' => <<<HTML
                
                     <div class="sub-cate-row">
                            <dl class="sub-cate-items hidden-md hidden-sm" data-role="two-menu">
                                <dd class="mall-brands-list">
                                   <a href="//huaweirussia.aliexpress.ru/store/5234011">
                                         <img src="{brandImage}">
                                   </a>
                                 </dd>
                           </dl>
                     </div>
HTML,

        'item' => <<<HTML
         <dd>
              <a href="#">{item}</a>
         </dd>
HTML,


        'css' => <<<CSS
      
         .ilon-mask{
            display: none;
         }
         
         .myBtn{
        overflow: hidden;
    }

    .myBtn img{
        background-color: wheat;
        width: 2.5rem;
        height: 2rem
    }
                            
    .myBtn:hover{
         background-color: whitesmoke;
    }
    .home-firstscreen{
        background-color: white;

    }
    .sub-menu-class{
    
        /*max-height: 200px;
        overflow: scroll;*/
        
    } 
    .sub-cate-row, sub-cate-items{
        display: inline-block !important;
    } 
CSS,

        'js' => <<<JS
       $( document ).ready(function() {
            $('.cate-name,.cl-item .sub-cate').hover(function () {
            $('.cl-item .sub-cate').toggleClass('d-block');
        });
        
        let menuId = $('#menuId')
            $('#myBtn, #menuId').hover(function () {
             menuId.toggleClass('d-none');
        })
    });
       
JS,

    ];


    public function codes()
    {


        $brandsImages = '';
        $subMenuDT = '';
        $subMenuDD = '';

        $subMenuDT .= strtr($this->_layout['subMenuDT'], [
            '{subCategories}' => $this->_config['subCategoriesTitle'],
        ]);

        $subMenuDD .= strtr($this->_layout['subMenuDD'], [
            '{item}' => $this->_config['itemTitle'],
        ]);
        $brandsImages .= strtr($this->_layout['brandsImages'], [
            '{brandImage}' => $this->_config['brandImageSrc'],
        ]);

        $subMenu = '';
        $subMenu .= strtr($this->_layout['subMenu'], [

            '{subMenuDT}' => $subMenuDT,

            '{subMenuDD}' => $subMenuDD,

            /*vdd($subMenuDD)*/

        ]);

        $categoriesListbox = '';
        $categoriesListbox .= strtr($this->_layout['categoriesListbox'], [
            '{subMenu}' => $subMenu,
            '{brandsImages}' => $brandsImages,
            '{categories}' => $this->_config['categoriesTitle'],
        ]);


        $this->htm = strtr($this->_layout['main'], [
            '{menuTitle}' => 'Kategoriya',
            '{categoriesListbox}' => $categoriesListbox,
            '{btnDisplay}' => $this->_config['btnMenu'] ? 'block' : 'none',
            '{menuDisplay}' => $this->_config['btnMenu'] ? 'none' : 'block',


        ]);


        $this->css = strtr($this->_layout['css'], [

        ]);

        $this->js = strtr($this->_layout['js'], [

        ]);

    }

}
