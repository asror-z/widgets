<?php

namespace zetsoft\widgets\former;

use kartik\builder\Form;
use kartik\form\ActiveForm;
use zetsoft\dbitem\data\FormDb;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\system\schema\ColumnSchema;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\notifier\ZModalWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZPopoverXWidget;
use zetsoft\widgets\places\ZGoogleWidget;

/**
 * Class ZKEditableWidget
 * @package widgets\blocks
 * http://demos.krajee.com/editable
 */
class ZEditableModalWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $widgetClass;
    public $readonly = false;
    public $valueIfNull = Azl . 'Не задано';

    public $config = [];
    public $_config = [
        'pjaxContainerId' => '',
        'isSession' => false,
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
        'editableSuccess' => 'function(event, val, form, data) { console.log( "ZKEditableWidget | Successful submission of value"); }',
        'editableError' => 'function(event, val, form) { console.log("ZKEditableWidget | Submitted Value" ) }',

        'editableAjaxError' => 'function(event, jqXHR, status, message) { console.log("ZKEditableWidget | message"); }'
    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   <div class="rv-editable-link {class} d-flex justify-content-center">
      {displayValue}
   </div>
   
HTML,

        'displayValueLink' => <<<HTML
<a id="modal-{id}-modal" class="displayValue-editable modal-trigger-button">
  {value}
</a>
HTML,

        'displayValueReadonly' => <<<HTML
<span style="width:100%" id="readonly-{id}" class="modal-trigger-button">
  {value}
</span>
HTML,


        'js' => <<<JS

  $('#editable-submit-{id}').click(function(event) {
      
      $('.spinner-border').fadeIn();
      $(this).addClass('clicked');
      $.ajax({
        method: 'POST',
        url: '/api/core/app/sorting.aspx?' + $('#{id}-editable-form').serialize(),
        dataType: 'json',
        data: {
            hasEdit: true,
            modelId: {modelId},
            session: {session},
            attribute: '{attribute}',
            modelName: '{modelName}',
            formName: '{formName}',
        }, 
        
        success: function(response) {
            $('#{id}-modal').modal('hide');
            var value = response.output;
            $('#editable-submit-{id}').removeClass('clicked');
            $('.spinner-border').fadeOut();
                   
            console.log('value')        
            console.log(value)        
            console.log('value')        
                   
            $('#modal-{id}-modal').html(value);
        }
      })
      
    })
    
    $("#modal-{id}-modal").click(function () {
       $('#{id}-modal').modal('show');
    });
    
    
    $("#editable-reset-{id}").click(function () {
        //$('#{widgetId}').val($('#modal-{id}-modal').attr('last-value'))
        $('#modal-{id}-modal').html($('#modal-{id}-modal').attr('last-value'))
        $('#{id}-modal').modal('hide');
    });
    
JS,


        'css' => <<<CSS
        
        .displayValue-editable {
            color: royalblue!important;
            width: 100%;
        }
        
CSS,


    ];

    private function getValue()
    {

        Az::$app->forms->wiData->clean();
        Az::$app->forms->wiData->model = $this->model;
        Az::$app->forms->wiData->attribute = $this->attribute;
        $value = Az::$app->forms->wiData->value();

        if (empty($value))
            $value = $this->valueIfNull;

        return $value;

    }

    public function getWidgetClasss($id, $widgetClass)
    {

        $widgetOptions = ZArrayHelper::merge($this->_config['options'], [
            'id' => $id . '-widget',
            'name' => $this->name,
            'data' => $this->data,
            'value' => $this->value,
            'model' => $this->model,
        ]);

        return $widgetClass::widget($widgetOptions);
    }

    private function getDisplayValue($id)
    {

        $displayValue = strtr($this->_layout['displayValueLink'], [
            '{value}' => $this->getValue(),
            '{id}' => $id,
        ]);

        if ($this->readonly)
            $displayValue = strtr($this->_layout['displayValueReadonly'], [
                '{value}' => $this->getValue(),
                '{id}' => $id
            ]);

        return $displayValue;
    }

    private function getWidthModal($column)
    {

        $smallWidgets = [
            ZKSelect2Widget::class,
            ZHInputWidget::class,
            ZSelect2Widget::class,
            ZKSwitchInputWidget::class,
        ];

        $largeWidgets = [
            ZMultiWidget::class,
            ZGoogleWidget::class,
        ];

        switch (true) {

            case ZArrayHelper::isIn($column->widget, $largeWidgets):
                $width = ZModalWidgetRavshan::width['10x'];
                break;


            case ZArrayHelper::isIn($column->widget, $smallWidgets):
                $width = ZModalWidgetRavshan::width['5x'];
                break;

            default:
                $width = ZModalWidgetRavshan::width['7x'];
                break;

        }

        return $width;
    }


    /**
     *
     * Function  getOptionsModal
     * @param FormDb $column
     * @return  array
     */
    private function getOptionsModal($column)
    {

        $width = $this->getWidthModal($column);
        return [
            'id' => $this->id,
            'config' => [
                'width' => $column->modalWidth,
                'isBtn' => false,
                'title' => $column->title,
                'resetText' => Az::l('Очистить'),
                'submitText' => Az::l('Применить'),
                'submitId' => 'editable-submit-' . $this->id,
                'resetId' => 'editable-reset-' . $this->id,
                'closeId' => 'editable-close-' . $this->id,
            ]
        ];

    }

    private function getForm($column)
    {

        $column->options = $this->_config['options'];


        $formClass = $this->modelClass;

        switch (true) {

            case ZArrayHelper::keyExists('formClass', $column->options['config']):
                $formClass = $column->options['config']['formClass'];
                break;

            case ZArrayHelper::keyExists('formAttr', $column->options['config']):
                $attr = $column->options['config']['formAttr'];
                $formClass = $this->model->$attr;
                break;

        }

        /** @var Models $getForm */
        $getForm = new $formClass();
        $list = $getForm->columnsList();

        foreach ($list as $key => $columnName) {

            $id = $getForm->className . '-' . $columnName . '-' . $this->model->id;
            $column = $getForm->columns[$columnName];

            $column->options = ZArrayHelper::merge($column->options, [
                'id' => $id,
                'model' => $this->model,
                'attribute' => $this->attribute,
                'config' => [
                    'dependAttr' => '-' . $this->model->id,
                    'isDepend' => true,
                ]
            ]);

        }

        return $getForm;

    }


    public function codes()
    {

        $column = $this->model->columns[$this->attribute];

        #region Modal

        $modalOptions = $this->getOptionsModal($column);

        ZModalWidgetRavshan::begin($modalOptions);

        $active = new Ajaxer();
        $active->id = $this->id . '-' . 'editable-form';
        $getForm = $this->getForm($column);

        $form = $this->activeBegin($active);

        echo ZFormWidget::widget([
            'form' => $form,
            'model' => $this->model,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
            'rows' => [
                [
                    'attributes' => [
                        $this->attribute => [
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => $this->_config['widgetClass'],
                            'options' => ZArrayHelper::merge($this->_config['options'], [
                                'config' => [
                                    'formObject' => $getForm,
                                ]
                            ])
                        ],
                    ]
                ],
            ],
        ]);

        $this->activeEnd();

        ZModalWidgetRavshan::end();

        #endregion

        $contentBtn = $this->getDisplayValue($this->id);
        $this->htm = strtr($this->_layout['main'], [
            '{displayValue}' => $contentBtn,
            '{class}' => $this->_config['class'],
        ]);

        $this->css = strtr($this->_layout['css'], []);

        $this->js = strtr($this->_layout['js'], [
            '{modelId}' => $this->jscode($this->model->id),
            '{id}' => $this->jscode($this->id),
            '{attribute}' => $this->jscode($this->attribute),
            '{modelName}' => $this->jscode($this->modelClassName),
            '{formName}' => $this->jscode($getForm->className),
            '{session}' => $this->jscode($this->_config['isSession'])
        ]);

    }

}
