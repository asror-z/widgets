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

class ZFooterAllWidgetOrg extends ZWidget
{
    public $config = [];

    public $_config = [
        'check'=>true,
        'telnumber'=>'+998 (99) 123-56-67',
        'telnumber1'=>'+998 (99) 123-56-67',
        'info'=>'info@MarketPlace.uz',
        'facebook'=>'http://facebook.com',
        'instagram'=>'http://instagram.com',
        'telegram'=>'http://web.telegram.org',
        'twitter'=>'http://twitter.com',
    ];


    public function asset(){
    
    }

    public $event = [];
    public $_event = [

    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <footer id="main_footer" style="border-top: 1px solid #e0e0e0">
        
     <div class="pt-3 <!--cloudy-knoxville-gradient-->" style="background: url(https://www.pngitem.com/pimgs/m/160-1605161_cities-background-for-footer-skyline-hd-png-download.png);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3 col-6">
                        <h4 class="text-dark mb-4">Категории</h4>
                        <ul class="pl-0"> 
                          <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/user/filter-common/main.aspx?id=40">Компьютеры и оргтехника</a></li>
                          <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/user/filter-common/main.aspx?id=1">Телефоны и аксессуары</a></li>
                          <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/user/filter-common/main.aspx?id=137">Одежда и обувь</a></li>
                          <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/user/filter-common/main.aspx?id=51">Спорт и развлечения</a></li>
                          <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/user/filter-common/main.aspx?id=50">Красота и здоровье</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6 ">
                        <h4 class="text-dark mb-4">Информация</h4>
                        <ul class="pl-0">
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/cores/info/support-service.aspx">О нашем сервисе</a></li>
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/cores/info/warranty.aspx">Обработка Данных</a></li>
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/cores/info/shipping.aspx">Правила доставки</a></li>
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/cores/info/payment.aspx">Принимаемые платежи</a></li>
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/cores/info/oferta.aspx">Публичная оферта</a></li>
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/shop/cores/info/contacts.aspx">Наши контакты</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6 mt-3 mt-md-0 ">
                        <h4 class="text-dark mb-4">Личный Кабинет</h4>
                        <ul class="pl-0">
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/core/user/user-auth/login-register.aspx#tab-1">Вход</a></li>
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/core/user/user-auth/login-register.aspx#tab-2">Регистрация пользователя</a></li>
                            <li class="d-block"><a class="text-dark footer-link d-table" href="/core/user/user-auth/login-register.aspx#tab-3">Регистрация компании</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6 mt-3 mt-md-0">
                        <h4 class="text-dark mb-4">Контакты</h4>
                        <p class="text-dark">
                            <a class="text-dark footer-link  d-table" href="tel:+998001234567">{telnumber}</a>
                            <a class="text-dark footer-link  d-table" href="tel:+998001234567">{telnumber1}</a>
                            <span>г.Ташкент,Юнусабадский район, ул. Амир Темур. Строй центр.</span>
                            <a class="text-dark footer-link  d-table" href="mailto:info@MarketPlace.uz">{info}</a>
                        </p>
                    </div>
                </div>
            </div>    
        </div>
        <div class="footer_middle pt-2 /*heavy-rain-gradient*/ grey lighten-2">
        <div class="container">
            <div class="row">
                <div class="col-md-4 justify-content-center">
                    <p class="fp-15 text-dark text-center">Скачайте наше приложение</p>
                    <ul class="d-flex pl-0 justify-content-center mt-1">
                        <li class="d-inline-block border_none"><a class="position-relative  h-40 footer-link d-table" href="https://www.apple.com/ios/app-store/"><img alt="max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/app-store.png"></a></li>
                        <li class="d-inline-block border_none"><a class="d-table footer-link h-40 position-relative ml-2" href="https://play.google.com/"><img alt="max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/google-play-badge.png" ></a></li>
                    </ul>
                </div>
                <div class="col-md-4 m-md-0">
                    <p class=" fp-15 text-dark text-center">Мы в социальных сетях</p>
                    <ul class="mt-1 pl-0 d-flex justify-content-center">
                        <li class="d-inline-block border_side mx-2"><a class="text-dark footer-link position-relative" href="{facebook}" target="_blank" rel="nofollow"><i class="fab fa-facebook footer-link footer-link-facebook fp-20"></i></a></li>
                        <li class="d-inline-block border_side mx-2"><a class="position-relative footer-link text-dark" href="{instagram}" target="_blank" rel="nofollow" ><i class="fab fa-instagram footer-link footer-link-instagram fp-20"></i></a></li>
                        <li class="d-inline-block border_side mx-1"><a class="text-dark footer-link position-relative" href="{telegram}" target="_blank" rel="nofollow"><i class="fab fa-telegram footer-link footer-link-telegram fp-20"></i></a></li>
                         <li class="d-inline-block border_side mx-2"><a class="text-dark footer-link position-relative" href="{twitter}" target="_blank" rel="nofollow"><i class="fab fa-twitter footer-link footer-link-twitter fp-20"></i></a></li>
                        
                        
                    </ul>
                </div>
                                <div class="col-md-4 justify-content-center py-0">
                    <p class=" fp-15 text-dark text-center mb-0">Мы принимаем оплату через</p>
                    <ul class="d-flex mt-1 pl-0 justify-content-center px-4">
                        <li class="d-flex justify-content-center col-3 border_side px-0">
                            <a class="position-relative w-72 footer-link d-flex  align-items-center" href="https://click.uz/">
                                <img alt="Max-width 100%" class="mw-100" src="/render/market/ZFooterMarket/assets/img/logoClick.png">
                            </a>                          
                        </li>
                        <li class="d-flex justify-content-center col-3 border_side px-0">
                            <a class="position-relative w-72 footer-link d-flex  align-items-center" href="https://payme.uz/">
                                <img rel="preload" type="image" alt="Max-width 100%" class="mw-100" src="/render/market/ZFooterMarket/assets/img/logoPayme.png">
                            </a>
                        </li>
                        <li class="d-flex justify-content-center col-3 border_side px-0">
                            <a class="position-relative w-72 footer-link d-flex  align-items-center" href="https://uzcard.uz/">
                                <img alt="Max-width 100%" class="mw-100" src="/render/market/ZFooterMarket/assets/img/logoUzcard.png">
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        </div>
</footer>
    </div>
    <div class="footer_bottom {class} mt-2">
            <div class="container">
                <p class="copy float-md-left d-flex">© 2020 MarketPlace. Все права защищены.</p>
                <p class="web_studio float-md-right d-flex">Copyright © 2020 | MarketPlace by &nbsp; <a target="_blank" rel="nofollow" href="https://zetsoft/"> ZetSoft</a></p>
            </div>
      </div>


HTML,


        'css' => <<<CSS
        .border_side a {
            width: 45px;
            height: 45px;
            
        }
        .border_none a {  
            width: 95px !important;
            height: 35px !important;
        }
        .footer-link:hover {
            transform: scale(1.1);
            transition: 0.3s;
            
        }
        .footer-link-facebook:hover {
            color: #1877f2;
        }
        .footer-link-instagram:hover {
            color: #c32aa3;
        }
        .footer-link-twitter:hover {
            color: #1da1f2;
        }
        .footer-link-telegram:hover {
            color: #0088cc;
        }
          
CSS,
        'js' => <<<JS
             
JS,

    ];

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'],[
            '{telnumber}' => $this->_config['telnumber'],
            '{telnumber1}' => $this->_config['telnumber1'],
            '{info}' => $this->_config['info'],
            '{facebook}' => $this->_config['facebook'],
            '{instagram}' => $this->_config['instagram'],
            '{telegram}' => $this->_config['telegram'],
            '{twitter}' => $this->_config['twitter'],


        ]);
          $this->css .= ($this->_layout['css']);
        $this->js .= ($this->_layout['js']) ;
    }

}
