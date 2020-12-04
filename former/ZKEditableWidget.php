<?php

namespace zetsoft\widgets\former;

use kartik\builder\Form;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use zetsoft\former\shop\shopSizeForm;
use zetsoft\models\place\PlaceCountry;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;
use kartik\editable\Editable;
use kartik\popover\PopoverX;
use yii\web\JsExpression;
use zetsoft\widgets\actions\ZEasySelectableWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZPopoverXWidget;

/**
 * Class ZKEditableWidget
 * @package widgets\blocks
 * http://demos.krajee.com/editable
 */
class ZKEditableWidget extends ZWidget
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

    public static $grapes = [
        'width' => '600px',
        'height' => '750px',
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
   <div class="rv-editable-link d-flex justify-content-center">
      {displayValue}
   </div>
   
HTML,

        'displayValueLink' => <<<HTML
<a id="modal-{id}-modal" class="displayValue-editable modal-trigger-button">
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
        url: '/api/core/app/sorting.aspx?' + $('#{id}-editable-form').serialize(),
        dataType: 'json',
        data: {
            hasEdit: 1,
            modelId: {modelId},
            session: {session},
            attribute: '{attribute}',
            modelName: '{modelName}',
        }, 
        
        success: function(response) {
            $('#{id}-modal').modal('hide');
            var value = response.output;
            $('#editable-submit-{id}').removeClass('clicked');
            $('.spinner-border').fadeOut();
            $('#modal-{id}-modal').html(value);
        }
      })
      
    })
    
    $("#modal-{id}-modal").click(function () {
       $('#{id}-modal').modal('show');
    });
    
JS,


        'css' => <<<CSS
        
        .displayValue-editable {
            color: royalblue!important;
            width: 100%;
        }
        
CSS,


    ];


    private function getValue2()
    {

        $value = $this->value;

        $sessionValue = $this->sessionGet($this->attribute);

        switch (true) {
            case !empty($this->data):
                $value = ZArrayHelper::getValue($this->data, $value);
                break;

            case is_array($value):
                foreach ($value as $val) {
                    if (!empty($val))
                        $value = ZVarDumper::beauty($value);
                    else
                        $value = 'null';
                }
                break;

            case !empty($sessionValue):
                $value = $sessionValue;
                break;
        }

        

        if (empty($value))
            $value = $this->valueIfNull;

        return $value;
    }

    private function getValue()
    {
       
        Az::$app->forms->widata->clean();
        Az::$app->forms->widata->model = $this->model;
        Az::$app->forms->widata->attribute = $this->attribute;
        $value = Az::$app->forms->widata->value();
        
        if (empty($value))
            $value = $this->valueIfNull;

        return $value;
    }

    public function getWidgetClasss($id, $widgetClass) {

        $widgetOptions = ZArrayHelper::merge($this->_config['options'], [
            'id' => $id . '-widget',
            'name' => $this->name,
            'data' => $this->data,
            'value' => $this->value,
            'model' => $this->model,
        ]);

        return $widgetClass::widget($widgetOptions);
    }

    private function getDisplayValue($id) {

        $displayValue = strtr($this->_layout['displayValueLink'], [
            '{value}' => $this->getValue(),
            '{id}' => $id
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

        $model = clone $this->model;

        $column = $model->columns[$this->attribute];

        $widgetOptions = ZArrayHelper::merge($this->_config['options'], [
            'id' => $this->id,
        ]);

        $options = [
            'id' => $this->id,
            'config' => [
                'isBtn' => false,
                'title' => $column->title,
                'submitText' => Az::l('Применить'),
                'resetText' => Az::l('Очистить'),
                'submitId' => 'editable-submit-' . $this->id,
                'closeId' => 'editable-close-' . $this->id,
            ]
        ];

        $active = new Ajaxer();
        $active->id = $this->id . '-' . 'editable-form';

        ZModalWidgetRavshan::begin($options);

        $form = $this->activeBegin($active);

        $model = clone $this->model;
        $model->configs->nameOn = [$this->attribute];
        $model->columns();

        echo ZFormWidget::widget([
            'form' => $form,
            'model' => $model,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
        ]);

        $this->activeEnd();

        ZModalWidgetRavshan::end();

        $modelId = $this->model->id;

        $this->js = strtr($this->_layout['js'], [
            '{modelId}' => $this->jscode($modelId),
            '{id}' => $this->jscode($this->id),
            '{attribute}' => $this->jscode($this->attribute),
            '{modelName}' => $this->jscode($this->modelClassName),
            '{session}' => $this->jscode($this->_config['isSession'])
        ]);

        $this->css = strtr($this->_layout['css'], []);

    }
}
