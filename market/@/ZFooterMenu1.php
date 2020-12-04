<?php


namespace zetsoft\widgets\market;


use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZFooterMenu1 extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'color' => '#94969b',
        'class' => 'fa fa-angle-right',

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="footer-div list">
        <section class="footer-top">
            <div class="container">
                <div class="row">
                  {menulist}
                 
                </div>
            </div>
        </section>
        <section class="footer-btm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>Copyright &copy; 2020 | Bozorboy<i class="fa fa-heart" style="color: #f12121!important; float: none;" ></i> by <a href="#" target="_blank" style="color: {color_company};">ZetSoft</a></p>
                    </div>
                    <div class="col-md-6 text-right" >
<!--                        <img src="/render/market/ZFooterListWidget/demo/images/payment.png" alt="" class="img-fluid">-->
                    </div>
                </div>
            </div>
            <div class="back-to-top text-center">
                   <i class="fa fa-angle-up" style="color: {color}; font-size: 25px;" ></i>
<!--                <img src="/render/market/ZFooterListWidget/demo/images/backtotop.png" alt="" class="img-fluid">-->
            </div>
        </section>
    </div>
          
HTML,
        'menulist'=><<< HTML
  <div class="col-md-3">
                        <div class="f-cat">
                            <h5 style="color: {color};">{Categories}</h5>
                            <ul class="list-unstyled">
                                
                                {categoryList}
                                
                            </ul>
                        </div>
                    </div>
HTML,

        'categoryList' => <<<HTML
        <li><a href="{url}"><i class="{class}"></i>{categoryListNames}</a></li>
HTML,
      'List' => <<<HTML
        <li id={id}><img src="{icon}"><a href=""><i class="{class}"></i>{ListName}</a></li>
HTML,


        'css'=> <<<CSS
           .footer-top {
    background: #f8f8f8;
    padding: 50px 0 40px;
}
       .footer-btm{background-color: #f3f3f3;
        color: #000000;}
           .list-unstyled li a:hover  {
                color: #10b410!important;
            }  

      
              
            .footer-div .list{
                 width: 100%;
            }

            
CSS,
   'js'=> <<<JS
  \$(document).on('click', '#{id}', function(){\$("#loginNavbar").modal('show')});
 \$(document).on('click', '#fv{id}', function(){\$(fastRegisterVendor).modal('show')});
  \$(document).on('click', '#fu{id}', function(){\$(fastRegister).modal('show')});

            
JS,

        



    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');
    }

    public function codes()
    {

        $categories = ShopCategory::find()->all();

        $categoryListCode = '';
        /** @var Category[] $categories */

        foreach ($categories as $category) {
            if(!empty($category->child))
            $categoryListCode .= strtr($this->_layout['categoryList'], [
                '{categoryListNames}' => $category->name,
               '{url}' => $category->url,
            ]);
        }
        $categoryListCode =strtr($this->_layout['menulist'], [
            '{color}' => $this->_config['color'],
            '{Categories}'=> Az::l('Категории'),
            '{categoryList}' => $categoryListCode
        ]);

 //Info start       
$info='';
$info.= strtr($this->_layout['List'], [
                '{icon}' => 'http://bozorboy.com/pictures/icons/5039.png',
                '{ListName}' => 'О нашем сервисе'
            ]);
$info.= strtr($this->_layout['List'], [
                '{icon}' => 'http://bozorboy.com/pictures/icons/5040.png',
                '{ListName}' => 'Принимаемые платежи'
            ]);
$info.= strtr($this->_layout['List'], [
                '{icon}' => 'http://bozorboy.com/pictures/icons/5041.png',
                '{ListName}' => 'Правила доставки'
            ]);
$info.= strtr($this->_layout['List'], [
                '{icon}' => 'http://bozorboy.com/pictures/icons/5042.png',
                '{ListName}' => 'Обработка данных'
            ]);
$info.= strtr($this->_layout['List'], [
                '{icon}' => 'http://bozorboy.com/pictures/icons/5044.png',
                '{ListName}' => 'Наши контакты'
            ]);
 $categoryListCode .=strtr($this->_layout['menulist'], [
    '{color}' => $this->_config['color'],
            '{Categories}'=> Az::l('Информация'),
            '{categoryList}' => $info
        ]);

 //Info end  

//Register start       
$login='';
$login.= strtr($this->_layout['List'], [
                 '{id}' => $this ->id, 
                '{icon}' => 'http://bozorboy.com/pictures/icons/5045.png',
                '{ListName}' => 'Вход'
            ]);
$login.= strtr($this->_layout['List'], [
                  '{id}' => 'fv'.$this ->id, 
                '{icon}' => 'http://bozorboy.com/pictures/icons/5046.png',
                '{ListName}' => 'Регистрация поставщика'
            ]);
$login.= strtr($this->_layout['List'], [
                  '{id}' => 'fu'.$this ->id, 
                '{icon}' => 'http://bozorboy.com/pictures/icons/5042.png',
                '{ListName}' => 'Регистрация пользователя'
            ]);
//Register end

 $categoryListCode .=strtr($this->_layout['menulist'], [
    '{color}' => $this->_config['color'],
            '{Categories}'=> Az::l('Личный кабинет'),
            '{categoryList}' => $login
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{color}' => $this->_config['color'],
            '{color_company}' => '#0049ff',
            '{class}' => $this->_config['class'],
            '{menulist}' => $categoryListCode,
        ]);

        $this->css= strtr($this->_layout['css'], [
            '{color}' => $this->_config['color'],
        ]);
  $this->js= strtr($this->_layout['js'], [
            '{id}' => $this ->id,
        ]);
    }

}

