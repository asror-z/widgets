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


class ZRecaptchaWidgetXX extends ZWidget
{


    public $config = [];
    public $_config = [
        'type' => ZRecaptchaWidgetX::type['v2-checkbox'],
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
    <div id="{id}" ></div>
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
                'sitekey' : '6LfdxbsZAAAAAF3_LYwYRvfBojanNdpV6VinZ2wX',
                'theme' : 'dark light',
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
        $this->fileJs('https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit');
    }


    public function codes()
    {

        //vdd($this->value);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->jscode($this->id),
        ]);


        $this->htm = strtr($this->_layout['v2-checkbox'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
        ]);





    }
}
