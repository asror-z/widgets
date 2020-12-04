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
class ZSignUpWidget extends ZWidget
{
//start|JakhongirKudratov|2020-10-17

public $config = [];
public $_config = [
    'profile_settings_url' => '/core/user/user-profile/profile-settings.aspx',
    'order_url' => '/shop/client/order/main.aspx',
    'history_url' => '/shop/client/order/history.aspx',
    'edit_pass_url' => '/core/user/change-password/main.aspx',
    'logout_url' => '/core/user/user-auth/logout.aspx'

];

//end|JakhongirKudratov|2020-10-17

public $layout = [];
public $_layout = [
    'main' => <<<HTML
        <div class="dropdown mr-2">
            <div id="top-menu-profile" class="list-unstyled">
                <a href="#" id="dropdownMenuLink" class="mega-link text-muted dropdown-toggle dropleft d-flex align-items-center" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {photo}       
                    <div class="d-flex align-items-end ">
                       <div class="pr-2 text-muted d-none d-md-block">{userName} ({role})</div> 
                    </div>
                </a>
                
                <div class="dropdown-menu profile-dropdown main-drop dropping dropleft w-100" aria-labelledby="dropdownMenuLink">
                    <div class="child-menu mt-2">
                        <div class="content-list content-menu pr-1">
                            
                            <ul class="list-wrapper pl-1">
                           
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
'guestStatus' => <<<HTML
                <h5 class="text-dark mb-2 ml-2">Есть аккаунт ?</h5>
                <a href="/shop/cores/auth/loginCRM.aspx" class="btn w-100 mr-1 pt-2">
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
                <a href="/shop/cores/auth/registerCRM.aspx" class="btn btn-danger w-100 mr-1 pt-2">
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

    'clientStatus' => <<<HTML
                <div class="mt-2">
                    <a href="{profile_settings_url}" class="p-0 mb-3 d-flex align-items-center">
                       <i class="fas fa-user-circle fp-15"></i>
                       <span class="xdropdownSubtitle ml-2 fp-16">Мой профиль</span>
                    </a>
                    <a href="{edit_pass_url}" class="p-0 d-flex align-items-center mb-3">
                    <i class="fas fa-key fp-15"></i>
                    <span class="dropdownSubtitle ml-2">Изменит пароль</span>
                    </a>
                </div>
                <div class="userStatus">
              <a href="{logout_url}" class="d-flex align-items-center m-0 p-1 rounded">       <i class="fas fa-sign-out-alt mt-1 text-danger"></i>
                        <span class="ml-2 menu-text text-danger">Выход</span>
                </a>
            </div>
HTML,
    'userStatus' => <<<HTML
            
                <div class="mt-2">
                    <a href="/core/user/user-profile/profile-settings.aspx" data-pjax="0" class="p-0 mb-3 d-flex align-items-center">
                       <i class="fas fa-user-circle fp-15"></i>
                       <span class="xdropdownSubtitle ml-2 fp-16"></span>
                    </a>
                  
                    <a href="/core/user/change-password/main.aspx" class="p-0 d-flex align-items-center mb-3">
                    <i class="fas fa-key fp-15"></i>
                    <span class="dropdownSubtitle ml-2">Изменит пароль</span>
                    </a>
                </div>
                <div class="userStatus">
              <a href="/core/user/user-auth/logout.aspx" class="d-flex align-items-center m-0 p-1 rounded">       <i class="fas fa-sign-out-alt mt-1 text-danger"></i>
                        <span class="ml-2 menu-text text-danger">Выход</span>
                </a>
            </div>
    HTML,

    'js' => <<<JS
        
           /* $('#registerBtnSignUP').on('click', function() {
                $('#fastRegister').modal('show')
            });
            
            $('#loginBtnSignUP').on('click', function() {
                $('#loginNavbar').modal('show')  
            });
            
            $('#dropdownMenuLink').on("click", function() {
               $('.main-drop .dropping').toggleClass('show');
            });
            
            */
        
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
        
    CSS,
    'def_photo' => <<<HTML
            <div class="d-flex align-items-start">
                        <span class="fal fa-user fp-26 pr-2 grey-text"></span>
                        
                    </div> 
HTML,
    'photo' => <<<HTML
            <div class="d-flex align-items-start">
                       <img src="{user_photo}" alt="user photo" class="img-fluid" style="width: 50px">                         
                    </div> 
HTML,

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
    $title = $this->userIdentity()->title;
}

//start|JakhongirKudratov|2020-10-20

$user_photo = strtr($this->_layout['def_photo'], []);
if ($this->userPhoto())
    $user_photo = strtr($this->_layout['photo'], [
        '{user_photo}' => $this->userPhoto()
    ]);

//end|JakhongirKudratov|2020-10-20

$status = '';

if ($this->userIsGuest()) {
    $status = $this->htm = strtr($this->_layout['guestStatus'], []);
} else if ($this->userIdentity()->role !== 'client') {
    $status = $this->htm = strtr($this->_layout['clientStatus'], [
        //start|JakhongirKudratov|2020-10-17

        '{profile_settings_url}' => $this->_config['profile_settings_url'],
        '{order_url}' => $this->_config['order_url'],
        '{history_url}' => $this->_config['history_url'],
        '{edit_pass_url}' => $this->_config['edit_pass_url'],
        '{logout_url}' => $this->_config['logout_url'],

        //end|JakhongirKudratov|2020-10-17
    ]);
} else {
    $status = $this->htm = strtr($this->_layout['userStatus'], []);
}

/*
        ZModalNewWidget::begin([
            'id' => 'loginNavbar',
            'config' => [
                'title' => az::l('Вход в систему'),
                'size' => ZModalNewWidget::size['lg']
            ]
        ]);
        */ ?><!--
            <div class="col-lg-12 col-md-8 col-sm-6 loginFrame">
                <iframe src="/shop/cores/auth/login-frame.aspx" height="600" width="100%" class="border-0"
                        scrolling="no"></iframe>
            </div>
            <?php
/*        ZModalNewWidget::end();


        ZModalNewWidget::begin([
            'id' => 'fastRegister',
            'config' => [
                'title' => AZ::l('Регистрация'),
                'size' => ZModalNewWidget::size['lg']
            ]
        ]);

        */ ?>
            <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                <iframe src="/cores/auth/fast-register-frame.aspx" height="550" width="100%" class="border-0"></iframe>
            </div>

            <?php
/*        ZModalNewWidget::end();

        */ ?>

            <?php
/*        ZModalNewWidget::begin([
            'id' => 'fastRegisterVendor',
            'config' => [
                'title' => AZ::l('Регистрация Vendor'),
                'size' => ZModalNewWidget::size['lg']
            ]
        ]);
        */ ?>
            <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                <iframe src="/cores/auth/fast-register-vendor.aspx" height="550" width="100%"
                        class="border-0"></iframe>
            </div>

            --><?php
/*        ZModalNewWidget::end();*/


if ($this->_config['visible']) {
    $this->htm = strtr($this->_layout['main'], [
        '{userName}' => $this->userIdentity()->title,
        '{title}' => $title,
        '{status}' => $status,
        '{role}' => $this->userRoleTitle(),
        '{statusUser}' => $this->userIdentity()->status,
        '{photo}' => $user_photo
    ]);
}

$this->css = strtr($this->_layout['css'], []);

$this->js = $this->_layout['js'];
}
}
