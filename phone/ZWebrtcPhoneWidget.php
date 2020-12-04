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
 * Created By: Bunyod_Yoqubjonov
 */
class ZWebrtcPhoneWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     * Constants */
    public function asset()
    {
        $this->fileCss('/render/siplibs/All/css/theme.css');
        $this->fileCss(' https://cdn.statically.io/gh/alepolidori/jssip-webrtc-phone/master/src/css/material.css');

        $this->fileJs('/render/phone/ZWebrtcPhoneWidget/asset/main.js');
        $this->fileJs('https://cdn.statically.io/gh/alepolidori/jssip-webrtc-phone/master/lib/jssip-3.3.6.js');
        $this->fileJs('https://cdn.statically.io/gh/alepolidori/jssip-webrtc-phone/master/src/js/app.js');
        $this->fileJs('https://cdn.statically.io/gh/alepolidori/jssip-webrtc-phone/master/src/js/webrtc-phone.js');

    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML


         
<div class="wrapper">
        <div id="sidebar">
            <div id="dismiss" class="ml-lg-2 ml-2 mt-lg-2 mt-2">
                 <i class="fas fa-times"></i>
             </div>
                   <nav class="opacity mt-3">
                        <div class="number text-center border w-10">
                            <div class="mb-2 mt-2 control_btn">
                                <a type="button" id="call-audio-btn" class="btn btn-success btn-rounded">
                                    <i class="fas success-ic fa-phone"></i></a>
                                <a type="button" id="hangup-btn" class="btn btn-success btn-rounded">
                                    <i class="fab red-ic fa-xbox"></i></a>
                                <a type="button" id="answer-btn" class="btn btn-success btn-rounded">
                                    <i class="fas success-ic fa-phone-volume"></i></a>

                            </div>
                            <div class="" id="output-lbl">Ready</div>
                            <div class="ml-4 mr-4">
                                <div class=" md-form input-with-post-icon mt-lg-1">
                                    <i class=" fas dark-ic fa-user input-prefix text-center "></i>
                                    <input type="text" id="call-to" class=" text-dark text-center">
                                    <label for="call-to"></label>
                                </div>
                            </div>
                            <div class=" buuton-goup mb-lg-4 mb-3 text-center">
                                <a type="button" class="btn-floating button1" value="1"
                                   onclick="dis('1')">1</a>
                                <!--  onclick="dis('2')" -->
                                <a type="button" class="btn-floating button1" value="2"
                                   onclick="dis('2')">2</a>
                                <a type="button" class="btn-floating button1" value="3"
                                   onclick="dis('3')">3</a>
                                <br>
                                <a type="button" class="btn-floating button1t" value="4"
                                   onclick="dis('4')">4</a>
                                <a type="button" class="btn-floating button1" value="5"
                                   onclick="dis('5')">5</a>
                                <a type="button" class="btn-floating button1" value="6"
                                   onclick="dis('6')">6</a>
                                <br>
                                <a type="button" class="btn-floating button1" value="7"
                                   onclick="dis('7')">7</a>
                                <a type="button" class="btn-floating button1" value="8"
                                   onclick="dis('8')">8</a>
                                <a type="button" class="btn-floating button1" value="9"
                                   onclick="dis('9')">9</a>
                                <br>
                                <a type="button" class="btn-floating button1" value="+"
                                   onclick="dis('+')">+</a>
                                <a type="button" class="btn-floating button1" value="0"
                                   onclick="dis('0')">0</a>
                                <a type="button" class="btn-floating button1" value="c" onclick="clr()">
                                    x</a>
                            </div>
                        </div>
                   </nav>                   
                </nav>
                                   
    <div class="input-group embed-responsive embed-responsive-16by9 remote" style="display: none">
        <span class="remote-text">Local</span>
        <video autoplay id="local-stream-video" class="embed-responsive-item hidden d-none"></video>
        <audio autoplay id="remote-stream-audio"></audio>
    </div>
    
</div>
<div id="content01">
        
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-phone"></i>
            </button>
       
    </div>
<div class="overlay"></div>

HTML,


        'js' => <<<JS
            /* setTimeout(function () {
        webrtcPhone.initAndLogin({
            server: 'zoft.uz',
            name: '202',
            exten: '202',
            password: '202',
            audioId: 'remote-stream-audio',
            localVideoId: 'local-stream-video',
            remoteVideoId: 'remote-stream-video'
        });
    }, 1000)
    
     function dis(val) {
        document.getElementById("call-to").value += val
    }

    function clr() {
        document.getElementById("call-to").value = ""
    }*/


    $('#dismiss').on('click', function () {
    $('#sidebar').removeClass('active');
    $('.overlay').removeClass('active');
});

$('#sidebarCollapse').on('click', function () {
    $('#sidebar').addClass('active');
    $('.overlay').addClass('active');
});
JS,
    ];


    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], []);
        $this->js .= strtr($this->_layout['js'], []);
    }

}
