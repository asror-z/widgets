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
use zetsoft\dbitem\ALL\ZFriendItem;
use zetsoft\models\ALL\CoreFriend;
use zetsoft\models\ALL\CoreUser;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\pjax\ZJqueryPjaxWidget;
use zetsoft\widgets\pjax\ZPjaxWidget;

class ZFriendRequestsEyufWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $isRead = false;
    public $config = [];
    public $_config = [
        'type'=> self::type['facebook'],
        'title' => 'message',
        'viewButtonTitle' => ''
    ];

    public const type = [
        'mdb' => 'mdb',
        'facebook' => 'facebook',
    ];

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [
        'popover' => <<<HTML
       
     <li class="one-icon mega-li">
    <button id="myDropdown" class="btn mega-link dropdown-toggle" data-toggle="dropdown">
                    <span class="mega-icon vend-icon-color"><i class="{icon}"></i></span>
                    <span class="badge vd_bg-red">{badge}</span>
                </button>
    
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
            
            {friends}
            
        </div> <!-- child-menu -->
    </div>   <!-- vd_mega-menu-content -->
   
   
    </li>
   

    
HTML,

        'friendAll' =>[
            'mdb'=><<<HTML
                            <div class="child-menu" id="friend">
                            <div id="{id}"  class="content-grid column-xs-2 column-sm-3 height-xs-4">
                            <ul class="list-wrapper">
                                {content}
                            </ul>
                            </div>
                                <!--<div class="closing text-center">
                                    <a href="/cores/user/index.aspx" id="frReq">Посмотреть все запросы
                                        <i class="fa fa-angle-double-right"></i></a>
                                        
                                </div>-->
                        </div> 
HTML,

            'facebook' => <<<HTML
        <div class="child-menu">
                            <div class="content-list content-image">
                                    <div id="{id}" class="mCustomScrollbar _mCS_2" style="overflow:hidden;">
                                        <ul class="list-wrapper pd-lr-10">
                                        {content}  
                                        </ul>
                                    </div>
                                      <!--<div class="closing text-center" style="">
                                                            <a href="/cores/user/index.aspx" data-pjax="0">
                                                            {viewAll} <i class="fa fa-angle-double-right"></i></a>
                                     </div>-->
                                </div>
                                
                                
                                
                            </div>
HTML,


        ],

        'friendHtm' =>[
            'mdb'=><<<HTML
           <li class="px-1 friend-li" data-action="click-target">
               <a href="#">
                   <div class="menu-icon">
                        <img class="img-fluid img-1"  style="width: 60px; height: 60px" alt="userimage" src="{imgSrc}">
                   </div>
               </a>
                   <div class="menu-text"> {name}
                      <div class="menu-info">
                         <div class="menu-date"></div>
                         <div class="menu-action">
                            <span id="{id}-required" class="menu-action-icon vd_green vd_bd-green" data-original-title="Approve" data-toggle="tooltip" data-placement="bottom">
                                 <i class="fa fa-check"></i>
                            </span>
                            <span id="{id}-notrequired" class="menu-action-icon vd_red vd_bd-red" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom">
                               <i class="fa fa-times"></i>
                            </span>
                         </div>
                      </div>
                   </div>
            </li>   
HTML,
            'facebook' => <<<HTML
        <li class="friend-li">
        <div class="d-flex align-items-center ">
          <img class="img-1" src="{imgSrc}" alt="atl" class="friend-img">
          <div class="d-flex flex-column align-items-center">
            <div class="d-flex justify-content-between w-100">
            <div><p class="font-weight-bold">{name}</p></div>
            <div class="time">{time}</div>
            </div>
           <div class="d-flex justify-content-end">
           {accept}
           {remove}
           </div>
           </div>
        </div>
      </li>
HTML,

        ],
        'css'=><<<CSS

            .border-bg{
            border: 2px solid #0D47A1 !important;
            }
            
            .sx
            {
            display: inline-block !important;
             padding: 0 !important;
             padding-top: 10px !important;
     
            }
             
             .closing{
                font-size: 16px; 
             }
             

             .friend-li{
                background: #eeeeee;
                border-bottom: 1px solid #dddddd !important;
                cursor: pointer;
             }
     
     
      .friend-img{
        margin: 0 auto;
        grid-area: img;
        border-radius: 50%;
        /*max-width: 2rem;*/
        width: 6rem;
        /*min-width: 50%;*/
      }
      .full-name{
        text-transform: capitalize;
        grid-area: fullName;
        font-size: 1.5rem;
      }
      .time {
        grid-area: time;
        text-align: right;
      }

CSS,

        'js' => <<<JS
           $('#{id}').slimscroll({
        width: '',
        railVisible: true,
        allowPageScroll: true,
        touchScrollStep: 1000,
        height: '320',
    });  
    

JS,


    ];


    public function asset()
    {
       $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');

    }



    public function codes()
    {

        $content= '';

        $this->data = Az::$app->utility->notify->getFriendItem();


        //vdd($this->data);
        foreach ($this->data as $messageItem) {

            $accept = ZButtonWidget::widget([
                'config' => [
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnStyle' => ZButtonWidget::btnStyle['btn-info'],
                    'btnRounded' => false,
                    'pjax' => 0,
                    'text' => Az::l('Принять'),
                    'ttSize' => ZButtonWidget::ttSize['small'],
                    'ttSide' => ZButtonWidget::ttSide['bottom'],

                ],
                'event' => [
                    'click' => <<<JS
        function (e) {
        
         acceptFriendAjax('/tester/eyeremove/accept.aspx?id=$messageItem->id');
         
         e.stopPropagation();
         
    }
    
JS
                ],
            ]);

            $remove = ZButtonWidget::widget([
                'config' => [
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
                    'btnRounded' => false,
                    'pjax' => 0,
                    'text' => Az::l('Удалить'),
                    'ttSize' => ZButtonWidget::ttSize['small'],
                    'ttSide' => ZButtonWidget::ttSide['bottom'],
                ],
                'event' => [
                    'click' => <<<JS
        function (e) {
         removeFriendfAjax('/tester/eyeremove/removefriend.aspx?id=$messageItem->id');
         e.stopPropagation();

    }
    
JS
                ],
            ]);


            $content .= strtr($this->_layout['friendHtm'][$this->_config['type']], [
                '{imgSrc}' => $messageItem->photo,
                '{name}' => $messageItem->person,
                '{remove}' => $remove,
                '{accept}' => $accept,
                '{time}' => $messageItem->time


            ]);
        }

        $id = $this->userIdentity()->id;
        $viewAllF = Az::l('Посмотреть все уведомления');
        $friends = strtr($this->_layout['friendAll'][$this->_config['type']], [
            '{content}' => $content,
            '{id}' => $this->id,
            '{viewAll}' => $viewAllF,
        ]);
        $badge = Az::$app->utility->notify->getFriendBadge();

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
            'id' => 'refreshFriend'
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
                'icon' => 'fas fa-' . FA::_USER_CHECK,

            ],

            'event' => [
                'click' => <<<JS
        function () {
         acceptAllAjax('/tester/eyeremove/acceptall.aspx?id=$id');
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
            '{friends}' => $friends
        ]);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id
        ]);

        $this->css=strtr($this->_layout['css'],[
        ]);

        $this->htm .= ZAjaxWidget::widget([
            'config' => [
                'func' => ' acceptFriendAjax',
            ],
            'event' => [
                'complete' => <<<JS
            function (event) {
                  
                  
            }
JS,
                'done' => <<<JS
        
        setTimeout(function() {
            $('#refreshFriend').click()
        
        }, 5)
        
    
JS,

            ],

        ]);

        $this->htm .= ZAjaxWidget::widget([
            'config' => [
                'func' => ' removeFriendfAjax',
            ],
            'event' => [
                'complete' => <<<JS
            function (event) {
                  
                  
            }
JS,
                'done' => <<<JS
        
        setTimeout(function() {
            $('#refreshFriend').click()
        
        }, 5)
        
    
JS,

            ],

        ]);
        $this->htm .= ZAjaxWidget::widget([
            'config' => [
                'func' => ' acceptAllAjax',
            ],

            'event' => [
                'done' => <<<JS
        
        setTimeout(function() {
            $('#refreshFriend').click()
        
        }, 5)
        
    
JS,
            ]

        ]);


    }

}

