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
class ZModalWidgetD extends ZWidget
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

        'btn'=> '',

        'footer' => '',
        'submitId' => 'submit',
        'resetId' => 'reset',
        'resetText' => Azl . 'Reset',
        'submitText' => Azl . 'Submit',
        'isBtn' => true,
        'value' => 'sdasdaads',
        'title' => 'Modal',

        'max-width' => '1000px',
        'width' => '800px',
        'bgColor' => 'white',
        'icon' => 'fa fa-user',

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

    public function asset()
    {


    }

    public function codes()
    {

        $this->layout = [

            'main' => <<<HTML
      
{valueBtn}      
       
<div class="modal fade" id="{id}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{id}"
  aria-hidden="true">
  <div id="{id}-width" class="modal-dialog modal-notify modal-{styleType} modal-{size} modal-notify" role="document">
    <div class="modal-content text-left w-100">
      <div class="modal-header headerStyle">
      <i class="{icon} mt-auto mb-auto mr-2"></i>
        <h4 class="modal-title" id="myModalLabel-{id}">{title}</h4>
        <button type="submit" class="close" id="{closeId}" data-dismiss="modal" aria-label="Close">
          <span style="font-size: 38px" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" last-value='{content}'>
            {content}
      </div>
      <div class="modal-footer">
      <span class="spinner-border text-primary" role="status" style="position: absolute; display: none; left: 30px;"><span class="sr-only">Loading...</span></span>
            <div class="d-flex justify-content-end">
                {footer}
            </div>
      </div>
    </div>
  </div>
</div>
HTML,

            'footer' => <<<HTML
   {reset}
    {submit}   
HTML,


            'valueBtn' => <<<HTML
 <button id="{btnId}" type="submit" class="btn btn-{triggerButtonStyle} modal-trigger-button" data-target="#{type}">
  {text}
</button>
HTML,

            'css' => <<<CSS
        .clicked {
            opacity: 0.4;
        }
         #{id}-width {
            max-width:  {max-width};
            width:      {width};
        }
         .headerStyle {
            background-color: {bgColor} !important;
         }
CSS,
            'js' => <<<JS
     $(document).on('click', '#{btnId}',     function() {
        $('#{id}-modal').modal('show')
    });
    var id = $('.modal-body');
     $("#{resetId}").click(function () {
        id.html(id.attr('last-value'))
        $('#{id}-modal').modal('hide');
    });
    
    $("#{submitId}").click(function () {
        id.html(id.attr('last-value'))
        $('#{id}-modal').modal('hide');
    });
JS,


        ];

        $valueBtn = '';
        if ($this->_config['isBtn']) {
            $valueBtn = strtr($this->layout['valueBtn'], [
                '{triggerButtonStyle}' => $this->_config['triggerButtonStyle'],
                '{type}' => $this->_config['type'],
                '{text}' => $this->_config['value'],
                '{btnId}'=>$this->idApp
            ]);
        }


        if (empty($this->_config['footer'])) {
            $this->_config['footer'] = strtr($this->layout['footer'], [
                '{reset}' => ZButtonWidget::widget([
                    'id' => $this->_config['resetId'],
                    'config' => [
                        'text' => $this->_config['resetText'],
                        'btnType' => ZButtonWidget::btnType['submit'],
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
                        'text' => $this->_config['submitText'],
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'icon' => 'fas fa-save',
                        'btnSize' => ZColor::btnSize['btn-md'],
                        'class' => 'submit-button',
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                    ]
                ])
            ]);
        }

        $this->htm = strtr($this->layout['main'], [
            '{id}' => $this->id,
            '{footer}' => $this->_config['footer'],
            '{valueBtn}' => $valueBtn,
            '{content}' => ob_get_clean(),
            '{title}' => $this->_config['title'],
            '{styleType}' => $this->_config['styleType'],
            '{size}' => $this->_config['size'],
            '{icon}' => $this->_config['icon'],


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
            '{id}' =>$this->id,

        ]);

        $this->js = strtr($this->layout['js'], [
            '{id}' => $this->id,
            '{hidden.bs.modal}' => $this->eventCode('hidden.bs.modal'),
            '{hide.bs.modal}' => $this->eventCode('hide.bs.modal'),
            '{shown.bs.modal}' => $this->eventCode('shown.bs.modal'),
            '{show.bs.modal}' => $this->eventCode('show.bs.modal'),
            '{btnId}'=>$this->idApp,
            '{resetId}' => $this->_config['resetId'],
            '{submitId}' => $this->_config['submitId'],


        ]);


    }

}
