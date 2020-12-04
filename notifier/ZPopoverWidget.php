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
 * https://mdbootstrap.com/docs/jquery/modals/basic/
 *
 * Created By: Shahzod Gulomqodirov
 *
 */
class ZPopoverWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZPopoverWidget::type['central'],
        'position' => ZPopoverWidget::position['right'],
        'sidePosition' => ZPopoverWidget::SidePositon['left'],
        'size' => ZPopoverWidget::size['md'],
        'popoverTitle' => 'Modal Title',
        'content' => '',
        'styleType' => ZPopoverWidget::StyleType['success'],
        'frameSidePosition' => ZPopoverWidget::FrameSidePosition['top'],
        'closeButtonTitle' => 'Close',
        'checkButtonTitle' => 'Save Changes',
        'triggerButtonStyle' => ZPopoverWidget::TriggerButtonStyle['info'],
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

    public $layout  = [];
    public $_layout = [
        'side' => <<<HTML
        <!-- Side Modal Top Right -->
<!-- To change the direction of the modal animation change .right class -->
<div class="modal fade {position}" id="{id}-modal"
 tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-{frameSidePosition}-{sidePosition} modal-notify modal-{styleType}" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">{popoverTitle}</h4>
        <button type="button" class="close" data-dismiss="popover" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        {content}
        
      </div>
      <div class="modal-footer">
        <button type="button" id="{closeId} class="close-button btn btn-{styleType} btn-sm" data-dismiss="popover">{closeButtonTitle}</button>
        <button type="button" id="{submitId}" class="editable-submit zetsoft\dbdata\ALL\action\ZSortingActionbtn btn-outline-{styleType} btn-sm waves-effect">{checkButtonTitle}</button>
      </div>
    </div>
  </div>
</div>
<!-- Side Modal Top Right -->
HTML,

        'fluid' => <<<HTML
        <!-- Full Height Modal Right -->
<div class="modal fade {position}" id="{id}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-{position} modal-notify modal-{styleType}" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">{popoverTitle}</h4>
        <button type="button" class="close" data-dismiss="popover" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
                {content}

        
      </div>
      <div class="modal-footer justify-content-center">
       <button type="button" id="{closeId} class="close-button btn btn-{styleType} btn-sm" data-dismiss="popover">{closeButtonTitle}</button>
        <button type="button" id="{submitId}" class="editable-submit zetsoft\dbdata\ALL\action\ZSortingActionbtn btn-outline-{styleType} btn-sm waves-effect">{checkButtonTitle}</button>
      </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->
HTML,
        'frame' => <<<HTML
        <!-- Frame Modal Bottom -->
<div class="modal fade {position}" id="{id}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" {readonly}>

  <!-- Add class .modal-frame and then add class .modal-bottom (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-frame modal-{frameSidePosition} modal-notify modal-{styleType}" role="document">


    <div class="modal-content">
      <div class="modal-body">
        <div class="row d-flex justify-content-center align-items-center">

                  {content}


         <button type="button" id="{closeId} class="close-button btn btn-{styleType} btn-sm" data-dismiss="popover">{closeButtonTitle}</button>
        <button type="button" id="{submitId}" class="editable-submit zetsoft\dbdata\ALL\action\ZSortingActionbtn btn-outline-{styleType} btn-sm waves-effect">{checkButtonTitle}</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Frame Modal Bottom -->
HTML,

        'central' => <<<HTML
       <!-- Central Modal Small -->
<div class="modal fade" id="{id}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-notify modal-{styleType} modal-{size} modal-notify" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 p-3" id="myModalLabel">{popoverTitle}</h4>
        <button type="button" class="close" data-dismiss="popover" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
                {content}

      </div>
      <div class="modal-footer">
        <button type="button" id="{closeId} class="close-button btn btn-{styleType} btn-sm" data-dismiss="popover">{closeButtonTitle}</button>
        <button type="button" id="{submitId}" class="editable-submit zetsoft\dbdata\ALL\action\ZSortingActionbtn btn-outline-{styleType} btn-sm waves-effect">{checkButtonTitle}</button>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->
HTML,

];

    public function codes()
    {
        if (empty($this->_config['contentBtn'])) {
        $this->_config['contentBtn'] = <<<HTML
<button type="button" class="btn btn-{$this->_config['triggerButtonStyle']} modal-trigger-button" data-toggle="popover" data-target="#{$this->_config['type']}">
  {$this->_config['triggerButtonTitle']}
</button>
HTML;

    }
        $content = $this->_config['contentBtn'];
        $this->htm = <<<HTML
    <!--$content-->
HTML;
        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{content}' => ob_get_clean(),
            '{submitId}' => $this->_config['submitId'],
            '{closeId}' => $this->_config['closeId'],
            '{frameSidePosition}' => $this->_config['frameSidePosition'],
            '{styleType}' =>$this->_config['styleType'],
            '{closeButtonTitle}' =>$this->_config['closeButtonTitle'],
            '{popoverTitle}' =>$this->_config['popoverTitle'],
            '{checkButtonTitle}' =>$this->_config['checkButtonTitle'],
            '{size}' =>$this->_config['size'],
            '{position}' =>$this->_config['position'],

        ]);


        
        $this->js = strtr($this->js, [

            '{hidden.bs.popover}' => $this->eventCode('hidden.bs.popover'),
            '{hide.bs.popover}' => $this->eventCode('hide.bs.popover'),
            '{shown.bs.popover}' => $this->eventCode('shown.bs.popover'),
            '{show.bs.popover}' => $this->eventCode('show.bs.popover')


        ]);


    }

}
