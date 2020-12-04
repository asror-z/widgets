<?php



namespace zetsoft\widgets\phone;
use zetsoft\system\kernels\ZWidget;
/**
 *

 *
 * Created By: O'tkir JAKUPOV
 */
class ZJsSipGetWidget2  extends  ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZJsSipGetWidget2::type['main'],
        'uri' => 'sip:301@94.158.52.244:7777',
       'password' => 301, // FILL PASSWORD HERE,
       'sockets' => [ socket ],
       'register_expires' => 180,
       'session_timers' => false,
       'user_agent' => 'JsSip-' + userAgent,
    ];
    const theme = [ ];
    const size = [];
    public const type = [
        'main' => 'main',
    ];

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jssip/3.1.2/jssip.min.js');
        $this->fileJs('/render/siplibs/JsSip_Get_Started/js/main3.js');

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="main">
  <div class="logIn "  style="display: none;">
      <label for="uri">Log In</label>
      <input type="text" id="uri">
      </br>
      <label for="secret">Password</label>
      <input type="text" id="secret">
      <button id="button_auth"> Log In</button>

      <h1 class="authUri" style="display: none;"></h1>
  </div>
 <div class="inputUsers">
     <label for="inputNumber">Number</label>
  <input type="text" id="inputNumber">

  <button class="callButton" value="call">Call</button>
  <button class="hangUpButton">HangUp</button>
  <button class="answerButton">Answer</button>
 </div>

 <video id="selfView" autoplay muted></video>
 <video id="remoteView" autoplay></video>

 <div class="messages">
  <label for="inputNumberMsg">Номер</label>
  <input type="text" id="inputNumberMsg">
  </br>
  <label for="inputTextMsg">Сообщение</label>
  <input type="text" id="inputTextMsg">
  </br>
  <button id="sendMsgButton">Отправить</button>
  
 </div>
</div>
HTML,

    ];

    public function codes()
    {

        $this->htm = strtr($this ->_layout['main'],[]);
        $this->js .= strtr($this->_layout['js'], []);

        $mainJS = file_get_contents(Root . '/render/siplibs/JsSip_Get_Started/js/mainUtkir.js');
        $this->js = strtr($mainJS, [
        '{uri}' =>$this->_config['uri'],
       'password' =>_config['password'],// FILL PASSWORD HERE,
       'sockets' =>_config['sockets'],
       'register_expires' =>_config['register_expires'],
       'session_timers' =>_config['session_timers'],               
       'user_agent' =>_config['user_agent'],
       '{readonly}' => $this->jscode( $this->_config['readonly']),
        ]);
    }
}
