<?php

namespace zetsoft\widgets\former;

use kartik\builder\Form;
use kartik\form\ActiveForm;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZPopoverXWidget;

/**
 * Class ZKEditableWidget
 * @package widgets\blocks
 * http://demos.krajee.com/editable
 */
class ZEditRavWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $widgetClass;
    public $readonly = false;

    public $config = [];
    public $_config = [
        'pjaxContainerId' => '',
        'session' => false,
        'asPopover' => false,
        'templateBefore' => '{header}',
        'templateAfter' => '{loading}{buttons}{close}',
        'displayValueConfig' => [],
        'displayValue' => '',
        'submitOnEnter' => false,
        'afterInput' => '',
        'placement' => ZEditKartikWidget::placement['ALIGN_RIGHT_BOTTOM'],
        'header' => '',
        'inputType' => ZEditKartikWidget::type['INPUT_WIDGET'],
        'format' => ZEditKartikWidget::format['link'],
        'template' => ZEditKartikWidget::template['INLINE_AFTER_1'],
        //'buttonType' => ZKEditableWidget::popover['ALIGN_RIGHT_BOTTOM'],
        'widgetClass' => ZHInputWidget::class,

        'beforeInput' => '',
        'formClass' => ActiveForm::class,
        'formAction' => [],
        'autoGuessInput' => true,
        'options' => [],
        'editableType' => self::editableType['modal'],
        'title' => null,
        'emptyValueText' => Azl.'Не задано',
        'text-color' =>'text-success',
    ];


    public const editableType = [
        'modal' => ZModalWidget::class,
        'popoverX' => ZPopoverXWidget::class,
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'editableChange' => 'function(event, val) { console.log("ZKEditableWidget | Changed Value") }',
        'editableSubmit' => 'function(event, val, form) { console.log("ZKEditableWidget | Submitted Value ") }',
        'editableBeforeSubmit' => 'function(event, val, form, jqXHR) { console.log("ZKEditableWidget | Before submit triggered"  ) }',
        'editableReset' => 'function(event) { console.log("ZKEditableWidget | Reset editable form"); }',

        'editableAjaxComplete' => 'function(event, val, form) { console.log("ZKEditableWidget | Submitted Value" ) }',
        'editableAjaxSuccess' => 'function(event, val, form, data) { console.log( "ZKEditableWidget | Successful submission of value"); }',
        'editableAjaxError' => 'function(event, jqXHR, status, message) { console.log("ZKEditableWidget | message"); }'

    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   <div class="rv-editable-link d-flex justify-content-center">
      {displayValue}
   </div>
   
HTML,

        'displayValue' => <<<HTML
<a data-last-value="{value}" id="modal-{id}-modal" class="displayValue-editable modal-trigger-button">
  {value}
</a>
HTML,

        'displayValueLink' => <<<HTML
<a id="modal-{id}-modal" class="displayValue-editable modal-trigger-button {text-color}">
  {value}
</a>
HTML,

        'displayValueReadonly' => <<<HTML
<span id="readonly-{id}" class="modal-trigger-button">
  {value}
</span>
HTML,


        'js' => <<<JS

  $('#editable-submit-{id}').click(function(event) {
      
      $('.spinner-border').fadeIn();
      $(this).addClass('clicked');
        
      $.ajax({
        method: 'POST',
        url: '{url}?' + $('#{id}-editable-form').serialize(),
        dataType: 'json',
        data: {
            hasEdit: 1,
            modelId: {modelId},
            session: {session},
            attribute: '{attribute}',
            name: '{name}',
            modelName: '{modelName}',
        }, 
        
        success: function(response) {
            $('#{id}-modal').modal('hide');
            var value = response.output;
            $(this).removeClass('clicked');
            $('.spinner-border').fadeOut();
            $('#modal-{id}-modal').html(value);
        }
      }).done({done}).fail({fail}).always({always});
      
    })
    
    $("#modal-{id}-modal").click(function () {
       $('#{id}-modal').modal('show');
    });
    
    /*$('#modal-{id}-modal').popoverX({
        closeOpenPopovers : true,
        autoPlaceSmallScreen : {autoPlaceSmallScreen},
        smallScreenWidth : {smallScreenWidth},
        keyboard : true,
        backdrop : null,
        remote :''
    });*/
    
    
JS,


        'css' => <<<CSS
        
        .displayValue-editable {
            width: 100%;
        }
        
CSS,


    ];


    private function getValue()
    {
        //vdd($this->value);
        $value = $this->value;

        //              vdd();
        if ($this->_config['session']) {
            $value = $this->sessionGet($this->name);
        } else {
            
                  
            Az::$app->forms->widata->clean();
            Az::$app->forms->widata->model = $this->model;
            Az::$app->forms->widata->attribute = $this->attribute;
            $value = Az::$app->forms->widata->value();

        }



        if (empty($value))
            $value = $this->_config['emptyValueText'];

        return $value;
    }

    public function getWidgetClasss($id, $widgetClass)
    {

        $widgetOptions = ZArrayHelper::merge($this->_config['options'], [
            'id' => $id . '-widget',
            'name' => $this->name,
            'data' => $this->data,
            'value' => $this->getValue(),
            'model' => $this->model,
            //'form' => $form,
        ]);

        return $widgetClass::widget($widgetOptions);
    }

    private function getDisplayValue($id)
    {
         if ($this->getValue() === null)  return 'fwdg';
        $displayValue = strtr($this->_layout['displayValueLink'], [
            '{value}' => $this->getValue(),
            '{id}' => $id,
            '{text-color}' => $this->_config['text-color'],
        ]);

        if ($this->readonly)
            $displayValue = strtr($this->_layout['displayValueReadonly'], [
                '{value}' => $this->getValue(),
                '{id}' => $id
            ]);

        return $displayValue;
    }


    public function codes()
    {

        $id = $this->id;
        $contentBtn = $this->getDisplayValue($id);

        $this->htm = strtr($this->_layout['main'], [
            '{displayValue}' => $contentBtn,
        ]);
        $model = null;
        $title = '';
        $widgetOptions = ZArrayHelper::merge($this->_config['options'], [

            'id' => $this->id,
            'name' => $this->name,
            'data' => $this->data,
            'value' => $this->getValue(),
            'model' => $this->model,

        ]);

        $modelId = 0;
        if ($this->_config['session']) {
            if ($this->_config['title'] !== null)
                $title = $this->_config['title'];
            $widget = $this->_config['widgetClass'];
            $url = '/api/core/edit/editable-session.aspx';

        } else {

            $model = clone $this->model;

            $column = $model->columns[$this->attribute];

            $widgetOptions = ZArrayHelper::merge($column->options, [
                'id' => $this->id
            ]);
            $modelId = $this->model->id;
            $title = $column->title;
            $widget = $column->widget;
            $url = '/api/core/app/editable.aspx';
        }

        $options = [
            'id' => $this->id,
            'config' => [
                'resetBtn' =>false,
                'size' => ZModalWidget::size['sm'],
                'button' => ZButtonWidget::widget([
                    'config' => [
                        'text' => 'asdasd'
                    ]
                ]),
                'isBtn' => false,
                'title' => $title,
                'submitId' => 'editable-submit-' . $this->id,
                'closeId' => 'editable-close-' . $this->id,
                'icon' => '',
            ]
        ];

        $active = new Ajaxer();
        $active->id = $this->id . '-' . 'editable-form';

        ZModalWidgetRavshan::begin($options);

        $form = $this->activeBegin($active);
        if ($this->_config['session'])
            echo $this->getWidgetClasss($this->id, $widget);
        else
            echo ZFormWidget::widget([
                'form' => $form,
                'model' => $model,
                'name' => $this->name,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ],
                'rows' => [
                    [
                        'attributes' => [
                            $this->attribute => [
                                'type' => Form::INPUT_WIDGET,
                                'widgetClass' => $widget,
                                'options' => $widgetOptions
                            ],
                        ]
                    ],
                ],
            ]);

        $this->activeEnd();

        ZModalWidgetRavshan::end();

       
        $this->js = strtr($this->_layout['js'], [
            '{modelId}' => $this->jscode($modelId),
            '{id}' => $this->jscode($this->id),
            '{url}' => $this->jscode($url),
            '{attribute}' => $this->jscode($this->attribute),
            '{name}' => $this->jscode($this->name),
            '{modelName}' => $this->jscode($this->modelClassName),
            '{session}' => $this->jscode($this->_config['session']),
            '{always}' => $this->eventCode('editableAjaxComplete'),
            '{fail}' => $this->eventCode('editableAjaxError'),
            '{done}' => $this->eventCode('editableAjaxSuccess'),
        ]);

        $this->css = strtr($this->_layout['css'], []);

    }
}
