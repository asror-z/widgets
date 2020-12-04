<?php

namespace zetsoft\widgets\notifier;

use kartik\form\ActiveForm;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
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
class ZDynaModalWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'checkButton' => null,
        'type' => ZModalWidget::type['frame'],
        'position' => ZModalWidget::position['right'],
        'sidePosition' => ZModalWidget::SidePositon['left'],
        'size' => ZModalWidget::size['md'],
        'modalTitle' => 'Modal Title',
        'modalBodyContent' => 'this is modal content',
        'styleType' => ZModalWidget::StyleType['danger'],
        'frameSidePosition' => ZModalWidget::FrameSidePosition['top'],
        'closeButtonTitle' => 'Close',
        'checkButtonTitle' => 'Сохранить',
        'triggerButtonStyle' => ZModalWidget::TriggerButtonStyle['info'],
        'triggerButtonTitle' => 'show modal',
        'form_id' => 'id',
        'modelClassName'=>''

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
        'hidden.bs.modal' => '$(".modal").on("hidden.bs.modal", function(){
        console.log("this is event-hidden.bs.modal{id}");
});',
        'hide.bs.modal' => '$(".modal").on("hide.bs.modal", function(){
            console.log("this is event-hide.bs.modal=");

});', 'shown.bs.modal' => '$(".modal").on("shown.bs.modal", function(){
              console.log("this is event-shown.bs.modal{id}");

});', 'show.bs.modal' => '$(".modal").on("show.bs.modal", function(){
              console.log("this is event-show.bs.modal{id}");

});',
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
        
        $url = ZUrl::to([
            '/api/core/editable/editable',
            'id' => 1
        ]);
        $this->layout = [
            'side' => <<<HTML
         <!-- Side Modal Top Right -->

<!-- To change the direction of the modal animation change .right class -->
<div class="modal fade {$this->_config['position']}" id={id}
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">{$this->_config['closeButtonTitle']}</button>
        {saveButton}
      </div>
    </div>
  </div>
</div>
<!-- Side Modal Top Right -->
HTML,

            'fluid' => <<<HTML
        <!-- Full Height Modal Right -->
<div class="modal fade {$this->_config['position']}" id={id} tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">{$this->_config['closeButtonTitle']}</button>
        {saveButton}
      </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->
HTML,
            'frame' => <<<HTML
        <!-- Frame Modal Bottom -->
<div class="modal fade {$this->_config['position']}"   id="{id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" {readonly}>

  <!-- Add class .modal-frame and then add class .modal-bottom (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-frame modal-{$this->_config['frameSidePosition']} modal-notify modal-{$this->_config['styleType']}" role="document">


    <div class="modal-content">
      <div class="modal-body">
        <div class="row d-flex justify-content-center align-items-center">

                  {$this->_config['modalBodyContent']}


          <button type="button" class="btn btn-danger" data-dismiss="modal">{$this->_config['closeButtonTitle']}</button>
          {saveButton}
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Frame Modal Bottom -->
HTML,

            'central' => <<<HTML
       <!-- Central modal{id} Small -->
       
<div class="modal fade" id="{id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" >

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-notify modal-{$this->_config['styleType']} modal-{$this->_config['size']} modal-notify" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 p-0" id="myModalLabel">{$this->_config['modalTitle']}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
                {content}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">{$this->_config['closeButtonTitle']}</button>
        {saveButton}
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->
HTML

        ];

        $jss = <<<JS
$(document).ready(function () {
                    //при нажатию на любую кнопку, имеющую класс .btn
                    $("#modal{id}").click(function () {
                         $('#{id}').modal('show');
                    });

                });
JS;
        $jss = strtr($jss, [
            '{id}' => $this->id
        ]);


        $this->htm = <<<HTML
      
        <!-- Button trigger modal -->
<button type="button" class="{$this->_config['triggerButtonStyle']}" data-toggle="modal" data-target="#{$this->_config['type']}" id="modal{id}">
  {$this->_config['triggerButtonTitle']}
</button>
        
    
HTML;
    if ($this->attribute !== null) {
        $this->model->configs->nameOn = [
            $this->attribute
        ];
        $this->model->columns();
    }

        $this->htm = strtr($this->htm, [
            '{id}' => $this->id
        ]);
        if ($this->_config['checkButton'] === null)
            $this->_config['checkButton'] = ZButtonWidget::widget([
                'config' => [
                    'text' => $this->_config['checkButtonTitle'],
                    'btnRounded' => false,
                    'btnStyle' => ZColor::btnStyle['btn-success'],
                    'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                    'btnType' => ZButtonWidget::btnType['submit'],
                    'url' =>ZUrl::to([
                        '/api/core/editable/editable',
                        'id' => 1,
                    ]),
                    'data-pjax' => 1,
                    'data' => "$('#".$this->id."').serialize()",
                ]
            ]);



        ob_start();

        //$this->pjaxBegin();

        $active=new Active();
        $active->formAction = ZUrl::to([
            '/api/core/app/modal-edit',
            'modelClassName' => $this->_config['modelClassName'],
            'id' => $this->_config['form_id']
        ]);

        $this->activeBegin($active);
        echo strtr($this->layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{saveButton}' => $this->_config['checkButton'],
            '{content}'=>$this->_config['modalBodyContent']
        ]);
        $this->activeEnd();
        $content = ob_get_clean();
        $this->htm .= $content;

       // $this->pjaxEnd();

        /*$this->htm = strtr($this->_layout['frame'], [
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);*/


        $this->css = <<<CSS
.kv-editable-link {
    color: #428bca;
    background: none;
    border: none;
    margin: 0;
    padding: 2px 1px;
    text-decoration: none;
    cursor: pointer;
    border-bottom: 1px dashed;
}
CSS;


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

        $this->js .= strtr($jss, [
            '{id}' => $this->id
        ]);
    }

}
