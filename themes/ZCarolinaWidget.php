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
use function GuzzleHttp\Psr7\str;

class ZCarolinaWidget extends ZWidget
{
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="vd_mega-menu-wrapper">
    <div class="vd_mega-menu pull-right">
        <ul class="mega-ul">
            <li id="top-menu-profile" class="profile mega-li add">

                <a href="#" class="pastgaStrelka mega-link dropdown-toggle" data-toggle="dropdown" data-action="click-trigger">
                        <span class="mega-image user-photo">
                          {photo}   
                        </span>
                        <div class="carolinaTextColor mega-name carolina-user name-n">
                           <p class="userTextColor m-0">{title}</p> 
                           <p class="roleTextColor role-user m-0">{role}</p>
                        </div>
                        
                </a>
                

                <div class="vd_mega-menu-content  width-xs-3  left-xs left-sm dropdown-menu gg" >
                    <div class="child-menu">
                        <div class="content-list content-menu">
                            <ul class="list-wrapper pd-lr-10">
                           
                                    {status}
                               
                            </ul>
                        </div>
                    </div>
                </div>

            </li>
        </ul>
    </div>
</div>
HTML,


        'itemBadge' => <<<HTML
            <div class="badge vd_bg-red">{itemBadges}</div>
HTML,

        'userStatus' => <<<HTML

        <li class="userStatus">
          <a href="/eyuf/cores/user/index.aspx" data-pjax="0">
            <div class="menu-icon"><i class=" fa fa-user"></i></div>
                <div class="menu-text pr-0">{profile}</div>
            
            </a>
        </li>
        <li class="userStatus">
          <a href="/core/user/change-password/edit.aspx" data-pjax="0">
            <div class="menu-icon"><i class="fa fa-cogs"></i></div>
                <div class="menu-text pr-0">{setting}</div>
            <!--<div class="menu-badge">
                <div class="badge vd_bg-red"></div>
            </div>-->
            </a>
        </li>
        
      

        <li class="userStatus">
          <a href="/eyuf/cores/auth/logout.aspx" data-pjax="0">
            <div class="menu-icon"><i class="fas fa-sign-out-alt"></i></div>
                <div class="menu-text pr-0">{exit}</div>
            </a>
        </li>
    
HTML,

        'css' => <<<CSS
    .content-list{ 
        overflow: unset;
    }
    .role-user{
        font-size: 12px !important;
    }
    
    .add{
        padding: 7px !important;
        
    }
    .name-n{
        /*padding: 0 !important;
        padding-left: 5px !important;
        padding-bottom: 15px !important;*/
        margin-top: 0 !important;
    }
    .user-photo{
        padding-top: 5px !important;
    }
    
    .add{
       margin-left: 15px !important;
    }
    .userStatus{
       height: 30px;
       margin: 2px 0;
    }
    .userStatus a{
       padding: 0 !important;
    }
    .userStatus a:hover{
        background-color: unset !important; 
    }
    .carolinaTextColor{
        padding-top: 7px;
    }

    .carolinaTextColor{
        color: #424242;
        font-weight: bold;
        line-height: 18px;
        
    }
    .roleTextColor{
        color: #424242;
    }
    .pastgaStrelka span img{
        width: 96%;     
    }
    .pastgaStrelka::after{
        margin: 20px 10px 0;
        font-size: 22px;
        color: #424242;
    }
CSS

    ];

    public function codes()
    {

        $photo = $this->userPhoto();
        $defaultImg = 'https://cdn.clipart.email/96134fd4566a3c6d94f5ab53d8e56297_fileuser-circlepng-wikipedia_256-256.png';

        /*if(!file_exists($photo))
            $photo=$defaultImg;*/

        if ($this->userIsGuest()) {
            $photo = $defaultImg;
            $title = Az::l('Гость');
        } else {
            $title = $this->userIdentity()->email;
        }


        $status = strtr($this->_layout['userStatus'], [
            '{exit}' => Az::l('Выход'),
            '{setting}' => Az::l('Настройки'),
            '{profile}' => Az::l('Мой профиль'),
        ]);


        $role = $this->userRole();

        if (empty($role))
            $role = 'User';


        //vdd($title);

        if ($this->_config['visible']) {
            $this->htm = strtr($this->_layout['main'], [
                '{photo}' => "<img src='$photo'>",
                '{title}' => $title,
                '{status}' => $status,
                '{role}' => $role,
            ]);
        }

        $this->css = strtr($this->_layout['css'], []);


    }
}
