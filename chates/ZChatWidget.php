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

namespace zetsoft\widgets\chates;


use zetsoft\system\kernels\ZWidget;

class ZChatWidget  extends ZWidget
{
    public $config = [];
    public $_config = [
       'usermess'=>ZUserMessageWidget::type['mdb'],
      // 'userslist'=>ZChatWidget::type['userlist'],
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="card rare-wind-gradient chat-room">
  
</div>
HTML,
        'style' => <<<CSS
.card.chat-room .members-panel-1,
.card.chat-room .chat-1 {
position: relative;
overflow-y: scroll; }

.card.chat-room .members-panel-1 {
height: 570px; }

.card.chat-room .chat-1 {
height: 495px; }

.card.chat-room .friend-list li {
border-bottom: 1px solid #e0e0e0; }
.card.chat-room .friend-list li:last-of-type {
border-bottom: none; }

.scrollbar-light-blue::-webkit-scrollbar-track {
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color: #F5F5F5;
border-radius: 10px; }

.scrollbar-light-blue::-webkit-scrollbar {
width: 12px;
background-color: #F5F5F5; }

.scrollbar-light-blue::-webkit-scrollbar-thumb {
border-radius: 10px;
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color: #82B1FF; }

.rare-wind-gradient {
background-image: -webkit-gradient(linear, left bottom, left top, from(#a8edea), to(#fed6e3));
background-image: -webkit-linear-gradient(bottom, #a8edea 0%, #fed6e3 100%);
background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%); }

CSS,
    ];


    public function asset()
    {

    }
    public function codes()
    {
        $this->htm .= $this->_layout['main'];
        $this->css .= $this->_layout['style'];

    }

}
