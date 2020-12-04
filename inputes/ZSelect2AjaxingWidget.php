<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

/**
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 *
 * Created By: MurodovMirbosit
 * Refactored: Tursunaliyev Abdulloh
 *
 * Class ZSelect2Widget
 * https://github.com/asror-z
 * https://github.com/select2/select2
 * https://select2.org/
 * https://select2.github.io/select2/
 *
 */
class ZSelect2AjaxingWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'width' => '',
        'class' => '',
        'theme' => ZSelect2Widget::theme['bootstrap'],
        'multiple' => false,
        'icon' => '',
        'hasPlace' => true,
        'placeholder' => '',
        'flagHeight' => '15px',
        'flagWidth' => '18px',
        'margin' => '',
        'padding' => '',
        //true only in view page
        'ajax' => false,
        'url' => '/core/tester/restjson/api4.aspx',
        'dataType' => 'jsonb',
        //true for select country with his flag
        'imagePath' => false,
        'clear' => true,
        'label' => false,
        //optionlarini backgroundi
        'selectedColor' => '#d9edf7',
        'selectColor' => '',
        'Fontcolor' => '#000000',
        'readonly' => false,

    ];

    public static $grapes = [
        'enable' => true,
        'icon' => 'fa-down',
        'src' => '/render/inputes/ZSelect2Widget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<h4>Select2</h4>',
        'content' => Azl . '<b>this widget for selcted element</b>',
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
        'widget' => Azl . 'Основные опции ZSelect2Widget',
        'tooltip' => Azl . 'Примечание',
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    public const theme = [
        'bootstrap' => 'bootstrap',
        'classic' => 'classic',
        'material' => 'material',
    ];

    public $event = [];
    public $_event = [
        'opening' => "function() { console.log('select2:opening'); }",
        'open' => "function() { console.log('open') }",
        'closing' => "function() { console.log('close'); }",
        'close' => "function() { console.log('close'); }",
        'selecting' => "function() { console.log('selecting'); }",
        'select' => "function() { console.log('select'); }",
        'unselecting' => "function() { console.log('unselecting'); }",
        'unselect' => "function() { console.log('unselect'); }",
        'clear' => "function() { console.log('select2:clear'); }",
        'clearing' => "function() { console.log('select2:clearing'); }",
        'clicking' => "function() { console.log('button:clicking'); }",
    ];

    public function asset()
    {
        //CssFile
        $this->fileCss('/render/asrorz/css/select2.css');

        //Theme
        $this->fileCss('/render/inputes/ZSelect2Widget/assets/select2-bootstrap.css');

        //JsFile
        $this->fileJs('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        {label}
<select id="{id}" class="select {class} selectM" {readonly} {multiple} name="{name}" data-placeholder="{placeholder}" data-allow-clear="{clear}">
  {content}
</select>


<div class="col-md-12 mt-4">

    <div class="col-md-3 ml-auto mt-4" id="{id}-parent">
    
    </div>

</div>

HTML,

        'option' => <<<HTML
             <option value="{key}" {selected}>{value}</option>
HTML,
        'label' => <<<HTML
            <label class="select2-label" for="{id}">
            {labels}   
</label>
HTML,

        'js' => <<<JS
      $(document).ready(function() {
        $('#{id}').select2({
          width: '100%',
          theme: 'bootstrap',
          placeholder: '{placeholder}',
          allowClear: true,
        })

        .on("select2:closing", {closing})
        .on("select2:open", {open})
        .on("select2:close", {close})
        .on("select2:opening", {opening})
        .on("select2:selecting", {selecting})
        .on("select2:select", {select})
        .on("select2:unselecting", {unselecting})
        .on("select2:unselect", {unselect})
        .on("select2:clearing", {clearing})
        .on("select2:clear", {clear});
         {withAjax}
      });
JS,

        'withAjax' => <<<JS
    
      $.ajax({
         url: '{url}',
         method: 'GET',
         success: function(response) {
             var select2 = $("#{id}");
             select2.empty();
             select2.append(document.createElement('option'))
             
             for (const prop in response) {

                 var options = document.createElement('option');
                 options.value = prop;
                 options.text = response[prop];

                 select2.append(options);
             }
         }
      }) 
JS,
        
        'icon' => <<<HTML
    <i class="{icon} fa-2x"></i>
HTML,

    ];

    public function codes()
    {

        $withAjax = '';

        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{data}' => $this->data,
            '{class}' => $this->_config['class'],
            '{name}' => $this->modelClassName,
            '{content}' => '',
            '{multiple}' => $this->_config['multiple'] ? 'multiple="multiple"' : '',
            '{placeholder}' => $this->_config['placeholder'],
            '{clear}' => $this->_config['clear'],
            '{readonly}' => $this->_config['readonly'] ? 'disabled' : '',
        ]);

        $column = $this->model->columns[$this->attribute];

        $b1 = !empty($column->fkTable);
        $b2 = ZStringHelper::endsWith($this->attribute, '_id');
        $b3 = ZStringHelper::endsWith($this->attribute, '_ids');
        
        if ($b1 || $b2 || $b3) {

            $table_name = str_replace(['_ids', '_id'], '', $this->attribute);
            if (!empty($column->fkTable))
                $table_name = str_replace(['_ids', '_id'], '', $column->fkTable);

            $modelClass = ZInflector::camelize($table_name);
            $withAjax = strtr($this->_layout['withAjax'], [
                '{id}' => $this->id,
                '{url}' => ZUrl::to([
                    '/api/core/select/testSelect2',
                    'modelClass' => $modelClass,
                    'attribute' => $this->attribute,
                    'fkQuery' => $column->fkQuery,
                    'fkAndQuery' => $column->fkAndQuery ,
                    'fkOrQuery' => $column->fkOrQuery,
                ]),
            ]);

        }


        $this->js .= strtr($this->_layout['js'], [
            '{width}' => $this->jscode($this->_config['width']),
            '{theme}' => $this->jscode($this->_config['theme']),
            '{id}' => $this->id,
            '{withAjax}' => $withAjax ?? '',
            //Events
            '{select}' => $this->eventCode('select'),
            '{selecting}' => $this->eventCode('selecting'),
            '{clear}' => $this->eventCode('clear'),
            '{clearing}' => $this->eventCode('clearing'),
            '{open}' => $this->jscode(strtr($this->_event['open'], [
                '{id}' => $this->id,
                '{clicking}' => $this->eventCode('clicking')
            ])),
            '{opening}' => $this->eventCode('opening'),
            '{close}' => $this->eventCode('close'),
            '{closing}' => $this->eventCode('closing'),
            '{unselect}' => $this->eventCode('unselect'),
            '{unselecting}' => $this->eventCode('unselecting'),
        ]);
        
    }
}


