<?php

namespace zetsoft\widgets\inptest;

use kartik\helpers\Html;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2AjaxWidget
 * http://demos.krajee.com/widget-details/select2
 * Asror Zakirov
 */
class ZKSelect2AjaxWidget extends ZWidget
{
    /**
     *
     * Configuration
     */
    public $config = [];
    public $_config = [
        'addonPrependContent' => false,
        'addonAppendContent' => false,
        'isHideSearch' => false,
        'isMaintainOrder' => false,
        'contentBefore' => '',
        'class' => 'kv-editable-input',
        'contentAfter' => '',
        'allowClear' => false,
        'theme' => ZKSelect2AjaxWidget::theme['classic'],
        'size' => ZKSelect2AjaxWidget::size['lg'],
        'inpLength'=>2,
        'url'=>"/core/tester/restjson/ajax.aspx" ,
        'ajax' =>'ajax',
    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2AjaxWidget | $eventChange") ',
        'opening' => ' console.log("ZKSelect2AjaxWidget | $eventOpening") ',
        'open' => ' console.log("ZKSelect2AjaxWidget | $eventOpen") ',
        'closing' => ' console.log("ZKSelect2AjaxWidget | $eventClosing") ',
        'close' => ' console.log("ZKSelect2AjaxWidget | $eventClose") ',
        'selecting' => ' console.log("ZKSelect2AjaxWidget | $eventSelecting") ',
        'select' => ' console.log("ZKSelect2AjaxWidget | $eventSelect") ',
        'unSelecting' => ' console.log("ZKSelect2AjaxWidget | $eventUnSelecting") ',
        'unselect' => ' console.log("ZKSelect2AjaxWidget | $eventUnselect") ',
    ];


    /**
     *
     * Constants
     */

    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'material' => 'material',
        'krajee-bs4' => 'krajee-bs4',
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    /**
     *
     * Function  option
     * https://demos.krajee.com/widget-details/select2#settings
     */

    private function _addon($content)
    {
        if ($content)
            $prepend['content'] = $content;

        $prepend['asButton'] = false;

        return $prepend;
    }

    public function codes()
    {

        $this->layout = [
            'main' => <<<HTML
          <i class="{icon}"></i>
          
HTML,


        ];

        if ($this->_config['hasIcon']) {
            $getIcon = strtr($this->layout['main'], [
                '{icon}' => $this->_config['icon'],
            ]);
        } else {
            $getIcon = null;
        }

        $this->options = [
            'bsVersion' => $this->bsVersion,
            'data' => $this->data,
            'language' => Az::$app->language,
            'theme' => $this->_config['theme'],
            'changeOnReset' => true,
            'hideSearch' => $this->_config['isHideSearch'],
            'maintainOrder' => $this->_config['isMaintainOrder'],
            'showToggleAll' => true,
            'toggleAllSettings' => [
                'selectLabel' => '<i class="fas fa-ok-circle"></i> Tag All',
                'unselectLabel' => '<i class="far fa-check-square"></i> Unselect all',
                'selectOptions' => [],
                'unselectOptions' => [],
                'options' => ['class' => 's2-togall-button']
            ],
            'initValueText' => '',
            'addon' => [
                'prepend' => [
                    'content' => $getIcon,
                    $this->_addon($this->_config['addonPrependContent']),
                ],

                'append' => $this->_addon($this->_config['addonAppendContent']),
                'groupOptions' => [],
                'contentBefore' => $this->_config['contentBefore'],
                'contentAfter' => $this->_config['contentAfter']

            ],
            'size' => $this->_config['size'],
            'disabled' => $this->_config['readonly'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                'id' => $this->id,
                'multiple' => $this->_config['multiple'],
                'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
                /* 'placeholder' => $this->value ?? '', */
                'class' => $this->_config['class']
            ],
            'pluginLoading' => true,
            /**
             * Plugin Options
             * https://select2.org/options
             */
            'pluginOptions' => [
                'multiple'=>true,
                'placeholder' => 'Search for a city ...',
                'allowClear' => $this->_config['allowClear'],
                'id' => "value attribute" || "option text",
                'text' => "label attribute" || "option text",
                'element' => [],
                
                'minimumInputLength' => $this->_config['inpLength'],
                'language' => [
                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                ],
                
                $this->_config['ajax'] => [
                    'url'      => $this->_config['url'],
                    'dataType' => 'json',
                    'data'     => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                
                /*'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(User) { return User.text; }'),
                'templateSelection' => new JsExpression('function (User) { return User.text; }')*/
            ],
            /**
             * Plugin Events
             * https://select2.org/programmatic-control/events
             */
            'pluginEvents' => [
                'select2:change' => $this->eventCode('change'),
                'select2:opening' => $this->eventCode('opening'),
                'select2:open' => $this->eventCode('open'),
                'select2:closing' => $this->eventCode('closing'),
                'select2:close' => $this->eventCode('close'),
                'select2:selecting' => $this->eventCode('selecting'),
                'select2:select' => $this->eventCode('select'),
                'select2:unselecting' => $this->eventCode('unSelecting'),
                'select2:unselect' => $this->eventCode('unselect'),
            ],
            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'value' => $this->value,

        ];

        $this->htm = Select2::widget($this->options);

    }

}

