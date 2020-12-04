<?php
/**
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 *
 * Created By: MurodovMirbosit
 *
 * Class ZInputNumberWidget
 * https://github.com/wpic/bootstrap-number-input/blob/master/screenshot.png
 */

namespace zetsoft\widgets\market;

use zetsoft\system\kernels\ZWidget;

class ZInputNumberWidget extends ZWidget
{
   public $config = [];
   public $_config = [
   ];
    /*
       public $event = [];
       public $_event = [];*/

    public function asset()
    {
        $this->fileJs('/render/market/ZInputNumberWidget/assets/js/main_01.js');
        $this->fileCss('/render/market/ZInputNumberWidget/assets/css/style_01.css');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
         <div class="col-md-3">
            <div class='ctrl'>
                <button class='ctrl-button ctrl-button-decrement'>-</button>
                <div class='ctrl-counter'>
                    <input class='ctrl-counter-input' maxlength='10' type='text' value='0'>
                    <div class='ctrl-counter-num'>0</div>
                </div>
                <button class='ctrl-button ctrl-button-increment'>+</button>
            </div>
        </div>

HTML,
    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], []);
    }
}
