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

namespace zetsoft\widgets\market;


use yii\jui\Widget;
use zetsoft\dbitem\ALL\ZUserItem;
use zetsoft\models\user\UserFriend;
use zetsoft\models\auto\ChatMessage;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHImgWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use function GuzzleHttp\Psr7\str;

class ZDeliveryWidget extends ZWidget
{
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="vd_mega-menu-wrapper">
    <div class="vd_mega-menu pull-right w-50">
        <ul class="mega-ul w-50">
            <li id="top-menu-profile" class="profile mega-li add w-100">

                <a href="#" class="pastgaStrelka mega-link dropdown-toggle" data-toggle="dropdown" data-action="click-trigger">
                        
                        <span>
                           Доставка в   
                        </span>              
                </a>
                

                <div class="vd_mega-menu-content dropdown-menu gg w-100" >
                    <div class="child-menu mt-2">
                        <div class="content-list content-menu pl-1 pr-3">
                            <h5 class="text-dark mb-2 ml-2"></h5>
                            <ul class="list-wrapper">
                           
                                    {countryStatus}
                              
                            </ul>
                        </div>
                    </div>
                </div>

            </li>
        </ul>
    </div>
</div>
HTML,
        
        'countryStatus' => <<<HTML
            <li>
            <h3 class="w-100 mr-1 pt-2">
                <div class="menu-text text-light">Доставка в</div>            
                <div class="w-100">{country}</div> 
            </h3>
</li>
            
              
           
HTML,

        

    ];
    public function asset()
    {
        $this->fileCss('/render/market/ZDeliveryWidget/assets/style.css');
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
             '{countryStatus}' => ZSelect2Widget::widget([
                'config' => [
                'imagePath' => true,
                ]
             ])
        ]);



    }
}
