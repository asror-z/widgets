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
 * Refactored: AzimjonToirov
 *
 * Class ZSelect2Widget
 * https://github.com/asror-z
 * https://github.com/select2/select2
 * https://select2.org/
 * https://select2.github.io/select2/
 *
 */
class ZSelect2Widget extends ZWidget
{

    

    public $config = [];
    public $_config = [
        'width' => '',
        'class' => '',
        'theme' => ZKSelect2Widget::theme['bootstrap'],
        'icon' => '',
        'hasPlace' => true,
        'placeholder' => '',
        'flagHeight' => '15px',
        'flagWidth' => '18px',
        'margin' => '',
        'padding' => '',
        'tags' => true,
        //true only in view page
        'ajax' => false,
        'pjax' => true,
        'url' => null,
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
        'allowClear' => false,
        'grapes' => true,
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => 'fa-down',
        'height' => '600px',
        'width' => '840px',
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
        'krajee-bs4' => 'krajee-bs4',
    ];

    public $event = [];
    public $_event = [
        'opening' => "function() { console.log('select2:opening'); }",
        'open' => "function() { console.log('open'); }",
        'closing' => "function() { console.log('close'); }",
        'close' => "function() { console.log('close'); }",
        'selecting' => "function() { console.log('selecting'); }",
        'select' => "function() { console.log('select'); }",
        'unselecting' => "function() { console.log('unselecting'); }",
        'unselect' => "function() { console.log('unselect'); }",
        'clear' => "function() { console.log('select2:clear'); }",
        'clearing' => "function() { console.log('select2:clearing'); }",
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
        <select id="{id}" class="select {class} selectM" {readonly} {multiple} name="{name}">
         <option value="">{placeholder}</option>
        {content}
        </select>
HTML,

        'option' => <<<HTML
             <option value="{key}" {selected}>{value}</option>
HTML,

        'label' => <<<HTML
            <label class="select2-label" for="{id}">
            {labels}   
</label>
HTML,
        
        'select2Options' => <<<JS
        
       $("#{id}").select2({
            theme: '{theme}',
            delimiter: ',',
            tags: '{tags}',
            persist: true,
            create: true,
            createOnBlur: true,
            createFilter: null,
            highlight: true,
            maxItems: 1,
            hideSelectedhideSelected: null,
            closeAfterSelect: true,
            loadThrottle: 300,
            scrollDuration: 60,
            loadingClass: 'loading',
            preload: false,
            dropdownParent: null,
            addPrecedence: false,
            selectOnTab: true,
            diacritics: true,
            dataAttr: 'data-',
            valueField: 'value',
            optgroupValueField: 'value',
            labelField: 'text',
            optgroupLabelField: 'label',
            optgroupField: 'optgroup',
            disabledField: 'disabled',
            sortField: 'order',
            searchField: ['text'],
            searchConjunction: 'and',
            lockOptgroupOrder: false,
            copyClassesToDropdown: true, 
            loadMorePadding: 100,
            closeOnSelect: true,
            openOnEnter: false,
            //dropdownAutoWidth: true,
            selectOnBlur: false,
            width: '{width}',
            allowClear: '{allowClear}',
            maximumInputLength: 20,
            placeholder: '{placeholder}',
           
        })   
          
        {eventItem}
        
        ;
JS,


        'pjax' => <<<JS

        function ZSelect2Widget(){
            {select2Options}
        }
        
        $(document).ready(function() {
         ZSelect2Widget();
         
         {withAjax}  
        });
        
        $(document).on('pjax:end', function () {
            ZSelect2Widget();
        });
JS,

        

        'js' => <<<JS
      $(document).ready(function() {
      {select2Options}
      
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

        'css' => <<<CSS
       .select2-container--bootstrap .select2-results__option[aria-selected=true]{
       background-color: {selectedColor};
       }
       .select2-container--bootstrap .select2-results__option--highlighted[aria-selected]{
       color: {Fontcolor};
       background-color: {selectColor};
       }    
CSS,

        'icon' => <<<HTML
    <i class="{icon} fa-2x"></i>
HTML,
    ];

    public function codes()
    {
        $option = '';

        if (!$this->_config['ajax']) {
            foreach ($this->data as $key => $value) {

                $selected = '';
                if ($this->value === $key) {
                    $selected = 'selected="selected"';
                }

                if (is_array($this->value)) {
                    foreach ($this->value as $val) {
                        if ($key === $val) {
                            $selected = 'selected="selected"';
                        }
                    }
                }

                $option .= strtr($this->_layout['option'], [
                    '{value}' => $value,
                    '{key}' => $key,
                    '{selected}' => $selected,
                    '{readonly}' => $this->_config['readonly'],
                ]);
            }
        }

        $iconCode = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon'],
        ]);

        $name = $this->name;
        if ($this->_config['multiple']) {
            $name = $this->name . '[]';
        }

        $label = '';
        if ($this->_config['label']) {
            $label .= strtr($this->_layout['label'], [
                '{labels}' => $this->_config['placeholder'],
                '{id}' => $this->id,
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{data}' => $this->data,
            '{class}' => $this->_config['class'],
            '{name}' => $name,
            '{content}' => $option,
            '{multiple}' => $this->_config['multiple'] ? 'multiple="multiple"' : '',
            '{icon}' => $this->_config['hasIcon'] ? $iconCode : '',
            '{readonly}' => $this->_config['readonly'] ? 'disabled' : '',
            '{label}' => $label,
            '{placeholder}' => $this->_config['placeholder'],
        ]);
        
        $withAjax = '';
        if ($this->_config['ajax'] && $this->modelCheck()) {

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
        }

        $eventsAll = $this->eventsAll([
            'select2:select' => 'select',
            'select2:opening' => 'opening',
            'select2:open' => 'open',
            'select2:closing' => 'closing',
            'select2:close' => 'close',
            'select2:selecting' => 'selecting',
            'select2:unselecting' => 'unselecting',
            'select2:clear' => 'clear',
            'select2:unselect' => 'unselect',
            'select2:clearing' => 'clearing',
        ]);

        $eventItem = $this->eventsOn($eventsAll);

        $conf = $this->js = strtr($this->_layout['select2Options'],[
            //configuration
            '{width}' => $this->jscode($this->_config['width']),
            '{theme}' => $this->jscode($this->_config['theme']),
            '{id}' => $this->jscode($this->id),
            '{tags}' => $this->jscode($this->_config['tags']),
            '{allowClear}' => $this->_config['allowClear'],
            '{placeholder}' => $this->_config['placeholder'],
            '{eventItem}' => $eventItem,
            //Events

        ]);

        if ($this->_config['pjax']) {
            $this->js .= strtr($this->_layout['pjax'], [
                '{id}' => $this->jscode($this->id),
                '{select2Options}' => $conf,
                '{withAjax}' => $withAjax,
            ]);
        } else {
            $this->js .= strtr($this->_layout['js'], [
                //'{flagSelect2}' => $this->jscode($this->_layout['flagSelect2']),
                '{select2Options}' => $conf,
                '{withAjax}' => $withAjax,
            ]);
        }

        $this->css = strtr($this->_layout['css'], [
            '{margin}' => $this->_config['margin'],
            '{padding}' => $this->_config['padding'],
            '{selectedColor}' => $this->_config['selectedColor'],
            '{selectColor}' => $this->_config['selectColor'],
            '{Fontcolor}' => $this->_config['Fontcolor']
        ]);
    }
}
