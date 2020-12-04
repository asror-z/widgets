<?php
namespace zetsoft\widgets\chates;

use zetsoft\models\user\UserFriend;
use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZChatListWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'chates' => [],
        'users' => [],
        'isSendBtn' => true,
        'btn' => ''
    ];



    public function codes()
    {
        $this->htm .= <<<HTML
            <div class="chat_title">
                <a href="/admin/chat/online-chat.aspx" class="">Все пользователи</a>
             </div>    

HTML;


        foreach ($this->_config['users'] as $user) :
            if($this->_config['isSendBtn'] === false)
                $this->_config['btn'] = '';

            $this->htm .= <<<HTML
        <div class="chat_list active_chat">
        
            <div class="chat_people">
                <div class="chat_img"> <img src="{$user->photo}" alt="sunil"> </div>
                <div class="chat_ib">
                    <h5 class="chat_date">
                    {$user->title}
                    
                    <a class="input_request" href="/admin/chat/add-friend.aspx?friend_id = 1">
                                   
HTML;
                    $friend = UserFriend::find()->all();
                    $bol = 0;
                    foreach ($friend as $fr){
                        if ($fr['friend_id'] == $user['id']){
                            $bol++;
                        }
                    }
                        if ($bol==0){
                            $this->htm .=<<<HTML
                        <button class="btn btn-sm" href="">Добавить в друзья</button>
HTML;

            } else{
                echo '';
            }
                    $this->htm .=<<<HTML
                    
</a><p>{$user->status}</p></h5>
            
<a href="/admin/chat/private-chat.aspx?id={$user->id}" data-toggle="tooltip" data-placement="left" title="add to friend"><i class="chat_send fab fa-telegram-plane"></i></a>
                    
                </div>
            </div>
        </div>
HTML;

endforeach;

            $this->css = <<<CSS
        .fas{
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }
        .fas:hover{
            color: gold;
            transition: all 0.3s ease-in-out;
        }
        .chat_ib h5{ font-size:22px; font-weight: 500; cursor: pointer; color:#464646; margin:0 0 8px 0;}
        .chat_ib h5 span{ font-size:18px; float:right;}
        .chat_ib p{ font-size:14px; color:#989898; margin:auto}
        .chat_img {
            float: left;
            width: 11%;
        }
        .chat_date{
            cursor: pointer;
        }
        .chat_ib {
            display: flex;
            justify-content: space-between;
            float: left;
            padding: 0 0 0 15px;
            width: 88%;
        }
        .chat_title{
            padding: 10px;
        }

        .chat_people{ overflow:hidden; clear:both;}
        .chat_list {
            border-bottom: 1px solid #c4c4c4;
            margin: 0;
            cursor: default;
            padding: 18px 16px 10px;
        }
CSS;
            $this->js=<<<JS
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();

});
JS;

        }

}
