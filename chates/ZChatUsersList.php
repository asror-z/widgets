<?php

namespace zetsoft\widgets\chates;


use rmrevin\yii\fontawesome\FA;
use zetsoft\models\chat\ChatMessage;
use zetsoft\models\user\User;
use zetsoft\dbitem\chat\MessageItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

/**
 **
 * Author:  AzimjonToirov
 * Refactored: Tursunaliyev Abdulloh  
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZChatUsersList extends ZWidget
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
        'type' => ZChatUsersLIst::type['telegram']

    ];

    public const  type = [
        'mdb' => 'mdb',
        'telegram' => 'telegram'
    ];


    public function codes()
    {


        if (!empty($this->data))
            return false;

        /// All users
        $users = User::find()
            ->where(['not',
                ['id' => $this->userIdentity()->id]
            ])
            ->orderBy('id')
            ->all();

        foreach ($users as $val) {
           // vdd($val);
         
            $query = ChatMessage::find()
                ->where(['and',
                    ['sender' => $val->id],
                    ['receiver' => $this->userIdentity()->id]
                ])
                ->orWhere(['and',
                    ['sender' => $this->userIdentity()->id],
                    ['receiver' => $val->id]
                ])
                ->orderBy([
                    'id' => SORT_ASC
                ]);

            $message = $query->all();

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
                continue;   // message mavjud bo'lmasa o'tkazib yubor
                $time = '';
                $text = '';
            }

            $readCount = ChatMessage::find()
                ->where([
                    'receiver' => $this->userIdentity()->id,
                    'sender' => $val->id,
                    'read' => false
                ])
                ->count();


            $img = Az::$app->App->eyuf->chat->getUserPhoto($val->id);

            if ($val === null)
                Az::error($val->sender, 'User Not Exists');
            $item = new MessageItem();
            $item->name = $val->name;
            $item->userId = $val->id;
            $item->photo = $img;
            $item->time = $time;
            $item->reading = $readCount;
            $item->text = $text;
            $Item->read = false;
            $this->data[] = $item;

        }// END FOREACH //

        $url = ZUrl::to([$this->urlParamStr]);


        $this->layout = [
            'userlist' => [
                'mdb' => <<<HTML
        <div class="white z-depth-1 px-2 rounded pt-3 pb-0 members-panel-1 usersList" >
             
          <ul id='{id}' class="list-unstyled friend-list w-100  sieve " >
              {content}
          </ul>
        </div>
HTML,

                'telegram' => <<<HTML

<div class="col-lg-12 ml-3 pp" style=" height: 830px; border: 1px solid lightgrey; border-radius: 2px";>
                <div class="row flex-column sieve">
               
                   {content}
               
                </div>
            </div>
            
HTML,


            ],
            'userRead' => [
                'mdb' => <<<HTML
        
          <li class="active p-2 w-100" id="b{userId}" >
              <a href="{url}?userId={userId}" class="d-flex justify-content-between">
                <div class="w-75 d-flex justify-content-between">
                    <div class="w-25 d-flex justify-content-center avatar avatar-online" style="position: relative">
                        <img src="{photo}" alt="avatar" class="statAvatar avatar avatar-online rounded-circle align-self-center mr-2 z-depth-1">              
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
                'telegram' => <<<HTML

 <div class="col-lg-12 height" id="b{userId}">
                        <div class="row">
                            <a href="{url}?userId={userId}">
                                 <div class="lichka_box d-flex justify-content-between">
                                <div class="left1 d-flex">
                                    <div class="img_box">
                                        <img src="{photo}">
                                        {online2}
                                    </div>
                                    <div class="who_box">
                                        <p class="recent">{name}</p>
                                        <p class="regular">{text}</p>
                                    </div>
                                </div>
                                <div class="left2 ">
                                    <p class="light">{time}</p>
                                    
                                </div>
                            </div>
                            </a>
                       
                        </div>
                    </div>
HTML,


            ],
            'userUnRead' => [
                'mdb' => <<<HTML
          <li class="active p-2 w-100" id="b{userId}">
              <a href="{url}?userId={userId}" class="d-flex justify-content-between">
                <div class="w-75 d-flex justify-content-between">
                    <div class="w-25 d-flex justify-content-center" >
                        
                        <div style="col-lg-12 height pr-5;background: black!important; position: relative">
                        <img src="{photo}" alt="avatar" class="statAvatar avatar avatar-online rounded-circle align-self-center mr-2 z-depth-1">
                       
                       {online2}
                         
                        
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
                </div>
              </a>
                <div style="position:relative;float: right;top: -50px;right: 20px">   
                           <span><a class="btn-floating btn-sm btn-info" href="/cores/user/ZUsersDataList.aspx?userId={userId}"><i class="fas fa-info" id="usePjax"></i></a></span> 
                            
                    </div>
       
            </li>
           
HTML,
                'telegram' => <<<HTML
    
                <div class="col-lg-12 height pr-5" id="b{userId}">
                       
                            <a href="{url}?userId={userId}">
                                 <div class="lichka_box d-flex justify-content-between">
                                <div class="left1 d-flex">
                                    <div class="img_box">
                                        <img src="{photo}">
                                        {online2}
                                    </div>
                                    <div class="who_box">
                                        <p class="recent">{name}</p>
                                        <p class="regular">{text}</p>
                                    </div>
                                </div>
                                <div class="left2 ">
                                    <p class="light">{time}</p>
                                    
                                </div>
                            </div>
                            </a>
                       
                     
                    </div>
HTML,

            ],
            'scroll' => <<<JS
             $('#{id}').slimscroll({
                railVisible: '{railVisible}',
                allowPageScroll: true,
                touchScrollStep: 1000,
                height : '{height}',
             });
    
JS,
            'css' => [
                'mdb' => <<<CSS
        
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
            background: white!important;
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
     
       .pp{
        padding: 10px !important;
        
       } 
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
        
    
CSS,
                'telegram' => <<<CSS
   
        .header__tg{
            padding: 10px;
            color: white;
            background-color:#7ba6d1;
            font-size: 35px !important;
        }
        .list-unstyled{
         height: 700px;
        }
        
      
       .pl-md-3 {
        padding-left: 1rem!important;
         }
       .header__chat{
        
        padding: 20px;
       }
       .avatar2{
        width: 60px;
       }
       .t_icon{
        font-size: 20px !important;
       }

       .avatar{
           width: 90px;
           height: 80px;
           
       }

       .chat-body{
        border-radius: 5px;
       }
       
        a {
            font-size: 14px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        .height {
            width: 100%;
            height: 40px;
            margin-top: 0px !important;
            padding: 15px 0 11px 21px  ;
        }
     
        .recent {
            margin-left: 10px;
            margin-right: 10px;
            font-weight: 700;
           
        }

        .light {
            font-weight: 300;
           
        }

        .blue {
            margin-left: 10px;
            margin-right: 10px;
        }

        .lichka_box {
            width: 100%;
            height: 60px;
        }
        .row{
            margin-left:-27px;
        }
        .pl-md-3{
        padding-left:0 !important;
        }

        .img_box {
            width: 60px;
            height: 60px;
            overflow: hidden;
            border-radius: 50%;
        }

        .who_box {
            margin-left: 10px;
            
        }

        .who_box .recent {
            margin: 0;
            margin-top: 5px;
            margin-bottom: 2px;
        }

        .light {
            font-size: 16px;
            margin: 0;
            margin-top: 5px;
            margin-bottom: 2px;
        }

CSS,
            ]
        ];


        $content = '';
        
        foreach ($this->data as $messageItem) {
            if ($messageItem->reading) {
                $reading = "<span class='badge badge-danger float-right'>$messageItem->reading</span>";
            } else {
                $reading = "";
            }


                /*if ($messageItem->online == 1) {
                    $online1 = "<img src='http://www.downloadclipart.net/large/21338-glossy-green-circle-button-design.png' style='bottom: 1px;right: 13px;display: block;margin: -9px auto;margin-right: 14px'  height='13' width='13'>";
                } else {
                    $online1 = "<img src='http://icongal.com/gallery/image/98937/circle_grey.png' style='bottom: 1px;right: 13px;display: block;margin: -9px auto;margin-right: 14px'  height='13' width='13'>";
                }*/
            $role = User::findOne($messageItem->userId);
            
            if(strlen($messageItem->text) === 90 || strlen($messageItem->text) === 53){
                $messageItem->text ='<span style="color: red">'.Az::l('вы: ').'</span>'. Az::l('Помахать');

            }

            if ($messageItem->read)
                $content .= strtr($this->layout['userRead'][$this->_config['type']], [
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
                $content .= strtr($this->layout['userUnRead'][$this->_config['type']], [
                    '{photo}' => $messageItem->photo,
                    '{text}' => $messageItem->text,
                    //'{online2}' => $online1,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{reading}' => $reading,
                    '{userId}' => $messageItem->userId,
                    '{role}' => $role->userRole(),
                    '{url}' => $url

                ]);
        }
        $this->htm = strtr($this->layout['userlist'][$this->_config['type']], [
            '{content}' => $content,
            '{id}' => $this->id,

        ]);
        $this->js = strtr($this->layout['scroll'], [
            '{id}' => $this->id,
            '{height}' => $this->_config['height'],
            '{railVisible}' => $this->_config['railVisible']
        ]);


        $this->css = strtr($this->layout['css'][$this->_config['type']], [

        ]);


        $this->js .= <<<JS
$(document).pjax('#usePjax', '/cores/user/ZUsersDataList.aspx?userId={userId}')
JS;


    }

}
