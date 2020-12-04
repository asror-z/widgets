<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\themes;


use rmrevin\yii\fontawesome\FA;
use zetsoft\assets\theme\ZMainAsset;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


class ZNotificationWidget extends ZWidget
{
    public $data = [
        '0' => [
            'text' => 'Change your profile details',
            'icon' => 'fa fa-user',
            'times' => '1 hour 2 min',
            'moreInfo' => 'The best and most beautiful things in the world cannot be seen or even touched-they must be felt with the heart.'
        ],
        '1' => [
            'text' => 'Change your profile details2',
            'icon' => 'fa fa-home',
            'times' => '1 hour 2 min',
            'moreInfo' => 'Мамасолиев Фаррух Ғуломжон ўғли 1  -курс DR-3 гуруҳ талабаси
             Очилов Комил Қобил ўғли 1  -курс TV-729B гуруҳ талабаси'
        ],

        '2' => [
            'text' => 'Change your profdddile details',
            'icon' => 'fa fa-car',
            'times' => ' min',
            'moreInfo' => 'Худойбердиев Дониёр Эгамназар ўғли 2018/2019 ўқув йили MN-51-a гуруҳ битирувчиси'
        ],
    ];
    public $config = [];
    public $_config = [
        'times' => '3 hour 2 min',
        'moreInfo' => 'The best and most beautiful things in the world cannot be seen or even touched-they must be felt with the heart.'
    ];


    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                   <div class="vd_mega-menu-wrapper">
                 <div class="vd_mega-menu pull-right" style="float:right;!important;">
                  <ul class="mega-ul">
                             <li id="top-menu-3" class="one-icon mega-li">
                                <a href="#" class="mega-link dropdown-toggle" data-toggle="dropdown" data-action="click-trigger">
                               <span class="mega-icon "><i class="fa fa-globe" style="padding-left:3px;"></i></span>
                                         {badge}
                              </a>
                                     
                     <div class="vd_mega-menu-content  width-xs-3 width-sm-4  center-xs-3 left-sm dropdown-menu"
                                                 >
                 <div class="child-menu">
                   <div class="title"> Notifications
                       <div class="vd_panel-menu">
                           <span data-original-title="Notification Setting" data-toggle="tooltip" data-placement="bottom" class="menu">
                                                                
                                                                <!--<a href="#"><i class="fa fa-refresh"></i></a>-->
                               {button}       
                           </span>
                            <span >{buttonCog}</span>
                                          </div>
                                   </div>
                        <div class="content-list">
                              <div data-rel="scroll" class="mCustomScrollbar _mCS_3" style="overflow: hidden;">
                                  <div class="mCustomScrollBox mCS-light" id="mCSB_3"
                                                            style="position: relative; height: 100%; overflow: scroll; max-width: 100%; max-height: 400px;">
                                       <div class="mCSB_container mCS_no_scrollbar" style="position: relative; top: 0px;">
                                         <ul class="list-wrapper pd-lr-10">
                                                                {item}
                                             </ul>
                                                 </div>
                                                        <div class="mCSB_scrollTools" style="position: absolute; display: none;">
                                                                    <div class="mCSB_draggerContainer">
                                                                        <div class="mCSB_dragger" style="position: absolute; top: 0px;"  oncontextmenu="return false;">
                                                                            <div class="mCSB_dragger_bar"
                                                                                 style="position:relative;"></div>
                                                                        </div>
                                                                        <div class="mCSB_draggerRail"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                <div class="closing text-center" style="">
                    <a href="http://www.venmond.com/asset/vendroid/pages-user-profile.php#"> See All Notifications <i class="fafa-angle-double-right"></i>
                                                            </a>
                                                        </div>
                                                        
                                                    </div>
                                                </div> 
                                            </div> 
                                        </li>
                              </ul>           
                            </div>
                            </div>
HTML,
        'badgeType' => '<span class="badge vd_bg-red">{count}</span>',
        'item' => <<<HTML
         <li>
        <a href="{url}" >
            <div class="menu-icon vd_yellow remove"><i class="{icon}"></i>            
            </div>
            <div class="menu-text remove" ">{text}<div class="menu-info"><span class="menu-date">{time} Ago</span>
                </div> <br>
                <div><span>{moreInfo}</span></div>
            </div> 
            </a>             
       <span class="float-right delete-btn" data-original-title="Delete this file" style="cursor: pointer"><i class="far fa-times-circle" style=""></i></span>
        </li>
HTML,

    ];


    public $depend = [
        ZMainAsset::class
    ];

    public function init()
    {
        parent::init();

        }

    public function codes()
    {
        $button = ZButtonWidget::widget([
            'config' => [
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'icon' => FA::_SYNC,
                'url' => ZUrl::current(),
                'isSocial' => true
            ],
            'id' => 'notifyPjax',
        ]);
        $buttonCog = ZButtonWidget::widget([
            'config' => [
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'icon' => FA::_COG,
                'url' => ZUrl::current(),
                'isSocial' => true
            ]

        ]);

        $item = '';
        foreach ($this->data as $notItem) {
            $item .= strtr($this->_layout['item'], [
                '{text}' => $notItem['text'],
                '{url}' => '#',
                '{icon}' => $notItem['icon'],
                '{time}' => $this->_config['times'],
                '{moreInfo}' => $this->_config['moreInfo'],


            ]);

        }

        $badge = '';

        if ($this->_config['badge'] > 0)
            $badge = strtr($this->_layout['badge'], [
                '{count}' => $this->_config['badge'],
            ]);
         if($this->_config['visible']) {
             $this->htm = strtr($this->_layout['main'], [
                 '{item}' => $item,
                 '{button}' => $button,
                 '{buttonCog}' => $buttonCog,
                 '{badge}' => $badge,
             ]);
         }


        $this->css = <<<CSS
        ::before{
            margin-right: 5px !important;
        }
        
        
        .delete-btn:hover {
        color: red;
        }
        .vd_panel-menu {
        width: 50px;
        }
        
        
CSS;

    }
}
