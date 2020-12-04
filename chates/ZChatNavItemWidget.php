<?php

namespace zetsoft\widgets\chates;

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
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZChatNavItemWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
       'grapes' => true,
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        
    ];
    public $layout = [];
    public $_layout = [

        'navigation' => <<<HTML
      <div class="layout"  {readonly}>

            <!-- Navigation -->
            <div class="navigation navbar-light justify-content-center py-xl-7">

                <!-- Brand -->
                <a href="#!" class="d-none d-xl-block mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="" x="0px" y="0px" viewBox="0 0 46 46" enable-background="new 0 0 46 46" xml:space="preserve" class="injected-svg mx-auto fill-primary" style="height: 46px;">
    <polygon opacity="0.7" points="45,11 36,11 35.5,1 "></polygon>
    <polygon points="35.5,1 25.4,14.1 39,21 "></polygon>
    <polygon opacity="0.4" points="17,9.8 39,21 17,26 "></polygon>
    <polygon opacity="0.7" points="2,12 17,26 17,9.8 "></polygon>
    <polygon opacity="0.7" points="17,26 39,21 28,36 "></polygon>
    <polygon points="28,36 4.5,44 17,26 "></polygon>
    <polygon points="17,26 1,26 10.8,20.1 "></polygon>
</svg>
                </a>

                <!-- Menu -->
                <ul class="nav navbar-navs flex-row flex-xl-column   pl-3 flex-grow-1 justify-content-xl-between justify-content-xl-center py-3 py-lg-0" role="tablist">

                    <!-- Invisible item to center nav vertically -->
                    <li class="nav-item d-none d-xl-block invisible flex-xl-grow-1">
                        <a class="nav-link position-relative p-0 py-xl-3" href="https://themes.2the.me/Messenger-1.1/chat-2.html#" title="">
                            <i class="icon-lg fe-x"></i>
                        </a>
                    </li>

                    <!-- Create group -->
                    <li class="nav-item">
                        <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#!" title="Create chat" role="tab">
                            <i class="far fa-edit"></i>
                        </a>
                    </li>

                    <!-- Friend -->
                    <li class="nav-item mt-xl-9">
                        <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#!" title="Friends" role="tab">
                            <i class="fas fa-user-friends"></i>
                        </a>
                    </li>

                    <!-- Chats -->
                    <li class="nav-item mt-xl-9">
                        <a class="nav-link position-relative p-0 py-xl-3 active" data-toggle="tab" href="#!" title="Chats" role="tab">
                            <i class="far fa-comment-alt"></i>
                            <div class="badge badge-dot badge-primary badge-bottom-center"></div>
                        </a>
                    </li>

                    <!-- Profile -->
                    <li class="nav-item mt-xl-9">
                        <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#!" title="User" role="tab">
                            <i class="far fa-user"></i>
                        </a>
                    </li>

                    <!-- Demo only: Documentation -->
                    <li class="nav-item mt-xl-9 d-none d-xl-block flex-xl-grow-1">
                        <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#!" title="Demos" role="tab">
                            <i class="fas fa-layer-group"></i>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="nav-item mt-xl-9">
                        <a class="nav-link position-relative p-0 py-xl-3" href="#!" title="Settings">
                            <i class="icon-lg fe-settings"></i>
                        </a>
                    </li>

                </ul>
                <!-- Menu -->

            </div>
            <!-- Navigation -->
</div>
HTML,
        'css' => <<<CSS
.navbar-navs{
margin-top:200% !important;
    width:5%;
  min-height: min-content;
  
}
.layout{

background:white;
width:5%;
    height:900px;
}
.navigation{
margin-left:25px;
margin-top:10%;
height:900px
}
      
CSS,

    ];


    /**
     *
     * Constants
     */
    

    public function asset()
    {
       // $this->fileJs('/render/chates/@/NoWidget/chats/content-demo_files/plugins.bundle.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/Uniform.js/4.3.0/js/jquery.uniform.bundled.js');
    }


   


    public function codes()
    {

        $this->htm .= strtr($this->_layout['navigation'],[

//            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
    ]);
        $this->css = $this->_layout['css'];
    }

}
