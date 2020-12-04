<?php

namespace zetsoft\widgets\inptest;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * 
 * https://crlcu.github.io/multiselect/
 *
 * Created By: Ergashov Xakimjon
 * Refactored By: Abdullo
 */

class ZCMultiselectWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'placeholder' => '',
        'data' => [],

    ];


    /**
     *
     * Constants
     */

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/multiselect/2.2.9/js/multiselect.min.js');
    }


    public function codes()
    {

    $this -> layout = [
            //<select name="{name}[]" if you want save in db who array [], or string name="{name}",
                'main' => <<<HTML

                 <div class="row">
    <div class="col-md-5">
        <select name="{name}[]" id="undo_redo" class="form-control yy" size="13" multiple="multiple">
            {content}
        </select>
    </div>
    
    <div class="col-md-2">
        <button type="button" id="{id}-undo_redo_undo" class="btn btn-primary btn-block">undo</button>
        <button type="button" id="{id}-undo_redo_rightAll" class="btn btn-default btn-block"><i class="fas fa-forward"></i></button>
        <button type="button" id="{id}-undo_redo_rightSelected" class="btn btn-default btn-block"><i class="fas fa-chevron-right"></i></button>
        <button type="button" id="{id}-undo_redo_leftSelected" class="btn btn-default btn-block"><i class="fas fa-chevron-left"></i></button>
        <button type="button" id="{id}-undo_redo_leftAll" class="btn btn-default btn-block"><i class="fas fa-backward"></i></button>
        <button type="button" id="{id}-undo_redo_redo" class="btn btn-warning btn-block">redo</button>
    </div>

    <div class="col-md-5">
        <select name="{name}[]" id="{id}-undo_redo_to" class="form-control hh" size="13" multiple="multiple">
        
</select>
    </div>
</div>

HTML,

        'content' => <<<HTML
           <option value="{key}">{value}</option>
HTML,

    ];
        $content = '';
        //vdd($this->modelCheck());
        if(!$this->modelCheck()){
            foreach ($this->value as $key => $value){
               $content .= strtr($this->layout['content'],[
                    '{key}' => $key,
                    '{value}' => $value
               ]);
            }
        }

        else{
            foreach ($this->_config['data'] as $key => $value){
                $content .= strtr($this->layout['content'],[
                    '{key}' => $key,
                    '{value}' => $value
                ]);
            }
        }

        $this->htm .= strtr($this->layout['main'], [

            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}'  => $this->value,
            '{content}' => $content,
            '{placeholder}' => $this->_config['placeholder'],

        ]);

        $this->js = <<<JS
            var all = [];
           $(document).ready(function() {
        $('#undo_redo').multiselect({
            afterMoveToRight : function (event) {
            var values = $('#undo_redo_to').children();
               values.each(function() {
                    
                  //console.log(this.val());
                  var a = this.value;
                  all.push(a);
                  
                  console.log(a);
                console.log(all);
               }); 
              console.log(values);
            }
        }); 

        $('#undo_redo_to').on('change', function() {
              var values = $('#undo_redo_to').children();
              console.log(values);
        })
    });
JS;

        $this->css = <<<CSS
CSS;
        
    }

}
