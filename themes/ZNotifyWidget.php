<?php
/**
 *
 *
 * Author:  Musoxon Adulkhamidov
 * @license AzimjonToirov
 *
 *
 */

namespace zetsoft\widgets\themes;

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Html;
use zetsoft\assets\theme\ZMainAsset;
use zetsoft\dbitem\chat\MessageItem;
use zetsoft\dbitem\core\NotifyItem;
use zetsoft\models\auto\ChatMessage;
use zetsoft\models\auto\ChatNotify;

use zetsoft\models\user\User;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZPopoverXWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

class ZNotifyWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'badge' => 0,
        'url' => '',
        'type' => self::type['mdb'],
        'title' => 'message',
        'viewButtonTitle' => '',
        'grapes' => false,
        'hint' => 'Уведомления',
    ];

    public $layout = [];
    public $_layout = [
        'popover' => <<<HTML
    <span id="notify" class="mega-link" data-toggle="dropdown" style="border-radius: 50%">
        <span class="mega-icon hint--bottom" aria-label="{hint}"><i class="{icon} grey-text " style="cursor: pointer;" title="
        "></i></span>asdasd
        <span class="counter px-2 success-color {class}">{badge}</span>
    </span>
    
    <div class="dropdown-menu mt-4 p-0 rounded" aria-labelledby="notify" >
            <div class="dropdown-item align-items-center rounded-top success-color  d-flex justify-content-between" {readonly}>
                <div class="fp-18 text-white">{title}</div>
                <div class="vd_panel-menu mt-1"  >
                    <span class="menu mr-2">
                       {viewButton}
                    </span> 
                    <span class="menu">
                       {refreshButton}
                    </span>
                </div>
            </div>
            
            {notifies}
            
    </div>  
    
HTML,
        'main' => [
            'mdb' => <<<HTML
            <div class="child-menu">
                <div class="content-list content-image">
                    <div id="{id}" class="mCustomScrollbar _mCS_2" style="overflow:hidden;">
                        <ul class="pd-lr-10 pl-0">
                        {content}  
                        </ul>
                    </div>
                    <div class="text-center p-1" style="background-color: #f3f3f3;">
                    <a href="/cruds/chat-notify/index.aspx"  data-pjax="0"                     <a href="/cores/user/index.aspx" style="background: none;" data-pjax="0">
                    Посмотреть все уведомления <small><i class="fa fa-angle-double-right text-muted"></i></small>
                    </a>
                    </div>
                </div>
            </div>
HTML,
            'pro' => <<<HTML
            <div class="child-menu">
                <div class="content-list content-image">
                    <div id="{id}" class="mCustomScrollbar _mCS_2">
                        <ul class="pd-lr-10">
                            {content}  
                        </ul>
                    </div>
                    <div class="text-center">
                    <a href="/cruds/chat-notify/index.aspx" id="notifyFor">
                    Посмотреть все уведомления <i class="fa fa-angle-double-right"></i>
                    </a>
                    </div>
                </div>
            </div>
HTML,
        ],
        'unread' => [
            'mdb' => <<<HTML
            <li class="notify-li d-flex" id="{id}">
                <div>
                    <img alt="photo" width="50" height="50" src="{userPhoto}" class="img-fluid">
                </div>
                
                <div class="w-75">  
                    <div class="ml-2">
                        <p>{name}</p> 
                        <span class="d-inline-block">{text}</span>
                    </div>
                    <div class="menu-info d-flex justify-content-between align-items-center">
                        <span class="menu-date"> {time} </span>
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
             <a href="{url}" class="d-block" data-pjax="0" target="_blank">
                <div class="menu-icon ">
                    <img alt="photo" src="{userPhoto}">
                </div>
                
                <div class="menu-text">  
                    <p>{name}</p> 
                    <p class="text-truncate">{text}</p>
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
        <li id="{id}">
            <div class="menu-icon ">
                <img alt="photo" src="{userPhoto}">
            </div>
            
            <div class="menu-text">  
                <div>
                    <p>{name}</p> 
                    <span class="d-inline-block">{text}</span>
                </div>
                <div class="menu-info d-flex justify-content-between align-items-center">
                    <span class="menu-date">{time}</span>
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


        'scroll' => <<<JS
        $('#{id}').slimscroll({
            width: '250',
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
    
JS,

        'sweet' => <<<JS
            $('#{id}').on('click', function() {
                {funcnime};
            });
            console.log('hi');
JS,
    ];

    public const type = [
        'mdb' => 'mdb',
        'pro' => 'pro',
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.js');
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
                'iconColor' => 'white',
                'icon' => 'fp-13 text-white far fa-' . FA::_SLASH,
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
                'iconColor' => 'white',
                'icon' => 'fp-13  text-white  fas fa-' . FA::_EYE_SLASH,
            ],

        ]);

        $data = Az::$app->utility->notify->notifies();

        $badge = Az::$app->utility->notify->notifiesBadge();

        // notification testing
        //$badge = 15;
        if ($badge === 0) {
            $badge = 0;
        }

        $sweet = '';
        $content = '';

        $myId = 1;
        foreach ($data as $messageItem) {

            /*echo ZSweetAlert2Widget::widget([
                 'config' => [
                     'funcName' => 'notifyalert' . $myId,
                     'text' => $messageItem->time,
                     'button' => 'dsa'

                 ]
             ]); */

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
                    'iconColor' => 'white',
                    'icon' => 'fp-13 text-white fa fa-' . FA::_EYE_SLASH,
                ],
                'event' => [
                    'click' => <<<JS
                        function () {
                            eyeRemoveNotifAjax('/core/tester/eyeremove/notify.aspx?id=$messageItem->id');
                        }
    
JS
                ],
            ]);
            
            if ($messageItem->read)
                $content .= strtr($this->_layout['read'][$this->_config['type']], [
                    '{userPhoto}' => $messageItem->photo,
                    '{text}' => $messageItem->text,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{readButton}' => $readButton,
                    '{id}' => 'n' . $myId,
                    '{eyeButton}' => $eyeBtn,
                    '{url}' => '/cruds/chat-notify/view.aspx?id=' . $messageItem->id,
                ]);
            else
                $content .= strtr($this->_layout['unread'][$this->_config['type']], [
                    '{userPhoto}' => $messageItem->photo,
                    '{text}' => $messageItem->text,
                    '{name}' => $messageItem->name,
                    '{time}' => $messageItem->time,
                    '{unreadButton}' => $unreadButton,
                    '{eyeButton}' => $eyeBtn,
                    '{id}' => 'n' . $myId,
                    '{url}' => '/cruds/chat-notify/view.aspx?id=' . $messageItem->id,
                ]);

            $sweet .= strtr($this->_layout['sweet'], [
                '{funcnime}' => 'notifyalert' . $myId,
                '{id}' => 'n' . $myId,

            ]);

            $myId++;
        }

        $class = '';
        if ($badge === 0) {
            $class = 'd-none';
        }
        
        $notifies = strtr($this->_layout['main'][$this->_config['type']], [
            '{content}' => $content,
            '{id}' => $this->id,
        ]);

        $this->js = strtr($this->_layout['scroll'], [
            '{id}' => $this->id,
            '{sweet}' => $sweet
        ]);

        $refreshButton = ZButtonWidget::widget([
            'config' => [
                'url' => '',
                'hasIcon' => true,
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnRounded' => false,
                'text' => '',
                //'method' => ZButtonWidget::method['post'],
                'pjax' => true,
                'title' => 'Обновление',
                'ttSize' => ZButtonWidget::ttSize['small'],
                'ttSide' => ZButtonWidget::ttSide['bottom'],
                'btn' => false,
                'class' => 'h-100 p-0 bg-transparent',
                'iconColor' => 'white',
                'icon' => 'fp-13  text-white  fa fa-' . FA::_SYNC,
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
                'class' => 'h-100 p-0 bg-transparent',
                'title' => $this->_config['viewButtonTitle'],
                'ttSize' => ZButtonWidget::ttSize['small'],
                'ttSide' => ZButtonWidget::ttSide['bottom'],
                'btn' => false,
                'iconColor' => 'white',
                'icon' => 'fp-13  text-white  fa fa-' . FA::_EYE,

            ],
            'event' => [
                'click' => <<<JS
                    function () {
                        viewAll('/core/tester/eyeremove/viewall.aspx?id=$id');
                    }
JS
            ],
        ]);

        $this->htm .= strtr($this->_layout['popover'], [
            '{badge}' => $badge,
            '{refreshButton}' => $refreshButton,
            '{viewButton}' => $viewButton,
            '{icon}' => $this->_config['icon'],
            '{title}' => $this->_config['title'],
            '{notifies}' => $notifies,
            '{class}' => $class,
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
            '{hint}' => $this->_config['hint']
        ]);
        
        $this->htm .= ZAjaxWidget::widget([
            'config' => [
                'func' => 'eyeRemoveNotifAjax',
            ],
            'event' => [
                'complete' => <<<JS
                    function (event) {
                        console.log(event)
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
