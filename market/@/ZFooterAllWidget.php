<?php

/**
 * @license SherzodMangliyev
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZFooterAllWidget extends ZWidget
{
    public $config = [];

    public $_config = [
        'check' => true,
        'telnumber' => '+998 (99) 123-56-67',
        'telnumber1' => '+998 (99) 123-56-67',
        'info' => 'info@MarketPlace.uz',
        'facebook' => 'http://facebook.com',
        'instagram' => 'http://instagram.com',
        'telegram' => 'http://web.telegram.org',
        'twitter' => 'http://twitter.com',
    ];


    public function asset()
    {

    }

    public $event = [];
    public $_event = [

    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<footer id="main_footer">
    <div class="pt-3" style="background-color: #10b410;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3 col-6">
                        <h4 class="text-white mb-4">Категории</h4>
                        <ul class="pl-0"> 
                          <li class="d-block"><a class="text-white d-table" href="/shop/user/filter-common/main.aspx?id=40">Компьютеры и оргтехника</a></li>
                          <li class="d-block"><a class="text-white d-table" href="/shop/user/filter-common/main.aspx?id=1">Телефоны и аксессуары</a></li>
                          <li class="d-block"><a class="text-white d-table" href="/shop/user/filter-common/main.aspx?id=137">Одежда и обувь</a></li>
                          <li class="d-block"><a class="text-white d-table" href="/shop/user/filter-common/main.aspx?id=51">Спорт и развлечения</a></li>
                          <li class="d-block"><a class="text-white d-table" href="/shop/user/filter-common/main.aspx?id=50">Красота и здоровье</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6 ">
                        <h4 class="text-white mb-4">Информация</h4>
                        <ul class="pl-0">
                            <li class="d-block"><a class="text-white d-table" href="/cores/info/about.aspx">О нашем сервисе</a></li>
                            <li class="d-block"><a class="text-white d-table" href="/cores/info/warranty.aspx">Обработка Данных</a></li>
                            <li class="d-block"><a class="text-white d-table" href="/cores/info/shipping.aspx">Правила доставки</a></li>
                            <li class="d-block"><a class="text-white d-table" href="/cores/info/payment.aspx">Принимаемые платежи</a></li>
                            <li class="d-block"><a class="text-white d-table" href="/cores/info/oferta.aspx">Публичная оферта</a></li>
                            <li class="d-block"><a class="text-white d-table" href="/cores/info/contacts.aspx">Наши контакты</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6 mt-3 mt-md-0 ">
                        <h4 class="text-white mb-4">Личный Кабинет</h4>
                        <ul class="pl-0">
                            <li class="d-block"><a class="text-white d-table" href="/core/user/user-auth/login-register.aspx#tab-1">Вход</a></li>
                            <li class="d-block"><a class="text-white d-table" href="/core/user/user-auth/login-register.aspx#tab-2">Регистрация пользователя</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6 mt-3 mt-md-0">
                        <h4 class="text-white mb-4">Контакты</h4>
                        <p class="text-white">
                            <a class="text-white d-table" href="tel:+998001234567">{telnumber}</a>
                            <a class="text-white d-table" href="tel:+998001234567">{telnumber1}</a>
                            <span>г.Ташкент,Юнусабадский район, ул. Амир Темур. Строй центр.</span>
                            <a class="text-white d-table" href="mailto:info@MarketPlace.uz">{info}</a>
                        </p>
                    </div>
                </div>
            </div>    
        </div>
    <div class="footer_middle pt-3" style="background-color: #17a717;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 justify-content-center">
                    <p class="text-white text-center">Скачайте наше приложение</p>
                    <ul class="d-flex pl-0 justify-content-center mt-3">
                        <li class="d-inline-block border_none"><a class="position-relative  h-50 d-table" href="https://www.apple.com/ios/app-store/"><img alt="max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/app-store.png"></a></li>
                        <li class="d-inline-block border_none"><a class="d-table  h-50 position-relative ml-2" href="https://play.google.com/"><img alt="max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/google-play-badge.png" ></a></li>
                    </ul>
                </div>
                <div class="col-md-4 mt-4 m-md-0">
                    <p class="text-white text-center mb-1">Мы в социальных сетях</p>
                    <ul class="mt-3 pl-0 d-flex justify-content-center">
                        <li class="d-inline-block border_side mx-2"><a class="text-white position-relative" href="{facebook}" target="_blank" rel="nofollow" title="MarketPlace в Facebook"><i class="fab fa-facebook "></i></a></li>
                        <li class="d-inline-block border_side mx-2"><a class="position-relative text-white" href="{instagram}" target="_blank" rel="nofollow" title="MarketPlace в Instagram"><i class="fab fa-instagram "></i></a></li>
                        <li class="d-inline-block border_side  mx-1"><a class="text-white position-relative" href="{telegram}" target="_blank" rel="nofollow" title="MarketPlace в Telegram"><i class="fab fa-telegram "></i></a></li>
                         <li class="d-inline-block border_side mx-2"><a class="text-white position-relative" href="{twitter}" target="_blank" rel="nofollow" title="MarketPlace в Twitter"><i class="fab fa-twitter "></i></a></li>
                        
                        
                    </ul>
                </div>
                <div class="col-md-4 justify-content-center">
                    <p class="text-white text-center mb-0">Мы принимаем к оплате</p>
                    <ul class="d-flex pl-0 justify-content-center">
                        <li class="d-inline-block border_side mx-1"><a class="position-relative d-table" href="https://click.uz/"><img alt="Max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/click.png" ></a></li>
                        <li class="d-inline-block border_side mx-1"><a class="position-relative d-table" href="https://payme.uz/"><img alt="Max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/payme.png" ></i></a></li>
                        <li class="d-inline-block border_side mx-1"><a class="position-relative d-table" href="https://uzcard.uz/"><img alt="Max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/uzcard.png" ></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
     </div>
    <div class="footer_bottom {class} mt-3">
            <div class="container">
                <p class="copy float-md-left d-flex">© 2020 MarketPlace. Все права защищены.</p>
                <p class="web_studio float-md-right d-flex">Copyright © 2020 | MarketPlace by &nbsp; <a target="_blank" rel="nofollow" href="https://zetsoft/"> ZetSoft</a></p>
            </div>
    </div> 
</footer>
HTML,


        'css' => <<<CSS
        .border_side a {
            width: 45px;
            height: 45px;
            
        }
        .border_none a {  
            width: 85px;
            height: 45px;
        }  
CSS,
        'js' => <<<JS
             
JS,

    ];

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            '{telnumber}' => $this->_config['telnumber'],
            '{telnumber1}' => $this->_config['telnumber1'],
            '{info}' => $this->_config['info'],
            '{facebook}' => $this->_config['facebook'],
            '{instagram}' => $this->_config['instagram'],
            '{telegram}' => $this->_config['telegram'],
            '{twitter}' => $this->_config['twitter'],


        ]);
        $this->css .= ($this->_layout['css']);
        $this->js .= ($this->_layout['js']);
    }

}
