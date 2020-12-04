<?php

namespace zetsoft\widgets\phone;

use aki\telegram\types\ForceReply;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\notifier\ZJspanelWidgetWebphone;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/*
 * @author XakimjonErgashev
 * @license SherzodMangliyev
 *
 * */


class ZJsSipWidgetX extends ZWidget
{

    public $config = [];
    public $_config = [
        //'type' => ZSipml5Widget::type['main'],
        'outbound_proxy_url' => null,
        'ice_servers' => [],
        'enable_rtcweb_breaker' => false,
        'enable_early_ims' => true, // Must be true unless you're using a real IMS network
        'enable_media_stream_cache' => false,
        'bandwidth' => null, // could be redefined a session-level
        'video_size' => null, // could be redefined a session-level
//      'events_listener'=>  {'events'=> '*', 'listener'=> onSipEventStack },
        'ringtone' => '/render/phone/ZSipml5Widget/fayzullo/sounds/ringtone.wav',
        'ringbacktone' => '/render/phone/ZSipml5Widget/fayzullo/sounds/ringbacktone.wav',
        'dtmftone' => '/render/phone/ZSipml5Widget/fayzullo/sounds/dtmf.wav',
        'callBtn' => true,
        'videoCallBtn' => true,
        'btnHangUp' => true,
        'keypad' => true,
        //'backgroundColor' => 'blue lighten-4',
        'jsPanel' => true,
        'readonly' => true


    ];


    public const type = [
        'main' => 'main',
    ];

    public $event = [];
    public $_event = [

    ];

