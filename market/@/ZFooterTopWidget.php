<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

/**
 *
 *
 * CreatedBy: prZafar
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZFooterTopWidget extends ZWidget
{

    public $config = [];

    public $_config = [
        'url' => 'https://av.ru/lp/b2b/pic/b2b/pleasure/pleasure1.png',
        'title' => 'Индивидуальный сервис',
        'content' => 'Заключим договор, выберем способ оплаты, согласуем персональные цены: они отобразятся на сайте после авторизации',
        'class'=>''

    ];


    public $event = [];
    public $_event = [

    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="footer_top bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-3 align-items-center">
                    <h4>Категории</h4>
                    <ul>
                        <li><a href="#">Электроника</a></li>
                        <li><a href="#">Всё для детей</a></li>
                        <li><a href="#">Сумки и спорт</a></li>
                        <li><a href="#">Бижутерия и часы</a></li>
                        <li><a href="#">Спорт и развлечение</a></li>
                    </ul>
                </div>
                <div class="col-md-3 align-items-center">
                    <h4>Информация</h4>
                    <ul>
                        <li><a href="#">О нашем сервисе</a></li>
                        <li><a href="#">Обработка Данных</a></li>
                        <li><a href="#">Правила доставки</a></li>
                        <li><a href="#">Принимаемые платежи</a></li>
                    </ul>
                </div>
                <div class="col-md-3 align-items-center">
                    <h4>Личный Кабинет</h4>
                    <ul>
                        <li><a href="#">Вход</a></li>
                        <li><a href="#">Регистрация пользователя</a></li>
                    </ul>
                </div>
                <div class="col-md-3 align-items-center">
                    <h4>Контакты</h4>
                    <p>
                        <a href="tel:+998001234567">+998 (99) 123-56-67</a>
                        <a href="tel:+998001234567">+998 (99) 123-56-67</a>
                        <span>г.Ташкент,Юнусабадский район, ул. Амир Темур. Строй центр.</span>
                        <a href="mailto:info@MarketPlace.uz">info@MarketPlace.uz</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

HTML,
        'css' => <<<CSS
        .footer_top {
            padding: 40px 0;
        }
        .footer_top p {
            font-size: 18px;
            color: #FFFFFF;
        }
        .footer_top p a {
            color: #ffffff;
            display: table;
            margin-bottom: 10px;
        }
        .footer_top ul li a {
            color: #FFFFFF;
        }
        .footer_top ul {
            list-style: none;
            padding-left: 0;
        }
        .footer_top ul li {
            font-size: 14px;
            line-height: 20px;
            margin-bottom: 10px;
            display: block;
        }
        .footer_top h4 {
            font-size: 24px;
            line-height: 35px;
            color: #ffffff;
            margin-bottom: 10px;
        }
CSS,
        'js' => <<<JS
             
             
JS,

    ];


    public function codes()

    {
        $this->htm .= strtr($this->_layout['main'], [


        ]);
        $this->css .= strtr($this->_layout['css'], [

        ]);

        $this->js = strtr($this->_layout['js'], [

        ]);

    }


}
