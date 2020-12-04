<?php

namespace zetsoft\widgets\former;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use kartik\editable\Editable;
use kartik\popover\PopoverX;
use yii\web\JsExpression;

/**
 * Class ZKEditableWidget
 * @package widgets\blocks
 * http://demos.krajee.com/editable
 */
class ZEditableWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'pjaxContainerId' => '',
        'asPopover' => true,
        'displayValueConfig' => [],
        'submitOnEnter' => false,
        'afterInput' => '',
        'placement' => '',
        'displayValue' => '',
        'header' => '',
       /* 'inputType' => ZEditKartikWidget::type['INPUT_WIDGET'],
        'format' => ZEditKartikWidget::format['FORMAT_LINK'],
        'template' => ZEditKartikWidget::template['INLINE_AFTER_2'],
        'buttonType' => ZEditKartikWidget::popover['ALIGN_AUTO_VERTICAL'],*/
        'widgetClass' => '',
        'formClass' => '\kartik\form\ActiveForm',
        'beforeInput' => '',
        'formAction' => 'editdemo',
        'autoGuessInput' => true,
        'options' => [],
    ];

    /**
     *
     * Constants
     */

    public const type = [
        'INPUT_HIDDEN' => Editable::INPUT_HIDDEN,
        'INPUT_TEXTAREA' => Editable::INPUT_TEXTAREA,
        'INPUT_PASSWORD' => Editable::INPUT_PASSWORD,
        'INPUT_DROPDOWN_LIST' => Editable::INPUT_DROPDOWN_LIST,
        'INPUT_LIST_BOX' => Editable::INPUT_LIST_BOX,
        'INPUT_CHECKBOX' => Editable::INPUT_CHECKBOX,
        'INPUT_RADIO' => Editable::INPUT_RADIO,
        'INPUT_CHECKBOX_LIST' => Editable::INPUT_CHECKBOX_LIST,
        'INPUT_RADIO_LIST' => Editable::INPUT_RADIO_LIST,
        'INPUT_CHECKBOX_BUTTON_GROUP' => Editable::INPUT_CHECKBOX_BUTTON_GROUP,
        'INPUT_RADIO_BUTTON_GROUP' => Editable::INPUT_RADIO_BUTTON_GROUP,
        'INPUT_MULTISELECT' => Editable::INPUT_MULTISELECT,
        'INPUT_FILE' => Editable::INPUT_FILE,
        'INPUT_HTML5' => Editable::INPUT_HTML5,
        'INPUT_WIDGET' => Editable::INPUT_WIDGET,
        'INPUT_DEPDROP' => Editable::INPUT_DEPDROP,
        'INPUT_SELECT2' => Editable::INPUT_SELECT2,
        'INPUT_TYPEAHEAD' => Editable::INPUT_TYPEAHEAD,
        'INPUT_SWITCH' => Editable::INPUT_SWITCH,
        'INPUT_SPIN' => Editable::INPUT_SPIN,
        'INPUT_RATING' => Editable::INPUT_RATING,
        'INPUT_RANGE' => Editable::INPUT_RANGE,
        'INPUT_COLOR' => Editable::INPUT_COLOR,
        'INPUT_FILEINPUT' => Editable::INPUT_FILEINPUT,
        'INPUT_DATE' => Editable::INPUT_DATE,
        'INPUT_TIME' => Editable::INPUT_TIME,
        'INPUT_DATETIME' => Editable::INPUT_DATETIME,
        'INPUT_DATE_RANGE' => Editable::INPUT_DATE_RANGE,
        'INPUT_SORTABLE' => Editable::INPUT_SORTABLE,
        'INPUT_SLIDER' => Editable::INPUT_SLIDER,
        'INPUT_MONEY' => Editable::INPUT_MONEY,
        'INPUT_CHECKBOX_X' => Editable::INPUT_CHECKBOX_X,
        //'LOAD_INDICATOR' => Editable::LOAD_INDICATOR,
        'CSS_PARENT' => Editable::CSS_PARENT,
    ];

    public const format = [
        'FORMAT_LINK' => Editable::FORMAT_LINK,
        'FORMAT_BUTTON' => Editable::FORMAT_BUTTON,
    ];

    public const template = [
        'INLINE_BEFORE_1' => Editable::INLINE_BEFORE_1,
        'INLINE_BEFORE_2' => Editable::INLINE_BEFORE_2,
        'INLINE_AFTER_1' => Editable::INLINE_AFTER_1,
        'INLINE_AFTER_2' => Editable::INLINE_AFTER_2,
    ];

    public const popover = [

        'TYPE_DEFAULT' => PopoverX::TYPE_DEFAULT,
        'TYPE_PRIMARY' => PopoverX::TYPE_PRIMARY,
        'TYPE_INFO' => PopoverX::TYPE_INFO,
        'TYPE_DANGER' => PopoverX::TYPE_DANGER,
        'TYPE_WARNING' => PopoverX::TYPE_WARNING,
        'TYPE_SUCCESS' => PopoverX::TYPE_SUCCESS,

        'ALIGN_AUTO' => PopoverX::ALIGN_AUTO,
        'ALIGN_AUTO_TOP' => PopoverX::ALIGN_AUTO_TOP,
        'ALIGN_AUTO_RIGHT' => PopoverX::ALIGN_AUTO_RIGHT,
        'ALIGN_AUTO_BOTTOM' => PopoverX::ALIGN_AUTO_BOTTOM,
        'ALIGN_AUTO_LEFT' => PopoverX::ALIGN_AUTO_LEFT,
        'ALIGN_AUTO_HORIZONTAL' => PopoverX::ALIGN_AUTO_HORIZONTAL,
        'ALIGN_AUTO_VERTICAL' => PopoverX::ALIGN_AUTO_VERTICAL,
        'ALIGN_RIGHT' => PopoverX::ALIGN_RIGHT,
        'ALIGN_LEFT' => PopoverX::ALIGN_LEFT,
        'ALIGN_TOP' => PopoverX::ALIGN_TOP,
        'ALIGN_BOTTOM' => PopoverX::ALIGN_BOTTOM,
        'ALIGN_TOP_LEFT' => PopoverX::ALIGN_TOP_LEFT,
        'ALIGN_BOTTOM_LEFT' => PopoverX::ALIGN_BOTTOM_LEFT,
        'ALIGN_TOP_RIGHT' => PopoverX::ALIGN_TOP_RIGHT,
        'ALIGN_BOTTOM_RIGHT' => PopoverX::ALIGN_BOTTOM_RIGHT,
        'ALIGN_LEFT_TOP' => PopoverX::ALIGN_LEFT_TOP,
        'ALIGN_RIGHT_TOP' => PopoverX::ALIGN_RIGHT_TOP,
        'ALIGN_LEFT_BOTTOM' => PopoverX::ALIGN_LEFT_BOTTOM,
        'ALIGN_RIGHT_BOTTOM' => PopoverX::ALIGN_RIGHT_BOTTOM,
        'SIZE_LARGE' => PopoverX::SIZE_LARGE,
        'SIZE_MEDIUM' => PopoverX::SIZE_MEDIUM,
    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => 'function(event, val) { console.log(ZKEditableWidget | Changed Value + val); }',
        'submit' => 'function(event, val, form) { console.log(ZKEditableWidget | Submitted Value ) }',
        'beforeSubmit' => 'function(event, val, form, jqXHR) { console.log(ZKEditableWidget | Before submit triggered  ) }',
        'reset' => 'function(event) { console.log(ZKEditableWidget | Reset editable form); }',
        'success' => 'function(event, val, form, data) { console.log( ZKEditableWidget | Successful submission of value + val); }',
        'error' => 'function(event, val, form) { console.log(ZKEditableWidget | Submitted Value ) }',

        'ajaxError' => 'function(event, jqXHR, status, message) { console.log("ZKEditableWidget | message"); }'
    ];


    public function codes()
    {
        //vdd($this->model->className);

        $this->options = [

           /* 'bsVersion' => $this->bsVersion,
            'pjaxContainerId' => $this->_config['pjaxContainerId'],
            'format' => $this->_config['format'],
            'asPopover' => $this->_config['asPopover'],

            'inlineSettings' => [
                'options' => ['class' => 'panel panel-default'],
                'closeButton' => 'closeButton',
                'template' => $this->_config['template'],
            ],*/

            'formOptions' => [
                'method' => 'post',
                'action' => [
                    'editable',
                    'modelClassName' => $this->model->className,
                    'id' => $this->model->id
                ],
            ],


         /*   'editableButtonOptions' => [
                'label' => FA::_PEN_SQUARE,
                'editableValueOptions' => [],
                'containerOptions' => [],
                'type' => $this->_config['buttonType'],
                'placement' => $this->_config['placement'],
                'preHeader' => FA::_EDIT . Az::l('Edit'),
                'header' => null,

                'displayValue' => null,
                'valueIfNull' => '<em>(not set)</em>',
                'contentOptions' => '',
                'inputType' => $this->_config['inputType'],
                'form' => $this->_config['formClass'],

            ],*/
            'widgetClass' => $this->_config['widgetClass'],
            'options' => $this->_config['options'],
    
           /* 'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kveditable/messages',
                'forceTranslation' => true
            ],
            'showButtonLabels' => true,
            'buttonsTemplate' => '{reset}{submit}',
            'submitButton' => [
                'icon' => '<i class="fas fa-check"></i>' ,
                'label' => Az::l('Apply')
            ],
            'resetButton' => [
                'icon' => '<i class="fas fa-ban"></i>',
                'label' => Az::l('reset')
            ],*/
            /**
             * ajaxSettings
             * http://api.jquery.com/jquery.ajax/
             */
          /*  'ajaxSettings' => [],
            'submitOnEnter' => $this->_config['submitOnEnter'],
            'showAjaxErrors' => true,
            'encodeOutput' => true,*/
            /*'pluginEvents' => [
                'editableChange' => $this->eventCode('change'),
                'editableSubmit' => $this->eventCode('submit'),
                'editableBeforeSubmit' => $this->eventCode('beforeSubmit'),
                'editableReset' => $this->eventCode('reset'),
                "editableSuccess" => $this->eventCode('success'),
                "editableError" => $this->eventCode('error'),
                "editableAjaxError" => $this->eventCode('ajaxError'),
            ]*/


            /**
             * HTML attributes for the container enclosing the main content and the editable form in the popover dialog
             */
            /* 'contentOptions' => [],*/
             /*'header' => $this->_config['header'],*/
             /*'displayValueConfig' => $this->_config['displayValueConfig'],
             'displayValue' => $this->_config['displayValue'],*/

            /* 'pluginOptions' => [
                 'class' => ZEditable::class
             ],*/
            'model' => $this->model,
            'attribute' => $this->attribute,
            /*'name' => $this->name,
            'value' => $this->value,
            'data' => $this->data,*/

        ];

         $this->options;
        $this->htm = Editable::widget($this->options);
    }
}
