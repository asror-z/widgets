<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZStarDobtcoWidget2 extends ZWidget
{

    public $config = [];
    public $_config = [

    ];

    public const type = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        
<div class="container">
    <h5>Click to rate:</h5>
    <div class='starrr' id='star1'></div>
    <div>&nbsp;
        <span class='your-choice-was' style='display: none;'>
        Your rating was <span class='choice'><input type="hidden" class="star" id="{id}-star1" name="{name}" value="{value}"/></span>.
      </span>
    </div>
</div>
HTML,

        'type1' => <<<CSS
      input {
            width: 30px;
            margin: 10px 0;
        }
        .starrr {
            display: inline-block; }
        .starrr a {
            font-size: 16px;
            padding: 0 1px;
            cursor: pointer;
            color: #FFD119;
            text-decoration: none; }           
CSS,

        'jscode' => <<<JS
$('#star1').starrr({
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });

JS,





    ];

    public function asset()
    {
        $this->fileJs("/render/market/ZStarDobtco/assets/js/main1.js");
    }

    public function codes()
    {


            $this->htm .= strtr($this->_layout['main'], [
             '{id}' => $this->id,
             '{name}' => $this->name,
             '{value}' => $this->value,
           ]);


        $this->css = $this->_layout['type1'];

        $this->js = strtr($this->_layout['jscode'], [
        ]);
        
    }
}
