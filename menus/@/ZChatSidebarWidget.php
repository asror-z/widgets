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

namespace zetsoft\widgets\menus;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZChatSidebarWidget extends ZWidget

{
    public $config = [];
    public $_config = [

            'url' => '/publish/inputs/user-inputs/demo_files/avatar-2.jpg',
            'AdminOrUser' => 'Adminstrator',
            'BgColor' => ZChatSidebarWidget::BgColor['bg-danger'],
            'TextColor' => ZChatSidebarWidget::TextColor['text-dark'],
            'name' => 'John Wick'
     
    ];

    public const BgColor = [

        'bg-primary' => 'bg-primary',
        'bg-secondary' => 'bg-secondary',
        'bg-success' => 'bg-success',
        'bg-danger' => 'bg-danger',
        'bg-warning' => 'bg-warning',
        'bg-info' => 'bg-info',
        'bg-light' => 'bg-light',
        'bg-dark' => 'bg-dark',
        'bg-link' => 'bg-link',
        'peach-gradient' => 'peach-gradient',
        'purple-gradient' => 'purple-gradient',
        'blue-gradient' => 'blue-gradient',
        'aqua-gradient' => 'aqua-gradient',
        'bg-outline-primary' => 'bg-outline-primary waves-effect',
        'bg-outline-secondary' => 'bg-outline-secondary waves-effect',
        'bg-outline-success' => 'bg-outline-success waves-effect',
        'bg-outline-danger' => 'bg-outline-danger waves-effect',
        'bg-outline-warning' => 'bg-outline-warning waves-effect',
        'bg-outline-info' => 'bg-outline-info waves-effect',
        'bg-outline-light' => 'bg-outline-light waves-effect',
        'bg-outline-dark' => 'bg-outline-dark waves-effect',
        'bg-outline-link' => 'bg-outline-link waves-effect',

    ];

    public const TextColor = [

        'text-primary' => 'text-primary',
        'text-secondary' => 'text-secondary',
        'text-success' => 'text-success',
        'text-danger' => 'text-danger',
        'text-warning' => 'text-warning',
        'text-info' => 'text-info',
        'text-light' => 'text-light',
        'text-dark' => 'text-dark',
        'text-link' => 'text-link',
        'text-muted' => 'text-muted',
        'text-white' => 'text-white ',

    ];
      public $layout = [];
      public $_layout = [

          'main' => <<<HTML
            <div class="vd_navbar vd_nav-width vd_navbar-chat vd_bg-black-80 vd_navbar-right vd_navbar_tyop" 
            
            
      ' class="input-group clockpicker {readonly}">
      
            style="margin-top: 85px; z-index:1!important;background: #fff!important;border: 2px solid #2c3e50;">
            <div class="navbar-tabs-menu clearfix">
			<span class="expand-menu" data-action="expand-navbar-tabs-menu">
            	<span class="menu-icon menu-icon-left">
            		<i class="fa fa-ellipsis-h"></i>
                    <span class="badge vd_bg-red">
                        20
                    </span>
                </span>
            	<span class="menu-icon menu-icon-right">
            		<i class="fa fa-ellipsis-h"></i>
                    <span class="badge vd_bg-red">
                        20
                    </span>
                </span>
            </span>
                <div class="menu-container">
                    <div class="navbar-search-wrapper">
                        <div class="navbar-search vd_bg-blue-30">
                            <span class="append-icon"><i class="fa fa-search"></i></span>
                            <input type="text" placeholder="Search"
                                   class="vd_menu-search-text no-bg no-bd vd_white width-70" name="search" style="outline: none!important;">
                            <div class="pull-right search-config">
                                <a data-toggle="dropdown" href="javascript:void(0);" class="dropdown-toggle"><span class="prepend-icon vd_grey"><i class="fa fa-cog"></i></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="#">Action</a>
                                    </li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="navbar-menu clearfix" style="background: #ffff;">
                <div class="content-list content-image content-chat">
                    <ul class="list-wrapper no-bd-btm pd-lr-10">
                        <li>
                            <a href="#">
                                <div class="menu-icon"><img src="/publish/inputs/user-inputs/demo_files/avatar-2.jpg" alt="example image"></div>
                                <div class="menu-text">Jessylin
                                    <div class="menu-info">
                                        <span class="menu-date">Administrator </span>
                                    </div>
                                </div>
                                <div class="menu-badge"><span class="badge status vd_bg-green">&nbsp;</span></div>
                            </a>
                        </li>
                        {item}
                </ul>
                </div>
            </div>
            <div class="navbar-spacing clearfix">
            </div>
        </div>


    </div>

</div>   
HTML,
          'item' => <<<HTML
            <li>
                <a href="#">
                    <div class="menu-icon"><img src="{url}" alt="example image"></div>
                    <div class="menu-text {AdminOrUser}">
                        {BgColor}
                        <div class="menu-info">
                            <span class="menu-date">{TextColor}</span>
                        </div>
                    </div>
                    <div class="menu-badge"><span class="badge status {name}">&nbsp;</span></div>
                </a>
            </li>
HTML,

      ];


    public function codes()
    {


        $item = '';
        $item .= strtr($this->_layout['item'], [
            '{url}' => $this->_config['url'],
            '{AdminOrUser}' => $this->_config['AdminOrUser'],
            '{BgColor}' => $this->_config['BgColor'],
            '{TextColor}' => $this->_config['TextColor'],
            '{name}' => $this->_config['name'],

        ]);


        $this->htm = strtr($this->_layout['main'], [
            '{main}' => $item,
        ]
        );

        $this->htm = strtr($this->htm, [
            '{url}' => $this->_config['url'],
            '{AdminOrUser}' => $this->_config['AdminOrUser'],
            '{BgColor}' => $this->_config['BgColor'],
            '{TextColor}' => $this->_config['TextColor'],
            '{name}' => $this->_config['name'],

        ]);


        }




}

