<?php


namespace zetsoft\widgets\audios;


use zetsoft\system\kernels\ZWidget;

class ZGspeechWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'grapes' => true,
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

        <div  '>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos beatae similique placeat culpa voluptas sed, iste commodi animi enim recusandae harum ratione ab, aut deleniti ipsum tempora, facilis vero unde?</div>

    
    
    
    <span id="sexy_tooltip_title" style="display: none; left: 479.5px; opacity: 2.22045e-16; top: 761px;">
             <span class="the-tooltip top left dark-midnight-blue">
                        <span class="tooltip_inner">Matnni eshitish uchun quyidagini bosing!</span>
             </span>
    </span>
            
    <span id="sexy_tooltip" left: 480px; opacity: 0.22045e-16; top: 761px;">
    <span
            class="the-tooltip bottom left dark-midnight-blue">
            <span
            class="tooltip_inner powered_by_3 powered_by"> </span></span>
            </span>
            
          

<div id="sound_container" class="sound_div sound_div_basic size_1 speaker_32" title=""
     style="left: 495px; top: 961px; transform: rotate(0deg); display: none; opacity: 1;">
    <div id="sound_text"></div>
</div>
<div id="sound_audio"></div>


HTML,
        'js' => <<<JS
    var s5_initial_load = 40;

    function s5_position_top() {
        document.getElementById("s5_top_area_bg").style.height = document.getElementById("s5_top_area_bg_img").offsetHeight + "px";
        if (document.getElementById("s5_floating_menu_spacer") && document.getElementById("s5_menu_move")) {
            document.getElementById("s5_floating_menu_spacer").id = "s5_menu_spacer";
            document.getElementById("s5_menu_move").id = "s5_floating_menu_spacer";
        }
    }

    jQuery(document).ready(function () {
        s5_position_top();
    });
    jQuery(window).resize(s5_position_top);
    var s5_component_height = 0;
    var s5_tallest_column = 0;

    function s5_set_column_heights() {
        if (document.getElementById("s5_component_call_wrap_inner")) {
            if (document.getElementById("s5_pos_custom_2")) {
                document.getElementById("s5_pos_custom_2").style.minHeight = "auto";
            }
            if (document.getElementById("s5_left_wrap_inner")) {
                document.getElementById("s5_left_wrap_inner").style.minHeight = "auto";
            }
            if (document.getElementById("s5_right_wrap_inner")) {
                document.getElementById("s5_right_wrap_inner").style.minHeight = "auto";
            }
            s5_tallest_column = 0;

            if (document.getElementById("s5_pos_custom_2")) {
                if (document.getElementById("s5_pos_custom_2").offsetHeight > s5_tallest_column) {
                    s5_tallest_column = document.getElementById("s5_pos_custom_2").offsetHeight;
                }
            }
            if (document.getElementById("s5_right_wrap_inner")) {
                if (document.getElementById("s5_right_wrap_inner").offsetHeight > s5_tallest_column) {
                    s5_tallest_column = document.getElementById("s5_right_wrap_inner").offsetHeight;
                }
            }
            if (document.getElementById("s5_left_wrap_inner")) {
                if (document.getElementById("s5_left_wrap_inner").offsetHeight > s5_tallest_column) {
                    s5_tallest_column = document.getElementById("s5_left_wrap_inner").offsetHeight;
                }
            }
            if (document.getElementById("s5_left_inset_wrap")) {
                if ((document.getElementById("s5_left_inset_wrap").offsetHeight-25) > s5_tallest_column) {
                    s5_tallest_column = document.getElementById("s5_left_inset_wrap").offsetHeight-25;
                }
            }
            if (document.getElementById("s5_right_inset_wrap")) {
                if ((document.getElementById("s5_right_inset_wrap").offsetHeight-25) > s5_tallest_column) {
                    s5_tallest_column = document.getElementById("s5_right_inset_wrap").offsetHeight-25;
                }
            }
            s5_component_height = document.getElementById("s5_component_call_wrap_inner").offsetHeight;
            if (document.getElementById("s5_component_call_wrap_inner").offsetHeight > s5_tallest_column) {
                s5_tallest_column = document.getElementById("s5_component_call_wrap_inner").offsetHeight;
            }

            if (document.getElementById("s5_pos_custom_2")) {
                document.getElementById("s5_pos_custom_2").style.minHeight = s5_tallest_column + "px";
            }
            if (document.getElementById("s5_left_wrap_inner")) {
                document.getElementById("s5_left_wrap_inner").style.minHeight = s5_tallest_column + "px";
            }
            if (document.getElementById("s5_right_wrap_inner")) {
                document.getElementById("s5_right_wrap_inner").style.minHeight = s5_tallest_column + "px";
            }
        }
        window.setTimeout(s5_set_column_heights, 500);
    }

    jQuery(document).ready(function () {
        s5_set_column_heights();
    });
    jQuery(window).resize(s5_set_column_heights);
    
    var players = new Array(),
        blink_timer = new Array(),
        rotate_timer = new Array(),
        lang_identifier = 'ru',
        selected_txt = '',
        sound_container_clicked = false,
        sound_container_visible = true,
        blinking_enable = true,
        basic_plg_enable = true,
        pro_container_clicked = false,
        streamerphp_folder = '/render/audios/assets/audio/gspeech/',
        translation_tool = 'g',
        //translation_audio_type = 'audio/x-wav',
        translation_audio_type = 'audio/mpeg',
        speech_text_length = 100,
        blink_start_enable_pro = true,
        createtriggerspeechcount = 0,
        speechtimeoutfinal = 0,
        speechtxt = '',
        userRegistered = "0",
        gspeech_bcp = ["#ffffff", "#ffffff", "#ffffff", "#ffffff", "#ffffff"],
        gspeech_cp = ["#111111", "#3284c7", "#fc0000", "#0d7300", "#ea7d00"],
        gspeech_bca = ["#545454", "#3284c7", "#ff3333", "#0f8901", "#ea7d00"],
        gspeech_ca = ["#ffffff", "#ffffff", "#ffffff", "#ffffff", "#ffffff"],
        gspeech_spop = ["90", "80", "90", "90", "90"],
        gspeech_spoa = ["100", "100", "100", "100", "100"],
        gspeech_animation_time = ["400", "400", "400", "400", "400"];
