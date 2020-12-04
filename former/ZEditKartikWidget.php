<?php

namespace zetsoft\widgets\former;

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use zetsoft\dbitem\data\Form;
use zetsoft\former\shop\shopSizeForm;
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
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/**
 * Class ZKEditableWidget
 * @package widgets\blocks
 * http://demos.krajee.com/editable
 */
class ZEditKartikWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'session' => false,
        'editButtonLabel' => '',
        'editButtonIcon' => FA::_PEN_SQUARE,
        'pjaxContainerId' => '',
        'asPopover' => false,
        'templateBefore' => '{header}',
        'templateAfter' => '{loading}{buttons}{close}',
        'displayValueConfig' => [],
        'displayValue' => '',
        'submitOnEnter' => false,
        'afterInput' => '',
        'placement' => ZEditKartikWidget::placement['ALIGN_AUTO'],
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
        'mainClass' => self::mainClass['editable'],

    ];

    public const mainClass = [
        'editable' => Editable::class,
        'editableModal' => Editable::class,
        'editableSweet' => Editable::class,
        'editablePopX' => Editable::class,
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

    public const placement = [
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

    public const popover = [

        'TYPE_DEFAULT' => PopoverX::TYPE_DEFAULT,
        'TYPE_PRIMARY' => PopoverX::TYPE_PRIMARY,
        'TYPE_INFO' => PopoverX::TYPE_INFO,
        'TYPE_DANGER' => PopoverX::TYPE_DANGER,
        'TYPE_WARNING' => PopoverX::TYPE_WARNING,
        'TYPE_SUCCESS' => PopoverX::TYPE_SUCCESS,

        
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
        'buttons' => <<<HTML
   <div class="d-flex justify-content-end">
       {reset}{submit}
   </div>
HTML,

    ];


    private function getValue()
    {

        $value = $this->value;

        $sessionValue = $this->sessionGet($this->attribute);
        if (!empty($sessionValue))
            $value = $sessionValue;

        if (is_array($value)) {
            foreach ($value as $val) {
                if (!empty($val))
                    $value = ZVarDumper::beauty($value);
                else
                    $value = '';
            }
        }


        return $value;
    }

    public function codes()
    {

        $buttons = strtr($this->_layout['buttons'], [
            '{reset}' => ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Reset'),
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnRounded' => false,
                    'hasIcon' => true,
                    'btnSize' => ZColor::btnSize['btn-md'],
                    'icon' => 'fas fa-trash',
                    'class' => 'kv-editable-reset',
                    'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
                ]
            ]),
            '{submit}' => ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Save'),
                    'btnType' => ZButtonWidget::btnType['button'],
                    'hasIcon' => true,
                    'btnRounded' => false,
                    'icon' => 'fas fa-save',
                    'btnSize' => ZColor::btnSize['btn-md'],
                    'class' => 'kv-editable-submit',
                    'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                ]
            ])
        ]);

        $value = $this->getValue();

        if (empty($this->_config['displayValue']))
            $this->_config['displayValue'] = $value;

        if ($this->_config['session'])
            $url = ZUrl::to([
                '/api/core/edit/editable-session',
                'name' => $this->name,
            ]);
        else
            $url = ZUrl::to([
                '/api/core/edit/editable',
                'modelClassName' => $this->model->className,
                'attribute' => $this->attribute,
                'id' => $this->model->id,
            ]);
         

        $this->options = [
            'bsVersion' => $this->bsVersion,
            'ajaxSettings' => [
                'url' => $url
            ],
            'options' => ZArrayHelper::merge($this->_config['options'], [
                'value' => 'uz'
            ]),
            'pjaxContainerId' => $this->_config['pjaxContainerId'],
            'format' => $this->_config['format'],
            'asPopover' => $this->_config['asPopover'],

            'inlineSettings' => [
                'options' => ['class' => 'panel panel-default'],
                'closeButton' => false,
                'templateBefore' => $this->_config['templateBefore'],
                'templateAfter' => $this->_config['templateAfter'],
            ],
            'widgetClass' => $this->_config['widgetClass'],
            'formClass' => $this->_config['formClass'],

            'editableButtonOptions' => [
                'label' => $this->_config['editButtonLabel'],
                'icon' => $this->_config['editButtonIcon'],
                'class' => 'p-2 btn btn-rounded btn-outline-success'
            ],
            'editableValueOptions' => [],
            'containerOptions' => [],
            'placement' => $this->_config['placement'],
            'preHeader' => FA::_EDIT . Az::l('Edit'),
            'size' => PopoverX::SIZE_LARGE,
            'valueIfNull' => '<em>(Not set)</em>',

            'formOptions' => [
                'method' => 'post',
                'action' => $url
            ],

            'inputFieldConfig' => [],
            'showButtons' => false,
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kveditable/messages',
                'forceTranslation' => true
            ],
            'showButtonLabels' => false,
            'buttonsTemplate' => $buttons,
            'submitButton' => [
                'icon' => FA::_CHECK,
                'label' => Az::l('Apply')
            ],
            'resetButton' => [
                'icon' => FA::_BAN,
                'label' => Az::l('Reset')
            ],

            'submitOnEnter' => $this->_config['submitOnEnter'],
            'showAjaxErrors' => true,
            'encodeOutput' => true,
            'pluginEvents' => [
                'editableChange' => $this->eventCode('editableChange'),
                'editableSubmit' => $this->eventCode('editableSubmit'),
                'editableBeforeSubmit' => $this->eventCode('editableBeforeSubmit'),
                'editableReset' => $this->eventCode('editableReset'),
                "editableSuccess" => $this->eventCode('editableSuccess'),
                "editableError" => $this->eventCode('editableError'),
                "editableAjaxError" => $this->eventCode('editableAjaxError'),
            ],
            'header' => $this->_config['header'],
            'displayValueConfig' => $this->_config['displayValueConfig'],

            'displayValue' => $this->_config['displayValue'],

            'inputType' => $this->_config['inputType'],

            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'value' => $value,
            'data' => $this->data,

        ];


        //vdd($this->options);
        $this->htm = $this->_config['mainClass']::widget($this->options);
    }
}
