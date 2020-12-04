<?php

/**
 *
 * Created By: Xakimjon Ergashov;
 */

namespace zetsoft\widgets\actions;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;


class ZRecaptchaWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZRecaptchaWidget::type['v2-checkbox'],
        'grapes' => false,
        'sitekey' => '6Lc26t8UAAAAAFofGeFQJhMmHQR3OexuG3vgP5Ph',
        'actionUrl' => ''
    ];

    /**
     *
     * Constants
     */

     public const type = [
         'v2-checkbox' => 'v2-checkbox',
         'v2-invisible' => 'v2-invisible',
         'auto' => 'auto',
     ];

     public $layout = [];
     public $_layout =  [

         'v2-checkbox' => <<<HTML
        <form action="{actionUrl}" method="https://www.google.com/recaptcha/api/siteverify METHOD: POST">
    <div id="{id}" class="g-recaptcha" data-sitekey="{site_key}"></div>
    <br>
    <!--<input id="input" type="submit" value="Submit1" name="{name}" disabled>-->
    <!--<input id="{id}-hidden" type="hidden" name="{name}" value="0">-->
</form>

HTML,

         'v2-invisible' => <<<HTML
        <form action="{actionUrl}" method="https://www.google.com/recaptcha/api/siteverify METHOD: POST">
    <div id="{id}"></div>
    <br>
    <input type="submit" value="Submit">
</form>

HTML,

    'auto' => <<<HTML
        <form action="{actionUrl}" method="POST">
      <div id="{id}" class="g-recaptcha" data-sitekey="{site_key}"></div>
      <br/>
      <input type="submit" value="Submit">
    </form>
HTML,

         'js' => <<<JS
         /*onloadCallback = function() {
            grecaptcha.render('{id}', {
                'sitekey' : '{site_key}',
                'callback' : function(result) {
                     $('#{id}-hidden').val(1);
                    console.log($('#{id}-hidden').val());
                },
            });
        };*/
        /*var checkbox =  document.getElementById('recaptcha-anchor');
        console.log(checkbox);
        console.log("checkbox");*/
JS

     ];

    public function asset()
    {
        $this->fileJs('https://www.google.com/recaptcha/api.js');
    }


    public function codes()
    {
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->jscode($this->id),
            '{site_key}' => $this->_config['sitekey']
        ]);

        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{actionUrl}' => $this->_config['actionUrl'],
            '{site_key}' => $this->_config['sitekey']
        ]);
    }
}
