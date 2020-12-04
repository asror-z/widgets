<?php


namespace zetsoft\widgets\blocks;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZFooterChatBtnWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'items' => [],
        'grapes' => true,
    ];

    private $chat_user = [
        'icon' => 'fa fa-user',
        'user_name' => 'Jessica',
        'AdminOrUser' => 'Adminstrator',
        'user_img' => '/publish/inputs/avatar-3.jpg'
    ];

    public $layout = [];
    public $_layout = [

        'mainArray' => <<<HTML

<li  
                '>
<a href="#">
<div class="menu-icon"><img src="{item['user_img']}" alt="example image"></div>
<div class="menu-text">{item['user_name']}
<div class="menu-info">
<span class="menu-date">{item['AdminOrUser']} </span>
</div>
</div>
<div class="menu-badge"><span class="badge status vd_bg-green">&nbsp;</span></div>
</a>
</li>

HTML,
        'main' => <<<HTML
<li class="profile mega-li pdlr-15 bordered">
<a class="mega-link" href="http://www.venmond.com/asset/vendroid/index-ecommerce.php#" data-action="click-trigger">
<span class="menu-name">
<i class="fa fa-comments append-icon"></i> Chat
</span>
</a>
<div class="vd_mega-menu-content  width-xs-3  center-xs-3 open-top" data-action="click-target" style="display: none;">
<div class="child-menu">
<div class="content-list  content-image">
<div data-rel="scroll" class="mCustomScrollbar _mCS_13" style="overflow: hidden;"><div class="mCustomScrollBox mCS-light" id="mCSB_13" style="position: relative; height: 100%; overflow: hidden; max-width: 100%; max-height: 400px;"><div class="mCSB_container mCS_no_scrollbar" style="position: relative; top: 0px;">
<ul class="list-wrapper pd-lr-10">
<li>
<a href="http://www.venmond.com/asset/vendroid/index-ecommerce.php#">
<div class="menu-icon"><img src="/publish/inputs/avatar-3.jpg" alt="example image"></div>
<div class="menu-text">Jessylin
<div class="menu-info">
<span class="menu-date">Administrator </span>
</div>
</div>
<div class="menu-badge"><span class="badge status vd_bg-green">&nbsp;</span></div>
</a>
{array}
</li>

</ul>
</div><div class="mCSB_scrollTools" style="position: absolute; display: none;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position:relative;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
</div>
</div>
</div>

</li>
HTML
    ];

    public function codes()
    {
        $array = '';

        foreach ($this->_config['items'] as $key => $item) {

            $item = ZArrayHelper::merge($this->chat_user, $item);

            $array .= strtr($this->_layout["mainArray"], [
                '{item}' => $item
            ]);


        }
        $this->htm = strtr($this->_layout["main"], [
            '{array}' => $array,
             
        ]);


    }
}
