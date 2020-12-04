<?php


/**
 *
 *
 * Author:  Asror Zakirov
 *
 */

namespace zetsoft\widgets\inputes;


use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZInputWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#input()-detail
 * https://mdbootstrap.com/docs/jquery/forms/inputs/
 *
 *
 * Clean Css By: Jasur Shukurov
 *
 */
class ZjQueryCustomCaretWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'placeholder' => 'ZJQueryCustomCaretWidget',

            ];

    public $event = [];
    public $_event = [
        'click' => "function(){console.log('{className} | click')}",
        'overCount' => "function (count, countable, counter) {
            console.log('{className} | This is max count');
            }"
    ];

    public function asset()
    {
        $this->fileJs("https://cdnjs.cloudflare.com/ajax/libs/caret/1.3.7/jquery.caret.min.js");
        /*$this->fileCss('https://raw.githubusercontent.com/apm1467/jQuery.Custom-Caret/master/example/main.css'); */

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div class="asset" id="asset {id}" {readonly}>
                  <input class="border border-danger" type="text" name="{name}" value="{value}" placeholder="{placeholder}">
           </div>
      
HTML,
        'js' => <<<JS
      $("#asset").customCaret();
      //need more options in GitHub
JS,




    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
              '{id}' => $this->id,
              '{name}' => $this->name,
              '{value}' => $this->value,
            
            '{placeholder}' => $this->_config['placeholder'],
        ]);

    }
}

