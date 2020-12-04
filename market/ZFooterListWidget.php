<?php


namespace zetsoft\widgets\market;


use zetsoft\models\App\eyuf\Category;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZFooterListWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'color' => '',
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
        <div class="footer-div list w-100">
        <section class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="f-cat">
                            <h5 style="color: {color};">{Categories}</h5>
                            <ul class="list-unstyled">
                                
                                {categoryList}
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="f-link">
                            <h5 class="heading-five" style="color: {color};">Профиль</h5>
                            <ul class="list-unstyled">
                                <li><a href=""><i class="{class}"></i>Мой аккаунт</a></li>
                                <li><a href=""><i class="{class}"></i>Корзина</a></li>
                                <li><a href=""><i class="{class}"></i>Избранное</a></li>
                                <li><a href=""><i class="{class}"></i>Checkout</a></li>
                                <li><a href=""><i class="{class}"></i>История заказов</a></li>
                                <li><a href=""><i class="{class}"></i>Вход</a></li>
                                <li><a href=""><i class="{class}"></i>Наши локации</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="f-sup">
                            <h5 class="heading-five" style="color: {color};">Служба поддержки</h5>
                            <ul class="list-unstyled">
                                <li><a href=""><i class="{class} hoverable"></i>Контакты</a></li>
                                <li><a href=""><i class="{class} hoverable"></i>Политика оплаты</a></li>
                                <li><a href=""><i class="{class} hoverable"></i>Политика возврата</a></li>
                                <li><a href=""><i class="{class} hoverable"></i>Политика конфиденциальности</a></li>
                                <li><a href=""><i class="{class} hoverable"></i>Часто задаваемые вопросы</a></li>
                                <li><a href=""><i class="{class} hoverable"></i>Условия использования</a></li>
                                <li><a href=""><i class="{class} hoverable"></i>Информация о доставке</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer-btm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>Copyright &copy; 2020 | MarketPlace<i class="fa fa-heart" style="color: {color};" ></i> by <a href="#" target="_blank" style="color: {color};">ZetSoft</a></p>
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
        'categoryList' => <<<HTML
        <li><a href=""><i class="{class}"></i>{categoryListNames}</a></li>
HTML,

        

    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');
    }

    public function codes()
    {

        $categories = Category::find()->all();

        $categoryListCode = '';
        /** @var Category[] $categories */

        
        foreach ($categories as $category) {
            $categoryListCode .= strtr($this->_layout['categoryList'], [
                '{categoryListNames}' => $category->name
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{color}' => $this->_config['color'],
            '{class}' => $this->_config['class'],
            '{Categories}' => Az::l('Категории'),
            '{categoryList}' => $categoryListCode,
        ]);

        $this->css= strtr($this->_layout['css'], [
            '{color}' => $this->_config['color'],
        ]);

    }

}

