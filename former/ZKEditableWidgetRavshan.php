<?php

namespace zetsoft\widgets\former;

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use zetsoft\dbitem\data\Form;
use zetsoft\former\shop\shopSizeForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use kartik\editable\Editable;
use kartik\popover\PopoverX;
use yii\web\JsExpression;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\values\ZFormViewWidget;

/**
 * Class ZKEditableWidget
 * @package widgets\blocks
 * http://demos.krajee.com/editable
 */
class ZKEditableWidgetRavshan extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'pjaxContainerId' => '',
        'asPopover' => false,
        'templateBefore' => '{header}',
        'templateAfter' => '{loading}{buttons}{close}',
        'displayValueConfig' => [],
        'submitOnEnter' => false,
        'afterInput' => '',
        'placement' => ZEditKartikWidget::popover['ALIGN_RIGHT_BOTTOM'],
        'displayValue' => null,
        'valueWidgetConfig' => [],
        'valueWidget' => null,
        'header' => '',
        'inputType' => ZEditKartikWidget::type['INPUT_WIDGET'],
        'format' => ZEditKartikWidget::format['link'],
        'template' => ZEditKartikWidget::template['INLINE_AFTER_1'],
        'buttonType' => ZEditKartikWidget::popover['ALIGN_RIGHT_BOTTOM'],
        'widgetClass' => '',
        'formClass' => ActiveForm::class,
        'beforeInput' => '',
        'formAction' => [],
        'formOptions' => [],
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
        'LOAD_INDICATOR' => Editable::LOAD_INDICATOR,
        'CSS_PARENT' => Editable::CSS_PARENT,
    ];

    public const format = [
        'link' => Editable::FORMAT_LINK,
        'button' => Editable::FORMAT_BUTTON,
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

    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
       'beforeSubmit' => "function(){console.log('editableWidget')}",
       'reset' => "function(){console.log('editableWidget')}",
       'success' => "function(){console.log('editableWidget')}",
       'submit' => "function(){console.log('editableWidget')}",
       'change' => "function(){console.log('editableWidget')}",
    ];


    public function codes()
    {
        $closeButton = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'icon' => 'fa fa-' . FA::_TIMES,
                'btnRounded' => false,
                'class' => 'kv-editable-close close m-0',
                'btnStyle' => ZColor::btnStyle['btn-danger'],
                'btnSize' => ZButtonWidget::btnSize['btn-md'],
            ]
        ]);



        $this->options = [
            'bsVersion' => $this->bsVersion,
            'ajaxSettings' => [
                'url' => ZUrl::to([
                    '/api/core/editable/editable',
                    'modelClassName' => $this->model->className,
                    'id' => $this->model->id,
                ]),
            ],
            'options' => $this->_config['options'],
            'pjaxContainerId' => $this->_config['pjaxContainerId'],
            'format' => $this->_config['format'],
            'asPopover' => $this->_config['asPopover'],

            'inlineSettings' => [
                'options' => ['class' => 'panel panel-default'],
                'closeButton'  => $closeButton,
                'templateBefore' => $this->_config['templateBefore'],
                'templateAfter' => $this->_config['templateAfter'],
            ],
            'widgetClass' => $this->_config['widgetClass'],


            'editableButtonOptions' => [
                'label' => FA::_PEN_SQUARE,
                'editableValueOptions' => [],
                'containerOptions' => [],
                // 'type' => $this->_config['buttonType'],
                'placement' => $this->_config['placement'],
                'preHeader' => FA::_EDIT . Az::l('Edit'),
                'header' => null,
                'size' => PopoverX::SIZE_LARGE,
                //'displayValue' => null,
                'valueIfNull' => '<em>(Not set)</em>',
                'contentOptions' => '',

                'form' => $this->form,
                'formOptions' => [
                    'method' => 'post',
                    'action' => ZUrl::to([
                        '/api/core/editable/editable',
                        'modelClassName' => $this->modelClassName,
                        'id' => $this->model->id,
                    ]),
                ],
                'formClass' => $this->_config['formClass'],
                'inputFieldConfig' => [],
                'templateInput' => $this->_config['template'],
                'showButtons' => true,
                'i18n' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@kveditable/messages',
                    'forceTranslation' => true
                ],
                'showButtonLabels' => true,
                'buttontemplate' => '{reset}{submit}',
                'submitButton' => [
                    'icon' => FA::_CHECK,
                    'label' => Az::l('Apply')
                ],
                'resetButton' => [
                    'icon' => FA::_BAN,
                    'label' => Az::l('reset')
                ],

                'ajaxSettings' => [],
                'submitOnEnter' => $this->_config['submitOnEnter'],
                'showAjaxErrors' => true,
                'encodeOutput' => true,
                'pluginEvents' => [
                    'editableChange' => $this->eventCode('change'),
                    'editableSubmit' => $this->eventCode('submit'),
                    'editableBeforeSubmit' => $this->eventCode('beforeSubmit'),
                    'editableReset' => $this->eventCode('reset'),
                    "editableSuccess" => $this->eventCode('success'),
                   // "editableError" => $this->eventCode('error'),
                   // "editableAjaxError" => $this->eventCode('ajaxError'),
                ]


            ],

            /**
             * HTML attributes for the container enclosing the main content and the editable form in the popover dialog
             */
            'contentOptions' => [],
            'header' => $this->_config['header'],
            'displayValueConfig' => $this->_config['displayValueConfig'],

            //'displayValue' => $this->_config['displayValue'],


            'inputType' => $this->_config['inputType'],

            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'value' => $this->value,
            'data' => $this->data,

        ];

        //vdd($this->options);
        $this->htm = Editable::widget($this->options);
    }
}
