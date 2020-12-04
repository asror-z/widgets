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
 * Created By: Jahongir Qudratov
 *
 */
class ZModalWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZModalWidget::type['central'],
        'position' => ZModalWidget::position['right'],
        'sidePosition' => ZModalWidget::SidePositon['left'],
        'size' => ZModalWidget::size['md'],
        'modalTitle' => 'Modal Title',
        'modalBodyContent' => '',
        'styleType' => ZModalWidget::StyleType['success'],
        'frameSidePosition' => ZModalWidget::FrameSidePosition['top'],
        'closeButtonTitle' => Azl . ('Close'),
        'checkButtonTitle' => Azl . ('Save Changes'),
        'triggerButtonStyle' => ZModalWidget::TriggerButtonStyle['info'],
        'triggerButtonTitle' => 'show modal',
        'contentBtn' => '',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZModalWidget/image/icon.png',
        'name' => Azl . 'Modal',
        'title' => Azl . '<b>safasfsa</b><img src="/render/notifier/ZModalWidget/image/icon.png"/>',

    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        /*
         * $("#{$this->_config['type']}").on('show.bs.modal', function(){
       alert("Hello World!");
    });
         $("#{$this->_config['type']}").on('shown.bs.modal', function(){
       alert("Hello World!");
    });

    $("#{$this->_config['type']}").on('hide.bs.modal', function(){
      alert("Hello World!");
    });

    $("#{$this->_config['type']}").on('hidden.bs.modal', function(){
        alert("Hello World!");
    });
         *
         */
        'hidden.bs.modal' => 'console.log("this is event-hidden.bs.modal");',
        'hide.bs.modal' => 'console.log("this is event-hide.bs.modal");',
        'shown.bs.modal' => ' console.log("this is event-shown.bs.modal");', 'show.bs.modal' => 'console.log("this is event-show.bs.modal");',
    ];


    /**
     *
     * Constants
     */


    public const type = [
        'central' => 'central',
        'side' => 'side',
        'fluid' => 'fluid',
        'frame' => 'frame',

    ];

    public const size = [
        'lg' => 'lg',
        'xl' => 'xl',
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

    public const FrameSidePosition = [
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

    public function asset()
    {

    }

    public function codes()
    {

        $this->layout = [
            'side' => <<<HTML
         <!-- Side Modal Top Right -->

<!-- To change the direction of the modal animation change .right class -->
<div class="modal fade {$this->_config['position']}" id="side"
 tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-{$this->_config['frameSidePosition']}-{$this->_config['sidePosition']} modal-notify modal-{$this->_config['styleType']}" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">{$this->_config['modalTitle']}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        {$this->_config['modalBodyContent']}
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-{$this->_config['styleType']}" data-dismiss="modal">{$this->_config['closeButtonTitle']}</button>
        <button type="button" class="btn btn-outline-{$this->_config['styleType']} waves-effect">{$this->_config['checkButtonTitle']}</button>
      </div>
    </div>
  </div>
</div>
<!-- Side Modal Top Right -->
HTML,

            'fluid' => <<<HTML
        <!-- Full Height Modal Right -->
<div class="modal fade {$this->_config['position']}" id="fluid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-{$this->_config['position']} modal-notify modal-{$this->_config['styleType']}" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">{$this->_config['modalTitle']}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
                {$this->_config['modalBodyContent']}

        
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-{$this->_config['styleType']}" data-dismiss="modal">{$this->_config['closeButtonTitle']}</button>
        <button type="button" class="editable-submit btn btn-outline-{$this->_config['styleType']} waves-effect">{$this->_config['checkButtonTitle']}</button>
      </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->
HTML,
            'frame' => <<<HTML
        <!-- Frame Modal Bottom -->
<div class="modal fade {$this->_config['position']}" id="frame" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" {readonly}>

  <!-- Add class .modal-frame and then add class .modal-bottom (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-frame modal-{$this->_config['frameSidePosition']} modal-notify modal-{$this->_config['styleType']}" role="document">


    <div class="modal-content">
      <div class="modal-body">
        <div class="row d-flex justify-content-center align-items-center">

                  {$this->_config['modalBodyContent']}


          <button type="button" class="btn btn-{$this->_config['styleType']}" data-dismiss="modal">{$this->_config['closeButtonTitle']}</button>
          <button type="button" class="btn btn-outline-{$this->_config['styleType']} waves-effect">{$this->_config['checkButtonTitle']}</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Frame Modal Bottom -->
HTML,

            'central' => <<<HTML
       <!-- Central Modal Small -->
<div class="modal fade" id="central" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-notify modal-{$this->_config['styleType']} modal-{$this->_config['size']} modal-notify" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 p-3" id="myModalLabel">{$this->_config['modalTitle']}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
                {$this->_config['modalBodyContent']}

      </div>
      <div class="modal-footer">
        <button type="button" class="close-button btn btn-{$this->_config['styleType']} btn-sm" data-dismiss="modal">{$this->_config['closeButtonTitle']}</button>
        <button type="button" class="editable-submit zetsoft\dbdata\ALL\action\ZSortingActionbtn btn-outline-{$this->_config['styleType']} btn-sm waves-effect">{$this->_config['checkButtonTitle']}</button>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->
HTML

        ];

        if (empty($this->_config['contentBtn'])) {
            $this->_config['contentBtn'] = <<<HTML
<button type="button" class="btn btn-{$this->_config['triggerButtonStyle']} modal-trigger-button" data-toggle="modal" data-target="#{$this->_config['type']}">
  {$this->_config['triggerButtonTitle']}
</button>
HTML;

        }


        $this->_config['modalBodyContent'] = ob_get_clean();

        $content = $this->_config['contentBtn'];

        $this->htm = <<<HTML
      
        <!-- Button trigger modal -->

    <!--$content-->
        
    
HTML;
        $this->htm .= $this->layout[$this->_config['type']];

        /*$this->htm = strtr($this->_layout['frame'], [
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);*/


        $this->js = <<<JS
       
        {hidden.bs.modal} 
        {hide.bs.modal}
        {shown.bs.modal}
        {show.bs.modal}
        
     

JS;

        $this->js = strtr($this->js, [

            '{hidden.bs.modal}' => $this->eventCode('hidden.bs.modal'),
            '{hide.bs.modal}' => $this->eventCode('hide.bs.modal'),
            '{shown.bs.modal}' => $this->eventCode('shown.bs.modal'),
            '{show.bs.modal}' => $this->eventCode('show.bs.modal')


        ]);


    }

}
