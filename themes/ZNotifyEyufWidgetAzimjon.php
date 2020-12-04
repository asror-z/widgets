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
use zetsoft\assets\theme\ZMainAsset;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

class ZNotifyEyufWidgetAzimjon extends ZWidget
{

    public $config = [];
    public $_config = [
        'badge' => 0,
        'url' => '',
        'type' => self::type['mdb'],
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
    <button id="notify" class="btn mega-link dropdown-toggle" data-toggle="dropdown">
                    <span class="mega-icon vend-icon-color noti-position"><i class="{icon}"></i></span>
                    <span class="badge vd_bg-red">{badge}</span>
                </button>
    
    
    <!--<a href="#" class="btn-floating btn-info btn-sm" data-action="click-trigger">
        <i class="{icon} vend-icon-color"></i>

    </a>-->
        <!--<span class="badge counter">{badge}</span>-->

    <div class="vd_mega-menu-content width-xs-3 width-sm-4 width-md-5 width-lg-4 right-xs left-sm dropdown-menu" aria-labelledby="notify">
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
            
            {notifies}
            
        </div> <!-- child-menu -->
    </div>   <!-- vd_mega-menu-content -->
   
   
    </li>
    <!--</div>
     </div>-->

    
HTML,
        'main' => [
            'mdb' => <<<HTML
                      <div class="child-menu">
                            <div class="content-list content-image">
                                    <div id="{id}" class="mCustomScrollbar _mCS_2" style="overflow:hidden;">
                                        <ul class="list-wrapper pd-lr-10" id="notify-items">
                                        {content}  
                                        </ul>
                                    </div>
                                      <div class="closing text-center" style="">
                                  <a href="/cores/user/index.aspx" data-pjax="0">
                                                            Посмотреть все уведомления <i class="fa fa-angle-double-right"></i></a>
                                     </div>
                                </div>
                                
                                
                                
                            </div>
HTML,
            'pro' => <<<HTML
            <div class="child-menu">
                      <div class="content-list content-image">
                            <div id="{id}" class="mCustomScrollbar _mCS_2" style="overflow:hidden;">
                            
                                 <ul class="list-wrapper pd-lr-10">
                                    {content}  
                                 </ul>
                                 
                            </div>
                            
                            <div class="closing text-center" style="">
                            
                              <a href="/cores/user/index.aspx" id="notifyFor">
                                Посмотреть все уведомления 
                              <i class="fa fa-angle-double-right"></i>
                              </a>
                            </div>
                      </div>
            </div>
HTML,
        ],
        'unread' => [
            'mdb' => <<<HTML
         <li class="notify-li" id="{id}">
         
         
                 <div class="menu-icon ">
                 <img alt="photo" src="{userPhoto}">
                
                </div>
                <div class="menu-text">  
                <div>
                <p class="user-name">{name}</p> 
                <span class="d-inline-block user-message">{text}</span>
                </div>
                    <div class="menu-info d-flex justify-content-between align-items-center">
                        <span class="menu-date notify-time"> {time} </span>
                        <span class="menu-action">
                            <span class="menu-action-icon menuAction icon-eye">   
                                  {eyeButton}
                                <!--<i class="fas fa-eye"></i>-->                         
                            </span>
                        </span>
                    </div>
                </div>
                
                        </li>
      
HTML,
            'pro' => <<<HTML
         <li>
         
         <a href="{url}" class="d-block noHover" data-pjax="0" target="_blank">
         
         <div class="menu-icon ">
         <img alt="photo" src="{userPhoto}">
       
                </div>
          <div class="menu-text">  
          <p  class="user-name">{name}</p> 
                 <p class="user-message text-truncate">{text}</p>
                    <div class="menu-info d-flex justify-content-between">
                            <span class="menu-date"> {time} </span>
                        <span class="menu-action">
                            <span class="menu-action-icon menuAction icon-eye"
                                data-original-title="Mark as Unread"
                                data-toggle="tooltip" data-placement="bottom">
                                   {eyeButton}
                                <!--<i class="far fa-eye-slash"></i>-->
                            
                            </span>
                        </span>
                    </div>
                </div>
                
                
                
                        </a>
                        
                        </li>
HTML,
        ],
        'read' => [
            'mdb' => <<<HTML
        <li class="notify-li" id="{id}">
            <div class="menu-icon ">
                <img alt="photo" src="{userPhoto}">
            </div>
            <div class="menu-text">  
                <div>
                    <p class="user-name">{name}</p> 
                    <span class="d-inline-block user-message">{text}</span>
                </div>
                <div class="menu-info d-flex justify-content-between align-items-center">
                    <span class="menu-date notify-time">{time}</span>
                    <span class="menu-action">
                        <span class="menu-action-icon menuAction icon-eye">
                            {eyeButton}
                            <!--<i class="fas fa-eye"></i>-->
                        </span>
                    </span>
                </div>
            </div>
        </li>
HTML
        ],
        'css' => [
            'mdb' => <<<CSS
            .border-bg{
            border: 2px solid #0D47A1 !important;
            }
            
            .sx
            {
            display: inline-block !important;
             padding: 0 !important;
             padding-top: 0px !important;
     
            }
            
            .notify-link:hover{
                text-decoration: none;
                background: transparent!important;
            }
            .notify-icon{
                margin-top: 10px;
            }
            .user-message{
            width: 90%;
            max-height: 40px;
            font-weight: normal;
            font-size: 16px !important;
            margin: 0; 
             }
            .closing{
            font-size: 16px;
            }
            .list-wrapper li a{
                color: black;
            }
            .user-name{
                margin: 0;
            }
            .vend-icon-color{
            color: #0d47a1 !important;
        } 
            .noHover:hover{
                background: transparent!important;
            }
            
        .notify-time{
            font-size: 12px;
        }
        .notify-li{
            cursor: pointer;
        }
        .noti-position{
            position: absolute;
        }
            
CSS
        ],
        'scroll' => <<<JS
        $('#{id}').slimscroll({
            width: '',
            railVisible: true,
            allowPageScroll: true,
            touchScrollStep: 1000,
            height:'320',
        }); 
    
        $('.icon-eye i').on('click', function() {
             $(this).removeClass('fa-eye-slash')
             .addClass('fa-eye');
             $('#refreshButton').click();
        });
        
       {sweet}
       
        const socket = io('ws://'+document.domain+':2020/notification');
        
        socket.on('connected', () => {
            console.log('connected');
        })
        
        socket.on('new notify', (notify) => {
            $('#notify-items').append(notify);
        })
JS,
        'guest' => <<<HTML

HTML,

        'sweet' => <<<JS
          $('#{id}').on('click', function() {
                {funcnime}();
                
         });
         console.log('hi');
JS,

    ];



