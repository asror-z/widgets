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

class ZServerStatusWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
     //  'type' => ZCardWidget::type['dynCard'],
        'items' => [],

    ];

    public const type = [
    'dynCard' => 'dynCard',
    'mdbCard' => 'mdbCard',
    'newsCard' => 'newsCard',
    'venCard' => 'venCard'
    ];

    public $event = [];
    public $_event = [

    ];

    private $server_item = [
        'icon' => 'fa fa-bolt',
        'title' => 'Pending task',
        'OnlineOrOffline' => 'online',
        'text' => 'CPU problem',
        'progressWidth' => '75'

    ];


    public $layout = [];
    public $_layout = [
        'main'=><<<HTML

   <li class="one-icon mega-li mgl-10">
      <a class="mega-link vd_bg-green" href="javascript:void(0);" data-action="click-trigger">
            <span class="mega-icon">
                <i class="fa fa-cloud"></i>
            </span>
            <span class="badge vd_bg-red">
                10
            </span>
      </a>
      <div class="vd_mega-menu-content width-xs-3 width-sm-5 width-md-6  center-xs-6 open-top" data-action="click-target" style="display: none;">
        <div class="child-menu">
           <div class="title">
           	   Server Status
               <div class="vd_panel-menu">
                     <span data-original-title="Find Server" data-toggle="tooltip" data-placement="bottom" class="menu">
                        <i class="fa fa-search"></i>
                    </span>
                     <span data-original-title="Message Setting" data-toggle="tooltip" data-placement="bottom" class="menu">
                        <i class="fa fa-cog"></i>
                    </span>
                </div>
           </div>
		   <div class="content-grid column-md-3 column-sm-2 column-xs-1 height-xs-auto height-sm-4">
           <div data-rel="scroll" class="mCustomScrollbar _mCS_9" style="overflow: hidden;"><div class="mCustomScrollBox mCS-light" id="mCSB_9" style="position: relative; height: 100%; overflow: hidden; max-width: 100%; max-height: 400px;"><div class="mCSB_container mCS_no_scrollbar" style="position: relative; top: 0px;">
               <ul class="list-wrapper">
                    <li><a>
           		            <div class="menu-icon">
                				<i class="fa fa-cloud"></i>
           				    </div>
                            <div class="menu-text"> Venmond.com
                            	<div class="menu-info">
                                    <span class="menu-date vd_bg-green badge">Online</span>
                                    <div class="menu-status  text-left">
                                    	<span class="text">Disk Usage</span>
                                        <span class="value pull-right vd_black">4.35/140 GB</span>
                                    </div>
                                    <div class="menu-info">
                                        <div class="progress">
                                            <div style="width:15%" class="progress-bar progress-bar-info">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-status  text-left">
                                    	<span class="text">BW Usage</span>
                                        <span class="value pull-right vd_black">1600/2500 GB</span>
                                    </div>
                                    <div class="menu-info">
                                        <div class="progress">
                                            <div style="width:65%" class="progress-bar  progress-bar-warning">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="menu-action">
                                        <span class="menu-action-icon vd_green vd_bd-green" data-original-title="Reboot Server" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                        <span class="menu-action-icon vd_red vd_bd-red" data-original-title="Stop Server" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fa fa-stop"></i>
                                        </span>
                                    </span>
                            	</div>
                            </div>
                    </a></li>
                   
               </ul>
               </div><div class="mCSB_scrollTools" style="position: absolute; opacity: 0; display: none;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; height: 314px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position: relative; line-height: 314px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div> <!-- data-rel="scroll" -->
               <div class="closing text-center" style="">
               		<a href="http://www.venmond.com/asset/vendroid/index-ecommerce.php#">See All Requests <i class="fa fa-angle-double-right"></i></a>
               </div>
           </div>
        </div> <!-- child-menu -->
      </div>   <!-- vd_mega-menu-content -->
    </li>


HTML
    ];
    

    public function codes()
    {
        $array = '';

        foreach ($this->_config['items'] as $key => $item) {

            $item = ZArrayHelper::merge($this->server_item, $item);

            $array .= <<<HTML
              <li><a>
           		            <div class="menu-icon">
                				<i class="fa fa-cloud"></i>
           				    </div>
                            <div class="menu-text"> {$item['title']}
                            	<div class="menu-info">
                                    <span class="menu-date vd_bg-green badge">{$item['OnlineOrOffline']}</span>
                                    <div class="menu-status  text-left">
                                    	<span class="text">Disk Usage</span>
                                        <span class="value pull-right vd_black">4.35/140 GB</span>
                                    </div>
                                    <div class="menu-info">
                                        <div class="progress">
                                            <div style="width:15%" class="progress-bar progress-bar-info">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-status  text-left">
                                    	<span class="text">BW Usage</span>
                                        <span class="value pull-right vd_black">1600/2500 GB</span>
                                    </div>
                                    <div class="menu-info">
                                        <div class="progress">
                                            <div style="width:65%" class="progress-bar  progress-bar-warning">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="menu-action">
                                        <span class="menu-action-icon vd_green vd_bd-green" data-original-title="Reboot Server" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                        <span class="menu-action-icon vd_red vd_bd-red" data-original-title="Stop Server" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fa fa-stop"></i>
                                        </span>
                                    </span>
                            	</div>
                            </div>
                    </a></li>
HTML;
        }




        $this->js = <<<JS
   
JS;




        $this->css = <<<CSS
       .mega-ul {
        margin-right:200px
      
       }
CSS;


    }

}
