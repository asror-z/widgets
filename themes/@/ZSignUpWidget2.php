<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\themes;


use yii\jui\Widget;
use zetsoft\dbitem\ALL\ZUserItem;
use zetsoft\models\user\UserFriend;
use zetsoft\models\auto\ChatMessage;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHImgWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use function GuzzleHttp\Psr7\str;

class ZSignUpWidget2 extends ZWidget
{


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="btn-group">
            <button id="signUpButton1" type="button" class="btn btn-blue-gradient">
                {title}
            </button>
            <button id="signUpButton"
                    type="button" 
                    class="btn btn-blue-gradient dropdown-toggle dropdown-toggle-split" 
                    id="dropdownMenuReference" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false" 
                    data-reference="parent"
            >
            </button>
            
            <div id="signUpContent" class="dropdown-menu p-3 pl-1 mt-4" aria-labelledby="dropdownMenuReference">
                 {status}
            </div> 
        </div> 
HTML,
        'userStatus' => <<<HTML
            <span class="text-dark">{haveAccount} ?</span>
            <a href="/shop/cores/auth/login.aspx" 
                class="btn btn-warning w-100 d-flex mt-2"
            >
                <div class="ml-5"><i class="fas fa-sign-in-alt text-light"></i></div>
                &nbsp;&nbsp;
                <div>
                    <h5 class="text-light">{sign}</h5>          
                </div>
            </a>
            <hr>
            <div class="my-2"> 
                <div class="text-dark mb-2">{signVia} :</div> 
                <div class="d-flex justify-content-around">      
                    <a href="/cores/auth/oauth.aspx?service=github" class="git-ic"> 
                        <i class="fa fa-lg fa-github"
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Github"
                        ></i>
                    </a>&nbsp;
                    <a href="#" class="fb-ic">
                        <i class="fab fa-lg fa-facebook-f"
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Facebook"
                        ></i>
                    </a>&nbsp;
                    <a href="#" class="gplus-ic">
                        <i class="fab fa-lg fa-google-plus-g"
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Google"
                        ></i>
                    </a>&nbsp;
                    <a href="#" class="vk-ic">
                        <i class="fab fa-lg fa-vk"
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Vkontakte"
                        ></i>
                    </a>&nbsp;
                </div>
            </div>
            <hr>
            <span class="text-dark mb-2">{newCustomer} ?</span>
            <a href="/shop/cores/auth/register.aspx" 
                class="btn btn-danger w-100 d-flex justify-content-between mt-2"
            >
                <div class=""><i class="fas fa-user-plus text-light"></i></div>
                &nbsp;&nbsp;
                <div class="text-light">
                    <h5>{register}</h5>
                </div>            
            </a>
            
HTML,

        'userStatus' => <<<HTML
            <a href="/cores/auth/logout.aspx" 
                class="d-flex btn btn-danger"
            >
                <div class="ml-0 menu-text">{exit}</div>
                <div class="">
                    <i class="ml-5 pl-5 fas fa-sign-out-alt"></i>
                </div>
            </a>
            <div class="pl-1 mt-3">
                <a class="p-0 d-flex justify-content-between">
                    <div><u class="mb-3">{myMarketPlace}</u></div>
                    <div><i class="fa fa-home text-right"></i></div>
                </a>
                <a class="p-0 d-flex justify-content-between">
                    <div><u class="mb-3">{myOreders}</u></div>
                    <div><i class="fas fa-clipboard-list"></i></div>
                </a>
                <a class="p-0 d-flex justify-content-between">
                    <div><u class="mb-3">{wish}</u></div>
                    <div><i class="far fa-heart text-right"></i></div>
                </a>
                <a class="p-0 d-flex justify-content-between">
                    <div><u class="mb-3">{notify}</u></div>
                    <div><i class="far fa-bell text-right"></i></div>
                </a>
                <a class="p-0 d-flex justify-content-between">
                    <div><u class="mb-3">{store}</u></div>
                    <div><i class="fas fa-store-alt text-right"></i></div>
                </a>
            </div>
    
HTML,

        'js' => <<<JS
    
        
        /* Modal ochili uchun
        $('#registerBtnSignUP').on('click', function() {
            $('#fastRegister').modal('show')
        });
        
        $('#loginBtnSignUP').on('click', function() {
            $('#loginNavbar').modal('show')  
        })*/
        

        $("#signUpButton, #signUpButton1").on('click', function(event){
            let dropdownContent = $("#signUpContent");
            let signUpButton = $("#signUpButton");
            dropdownContent.slideToggle("slow");
            if (event.which === 27)
                dropdownContent.slideUp(500);
        })
        
JS,

    ];

    public function codes()
    {
        # Registratsiya bilan Login Modal
        #region Modal

        ZModalNewWidget::begin([
            'id' => 'loginNavbar',
            'config' => [
                'title' => az::l('Вход в систему'),
                'size' => ZModalNewWidget::size['lg']
            ]
        ]);
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

        #endregion

        if ($this->userIsGuest())
            $title = Az::l('Вход / Регистрация');
        else
            $title = Az::l('Добро пожаловать');


        $status = '';
        if ($this->userIsGuest())
            $status .= strtr($this->_layout['userStatus'], [
                '{haveAccount}' => Az::l('Есть Аккаунт'),
                '{sign}' => Az::l('Вход'),
                '{signVia}' => Az::l('Войти через'),
                '{newCustomer}' => Az::l('Новый пользовател'),
                '{register}' => Az::l('Регистрация'),
            ]);
        else
            $status .= strtr($this->_layout['userStatus'], [
                '{exit}' => Az::l('Выход'),
                '{myMarketPlace}' => Az::l('Мой MarketPlace'),
                '{myOreders}' => Az::l('Мои заказы'),
                '{wish}' => Az::l('Избранное'),
                '{notify}' => Az::l('Уведомления'),
                '{store}' => Az::l('Любимые магазины')
            ]);



        if ($this->_config['visible']) {
            $this->htm = strtr($this->_layout['main'], [
                '{title}' => $title,
                '{status}' => $status,
            ]);
        }

        $this->js = $this->_layout['js'];
    }
}
