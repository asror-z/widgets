<?php

/**
 *
 * Class ZCatcDisplaceWidget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: ElnurController Suyunov
 * Refactored: Asror Zakirov;
 * Refactored: Xakimjon Ergashov;
 */

namespace zetsoft\widgets\actions;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;


class ZRecaptchaWidgetX1 extends ZWidget
{


    public $config = [];
    public $_config = [
        'type' => ZRecaptchaWidgetX1::type['v2-checkbox'],
        'sitekey' => '6Lc26t8UAAAAAFofGeFQJhMmHQR3OexuG3vgP5Ph',
        'grapes' => true,
    ];

    /**
     *
     * Constants
     */

     public const type = [

         'v2-checkbox' => 'v2-checkbox',
         'v2-invisible' => 'v2-invisible',

     ];

     public $layout = [];
     public $_layout =  [

         'v2-checkbox' => <<<HTML
        <form action="?" method="https://www.google.com/recaptcha/api/siteverify METHOD: POST">
    <div id="{id}"></div>
    <br>
    <!--<input id="input" type="submit" value="Submit1" name="{name}" disabled>-->
    <input id="{id}-hidden" type="hidden" name="{name}" value="0">
</form>

HTML,

         'v2-invisible' => <<<HTML
        <form action="?" method="https://www.google.com/recaptcha/api/siteverify METHOD: POST">
    <div id="v2-invisibleId"></div>
    <br>
    <input type="submit" value="Submit2">
</form>

HTML,
         'js' => <<<JS

         onloadCallback = function() {
            grecaptcha.render('{id}', {
                'sitekey' : '{site_key}',
                'callback' : function(result) {
                     $('#{id}-hidden').val(1);
                    console.log($('#{id}-hidden').val());
                },
            });
            
        };
        
           

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


        $this->htm = strtr($this->_layout['v2-checkbox'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{site_key}' => $this->_config['sitekey'],
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
        ]);





    }
}