JS
    ];

    public function asset()
    {
        /*   
         *
         *
         *
         *              
         *  <link rel="stylesheet" href="/render/audios/assets/audio/gspeech/includes/css/gspeech.css" type="text/css">
            <link rel="stylesheet" href="/render/audios/assets/audio/gspeech/includes/css/the-tooltip.css" type="text/css">



            <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js" type="text/javascript"
                    style="color: rgb(0, 0, 0);"></script>
            <script src="/render/audios/assets/audio/gspeech/includes/js/color.js" type="text/javascript"></script>
            <script src="/render/audios/assets/audio/gspeech/includes/js/jQueryRotate.2.1.js" type="text/javascript"></script>
            <script src="/render/audios/assets/audio/gspeech/includes/js/easing.js" type="text/javascript"></script>
            <script src="/render/audios/assets/audio/gspeech/includes/js/mediaelement-and-player.min.js"
                    type="text/javascript"></script>
            <script src="/render/audios/assets/audio/gspeech/includes/js/gspeech.js?version=2.0.1"
                    type="text/javascript"></script>
            <script src="/render/audios/assets/audio/gspeech/includes/js/gspeech_pro.js?version=2.0.1"
                    type="text/javascript"></script>



            <!-- Resize column function -->

            <script type="text/javascript"
                    src="/render/audios/assets/audio/gspeech/audio/s5_columns_equalizer-min.js"></script>
         <script type="text/javascript" src="/render/audios/assets/audio/gspeech/audio/orphus.js"></script>
        <script type="text/javascript" src="/render/audios/assets/audio/gspeech/audio/share42.js"></script>


        <script defer src="/render/audios/assets/audio/gspeech/includes/js/nwmatcher-1.2.4-min.js"></script>
        <script defer src="/render/audios/assets/audio/gspeech/includes/js/selectivizr-min.js"></script>


         */

        $this->fileCss('/render/audios/assets/audio/gspeech/includes/css/gspeech.css');
        $this->fileCss('/render/audios/assets/audio/gspeech/includes/css/the-tooltip.css');
        $this->fileCss('/render/audios/assets/audio/gspeech/audio/template(1).css');
        $this->fileCss('/render/audios/assets/audio/gspeech/New folder/css/tooltip.css');
        $this->fileJs("https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js");

        $this->fileJs('https://ghcdn.rawgit.org/brehaut/color-js/master/color.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jqueryrotate-slevomat-fork@1.0.0/jQueryRotate.js');

        $this->fileJs('https://cdn.jsdelivr.net/npm/easing@1.2.1/browser-easing.js');
        $this->fileJs('/render/audios/assets/audio/gspeech/includes/js/mediaelement-and-player.min.js');
        $this->fileJs('/render/audios/assets/audio/gspeech/includes/js/gspeech.js');
        $this->fileJs('/render/audios/assets/audio/gspeech/includes/js/gspeech_pro.js');
        $this->fileJs('/render/audios/assets/audio/gspeech/includes/js/s5_columns_equalizer-min.js');
        $this->fileJs('/render/audios/assets/audio/gspeech/includes/js/orphus.js');
        $this->fileJs('/render/audios/assets/audio/gspeech/includes/js/share42.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/selectivizr@1.0.3/selectivizr.min.js');

    }

    public function codes()
    {


        $this->htm = strtr($this->_layout['main'], [
            
        ]);

        $this->js = strtr($this->_layout['js'], []);


    }


}
