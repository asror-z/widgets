<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Maftuna Kodirova

 */

class ZJqueryPjaxWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public function asset()
    {
      $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-pjax@2.0.1/jquery.pjax.js');
    }

      public $layout =[];
      public $_layout =[
          'pjax' => <<<HTML

            <h1>Jquery Pjax</h1>
                <div class="container" id="pjax-container">
                    Go to <a href="page2.html">next page</a>.
                </div> 
HTML,





      ];



    public function codes()
    {
        $this->js = <<<JS
        /* global Pjax */
var pjax;
var initButtons = function() {
  var buttons = document.querySelectorAll("button[data-manual-trigger]");

  if (!buttons) {
    return null;
  }

  // jshint -W083
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function (event) {
      var el = e.currentTarget;

      if (el.getAttribute("data-manual-trigger-override") === "true") {
        // Manually load URL with overridden Pjax instance options
        pjax.loadUrl("/example/page2.html", { cacheBust: false });
      } else {
        // Manually load URL with current Pjax instance options
        pjax.loadUrl("/example/page2.html");
      }
    });
  }
  // jshint +W083
};

console.log("Document initialized:", window.location.href);

document.addEventListener("pjax:send", function() {
  console.log("Event: pjax:send", arguments);
});

document.addEventListener("pjax:complete", function() {
  console.log("Event: pjax:complete", arguments);
});

document.addEventListener("pjax:error", function() {
  console.log("Event: pjax:error", arguments);
});

document.addEventListener("pjax:success", function() {
  console.log("Event: pjax:success", arguments);

  // Init page content
  initButtons();
});

document.addEventListener("DOMContentLoaded", function() {
  // Init Pjax instance
  pjax = new Pjax({
    elements: [".js-Pjax"],
    selectors: [".body", "title"],
    cacheBust: true
  });
  console.log("Pjax initialized.", pjax);

  // Init page content
  initButtons();
});

JS;

        $this ->htm = strtr($this ->_layout['pjax'],[]);


    }

}