    public function asset()
    {


        $this->fileCss('/render/phone/ZSipml5Widget/fayzullo/css/light2.css');


        // $this->fileJs('https://jssip.net/download/releases/jssip-3.4.0.min.js');
        //$this->fileJs('https://jssip.net/download/releases/jssip-3.4.5.min.js');
        $this->fileJs('https://cdn.statically.io/gh/versatica/JsSIP/3.4.5/dist/jssip.min.js');
        //$this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jssip/3.1.2/jssip.min.js');
        $this->fileJs('https://cdn.statically.io/gh/albert-gonzalez/easytimer.js/master/dist/easytimer.min.js');
        //$this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jssip/3.1.2/jssip.min.js');

    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

            <div class="no_pad">
    <div class="main_block">
        <div class="block_item w-100">
            <div class="right_block row">
                <div class="number text-center border col-md-12 ">
                    <div class="mb-2 mt-2 control_btn">
                        <button id="callButton" class="btn btnCall callButton btn1 py-2" title="Call">
                            <i class="fa fa-phone fa-2x text-success"></i>
                        </button>
                        <!--<button id="answerButton" class="btn btnCall answerButton btn1 py-2" title="Call">
                            <i class="fa fa-phone fa-2x text-dark"></i>
                        </button>-->
                        <button class="btn btnHangUp hangUpButton btn1 hangupBtn py-2" id="btnHangUp" title="Hangup">
                            <i class="fas red-ic  fa-phone-slash fa-2x"></i>
                        </button>

                    </div>
                    <div class="ml-4 mr-4">
                        <div id="txtCallStatus" class="h-25"></div>
                        <div id="txtRegStatus"></div>
                        <h6 id="timer" class="d-none">00:00</h6>
                <div class=" md-form input-with-post-icon">
                    <i class="fas fa-user fa-2x input-prefix text-center"></i>
                    <input type="number" {readonly} id="txtPhoneNumber" class="form-control {numberInputClass} text-dark text-center">
                    <label for="txtPhoneNumber"></label>
                    <input type="number" {readonly} id="orderIdInput" class="form-control {orderInputClass} text-dark text-center">
                    <label for="orderIdInput"></label>
                </div>
            </div>
            <div class="buuton-goup {itemKeypad} mb-lg-4 mb-3">
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="1">1</a>
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="2">2</a>
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="3">3</a>
                <br>                                                       
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="4">4</a>
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="5">5</a>
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="6">6</a>
                <br>                                                       
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="7">7</a>
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="8">8</a>
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="9">9</a>
                <br>                                                       
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="+">+</a>
                <a type="button" class="btn-floating pt-3 fp-20 number-btn {buttonClass} mx-1 hvr-glow" value="0">0</a>
                <a type="button" class="btn-floating backspace-btn mx-1 hvr-glow" value="c">
                    <i class="fas red-ic fa-backspace"></i></a>

                    </div>
                </div>
         
                                    {jsPanel}
                  
            </div>
        </div>
    </div>


</div>
    
<audio id="ringing" src="/render/phone/ZWebrtcPhoneWidget/demo/sounds/ringing.mp3" loop></audio>
<audio id="calling" src="/render/phone/ZWebrtcPhoneWidget/demo/sounds/calling.mp3" loop></audio>


HTML,
        'js' => <<<JS
    var timer = document.getElementById("timer");
    var time = "00:00"
    var seconds = 0;
    var minutes = 0;
    var t;
    
    timer.textContent = time;
    
    function buildTimer () {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                seconds = 0;
            }
        }
        timer.textContent = (minutes < 10 ? "0" + minutes.toString(): minutes) + ":" + (seconds < 10 ? "0" + seconds.toString(): seconds);
    }
    function startTimer () {
        
        clearTimeout(t);
        t = setInterval(buildTimer,1000);
    }
    function resetTimer () {
        
        timer.textContent = time;
        seconds = 0; minutes = 0;
        
    }
    function stopTimer () {
        clearTimeout(t);
        
    }
        /*
        * $('#jspanel').toggle();
        * */
        var iframe = $('#videoBlock');
        iframe.attr('height', '95%');
        iframe.attr('width', '100%');
        let callButton = document.querySelector('#callButton'), // Нахожу кнопку Call
        hangUpButton = document.querySelector('.hangUpButton'),  // Нахожу кнопку Hangup
        txtPhoneNumber = document.querySelector('#txtPhoneNumber');
        txtRegStatus = document.getElementById('txtRegStatus');
        calling = document.getElementById('calling');
        ringing = document.getElementById('ringing');
        var idNumber = document.getElementById('orderIdInput');
        
        
    
        
        function setIdNumber()
    {

     idNumber.value = currentId;
     

    }

    function disableBtn(keyBtn){
        keyBtn.disabled = true;
    }

    function enableBtn(keyBtn){
        keyBtn.disabled = false;
    }

    $('.number-btn').on("click", function() {
        var numberBtnVal = $(this).html();
        dis(numberBtnVal);
        enableBtn(callButton);

    })
    
    function clr() {
        document.getElementById("txtPhoneNumber").value = "";
        //disableBtn(callButton);
    }

    $('.backspace-btn').on("click", function() {
        clr();
    })

    function dis(val) {
        console.log('clicked');
        document.getElementById("txtPhoneNumber").value += val
        //console.log($('#txtPhoneNumber').val());
    }

    var options = {
        'mediaConstraints': {'audio': true, 'video': false},
        'pcConfig': {
            'rtcpMuxPolicy': 'require',
            'iceServers': []
        },
        'rtcOfferConstraints': {
            'offerToReceiveAudio': 1, // Принимаем только аудио
            'offerToReceiveVideo': 0
        }
    };

    var socket = new JsSIP.WebSocketInterface('{websocket_proxy_url}');

    //Create HTML Audio Object
    var remoteAudio = new window.Audio()
    remoteAudio.autoplay = true;

    const mediaSource = new MediaSource();

    var selfView = document.getElementById('selfView');
    var remoteView = document.getElementById('remoteView');
    

    var userAgent = JsSIP.version;
    console.log(socket);

    /**/

    var configuration = {
        'uri': 'sip:{impi}{impu}',
        'password': {password}, // FILL PASSWORD HERE,
        'sockets': [socket],
        'register_expires': 600,
        'session_timers': false,
        'user_agent': 'JsSip-' + userAgent
    };

    var user = configuration.uri;
    var pass = configuration.password;
    console.log(pass)
    var phone;
    if (user && pass) {
        /*JsSIP.debug.enable('JsSIP:*');*/
        phone = new JsSIP.UA(configuration);
        phone.on('registrationFailed', function (ev) {
            alert('Registering on SIP server failed with error: ' + ev.cause);
            configuration.uri = null;
            configuration.password = null;
        });

        phone.on('newRTCSession', (data) => {
            var newSession = data.session;


            if (session) { // hangup any existing call
                console.log('hangup any existing call ');
                session.terminate();
                phone.stop();
            }
            session = newSession;


            var completeSession = function () {
                console.log('completeSession');
                console.log('terminated');
                txtRegStatus.innerHTML = 'Kонец вызова';
                
                stopTimer();
                var incomingPhoneNumber = session.remote_identity.display_name;
                var currentId = window.currentId;
                
                /*console.log(currentId);*/


                var operatorNumber = "{impi}";
               /// var clientNumber = document.getElementById("txtPhoneNumber").value;

                $.ajax({
                    type: "GET",
                    url: '/api/calls/time/cdr.aspx',
                    data:{
                        updateValue: currentId,
                      //  dstNumber: clientNumber,
                        srcNumber: operatorNumber
                    },
                    /*success: function (data) {
                        console.log(data);
                    }*/
                });

                setTimeout(function(){ txtRegStatus.innerHTML = 'Подключено'; timer.classList.add('d-none'); resetTimer(); }, 2000);
                //checkIfEmpty();
                /*enableBtn(answerButton);*/
                calling.pause();
                ringing.pause();
                session = null;
            };
            let ringPlay = $('#ringing'); //рингтоне
            let ringCall = $('#calling'); //гудки

            var playingRingtone = function () {
                    console.log('playingRingtone');

                    ringCall.pause();
                    ringPlay.play();
            }
            var playingCalling = function () {
                    console.log('playingCalling');
                    ringPlay.pause();
                    ringCall.play();
            }
            var playingPause = function () {
                    console.log('playingPause');
                    ringCall.pause();
                    ringPlay.pause();
            }

            /*function completeSessionFunc(key) {
                console.log('Call ' + key);
                txtRegStatus.innerHTML = 'Call ' + key ;
                callButton.disabled = false;
                session = null;
            }
*/
            function cnslg(key) {
                     console.log(key);
            }
            
            function openIncomingModal() 
            {
                console.log('openIncomingModal');
                window.webphonePanel();
            
                /*$('#jsPanel-webPhone').toggle();*/
                
                var iframe = $('#jsPanel-webPhone-iframe');
                
                iframe.attr('src', '/shop/agent/manual/update.aspx?id=' + session.remote_identity.uri.user);
                
                iframe.attr('height', '95%');
                
                iframe.attr('width', '100%');
                
                iframe.on('load', function () {
                    var form = iframe.contents().find('#callsForm')
                    form.on('submit', function() {
                        alert()
                        window.parent.closeSweet()
                        $('#ShopOrder_Grid_Reset').click();
                    })
                });
            
                $.ajax({
                    type: "GET",
                    url: '/core/agent/setInProsess.aspx',
                    data: {
                      agentId: agentId,  
                    },
                });
                
            }


            if (session.direction == 'outgoing') {
                console.log('stream outgoing  -------->');
                txtRegStatus.innerHTML = 'Исходящий вызов';

                session.on('connecting', function (e) {
                    console.log('CONNECT');
                });
                session.on('peerconnection', function (e) {
                    console.log('1accepted');
                    timer.classList.remove('d-none');
                    resetTimer();
                    startTimer();
                    
                });
                session.on('sending', function (e) {
                    console.log('sending');
                });
                session.on('progress', function (e) {
                    //ringtone('ringing');
                    calling.play();
                    console.log('progress');
                });
                session.on('newDTMF', function (e) {
                    console.log('newDTMF');
                });
                session.on('newInfo', function (e) {
                    console.log('newInfo');
                });
                session.on('hold', function (e) {
                    console.log('hold');
                });
                session.on('unhold', function (e) {
                    console.log('unhold');
                });
                session.on('muted', function (e) {
                    console.log('muted');
                });
                session.on('unmuted', function (e) {
                    console.log('unmuted');
                });
                session.on('reinvite', function (e) {
                    //Протестить эту вещь очень важно
                    console.log('reinvite');
                });
                session.on('update', function (e) {
                    //Протестить эту вещь тоже очень  важно
                    console.log('update');
                });
                session.on('refer', function (e) {
                    //Протестить эту вещь тоже очень  важно
                    console.log('refer');
                });
                session.on('replaces', function (e) {
                    //Протестить эту вещь тоже очень  важно
                    console.log('replaces');
                });
                session.on('sdp', function (e) {
                    //Протестить эту вещь тоже очень  важно
                    console.log('sdp');

                });

                session.on('ended', completeSession);
                session.on('failed', completeSession);
                session.on('accepted', function (e) {
                    console.log('acceptedasdasdsda');
                    timer.classList.remove('d-none');
                    resetTimer();
                    startTimer();
                    
                    calling.pause();
                });
                session.on('confirmed', function (e) {
                    console.log('CONFIRM STREAM');
                });
            }
            else if (session.direction == 'incoming') {
                session.remote_identity.display_name;
                
                
                autoAnswer = '{autoAnswer}';
                if (autoAnswer){
                 setTimeout(function(){ callButton.click(); }, {autoAnswerTimeOut});
                }
              
                if (session.remote_identity.uri.user.length < 9){
                    console.log('session.remote_identity.uri.user.length');
                    openIncomingModal()
                }
                
                
                session.remote_identity.display_name;
                idNumber.value = session.remote_identity.uri.user;
             
                console.log('stream incoming  -------->');
                txtRegStatus.innerHTML = 'Incoming Call';
                //enableBtn(callButton);
                session.on('connecting', function () {
                    console.log('CONNECT');
                });
                session.on('peerconnection', function (e) {
                    console.log('1accepted');
                    calling.pause();
                    //timer.start();
                });
                session.on('sending', function (e) {
                    console.log('sending');
                });
                session.on('progress', function (e) {
                    console.log('progress');
                    ringing.play();
                });
                session.on('newDTMF', function (e) {
                    console.log('newDTMF');
                });
                session.on('newInfo', function (e) {
                    console.log('newInfo');
                });
                session.on('hold', function (e) {
                    console.log('hold');
                });
                session.on('unhold', function (e) {
                    console.log('unhold');
                });
                session.on('muted', function (e) {
                    console.log('muted');
                });
                session.on('unmuted', function (e) {
                    console.log('unmuted');
                });
                session.on('reinvite', function (e) {
                    //Протестить эту вещь очень важно
                    console.log('reinvite');
                });
                session.on('update', function (e) {
                    //Протестить эту вещь тоже очень  важно
                    console.log('update');
                });
                session.on('refer', function (e) {
                    //Протестить эту вещь тоже очень  важно
                    console.log('refer');
                });
                session.on('replaces', function (e) {
                    //Протестить эту вещь тоже очень  важно
                    console.log('replaces');
                });
                session.on('sdp', function (e) {
                    //Протестить эту вещь тоже очень  важно
                    console.log('sdp');
                });

                session.on('ended', completeSession);
                session.on('failed', completeSession);
                session.on('accepted', function (e) {
                    console.log('accepted');
                    timer.classList.remove('d-none');
                    resetTimer();
                    startTimer();
                });
                session.on('confirmed', function (e) {
                    console.log('CONFIRM STREAM');
                });

                
                //Поднимаем трубку при нажатии на кнопку Answer
                /*
                answerButton.addEventListener('click', function (){
             
                    newSession.answer(options);
                    
                    console.log(session.connection)
                    
                    console.log(session.connection.stream);
                    
                    ringing.pause()
                    
                    add_stream()
                    
                });
                
                    
                */
                
            }

        });
        phone.on('connecting', (data)=> {
           // let session = data.session;

            console.log('connecting');
            txtRegStatus.innerHTML = 'Cоединение';
        });
        phone.on('connected', (data)=> {
            //let session = data.session;

            console.log('connected');
            txtRegStatus.innerHTML = 'Подключено';
        });
        phone.on('disconnected', (data)=> {
            //let session = data.session;

            console.log('disconnected');
            txtRegStatus.innerHTML = 'Не подключено';

        });
        phone.on('registered', (data)=> {
            //let session = data.session;

            console.log('registered')
        });
        phone.on('unregistered', (data)=> {
           // let session = data.session;

            console.log('unregistered')
        });
        phone.on('registrationFailed', (data)=> {
           // let session = data.session;

            console.log('registrationFailed');
            txtRegStatus.innerHTML = 'Регистрация не удалась';
        });
        phone.on('registrationExpiring', function () {
            console.log('registrationExpiring')
            phone.register();
            console.log('phoneregister');
        } );
        phone.on('newMessage', (data)=> {
        });
        phone.start();
    }

    var session;



    callButton.addEventListener('click', function () {

        if (session == undefined){
            if (txtPhoneNumber.value == "" ){
                txtPhoneNumber.placeholder = "введите номер";
            } else {
                phone.call('sip:' + txtPhoneNumber.value + '{impu}', options)
                add_stream();
            }


        }
        else if (session.direction == "incoming") {
            session.answer(options);
            ringing.pause();
            add_stream()
        }
    });


    function add_stream() {
        session.connection.addEventListener('addstream', function (e) {
            remoteAudio.srcObject = (e.stream);
        })
    }


    //сбрасываем звонок при нажатии на HangUP
    hangUpButton.addEventListener('click', function () {
        phone.terminateSessions();
        ringing.pause();
        calling.pause();
    });

    // Отправка сообщений

