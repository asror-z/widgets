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
class ZSignUpWidgetNew extends ZWidget
{
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div class="dropdown mr-2">
        <div id="top-menu-profile" class="list-unstyled">
            <a href="#" id="dropdownMenuLink" class="mega-link text-muted dropdown-toggle dropleft d-flex align-items-center" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-flex align-items-start">
                    <span class="fal fa-user fp-26 pr-2 grey-text"></span>
                    
                </div>        
                <div class="d-flex align-items-end">
                   <div class="pr-2 text-muted d-none d-md-block">{userName}</div> 
                </div>
            </a>
            
            <div class="dropdown-menu profile-dropdown main-drop dropping dropleft w-100" aria-labelledby="dropdownMenuLink">
                <div class="child-menu">
                    <div class="content-list content-menu pr-1">
                        
                        <ul class="list-wrapper pl-1 mb-0">
                       
                                {status}
                           
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>
HTML,


        'clientStatus' => <<<HTML
        
            <div class="mt-2">
                <h5>Jessica Alba</h5>
                <div class="d-flex">
                <p>Status: <a href="#" class="p-0 text-info">Premium</a> до <span>11.12.2020</span></p>
</div>
                <a href="/core/user/user-profile/profile-settings.aspx" class="p-0 mb-3 d-flex align-items-center justify-content-center">
                   <span class="xdropdownSubtitle text-muted fp-16">Профиль</span>
                </a>
                <a href="/core/user/user-auth/logout.aspx" class="d-flex align-items-center m-0 p-1 justify-content-center">       
                    <span class="menu-text text-muted">Выход</span>
            </a>
            </div>
            
HTML,


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
   
    .dropdown-menu {
        min-width: 15rem;
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


        $status = strtr($this->_layout['clientStatus'], []);

        $this->htm = strtr($this->_layout['main'], [
            '{photo}' => $this->userPhoto() ?? '',
            '{userName}' => $this->userIdentity()->title,
            '{status}' => $status,
            '{statusUser}' => $this->userIdentity()->status
        ]);

        $this->css = strtr($this->_layout['css'], []);

    }
}
