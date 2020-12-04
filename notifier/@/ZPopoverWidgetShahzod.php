<?php

namespace zetsoft\widgets\notifier;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class 
 * https://getbootstrap.com/docs/4.0/components/popovers/
 * https://gist.github.com/tamilps2/8897198
 *
 * Created By: 
 */
class ZPopoverWidgetShahzod extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZPopoverWidgetShahzod::type['central'],
        'position' => ZPopoverWidgetShahzod::position['right'],
        'sidePosition' => ZPopoverWidgetShahzod::SidePositon['left'],
        'size' => ZPopoverWidgetShahzod::size['md'],
        'popoverTitle' => 'Popover Title',
        'content' => '<p>lsaasdfsafaf</p>',
        'styleType' => ZPopoverWidgetShahzod::StyleType['success'],
        'frameSidePosition' => ZPopoverWidgetShahzod::FrameSidePosition['top'],
        'closeButtonTitle' => 'Close',
        'checkButtonTitle' => 'Save Changes',
        'triggerButtonStyle' => ZPopoverWidgetShahzod::TriggerButtonStyle['info'],
        'triggerButtonTitle' => 'show modal',
        'contentBtn' => '',
        'modalBodyContent' => '',
        'submitId' => 'submit',
        'closeId' => 'close',
    ];

    public static $grapes = [
        'enable' => false,
        'icon' => '',
        'image' => '/render/notifier/ZPopoverWidget/image/icon.png',
        'name' => Azl . 'Modal',
        'title' => Azl . '<b>safasfsa</b><img src="/render/notifier/ZPopoverWidget/image/icon.png"/>',

    ];

    public $event = [];
    public $_event = [

        'hidden.bs.popover' => '$(".modal").on("hidden.bs.popover", function(){
        console.log("this is event-hidden.bs.popover");
});',
        'hide.bs.popover' => '$(".modal").on("hide.bs.popover", function(){
            console.log("this is event-hide.bs.popover");

});',   'shown.bs.popover' => '$(".modal").on("shown.bs.popover", function(){
              console.log("this is event-shown.bs.popover");

});',   'show.bs.popover' => '$(".modal").on("show.bs.popover", function(){
              console.log("this is event-show.bs.popover");

});',
    ];

    public const type = [
        'central' => 'central',
        'side' => 'side',
        'fluid' => 'fluid',
        'frame' => 'frame',

    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
        'fluid' => 'fluid'
    ];

    public const position = [
        'right' => 'right',
        'left' => 'left',
        'top' => 'top',
        'bottom' => 'bottom'
    ];

    public const FrameSidePosition =[
        'top' => 'top',
        'bottom' => 'bottom'
    ];

    public const SidePositon = [
        'right' => 'right',
        'left' => 'left'
    ];

    public const StyleType = [
        'defoult' => '',
        'success' => 'success',
        'info' => 'info',
        'danger' => 'danger',
        'warning' => 'warning',
    ];

    public const TriggerButtonStyle = [
        'primary' => 'primary',
        'success' => 'success',
        'danger' => 'danger',
        'warning' => 'warning',
        'dark' => 'dark',
        'info' => 'info',
        'secondary' => 'secondary',
        'light' => 'light',

    ];

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function asset()
    {

    }


    public $layout = [];
    public $_layout = [

        'central' => <<<HTML
               
               <a href="#"
            class="myPopover"
            data-toggle="popover"
            data-placement="right" 
            data-html="true"
            data-popover-content="#myPopoverContent">POPOVER</a>
 
   <!-- Content for Popover: -->
   
   <div class="d-none popover-content" id="myPopoverContent" id="{id}-modal" tabindex="-1" role="dialog" >
           
         <div class="popover-success">
        
      </div>
         
         {content}
         
         <div class="d-flex">
         
             <a class="btn btn-{styleType}" id="{closeId} href="#">{closeButtonTitle}</a>
             <a class="btn btn-{styleType}" id="{submitId}" href="#">{checkButtonTitle}</a>
            
      </div>
   </div>
 
HTML,
        'js' => <<<JS
        
            $('.myPopover').popover({
         html : true,
         title: '<h4 class="w-100 popover-{styleType}">{popoverTitle}</h4>        <button data-dismiss="popover" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
         content: function() {
          var elementId = $(this).attr("data-popover-content");
          return $(elementId).html();
         }
         });
         
  JS,
    ];

    public function codes()
    {


        $content = ob_get_clean();



        $this->htm .= strtr($this->_layout[$this->_config['type']], [

            '{content}' => $this->_config['content'],
            '{styleType}' => $this->_config['styleType'],
            '{closeButtonTitle}' => $this->_config['closeButtonTitle'],
            '{checkButtonTitle}' => $this->_config['checkButtonTitle'],

        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{popoverTitle}' => $this->_config['popoverTitle'],
            '{styleType}' => $this->_config['styleType'],
        ]);

    }

}
