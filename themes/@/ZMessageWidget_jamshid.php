<?php
/**
 *
 *
 * Author:  Musoxon Adulkhamidov
 *
 *
 */

namespace zetsoft\widgets\themes;
//namespace zetsoft\widgets\themes;

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Html;
use zetsoft\assets\theme\ZMainAsset;
use zetsoft\dbitem\chat\MessageItem;
use zetsoft\models\auto\ChatMessage;
use zetsoft\models\user\User;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZVendroidPopoverWidget;


class ZMessageWidget_jamshid extends ZWidget

{

    public $config = [];
    public $_config = [
        'type' => ZMessageWidget_jamshid::type['mdb'],
        'title' => 'message',
        'viewButtonTitle' => '',
        'class' => '',
        'iconSize'=> 'small'
    ];


    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [
        'popover' => <<<HTML
        <span id="myDropdown" 
            class="mega-link border-none dropdown-toggle" 
            data-toggle="dropdown"
        >
            <span class="mega-icon vend-icon-color"><i class="{icon} grey-text"></i></span>
            <span class="counter px-2 success-color">{badge}</span>
        </span>
    

        <div class="dropdown-menu mt-4 p-0 rounded" aria-labelledby="myDropdown">       
            <div class="align-items-center dropdown-item d-flex justify-content-between success-color rounded-top">
                <div class="text-white fp-18">{title}</div>
                <div class=" mt-1 d-flex">
                    <span class="menu mr-2">{viewButton}</span> 
                    <span class="menu">{refreshButton}</span>
                </div>
            </div>
            
            {messages}
            
        </div>   
   
    
HTML,
        'main' => [ 
            'mdb' => <<<HTML
        <div id="message">
            <div id="{id}">
                <ul class="list-wrapper d-flex flex-column">
                    {content}  
                </ul>
            </div>
            <div class="text-center p-1" style="background: #f3f3f3">
                <a href="/cores/chat.aspx" class="" target="_blank" data-pjax="0" 
                 style="background: none;">
                {viewAll} <small><i class="text-muted fa fa-angle-double-right "></i></small></a>
            </div>
        </div>
HTML,
        ],
        'badgeType' => '<span class="badge vd_bg-red">{count}</span>',
        'css'=> <<<CSS
           .msg .fa, .msg .far,.msg .fas {
                   font-size: __iconSize__;
           }

           CSS,

        'unread' => [
            'mdb' => <<<HTML
             <li class="d-flex mb-1">
                 <a style="display: none"  target="_self" data-method="post" id="messRefresh"  data-pjax="1"   aria-hidden="true" >             
                 </a>
                 <div class="w- 25">
                     <img alt="example img"
                         src="{photo}"
                         class="img-fluid"
                    >
                 </div>                                  
                 <div class="w-75 pl-3" onclick="eyeRemove(1)">
                    {name} 
                    <p class="text-truncate">{text}</p>
                    <div class="d-flex justify-content-between">
                        <span class="menu-date"> {time} 10.12.20 10:37 </span>
                        <span class="menu-action">
                            <span id="{id}-unread" class="pb-5"
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
                     <div class="menu-icon"><img alt="photo"
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
            railVisible: true,
            allowPageScroll: true,
            touchScrollStep: 1000,
            height:'350',
            width: '250'
        });
           
JS,
    ];


    public $depend = [
        ZMainAsset::class
    ];

    public const type = [
        'mdb' => 'mdb',
        'pro' => 'pro',
    ];


    /* @var MessageItem[] $data */


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');

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
                    'iconColor' => 'white',
                    'icon' => 'fp-13  fa fa-' . FA::_EYE_SLASH,
                ],
                'event' => [
                    'click' => <<<JS
        function () {
         viewAllMessagesAjax('/core/tester/eyeremove/messages.aspx?id=$messageItem->id');
         
    }
JS
                ],
            ]);
            if (strlen($messageItem->text) === 53) {
                $messageItem->text = '<span class="red accent-4">' . Az::l('вы: ') . '</span>' . Az::l('Помахать');
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
                    '{eyeButton}' => $eyeBtn
                ]);

        }

        $badge = count(Az::$app->utility->notify->getMessageItem());

        if ($badge === 0) {
            $badge = 0;
        }

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
                'class' => 'h-100 p-0 noHover',
                'iconColor' => 'white',
                'icon' => 'fp-13     fa fa-' . FA::_SYNC,
            ],

            'id' => 'refreshMessage',


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
                'iconColor' => 'white',
                'icon' => 'fp-13 fa fa-' . FA::_EYE,

            ],
            'event' => [
                'click' => <<<JS
        function () {
        
         viewAll('/core/tester/eyeremove/allmessages.aspx?id=$id');
    }
    
JS
            ],
        ]);

        $viewAll = Az::l('Посмотреть все сообщения');
        $messages = strtr($this->_layout['main'][$this->_config['type']], [
            '{content}' => $content,
            '{id}' => $this->id,
            '{class}' => $this->_config['class'],
            '{viewAll}' => $viewAll

        ]);


        $this->htm = strtr($this->_layout['popover'], [
            '{badge}' => $badge,
            '{refreshButton}' => $refreshButton,
            '{viewButton}' => $viewButton,
            '{icon}' => $this->_config['icon'],
            '{title}' => $this->_config['title'],
            '{messages}' => $messages,
        ]);

        $this->css = strtr($this->_layout['css'],[
            '__iconSize__'=>$this->_config['iconSize']
        ]);



        $this->js = strtr($this->_layout['scroll'], [
            '{id}' => $this->id
        ]);


        $this->js .= ZAjaxWidget::widget([
            'config' => [
                'func' => ' eyeRemoveMessAjax',
                //'url' => '/core/tester/eyeremove/messages.aspx',
            ],
            'event' => [
                'success' => <<<JS
            function (event) {
              //$.pjax.reload({container: '#pjaxId'});
              //  $('#refreshButton').click();
              location.reload();
              setInterval('location.reload()', 5000);
                
            }            
JS,
                'done' => <<<JS
        
        setTimeout(function() {
            $('#refreshMessage').click()
           location.reload(); 
        }, 5)
        
    
JS,

            ],
        ]);

        $this->js .= ZAjaxWidget::widget([
            'config' => [
                'func' => ' viewAllMessagesAjax',
                //'url' => '/core/tester/eyeremove/messages.aspx',
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
    }
}
