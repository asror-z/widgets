<?php
/**
 *
 *
 * Author:  Zoxidjon Ergashev
 *
 *
 */


namespace zetsoft\widgets\themes;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZOnlineUsersWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'name' => 'Lara Croft',
        'OnlineOrOffline' => 'online',
        'items' => [],
        'type' => ZAddEditorWidget::type['main'],
    ];

    public const type = [
        'main' => 'main'

    ];

    public $layout = [];
    public $_layout = [
    
        'main' => <<<HTML

                <li class="one-big-icon mega-li mgl-10">
                        <a href="http://www.venmond.com/asset/vendroid/index_product.php" class="mega-link" data-action="click-trigger">
                            <span class="mega-icon"><img alt="example image" src="/publish/inputs/user-inputs/demo_files/avatar.jpg"></span>
                            <span class="badge vd_bg-red">10</span>
                        </a>
                        <div class="vd_mega-menu-content  open-top width-xs-4 width-md-5 width-lg-4 center-xs-4" data-action="click-target" style="display: none;">
                            <div class="child-menu">
                                <div class="title">
                                    {name} <i>{OnlineOrOffline}</i>
                                    <div class="vd_panel-menu">
                                        <div data-rel="tooltip" data-original-title="Make a Call" class="menu entypo-icon smaller-font">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div data-rel="tooltip" data-original-title="Video Call" class="menu">
                                            <i class="fa fa-video-camera"></i>
                                        </div>
                                        <div data-rel="tooltip" data-original-title="Message Setting" class="menu smaller-font entypo-icon">
                                            <i class="fas fa-cog"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="content-list content-image content-menu">
                                    <div data-rel="scroll" class="mCustomScrollbar _mCS_11" style="overflow: hidden;"><div class="mCustomScrollBox mCS-light" id="mCSB_11" style="position: relative; height: 100%; overflow: hidden; max-width: 100%; max-height: 400px;"><div class="mCSB_container mCS_no_scrollbar" style="position: relative; top: 0px;">
                                                <ul class="list-wrapper pd-lr-10">
                                                    <li> <a href="http://www.venmond.com/asset/vendroid/index-ecommerce.php#">
                                                            <div class="menu-icon"><img alt="example image" src="/publish/inputs/user-inputs/demo_files/avatar.jpg"></div>
                                                            <div class="menu-text"> Do you play or follow any sports?
                                                                <div class="menu-info">
                                                                    <span class="menu-date">12 Minutes Ago </span>
                                                                </div>
                                                            </div>
                                                        </a> </li>
                                                    <li class="align-right"> <a href="http://www.venmond.com/asset/vendroid/index-ecommerce.php#">
                                                            <div class="menu-icon"><img alt="example image" src="/publish/inputs/user-inputs/demo_files/avatar-2.jpg"></div>
                                                            <div class="menu-text">  Good job mate !
                                                                <div class="menu-info">
                                                                    <span class="menu-date">1 Hour 20 Minutes Ago </span>

                                                                </div>
                                                            </div>
                                                        </a> </li>
                                               
                                                </ul>
                                            </div><div class="mCSB_scrollTools" style="position: absolute; opacity: 0; display: none;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; height: 346px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position: relative; line-height: 346px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
                                    <div class="closing chat-area">
                                        <div class="chat-box">
                                            <input type="text" placeholder="chat here..">
                                        </div>
                                        <div class="vd_panel-menu">
                                            <div data-rel="tooltip" data-original-title="Insert Picture" class="menu">
                                                <i class="icon-camera"></i>
                                            </div>
                                            <div data-rel="tooltip" data-original-title="Emoticons" class="menu">
                                                <i class="fa fa-smile-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- child-menu -->
                        </div>   <!-- vd_mega-menu-content -->
                    </li>
              
HTML
    ];


    public $event = [];
    public $_event = [

    ];
    

    public function codes()
    {




        if($this->_config['visible'])
            $this->htm = $this->_layout[$this->_config['type']];

            $this->js = <<<JS
   
JS;


            $this->css = <<<CSS
               
           .fa-gear:before, .fa-cog:before {
           content: "";
           }
           :before, :after {
           -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
           box-sizing: border-box;
           }
           
CSS;
        $this->htm = strtr($this->htm, [
            '{name}' => $this->jscode($this->_config['name']),
            '{OnlineOrOffline}' => $this->jscode($this->_config['OnlineOrOffline'])
        ]);

        }


}
