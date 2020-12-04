<?php

namespace zetsoft\widgets\inputes;

use kartik\select2\Select2;
use yii\web\JsExpression;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZKSelect2AjaxWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'addonPrependContent' => false,
        'addonAppendContent' => false,
        'isHideSearch' => false,
        'isMaintainOrder' => false,
        'contentBefore' => '',
        'class' => 'kv-editable-input',
        'contentAfter' => '',
        'multiple' => false,
        'ajax.data' => null,
        'ajax.result' => null,
        'allowClear' => true,
        'theme' => ZKSelect2Widget::theme['krajee-bs4'],
        'size' => ZKSelect2Widget::size['lg'],
        'inpLength' => 0,
        'url' => null,
        'tags' => false,
        'escapeMarkup' => null,
        'templateResult' => null,
        'templateSelection' => null,
    ];


    public $branch = [];
    public $_branch = [
        'widget' => [
            'theme',
            'size',
            'url',
            'multiple',
            'allowClear',
            'isHideSearch',
        ]
    ];

    public $branchLabel = [];
    public $_branchLabel = [
        'widget' => Azl . 'Основные опции ZKSelect2Widget'
    ];


    public $event = [];
    public $_event = [
        'opening' => ' console.log("ZKSelect2Widget | $eventOpening") ',

        'closing' => ' console.log("ZKSelect2Widget | $eventClosing") ',
        'close' => ' console.log("ZKSelect2Widget | $eventClose") ',
        'selecting' => 'function() { console.log("ZKSelect2Widget | $eventSelecting")
         }',
        'select' => 'function() { console.log("ZKSelect2Widget | $eventSelecting")
         }',
        'unSelecting' => ' console.log("ZKSelect2Widget | $eventUnSelecting") ',
        'unselect' => ' console.log("ZKSelect2Widget | $eventUnselect") ',
    ];

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

    public function init()
    {
        parent::init();
        if ($this->_config['multiple'])
            $this->dbType = dbTypeJsonb;
    }


    private function addon($content)
    {
        if ($content)
            $prepend['content'] = $content;

        $prepend['asButton'] = false;

        return $prepend;
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
          <i class="{icon}"></i>
HTML,

        /**
         *
         * https://select2.org/data-sources/ajax
         */
        'ajax' => [
            'url' => null,
            'dataType' => 'json',
            'delay' => 250,
            'processResults' => null,
            'cache' => true
        ],
    ];


    public function codes()
    {

        $this->_layout['ajax']['url'] = $this->_config['url'];
        $this->_layout['ajax']['processResults'] = $this->_config['ajax.result'];

        if ($this->_config['hasIcon'])
            $getIcon = strtr($this->_layout['main'], [
                '{icon}' => $this->_config['icon'],
            ]);
        else
            $getIcon = null;

        if ($this->_config['url'] !== null) {
            $ajaxKey = 'ajax';
            $ajax = $this->_layout['ajax'];
        } else {
            $ajaxKey = '';
            $ajax = '';
        }
        if ($this->_config['escapeMarkup'] !== null) {
            $escapeMarkup = 'escapeMarkup';
            $escapeMarkupVal = $this->config['escapeMarkup'];
        } else {
            $escapeMarkup = '';
            $escapeMarkupVal = '';
        }

        if ($this->_config['templateResult'] !== null) {
            $templateResult = 'templateResult';
            $templateResultVal = $this->config['templateResult'];
        } else {
            $templateResult = '';
            $templateResultVal = '';
        }
        if ($this->_config['templateSelection'] !== null) {
            $templateSelection = 'templateSelection';
            $templateSelectionVal = $this->config['templateSelection'];
        } else {
            $templateSelection = '';
            $templateSelectionVal = '';
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
                'options' => ['class' => 's2-togall-button'],
            ],
            'initValueText' => '',
            'addon' => [
                'prepend' => [
                    'content' => $getIcon,
                    $this->addon($this->_config['addonPrependContent']),
                ],

                'append' => $this->addon($this->_config['addonAppendContent']),
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
                'class' => $this->_config['class'],
                //'widget' => $this->dataWidget,
                //'config' => json_encode($this->_config, JSON_UNESCAPED_UNICODE),
            ],
            'pluginLoading' => true,

            'pluginOptions' => [

                'placeholder' => $this->_config['placeholder'],
                'allowClear' => $this->_config['allowClear'],
                'id' => 'value attribute' || 'option text',
                'name' => 'label attribute' || 'option text',
                'element' => [],
                'minimumInputLength' => $this->_config['inpLength'],
                'tags' => $this->_config['tags'],
                'tokenSeparators' => [',', ' '],

                $ajaxKey => $ajax,

                $escapeMarkup => $escapeMarkupVal,
                $templateResult => $templateResultVal,
                $templateSelection => $templateSelectionVal,
            ],

            'pluginEvents' => $this->eventsAll([
                'select2:change' => 'change',
                'select2:opening' => 'opening',
                'select2:open' => 'open',
                'select2:closing' => 'closing',
                'select2:close' => 'close',
                'select2:selecting' => 'selecting',
                'select2:select' => 'select',
                'select2:unselecting' => 'unselecting',
                'select2:unselect' => 'unselect',
            ]),
            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'value' => $this->value,

        ];


        $this->htm = Select2::widget($this->options);



    }
}
