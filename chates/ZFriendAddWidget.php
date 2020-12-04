<?php

namespace zetsoft\widgets\chates;

use zetsoft\models\user\UserFriend;
use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZFriendAddWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'src' => 'https://www.w3schools.com/howto/img_avatar.png',
        'text' => 'lfhoasif fisa  ifsafu fua sif as fiasu fais fias fiu asi fi',
        'data' => '',
        'fullname' => '',
        'grapes' => true,
    ];


    public function asset()
    {

        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');


    }



    public function codes()
    {


        $this->htm .= <<<HTML
                          
                         <li class="d-flex mb-4">
                            <img src="{$this->_config['src']}" alt="avatar" class="avatar rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1" style="height: 3rem;width: 3rem;">
                            <div class="chat-body white p-3 ml-2 z-depth-1"  ' style="max-width: 60%">
                                <div class="header">
                                    <strong class="primary-font">{$this->_config['fullname']}</strong>
                                </div>
                         
                                <p class="mb-0" style="font-weight: normal !important;">
                                    {$this->_config['text']}
                                </p>
                                <span class="d-block text-right"><fp-16 class="pull-right text-muted"><i class="far fa-clock"></i>{$this->_config['data']}</small></span>
                            </div>
                        </li>
                        
HTML;

        $this->css = <<<HTML
    <style>
        img.avatar {
            height: 3rem;
            width: 3rem;
        }
    </style>
HTML;


    }


}
