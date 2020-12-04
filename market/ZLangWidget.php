<?php


namespace zetsoft\widgets\market;


use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZSignUpWidget;

class ZLangWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'class' => [
            'top-bar',
            'container',
            'row',
            'col-lg-6 col-md-4',
            'top-left d-flex',
            'lang-box',
            'fa fa-angle-down',
            'list-unstyled',

        ],
        'items' => [
            'English' => [
                'img' => '/render/animo/ZLangWidget/images/fl-eng.png',
                'lang' => 'English'
            ],
            'Spanish' => [
                'img' => '/render/animo/ZLangWidget/images/fl-ger.png',
                'lang' => 'Germany'
            ],
            'French' => [
                'img' => '/render/animo/ZLangWidget/images/fl-fra.png',
                'lang' => 'French'
            ],
        ]
    ];


    public $layout = [];
    public $__layout = [
        'css' => <<<CSS
        .top-bar{
            border: none;
            position: fixed;
            background-color: white;
            z-index: 99;
            top: 0;
            width: 100%;
            box-shadow: 0px 0px 7px 0px lightgrey;
            margin-bottom: 20px;
            height: 55px !important;
        }
        .lang-box {
            width: 80%;
            padding-left: 20px!important;
        }
        
       
        
CSS,
        'main' => <<<HTML

    <section class="top-bar ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="top-left d-flex col-lg-3">
                        <div class="lang-box" style="width: 150px;">
                        <span class="row pl-3" style="width: 250px;"><img src="/render/animo/ZLangWidget/images/fl-eng.png" alt="">English</span>
                        <ul class="list-unstyled">
                            {items} 
                        </ul>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="top-right text-right">
                            <ul class="list-unstyled list-inline">
                                
                                <li class="list-inline-item">
                                {registerUser}
                                </li>
                                <li class="list-inline-item">
                                {registerVendor}
                                </li>
                                <li class="list-inline-item">
                                {login}
                                </li>
                                <li class="list-inline-item">
                                {signup}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

HTML,
        'li' => <<<HTML
            <li class ="bar-content">
                <img src="{src}" class="img-fluid" alt="">   
                    <span>{item}</span>
            </li>
HTML,


    ];


    public function asset()
    {

//        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');

    }

    public function codes()
    {
        $content = '';
        $data = $this->_config['items'];
        foreach ($data as $item) {
            $content .= strtr($this->_layout['li'], [
                '{item}' => $item['lang'],
                '{src}' => $item['img'],
            ]);
        };


        $this->css = strtr($this->_layout['css'], [

        ]);

        ZModalNewWidget::begin([
            'id' => 'loginNavbar',
            'config' => [
                'title' => az::l('Вход в систему'),
                'size' => ZModalNewWidget::size['lg']
            ]
        ]);
//require_once Root.'/webhtm/shop/cores/auth/register.php';
        ?>
        <div class="col-lg-12 col-md-8 col-sm-6 loginFrame">
            <iframe src="/shop/cores/auth/login-frame.aspx" height="600" width="100%" class="border-0"
                    scrolling="no"></iframe>
        </div>
        <?php
        ZModalNewWidget::end();


        /*
         *  Fast Register Modal
         *
         */
//                    print_r(Az::$app->cores->auth->user());
        ZModalNewWidget::begin([
            'id' => 'fastRegister',
            'config' => [
                'title' => AZ::l('Регистрация'),
                'size' => ZModalNewWidget::size['lg']
            ]
        ]);

        ?>
        <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
            <iframe src="/cores/auth/fast-register-frame.aspx" height="550" width="100%"
                    class="border-0"></iframe>
        </div>

        <?php
        ZModalNewWidget::end();

        ?>

        <?php
        ZModalNewWidget::begin([
            'id' => 'fastRegisterVendor',
            'config' => [
                'title' => AZ::l('Регистрация Vendor'),
                'size' => ZModalNewWidget::size['lg']
            ]
        ]);
        ?>
        <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
            <iframe src="/cores/auth/fast-register-vendor.aspx" height="550" width="100%"
                    class="border-0"></iframe>
        </div>

        <?php
        ZModalNewWidget::end();


        $this->htm = strtr($this->_layout['main'], [
            '{class}' => $this->_config['class'],
            '{items}' => $content,
            '{login}' => ZButtonWidget::widget([
                'config' => [
                    //'text' => Az::l('Вход'),
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['button'],
                    'icon' => 'fas fa-' . FA::_SIGN_IN_ALT,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                    'class' => 'text-white',
                    /*'cooler' => true,
                    'url' => '/shop/cores/auth/login-frame.aspx',
                    'ic-target' => '.loginFrame',
                    'ic-push-url' => false*/
                ],
                'event' => [
                    'click' => '$("#loginNavbar").modal(\'show\')'
                ]
            ]),
            '{registerVendor}' => ZButtonWidget::widget([
                'config' => [
                    //'text' => Az::l('Регистрация Продавцам'),
                    'icon' => 'fas fa-' . FA::_USER_ASTRONAUT,
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                    'class' => 'text-white',
                    'hasIcon' => true
                ],
                'event' => [
                    'click' => '$(fastRegisterVendor).modal(\'show\')'
                ]
            ]),
            '{registerUser}' => ZButtonWidget::widget([
                'config' => [
                   // 'text' => Az::l('Регистрация Пользователям'),
                    'icon' => 'fas fa-' . FA::_USER,
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                    'class' => 'text-white',
                    'hasIcon' => true
                ],
                'event' => [
                    'click' => '$(fastRegister).modal(\'show\')'
                ]
            ]),
            '{signup}' => ZSignUpWidget::widget(),
        ]);

    }

}
