<?php

namespace zetsoft\widgets\blocks;

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
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */
class ZResponsiveIFrameWidget extends ZWidget
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
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-iframe-auto-height@2.0.0/dist/jquery-iframe-auto-height.js');

    }


    public function codes()
    {

        $this->htm = <<<HTML
<iframe id="myIframe" src="/cores/main/table.aspx" scrolling="yes"></iframe>

<!-- with document ready, most likely in the html head -->
<script>
  $(document).ready(function () {
    $('iframe').iframeAutoHeight({debug: true});
  });
</script>

<!-- inline, after the iframe -->
<!--<iframe src="my_iframe.html" class="auto-height" scrolling="no" frameborder="0"></iframe> -->
<script>
  $('iframe.auto-height').iframeAutoHeight({minHeight: 240});
</script>
HTML;

     $this->js = <<<JS
// fire iframe resize when window is resized
var windowResizeFunction = function (resizeFunction, iframe) {
  $(window).resize(function () {
    console.debug("window resized - firing resizeHeight on iframe");
    resizeFunction(iframe);
  });
};

// fire iframe resize when a link is clicked
var clickFunction = function (resizeFunction, iframe) {
  $('a').click(function () {
    $(iframe).contents().find('body').html(''); // clear content of iframe
    console.debug("link clicked - firing resizeHeight on iframe");
    resizeFunction(iframe);
  });
};

$('iframe').iframeAutoHeight({
  debug: true,
  triggerFunctions: [
    windowResizeFunction,
    clickFunction
  ]
});




JS;




        $this->css = <<<CSS
#myIframe {
        width: 1px;
        min-width: 100%;
        height: 50vh;
        border: none;
    }
CSS;


    }

}
