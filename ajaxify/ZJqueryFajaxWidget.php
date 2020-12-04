<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\ajaxify;

use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZIconPickerWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZJqueryFajaxWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [


        'url' => '',
        'method' => 'POST',
        'grapes' => true,

    ];

    /**
     *
     * Constants
     */
    public const type = [
        /*  'buttonIconPicker' => 'buttonIconPicker',
          'divIconPicker' => 'divIconPicker',
          'inputIconPicker' => 'inputIconPicker',*/
    ];


    public $event = [];
    public $_event = [
        /*        'click' => ' console.log("self | $eventClick") ',
                'dblclick' => ' console.log("self | $eventDblclick") ',
                'mouseenter' => ' console.log("self | $eventMouseEnter") ',
                'mouseleave' => ' console.log("self | $eventMouseLeave") ',
                'keyup' => ' console.log("self | $eventKeyup") ',*/
    ];

    public $layout = [];
    public $_layout = [
        'html' => <<<HTML
<div class="ui container"  '>
    <div class="ui form">
        <form action="{url}" method="{method}">

            <div class="field">
                <label>Fullname</label>
                <input type="text" name="fullname" placeholder="Amon Bower">
            </div>

            <div class="field">
                <label>Phone</label>
                <input type="text" name="phone" placeholder="+7 (999) 123-456-789">
            </div>

            <div class="field">
                <label>Text</label>
                <textarea name="text" placeholder="Enter your comments"></textarea>
            </div>

            <div class="field">
                <label for="attach" style="color: #fff" class="ui green button">Attach file</label>
                <input type="file" name="attach" id="attach" style="display:none">
            </div>

            <div class="inline fields">
                <label>Choose your gender</label>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" value="male" name="gender" checked="checked">
                        <label for="gender">Male</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" value="female" name="gender">
                        <label>Female</label>
                    </div>
                </div>
            </div>

            <div class="ui segment">
                <div class="field">
                    <div class="ui toggle checkbox">
                        <input type="checkbox" name="checkbox" tabindex="0" class="hidden">
                        <label>Do you wana test the checkbox (toggle check)?</label>
                    </div>
                </div>
            </div>

            <div class="field">
                <button type="submit" class="ui fluid big submit button">Send form</button>
            </div>
        </form>
        
        <div class="ui hidden message">
            <div class="header">Form Completed!</div>
            <p>Your form successfully sent!</p>
        </div>
        <p>Check the response using your browsers JavaScript console.</p>
    </div>

</div>
HTML,

        'js' => <<<JS
            
             $('form').fajax({
        success: function () {
            alert('The form was successfully sent');
        },
    });
JS,

        'css' => <<<CSS
        .container {
            margin: 100px;
            width: 450px !important;
        }
CSS,

    ];

    public function asset()
    {

        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.4/semantic.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery.fajax@1.1.6/dist/jquery.fajax.js');
        $this->fileJs('https://cdn.statically.io/gh/aziev/jquery.fajax/v1.1.0/asset/main.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.4/semantic.min.js');

    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['html'], [
            '{url}' => $this->_config['url'],
            '{method}' => $this->_config['method'],
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
        ]);
        $this->css = $this->_layout['css'];
        $this->js = $this->_layout['js'];

    }


}
