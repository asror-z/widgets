<?php

/**
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 * Created by:  Olim Sattorov
 *
 * https://github.com/wstoettinger/jquery.emojiarea.js
 * https://www.jqueryscript.net/demo/Emoji-Picker-For-Textarea-jQuery-Emojiarea/
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;

class ZJqueryEmojiareaJsWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'placement' => 'z',

    ];


    public $event = [];
    public $_event = [
        'click' => ' console.log("self | $eventClick") ',
        'dblclick' => ' console.log("self | $eventDblclick") ',
        'mouseenter' => ' console.log("self | $eventMouseEnter") ',
        'mouseleave' => ' console.log("self | $eventMouseLeave") ',
        'keyup' => ' console.log("self | $eventKeyup") ',
    ];

    public function asset()
    {
        /*$this->fileCss('/render/inputes/ZJqueryEmojiareaJsWidget/assets/style.css');*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery.emojiarea.js@0.1.8-beta/dist/reset.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery.emojiarea.js@0.1.8-beta/dist/jquery.emojiarea.min.js');
    }

    public $layout = [];
    public $_layout = [
        'buttonIconPicker' => <<<HTML
           <div class="example"  {readonly}>
                <div data-global-picker="false" data-type="unicode" data-emojiarea="">
                <div class="emoji-button">😄</div>
                <textarea id="{id}-textarea" name="{name}" value="{value}" rows="5">{value}</textarea>
           </div>
               <h3>Value:</h3>
               <div class="value">
               <pre id="value"></pre></div>
    
</div>   
HTML,
        'js' => <<<JS
$(document).ready(function() {
        $('#{id}-textarea').on('input', function() {
            $('#value').text($('#{id}-textarea').val());
        });
        $('#value').text($('#{id}-textarea').val());  
        });
        $( ".emoji-group" ).scrollTop( 100 );
        
JS,


    ];


    public function codes()
    {

    

        $this->htm .= strtr($this->_layout['buttonIconPicker'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}' => $this->value,
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{value}' => $this->modelCheck() ? $this->value : '',
        ]);
        

    }


}
