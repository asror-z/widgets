<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\FormDb;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\inputes\ZCKEditorWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\notifier\ZSweetAlertWidget;

class ZEditableIframeWidget2 extends ZWidget
{

    public $widgetClass;
    public $widgetOptions;
    public $columns;
    public $readonly = false;

    public $config = [];
    public $_config = [
        'theme' => ZDynaWidget::theme['panel-success'],
        'modalId' => 'dynaModal',
        'url' => '/core/edit/editable.aspx',
        'width' => '500px',
        'height' => '600px',
        'key' => '',
        'type' => ZEditableIframeWidget::type['sweet'],
        'isSession' => false,
        'options' => [],
        'data' => [],
        'formId' => '',
        'successChange' => '',
        'editableUrl' => ''
    ];

    public const type = [
        'panel' => 'panel',
        'sweet' => 'sweet',
    ];

    public $layout = [];
    public $_layout = [


        'editable' => <<<HTML

<div class="rv-editable-link {class} hint--top" aria-label="{tooltip}">
    <span data-{attribute}="{dbValue}" id="editable-{id}" class="point-raw modal-trigger-button dyna-editable">
      {value}
    </span>    
</div>
HTML,

        'readonly' => <<<HTML
<div class="{class} hint--top" aria-label="{tooltip}">
    <span data-{attribute}="{dbValue}" id="editable-{id}" class="readonly modal-trigger-button">
      {value}
    </span>
</div>
HTML,

        'openSweet' => <<<JS
      window.dynaEditable()
JS,


        'openJsPanel' => <<<JS
      $('#dyna-editable-js-panel').show()
JS,


        'js' => <<<JS

    $("#editable-{id}").on('click',  function () {
        
        if ($(this).hasClass('readonly'))
            return;     
        
        {openModal}
    
        //$('.swal2-content').loader('show')
        $('#swal2-title').html('{title}')
    
        var iframe = $('#{idModal}')
        
        $('#editable-key-{modelName}').val({key})
        $('#editable-index-{modelName}').val({index})
        $('#editable-attribute-{modelName}').val('{attribute}')
        $('#editable-options-{modelName}').val(`{options}`)
        $('#editable-widgetClass-{modelName}').val('{widgetClass}')
        
        $('#editable-form-{modelName}').submit()
        
        iframe.attr('width', '{width}')
        iframe.attr('height', '{height}')
    
        iframe.on('load', function() {
            $('.swal2-content').loader('hide')
        })
        
        $('.jsPanel-btn-close').on('click', function() {
           iframe.attr('src', '') 
        })
        
    });
JS,

        'css' => <<<CSS

    .readonly {
        cursor:pointer;
        color:#000000; 
    }
    
    .point-raw{
        width:auto;
        color: #544d9d!important;
        cursor:pointer;
    }
        
CSS,


    ];

    public function codes()
    {

        $column = $this->model->columns[$this->attribute];

        $tooltip = $column->title;
        if (!empty($column->tooltip)) {
            $tooltip = $column->tooltip;
        }

        $dbValue = '';
        if (!is_array($this->value))
            $dbValue = $this->value;

        $button = strtr($this->_layout['editable'], [
            '{id}' => $this->id,
            '{value}' => $this->getValue(),
            '{dbValue}' => $dbValue,
            '{attribute}' => $this->attribute,
            '{class}' => $this->_config['class'],
            '{tooltip}' => $tooltip,
        ]);

        if ($this->readonly) {
            $button = strtr($this->_layout['readonly'], [
                '{id}' => $this->id,
                '{class}' => $this->_config['class'],
                '{attribute}' => $this->attribute,
                '{value}' => $this->getValue(),
                '{dbValue}' => $dbValue,
                '{tooltip}' => $tooltip,
            ]);
        }

        $widget = $this->widgetClass;

        $height = ZArrayHelper::getValue($widget::$grapes, 'height');
        if (empty($height))
            $height = $column->modalHeight;

        $width = ZArrayHelper::getValue($widget::$grapes, 'width');
        if (empty($width))
            $width = $column->modalWidth;

        $this->htm = $button;

        switch ($this->_config['type']) {

            case 'panel':
                $openType = $this->_layout['openJsPanel'];
                $modalId = 'ravshanDynaPanel';
                break;

            default:
                $openType = $this->_layout['openSweet'];
                $modalId = 'ravshanDyna';
                break;
        }

        $widgetClass = str_replace('\\', '/', $this->widgetClass);

        $title = Az::l("Редактировать $column->title");
        $this->js = strtr($this->_layout['js'], [
            '{width}' => $width,
            '{openModal}' => $openType,
            '{idModal}' => $modalId,
            '{height}' => $height,
            '{title}' => $title,
            '{modelId}' => $this->jscode($this->_config['key']),
            '{key}' => $this->jscode($this->_config['key']),
            '{index}' => $this->jscode($this->_config['index']),
            '{id}' => $this->jscode($this->id),
            '{attribute}' => $this->jscode($this->attribute),
            '{options}' => $this->jscode($this->widgetOptions),
            '{widgetClass}' => $this->jscode($widgetClass),
            '{modelName}' => $this->jscode($this->modelClassName),
            '{session}' => $this->jscode($this->_config['isSession'])
        ]);

        $this->css = strtr($this->_layout['css'], []);

    }

    private function getValue()
    {

        Az::$app->forms->wiData->clean();
        Az::$app->forms->wiData->model = $this->model;
        Az::$app->forms->wiData->attribute = $this->attribute;

        return Az::$app->forms->wiData->value();

    }


}
