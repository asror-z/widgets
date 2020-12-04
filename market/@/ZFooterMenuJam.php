<?php


namespace zetsoft\widgets\market;


use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZFooterMenu extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'color' => 'white',
        'class' => 'fa fa-angle-right',
        'url' => '',
        'registrationUrl' => '',


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
                <div class="row zleft d-flex align-items-center">
                    <div class="col-md-6">
                        <p class="zcolor zlr">Copyright &copy; 2020 | Bozorboy<i class="fa fa-heart zcolor"></i> by <a href="#" target="_blank" class="zcolor"">ZetSoft</a></p>
                    </div>
                    
                </div>
            </div>
<!--            <div class="back-to-top text-center">-->
<!--                   <i class="fa fa-angle-up angleup" style="color: {color}; font-size: 25px; " ></i>-->
<!--                        &lt;!&ndash;<img src="/render/market/ZFooterListWidget/demo/images/backtotop.png" alt="" class="img-fluid">&ndash;&gt;-->
<!--            </div>-->
        </section>
    </div>
          
HTML,
        'menulist' => <<< HTML
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
        <li id={id}><img src="{icon}"><a href="{url}"><i class="{class}"></i>{ListName}</a></li>
HTML,


        'css' => <<<CSS
            .footer-top {
            border: 1px solid #efefef!important;
            background: #10b410;
            padding: 50px 0 40px;
            }       
            .logo-area {
            padding-top: 0!important;
            }
            .footer-btm {
            background-color: #10b410;
            border-top: 0 !important; 
            height: 0;
           
            }
            .footer-btm p {
            color: #efefef;
            
            }
            .footer-div .list{
            width: 100%;
            }
            .back-to-top {
            border: 1px solid #10b410!important;
            }
            .zcolor {
                color: #ffffff!important;
                padding-left: 5px;
                font-size: 18px!important;
                
            }
            
            .f-cat .list-unstyled li img {
            display: none;
            }
            .f-cat .list-unstyled li  a {
                color: white !important;
            }
            .f-cat .list-unstyled li  a:hover {
                opacity: 0.8;
                color: grey;
            }
            .f-cat .list-unstyled {
                margin-left: -10px;
            }
            .logo-text {
                font-size: 25px;
                color: white;
            }
            /*.zetshop {*/
            /*    font-family: 'Marck Script', cursive;*/
            /*    color: #fff;*/
            /*    font-size: 40px;*/
            /*    text-align: center;*/
            /*    padding: 10px 20px;*/
            /*}*/
            
            .zleft {
            margin-top: -20px;
            }
            .zleft-icon {
                display:flex;
                justify-content:center;
                align-items: center;
                width: 40px;
                height: 40px;
                background-color: #fff;
                border-radius: 50%;
                margin-left: 5px;
            }
            .zleft-icon i {
                color: #10b410!important;
            }
            .zleft-icon i:hover {
            opacity: 0.8;
            }
            .zleft-left {
                display:flex;
                justify-content:space-around;
            }
            
            
            

            
CSS,
        'js' => <<<JS
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

        ////////////
        $child_ids = [];
        foreach ($categories as $category) {
            $child_sub_arr = (array)$category->child;
            $child_sub_arr = array_map(function ($a) {
                return (int)$a;
            }, $child_sub_arr);
            $child_ids = array_merge($child_ids, $child_sub_arr);
        }
        $parent_categories = array_filter($categories, function ($a) use ($child_ids) {
            if (!in_array($a->id, $child_ids))
                return $a;
        });

        $categories = $parent_categories;
        ////////

        foreach ($categories as $category) {
            if (!empty($category->child))
                $categoryListCode .= strtr($this->_layout['categoryList'], [
                    '{categoryListNames}' => $category->name,
                    '{url}' => $category->url,
                ]);
        }
        $categoryListCode = strtr($this->_layout['menulist'], [
            '{color}' => $this->_config['color'],
            '{Categories}' => Az::l('Категории'),
            '{categoryList}' => $categoryListCode,
            '{url}' => $this->_config['url']
        ]);

        //Info start
        $info = '';
        $info .= strtr($this->_layout['List'], [
            '{icon}' => 'http://bozorboy.com/pictures/icons/5039.png',
            '{ListName}' => 'О нашем сервисе',
            '{url}' => $this->_config['url']
        ]);
        $info .= strtr($this->_layout['List'], [
            '{icon}' => 'http://bozorboy.com/pictures/icons/5040.png',
            '{ListName}' => 'Принимаемые платежи'
        ]);
        $info .= strtr($this->_layout['List'], [
            '{icon}' => 'http://bozorboy.com/pictures/icons/5041.png',
            '{ListName}' => 'Правила доставки'
        ]);
        $info .= strtr($this->_layout['List'], [
            '{icon}' => 'http://bozorboy.com/pictures/icons/5042.png',
            '{ListName}' => 'Обработка данных'
        ]);
        $info .= strtr($this->_layout['List'], [
            '{icon}' => 'http://bozorboy.com/pictures/icons/5044.png',
            '{ListName}' => 'Наши контакты'
        ]);
        $categoryListCode .= strtr($this->_layout['menulist'], [
            '{color}' => $this->_config['color'],
            '{Categories}' => Az::l('Информация'),
            '{categoryList}' => $info,
            '{url}' => $this->_config['url']
        ]);

        $this->htm = strtr($this->_layout['categoryList'], [
            '{url}' => $this->_config['url']
        ]);

        //Info end

//Register start
        $login = '';
        $login .= strtr($this->_layout['List'], [
            '{id}' => $this->id,
            '{icon}' => 'http://bozorboy.com/pictures/icons/5045.png',
            '{ListName}' => 'Вход',
            '{url}' => $this->_config['url']
        ]);
        $login .= strtr($this->_layout['List'], [
            '{id}' => 'fu' . $this->id,
            '{icon}' => 'http://bozorboy.com/pictures/icons/5042.png',
            '{ListName}' => 'Регистрация пользователя',
            '{url}' => $this->_config['registrationUrl']

        ]);
//Register end

        $categoryListCode .= strtr($this->_layout['menulist'], [
            '{color}' => $this->_config['color'],
            '{Categories}' => Az::l('Личный кабинет'),
            '{categoryList}' => $login,
            '{url}' => $this->_config['url']
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{color}' => $this->_config['color'],
            '{color_company}' => '#0049ff',
            '{class}' => $this->_config['class'],
            '{menulist}' => $categoryListCode,
            '{url}' => $this->_config['url']
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{color}' => $this->_config['color'],
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
        ]);

        $categoryListCode .= strtr($this->_layout['menulist'], [
            '{color}' => $this->_config['color'],
            '{Categories}' => Az::l('Информация о сети'),
            '{categoryList}' => '
                            <div class="zleft-left">
                <div class="zleft-icon"><a href="http://telegram.com">
                <i class="fab fa-telegram-plane fa-2x"></i></a>
                </div>
                <div class="zleft-icon"><a href="http://instagram.com">
                <i class="fab fa-instagram fa-2x"></i></a>
                </div>
                <div class="zleft-icon"><a href="http://telegram.com">
                <i class="fab fa-facebook-f fa-2x"></i></i></a>
                </div>
                </div>
            ',
            '{url}' => $this->_config['url']
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{color}' => $this->_config['color'],
            '{color_company}' => '#0049ff',
            '{class}' => $this->_config['class'],
            '{menulist}' => $categoryListCode,
            '{url}' => $this->_config['url']
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{color}' => $this->_config['color'],
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
        ]);


    }

}

