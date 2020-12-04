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
class ZModalShahzod extends ZWidget
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
        'submitId' => 'submit',
        'resetId' => 'reset',
        'resetText' => Azl . 'Reset',
        'submitText' => Azl . 'Submit',
        'isBtn' => true,
        'value' => 'sdasdaads',
        'title' => 'Modal',

        'max-width' => '1000px',
        'width' => ZModalWidgetRavshan::width['5x'],
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

});', 'shown.bs.modal' => '$(".modal").on("shown.bs.modal", function(){
              console.log("this is event-shown.bs.modal");

});', 'show.bs.modal' => '$(".modal").on("show.bs.modal", function(){
              console.log("this is event-show.bs.modal");

});',
    ];

    public const width = [
        '100px' => '100px',
        '200px' => '200px',
        '300px' => '300px',
        '400px' => '400px',
        '500px' => '500px',
        '600px' => '600px',
        '700px' => '700px',
        '800px' => '800px',
        '900px' => '900px',
        '1000px' => '1000px',
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

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function asset()
    {
        $this->fileJs('https://rawcdn.githack.com/anseki/jquery-plainmodal/6a4896b0c88fd32c4d406ded61a8261d3d5d8767/jquery.plainmodal.min.js');

    }

    public function codes()
    {

        $this->layout = [


            'main' => <<<HTML
      
{valueBtn}

                <div id="{id}-modal" style="display:none;">
                <div class="modal-content modal-{styleType} modal-{size} text-left w-100">
                        <!-- dialog body -->
                        <div class="modal-body">
                            <div class="d-flex w-100 justify-content-between">
                                
                                <div class="modal-header headerStyle">
                                    <i class="{icon} mt-auto mb-auto mr-2"></i>
                                    <h4 class="modal-title" id="myModalLabel-{id}">{title}</h4>
                                </div>
                                <button id="{closeId}" type="button" class="mt-auto mb-auto plainmodal-close">&times;</button>
</div>
                            {content}
                        </div>
                        <!-- dialog buttons -->
                        <div class="modal-footer">
                            {footer}
                        </div>
                    </div>
                </div>   
HTML,

            'footer' => <<<HTML
    {reset}
    {submit}   
HTML,


            'valueBtn' => <<<HTML
 <button type="button" class="btn filter-btn-open btn-{triggerButtonStyle} modal-trigger-button" data-target="#{type}">
  {text}
</button>
HTML,

            'css' => <<<CSS
        

   
   
CSS,
            'js' => <<<JS
                $('.filter-btn-open').click(function() {
                    $('#{id}-modal').plainModal('open');
                    $('#{id}-modal').plainModal('close');
            });          
            $('.plainmodal-close').on('click', function() {             
            })

           
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


        if (empty($this->_config['footer'])) {
            $this->_config['footer'] = strtr($this->layout['footer'], [
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
                        'text' => $this->_config['submitText'],
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

        $this->js .= <<<JS
            
            {hidden.bs.modal} 
            {hide.bs.modal}
            {shown.bs.modal}
            {show.bs.modal}
        
     

JS;

        $this->css = strtr($this->layout['css'], [
            '{max-width}' => $this->_config['max-width'],
            '{width}' => $this->_config['width'],
            '{bgColor}' => $this->_config['bgColor'],
        ]);

        $this->js = strtr($this->layout['js'], [
            '{id}' => $this->id,
            '{hidden.bs.modal}' => $this->eventCode('hidden.bs.modal'),
            '{hide.bs.modal}' => $this->eventCode('hide.bs.modal'),
            '{shown.bs.modal}' => $this->eventCode('shown.bs.modal'),
            '{show.bs.modal}' => $this->eventCode('show.bs.modal')


        ]);


    }

}
