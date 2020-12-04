<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */
class ZMarkJsWidget extends ZWidget
{

  /**
   * Configuration
   */
  public $config = [];
  public $_config = [
      'type' => ZMarkJsWidget::type['main'],
      'text' => 'hello world',
      'grapes' => true,
  ];

  public const type = [
      'main' => 'main'

  ];

  /**
   *
   * Plugin Events
   * https://select2.org/programmatic-control/events
   */
  public $event = [];
  public $_event = [

  ];

  public $layout = [];
  public $_layout = [

      'main' => <<<HTML

<div class="panel panel-default"  '>
    <div class="panel-heading">Search</div>
    <div class="panel-body">
        <div class="search row">
            <div class="col-xs-6">
                <input type="text" name="keyword" class="form-control input-sm search-input" placeholder="Search in text">
                
            </div>
        
        </div>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-body context">
        <p>
            {text}
        </p>
    </div>
</div>

HTML,
      'js' => <<<JS
       $(function() {

var mark = function() {

    // Read the keyword
    var keyword = $("input[name='keyword']").val();
    console.log(keyword);
    // Determine selected options
    var options = {};
    $("input[name='opt[]']").each(function() {
        options[$(this).val()] = $(this).is(":checked");
    });

    // Remove previous marked elements and mark
    // the new keyword inside the context
    $(".context").unmark({
        done: function() {
            $(".context").mark(keyword, options);
        }
    });
};

$("input[name='keyword']").on("input", mark);
$("input[type='checkbox']").on("change", mark);

});

JS,
      'css' => <<<CSS
       /* body {
           padding-bottom:30px;
           padding-left:30px;
        }*/
         .panel-default{
           padding-bottom:30px;
           padding-left:30px;
         }
       
        div.panel .panel-body p:last-child {
            margin-bottom: 0;
        }

        mark {
            padding: 0;
            background-color: cyan;
        }

CSS,
  ];


  public function asset()
  {
    //$this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
    /*$this->fileJs('/publish/yarner/mark.js/dist/jquery.mark.min.js');*/
    $this->fileJs('https://cdn.jsdelivr.net/npm/mark.js@8.11.1/dist/jquery.mark.min.js');

  }


  public function codes()
  {
    //  $this->htm = \kartik\select2\Select2::widget($this->options);


    //$this->htm = $this->layout['main'];

    $this->htm .= strtr($this->_layout['main'], [
        '{text}' => $this->_config['text'],

        '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
    ]);

    $this->js = strtr($this->_layout['js'], []);
    $this->css = strtr($this->_layout['css'], []);


  }

}
