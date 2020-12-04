<?php

namespace zetsoft\widgets\notifier;

use zetsoft\system\assets\ZColor;
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
 * Created By: Dilshod Olimov
 *
 */
class ZModalEyufWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'size' => ZModalNewWidget::size['lg'],
        'title'  => 'Измениние профиля'
    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'hidden.bs.modal' => '$(".modal").on("hidden.bs.modal", function(){
        console.log("this is event-hidden.bs.modal");
});',
        'hide.bs.modal' => '$(".modal").on("hide.bs.modal", function(){
            console.log("this is event-hide.bs.modal");

});',   'shown.bs.modal' => '$(".modal").on("shown.bs.modal", function(){
              console.log("this is event-shown.bs.modal");

});',   'show.bs.modal' => '$(".modal").on("show.bs.modal", function(){
              console.log("this is event-show.bs.modal");

});',
    ];


    /**
     *
     * Constants
     */


    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
        'fluid' => 'fluid'
    ];


   public function init()
   {
       parent::init();
       ob_start();
   }


   public $layout =[];
   public $_layout =[

       'main' => <<<HTML
       <!-- Central Modal Small -->
<div class="modal fade" id="{id}" tabindex="-1" role="dialog"
  aria-hidden="true" style="z-index: 10000">
  
   
  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-body" role="document">
     {modalContent}
  </div>
</div>
<!-- Central Modal Small -->
HTML,
       'new' => <<<HTML
<div class="modal fade" id="{id}" role="dialog" style="z-index: 10000">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center bg-primary text-white">
          
           <h4 class="modal-title w-100">{modalTitle}</h4>
        </div>
        <div class="modal-body m-0 p-0">
          {modalContent}
        </div>
        
      </div>
      
    </div>
  </div>
HTML,

       'central' => <<<HTML
        
        
        <div class="modal fade" id="{id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true"  style="z-index: 10000">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-notify modal-lg modal-notify modal-info" role="document">


    <div class="modal-content">
      <div class="modal-header text-center bg-primary text-white">
        <h4 class="modal-title w-100 p-3" id="myModalLabel">{modalTitle}</h4>
      </div>
      <div class="modal-body">
      
                {modalContent}

      </div>
      
    </div>
  </div>
</div>
HTML,


       'js' => <<<JS
         {hidden.bs.modal} 
        {hide.bs.modal}
        {shown.bs.modal}
        {show.bs.modal}
JS,

   ];

    public function codes()
    {
        $trigger = ob_get_clean();

        $this->htm = strtr($this->_layout['new'],[
             '{modalContent}' => $trigger,
             '{modalTitle}' => $this->_config['title'],
             '{size}' => $this->_config['size'],
             '{id}' => $this->id,
        ]);
        $this->js = strtr($this->_layout['js'], [

            '{hidden.bs.modal}' => $this->eventCode('hidden.bs.modal'),
            '{hide.bs.modal}' => $this->eventCode('hide.bs.modal'),
            '{shown.bs.modal}' => $this->eventCode('shown.bs.modal'),
            '{show.bs.modal}' => $this->eventCode('show.bs.modal')


        ]);

    }

}