    public const type = [
        'mdb' => 'mdb',
        'pro' => 'pro',
    ];


    public $depend = [
        ZMainAsset::class
    ];

    /* @var ZMessageItem[] $data */
    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js');
    }


    public function codes()
    {

        $id = $this->userIdentity()->id;

        $readButton = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnRounded' => false,
                'text' => '',
                'method' => ZButtonWidget::method['post'],
                'pjax' => true,
                'title' => 'read',
                'ttSize' => ZButtonWidget::ttSize['small'],
                'ttSide' => ZButtonWidget::ttSide['bottom'],
                'btn' => false,
                'iconColor' => '#0d47a1',
                'icon' => 'far fa-' . FA::_SLASH,
            ],
        ]);

        $unreadButton = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnRounded' => false,
                'text' => '',
                'method' => ZButtonWidget::method['post'],
                'pjax' => true,
                'title' => 'read',
                'ttSize' => ZButtonWidget::ttSize['small'],
                'ttSide' => ZButtonWidget::ttSide['bottom'],
                'btn' => false,
                'iconColor' => '#0d47a1',
                'icon' => 'fas fa-' . FA::_EYE_SLASH,
            ],

        ]);
        
        $this->data = Az::$app->utility->notify->notifies();
        $badge = Az::$app->utility->notify->notifiesBadge();
        
        if($badge === 0){
            $badge = '';
        }

        $sweet = '';
        $content = '';

        $myId = 1;
        foreach ($this->data as $messageItem) {

            echo ZSweetAlert2Widget::widget([
                'config' => [
                    'funcName' => 'notifyalert'.$myId,
                    'text' => $messageItem->time,
                    'button' => 'dsa'

                ]
            ]);

            $eyeBtn = ZButtonWidget::widget([
                'config' => [
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'btnStyle' => ZButtonWidget::btnStyle['none'],
                    'btnRounded' => false,
                    'text' => '',
                    'pjax' => 0,
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
                            eyeRemoveNotifAjax('/tester/eyeremove/notify.aspx?id=$messageItem->id');
                        }
JS
                ],
            ]);
            if ($messageItem->read) {
                $content .= strtr($this->layout['read'][$this->_config['type']], [
                    '{userPhoto}' => $messageItem->photo,
                    '{text}' => $messageItem->text,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{readButton}' => $readButton,
                    '{id}' => 'n' . $myId,
                    '{eyeButton}' => $eyeBtn,
                    '{url}' => '/cores/notify/view.aspx?id=' . $messageItem->id,
                ]);
            }else {
                $content .= strtr($this->_layout['unread'][$this->_config['type']], [
                    '{userPhoto}' => $messageItem->photo,
                    '{text}' => $messageItem->text,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{unreadButton}' => $unreadButton,
                    '{eyeButton}' => $eyeBtn,
                    '{id}' => 'n' . $myId,
                    '{url}' => '/cores/notify/view.aspx?id=' . $messageItem->id,
                ]);
            }
            $sweet .= strtr($this->_layout['sweet'],[
                '{funcnime}' => 'notifyalert'.$myId,
                '{id}' => 'n'.$myId,

            ]);


            $myId++;
        }


        $notifies = strtr($this->_layout['main'][$this->_config['type']], [
            '{content}' => $content,
            '{id}' => $this->id
        ]);

        $this->js = strtr($this->_layout['scroll'], [
            '{id}' => $this->id,
            '{sweet}' => $sweet

        ]);




        $this->css = strtr($this->_layout['css'][$this->_config['type']], [

        ]);



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
            'id' => 'refreshNotify'
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
         viewAll('/tester/eyeremove/viewall.aspx?id=$id');
    }
    
JS
            ],

        ]);

        $this->htm .= strtr($this->_layout['popover'],[
            '{badge}' => $badge,
            '{refreshButton}' => $refreshButton,
            '{viewButton}' => $viewButton,
            '{icon}' => $this->_config['icon'],
            '{title}' => $this->_config['title'],
            '{notifies}' => $notifies
        ]);
        $this->htm .= ZAjaxWidget::widget([
            'config' => [
                'func' => 'eyeRemoveNotifAjax',
            ],
            'event' => [
                'complete' => <<<JS
            function (event) {
                  
                  
            }
JS,
                'done' => <<<JS
        
        setTimeout(function() {
            $('#refreshNotify').click()
        
        }, 5)
        
    
JS,

            ],

        ]);

        $this->htm .= ZAjaxWidget::widget([
            'config' => [
                'func' => 'viewAll',
            ],

            'event' => [
                'done' => <<<JS
        
        setTimeout(function() {
            $('#refreshNotify').click()
        
        }, 5)
        
    
JS,
            ]

        ]);







    }
}
