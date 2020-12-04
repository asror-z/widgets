<?php
/**
 *
 *
 * Author:  Musoxon Adulkhamidov
 *
 *
 */


namespace zetsoft\widgets\themes;

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Html;
use zetsoft\assets\theme\ZMainAsset;
use zetsoft\dbitem\ALL\ZMessageItem;
use zetsoft\models\ALL\CoreMessage;
use zetsoft\models\ALL\CoreUser;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZVendroidPopoverWidget;
use zetsoft\widgets\ajaxify\ZAjaxWidget;


class ZMessageEyufWidget extends ZWidget

{

    public $config = [];
    public $_config = [
        'type' => ZMessageEyufWidget::type['mdb'],
        'title' => 'message',
        'viewButtonTitle' => ''
    ];


    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [
        'popover' => <<<HTML
              
        <!--<div class="my-div2">
    <div class="d-inline-blok my-div">-->

       
     <li class="one-icon mega-li">
    <button id="myDropdown" class="btn mega-link dropdown-toggle" data-toggle="dropdown">
                    <span class="mega-icon vend-icon-color mess-position"><i class="{icon}"></i></span>
                    <span class="badge vd_bg-red">{badge}</span>
                </button>
    
    
    <!--<a href="#" class="btn-floating btn-info btn-sm" data-action="click-trigger">
        <i class="{icon} vend-icon-color"></i>

    </a>-->
        <!--<span class="badge counter">{badge}</span>-->

    <div class="vd_mega-menu-content width-xs-3 width-sm-4 width-md-5 width-lg-4 right-xs left-sm dropdown-menu" aria-labelledby="myDropdown">
        <div class="child-menu">
            <div class="title my-title">
                <span class="title-popover">{title}</span>
                <div class="vd_panel-menu mt-1">
                    <span class="menu">
                       {viewButton}
                    </span> 
                    <span class="menu">
                       {refreshButton}
                    </span>
                    
                </div>
            </div>
            
            {messages}
            
        </div> <!-- child-menu -->
    </div>   <!-- vd_mega-menu-content -->
   
   
    </li>
    <!--</div>
     </div>-->

    
HTML,
        'main' => [
            'mdb' => <<<HTML
                        
                        <div class="child-menu" id="message">

                            <div class="content-list content-image">
                                <div id="{id}" >
                                
                                    <ul class="list-wrapper">
                                                {content}  
                                            </ul>
                                            
                                </div>
                                    
                                </div>

</div>                                
                                
HTML,
        ],
        'badgeType' => '<span class="badge vd_bg-red">{count}</span>',
        'unread' => [
            'mdb' => <<<HTML
             <li class="list-wrapper-item">
             
             <a style="display: none"  target="_self" data-method="post" id="messRefresh"  data-pjax="1"   aria-hidden="true" >             
             </a>
                     <div class="menu-icon"><img class="img-1" alt="example img"
                        src="{photo}">
                    </div>                                  
                    <!--;({ids});-->
                    <div class="menu-text"  onclick="eyeRemove(1)" >  
                    {name} 
                    <p class="user-message text-truncate">{text}</p>
                        <div class="menu-info d-flex justify-content-between">
                                <span class="menu-date"> {time} </span>
                            <span class="menu-action">
                                <span id="{id}-unread" class="menu-action-icon icon-eye"
                                    data-original-title="Mark as Unread"
                                    data-toggle="tooltip" data-placement="bottom">
                                   {eyeButton}
                                </span>
                            </span>
                        </div>
                    </div>
                            </li>
                            
    <script>
    
    function eyeRemove(id){
         $("#okButton").click();
         /*$.ajax({
         type:'POST',
         data:{'id':id},
         success:function(res) {    
         },
         })*/
       }
       
    </script>
HTML,



        ],
        'read' => [

            'mdb' => <<<HTML
                
             <li class="list-wrapper-item">
                     <div class="menu-icon"><img class="img-1" alt="photo"
                src="{photo}">
                    </div>
                    <div class="menu-text"  onclick="this_eye_ubrat({ids});" >  {name} 
                    <p class="user-message text-truncate">{text}</p>
                        <div class="menu-info d-flex justify-content-between">
                            <span class="menu-date"> {time} </span>
                            <span class="menu-action">
                                <span id="{id}-read"  class="menu-action-icon icon-eye"
                                    data-original-title="read"
                                    data-toggle="tooltip" data-placement="bottom">
                                    <i class="fa fa-eye" onclick="this_eye_ubrat({ids})"></i>
                                </span>
                            </span>
                        </div>
                    </div>
             </li>
HTML,
        ],
        'scroll' => <<<JS
    
                 $('#{id}').slimscroll({
            width: '',
            railVisible: true,
            allowPageScroll: true,
            touchScrollStep: 1000,
            height:'320',
        });
        
        
           
JS,
        'css' => <<<CSS
        .mega-link{
           padding-left: 1px !important;
        }
        .border-bg{
            border: 2px solid #0D47A1 !important;
        }
        .dropdown-toggle::after{
        content: 0 !important;
        }
        
        .sv{
          display: inline-block !important;
         
          padding: 0 !important;
          padding-top: 10px !important;
        }
       
        .chat-body{
        border-radius: 30px !important;
        }
        
        .user-message{
            font-weight: normal;
            font-size: 16px;
            margin: 0; 
        }
        .closing{
            font-size: 16px;
        }
        .list-wrapper li{
            cursor: pointer;
        }
        .list-wrapper-item:hover{
            background: #e0e0e0;
        }
        .icon-eye:hover{
            background-color: #fff;
            color: #1fae66!important;
            cursor: pointer                
        }
        .vend-icon-color{
            color: #0d47a1 !important;
        }
        #myDropdown .dropdown-toggle::after{
    font-size: 16px!important;
        }
        .one-icon mega-li{
          list-style-type: none;
        }
        
   
CSS,
    ];


    public $depend = [
        ZMainAsset::class
    ];

    public const type = [
        'mdb' => 'mdb',
        'pro' => 'pro',
    ];


    /* @var ZMessageItem[] $data */


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');

        $this->fileCss('/render/ALL/vendroid/assets/theme/vendroid/css/theme.min.css');
        
        $this->fileCss('/render/ALL/vendroid/assets/theme/vendroid/css/theme-responsive.min.css');
    }





    public function codes()
    {



        $data = Az::$app->utility->notify->getMessageItem();
        $id = $this->userIdentity()->id;
        $content = '';
        foreach ($data as $messageItem) {
            $eyeBtn = ZButtonWidget::widget([
                'config' => [
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'btnStyle' => ZButtonWidget::btnStyle['none'],
                    'btnRounded' => false,
                    'text' => '',
                    'pjax' => false,
                    'title' => '',
                    'ttSize' => ZButtonWidget::ttSize['small'],
                    'ttSide' => ZButtonWidget::ttSide['bottom'],
                    'btn' => false,
                    'class' => 'h-100 p-0',
                    'iconColor' => '#0d47a1',
                    'icon' => 'fa fa-' . FA::_EYE_SLASH,
                ],
                'event' => [
                    'click' => <<<JS
        function () {
         viewAllMessagesAjax('/tester/eyeremove/messages.aspx?id=$messageItem->id');
         
    }
JS
                ],
            ]);
            if(strlen($messageItem->text) === 53){
                $messageItem->text ='<span style="color: red">'.Az::l('вы: ').'</span>'. Az::l('Помахать');
            }
            if ($messageItem->read)
                $content .= strtr($this->_layout['read'][$this->_config['type']], [
                    '{photo}' => Az::getAlias(Az::getAlias('@webroot') . $messageItem->photo),
                    '{text}' => $messageItem->text,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{id}' => $this->id,
                    '{ids}' => $messageItem->id
                ]);
            else
                $content .= strtr($this->_layout['unread'][$this->_config['type']], [
                    '{photo}' => $messageItem->photo,
                    '{text}' => $messageItem->text,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{id}' => $this->id,
                    '{ids}' => $messageItem->id,
                    '{eyeButton}' =>   $eyeBtn
                ]);

        }

        $badge = count(Az::$app->utility->notify->getMessageItem());

        if($badge === 0){
            $badge = '';
        }

        $refreshButton = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnRounded' => false,
                'text' => '',
                'method' => ZButtonWidget::method['post'],
                'pjax' => true,
                'title' => 'Обновление',
                'ttSize' => ZButtonWidget::ttSize['small'],
                'ttSide' => ZButtonWidget::ttSide['bottom'],
                'btn' => false,
                'class' => 'h-100 p-0 noHover',
                'iconColor' => '#0d47a1',
                'icon' => 'fa fa-' . FA::_SYNC,
            ],
            'id'=> 'refreshMessage'

        ]);

        $viewButton = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnRounded' => false,
                'text' => '',
                'method' => ZButtonWidget::method['post'],
                'pjax' => true,
                'class' => 'h-100 p-0 noHover',
                'title' => $this->_config['viewButtonTitle'],
                'ttSize' => ZButtonWidget::ttSize['small'],
                'ttSide' => ZButtonWidget::ttSide['bottom'],
                'btn' => false,
                'iconColor' => '#0d47a1',
                'icon' => 'fa fa-' . FA::_EYE,

            ],
            'event' => [
                'click' => <<<JS
        function () {
         viewAll('/tester/eyeremove/allmessages.aspx?id=$id');
    }
    
JS
            ],
        ]);

        $viewAll = Az::l('Посмотреть все сообщения');
        $messages = strtr($this->_layout['main'][$this->_config['type']], [
            '{content}' => $content,
            '{id}' => $this->id,
            '{viewAll}' => $viewAll
        ]);



        $this->htm = strtr($this->_layout['popover'],[
            '{badge}' => $badge,
            '{refreshButton}' => $refreshButton,
            '{viewButton}' => $viewButton,
            '{icon}' => $this->_config['icon'],
            '{title}' => $this->_config['title'],
            '{messages}' => $messages
        ]);

        $this-> js = strtr($this->_layout['scroll'],[
            '{id}' => $this->id
        ]);



        $this->js .= ZAjaxWidget::widget([
            'config' => [
                'func' => ' eyeRemoveMessAjax',
                //'url' => '/tester/eyeremove/messages.aspx',
            ],
            'event' => [
                'complete' => <<<JS
            function (event) {
              //$.pjax.reload({container: '#pjaxId'});
                //$('#refreshButton').click();
             // location.reload();
            }
JS,
                'done' => <<<JS
        
        setTimeout(function() {
            $('#refreshMessage').click()
        
        }, 5)
        
    
JS,

            ],
        ]);

        $this->js .= ZAjaxWidget::widget([
            'config' => [
                'func' => ' viewAllMessagesAjax',
                //'url' => '/tester/eyeremove/messages.aspx',
            ],
            'event' => [
                'complete' => <<<JS
            function (event) {
              //$.pjax.reload({container: '#pjaxId'});
                //$('#refreshButton').click();
             // location.reload();
            }
JS,
                'done' => <<<JS
        
        setTimeout(function() {
            $('#refreshMessage').click()
        
        }, 5)
        
    
JS,

            ],
        ]);
        $this->css=<<<CSS
    li{
        list-style-type: none;
    }
    .mess-position{
            position: absolute;
        }
CSS;



    }
}
