<?php

/**
 *
 *
 * Author: Zulpanov Ibrohim
 * http://cbu.uz/uzc/
 *
 *
 */

namespace zetsoft\widgets\audios;


use zetsoft\system\kernels\ZWidget;

class ZSpeakerWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => ZSpeakerWidget::type['Russian Female'],
        'icon' => '/render/audios/assets/audio/responciveVoice/rupor.png',
        'bg_color' => '#000000',
         'grapes' => true,



    ];
    public const type = [
        'UK English Female' => 'UK English Female',
        'UK English Male' => 'UK English Male',
        'US English Female' => 'US English Female',
        'Spanish Female' => 'Spanish Female'
        , 'French Female' => 'French Female'
        , 'Deutsch Female' => 'Deutsch Female'
        , 'Italian Female' => 'Italian Female'
        , 'Greek Female' => 'Greek Female'
        , 'Hungarian Female' => 'Hungarian Female'
        , 'Russian Female' => 'Russian Female'
        , 'Dutch Female' => 'Dutch Female'
        , 'Swedish Female' => 'Swedish Female'
        , 'Japanese Female' => 'Japanese Female'
        , 'Korean Female' => 'Korean Female'
        , 'Chinese Female' => 'Chinese Female'
        , 'Hindi Female' => 'Hindi Female'
        , 'Serbian Male' => 'Serbian Male'
        , 'Croatian Male' => 'Croatian Male'
        , 'Bosnian Male' => 'Bosnian Male'
        , 'Romanian Male' => 'Romanian Male'
        , 'Fallback UK Female' => 'Fallback UK Female',
    ];

    public function asset()
    {
        
        $this->fileJs('/render/audios/assets/audio/responciveVoice/jquery.liTranslit.js');
        $this->fileJs('/render/audios/assets/audio/responciveVoice/responsivevoice.js');

/*        $this->fileJs('/render/audios/assets/audio/gspeech/includes/js/s5_columns_equalizer-min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/equalize.js/1.0.2/equalize.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.16/mediaelement.min.js');*/

    }

    public $layout = [];
    public $_layout =[

        'main' => <<<HTML
            <div id="rv_spk" onselectstart="return true" class="load_rv" '   class="btn btn-secondary" data-icon="fas fa-map-marker-alt" {readonly}></div>
            <span id="yz-text" style="overflow-wrap: break-word;"></span>
HTML,
'css' => <<<CSS
#rv_spk {
    position: absolute;
    left: -9999px;
    top: -9999px;
    /*font-size: 3em;*/
    cursor: pointer;
    z-index: 1100;
    width: 50px;
    height: 50px;
    border-radius: 50px;
    line-height: 47px;
    text-align: center;
    background: {bg_color} url({icon}) 50% 50% no-repeat;
    -webkit-background-size: 28px;
    background-size: 28px;
    -webkit-box-shadow: 1px 2px 10px rgba(0, 0, 0, 0.3);
    box-shadow: 1px 2px 10px rgba(0, 0, 0, 0.3);
}
.vd_chat-menu{
    background-color: #3d799c;
}
#yz-text{
display: none;
}
CSS,

];

    public function codes()
    {
        
        $this->js = <<<JS
    $("#rv_spk").on('mousedown', function() {
        return false;
    });

    function speak() {
        $('#rv_spk').select(function () {
            return false;
        });
        var selection;
        var rv_text;
        $(window).mouseup(function (event) {
            var xPos = e.pageX;
            var yPos = e.pageY;
            if (e.target.id != "rv_spk") {
                $("#rv_spk").css({
                    'left': xPos + 'px',
                    'top': yPos + 'px',
                });
            }
            if (window.getSelection) {
                selection = window.getSelection();
            } else if (document.selection) {
                selection = document.selection.createRange();
            }
            if (selection.isCollapsed == false) {
                $("#rv_spk").fadeIn('slow');
            } else {
                $("#rv_spk").hide().removeClass('load_rv');
                responsiveVoice.cancel();
            }
            // console.log(selection.toString());
            $('#yz-text').text(selection.toString());
            var str;
            $('#yz-text').liTranslit({
                reg: '"а"="a","и"="i","р"="r","ш"="ş","б"="b","й"="y","с"="s","ъ"="‘","в"="v","к"="k","т"="t","ғ"="g‘","г"="g","л"="l","у"="u","қ"="k","д"="d","м"="m","ф"="f","ў"="o‘","е"="e","н"="n","х"="x","ҳ"="h","ж"="j","о"="o","ц"="ts" ,"з"="z","п"="p","ч"="ç","я"="ya","нг"="ng","pub"="pu‘b"',
                /*elAlias: $('.demo2_translit'),*/
        translated: function (el, text, eventType) {
        str = text;
        str = str.replace(/_/g, " ");
                    // $('#test').text(str);
                }
    });
    // console.log(str);
rv_text = selection.toString();
rv_text = str;
});

$("#rv_spk").click(function (event) {
    responsiveVoice.speak(rv_text, "{$this->_config['type']}", {
                onstart: function () {
        $('#rv_spk').addClass('load_rv');
    }, onend: function () {
        $('#rv_spk').removeClass('load_rv');
    }
            });
        });
$('a, label, button, option').each(function () {
    $(this).click(function () {
        $('#yz-text').text($(this).text());
        $('#yz-text').liTranslit({
                    reg: '"а"="a","и"="i","р"="r","ш"="ş","б"="b","й"="y","с"="s","ъ"="‘","в"="v","к"="k","т"="t","ғ"="g‘","г"="g","л"="l","у"="u","қ"="k","д"="d","м"="m","ф"="f","ў"="o‘","е"="e","н"="n","х"="h","ҳ"="h","ж"="j","о"="o","ц"="ts" ,"з"="z","п"="p","ч"="ç","я"="ya","нг"="ng","pub"="pu‘b"',
                    /*elAlias: $('.demo2_translit'),*/
                    translated: function (el, text, eventType) {
            str = text;
            str = str.replace(/_/g, " ");
                        // $('#test').text(str);
                    }
                });
                rv_text2 = $(this).text();
                rv_text2 = str;
                responsiveVoice.speak(rv_text2, "{$this->_config['type']}");
            }, function () {
        responsiveVoice.cancel();
        $('#yz-text').text('');
    });
})
    }

    window.onload = speak;
JS;

$this->htm = strtr($this->_layout['main'],[
    
    '{class}' => $this->_config['class'],
    '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
]);
$this->css = strtr($this->_layout['css'],[
 '{icon}' => $this->_config['icon'],
 '{bg_color}' => $this->_config['bg_color'],
 


]);


    }


}
