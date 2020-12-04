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

/** @var ZView $this */


class ZSignUpAdminWidget extends ZWidget
{
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div class="dropdown mr-2">
        <div id="top-menu-profile" class="list-unstyled">
            <a href="#" id="dropdownMenuLink" class="mega-link text-muted dropdown-toggle dropleft" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                    <div class="d-inline-flex">
                       <div class="pr-2 text-muted d-none d-md-block">{userName}</div> 
                    </div>
                    <span class="fal fa-user fe-15 pr-2 grey-text">
                    </span>
            </a>
            
            <div class="dropdown-menu profile-dropdown main-drop dropping dropleft w-100" aria-labelledby="dropdownMenuLink">
                <div class="child-menu mt-2">
                    <div class="content-list content-menu pr-3">
                        
                        <ul class="list-wrapper pl-2">
                       
                                {status}
                           
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>
HTML,


        'itemBadge' => <<<HTML
            <div class="badge vd_bg-red">{itemBadges}</div>
HTML,
        'userStatus' => <<<HTML
            <h5 class="text-dark mb-2 ml-2">Есть аккаунт ?</h5>
            <a href="/shop/cores/auth/login.aspx" class="btn w-100 mr-1 pt-2">
                <div class="menu-icon"><i class="fas fa-sign-in-alt text-light"></i></div>
                <div class="menu-text text-light">
                    <h5>Вход</h5>
                </div>            
            </a>
            <div class="pl-2 my-2 d-flex"> 
                <div class="text-dark">Войти через</div> 
                <div class="ml-auto">      
                    <a href="/cores/auth/oauth.aspx?service=github"><i class="fa fa-github"></i></a>
                    <a><i class="fa fa-facebook"></i></a>
                    <a><i class="fa fa-google"></i></a>
                    <a><i class="fa fa-vk"></i></a>
                </div>
            </div>
            <hr>
            <span class="text-dark pl-2">Новый покупатель?</span>
            <a href="/shop/cores/auth/register.aspx" class="btn btn-danger w-100 mr-1 pt-2">
                <div class="menu-icon"><i class="fas fa-user-plus text-light"></i></div>
                <div class="menu-text text-light font-size">
                    <h5>Регистрация</h5>
                </div>            
            </a>
            
            <div class="mt-3">
                <a class="p-0"><h6 class="mb-3 dropdownSubtitle">Мой MarketPlace</h6></a>
                <a class="p-0"><h6 class="mb-3 dropdownSubtitle">Мои заказы</h6></a>
                <a class="p-0"><h6 class="mb-3 dropdownSubtitle">Мои желания</h6></a>
                <a class="p-0"><h6 class="mb-3 dropdownSubtitle">Центр сообщений</h6></a>
                <a class="p-0"><h6 class="mb-3 dropdownSubtitle">Любимые магазины</h6></a>
            </div>
HTML,

        'userStatus' => <<<HTML
        
            <div class="mt-2">
                <a href="/core/user/user-profile/profile-settings.aspx" class="p-0"><h6 class="mb-3 dropdownSubtitle">Мой профиль</h6></a>
           
                <a href="/client/settings/main.aspx" class="p-0"><h6 class="mb-3 dropdownSubtitle">Настройки</h6></a>
            </div>
         
HTML,

        'js' => <<<JS
    
        $('#registerBtnSignUP').on('click', function() {
            $('#fastRegister').modal('show')
        });
        
        $('#loginBtnSignUP').on('click', function() {
            $('#loginNavbar').modal('show')  
        });
        
        $('#dropdownMenuLink').on("click", function() {
           $('.main-drop .dropping').toggleClass('show');
        });
        
    
JS,



        'css' => <<<CSS
    .dropdownSubtitle:hover {
        color: #10b410;
        transition: color .2s linear;   
    }
    .profile-dropdown {
        right: 0px;
        left: auto;
        top:148%;
    }
    
    .profileIMG{
        width: 30px !important;
    }

    .userStatus a:hover{
        color: #10b410!important;
        transition: color .2s linear; 
        background: none!important; 
    }
    
CSS

    ];

    public function codes()
    {

        $photo = $this->userPhoto();
        $defaultImg = '/render/theme/ZCarolinaWidget/asset/img/user-photo.jpg';

        if (!file_exists($photo))
            $photo = $defaultImg;

        if ($this->userIsGuest()) {
            $photo = $defaultImg;
            $title = Az::l('Мой Профиль');
        } else {
            $title = $this->userIdentity()->name;
        }


        $status = '';

        if ($this->userIsGuest()) {
            $status = $this->htm = strtr($this->_layout['userStatus'], []);
        } else {
            $status = $this->htm = strtr($this->_layout['userStatus'], []);
        }


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


        $role = $this->userRole();

        if (empty($role))
            $role = 'User';


        if ($this->_config['visible']) {
            $this->htm = strtr($this->_layout['main'], [
                '{photo}' => $this->userPhoto() ?? '',
                '{userName}' => $this->userIdentity()->name,
                '{title}' => $title,
                '{status}' => $status,
                '{role}' => $role,
            ]);
        }

        $this->css = strtr($this->_layout['css'], []);

        $this->js = $this->_layout['js'];
    }
}
