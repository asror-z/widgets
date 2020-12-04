<?php
/**
 *
 *
 * Author:  Otabek Abdumalikov
 *
 *
 */


namespace zetsoft\widgets\themes;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\animo\ZProgressBarWidget;

class ZPendingTasksWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'items' => [],
        'title' => 'Pending task',

    ];

    public const type = [
    ];

    public $event = [];
    public $_event = [

    ];
    public $layout = [];
    public $_layout = [
        'main'=><<<HTML
            <li class="one-big-icon mega-li mgl-10">
                        <a class="mega-link open" href="javascript:void(0);" data-action="click-trigger">
            <span class="mega-icon">
                <i class="fa fa-tasks"></i>
            </span>
                            <span class="badge vd_bg-red">
                8
            </span>
                        </a>
                        <div class="vd_mega-menu-content width-xs-3 width-sm-4 width-md-4 center-xs-4 open-top" data-action="click-target">
                            <div class="child-menu">
                                <div class="title">
                                   {title}
                                    <div class="vd_panel-menu">
                     <span data-original-title="Task Setting" data-toggle="tooltip" data-placement="bottom" class="menu">
                        <i class="fa fa-cog"></i>
                    </span>
                                    </div>
                                </div>
                                <div class="content-list content-image">
                                   <div data-rel="scroll" class="mCustomScrollbar _mCS_2" style="overflow:hidden;">
                                        <div class="mCustomScrollBox mCS-light" id="mCSB_2"
                                            style="position: relative; height: 100%; overflow: scroll; max-width: 100%; max-height: 400px;">
                                            <div class="mCSB_container mCS_no_scrollbar"
                                                style="position: relative; top: 0px;">
                                                <ul class="list-wrapper pd-lr-10">
                                                    <li> <a href="http://www.venmond.com/asset/vendroid/index-ecommerce.php#">
                                                            <div class="menu-icon vd_blue"><i class="fa fa-bolt"></i></div>
                                                            <div class="menu-text"> Electricity Problem
                                                                <div class="menu-info">
                                                                    <div class="progress progress-sm">
                                                                        <div style="width:85%" class="progress-bar progress-bar-info">
                                                                            85%
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a> </li>
                                                    {arrays}
    
                                                </ul>
                                            </div><div class="mCSB_scrollTools" style="position: absolute; display: block; opacity: 0;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; top: 0px; height: 364px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position: relative; line-height: 364px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
                                    <div class="closing text-center" style="">
                                        <a href="http://www.venmond.com/asset/vendroid/index-ecommerce.php#">See All Tasks <i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div> <!-- child-menu -->
                        </div>   <!-- vd_mega-menu-content -->
                    </li>
HTML

    ];
    private $pending_item = [
        'icon' => 'fa fa-bolt',
        'text' => 'CPU problem',
        'progressWidth' => '75'
    ];
    public function codes()
    {
        $array = '';
        foreach ($this->_config['items'] as $key => $item) {

            $item = ZArrayHelper::merge($this->pending_item, $item);

            $array .= <<<HTML
             <li> 
                <a href="#">
                    <div class="menu-icon vd_blue"><i class="{$item['icon']}"></i></div>
                    <div class="menu-text">{$item['text']}
                        <div class="menu-info">
                           <div class="progress progress-sm">
                               <div style="width:{$item['progressWidth']}%" class="progress-bar progress-bar-info">
                                                {$item['progressWidth']}%
                               </div>
                        </div>
                    </div>
                </a> 
             </li>

HTML;
        }
    
        $this->htm .= strtr($this->_layout['main'], [
        '{arrays}'=>$array
        ]);

        $this->htm = strtr($this->htm, [
            '{title}' => $this->jscode($this->_config['title']),

        ]);
    }

}
