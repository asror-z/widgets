<?php

namespace zetsoft\widgets\chates;


use rmrevin\yii\fontawesome\FA;
use zetsoft\models\user\User;
use zetsoft\models\chat\ChatMessage;
use zetsoft\dbitem\chat\MessageItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
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
class ZChatDataList extends ZWidget
{

    public $config = [];
    public $_config = [
        'name' => 'Sardor',
        'status' => 'lastseen recently',
        'tagtext' => 'Hello how are you',
        'badge' => 0,
        'addFriend' => FA::_PLUS,
        'height' => '100%',
        'railVisible' => true,

    ];
    

    public function codes()
    {

        if (!empty($this->data))
            return false;


        /// All users
        $users = User::find()
            ->where(['NOT',
                ['id' => $this->userIdentity()->id]
            ])
            ->orderBy('id')
            ->all();

        foreach ($users as $val) {
           /* if (date('Y-m-d H:i:s', strtotime($val->online)) > date('Y-m-d H:i:s', strtotime('-8 sec')))
                $online = 1;
            else
                $online = 2;*/
            $message = ChatMessage::find()
                ->where(['and',
                    ['sender' => $val->id],
                    ['receiver' => $this->userIdentity()->id]
                ])
                ->orWhere(['and',
                    ['sender' => $this->userIdentity()->id],
                    ['receiver' => $val->id]
                ])
                ->orderBy([
                    'id' => SORT_DESC
                ])
                ->all();


            if ($message) {

                foreach ($message as $valMess) {
                    $add = '';
                    if ($valMess->sender == $this->userIdentity()->id) {
                        $add = "<span style='color:red'>вы: </span>";
                    }
                    $time = $valMess->time;
                    $text = $add . $valMess->text;
                }
            } else {
                $time = "";
                $text = "";
            }

            $readCount = ChatMessage::find()
                ->where([
                    'receiver' => $this->userIdentity()->id,
                    'sender' => $val->id,
                    'read' => false
                ])
                ->count();


            //$img=Az::$app->App->eyuf->chat->getUserPhoto($val->id);
            $img = $val->userPhoto();

            if ($val === null)
                Az::error($val->sender, 'User Not Exists');
            $item = new MessageItem();
            $item->name = $val->name;
            $item->userId = $val->id;
            $item->photo = $img;
            //$item->time = $time;
            $item->reading = $readCount;
            //$item->text = $text;
            //$item->online = $online;
            $Item->read = false;
            $this->data[] = $item;

        }


        $this->layout = [];
        $this->_layout = [
            'userlist' => <<<HTML
        <div class="blue-grey lighten-5 z-depth-1 px-2 rounded pt-3 pb-0 members-panel-1 usersList" >
             
          <ul id='{id}' class="list-unstyled friend-list w-100  sieve " style="overflow: scroll!important;" >
              {content}
          </ul>
        </div>
HTML,

            'userRead' => <<<HTML
        
          <li class="active p-2 w-100 user-li" id="b{userId}" >
              <a href="{url}?userId={userId}" class="d-flex justify-content-between">
                <div class="w-75 d-flex justify-content-between">
                    <div class="w-25 d-flex justify-content-center avatar avatar-online" style="position: relative">
                        <img src="{photo}" alt="avatar" class="statAvatar avatar avatar-online rounded-circle align-self-center mr-2 z-depth-1">
                        
                              {online2}
                              <img src='http://www.downloadclipart.net/large/21338-glossy-green-circle-button-design.png' style='bottom: 1px;right: 13px;display: block;margin: -9px auto;margin-right: 14px'  height='13' width='13'>
                        
                    </div>
                    <div class="text-small w-75">
                      <strong>{name}</strong>
                      <p class="last-message text-muted text-truncate"> {text}</p>
                      <i class="text-smaller text-muted"> {status}</i>
                    </div>
                    
                    
                </div>
                
                <div class="chat-footer mt-1">
                <p class="chattime mb-3 text-right"> {time}</p>
                 <i class="d-none fa fa-ban fa-2x" title="ban user"></i>
                  {reading}
                </div>
              </a>
              
            </li>
          
           
HTML,
            'userUnRead' => <<<HTML
          <li class="active p-2 w-100 user-li" id="b{userId}">
              <a href="{url}?userId={userId}" class="d-flex justify-content-between">
                <div class="w-75 d-flex justify-content-between">
                    <div class="w-25 d-flex justify-content-center" >
                        
                        <div style="position: relative">
                        <img src="{photo}" alt="avatar" class="statAvatar avatar avatar-online rounded-circle align-self-center mr-2 z-depth-1">
                       
                       {online2}
                       <img src='http://icongal.com/gallery/image/98937/circle_grey.png' style='bottom: 1px;right: 13px;display: block;margin: -9px auto;margin-right: 14px'  height='13' width='13'>
                         
                        
                        </div>
                    </div>
                    <div class="text-small w-75">
                      <strong>{name}</strong>
                      <p class="last-message text-muted text-truncate"> {text}</p> 
                      <b>{role}</b>
                      <i class="text-smaller text-muted"> {time}</i>
                    </div>
                </div>
                <div class="chat-footer mt-1">
                <p class="chattime mb-3 text-right"> {time}</p>
                 <i class="d-none fa fa-ban fa-2x" title="ban user"></i>
                     {reading}
                    <!-- <div style="position:relative;float: right;top: -60px">
                           <span><a class="btn-floating btn-sm btn-info" href="/logics/scholar/index.aspx#menu"><i class="fas fa-info"></i></a></span>  
                    </div>-->
                   
                </div>
           
              </a>
       
            </li>
           
HTML,
            'scroll' => <<<JS
             $('#{id}').slimscroll({
                railVisible: '{railVisible}',
                allowPageScroll: true,
                touchScrollStep: 1000,
                height : '{height}',
             });
             
             
JS,
            <<<CSS
        .chat-body{
        border-radius: 20px !important;
        }
      /*  .fa-ban{
            font-size: 30px !important;
            color: black !important;
        }
        .fa-ban:hover{
            color:gray !important;
        }*/
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
        .usersList{
            overflow : hidden !important;
        }
        .usersList ul li{
            
            min-height: 80px !important;
        }
        .usersList ul li:hover{
            background: lightgrey!important;
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
        .avatar {
            height: 3rem;
            width: 3rem;
        }
        .badge{
        border-radius: 50%;
        width: 20px;
        height: 20px;
        margin: 4px;
        }
        
      /*  .statAvatar::after{
            content: " ";
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: green;
            top: 50px;
            right: 0;
        }*/
        
       .text-smaller{
       font-size: 12px;
       color: green !important;
       margin-top:0px !important;
       }
       .text-muted{
       margin-bottom: 0;
       }
       .chattime{
       font-size: 14px !important;
       color: #808080;
       vertical-align: top !important;
       position: relative;
       }
       .active.p-2.w-100:visited {
             background: red!important;
       }
       .user-li{
            
            border-bottom: 1px solid #dddddd;
       } 
    
CSS,

        ];

        $url = ZUrl::to([$this->urlParamStr]);

        $content = '';
        //vdd($this->data);
        foreach ($this->data as $messageItem) {
            if ($messageItem->reading) {
                $reading = "<span class='badge badge-danger float-right'>$messageItem->reading</span>";
            } else {
                $reading = '';
            }


            /*if ($messageItem->online === 1) {
                $online1 = "<img src='http://www.downloadclipart.net/large/21338-glossy-green-circle-button-design.png' style='bottom: 1px;right: 13px;display: block;margin: -9px auto;margin-right: 14px'  height='13' width='13'>";
            } else {
                $online1 = "<img src='http://icongal.com/gallery/image/98937/circle_grey.png' style='bottom: 1px;right: 13px;display: block;margin: -9px auto;margin-right: 14px'  height='13' width='13'>";
            }*/
            $role = User::findOne($messageItem->userId);

            if (strlen($messageItem->text) === 53 || strlen($messageItem->text) === 90) {
                $messageItem->text = '<span style="color: #ff0000">' . Az::l('вы: ') . '</span>' . Az::l('Помахать');

            }

            if ($messageItem->read)
                $content .= strtr($this->layout['userRead'], [
                    '{photo}' => Az::getAlias(Az::getAlias('@webroot') . $messageItem->photo),
                    '{text}' => $messageItem->text,
                    //'{online2}' => $online1,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{userId}' => $messageItem->userId,
                    '{reading}' => $reading,
                    '{url}' => $url

                ]);
            else
                $content .= strtr($this->_layout['userUnRead'], [
                    '{photo}' => $messageItem->photo,
                    '{text}' => $messageItem->text,
                    //'{online2}' => $online1,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{reading}' => $reading,
                    '{userId}' => $messageItem->userId,
                    '{role}' => $role->role,
                    '{url}' => $url

                ]);
        }
        $this->htm = strtr($this->_layout['userlist'], [
            '{content}' => $content,
            '{id}' => $this->id,

        ]);
        $this->js = strtr($this->_layout['scroll'], [
            '{id}' => $this->id,
            '{height}' => $this->_config['height'],
            '{railVisible}' => $this->_config['railVisible']
        ]);
        /*class="lichka_box d-flex justify-content-between   "*/



    }

}
