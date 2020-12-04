<?php


namespace zetsoft\widgets\blocks;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\themes\ZOnlineUsersWidget;
use zetsoft\widgets\themes\ZPendingTasksWidget;
use zetsoft\widgets\themes\ZServerStatusWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;

class ZFooterBar extends ZWidget
{

    public $config = [];
    public $_config = [
        'isSticky' => false
    ];

    public $layout = [];
    public $_layout = [

     'main' =>   <<<HTML

            <div class="vd_chat-menu hidden-xs">
                    <div class="vd_mega-menu-wrapper">
                        <div class="vd_mega-menu">
                            <ul class="mega-ul">
                                {pendingBtn}
                                {useronlineBtn}
                                {chatBtn}
                                <li class="profile border-left mega-li">
                                    <a class="mega-link pd-10" href="" data-action="chat-close">
                                        <span class="mega-icon">
                                            <i class="fa fa-sign-out"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                         </div>
                    </div>
               </div>
             
HTML,
     'cssIf'=> <<<CSS
       .vd_chat-menu {
                    position: fixed;
                    right: 0;
                    bottom: 25%;
                }
                html{
                    overflow-x: hidden;
                }
CSS,

       'cssElse'=><<<CSS
         html{
                    overflow-x: hidden;
                }
                .vd_chat-menu{
                    position: fixed;
                    right: -250px;
                    bottom: 25%;
                    transition: .3s linear;
                    -o-transition: .3s linear;
                    -moz-transition: .3s linear;
                    -webkit-transition: .3s linear;
                    z-index: 1000;  
                }
                .vd_chat-menu:hover{
                    right: 0;
                }
CSS,


    ];

    public function codes()
    {
        $serverBtn = ZServerStatusWidget::widget([

        ]);
        $pendingBtn = ZPendingTasksWidget::widget([
            'config' => [
                'items' => [
                    [
                        'text' => 'CPU problem',
                        'progressWidth' => '80'
                    ]
                ]
            ]
        ]);
        $useronlineBtn = ZOnlineUsersWidget::widget([
            'config' => [
                'name' => 'Adelaida',
                'OnlineOrOffline' => 'online'
            ]
        ]);
//        $chatBtn = ZFooterChatBtnWidget::widget([
//            'config' => [
//                'items' => [
//                    [
//                        'user_name' => 'Alisun Jalis',
//                    ]
//                ]
//            ]
//        ]);


            $this->js = <<<JS

JS;
//             $this->css = <<<CSS
//             .vd_chat-menu{
//                 position: fixed;
//                 right: -262px;
//                 bottom: 25%;
//                 transition: .3s linear;
//                 -o-transition: .3s linear;
//                 -moz-transition: .3s linear;
//                 -webkit-transition: .3s linear;
//                 z-index: 1000;  
//             }
//             .vd_chat-menu:hover{
//                 right: 0;
//             }
//             html{
//                  overflow-x: hidden;
//             }
//             @media screen and (max-width: 680px){
//                 .vd-chat-menu{
//                 bottom: 10%;
//                 }
//             }
//             @media screen and (max-width: 370px){
//                 .vd-chat-menu{
//                 margin-bottom: 3%;
//                 }
//             }
// CSS;
         if ($this->_config['isSticky']) {
            $this->css =  strtr($this->_layout['cssIf'],[]);
         }
         else {
             $this->css =  strtr($this->_layout['cssElse'],[]);
         }

         $this->htm = strtr($this->_layout['main'],[
           '{pendingBtn}' => $pendingBtn,
         //  '{chatBtn}' => $chatBtn,
           '{useronlineBtn}' => $useronlineBtn,


         ]);
    }

}