JS,

        'css' => <<<CSS
         input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }
    .streamvideo {
        height: 240px;
        width: 320px;
        border: 3px solid grey;
    }
CSS,


    ];

    public function codes()
    {
        foreach ($this->data as $sipml) {

            $this->htm = strtr($this->_layout['main'], [
                '{ringtone}' => $this->_config['ringtone'],
                '{ringbacktone}' => $this->_config['ringbacktone'],
                '{callBtn}' => $sipml->callBtn ? '' : "d-none",
                '{videoCallBtn}' => $sipml->videoCallBtn ? '' : "d-none",
                '{btnHangUp}' => $sipml->btnHangUp ? '' : "d-none",
                '{itemKeypad}' => $sipml->keypad ? '' : "d-none",
                '{numberInputClass}' => $sipml->phoneInputDisplay ? 'd-block' : 'd-none',
                '{orderInputClass}' => $sipml->orderInputDisplay ? 'd-block' : 'd-none',
                '{buttonClass}' => $sipml->buttonClass,
                '{readonly}' => $this->_config['readonly'] ? "readonly" : "",
                '{jsPanel}' => $this->_config['jsPanel'] ? "" : ZJspanelWidgetWebphone::widget([
                    
                    'config' => [
                        'id' => 'jspanel',
                        'begin' => false,
                        'height' => '550px',
                        'width' => '50%',
                        'my' => 'center',
                        'at' => 'center',
                        'autoposition' => 'down',
                        'offsetX' => '-40',
                        'offsetY' => '0',
                        'content' => '<iframe id="videoBlock" src="/render/phone/ZJSSipWidget/video/videoCall.html"></iframe>'
                    ]
                ]),
            ]);


            $this->js = strtr($this->_layout['js'], [
                '{id}'=> $this->id,
                '{impi}' => $sipml->impi,
                '{impu}' => $sipml->impu,
                '{password}' => $sipml->password,
                //'{display_name}' => $SIPMLItem->display_name,
                '{websocket_proxy_url}' => $sipml->websocket_proxy_url,
                '{autoAnswer}' => $sipml->autoAnswer,
                '{autoAnswerTimeOut}' => $sipml->autoAnswerTimeOut,
            ]);

        }
        $this->css = strtr($this->_layout['css'], []);
    }

}
