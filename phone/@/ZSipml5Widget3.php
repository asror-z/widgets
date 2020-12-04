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
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Maftuna Qodirova

 */

class ZSipml5Widget3 extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZSipml5Widget::type['main'],
        'realm'=> '94.158.52.244:7777',
        'impi' => '301',
        'impu' => 'sip:301@94.158.52.244:7777',
        'password' => '301',
        'display_name'=> '301',
        'websocket_proxy_url'=> 'wss://10.10.3.31:8089/ws',
        'outbound_proxy_url'=> null,
        'ice_servers'=> [],
        'enable_rtcweb_breaker'=> false,
//      'events_listener'=>  {'events'=> '*', 'listener'=> onSipEventStack },
        'enable_early_ims' => true , // Must be true unless you're using a real IMS network
        'enable_media_stream_cache'=> false,
        'bandwidth' => null, // could be redefined a session-level
        'video_size' => null, // could be redefined a session-level
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

        $this->fileJs('/render/phone/ZSipml5Widget/fayzullo/js/main.js');
        /*$this->fileCss('/render/phone/ZSipml5Widget/fayzullo/css/style_bunyod.css');*/

        $this->fileJs('/render/phone/ZSipml5Widget/fayzullo/release/SIPml-api.js');
        $this->fileCss('/render/asrorz/mdb/css/mdb.css');

    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="wrapper">
     <nav id="sidebar">
     <div class="video_panel">
                    <div>
                        <div id="divCallCtrl" class="span7 well" style='display:table-cell; vertical-align:middle'>
                            <label style="width: 100%;" align="center" id="txtCallStatus1">          <!--id="txtCallStatus"-->
                            </label>
                            <label style="width: 100%;" align="center" id="txtRegStatus1"></label>       <!--id="txtRegStatus"-->

                            <br />
                            <table style='width: 100%;display: none'>
                                <tr style="visibility: hidden">
                                    <td style="white-space:nowrap;">
                                        <input type="text" style="width: 100%; height:100%;" id="txtPhoneNumber1" value="" placeholder="Enter phone number to call" />      <!--id="txtPhoneNumber"-->
                                    </td>
                                </tr>
                                <tr style="visibility: hidden">
                                    <td colspan="1" align="right">
                                        <div class="btn-toolbar" style="margin: 0; vertical-align:middle">
                                            <div id="divBtnCallGroup" class="btn-group">
                                                <button id="btnCall" disabled class="btn btn-primary" data-toggle="dropdown">Call</button>
                                            </div>&nbsp;&nbsp;
                                            <div class="btn-group">
                                                <input type="button" id="btnHangUp1" style="margin: 0; vertical-align:middle; height: 100%;" class="btn btn-primary" value="HangUp" onclick='sipHangUp();' disabled />   <!--id="btnHangUp"-->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div id="tdVideo"  class="tab-video">
                                <div id="divVideo" class='div-video'>
                                    <div id="divVideoRemote" style='position:relative; height:100%; width:100%; z-index: auto; opacity: 1'>
                                        <video class="video" width="100%" height="100%" id="video_remote" autoplay="autoplay" style="opacity: 0;
                                                        background-color: #000000; -webkit-transition-property: opacity; -webkit-transition-duration: 2s;"></video>
                                    </div>

                                    <div id="divVideoLocalWrapper" style="margin-left: 0px; border:0px solid #009; z-index: 1000">
                                        <iframe class="previewvideo" style="border:0px solid #009; z-index: 1000"> </iframe>
                                        <div id="divVideoLocal" class="previewvideo" style=' border:0px solid #009; z-index: 1000'>
                                            <video class="video" width="100%" height="100%" id="video_local" autoplay="autoplay" muted="true" style="opacity: 0;
                                                            background-color: #000000; -webkit-transition-property: opacity;
                                                            -webkit-transition-duration: 2s;"></video>
                                        </div>
                                    </div>
                                    <div id="divScreencastLocalWrapper" style="margin-left: 90px; border:0px solid #009; z-index: 1000">
                                        <iframe class="previewvideo" style="border:0px solid #009; z-index: 1000"> </iframe>
                                        <div id="divScreencastLocal" class="previewvideo" style=' border:0px solid #009; z-index: 1000'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id='divCallOptions' class='call-options' style='opacity: 0; margin-top: 30px; '>
                                <button class="btn" id="btnFullScreen" disabled onclick='toggleFullScreen();'><i class="fas fa-compress"></i></button>
                                <button class="btn" id="btnMute" onclick='sipToggleMute();'><i class="fas fa-microphone-slash"></i></button>
                                <button class="btn" id="btnHoldResume" onclick='sipToggleHoldResume();'><i class="fas fa-phone"></i></button>
                                <button class="btn" id="btnTransfer" onclick='sipTransfer();'><i class="fas fa-random"></i></button>
                                <button class="btn" id="btnKeyPad" onclick='openKeyPad();'><i class="far fa-keyboard"></i></button>
                            </div>

                        </div>
                    </div>

                   <div class="container display-no">
                        <div class="row-fluid">
                            <div class="span4 well">
                               
                                <table style='width: 100%'>
                                    
                                            <label style="height: 100%">
                                                Display Name:
                                            </label>
                                       
                                            <input type="text" style="width: 100%; height: 100%" id="txtDisplayName" value=""
                                                   placeholder="e.g. John Doe" />
                                    
                                            <label style="height: 100%">
                                                Private Identity<sup>*</sup>:
                                            </label>
                                       
                                            <input type="text" style="width: 100%; height: 100%" id="txtPrivateIdentity" value=""
                                                   placeholder="e.g. +33600000000" />
                                    
                                            <label style="height: 100%">
                                                Public Identity<sup>*</sup>:
                                            </label>
                                       
                                            <input type="text" style="width: 100%; height: 100%" id="txtPublicIdentity" value=""
                                                   placeholder="e.g. sip:+33600000000@doubango.org" />
                                  
                                            <label style="height: 100%">Password:</label>
                                        
                                            <input type="password" style="width: 100%; height: 100%" id="txtPassword" value="" />
                                     
                                            <label style="height: 100%">Realm<sup>*</sup>:</label>
                                        
                                            <input type="text" style="width: 100%; height: 100%" id="txtRealm" value="" placeholder="e.g. doubango.org" />
                                     
                                        <td colspan="2" align="right">
                                            <input type="button" class="btn btn-success" id="btnRegister" value="LogIn" disabled onclick='sipRegister();' />
                                            &nbsp;
                                            <input type="button" class="btn btn-danger" id="btnUnRegister" value="LogOut" disabled onclick='sipUnRegister();' />
                                        </td>
                                    
                                        <td colspan="3">
                                            <p class="small"><sup>*</sup> <i>Mandatory Field</i></p>
                                        </td>
                                    
                                        <td colspan="3">
                                            <a class="btn" href="http://code.google.com/p/sipml5/wiki/Public_SIP_Servers" target="_blank">Need SIP account?</a>
                                        </td>
                                    
                                        <td colspan="3">
                                            <a class="btn" href="./expert.htm" target="_blank">Expert mode?</a>
                                        </td>
                                  
                                </table>
                            </div>

                        </div>
                      
                        <footer>
                            <object id="fakePluginInstance" classid="clsid:69E4A9D1-824C-40DA-9680-C7424A27B6A0" style="visibility:hidden;"> </object>

                            </footer>
                    </div>
                    <!-- /container -->
                    <!-- Glass Panel -->
                    <!--<div id='divGlassPanel' class='glass-panel' style='visibility:hidden'></div>-->
                    <!-- KeyPad Div -->

                   
                    
                    <!-- Call button options -->
                    <ul id="ulCallOptions" class="dropdown-menu" style="visibility:hidden">
                        <li><a href="#" onclick='sipCall("call-audio");'>Audio</a></li>
                        <li><a href="#" onclick='sipCall("call-audiovideo");'>Video</a></li>
                        <li id='liScreenShare'><a href="#" onclick='sipShareScreen();'>Screen Share</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick='uiDisableCallOptions();'><b>Disable these options</b></a></li>
                    </ul>

                </div>
        <div id="dismiss" class="ml-lg-2 ml-2 mt-lg-2 mt-2">
            <i class="fas fa-times"></i>
        </div>
        <div class="opacity">
            <div class="number text-center">
                       <div class="">
                                <button id="callBtn" class="btn btn-floating" title="Call" onclick='sipCall("call-audio");'><i class="fa fa-phone"></i></button>

                                <button id="videoBtn" class="btn btn-floating" onclick='sipCall("call-audiovideo");'>
                                    <i class="fas success-ic fa-video"></i>
                                </button>

                                <button class="btn btn-floating" id="btnHangUp" title="Hangup" onclick='sipHangUp();'>
                                    <i class="fas red-ic  fa-phone-slash"></i>
                                </button>
                            </div>
               
                    <div class="ml-4 mr-4">
                                <div id="txtCallStatus" class=""></div>
                                <div id="txtRegStatus"></div>

                                <div class="md-form input-with-post-icon mt-lg-1">
                                
                                    <input type="text" id="txtPhoneNumber" class="text-white text-center">
                                    <label for="txtPhoneNumber"></label>
                                </div>
                            </div>
                    <div class=" buuton-goup mb-lg-1 mb-1 text-center">
                      
                                <a type="button" class=" button1 btn btn-floating" value="1" onclick="dis('1')">1</a>   
                                <a type="button" class=" button1 btn btn-floating" value="2" onclick="dis('2')">2</a>
                                <a type="button" class=" button1 btn btn-floating" value="3" onclick="dis('3')">3</a>
                                <br>
                                <a type="button" class=" button1 btn btn-floating" value="4" onclick="dis('4')">4</a>
                                <a type="button" class=" button1 btn btn-floating" value="5" onclick="dis('5')">5</a>
                                <a type="button" class=" button1 btn btn-floating" value="6" onclick="dis('6')">6</a>
                                <br>
                                <a type="button" class=" button1 btn btn-floating" value="7" onclick="dis('7')">7</a>
                                <a type="button" class=" button1 btn btn-floating" value="8" onclick="dis('8')">8</a>
                                <a type="button" class=" button1 btn btn-floating" value="9" onclick="dis('9')">9</a>
                                <br>
                                <a type="button" class=" button1 btn btn-floating" value="+" onclick="dis('+')">+</a>
                                <a type="button" class=" button1 btn btn-floating" value="0" onclick="dis('0')">0</a>
                                <a type="button" class=" btn-floating btn-sm btn-secondary" value="c" onclick="clr()">
                                    <i class="fas red-ic fa-backspace "></i></a>

                           
                    </div>                    
            </div>
        </div>
    </nav>
      <div id="content01">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-phone"></i>
            </button>
        </div>
    </div>
    
    
    
    

    

<div class="overlay"></div>


HTML,
        'js' => <<<JS

                try {
                    var pageTracker = _gat._getTracker("UA-6868621-19");
                    pageTracker._trackPageview();
                } catch (err) { }
            
                function dis(val) {
                    document.getElementById("txtPhoneNumber").value += val
                }
                function clr() {
                    document.getElementById("txtPhoneNumber").value = ""
                }
                
                setTimeout(function() {
                    sipRegister();
                }, 3000);


                $('#dismiss').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
        });

       /* $('#hangup-btn').on('click', function () {
            $('.overlay').removeClass('active');
            $('.call').removeClass('active');
            $('#sidebar').removeClass('active');
        });

        $('#call-audio-btn').on('click', function () {
            $('.call').addClass('active');
            $('#sidebar').removeClass('active');
        })*/


               /* $('#res_btn').click(function () {
                    // $(this).preventDefault();
                    $('.or2').toggleClass('res_active');
                });
            
                $('.out_phone').click(function () {
                    $('.or2').removeClass('res_active');
                });*/
    
JS,


    ];


    public function codes()
    {

        $this->htm = strtr($this ->_layout['main'],[]);
        $this->js .= strtr($this->_layout['js'], []);

    }

}
