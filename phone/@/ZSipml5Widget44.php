<?php

namespace zetsoft\widgets\phone;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Created By: Maftuna Qodirova

 */

class ZSipml5Widget44 extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => ZSipml5Widget::type['main'],
        'realm'=> '94.158.52.244:7777',
        'impi' => '305',
        'impu' => 'sip:305@94.158.52.244:7777',
        'password' => '305',
        'display_name'=> '305',
        'websocket_proxy_url'=> 'wss://zoft.uz:8089/ws',
        'outbound_proxy_url'=> null,
        'ice_servers'=> [],
        'enable_rtcweb_breaker'=> false,
        'enable_early_ims' => true , // Must be true unless you're using a real IMS network
        'enable_media_stream_cache'=> false,
        'bandwidth' => null, // could be redefined a session-level
        'video_size' => null, // could be redefined a session-level
//      'events_listener'=>  {'events'=> '*', 'listener'=> onSipEventStack },
        ];

//    /**
//     *
//     * Constants
//     */

    const theme = [ ];

    const size = [];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */

    public const type = [
        'main' => 'main',
    ];

    public $event = [];
    public $_event = [

    ];

    public function asset()
    {

       // $this->fileCss('/render/phone/ZSipml5Widget/fayzullo/css/style.css');
      $this->fileCss('/render/phone/ZSipml5Widget/fayzullo/css/light.css');

        //$this->fileJs('/render/phone/ZSipml5Widget/fayzullo/js/main.js');
        $this->fileJs('/render/phone/ZSipml5Widget/fayzullo/release/SIPml-api.js');

    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

<div>
    <div class="no_pad">
        <div class="main_block ">
            <div class="block_item ">
                <div class="left_block"></div>
            </div>
            <div class="block_item or2">
                <div class="video_panel">
                    <div>
                        <div id="divCallCtrl" class="span7 well table align-middle">
                            <label class="w-100 align-middle" id="txtCallStatus1">          <!--id="txtCallStatus"-->
                            </label>
                            <label class="w-100 align-middle" id="txtRegStatus1"></label>       <!--id="txtRegStatus"-->
                            <br />
                            <table class="w-100 d-none" >
                                <tr class="invisible" >
                                    <td >
                                        <input type="text" class="w-100 h-100" id="txtPhoneNumber1" value="" placeholder="Enter phone number to call" />      <!--id="txtPhoneNumber"-->
                                    </td>
                                </tr>
                                <tr class="invisible">
                                    <td colspan="1" align="right">
                                        <div class="btn-toolbar m-0 align-middle" >
                                             <div id="divBtnCallGroup" class="btn-group">
                                                <button id="btnCall" disabled class="btn btn-primary" data-toggle="dropdown">Call</button>
                                            </div>&nbsp;&nbsp;
                                            <div class="btn-group">
                                                <input type="button" id="btnHangUp1" class="btn btn-primary m-0 align-middle h-100" value="HangUp" onclick='sipHangUp();' disabled />   <!--id="btnHangUp"-->
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </table>


                            <div id="tdVideo"  class="tab-video">
                                <div id="divVideo" class='div-video'>
                                    <div id="divVideoRemote" class="position-relative h-100 w-100 opacity-1">
                                        <video class="video opacity-0 bg-dark" width="100%" height="100%" id="video_remote" autoplay="autoplay" ></video>
                                    </div>

                                    <div id="divVideoLocalWrapper" class="ml-0 border border-dark" >
                                        <iframe class="previewvideo border border-dark" > </iframe>
                                        <div id="divVideoLocal" class="previewvideo border border-dark">
                                            <video class="video opacity-0 bg-dark"  width="100%" height="100%" id="video_local" autoplay="autoplay" muted="true"></video>
                                        </div>
                                    </div>
                                    <div id="divScreencastLocalWrapper" class="ml-90 border border-dark">
                                        <iframe class="previewvideo border border-0 border-dark z-index-1000" > </iframe>
                                        <div id="divScreencastLocal" class="previewvideo border border-0 border-dark z-index-1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id='divCallOptions' class='call-options opacity-0 mt-2' >
                                <button class="btn" id="btnFullScreen" disabled onclick='toggleFullScreen();'><i class="fas fa-compress"></i></button>
                                <button class="btn" id="btnMute" onclick='sipToggleMute();'><i class="fas fa-microphone-slash"></i></button>
                                <button class="btn" id="btnHoldResume" onclick='sipToggleHoldResume();'><i class="fas fa-phone"></i></button>
                                <button class="btn" id="btnTransfer" onclick='sipTransfer();'><i class="fas fa-random"></i></button>
                                <button class="btn" id="btnKeyPad" onclick='openKeyPad();'><i class="far fa-keyboard"></i></button>
                            </div>

                        </div>
                    </div>


                    <div class="container d-none">
                        <div class="row-fluid">
                            <div class="span4 well">
                                 </label>
                                <h2>
                                    Registration
                                </h2>
                                <br />
                                <table class="w-100">
                                    <tr>
                                        <td>
                                            <label class="h-100" >
                                                Display Name:
                                            </label>
                                        </td>
                                        <td>
                                            <input type="text" class="w-100"  id="txtDisplayName" value=""
                                                   placeholder="e.g. John Doe" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="h-100" >
                                                Private Identity<sup>*</sup>:
                                            </label>
                                        </td>
                                        <td>
                                            <input type="text" class="w-100" id="txtPrivateIdentity" value=""
                                                   placeholder="e.g. +33600000000" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="h-100" >
                                                Public Identity<sup>*</sup>:
                                            </label>
                                        </td>
                                        <td>
                                            <input type="text" class="w-100" id="txtPublicIdentity" value=""
                                                   placeholder="e.g. sip:+33600000000@doubango.org" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="h-100" >Password:</label>
                                        </td>
                                        <td>
                                            <input type="password" class="w-100" id="txtPassword" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="h-100" >Realm<sup>*</sup>:</label>
                                        </td>
                                        <td>
                                            <input type="text" class="h-100" id="txtRealm" value="" placeholder="e.g. doubango.org" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            <input type="button" class="btn btn-success" id="btnRegister" value="LogIn" disabled onclick='sipRegister();' />
                                            &nbsp;
                                            <input type="button" class="btn btn-danger" id="btnUnRegister" value="LogOut" disabled onclick='sipUnRegister();' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p class="small"><sup>*</sup> <i>Mandatory Field</i></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <a class="btn" href="http://code.google.com/p/sipml5/wiki/Public_SIP_Servers" target="_blank">Need SIP account?</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <a class="btn" href="./expert.htm" target="_blank">Expert mode?</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <br>


                        <br />
                        <footer>

                            <p>
                                &copy; Zetsoft Telecom 2018-2020 <br />
                                <i>Inspiring the future</i>
                            </p>
                            <object id="fakePluginInstance" classid="clsid:69E4A9D1-824C-40DA-9680-C7424A27B6A0" class="invisible" > </object>

                            </footer>
                    </div>
                    
                    <!-- /container -->
                    <!-- Glass Panel -->
                    <div id='divGlassPanel' class='glass-panel invisible'></div>


                    <!-- Call button options -->
                    <ul id="ulCallOptions" class="dropdown-menu invisible" >
                        <li><a href="#" onclick='sipCall("call-audio");'>Audio</a></li>
                        <li><a href="#" onclick='sipCall("call-audiovideo");'>Video</a></li>
                        <li id='liScreenShare'><a href="#" onclick='sipShareScreen();'>Screen Share</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick='uiDisableCallOptions();'><b>Disable these options</b></a></li>
                    </ul>

                </div>

                <div class="right_block">
                    <div class="opacity mt-3">
                        <div class="number text-center border w-10">
                            <div class="mb-2 mt-2 control_btn">
                                <button id="callBtn" class="btn btnCall btn1" title="Call" onclick='sipCall("call-audio");'><i class="fa fa-phone"></i></button>

                                <button id="videoBtn" class="btn btn1" onclick='sipCall("call-audiovideo");'>
                                    <i class="fas success-ic fa-video"></i>
                                </button>

                                <button class="btn btnHangUp btn1 hangupBtn" id="btnHangUp" title="Hangup" onclick='sipHangUp();'>
                                    <i class="fas red-ic  fa-phone-slash"></i>
                                </button>
                            </div>
                            <div class="ml-4 mr-4">
                                <div id="txtCallStatus" class="h-25" ></div>
                                <div id="txtRegStatus" ></div>

                                <div class=" md-form input-with-post-icon mt-lg-1">
                                    <i class=" fas white-ic fa-user input-prefix text-center "></i>
                                    <input type="text" id="txtPhoneNumber" class="form-control text-white text-center">
                                    <label for="txtPhoneNumber"></label>
                                </div>
                            </div>
                            <div class=" buuton-goup mb-lg-4 mb-3">
                                <a type="button" class="btn-floating" value="1" onclick="dis('1')">1</a>
                                <a type="button" class="btn-floating" value="2" onclick="dis('2')">2</a>
                                <a type="button" class="btn-floating" value="3" onclick="dis('3')">3</a>
                                <br>
                                <a type="button" class="btn-floating" value="4" onclick="dis('4')">4</a>
                                <a type="button" class="btn-floating" value="5" onclick="dis('5')">5</a>
                                <a type="button" class="btn-floating" value="6" onclick="dis('6')">6</a>
                                <br>
                                <a type="button" class="btn-floating" value="7" onclick="dis('7')">7</a>
                                <a type="button" class="btn-floating" value="8" onclick="dis('8')">8</a>
                                <a type="button" class="btn-floating" value="9" onclick="dis('9')">9</a>
                                <br>
                                <a type="button" class="btn-floating" value="+" onclick="dis('+')">+</a>
                                <a type="button" class="btn-floating" value="0" onclick="dis('0')">0</a>
                                <a type="button" class="btn-floating" value="c" onclick="clr()">
                                    <i class="fas red-ic fa-backspace"></i></a>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>

</div>

HTML,
        'js' => <<<JS
            
                // function dis(val) {
                //     document.getElementById("txtPhoneNumber").value += val
                // }
                // function clr() {
                //     document.getElementById("txtPhoneNumber").value = ""
                // }
                
                setTimeout(function() {
                    sipRegister();
                }, 3000);


                $('#res_btn').click(function () {
                    // $(this).preventDefault();
                    $('.or2').toggleClass('res_active');
                });
            
                $('.out_phone').click(function () {
                    $('.or2').removeClass('res_active');
                });
                
                /*var call_config = {
                    realm: '{realm}',
                    impi: '{impi}',
                    impu: '{impu}',
                    password: '{password}',
                    display_name: '{display_name}',
                    websocket_proxy_url: '{websocket_proxy_url}',
                    outbound_proxy_url: '{outbound_proxy_url}',
                    ice_servers: '{ice_servers}',
                    enable_rtcweb_breaker: '{enable_rtcweb_breaker}',
                    events_listener: { events: '*', listener: onSipEventStack },
                    enable_early_ims: {enable_early_ims}, // Must be true unless you're using a real IMS network
                    enable_media_stream_cache: '{enable_media_stream_cache}',
                    bandwidth: '{bandwidth}', // could be redefined a session-level
                    video_size: '{video_size}', // could be redefined a session-level
                    sip_headers: [
                    { name: 'User-Agent', value: 'IM-client/OMA1.0 sipML5-v1.2016.03.04' },
                    { name: 'Organization', value: 'Doubango Telecom' }
                     ]
                };*/
                
                

JS,

    ];

    public function codes()
    {

        $this->htm = strtr($this ->_layout['main'],[]);
        $this->js .= strtr($this->_layout['js'], [



        ]);

        $mainJS = file_get_contents(Root . '/render/phone/ZSipml5Widget/fayzullo/js/main.js');

        //vdd($mainJS);

        $this->js = strtr($mainJS, [
            '{realm}' => $this->jscode($this->_config['realm']),
            '{impi}' => $this->jscode($this->_config['impi']),
            '{impu}' => $this->jscode($this->_config['impu']),
            '{password}' => $this->jscode($this->_config['password']),
            '{display_name}' => $this->jscode($this->_config['display_name']),
            '{websocket_proxy_url}' => $this->jscode($this->_config['websocket_proxy_url']),
            '{outbound_proxy_url}' => $this->jscode($this->_config['outbound_proxy_url']),
            '{ice_servers}' => $this->jscode($this->_config['ice_servers']),
            '{enable_rtcweb_breaker}' => $this->jscode($this->_config['enable_rtcweb_breaker']),
            '{enable_early_ims}' => $this->jscode($this->_config['enable_early_ims']),
            '{enable_media_stream_cache}' => $this->jscode($this->_config['enable_media_stream_cache']),
            '{bandwidth}' => $this->jscode($this->_config['bandwidth']),
            '{video_size}' => $this->jscode($this->_config['video_size']),
        ]);

    }

}
