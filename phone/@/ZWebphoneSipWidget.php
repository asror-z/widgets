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

class ZWebphoneSipWidget extends ZWidget
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

    public function asset()
    {

        $this->fileCss('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

        $this->fileCss('https://cdn.statically.io/gh/ricardojlrufino/webphone-sip/b984f5fb/dist/css/app.min.css');

        $this->fileJs('https://cdn.statically.io/gh/ricardojlrufino/webphone-sip/b984f5fb/dist/js/contrib.bundle.js');

        $this->fileJs('https://cdn.statically.io/gh/ricardojlrufino/webphone-sip/b984f5fb/dist/js/main.min.js');
    }
    /**
     * Constants */


    public $layout = [];
    public $_layout = [
        'phone' => <<<HTML


<div class="app">
    <header style="margin: 0px !important;">
        <div class="tabs is-centered">
            <ul>
                <li class="is-active">
                    <a data-tab="DialPage">
                            <span class="icon is-small">
                                <i class="fa fa-phone"></i>
                            </span>
                        <span data-localize="tab_dial">Dial</span>
                    </a>
                </li>
                <li>
                    <a data-tab="ConfigPage">
                            <span class="icon is-small">
                                <i class="fa fa-wrench"></i>
                            </span>
                        <span data-localize="tab_config">Config</span>
                    </a>
                </li>

            </ul>
        </div>
    </header>
    <div id="content">


        <div id="ConfigPage" class="container tab-content">
            <!-- AJAX -->
        </div>

        <div id="HistoryPage" class="container tab-content">
            <!-- AJAX -->
        </div>

        <div id="DialPage" class="container tab-content" data-loaded="true">

            <div id="caller-digits" class="is-unselectable box has-text-centered">

                <audio id="remoteAudio" style="display: none"></audio>

                <div>
                    <canvas id="phone-waveform" style="width: 250px;height: 40px;background-color: #56585a"></canvas>
                </div>

                <div style="position: relative;top: -40px;margin-bottom: -40px;float: left;width: 100%;">
                    <span id="phoneStatus" class="tag"></span>
                </div>

                <div class="call-row">
                    <a class="button is-large">1</a>
                    <a class="button is-large">2</a>
                    <a class="button is-large">3</a>
                </div>

                <div class="call-row">
                    <a class="button is-large">4</a>
                    <a class="button is-large">5</a>
                    <a class="button is-large">6</a>
                </div>

                <div class="call-row">
                    <a class="button is-large">7</a>
                    <a class="button is-large">8</a>
                    <a class="button is-large">9</a>
                </div>

                <div>
                    <a class="button is-large">*</a>
                    <a class="button is-large">0</a>
                    <a class="button is-large">#</a>
                </div>

            </div>
        </div>
    </div>

    <footer>

        <div id="controls-call-inactive">

            <div class="field has-addons">

                <div class="control is-expanded has-icons-left">
                    <input id="phoneNumber" data-localize="phoneNumber_field"
                           class="input is-medium" type="text" placeholder="Digite o número">
                    <span class="icon is-left">
                            <i class="fa fa-hashtag"></i>
                        </span>
                </div>

                <div class="control">
                    <a id="btnCall" type="button" class="button is-medium is-success" disabled>
                            <span class="icon is-small">
                                <i class="fa fa-chain-broken"></i>
                            </span>
                    </a>

                </div>
            </div>
        </div>

        <div id="controls-call-active">
            <p class="field">

                <a id="btnMute" class="button is-primary is-outlined">
                        <span class="icon">
                            <i class="fa fa-microphone-slash"></i>
                        </span>
                    <span data-localize="mute">Mute</span>
                </a>

                <a id="btnHold" class="button is-primary is-outlined">
                        <span class="icon is-small">
                            <i class="fa fa-stop"></i>
                        </span>
                    <span data-localize="hold">Hold</span>
                </a>

                <a id="btnStopCall" class="button is-danger is-right">
                    <span data-localize="cancel">Cancel</span>
                    <span class="icon is-small">
                            <i class="fa fa-close"></i>
                        </span>
                </a>
            </p>

        </div>

    </footer>
</div>

<div id="overlay">
    <nav id="nav-call-in">
        <ul>
            <li>
                <h1 class="title" data-localize="status_call_in">New Call</h1>
                <h2 class="subtitle"></h2>
            </li>
            <li>
                <div>
                    <div class="calling ball-scale-multiple">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </li>
            <li><a class="button is-danger cancel" href="#" data-localize="cancel">Cancel</a></li>
            <li><a class="button is-success answer" href="#" data-localize="answer">Answer</a></li>
        </ul>
    </nav>

    <nav id="nav-call-out">
        <ul>
            <li><h1 class="title" data-localize="status_call_out">Calling...</h1></li>
            <li>
                <div>
                    <div class="calling ball-scale-multiple">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </li>
            <li><a class="button is-danger cancel" href="#" data-localize="cancel">Cancel</a></li>
        </ul>

    </nav>
</div>


HTML,

    'css' => <<<CSS
           
          audio #remoteAudio{
            display: none;
        }

        canvas #phone-waveform{
            width: 250px;
            height: 40px;
            background-color: #56585a;
        }

        div .status{
            position: relative;
            top: -40px;
            margin-bottom: -40px;
            float: left;
            width: 100%;
        }
CSS,


    ];



    public function codes()
    {

        $this ->htm = strtr($this ->_layout['phone'],[]);
        $this->css = strtr($this->_layout['css'],[]);
    }

}
