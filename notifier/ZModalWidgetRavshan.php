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
class ZModalWidgetRavshan extends ZWidget
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

        'footer' => '',
        'isFooter' => true,
        'submitId' => 'submit',
        'resetId' => 'reset',
        'resetBtn' => true,
        'resetText' => Azl . 'Отменить',
        'submitText' => Azl . 'Подтвердить',
        'isBtn' => true,
        'value' => 'sdasdaads',
        'title' => 'Modal',

        'max-width' => ZModalWidgetRavshan::width['15x'],
        'width' => ZModalWidgetRavshan::width['12x'],
        'bgColor' => 'white',
        'icon' => 'fa fa-user',
        'modalBodyClass' => '',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZModalWidget/image/icon.png',
        'name' => Azl . 'Modal',
        'title' => Azl . '<img src="/render/notifier/ZModalWidget/image/icon.png"/>',

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

    public const width = [
        '1x' => '100px',
        '2x' => '200px',
        '3x' => '300px',
        '4x' => '400px',
        '5x' => '500px',
        '6x' => '600px',
        '7x' => '700px',
        '8x' => '800px',
        '9x' => '900px',
        '10x' => '1000px',
        '11x' => '1100px',
        '12x' => '1200px',
        '13x' => '1300px',
        '14x' => '1400px',
        '15x' => '1500px',
    ];
    public const type = [
        'central' => 'central',
        'side' => 'side',
        'fluid' => 'fluid',
        'frame' => 'frame',

    ];

    public const size = [
        'xl' => 'xl',
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
  <div id="{id}-width" class="modal-dialog modal-notify modal-{styleType} modal-{size} modal-notify" role="document">
    <div class="modal-content text-left w-100" id="{id}-content-modal">
      <div class="modal-header headerStyle">
        <i class="{icon} mt-auto mb-auto mr-2"></i>
        <h4 class="modal-title" id="myModalLabel-{id}">{title}</h4>
        <button type="button" class="close" id="{closeId}" data-dismiss="modal" aria-label="Close">
          <span style="font-size: 38px" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0 p-2 {modalBodyClass}" id="{id}-body-modal">
            {content}
      </div>
         {footer}
    </div>
  </div>
</div>
HTML,

        'footer' => <<<HTML
<div class="modal-footer">
  <span class="spinner-border text-primary" role="status" style="position: absolute; display: none; left: 30px;"><span class="sr-only">Loading...</span></span>
        <div class="d-flex justify-content-end">
            {reset}
            {submit} 
        </div>
  </div>
      
HTML,


        'valueBtn' => <<<HTML
 <button type="button" class="btn btn-{triggerButtonStyle} modal-trigger-button" data-target="#{type}">
  {text}
</button>
HTML,

        'css' => <<<CSS
        .clicked {
            opacity: 0.4;
        }
         #{id}-width {
            max-width: {max-width};
            width: {width};
         }
        
         .headerStyle {
            background-color: {bgColor} !important;
         }
         
         iframe {
            border:none;
         }
         
CSS,
            'js' => <<<JS
                
JS,


        ];

        $valueBtn = '';
        if ($this->_config['isBtn']) {
            $valueBtn = strtr($this->layout['valueBtn'], [
                '{triggerButtonStyle}' => $this->_config['triggerButtonStyle'],
                '{type}' => $this->_config['type'],
                '{text}' => $this->_config['value'],
            ]);
        }

        $footer = '';
        if (empty($this->_config['footer'])) {

           $footer = strtr($this->layout['footer'], [

                    '{reset}' =>$this->_config['resetBtn'] ? ZButtonWidget::widget([
                        'id' => $this->_config['resetId'],
                        'config' => [
                            'text' => $this->_config['resetText'],
                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnRounded' => false,
                            'hasIcon' => true,
                            'btnSize' => ZColor::btnSize['btn-md'],
                            'icon' => 'fas fa-trash',
                            'class' => 'reset-button mr-2',
                            'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
                        ]
                    ]) : '',

                '{submit}' => ZButtonWidget::widget([
                    'id' => $this->_config['submitId'],
                    'config' => [
                        'text' => $this->_config['submitText'],
                        'btnType' => ZButtonWidget::btnType['button'],
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'icon' => 'fas fa-save',
                        'btnSize' => ZColor::btnSize['btn-md'],
                        'class' => 'submit-button mr-2',
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                    ]
                ])
            ]);
        }

        if ($this->_config['isFooter'] === false)
            $footer = null;

        $this->htm = strtr($this->layout['main'], [
            '{id}' => $this->id,
            '{footer}' => $footer,
            '{valueBtn}' => $valueBtn,
            '{content}' => ob_get_clean(),
            '{title}' => $this->_config['title'],
            '{styleType}' => $this->_config['styleType'],
            '{size}' => $this->_config['size'],
            '{icon}' => $this->_config['icon'],
            '{modalBodyClass}' => $this->_config['modalBodyClass'],

        ]);

        $this->js = <<<JS
       
        {hidden.bs.modal} 
        {hide.bs.modal}
        {shown.bs.modal}
        {show.bs.modal}
        
     

JS;

        $this->css = strtr($this->layout['css'], [
            '{max-width}' => $this->_config['max-width'],
            '{width}' => $this->_config['width'],
            '{bgColor}' => $this->_config['bgColor'],
            '{id}' => $this->id,
        ]);

        $this->js = strtr($this->layout['js'], [

            '{hidden.bs.modal}' => $this->eventCode('hidden.bs.modal'),
            '{hide.bs.modal}' => $this->eventCode('hide.bs.modal'),
            '{shown.bs.modal}' => $this->eventCode('shown.bs.modal'),
            '{show.bs.modal}' => $this->eventCode('show.bs.modal')


        ]);


    }

}
