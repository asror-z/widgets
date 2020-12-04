<?php

/**
 * @author LobarOrifova ft. MurodovMirbosit
 */

namespace zetsoft\widgets\inputes;

use zetsoft\dbitem\data\ButtonItem;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZFloatButtonWidget
 * @package widgets\inputes
 *
 */
class ZFloatButtonWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'childClass' => '',
        'parentClass' => '',
        'parentIcon' => 'fa fa-share',
    ];
    public $event = [];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="container">
<!--Parent-->
<a href="#" class="float {parentClass}" id="{id}-menu-share">
    <i class="{parent-icon} my-float"></i>
</a>
<!--Childs-->
<ul class="childs-ul {childClass}">
    {child}
</ul>
</div>
HTML,
        'childs' => <<<HTML
    <li class="childs-li">
       <a href="{href}" class="{childAclass}">
           <i class="{childs-icon} my-float"></i>
           <img src="{src}" class="{childImg}">  
       </a>
    </li>
HTML,
        'css' => <<<CSS
.float{
	position:fixed;
	width:30px;
	height:30px;
	bottom:30px;
	right:200px;
	background-color:#cccccc;
	color:#000000;
	border-radius:50px;
	text-align:center;
	z-index:1000;
	animation: bot-to-top 2s ease-out;
}
.childs-ul{
	position:fixed;
	right:177px;
	margin-bottom: 30px;
	bottom:30px;
	z-index:100;
}
.childs-ul li{
	list-style:none;
	margin-bottom:0px;
	animation: my 1s ease-out;
}
.childs-ul li a{
	width:60px;
	height:40px;
	display:block;
}
.childs-ul:hover{
	visibility:visible!important;
	opacity:1!important;
}
.my-float{
	font-size:14px;
	margin-top:10px;
}
#{id}-menu-share + ul{
  visibility: hidden;
}
#{id}-menu-share:hover + ul{
  visibility: visible;
  animation: scale-in 0.5s;
}
#{id}-menu-share i{
	animation: rotate-in 0.5s;
}
#{id}-menu-share:hover > i{
	animation: rotate-out 0.5s;
}
@keyframes bot-to-top {
    0%   {bottom:-40px}
    50%  {bottom:40px}
}
@keyframes scale-in {
    from {transform: scale(0);opacity: 0;}
    to {transform: scale(1);opacity: 1;}
}
@keyframes rotate-in {
    from {transform: rotate(0deg);}
    to {transform: rotate(360deg);}
}
@keyframes rotate-out {
    from {transform: rotate(360deg);}
    to {transform: rotate(0deg);}
}
CSS,
    ];
    public function asset()
    {
        $this->fileCss('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
    }
    public function codes()
    {
        /** @var ButtonItem $value */
        $content = '';
        foreach ($this->data as $key => $value) {
            $content .= strtr($this->_layout['childs'], [
                '{childs-icon}' => $value->icon,
                '{href}' => $value->url,
                '{childAclass}' => $value->childAclass,
                '{childImg}' => $value->imgClass,
                '{src}' => $value->src,
            ]);
        }
        $this->htm .= strtr($this->_layout['main'], [
            '{parentClass}' => $this->_config['parentClass'],
            '{id}' => $this->id,
            '{childClass}' => $this->_config['childClass'],
            '{child}' => $content,
            '{parent-icon}' => $this->_config['parentIcon']
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{id}' => $this->id,
        ]);
    }
}

