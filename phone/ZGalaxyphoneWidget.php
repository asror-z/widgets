<?php

/**
 *     Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Creted  By: O'tkir Jakupov
 *
 */

namespace zetsoft\widgets\phone;


use zetsoft\system\kernels\ZWidget;

class ZGalaxyphoneWidget    extends ZWidget
{
    public $config = [];
    public $_config = [

    ];
    //    /**
//     *
//     * Constants
//     */
    const theme = [ ];

    const size = [];

    public function asset()
    {
        /*<audio id="audio_remote" autoplay="autoplay"></audio>
<audio id="ringtone" loop src="sounds/ringtone.wav"></audio>
<audio id="ringbacktone" loop src="sounds/ringbacktone.wav"></audio> */

        $this->fileCss('https://fonts.googleapis.com/icon?family=Material+Icons') ;
        $this->fileCss('/render/phone/Samsung Galaxy s10 - gtaRp/css/style1.css');

        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sipml@2.1.4/SIPml-api.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.9/angular.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js');
       
    }
    public$layout = [];
    /*public $_layout = [
      'main' => <<<HTML
            <div class="app-wrapper" ng-controller="ctrl">
                <div class="phone-wrapper" ng-class="{ 'small': sm, 'medium': med, 'large': lg, 'extra-large': xl  }">
                    <div class="screen">
                        <div class="phone-stats">
                            <i class="material-icons">network_cell</i>
                        </div>
                        <div class="regsts">
                            <div id="txtRegStatus"></div>
                            <div id="txtCallStatus" ></div>
                            <div id="txtState" ></div>
                        </div>
                        <div class="call-wrapper" ng-class="{ 'open': callToggle, '': !callToggle }">
                            <h1>
                                <i class="material-icons" ng-click="toggleView('call')">
                                    arrow_back_ios
                                </i> <span>Phone<span>
                            </h1>
                            <input id="phone_popup_number" class="number-input " type="tel" placeholder="enter number" ng-model="call_phone_number" maxlength="10" />
                            <label for="phone_popup_number"></label>
                            <div class="dialer">
                                <button class="dialer-btn" value="1" onclick="dis('1')">1</button>
                                <button class="dialer-btn" value="2" onclick="dis('2')">2</button>
                                <button class="dialer-btn" value="3" onclick="dis('3')">3</button>
                                <button class="dialer-btn" value="4" onclick="dis('4')">4</button>
                                <button class="dialer-btn" value="5" onclick="dis('5')">5</button>
                                <button class="dialer-btn" value="6" onclick="dis('6')">6</button>
                                <button class="dialer-btn" value="7" onclick="dis('7')">7</button>
                                <button class="dialer-btn" value="8" onclick="dis('8')">8</button>
                                <button class="dialer-btn" value="9" onclick="dis('9')">9</button>
                                <button class="dialer-btn" value="+" onclick="dis('+')">+</button>
                                <button class="dialer-btn" value="0" onclick="dis('0')">0</button>
                                <button class="dialer-btn clear" value="x" onclick="clr()">x</button>
            
                            </div>
                            <button id="btnCall" class="call-btn" ng-click="toggleView('calling', call_phone_number)"
                                    value="Call"
                                    onclick="call();"> <i class="material-icons">
                                phone
                            </i></button>
                        </div>
                        <div class="footer-bar">
                            <button class="footer-btn phone" ng-click="toggleView('call')">
                                <i class="material-icons">
                                    phone
                                </i>
                            </button>
                        </div>
                        <div class="phone-call-active-wrapper" ng-class="{ 'open': phoneCallActiveToggle, '': !phoneCallActiveToggle }">
                            <i class="material-icons back-from-call" ng-click="toggleView('calling')">
                                arrow_back_ios
                            </i>
                            <i class="material-icons">
                                phone_in_talk
                            </i>
                            <p>{{callingName || 'goodbye!'}}</p>
                            <p>{{callStatus}}</p>
                            <button class="answer-btn" ng-hide="callStatus === 'outgoing'" id="btnCall_2">Answer</button>
                            <button class="hangup-btn" ng-click="toggleView('calling')" id="btnHangUp" onclick="hangup(); clr();">Hangup</button>
                        </div>
                    </div>
                </div>
            </div>
HTML,
        'js' => <<<JS 
         
           
JS,

];*/


    public function codes()
    {

        $this ->htm = strtr($this ->_layout['main'],[]);
        $this->js .= strtr($this->_layout['js'], []);

        /* $this->css = <<<CSS

CSS;*/
        


    }

}
