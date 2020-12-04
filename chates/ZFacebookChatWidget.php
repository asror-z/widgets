<?php
namespace zetsoft\widgets\chates;
use zetsoft\system\kernels\ZWidget;


/**
 *
 *
 * Author:  Obidov Yasin
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

class ZFacebookChatWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'grapes' => true
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

        'main' => <<<HTML
        <div class="col-lg-3 border-let heig_box"  {readonly}>
                <div class="messeng">
                <div>
                    <div class="chat_nastroyka d-flex justify-content-between align-items-center">
                        <div class="chat_image d-flex align-items-center">
                            <div class="bosh_div"></div>
                            <h1>Chats</h1>
                        </div>
                        <div class="chat_icon_nav d-flex align-items-center">
                            <!-- Basic dropdown -->
                            <button class="btni  dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"
                                    id="myBtn"><i class="fas fa-cog"
                            ></i></button>

                            <div class="dropdown-menu"
                                 id="myDropMenu">
                                <a class="dropdown-item" href="#">Active contacts</a>
                                <a class="dropdown-item" href="#">Message requests</a>
                                <a class="dropdown-item" href="#">Hidden chats</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Help</a>
                                <a class="dropdown-item" href="#">Report a Problem</a>
                            </div>


                            <!-- Basic dropdown -->
                            <div class="div"><a href="#!"><i class="fa fa-pencil-square-o"
                                                             aria-hidden="true"></i></a></div>
                        </div>
                    </div>
                    <input type="search" placeholder="Search Messanger">
                </div>

                    <div id="wrapper">
                        <div class="scrollbar" id="style-6">
                            <div class="force-overflow">

                                <div class="chats_people">
                                    <div class="people d-flex align-items-center ">
                                        <div class="img_box">
                                            <img src="#!" alt="">
                                        </div>
                                        <div class="who_is">
                                            <p class="bolt">Hasan Obidov</p>
                                            <div class="ti  me d-flex ">
                                                <p class="regul">yahshimisiz birodar </p>
                                                <p class="timer"> 9:16</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="chats_people">
                                    <div class="people d-flex align-items-center ">
                                        <div class="img_box">
                                            <img src="#!" alt="">
                                        </div>
                                        <div class="who_is">
                                            <p class="bolt">Abdurahmon Alimov</p>
                                            <p class="regul">You: qalesan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="chats_people">
                                    <div class="people d-flex align-items-center active">
                                        <div class="img_box">
                                            <img src="#!" alt="">
                                        </div>
                                        <div class="who_is">
                                            <p class="bolt">Xusan Alimovich</p>
                                            <p class="regul">You: qalesan</p>
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
        $(document).ready(function () {
        $("#example1").emojioneArea({
            standalone: false,
            emojiPlaceholder: ":smile_cat:"

        });
    });
    function myFunction() {
        document.getElementById("sidebar1").style.display = "flex";
    }
   
JS,
        'css' => <<<CSS

        
   
   
CSS,

    ];


    /**
     *
     * Constants
     */


    public function asset()
    {
        $this->fileCss('/render/chates/ZFacebookChatWidget/assets/style.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/emojionearea@3.4.1/dist/emojionearea.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/emojionearea@3.4.1/dist/emojionearea.min.js');
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout["main"], [
            
        ]);
        $this->js = $this->_layout['js'];
        $this->css =$this->_layout['css'];


    }

}
