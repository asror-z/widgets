<?php

namespace zetsoft\widgets\inputes;

use kartik\select2\Select2;
use zetsoft\dbitem\data\FormDb;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\incores\ZSelect2;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetRavshan;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 * Asror Zakirov
 */
class ZKSelect2Widget extends ZWidget
{

    public static $grapes = [
        'enable' => true,
        'icon' => null,
        'image' => null,
        'height' => '450px',
        'width' => '500px',
        'dbType' => null,
        'modalWidth' => '450px',
        'modalHeight' => '400px',
        'title' => Azl . null,
        'descs' => Azl . null,
    ];


    public $config = [];
    public $_config = [
        'isLabel' => false,
        'depdrop' => true,
        'showToggleAll' => true,
        'maxSelect' => null,
        'addonPrependContent' => false,
        'addonAppendContent' => false,
        'isHideSearch' => false,
        'isMaintainOrder' => false,
        'contentBefore' => '',
        'class' => 'kv-editable-input kselect2',
        'contentAfter' => '',
        'ajax.data' => [],
        'limit' => 7,
        'ajax.result' => null,
        'ajax' => true,
        'allowClear' => true,
        'theme' => ZKSelect2Widget::theme['krajee-bs4'],
        'size' => ZKSelect2Widget::size['md'],
        'inpLength' => 0,
        'url' => '/api/core/select/select2',
        'grapes' => true,
        'tags' => false,
        'escapeMarkup' => null,
        'templateResult' => null,
        'templateSelection' => null,
        'addBtn' => false,
        'isHiddenVal' => false,

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
        ],
    ];

    public $branchLabel = [];
    public $_branchLabel = [
        'widget' => Azl . 'Опции виджета'
    ];


    public $label = [];
    public $_label = [
        'addonPrependContent' => Azl . 'Дополнить контент1',
        'addonAppendContent' => Azl . 'Добавить контент',
        'isHideSearch' => Azl . 'Скрыть поиск',
        'isMaintainOrder' => Azl . 'Поддерживать порядок',
        'contentBefore' => Azl . 'Содержание до',
        'class' => Azl . 'Класс',
        'contentAfter' => Azl . 'Содержание после',
        'multiple' => Azl . 'Множественный',
        'ajax.data' => Azl . 'Ajax дата',
        'ajax.result' => Azl . 'Ajax результат',
        'allowClear' => Azl . 'Разрешить очистку',
        'theme' => Azl . 'Тема',
        'size' => Azl . 'Размер',
        'inpLength' => Azl . '',
        'url' => Azl . 'URL',
        'tags' => Azl . 'Тэги',
        'escapeMarkup' => Azl . 'Избежать разметки',
        'templateResult' => Azl . 'Результат шаблона',
        'templateSelection' => Azl . 'Выбор шаблона',
    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
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
          <div class="">
            <i class="{icon} "></i>
          </div>
HTML,

        'click' => <<<JS
    function() {
      
        window.parent.select2Related()
        var parentDoc = window.parent.document.getElementById('jsPanel-related-iframe')
        $(parentDoc).attr('src', '{relatedUrl}')
        
    }       
JS,

        'frame' => <<<HTML
     <iframe src="{url}" width="{width}" height="{height}"></iframe>
HTML,

        'js' => <<<JS
   
JS,

        'css' => <<<CSS
/*Select2 ReadOnly Start*/
     .group-{id}{
        pointer-events: none;
        touch-action: none;
        cursor:not-allowed;
     }
   
/*Select2 ReadOnly End*/
CSS,

        /**
         *
         * https://select2.org/data-sources/ajax
         */
        'ajax' => [
            'url' => null,
            'dataType' => 'json',
            'delay' => 250,
            'processResults' => null,
            'cache' => true,
        ],
    ];


    public function codes()
    {

        /*  vd($this->_config['changeSave']);
          vd($this->_config['changeReload']);*/

        $ajaxData = ZArrayHelper::merge($this->_config['ajax.data'], [
            'modelClassName' => $this->modelClassName,
            'attribute' => $this->attribute,
            'modelId' => $this->model->id ?? null,
            'limit' => $this->_config['limit'],
        ]);


        $this->_layout['ajax']['url'] = ZUrl::to(ZArrayHelper::merge([
            $this->_config['url'],
        ], $ajaxData));

        $this->_layout['ajax']['processResults'] = $this->_config['ajax.result'];

        if ($this->_config['hasIcon'])
            $getIcon = strtr($this->_layout['main'], [
                '{icon}' => $this->_config['icon'],
            ]);
        else
            $getIcon = null;


        if ($this->_config['ajax']) {
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

        /**
         *
         * Adder
         */

        $column = null;
        if ($this->modelCheck()) {
            $column = $this->model->columns[$this->attribute];
        }

        if ($column && $column->addPlus)
            $this->addBtn($column);

        if ($this->_config['readonly']) {
            $this->_config['allowClear'] = false;
        }
        // vd($this->data);
        $data = Az::$app->select->select2->ajaxValue($this, $this->value);
        //  vd($data);


//vd($this->name);

        $this->options = [
            'bsVersion' => $this->bsVersion,
            'data' => $data,
            'language' => Az::$app->language,
            'theme' => $this->_config['theme'],
            'changeOnReset' => true,
            'hideSearch' => $this->_config['isHideSearch'],
            'maintainOrder' => $this->_config['isMaintainOrder'],
            'showToggleAll' => $this->_config['showToggleAll'],
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
            'disabled' => false,
            'readonly' => false,
            'options' => [
                'id' => $this->id,
                'multiple' => $this->_config['multiple'],
                'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
                'class' => $this->_config['class'],
            ],

            'pluginLoading' => true,

            'pluginOptions' => [

                'placeholder' => $this->_config['placeholder'],
                'allowClear' => $this->_config['allowClear'],
                'id' => 'value attribute' || 'option text',
                'disabled' => false,
                'name' => 'label attribute' || 'option text',
                'element' => [],
                'minimumInputLength' => $this->_config['inpLength'],
                'maximumSelectionLength' => $this->_config['maxSelect'],
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
                'select2:opejs-input-plun' => 'open',
                'select2:closing' => 'closing',
                'select2:close' => 'close',
                'select2:selecting' => 'selecting',
                'select2:select' => 'select',
                'select2:unselecting' => 'unselecting',
                'select2:unselect' => 'unselect',
            ]),
/*            'model' => $this->model,
            'attribute' => $this->attribute,*/
            'name' => $this->name,
            'id' => $this->id,
            'value' => $this->value,
        ];

        $this->htm = strtr($this->_layout['main'], [
            '{placeholder}' => $this->_config['placeholder'],
        ]);

        $css = '';
        if ($this->_config['readonly']) {
            $css = strtr($this->_layout['css'], [
                '{id}' => $this->id,
            ]);
        }

        $this->htm .= ZSelect2::widget($this->options);
        $this->css = $css;

    }


    public function addBtn($column)
    {

        /** @var FormDb $column */
        $b1 = empty($column->fkTable);
        $b2 = !ZStringHelper::endsWith($this->attribute, '_id');
        $b3 = !ZStringHelper::endsWith($this->attribute, '_ids');

        if ($b1 && $b2 && $b3)
            return false;

        $column = $this->model->columns[$this->attribute];

        $table_name = str_replace(['_ids', '_id'], '', $this->attribute);
        if (!empty($column->fkTable))
            $table_name = str_replace(['_ids', '_id'], '', $column->fkTable);

        $relateName = ZInflector::camelize($table_name);

        $this->htm .= ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-related',
            'config' => [
                'funcName' => 'select2Related',
            ]
        ]);

        $click = strtr($this->_layout['click'], [
            '{relatedUrl}' => ZUrl::to([
                '/core/dynagrid/related',
                'modelName' => $this->modelClassName,
                'modelId' => $this->model->id,
                'relateName' => $relateName,
                'fullWebId' => $this->urlMain,
                'attribute' => $this->attribute,
                'fkQuery' => $column->fkQuery,
                'fkAndQuery' => $column->fkAndQuery,
                'fkOrQuery' => $column->fkOrQuery,
            ])
        ]);

        $this->_config['addonAppendContent'] =
            ZButtonWidget::widget([
                'config' => [
                    'icon' => 'fas fa-plus',
                    'btn' => false,
                ],
                'event' => [
                    'click' => $click
                ]
            ]);
    }

}

