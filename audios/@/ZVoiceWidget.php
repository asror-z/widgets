<?php

namespace zetsoft\widgets\audios;

/*use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use kartik\widgets\Select2;
use yii\web\JsExpression;*/

/**
 *
 * Class ZKSelect2Widget
 * https://nbu.uz/uz/#
 * http://library.zettest.uz/render/Actions/voice/clean.html#
 *
 * Created By: Anvar Ibodullayyev
 * Refactored: Asror Zakirov
 */

use zetsoft\system\kernels\ZWidget;


class ZVoiceWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="specials">
        <a href="#" class="switcher"><span>Maxsus imkoniyatlar</span></a>
        <div class="spec_popup">
            <form>
                <ul>
                    <li>
                        <label>
                            <input type="checkbox" id="variantDefault" value="spec" name="name" class="itemRadio" checked="">
                            <span></span>
                            Ovoz berishni o'chirish                </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" value="spec" name="name" class="voice_on" id="voiceon" data-instruction="Hurmatli foydalanuvchilar! Saytda ovoz jo‘rligidan foydalanish imkoniyati mavjud. Ushbu funksiyadan foydalanish uchun kerakli matnni belgilang">
                            <span></span>
                            Ovoz berishni yoqish                  </label>
                    </li>
                </ul>
            </form>
        </div><!--end spec_popup-->
    </div><!--end specials-->
    <br><br>
HTML,

        'js' => <<<JS
           if(!window.BX)window.BX={};if(!window.BX.message)window.BX.message=function(mess){if(typeof mess=='object') for(var i in mess) BX.message[i]=mess[i]; return true;};
           
           (window.BX||top.BX).message({'LANGUAGE_ID':'uz','FORMAT_DATE':'DD.MM.YYYY','FORMAT_DATETIME':'DD.MM.YYYY HH:MI:SS','COOKIE_PREFIX':'BITRIX_SM','SERVER_TZ_OFFSET':'18000','SITE_ID':'uz','SITE_DIR':'/uz/','USER_ID':'','SERVER_TIME':'1575882563','USER_TZ_OFFSET':'0','USER_TZ_AUTO':'Y','bitrix_sessid':'00323c8b1c0bc02640fc48038898635c'});
           
           var _ba = _ba || []; _ba.push(["aid", "837748865ce1915bbffd04f3ca3eedd6"]); _ba.push(["host", "nbu.uz"]); (function() {var ba = document.createElement("script"); ba.type = "text/javascript"; ba.async = true;ba.src = (document.location.protocol == "https:" ? "https://" : "http://") + "bitrix.info/ba.js";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(ba, s);})();
JS,

        'css' => <<<CSS
    .myClass  {
        background:#e3334d;
    }
CSS,
    ];

    public function asset()
    {


        $this->fileCss('/render/Actions/voice/voice_files/material.css');
        $this->fileJs('/render/Actions/voice/voice_files/jquery-ui.min.js');
        $this->fileJs('/render/Actions/voice/voice_files/custom.js');
        $this->fileJs('/render/Actions/voice/voice_files/responsive-table.js');
        $this->fileJs('/render/Actions/voice/voice_files/select2.full.min.js"');
        $this->fileJs('/render/Actions/voice/voice_files/newscript.js');
        $this->fileJs('/render/Actions/voice/voice_files/script.js(1)');
        
    }


   


    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], []);
        $this->js = strtr($this->_layout['js'], []);
        $this->css = strtr($this->_layout['css'], []);


    }

}
