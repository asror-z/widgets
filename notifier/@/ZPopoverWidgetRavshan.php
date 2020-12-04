<?php

namespace zetsoft\widgets\notifier;

use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
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
class ZPopoverWidgetRavshan extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZModalWidget::type['central'],
        'position' => ZModalWidget::position['right'],
        'sidePosition' => ZModalWidget::SidePositon['left'],
        'triggerButtonStyle' => ZModalWidget::TriggerButtonStyle['primary'],
        'size' => ZModalWidget::size['md'],
        'styleType' => ZModalWidget::StyleType['success'],
        'frameSidePosition' => ZModalWidget::FrameSidePosition['top'],

        'submitId' => 'submit',
        'resetId' => 'reset',
        'resetText' => Azl . 'Reset',
        'submitText' => Azl . 'Submit',
        'isBtn' => true,
        'value' => 'sdasdaads',
        'title' => 'Modal',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZModalWidget/image/icon.png',
        'name' => Azl . 'Modal',
        'title' => Azl . '<b>safasfsa</b><img src="/render/notifier/ZModalWidget/image/icon.png"/>',

    ];

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

    public function codes()
    {

        $this->layout = [

            'main' => <<<HTML
      
{valueBtn}      
       
<div class="modal fade" id="{id}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{id}"
  aria-hidden="true">

  <div class="modal-dialog modal-notify modal-{styleType} modal-{size} modal-notify" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel-{id}">{title}</h4>
        <button type="button" class="close" id="{closeId}" data-dismiss="modal" aria-label="Close">
          <span style="font-size: 38px" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
            {content}

      </div>
      <div class="modal-footer">
        {reset}{submit}
      </div>
    </div>
  </div>
</div>
HTML,

        'valueBtn' => <<<HTML
 <button type="button" class="btn btn-{triggerButtonStyle} modal-trigger-button" data-target="#{type}">
  {text}
</button>
HTML,

        ];

        $valueBtn = '';
        if ($this->_config['isBtn']) {
            $valueBtn = strtr($this->layout['valueBtn'], [
                '{triggerButtonStyle}' => $this->_config['triggerButtonStyle'],
                '{type}' => $this->_config['type'],
                '{text}' => $this->_config['value'],
            ]);
        }

        $this->htm = strtr($this->layout['main'], [
            '{id}' => $this->id,
            '{valueBtn}' => $valueBtn,
            '{content}' => ob_get_clean(),
            '{title}' => $this->_config['title'],
            '{styleType}' => $this->_config['styleType'],
            '{size}' => $this->_config['size'],
            '{reset}' => ZButtonWidget::widget([
                'id' => $this->_config['resetId'],
                'config' => [
                    'text' => $this->_config['resetText'],
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnRounded' => false,
                    'hasIcon' => true,
                    'btnSize' => ZColor::btnSize['btn-md'],
                    'icon' => 'fas fa-trash',
                    'class' => 'reset-button',
                    'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
                ]
            ]),
            '{submit}' => ZButtonWidget::widget([
                'id' => $this->_config['submitId'],
                'config' => [
                    'text' => $this->_config['resetText'],
                    'btnType' => ZButtonWidget::btnType['button'],
                    'hasIcon' => true,
                    'btnRounded' => false,
                    'icon' => 'fas fa-save',
                    'btnSize' => ZColor::btnSize['btn-md'],
                    'class' => 'submit-button',
                    'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                ]
            ])
        ]);

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
