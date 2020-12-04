<?php

/**
 *
 *
 * Author:  MurodovMirbosit
 * Created By:ElnurController Suyunov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\animo;
use zetsoft\system\kernels\ZWidget;
class ZShakrmediaTuesdayWidget  extends ZWidget
{
    public $config = [];
    public $_config = [
    ];

    public $layout=[];
    public $_layout=[
       'main'=><<<HTML
    <div id="page">
    <h1 class="animated tdDropInLeft">It's Tuesday.</h1>
    <h2 class="animated tdDropInLeft"> Shakrmedia Tuesday CSS Animation Library Worked!</h2>
    <div class="container entrances">
        <h2>Entrances</h2>
        <div class="button-row">
            <form>
                <select class="animationlist">
                    <optgroup label="FadeIn">
                        <option value="tdFadeIn">tdFadeIn</option>
                        <option value="tdFadeInDown">tdFadeInDown</option>
                        <option value="tdFadeInLeft">tdFadeInLeft</option>
                        <option value="tdFadeInUp">tdFadeInUp</option>
                        <option value="tdFadeInRight">tdFadeInRight</option>
                    </optgroup>
                    <optgroup label="ExpandIn">
                        <option value="tdExpandIn">tdExpandIn</option>
                        <option value="tdExpandInBounce">tdExpandInBounce</option>
                    </optgroup>
                    <optgroup label="ShrinkIn">
                        <option value="tdShrinkIn">tdShrinkIn</option>
                        <option value="tdShrinkInBounce">tdShrinkInBounce</option>
                    </optgroup>
                    <optgroup label="StampIn">
                        <option value="tdStampIn">tdStampIn</option>
                        <option value="tdStampInSwing">tdStampInSwing</option>
                    </optgroup>
                    <optgroup label="SwingIn">
                        <option value="tdSwingIn">tdSwingIn</option>
                    </optgroup>
                    <optgroup label="DropIn">
                        <option value="tdDropInLeft">tdDropInLeft</option>
                        <option value="tdDropInRight">tdDropInRight</option>
                    </optgroup>
                    <optgroup label="PlopIn">
                        <option value="tdPlopIn">tdPlopIn</option>
                        <option value="tdPlopInDown">tdPlopInDown</option>
                        <option value="tdPlopInUp">tdPlopInUp</option>
                    </optgroup>
                    <optgroup label="HingeFlip">
                        <option value="tdHingeFlipIn" selected="">tdHingeFlipIn</option>
                    </optgroup>
                </select>
                <button class="reset">Reset</button>
            </form>
        </div>
        <div class="target animated tdSwingIn">
        Shakrmedia Tuesday
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </div>
        <div class="guide"></div>
    </div>
    <div class="container exits">
        <h2>Exits</h2>
        <div class="button-row">
            <form>
                <select class="animationlist">
                    <optgroup label="FadeOut">
                        <option value="tdFadeOut">tdFadeOut</option>
                        <option value="tdFadeOutDown">tdFadeOutDown</option>
                        <option value="tdFadeOutLeft">tdFadeOutLeft</option>
                        <option value="tdFadeOutUp">tdFadeOutUp</option>
                        <option value="tdFadeOutRight">tdFadeOutRight</option>
                    </optgroup>
                    <optgroup label="ExpandOut">
                        <option value="tdExpandOut">tdExpandOut</option>
                        <option value="tdExpandOutBounce">tdExpandOutBounce</option>
                    </optgroup>
                    <optgroup label="ShrinkOut">
                        <option value="tdShrinkOut">tdShrinkOut</option>
                        <option value="tdShrinkOutBounce">tdShrinkOutBounce</option>
                    </optgroup>
                    <optgroup label="SwingOut">
                        <option value="tdSwingOut">tdSwingOut</option>
                    </optgroup>
                    <optgroup label="HingeFlip">
                        <option value="tdHingeFlipOut" selected="">tdHingeFlipOut</option>
                    </optgroup>
                </select>

                <button class="button animate">Animate</button>
            </form>
        </div>
        <div class="target">
            Shakrmedia Tuesday
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </div>
        <div class="guide"></div>
    </div>
</div>
HTML,
        'js'=><<<JS
 $(document).ready(function(){
        $('button').click(function (event) {
            e.preventDefault();
            var that = this;
            var container = $(that).parents('.container');
            var currentAnimation = container.find('.animationlist').val();
            var target = container.children('.target');
            if ($(that).is('.animate')) {
                $(that).addClass('disabled').text('Animating...');
                target.addClass('animated '+currentAnimation);
                target.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (event) {
                    $(that).removeClass('disabled animate').addClass('reset').text('Reset');
                });
            } else {
                $(that).removeClass('reset').addClass('animate').text('Animate');
                target.attr('class', '').addClass('target');

            }

        });

        $('.animationlist').change(function(){
            var that = this;
            var container = $(that).parents('.container');

            container.find('button').attr('class', '').addClass('animate').text('Animate');
            container.children('.target').attr('class', '').addClass('target');
        });
    });
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-29552020-15', 'auto');
    ga('send', 'pageview'); 
JS,
    ];
    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/tuesday/1.2.3/tuesday.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/tuesday/1.2.3/tuesday.min.css');
        $this->fileJs('/render/Animo/ALL/CSS/Shakrmedia Tuesday/Shakrmedia Tuesday/html_files/analytics.js');
        $this->fileJs('/render/Animos/ALL/CSS/Shakrmedia Tuesday/Shakrmedia Tuesday/html_files/jquery-2.1.3.min.js');
        
       /* $this->fileCss('/publish/yarner/tuesday/build/tuesday.css');
        $this->fileCss('/publish/yarner/tuesday/build/tuesday.min.css');
        $this->fileJs('/render/Animo/ALL/CSS/Shakrmedia Tuesday/Shakrmedia Tuesday/html_files/analytics.js');
        $this->fileJs('/render/Animos/ALL/CSS/Shakrmedia Tuesday/Shakrmedia Tuesday/html_files/jquery-2.1.3.min.js');*/
    }
    public function codes()
    {
      $this->htm =strtr($this->_layout["main"],[]);
      $this->js = strtr($this->_layout["js"],[]);
    }

}


